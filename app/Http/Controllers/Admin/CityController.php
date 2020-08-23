<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\City;
use App\Helper;
use URL;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['logout']]);  
    }

    public function index()
    {
      
        try {  

            $all = City::cityList(); 
    
    
        } catch (\Exception $e) {
            Log::info('Log message', array('error' => $e));
            throw $e;
        } 

        return view('admin.city.list',['all'=>$all]); 
    }

    public function add(Request $request)
    {  

        if($request->isMethod('post')){

            $validatedData = $request->validate([
                'name' => 'required|unique:city|max:255',
            ]); 


                $postdata = $request->all();
         
                City::create($postdata);
                return redirect(route('admin.cities'))->with('success','City created successfully');
           
        }  
        return view('admin.city.add');   
    } 

    public function edit(Request $request,$id)
    {  
        $id = Helper::decodeNum($id);
        $category = City::where('id',$id)->first();

        if($request->isMethod('post')){ 

            $validatedData = $request->validate([
                'name' => 'required|unique:city|max:255',
            ]); 

                $postdata = [ 
                    'name'  =>  $request->name
                ];
                $postdata = $request->all();

                City::where('id', $id)->update($postdata);
                return redirect(route('admin.cities'))->with('success','City updated successfully');
           
        } 
        return view('admin.city.edit',['data'=>$category]);   
    }
     
    public function delete($id){
        $id = Helper::decodeNum($id);
        $category = City::find($id)->delete(); 
        return redirect(route('admin.cities'))->with('success','City deleted');
    }



}
