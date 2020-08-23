<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Plan;
use Log,URL; 
class PlanController extends Controller
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
               $plan = Plan::orderBy('id', $sortby);
               $plan = $plan->orWhere('title', 'LIKE', '%' . $request->searchquery . '%')
               ->orWhere('price', 'LIKE', '%' . $request->searchquery . '%')
               ->paginate(12)->setPath('');
               $pagination = $plan->appends(array(
                   'searchquery' => $request->searchquery
               ));
               if (count($plan) > 0)  
                   return view('admin.plans.list', compact('plan'))->withQuery($request->searchquery);
               return back()
               ->with('warning', 'Record not found');
           }else {
               $plan = Plan::orderBy('id', $sortby);
               $plan = $plan->paginate(12);
           }
       } catch (\Exception $e) {
           Log::info('Log Plan in', array('error' => $e));
           throw $e;
       }

       return view('admin.plans.list',compact('plan'));               
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {  

        return view('admin.plans.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

     $validatedData = $request->validate([
         'duration' => 'required|numeric',
         'title' => 'required|unique:plans',    
         'price' => 'required|numeric',
     ]);
     $post =  $request->except(['_token']);  
 
    $newproduct = Plan::create($post); 
    return redirect(route('plans.index'))->with('success', 'Plan save successfully');   
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
      $plan = Plan::where('id', $id)->first();                    
      return view('admin.plans.view',compact('plan')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
	 //Commission::with('subcategory')->orderBy('id', $sortby);	
       $plan = Plan::where('id', $id)->first();           		
       return view('admin.plans.edit',compact('plan')); 
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id) {

        $plan = Plan::where('id',$id)->first(); 
        $validatedData = $request->validate([
         'title' => 'required|unique:products,name,'.$id, 
         'price' => 'required|numeric',
         'duration' => 'required|numeric', 
     ]);
        $post = $request->except(['_method','_token']);
 
        Plan::where('id',$id)->update($post);  
 
        return redirect(route('plans.index'))->with('success', 'Plan update successfully');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        Plan::find($id)->delete();   
        return redirect(route('plans.index'))->with('warning', 'Plan deleted');
    } 
}
