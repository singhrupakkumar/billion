<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use URL,Session; 
use Config;
use App\Product;
use App\Category;
use App\Cart;
use App\Plan;
use App\Subscription;
 

class HomeController extends Controller

{

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    /**

     * Create a new controller instance.

     *

     * @return void

     */


    public function __construct()

    { 

    }

    public function username(){
        return 'email';
    } 

    public function customlogin(Request $request){   
      //  if(Auth::user()) return redirect()->intended(route('admin.dashboard'));

        if ($request->isMethod('post')) {
            $oldSession = Session::all()['_token'];
            $this->validate($request, [
                $this->username() => 'required', 'password' => 'required',
            ]);
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password,'type'=>'customer'])) {
                $newSession = Session::all()['_token'];
                Cart::where('session_id',$oldSession)->update(['session_id'=>$newSession,'user_id'=>Auth::id()]); 
                return redirect()->intended(route('home')); 
            }else{
                return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    $this->username() => 'Wrong Email address or password.',
                ]);
            }
        }
        return view('auth.login');
    }


    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function index(){ 



     $product = Product::orderBy('id','DESC')->get();
     $campaign = Product::with('product_voucher')->where('is_voucher',1)->orderBy('id','DESC')->get(); 
     $category = Category::with(['products'=>function($q){
        $q->where('is_voucher',1);
     },'products.product_voucher'])->orderBy('id','ASC')->get();  

     return view('home.home',compact('product','campaign','category')); 

    }

    public function plans(){ 

     $plan = Plan::orderBy('id','DESC')->get(); 

     return view('plans.plan',compact('plan')); 

    }

    public function buyPlan(Request $request){

        $plan = Plan::where('id',$request->plan_id)->first(); 
        if(!$plan)return redirect('/')->with('warning','Plan not found');
         $amt = $plan->price ;     
       $returnUrl = URL::to("/")."/shop/planSuccess?plan_id=$plan->id";  
       $ipnNotificationUrl = URL::to("/")."/shop/planipn"; 
          ///////////////////////////////////////////////payment////////////////////////////////////////////////
            echo ".<form name=\"_xclick\" action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\">
            <input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
            <input type=\"hidden\" name=\"email\" value=\"rupak-buyer@avainfotech.com\">
            <input type=\"hidden\" name=\"business\" value=\"rupak1-facilitator@avainfotech.com\">
            <input type=\"hidden\" name=\"currency_code\" value=\"USD\">
            <input type=\"hidden\" name=\"custom\" value=\"$plan->id\">
            <input type=\"hidden\" name=\"amount\" value=\"$amt\">
            <input type=\"hidden\" name=\"return\" value=\"$returnUrl\">
            <input type=\"hidden\" name=\"notify_url\" value=\"$ipnNotificationUrl\"> 
            </form>";
            echo "<script>document._xclick.submit();</script>"; 
         exit;  
    }


    public function planSuccess(Request $request){
        $plan = Plan::where('id',$request->plan_id)->first(); 
        if(!$plan)return redirect('/')->with('warning','Plan not found');
        if($request->tx){
        
            $exist = Subscription::where('user_id',Auth::id())->first();
            if(!$exist){
               Subscription::create([
                'user_id'=>Auth::id(),
                'plan_id'=>$request->plan_id,
                'plan_name'=>$plan->title,  
                'price'=>$request->amt,
                'transaction_id'=>$request->tx, 
                'expired_date'=>date("Y-m-d", strtotime("+ $plan->duration month")),
              ]);   
            }else{
               $exist = Subscription::where('user_id',Auth::id())->update([
                'plan_id'=>$request->plan_id,
                'plan_name'=>$plan->title, 
                'price'=>$request->amt,
                'transaction_id'=>$request->tx, 
                'expired_date'=>date("Y-m-d", strtotime("+ $plan->duration month")),
               ]);  
            }
          

        } 
     $paymentinfo =  $request->all();        
     
     return view('plans.success',compact('plan','paymentinfo'));
    }

    public function planipn(Request $request){ 
        print_r($request->all());
        exit;
    }

 public function apilist()

 { 

     $baseurl = URL::to("/");

     return view('apilist',compact('baseurl'));

 }



 public function payWithRazorpay()

 {        

    return view('payWithRazorpay');

}



public function razorPaySuccess(Request $Request){

    $data = [

      'user_id' => '1',

      'payment_id' => $request->payment_id,

      'amount' => $request->amount,

  ];

  $getId = Payment::insertGetId($data);  

  $arr = array('msg' => 'Payment successfully credited', 'status' => true);

  return Response()->json($arr);    

}



public function RazorThankYou()

{

    return view('rozarThankyou');

}

}

