<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Category;  
use App\Country;
use Log,URL;

class CategoryController extends Controller
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
	                $all = Category::withCount('products', 'categoryChildren')->orderBy('id', $sortby);
	                $all = $all->orWhere('name', 'LIKE', '%' . $request->searchquery . '%')
	                                ->paginate(12)->setPath(''); 
	                $pagination = $all->appends(array(
	                    'searchquery' => $request->searchquery
	                ));
	                if (count($all) > 0) 
	                    return view('admin.category.list', compact('all'))->withQuery($request->searchquery);
	                return back()
	                                ->with('warning', 'Record not found');
	            }else {
	                $all = Category::withCount('products', 'categoryChildren')->orderBy('id', $sortby);
	                $all = $all->paginate(12);
	            }
	        } catch (\Exception $e) {
	            Log::info('Log category in', array('error' => $e)); 
	            throw $e;
	        }
		
        return view('admin.category.list',compact('all'));               
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {  
        
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

           $validatedData = $request->validate([
			'name' => 'required|unique:categories',   
			]);
			$post =  $request->except(['_token']);
            $post['isSale'] = ($request->isSale)?$request->isSale:0;


            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName =   URL::to("/").'/images/categories/'.$file->getClientOriginalName();
                $upload = $file->move(public_path('images/categories'), $imageName); 
                $post['image'] = $imageName; 
            } 

            Category::create($post); 
            return redirect(route('categories.index'))->with('success', 'Category save successfully');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {      
     $category = Category::with(['products', 'categoryChildren'])->where('id', $id)->first();                    
      return view('admin.category.view',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
	 //Commission::with('subcategory')->orderBy('id', $sortby);	
     $category = Category::where('id', $id)->first();                		
      return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id) {
		
        $category = Category::where('id',$id)->first(); 
		$validatedData = $request->validate([
			'name' => 'required|unique:categories,name,'.$id,
		]);
		$post = $request->except(['_method','_token']); 
        $post['isSale'] = ($request->isSale)?$request->isSale:0;  

        if ($request->hasFile('image')) {

           if($category->image != ''){
                if(file_exists(public_path('/images/categories/'.$category->image))){
                    unlink(public_path('/images/categories/'.$category->image));
                }
            }
        
            $file = $request->file('image'); 
            $imageName =   URL::to("/").'/images/categories/'.time().$file->getClientOriginalName();
            $upload = $file->move(public_path('images/categories'), $imageName); 
            $post['image'] = $imageName;  

        }

		Category::where('id',$id)->update($post);     
		return redirect(route('categories.index'))->with('success', 'Category update successfully');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        Category::find($id)->delete();  
        return redirect(route('categories.index'))->with('warning', 'Category deleted');
    } 
}
