<?php



namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

use Auth;

use App\User;

use App\Role;

use Illuminate\Support\Facades\Route;

use URL;  

use Log;



class UserController extends Controller

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
            $alluser = User::orderBy('id', $sortby);  
            $alluser = $alluser->orWhere('name', 'LIKE', '%' . $request->searchquery . '%')
                    ->orWhere('phone', 'LIKE', '%' . $request->searchquery . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->searchquery . '%')
                    ->orWhere('created_at', 'LIKE', '%' . $request->searchquery . '%')  
                    ->paginate(12)->setPath('');                     
            $pagination = $alluser->appends(array(
                'searchquery' => $request->searchquery
                    ));
            if (count($alluser) > 0)
                return view('admin.user.list', compact('alluser'))->withQuery($request->searchquery);
            return back()
                ->with('warning','Record not found');        
        }else{ 
         $alluser = User::where(['type'=>'customer'])->orderBy('id', $sortby); 
         $alluser = $alluser->paginate(12);    
        }
        
         
        } catch (\Exception $e) {             
            Log::info('Log message', array('error' => $e));     
            throw $e;    
        } 
    
        return view('admin.user.list',compact('alluser'));    

    }



    public function trashUsers()

    {

        try {  



        $alluser = User::where(['type'=>'customer','status'=>0,'is_deleted'=>1])->get(); 



        } catch (\Exception $e) {

            Log::info('Log message inactive user', array('error' => $e));

            throw $e;

        }



        return view('admin.user.trash',['alluser'=>$alluser]); 

    }





    public function logout(Request $request)

    { 

        Auth::guard('admin')->logout();

        return redirect()->intended(route('admin.login'));

    }



    public function profile($id)

    { 

 

        $user = User::where('id',$id)->first();

        return view('admin.user.profile',['userdata'=>$user]);  

    }



    public function changepassword(Request $request,$id)

    {  



        $user = User::where('id',$id)->first();



        if($request->isMethod('post')){

            $validatedData = $request->validate([

                'password' => 'required|min:8',

            ]); 

  



                $data = [

                    'password'  =>  isset($request->password) ? bcrypt($request->password) : $user->password

                ];

                User::where('id', $id)->update($data);

                return back()

                ->with('success','Password changed successfully');

        }  

        return view('admin.user.changepassword',['user_id'=>$id]);  

    }



    public function adduser(Request $request)

    {  

        if($request->isMethod('post')){
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => 'required',
                'password' => ['required', 'string', 'min:8', 'confirmed'], 
            ]); 

                $postdata = [ 
                    'email' => $request->email,
                    'type' => 'customer',
                    'password' => Hash::make($request->password),
                    'name'  =>  $request->name,
                    'phone'  =>  $request->phone,
                    'country'  =>  $request->country
                ]; 

                if(isset($request->profile_picture)){

                    $file = $request->file('profile_picture');

                    $imageName =   URL::to("/").'/images/users/'.time().$file->getClientOriginalName();

                    $upload = $file->move(public_path('images/users'), $imageName); 

                    $postdata['profile_picture'] = $imageName;

                }
 
                $user = User::create($postdata); 

                User::where('id',$user->id)->update(['referral_code'=>substr($user->phone,6,3).rtrim(strtr(base64_encode($user->id), '+/', '-_'), '=')]);

                return redirect(route('admin.users'))->with('success','User created successfully');  

           

        }   

        return view('admin.user.adduser');   

    }



    public function edituser(Request $request,$id)
    {  

        $user = User::where('id',$id)->first();
        if($request->isMethod('post')){

            User::EditDataValidator($request->all(), $id)->validate();

                $postdata = $request->except(['_token']); 

                if ($request->hasFile('profile_picture')) {

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

     

                User::where('id', $id)->update($postdata);

                return redirect(route('admin.users'))->with('success','Profile updated successfully');

        } 

        return view('admin.user.edituser',['userdata'=>$user]);   

    }

     

    public function deleteUser(Request $request,$id){

        if($request->type =='hard'){

             $card = User::findOrFail($id)->delete();

             return redirect(route('admin.users'))->with('error','User deleted');       

        }else{

             $user = User::where('id',$id)->update(['is_deleted'=>1,'modified_by'=>Auth::id()]);

             return redirect(route('admin.users'))->with('warning','User move to trash');   

        }

        //$user = User::find($id)->delete();

    }



    public function undoUser($id){ 

        //$user = User::find($id)->delete();

        $user = User::where('id',$id)->update(['is_deleted'=>0,'modified_by'=>Auth::id()]);

        return redirect(route('admin.users'))->with('success','Resume user successfully');

    }







}

