<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Log;
use DB,URL;
use Mail,Session;
use Validator;
use Carbon\Carbon;
use App\Product;
use App\Order;
use App\OrderItem;
use App\PaymentHistory;
use App\Cart;
use App\Category;
use App\OrderVoucher;
use App\Voucher;
use App\Plan;
use App\Subscription;
use App\LiveBidding;
use App\Services\CartService;  

class ProductController extends Controller
{
	public function __construct() {

	} 

	public function show($slug) {
    $product = Product::with(['category','product_voucher.voucher_brand'])->where('slug', $slug)->first();  
    if(!$product)   return redirect('/')->with('warning','Product not found');  
     return view('product.view',compact('product'));    
  }

  public function liveAuction($slug) {
    $planExist = Subscription::with('plan')->where('user_id',Auth::id())->first();
    if(!$planExist)   return redirect(route('plan'))->with('warning','You don\'t have subscription.'); 

    $date_now = date("Y-m-d"); // this format is string comparable

    if ($date_now >= $planExist->expired_date) {   
        return redirect(route('plan'))->with('warning','Your subscription has been expired.'); 
    }

    $product = Product::with(['category','product_voucher.voucher_brand'])->where('slug', $slug)->first();  
    if(!$product)   return redirect('/')->with('warning','Product not found');  
     return view('product.livebid',compact('product'));     
  }

  public function bidNow(Request $request){
     $validatedData = $request->validate([
      'product_id' => 'required',
      'bid_amount' => 'required', 
      ]); 

     $exist = LiveBidding::where(['user_id'=>Auth::id(),'product_id'=>$request->product_id])->first(); 

     if($exist) return redirect('/')->with('warning','Already submit your proposal.');   
     LiveBidding::create([
      'product_id'=>$request->product_id,
      'user_id'=>Auth::id(), 
      'auction_date'=>date("Y-m-d"), 
      'bid_amount'=>$request->bid_amount,  
      'description'=>$request->description
     ]);
   
     return redirect('/')->with('success','Your proposal submit successfully.'); 
  }

  public function ajaxData($id) {
    $product = Product::where('id', $id)->first();  
    if(!$product) return response()->json(['success' => false, 'message' => 'Product not found'], 200); 

    return response()->json(['success' => true, 'data' => $product], 200);   
  }

  public function category($slug) {

     return view('product.products',compact('cart'));  
  }  

	/**
	*Add To Cart API
	*/
	public function addToCart(Request $request) { 
		
		$validatedData = $request->validate([
			'product_id' => 'required',
			'qty' => 'required', 
			]); 
		$user_id = Auth::id();
		$session_id = $request->session()->all()['_token']; 
		$product_id = $request->product_id;  
    $voucher_brand_id = ($request->voucher_brand_id) ? $request->voucher_brand_id: 0;  
    
		$quantity = ($request->qty) ? $request->qty: 0;

		if(!empty($user_id)){ 
               $user_id = $user_id;  
        }else{
               $user_id = 0 ;
        }           

		$exits = Cart::where(['session_id'=>$session_id,'product_id'=>$product_id,'user_id'=>$user_id])->first(); 

		if($exits){
			 $cart = CartService::cart($session_id,$user_id);
			 return redirect()->back()->with('success',$exits->name .' Product is already added in your cart.');      
		}else{

			$product = CartService::add($product_id, $quantity, $user_id,$voucher_brand_id,$session_id); 

			if(!empty($product)) {
			   $cart = CartService::cart($session_id,$user_id);    
			   return redirect()->back()->with('success', $product->name . ' is added to your cart successfully.');  	  			
				
			} else {  

        return redirect()->back()->with('error', 'Unable to add this product to your shopping cart.');
		
			} 

		}
 
	}

	/**
	*Clear Cart API
	*/
	public function cartClear() {
	  $product = CartService::clear(Auth::id()); 
	  return response()->json(['success' => true, 'message' => 'All item(s) removed from your shopping cart'], 200); 
	  
    }

