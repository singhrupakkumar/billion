<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Cart;
use App\Setting; 
use Carbon\Carbon;  
use Session;    

class CartService
{ 

    public function __construct(Request $request) {   
        $this->request = $request;  
    }


    public $maxQuantity = 99;



    public static function add($id, $quantity = 1 ,$uid = 0,$voucher_brand_id=0,$sid=NULL) { 
     if(!is_numeric($quantity)) {  
        $quantity = 1;
    }

    if($quantity == 0) { 
        
        return;
    }

    $product = Product::with(['category'])->where('id',$id)->first();

    if(!$product) return false;

    $data['product_id'] = $product->id;
    $data['voucher_brand_id'] = $voucher_brand_id;  
    $data['name'] = $product->name;
    $data['user_id'] = $uid;
    $data['price'] = $product->price;    
    $data['qty'] = $quantity; 
    $data['image'] = $product->image;
    $data['category_id'] = ($product->category)?$product->category->id:0;

    $cartdata['session_id'] = $sid; 
    $cartdata['qty'] = $quantity;
    $cartdata['user_id'] = $uid;  
    $cartdata['product_id'] = $product->id;
    $cartdata['voucher_brand_id'] = $voucher_brand_id;  
    $cartdata['image'] =  $product->image; 
  
    $cartdata['category_id'] =($product->category)?$product->category->id:0; 
    $cartdata['category_name'] =($product->category)?$product->category->name:NULL;   
    $cartdata['name'] = $product->name;
    $cartdata['price'] = $product->price; 
    $subtotal = $product->price*$quantity; 
    $cartdata['subtotal'] = sprintf('%01.2f', $subtotal); 
   
    $existing = Cart::where(['user_id'=>$uid,'product_id'=>$product->id])->first();

    if($existing) {
       Cart::where('id',$existing->id)->update($cartdata);
    } else {     
       Cart::create($cartdata);
    } 

   CartService::cart($sid,$uid);  
   return $product;    
}    

   //////////////////////////////////////////////////
public static function checkcrt($session_id,$pid,$uid) { 
    $cartData = Cart::with('product')->where(['session_id'=>$session_id,'product_id'=>$pid,'user_id'=>$uid])->first(); 
    return $cartData;   
}



    /////////////////////////////////////////////

public static function remove($id) { 
    $cartProduct = Cart::find($id)->delete(); 
    return true;
}

//////////////////////////////////////////////////

public static function cart($session_id,$user_id=0) { 

    $shop = Cart::with('product','category','voucher_brand')->where(['session_id'=>$session_id])->orWhere('user_id',$user_id)->get();   
    $quantities = 0; 
    $subtotal = 0;
    $total = 0;
    $order_item_count = 0;

    if (count($shop) > 0) {
        $currency = ''; 
        foreach ($shop as $item) {
            $quantities += $item->qty;
            $subtotal += $item['subtotal'];
            $total += $item['subtotal'];
            $order_item_count++;
            $currency = $item->product? $item->product->currency:''; 
        }
     
   
        $d['currency'] = $currency;
        $d['order_item_count'] = $order_item_count;   
        $d['quantity'] = $quantities;
        $d['subtotal'] = sprintf('%01.2f', $subtotal);
        $d['total'] = sprintf('%01.2f', $total);
    }
    else {
        $d['currency'] = '';
        $d['order_item_count'] = 0;   
        $d['quantity'] = 0;
        $d['subtotal'] = 0;     
        $d['total'] = 0;    
    }

    $alldata['items'] = $shop;
    $alldata['cartInfo'] = $d;
    $alldata['session_id'] = $session_id;
    Session::put($alldata);     
    return $alldata;     
}


public static function clear($session_id,$user_id=0) {

    Cart::where(['session_id'=>$session_id])->orWhere('user_id',$user_id)->delete();    
    return true; 
}

}
