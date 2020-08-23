<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\UserCards;
use App\Address;
use App\Order;

use DB;
use URL; 

class UserController extends Controller
{
    public $distance = 10;    
    public function __construct()
    {
        $this->middleware('auth');
         
    }

    public function profile(Request $request)
    {
    
        return view('user.profile'); 
    }

    public function cardList(Request $request)
    {
    
        return view('user.cardlist'); 
    }
    public function editprofile(Request $request)
    {

        $user = User::where('id', Auth::id())->first();
        if($request->isMethod('post')){


            User::EditDataValidator($request->all(), Auth::id())->validate();
            
                $postdata = [
                    'email' => $request->email,
                    'first_name'  =>  $request->first_name,
                    'last_name'  =>  $request->last_name,
                    'phone'  =>  $request->phone
                ];

                if(isset($request->profile_picture)){
                    if($user->profile_picture != ''){
                        if(file_exists(public_path('/images/users/'.$user->profile_picture))){
                            unlink(public_path('/images/users/'.$user->profile_picture));
                        }
                    }
                
                    $file = $request->file('profile_picture');
                    $imageName =   URL::to("/").'/images/users/'.time().$file->getClientOriginalName();
                    $upload = $file->move(public_path('images/users'), $imageName); 
                    $postdata['profile_picture'] = $imageName;
                }

                User::where('id', Auth::id())->update($postdata);
                return redirect(route('profile'))->with('success','Profile updated successfully');
           
        }
        return view('user.editprofile'); 
    }


    public function changepassword(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        if($request->isMethod('post')){
            $validatedData = $request->validate([
                'oldpassword' => 'required',
                'newpassword' => 'required|min:8',
                'confirmpassword' => 'required|same:newpassword',
            ]); 

            if(!Hash::check($request->oldpassword, $user->password)){ 
                return back()
                            ->with('error','Incorrect old password');
            }else{  

                $data = [
                    'password'  =>  isset($request->newpassword) ? bcrypt($request->newpassword) : $user->password
                ];
                User::where('id', Auth::id())->update($data);
                return redirect(route('profile'))->with('success','Password changed successfully');

            }

        }    
        return view('user.changepassword'); 
    }


    public function addCard(Request $request)
    {
        $card = UserCards::where('user_id', Auth::id())->first();

        if($request->isMethod('post')){
        $validatedData = $request->validate([
            'card_number' => 'required|min:16',
            'expired_month' => 'required',
            'expired_year' => 'required',
            'card_holder'=> 'required'
        ]);   

        if(empty($card)){
            $request['user_id'] = Auth::id();
            $create = UserCards::create($request->except(['_token']));
            if($create){ 
                return redirect(route('profile'))->with('success','Card added successfully');
            }else{
                return back()->with('error','Something Wrong!');
            }
        }else{

            $update = UserCards::where('user_id', Auth::id())->update($request->except(['_token']));

            if($update){
                return redirect(route('profile'))->with('success','Card updated successfully');
            }else{
                return back()->with('error','Error in updating card');
            }

        }
   
        
        }
        return view('user.addcard', ['card' => $card]);  
    }    


    public function manageAddress(Request $request)
    {
        $homeAddress = Address::where(['user_id'=>Auth::id(),'type'=>'home'])->first();
        $giftsAddress = Address::where(['user_id'=>Auth::id(),'type'=>'gifts'])->first();
        $othersAddress = Address::where(['user_id'=>Auth::id(),'type'=>'others'])->first();

        if($request->isMethod('post')){
        $validatedData = $request->validate([
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required'
        ]);    

        if($request->tab == 'home'){
            if(empty($homeAddress)){
                $request['user_id'] = Auth::id();
                $create = Address::create($request->except(['_token']));
                if($create){ 
                    return back()->with('success','Updated successfully');
                   
                }else{
                    return back()->with('error','Something Wrong!');
                }
            }else{
                $updateData = [
                    'address'=>$request->address,
                    'country'=>$request->country,
                    'city'=>$request->city,
                    'zip'=>$request->zip,
                ];
                
                $update = Address::where(['user_id'=>Auth::id(),'type'=>'home'])->update($updateData);
    
                if($update){
                    return back()->with('success','Updated successfully');
                }else{
                    return back()->with('error','Error in updating card');
                }
    
            }
       

        }elseif($request->tab == 'gifts'){
            if(empty($giftsAddress)){

                $request['user_id'] = Auth::id();
                $create = Address::create($request->except(['_token']));
                if($create){ 
                    return back()->with('success','Updated successfully');
                   
                }else{
                    return back()->with('error','Something Wrong!');
                }
            }else{
                $updateData = [
                    'address'=>$request->address,
                    'country'=>$request->country,
                    'city'=>$request->city,
                    'zip'=>$request->zip,
                ];
                
                $update = Address::where(['user_id'=>Auth::id(),'type'=>'gifts'])->update($updateData);
    
                if($update){
                    return back()->with('success','Updated successfully');
                }else{
                    return back()->with('error','Error in updating card');
                }
    
            }
       

        }else{
            if(empty($othersAddress)){
                $request['user_id'] = Auth::id();
                $create = Address::create($request->except(['_token']));
                if($create){ 
                    return back()->with('success','Updated successfully');
                   
                }else{
                    return back()->with('error','Something Wrong!');
                }
            }else{
                $updateData = [
                    'address'=>$request->address,
                    'country'=>$request->country,
                    'city'=>$request->city,
                    'zip'=>$request->zip,
                ];
                
                $update = Address::where(['user_id'=>Auth::id(),'type'=>'others'])->update($updateData);
    
                if($update){
                    return back()->with('success','Updated successfully');
                }else{
                    return back()->with('error','Error in updating card');
                }
    
            }
       

        }

        
        }
        return view('user.manageAddress', compact('homeAddress','giftsAddress','othersAddress'));  
    }

    
    public function myOrder(Request $request){  
        $order = Order::with(['orderStatus'])->where('user_id',Auth::id())->orderBy('id','DESC')->paginate(12);
        return view('user.orderlist',compact('order'));  
    }

    public function orderDetails($id){  
        $order_id = base64_decode($id); 
        $order = Order::with(['orderStatus','orderItem','payments'])->where('id',$order_id)->first();
        return view('user.orderDetails',compact('order'));  
    }


}