    /**
	*Remove Cart Item API
	*/
    public function cartRemoveItem(Request $request) {
    	$validator = Validator::make($request->all(), [
			'cart_id' => 'required'
		]);  

		if ($validator->fails()) {
			return response()->json(['success' => false, 'message' => $validator->messages()->first()], 422);
		}

    $user_id = 0;
		if(Auth::id()){
		$user_id = Auth::id();	
		}  
    	 CartService::remove($request->cart_id); 
    	 $cart = CartService::cart(Session::all()['_token'],$user_id);       
    	 return response()->json(['success' => true, 'data'=>$cart,'message' =>'Item was removed from your shopping cart'], 200);
    }
    /**
	*Display Cart API
	*/
    public function displayCart(){
    	$user_id = 0;
		if(Auth::id()){
		$user_id = Auth::id();	
		}			
      $cart = CartService::cart(Session::all()['_token'],$user_id);          
      return response()->json(['success' => true, 'data' => $cart,'tokein'=>Session::all()['_token']], 200); 
         
    } 

    public function cart(){ 
        $user_id = 0;
		if(Auth::id()){
		$user_id = Auth::id();	
		}			
      $cart = CartService::cart(Session::all()['_token'],$user_id);        
      return view('cart.cart',compact('cart'));     
    }

    /**
	*Increase Qty Cart API
	*/
     public function cartIncreaseQty(Request $request) {  
	     $validator = Validator::make($request->all(), [
				'product_id' => 'required'
			]);  

			if ($validator->fails()) {
				return response()->json(['success' => false, 'message' => $validator->messages()->first()], 422);
			}   
            
      $product_id = $request->product_id; 
       $user_id = 0;
			if(Auth::id()){
			$user_id = Auth::id();	
			}	

            $product = Product::where('id',$product_id)->first();
            $cartproduct = Cart::where(['product_id'=>$product_id,'user_id'=>$user_id])->first();
   
            if($cartproduct->qty < $product->stock){ 

            		 $qty = $cartproduct->qty + 1;
            		 $plustotal = $product->price;
                     $subtotal = $cartproduct->subtotal + $plustotal; 
                     Cart::where('id',$cartproduct->id)->update(['qty'=>$qty,'subtotal'=>$subtotal]);
           
            }else{
            	 $cart = CartService::cart(Session::all()['_token'],$user_id); 
            	return response()->json(['success' => false, 'data' => $cart,'message'=>'Available Item(s) in Stock : '.$product->stock], 200);          
            } 

	      $cart = CartService::cart(Session::all()['_token'],$user_id);        
	      return response()->json(['success' => true, 'data' => $cart,'msg'=>'Item increase successfully'], 200);       
     
    }  
    
    public function cartDecreaseQty(Request $request) { 
           $validator = Validator::make($request->all(), [
				'product_id' => 'required'
			]);  

			if ($validator->fails()) {
				return response()->json(['success' => false, 'message' => $validator->messages()->first()], 422);
			}   
            
            $product_id = $request->product_id; 
             $user_id = 0;
			if(Auth::id()){
			$user_id = Auth::id(); 	
			}

            $product = Product::where('id',$product_id)->first();
            $cartproduct = Cart::where(['product_id'=>$product_id,'user_id'=>$user_id])->first();

           if($cartproduct->qty  > 1){   
            		 $qty = $cartproduct->qty - 1;
            		 $minustotal = $product->price - ($product->price*$product->discount/100);
                     $subtotal = $cartproduct->subtotal - $minustotal;  
                     Cart::where('id',$cartproduct->id)->update(['qty'=>$qty,'subtotal'=>$subtotal]);
           
            }else{ 
            	 $cart = CartService::cart(Session::all()['_token'],$user_id);   
            	return response()->json(['success' => false,'data' => $cart,'message'=>'At least 1 Qty required'], 200);           
            } 
  
	      $cart = CartService::cart(Session::all()['_token'],$user_id);            
	      return response()->json(['success' => true, 'data' => $cart,'msg'=>'Item decrease successfully'], 200);    
    }

