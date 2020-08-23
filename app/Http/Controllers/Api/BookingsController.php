<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Address;
use App\Booking;
use App\BookingCharge;   
use App\JobRequest;
use App\VendorArea;
use App\BookingItems;
use App\PaymentHistory; 
use App\CancellationReason;
use App\User;
use Auth;
use Validator;
use Carbon\Carbon;

class BookingsController extends Controller
{

    public function __construct()
    { 
        $this->middleware(function ($request, $next) {
        if($request->header('accessToken') == env("APP_KEY", "base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=")){
             return $next($request);
         }else{  
            return response()->json(['error'=>'Unauthorised'], 401); 
        }   
        
        });
    }




    public $successStatus = 200;  


	/**
	** Booking API
	**
	******/
    public function createOrder(Request $request)
    {  


        $user = Auth::user(); 
        $userAddress = Address::where(['user_id'=>Auth::id()])->get();
        if($userAddress->isEmpty()) return response()->json(['success'=>false,'message' =>'Please add your address first!'],$this->successStatus);
        if($request->isMethod('post')){
   
            $validator = Validator::make($request->all(),[
                'addressId' => 'required',
                'categoryId' => 'required',
                'phone' => 'required',
                'serviceDate' => 'required',
                'time_from' => 'required',
                'time_to' => 'required',  
                'subtotal' => 'required',
                'total' => 'required'
            ]); 

            if ($validator->fails()) { 
                return response()->json(['success'=>false,'message'=>$validator->messages()->first()], 400);            
            }

            if(empty($request->bookingItem)){
                return response()->json(['success'=>false,'message'=>'Booking items required'], 400);   
            }
 
            $order = new Booking;

            $order->order_number = strtoupper(substr(md5(uniqid(rand(1,99999))), 0, 8)); // uniqid genrate
            $order->address_id = $request->input('addressId');
            $order->category_id = $request->input('categoryId');
            $order->payment_currency = $request->input('payment_currency');
            $order->name = $request->input('name');
            $order->phone = $request->input('phone');
            $order->payment_mode = $request->input('payment_mode');
            $order->service_date = Carbon::parse($request->input('serviceDate'));
            $order->time_from = Carbon::parse($request->input('time_from'));
			$order->time_to = Carbon::parse($request->input('time_to'));
            $order->subtotal = $request->input('subtotal');
            $order->total = $request->input('total');
            $order->user_id = Auth::id();
            $order->save();

            $orderItem = [] ; 
                
            foreach($request->bookingItem as $key=> $item){
                $orderItem[$key]['service_id'] = $item['serviceId'];
                $orderItem[$key]['service_name'] = $item['serviceName'];
                $orderItem[$key]['price'] = $item['price'];
                $orderItem[$key]['booking_id'] = $order->id; 
				$orderItem[$key]['qty'] = $item['qty']; 
				$orderItem[$key]['category_id'] = $item['category_id'];  				
            }   
           
          //  dd($orderItem);

            if(!empty($orderItem)){
                BookingItems::insert($orderItem);  
                $bookingAddress = Address::where('id',$request->input('addressId'))->first();  
                //JobRequest 
              //  VendorArea::inviteToTechnician($bookingAddress->lat,$bookingAddress->lng,$request->input('categoryId'),$order->id); 
                 $send  = VendorArea::inviteToTechnician($bookingAddress->lat, $bookingAddress->lng, $request->input('categoryId'), $order->id);
                 
                 if($send){
                    return response()->json(['success'=>true,'message'=>'Service booked successfully','data'=>$order], $this->successStatus);   
                 }else{
                    return response()->json(['success'=>false,'message'=>'Error in send invite to vendor'], $this->successStatus);     
                 }  
               
                 
            }else{
                return response()->json(['success'=>false,'message'=>'Try again'], $this->successStatus);     
            }
        

        }  
      
       
    }


	/**
	** My Booking API
	**
	******/
    public function myBooking(Request $request){
       
        $myOrder = Booking::with('vendorBooking.technician','BookingItems','BookingItems.category','BookingItems.category.rootCategory','address','category','bookingStatus','review')->where(['user_id'=>Auth::id(),'is_deleted'=>0])->orderBy('id', 'DESC')->get();
        if($myOrder->isNotEmpty()){
                return response()->json(['success'=>true,'data' => $myOrder], $this->successStatus); 
        }else{
                return response()->json(['success'=>false,'message' => 'Booking not found'], $this->successStatus); 
        }  
   
      
    }

 
    /**
	**  Booking Cancel API
	**
	******/
    public function bookingCancel(Request $request){
        $user = Auth::user(); 

        $validator = Validator::make($request->all(),[
            'booking_id' => 'required',
            'cancel_reason' => 'required',
        ]); 

        if ($validator->fails()) { 
            return response()->json(['success'=>false,'message'=>$validator->messages()->first()], 400);            
        }
        $booking = Booking::where('id',$request->booking_id)->update(['cancel_reason'=>$request->cancel_reason,'status'=>3]);
		if($booking){       
			return response()->json(['success'=>true,'message' => 'Booking cancelled'], $this->successStatus); 
		}else{
			return response()->json(['success'=>false,'message' => 'Something wrong'], $this->successStatus); 
		}
   
      
    }


