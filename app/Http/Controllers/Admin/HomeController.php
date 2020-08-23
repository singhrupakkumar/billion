<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Auth;
use App\Config;
use App\Home;
use Validator;   
use App\HomeStep;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['logout']]);
    }

    public function index()
    {
        $all = HomeStep::get();   
        return view('admin.homesteps.list',compact('all')); 
    }

    public function add(Request $request)
    {
        if($request->isMethod('post')){

            $validatedData = Validator::make($request->all(), [  
                'step_number' => 'required', 
                'title' => 'required',
            ]);

            $validatedData = $request->validate([
                'step_number' => ['required', 'string', 'max:255','unique:home_steps'],
                'title' => ['required', 'string', 'max:255','unique:home_steps']
            ]);  
            
              $postdata =  [
                'step_number'=>$request->step_number,
                'title'=>$request->title,
                'description'=>$request->description 
            ];
            
            if ($request->hasFile('icon')) {
            
                $file = $request->file('icon');
                $imageName = time() . $file->getClientOriginalName();
                Storage::disk('s3')->put('configs/'.$imageName, file_get_contents($file), 'public');
                $url =  Storage::disk('s3')->url('configs/' . $imageName); 
                $postdata['icon'] = $url;  
            }

            if ($request->hasFile('image')) {
            
                $file = $request->file('image');
                $imageName = time() . $file->getClientOriginalName();
                Storage::disk('s3')->put('configs/'.$imageName, file_get_contents($file), 'public');
                $url =  Storage::disk('s3')->url('configs/' . $imageName); 
                $postdata['image'] = $url;   
            }

          
            $create = HomeStep::create($postdata);
            return redirect(route('admin.homesteps'))->with('success','HomeStep created successfully');
        }
        return view('admin.homesteps.add'); 
    }


    public function edit(Request $request,$id)
    {  
        $page = HomeStep::where('id',$id)->first();

        if($request->isMethod('post')){

            $validatedData = $request->validate([
                'step_number' =>  'required|max:255|unique:home_steps,step_number,'.$id,
                'title' =>  'required|max:255|unique:home_steps,title,'.$id,
            ]); 



                $postdata = [
                    'step_number'=>$request->step_number,
                    'title'=>$request->title,
                    'description'  =>  $request->description,
                ];

                if ($request->hasFile('icon')) {
                     
                    if($page->icon != ''){
                        $oicArray = explode('/',$page->icon);
                        $cont=     count($oicArray);
                        $deletImag =  $oicArray[$cont-1];
                        Storage::disk('s3')->delete('configs/'.$deletImag);
                    } 
                
                    $file = $request->file('icon');
                    $imageName = time() . $file->getClientOriginalName();
                    Storage::disk('s3')->put('configs/'.$imageName, file_get_contents($file), 'public');
                    $url =  Storage::disk('s3')->url('configs/' . $imageName); 
                    $postdata['icon'] = $url;  
                }

                if ($request->hasFile('image')) {
                     
                    if($page->image != ''){
                        $oicArray = explode('/',$page->image);
                        $cont=     count($oicArray);
                        $deletImag =  $oicArray[$cont-1];
                        Storage::disk('s3')->delete('configs/'.$deletImag);
                    } 
                
                    $file = $request->file('image');
                    $imageName = time() . $file->getClientOriginalName();
                    Storage::disk('s3')->put('configs/'.$imageName, file_get_contents($file), 'public');
                    $url =  Storage::disk('s3')->url('configs/' . $imageName); 
                    $postdata['image'] = $url;  
                } 

                HomeStep::where('id', $id)->update($postdata);
                return redirect(route('admin.homesteps'))->with('success','HomeStep updated successfully');
           
        } 
        return view('admin.homesteps.edit',compact('page'));   
    }
     
    public function delete($id){ 
        $user = HomeStep::findOrFail($id)->delete();
        return redirect(route('admin.homesteps'))->with('success','Delete homesteps successfully');
    }

    public function view($id)
    {
        $page = HomeStep::where('id',$id)->first(); 
        return view('admin.homesteps.view',compact('page')); 
    }
    
    
    public function homecontent(Request $request){  
        if($request->isMethod('post')){
            foreach($request->all() as $key => $value){
                if($request->hasFile($key)){
                    Home::updateAll($key, $value, 'file');
                }else{    
                    Home::updateAll($key, $value, 'text');
                }
            }
            return redirect(route('admin.homecontent'))->with('success', 'A content has been saved successfully.');
        }
        return view('admin.home.homecontent');        
    } 
}
