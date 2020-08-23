<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Country;
use App\ProductVoucher;
use Log,URL; 
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['logout']]);
    }

    public function index(Request $request)
    {  
        $sortby = $request->sort ? $request->sort : 'DESC';
        try {
           if ($request->searchquery != "") {
               $all = Product::orderBy('id', $sortby);
               $all = $all->orWhere('name', 'LIKE', '%' . $request->searchquery . '%')
               ->orWhere('price', 'LIKE', '%' . $request->searchquery . '%')
               ->paginate(12)->setPath('');
               $pagination = $all->appends(array(
                   'searchquery' => $request->searchquery
               ));
               if (count($all) > 0) 
                   return view('admin.products.list', compact('all'))->withQuery($request->searchquery);
               return back()
               ->with('warning', 'Record not found');
           }else {
               $all = Product::orderBy('id', $sortby);
               $all = $all->paginate(12);
           }
       } catch (\Exception $e) {
           Log::info('Log products in', array('error' => $e));
           throw $e;
       }

       return view('admin.products.list',compact('all'));               
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {  

        return view('admin.products.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

     $validatedData = $request->validate([
         'category_id' => 'required|numeric',
         'name' => 'required|unique:products',    
         'min_qty' => 'required|numeric|lt:max_qty',
         'max_qty' => 'required|numeric|gt:min_qty',
         'stock' => 'required|numeric',
         'price' => 'required|numeric',
         'is_voucher' => 'integer|in:0,1', 
     ]);
     $post =  $request->except(['_token','voucher_brand_id','no_of_voucher']);  
     if ($request->hasFile('prize_image')) {
        $file = $request->file('prize_image');
        $imageName =   URL::to("/").'/images/prize_image/'.$file->getClientOriginalName();
        $upload = $file->move(public_path('images/prize_image'), $imageName);  

        $post['prize_image'] = $imageName;  
    }

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $imageName =   URL::to("/").'/images/products/'.$file->getClientOriginalName();
        $upload = $file->move(public_path('images/products'), $imageName);  

        $post['image'] = $imageName;  
    }  


    $newproduct = Product::create($post); 

    $allCount = count($request->voucher_brand_id); 

     if($allCount > 0){
        foreach ($request->voucher_brand_id as $key => $voucher_brand_id) {
          if ($request->no_of_voucher[$voucher_brand_id] !=0) {
                $voucher = ProductVoucher::firstOrNew(['voucher_brand_id'=>$voucher_brand_id,'product_id'=>$newproduct->id]); 
                $voucher->no_of_voucher = $request->no_of_voucher[$voucher_brand_id];
                $voucher->save();      

            }
         
 
        }
        
     } 

    return redirect(route('products.index'))->with('success', 'Product save successfully');   
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
      $product = Product::with(['category','country'])->where('id', $id)->first();                    
      return view('admin.products.view',compact('product')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
	 //Commission::with('subcategory')->orderBy('id', $sortby);	
       $product = Product::with('product_voucher')->where('id', $id)->first();           		
       return view('admin.products.edit',compact('product')); 
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id) {

        $product = Product::where('id',$id)->first(); 
        $validatedData = $request->validate([
         'name' => 'required|unique:products,name,'.$id, 
         'min_qty' => 'required|numeric|lt:max_qty',
         'max_qty' => 'required|numeric|gt:min_qty',
         'stock' => 'required|numeric',
         'price' => 'required|numeric',
         'is_voucher' => 'integer|in:0,1',
     ]);
        $post = $request->except(['_method','_token','voucher_brand_id','no_of_voucher']);
        if ($request->hasFile('image')) { 

               if($product->image != ''){
                    $oicArray = explode('/', $product->image);
                    $cont = count($oicArray);
                    $deletImag = $oicArray[$cont - 1];

                    if(file_exists(public_path('/images/products/'.$deletImag))){
                        unlink(public_path('/images/products/'.$deletImag)); 
                    }
                }
            
                $file = $request->file('image');  
                $imageName =   URL::to("/").'/images/products/'.$file->getClientOriginalName();
                $upload = $file->move(public_path('images/products'), $imageName); 
                $post['image'] = $imageName;     

        }

        if ($request->hasFile('prize_image')) { 

               if($product->prize_image != ''){
                    $oicArray = explode('/', $product->prize_image);
                    $cont = count($oicArray);
                    $deletImag = $oicArray[$cont - 1];

                    if(file_exists(public_path('/images/prize_image/'.$deletImag))){
                        unlink(public_path('/images/prize_image/'.$deletImag)); 
                    }
                }
            
                $file = $request->file('prize_image');  
                $imageName =   URL::to("/").'/images/prize_image/'.$file->getClientOriginalName();
                $upload = $file->move(public_path('images/prize_image'), $imageName); 
                $post['prize_image'] = $imageName;      

        }
 
        Product::where('id',$id)->update($post);  

            $allCount = count($request->voucher_brand_id); 

             if($allCount > 0){
                foreach ($request->voucher_brand_id as $key => $voucher_brand_id) {
                  if ($request->no_of_voucher[$voucher_brand_id] !=0) {
                        $voucher = ProductVoucher::firstOrNew(['voucher_brand_id'=>$voucher_brand_id,'product_id'=>$id]); 
                        $voucher->no_of_voucher = $request->no_of_voucher[$voucher_brand_id];
                        $voucher->save();    

                    } 
                 
         
                }
                
             } 
        return redirect(route('products.index'))->with('success', 'Product update successfully');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        Product::find($id)->delete();  
        return redirect(route('products.index'))->with('warning', 'Product deleted');
    } 
}