    public function checkout(Request $request){
 
        if($request->isMethod('post')){ 
            $address = array(
                'first_name'=> $request->first_name,
                'last_name'=> $request->last_name,
                'email'=>$request->email,
                'phone'=> $request->phone,
                'address'=> $request->address,
                'city'=> $request->city,
                'state'=> $request->state,
                'zip'=> $request->zip
                );   
          
            Session::put('shippingaddress',$address);
        }
       $user = Auth::user(); 
       $cart = CartService::cart(Session::all()['_token'],Auth::id());  
       if($cart['cartInfo']['order_item_count'] == 0)   
             return redirect('/')->with('warning','Shopping cart empty');  
     $shippingaddress = Session::get('shippingaddress');
  
    return view('cart.checkout',compact('cart','user','shippingaddress')); 
    }

    public function search(Request $request) { 
        $products =  Product::with('product_voucher.voucher_brand'); 
        if($request->search !==null) {
            $search = $request->search;
            $search = preg_replace('/[^a-zA-Z0-9 ]/', '', $search);
       
            $products = $products->where('name','LIKE','%'.$search.'%');  
        }
      $products = $products->where('is_voucher',1)->get();
      if(count($products) == 1) {
            return redirect(route('product.view',$products[0]->slug))->with('warning', 'Product found');  
      }   
      return view('product.search',compact('products'));   
    }


