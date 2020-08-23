<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\VoucherBrand;  
use App\Voucher;
use App\Country;
use Log,URL;

class VoucherController extends Controller
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
	                $all = VoucherBrand::withCount('voucher')->orderBy('id', $sortby);
	                $all = $all->orWhere('name', 'LIKE', '%' . $request->searchquery . '%')
	                                ->paginate(12)->setPath(''); 
	                $pagination = $all->appends(array(
	                    'searchquery' => $request->searchquery
	                ));
	                if (count($all) > 0) 
	                    return view('admin.voucher.list', compact('all'))->withQuery($request->searchquery);
	                return back()
	                                ->with('warning', 'Record not found');
	            }else {
	                $all = VoucherBrand::withCount('voucher')->orderBy('id', $sortby);
	                $all = $all->paginate(12); 
	            }
	        } catch (\Exception $e) {
	            Log::info('Log voucher in', array('error' => $e));  
	            throw $e;
	        }
		
        return view('admin.voucher.list',compact('all'));               
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {  
        
        return view('admin.voucher.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

           $validatedData = $request->validate([
			'name' => 'required|unique:voucher_brands',
            'no_of_voucher' => 'required|integer',   
			]);
			$post =  $request->except(['_token','no_of_voucher']); 

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName =   URL::to("/").'/images/vouchers/'.$file->getClientOriginalName();
                $upload = $file->move(public_path('images/vouchers'), $imageName); 
                $post['image'] = $imageName; 
            }

            $create = VoucherBrand::create($post); 
            $voucherCode = [] ;
            $date = \Carbon\Carbon::now()->toDateTimeString();   
            for ($k = 0 ; $k < $request->no_of_voucher; $k++) 
            {
             $voucherCode[$k]['brand_id'] =  $create->id;    
             $voucherCode[$k]['code'] = strtoupper(substr(md5(uniqid(rand(1, 99999))), 0, 6));
             $voucherCode[$k]['created_at'] = $date;    
             $voucherCode[$k]['updated_at'] = $date;  
            }
            
            Voucher::insert($voucherCode);
            return redirect(route('vouchers.index'))->with('success', 'Voucher Brand save successfully');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {      
     $voucher = VoucherBrand::with(['voucher'])->where('id', $id)->first();                    
      return view('admin.voucher.view',compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
     $voucher = VoucherBrand::where('id', $id)->first();                		
      return view('admin.voucher.edit',compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id) {
		
        $category = VoucherBrand::where('id',$id)->first(); 
		$validatedData = $request->validate([
			'name' => 'required|unique:voucher_brands,name,'.$id,
		]);
		$post = $request->except(['_method','_token']); 
        if ($request->hasFile('image')) {

           if($category->image != ''){
                if(file_exists(public_path('/images/vouchers/'.$category->image))){
                    unlink(public_path('/images/vouchers/'.$category->image));
                }
            }
        
            $file = $request->file('image'); 
            $imageName =   URL::to("/").'/images/vouchers/'.time().$file->getClientOriginalName();
            $upload = $file->move(public_path('images/vouchers'), $imageName); 
            $post['image'] = $imageName;  

        }

		VoucherBrand::where('id',$id)->update($post);     
		return redirect(route('vouchers.index'))->with('success', 'Voucher Brand update successfully');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        VoucherBrand::find($id)->delete();    
        return redirect(route('vouchers.index'))->with('warning', 'Voucher Brand deleted'); 
    } 
}
