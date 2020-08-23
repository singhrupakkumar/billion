<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Auth;
use App\Config;
use Validator;
use App\Page,App\Contact;


class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['logout']]);
    }

    public function index()
    {
        $all = Page::get();   
        return view('admin.pages.list',compact('all')); 
    }

    public function add(Request $request)
    {
        if($request->isMethod('post')){

            $validatedData = Validator::make($request->all(), [  
                'name' => 'required',   
                'description' => 'required'
            ]);

            $postdata =  [
                'name'=>$request->name,
                'description'=>$request->description
            ];

            $create = Page::create($postdata);
            return redirect(route('admin.pages'))->with('success','Page created successfully');
        }
        return view('admin.pages.add'); 
    }


    public function edit(Request $request,$id)
    {  
        $page = Page::where('id',$id)->first();

        if($request->isMethod('post')){
                $postdata = [
                    'description'  =>  $request->description,
                    'name'=>$request->name
                ];
   
                Page::where('id', $id)->update($postdata);  
                return redirect(route('admin.pages'))->with('success','Page updated successfully');
           
        } 
        return view('admin.pages.edit',compact('page'));   
    }
     
    public function delete($id){ 
        $user = Page::findOrFail($id)->delete();
        return redirect(route('admin.pages'))->with('success','Delete page successfully');
    }

    public function view($id)
    {
        $page = Page::where('id',$id)->first(); 
        return view('admin.pages.view',compact('page')); 
    }

    public function contacts()
    {
        $all = Contact::get();   
        return view('admin.contacts.list',compact('all')); 
    }

    public function contactview(Request $request,$id)
    {  
        $contact = Contact::where('id',$id)->first();

        if($request->isMethod('post')){
                $postdata = [
                    'status'  => 1,
                ];
                Contact::where('id', $id)->update($postdata);
                return redirect(route('admin.contacts'))->with('success','Enquiry updated successfully');
           
        } 
        return view('admin.contacts.view',compact('contact'));   
    }
}