    public function payment(Request $request){
    
        $shipping = Session::get('shippingaddress');
        if($shipping==null)  return redirect()->back()->with('warning','Shipping address empty'); 
        $cart = CartService::cart(Session::all()['_token'],Auth::id());

        if($cart['cartInfo']['order_item_count'] == 0)   
             return redirect()->back()->with('warning','Shopping cart empty');  
        $user = Auth::user();
        $first_name = $shipping['first_name']?$shipping['first_name']:$user->first_name;
        $last_name = $shipping['last_name']?$shipping['last_name']:$user->last_name;
        $orderemail = $shipping['email']?$shipping['email']:$user->email;
        $orderphone = $shipping['phone']?$shipping['phone']:$user->phone;
        $orderaddress = $shipping['address']?$shipping['address']:null;
        $ordercountry = $user->country;  
        $ordercity = $shipping['city']?$shipping['city']:null;
        $orderstate = $shipping['state']?$shipping['state']:null;  
        $orderzip = $shipping['zip']?$shipping['zip']:null;  

            $order = new Order;             
            $order->order_number = strtoupper(substr(md5(uniqid(rand(1, 99999))), 0, 8)); // uniqid genrate
            $order->address_id = $request->input('address_id')?$request->input('address_id'):0;             
            $order->currency = $cart['cartInfo']['currency'];
            $order->first_name = $first_name;
            $order->last_name = $last_name;
            $order->email = $orderemail;         
            $order->phone = $orderphone;
            $order->address = $orderaddress;
            $order->house_no = null;
            $order->city = $ordercity;
            $order->state = $orderstate;
            $order->zip = $orderzip;
            $order->country = $ordercountry;
            $order->lat = 0;
            $order->lng = 0; 
            $order->payment_mode = 'cod';        
            $order->subtotal = $cart['cartInfo']['subtotal'];
            $order->delivery_charge  = 0;      
            $order->tax = 0;  
            $order->total = $cart['cartInfo']['total'];      
            $order->user_id = Auth::id();   
            $order->save();


          $orderItem = [];
          $voucherItem = [];
          $date = \Carbon\Carbon::now()->toDateTimeString();

          foreach ($cart['items'] as $key => $item) { 
            $orderItem[$key]['order_id'] = $order->id; 
            $orderItem[$key]['category_id'] = $item->category_id; 
            $orderItem[$key]['category_name'] = $item->category_name; 
            $orderItem[$key]['product_id'] = $item->product_id; 
            $orderItem[$key]['product_name'] =$item->name;  
            $orderItem[$key]['price'] = $item->price;
            $orderItem[$key]['subtotal'] = $item->subtotal;
            $orderItem[$key]['image'] = $item->image;
            $orderItem[$key]['qty'] = $item->qty;     
            $orderItem[$key]['created_at'] = $date;    
            $orderItem[$key]['updated_at'] = $date;               
         }   
        OrderItem::insert($orderItem); 

        foreach ($cart['items'] as $key => $item) {
            $soldVoucher = OrderVoucher::where('voucher_brand_id',$item->voucher_brand_id)->pluck('voucher_id');
            $find_no_of_voucher = \App\ProductVoucher::where('voucher_brand_id',$item->voucher_brand_id)->first();
             $no_of_voucher = 1;
            if($find_no_of_voucher){
              $no_of_voucher = $find_no_of_voucher->no_of_voucher;
            }
            $brandVouchers = Voucher::where('brand_id', $item->voucher_brand_id)->whereNotIn('id',$soldVoucher)->get()->random($no_of_voucher); 

            if($brandVouchers->isNotEmpty()){
              foreach ($brandVouchers as $vkey => $voucher) {
                  $voucherItem[$vkey]['order_id'] = $order->id; 
                  $voucherItem[$vkey]['product_id'] = $item->product_id;
                  $voucherItem[$vkey]['voucher_brand_id'] =$voucher->brand_id;    
                  $voucherItem[$vkey]['voucher_id'] = $voucher->id;   
                  $voucherItem[$vkey]['created_at'] = $date;    
                  $voucherItem[$vkey]['updated_at'] = $date;  
                  Voucher::where('id',$voucher->id)->update(['sold_status'=>1]); 
              }
            }

           
             

                   
        }
        OrderVoucher::insert($voucherItem);      
        CartService::clear(Session::all()['_token'],Auth::id());          
       $amt = $cart['cartInfo']['total'] ;     
       $returnUrl = URL::to("/")."/shop/paymentSuccess?order_id=$order->id";  
       $ipnNotificationUrl = URL::to("/")."/shop/ipn"; 
          ///////////////////////////////////////////////payment////////////////////////////////////////////////
            echo ".<form name=\"_xclick\" action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\">
            <input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
            <input type=\"hidden\" name=\"email\" value=\"rupak-buyer@avainfotech.com\">
            <input type=\"hidden\" name=\"business\" value=\"rupak1-facilitator@avainfotech.com\">
            <input type=\"hidden\" name=\"currency_code\" value=\"USD\">
            <input type=\"hidden\" name=\"custom\" value=\"$order->id\">
            <input type=\"hidden\" name=\"amount\" value=\"$amt\">
            <input type=\"hidden\" name=\"return\" value=\"$returnUrl\">
            <input type=\"hidden\" name=\"notify_url\" value=\"$ipnNotificationUrl\"> 
            </form>";
            echo "<script>document._xclick.submit();</script>"; 
         exit;   
    }

    public function paymentSuccess(Request $request){

    	if(!Session::has('shippingaddress'))  return redirect('/')->with('warning','Shopping cart empty');
    	if($request->tx){

	    	PaymentHistory::create([
	    		'user_id'=>Auth::id(),
	    		'order_id'=>$request->order_id,
	    		'amount'=>$request->amt, 
	    		'currency'=>$request->cc,
	    		'transaction_id'=>$request->tx,
	    		'gateway_status'=>$request->st,
	    		'payment_gateway'=>'PayPal',
	    		'payment_method'=>'Card'
	    	]);

	    	Order::where('id',$request->order_id)->update([
	    		'payment_mode'=>'Card',
	    		'payment_status'=>1
	    	]);

    	}
     $paymentinfo =  $request->all();		
   	 $order = Order::with('orderItem')->where('id',$request->order_id)->first(); 
   	  Session::forget('shippingaddress'); 
   	  CartService::clear(Session::all()['_token'],Auth::id());  
     return view('cart.success',compact('order','paymentinfo'));
    }

    public function ipn(Request $request){ 
    	print_r($request->all());
    	exit;
    }


}