    /**
	**  Remove Booking API
	**
	******/
    public function removeBooking(Request $request){ 
        $booking = Booking::findOrFail($request->bookingId);  
        if($booking){ 

            $remove = Booking::where('id',$request->bookingId)->update(['is_deleted'=>1,'modified_by'=>Auth::id()]);    
            if($remove){
                return response()->json(['success'=>true,'message' => 'Booking move to trash'], $this->successStatus); 
            }else{
                return response()->json(['success'=>false,'message' => 'Try again'], $this->successStatus); 
            }
		
		}else{ 
			return response()->json(['success'=>false,'message' => 'Booking not found'], $this->successStatus); 
		}
      
    }


     /**
	**  Reschedule Booking API
	**
	******/
    public function bookingReschedule(Request $request){ 
     
        $booking = Booking::findOrFail($request->bookingId);
        if($booking->user_id != Auth::id())return response()->json(['success'=>false,'message'=>'You don\'t have permisssion to edit' ],400);

        $validator = Validator::make($request->all(), [ 
                'bookingId' => 'required', 
                'service_date' => 'required', 
                'time_from' => 'required', 
                'time_to' => 'required'
            ]);    
        if ($validator->fails()) {
            return response()->json(['success'=>false,'message'=>$validator->messages()->first()],400);
        }else{

            $postdata = [
                'service_date'=>$request->service_date,
                'time_from'=>$request->time_from,
                'time_to'=>$request->time_to,
            ];
          $booking->update($postdata);
          return response()->json(['success'=>true,'message'=>'Booking updated','data' => $booking], 201); 
        }

    }

    /**
	**   Booking Details API
	**
	******/
    public function bookingDetails(Request $request){  
          
        $booking = Booking::with('vendorBooking.technician','BookingItems','BookingItems.category','BookingItems.category.rootCategory','address','category.rootCategory','bookingStatus','review')->where('id',$request->bookingId)->first();
        if($booking->user_id != Auth::id())return response()->json(['success'=>false,'message'=>'You don\'t have access permisssion' ],401);  
        
        if ($booking) {    
            return response()->json(['success'=>true,'data'=>$booking],$this->successStatus);
        }else{
       
          return response()->json(['success'=>false,'message'=>'Booking not found'], $this->successStatus);   
        }

    }
      
   
    public function cancellationResaon()
    {
     

            $all = CancellationReason::where(['status'=>0,'is_deleted'=>0])->get(); 

            if($all->isNotEmpty()){
                return response()->json(['success'=>true,'data' => $all], $this->successStatus); 
            }else{
                return response()->json(['success'=>false,'message' => 'Reason not found'], $this->successStatus); 
            }
    
   

    }



       /**
	**  Save Booking Payment API
	**
	******/
    public function savePayment(Request $request){ 
     
        $booking = Booking::where('id',$request->bookingId)->first();
        if(!$booking)return response()->json(['success'=>false,'message'=>'Booking not found' ],$this->successStatus);

        $validator = Validator::make($request->all(), [ 
                'bookingId' => 'required', 
                'amount' => 'required', 
                'transaction_id' => 'required', 
                'payment_gatway' => 'required',
                'payment_method' => 'required'
            ]);    
        if ($validator->fails()) {
            return response()->json(['success'=>false,'message'=>$validator->messages()->first()],400);
        }else{
           // $input = $request->all(); 
             $input['booking_id'] = $request->bookingId;
            $input['amount'] = $request->amount;
            $input['transaction_id'] = $request->transaction_id;
            $input['payment_gatway'] = $request->payment_gatway;
            $input['payment_method'] = $request->payment_method;
            $input['offer_id'] = $request->offer_id;
            $input['promo_id'] = $request->promo_id;
            $input['user_id'] = Auth::id();
            
            $historyCreated = PaymentHistory::create($input);
            Booking::where('id',$request->bookingId)->update([
                'payment_mode'=>$request->payment_method,
                'payment_status'=>1,   
                ]);  
            if($historyCreated){  
                BookingCharge::create(['booking_id'=>$request->bookingId,'charge_type'=>'online','charge'=>$request->amount]);     
                return response()->json(['success'=>true,'message'=>'Payment Done!','data' => $historyCreated], $this->successStatus); 
            }else{
                return response()->json(['success'=>false,'message'=>'Something Wrong','data' =>''], $this->successStatus); 
            } 
       
        }

    }  
    
    


} 
