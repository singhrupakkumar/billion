<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;
use App\Contact;
use App\Faq;
use Mail;

class PageController extends Controller
{

    public function index($name)
    {
    
        $page = Page::where('slug', $name)->first();
        if($page){
            return view('page.view',['page'=>$page]);
        }else{
            return redirect(route('home'))->with('error','Page not found');
        }
          
    }

     public function faq(Request $request)
    {
        $faq =  Faq::get(); 
        return view('page.faq',compact('faq')); 
    } 

     public function contact(Request $request)
    {

        if($request->isMethod('post')){

            $validatedData = $request->validate([  
                'first_name' => 'required', 
                'email' => 'required',
                'message' => 'required'
            ]);


         $requestdata =   $request->all();
         $postdata = [
            'name'=>$request->first_name. ' '.$request->last_name, 
            'email'=>$request->email,
            'message'=>$request->message,  
         ];
        Mail::send('emails.contactUs', ['requestdata' =>$requestdata], function ($m) use ($requestdata) {
            $m->from('replytorupak@gmail.com', 'Billionaire');
            $m->to('replytorupak@gmail.com',$requestdata['first_name'])->subject('Contact Us');
        });

        Mail::send('emails.contactUsconfirmation', ['requestdata' =>$requestdata], function ($m) use ($requestdata) {
            $m->from('replytorupak@gmail.com', 'Billionaire'); 
            $m->to($requestdata['email'],$requestdata['first_name'])->subject('Contact Us');
        }); 
        
        Contact::create( $postdata);           
 
        return back()
        ->with('success','Thank you for contacting us! We will get back to you shortly.');  

        }
        return view('page.contact'); 
    }
}
