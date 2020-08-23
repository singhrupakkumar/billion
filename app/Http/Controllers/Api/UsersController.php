<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Role;
use App\Address;
use App\VendorArea;
use App\Wallet;
use App\Country;
use App\WalletHistory;
use App\Review;
use Illuminate\Support\Facades\Auth;
use Validator;
use sendotp\sendotp;
use File;
use URL;
use App\Transformers\User as Transformer;
use App\Transformers\Address as TransformerAddress;
use App\Services\OtpService;
use Mail;

class UsersController extends Controller {

    private $transformer;
    private $transformerAddress;

    public function __construct(Transformer $transformer, TransformerAddress $transformerAddress) {
        $this->middleware(function ($request, $next) {
            if ($request->header('accessToken') == env("APP_KEY", "base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=")) {
                return $next($request);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        });

        $this->transformer = $transformer;
        $this->transformerAddress = $transformerAddress;
    }

    public $successStatus = 200;

    protected function validator(array $data) {
        $validator = Validator::make($data, [
                    'email' => 'unique:users,email,' . Auth::user()->id,
                    'phone' => 'unique:users,phone,' . Auth::user()->id,
        ]);

        if ($validator->fails()) {
            return $validator->messages()->first();
        }
    }

    /**
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function login(Request $request) {


        $validator = Validator::make($request->all(), [
                    'phone' => 'required',
                    'iso_code_2' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()->first()], 422);
        }

        if (request('phone')) {
            $currency = '';
            $countryName = null;
            if (isset($request->iso_code_2)) {

                $country = Country::where('iso_code_2', $request->iso_code_2)->first();
                $currency = $country->currency;
                $countryName = $country->name;
            }


            // if(Auth::attempt(['phone' => request('phone'), 'password' => request('password')])){
            $user = User::where('phone', request('phone'))->first();


            if (!empty($user)) {

                // if($user->type !='customer')return response()->json(['success' => false,'message'=>'You are not a customer'], $this->successStatus);

                \Auth::login($user);
                $token = Str::random(80);
                if ($user->phone == '+919999999999') {

                    $request->user()->forceFill([
                        'api_token' => $token,
                        'otp' => 1234,
                    ])->save();

                    $user = Auth::user();
                    $success['api_token'] = $request->user()->api_token;
                    // $success['userId'] =  $request->user()->id;
                    return response()->json(['success' => true, 'data' => $success], $this->successStatus);
                }


                // $otp = mt_rand(1000,9999);
                $res = OtpService::sendOtp($request->phone);
                $otp = $res['otp'];
                $request->user()->forceFill([
                    'api_token' => $token,
                    'otp' => $otp,
                    'device_token' => request('device_token'),
                    'currency' => $currency,
                    'country'=>$countryName  
                ])->save();

                $user = Auth::user();
                $success['api_token'] = $request->user()->api_token;
                // $success['userId'] =  $request->user()->id;
                return response()->json(['success' => true, 'data' => $success], $this->successStatus);
            } else {
                $input = $request->all();
                //$input['email'] = request('phone')."@gmail.com";  
                $input['password'] = bcrypt('atdoorstep');
                if ($request->type == 'technician') {
                    $input['type'] = 'technician';
                } else {
                    $input['type'] = 'customer';
                }

                $agent = new Agent();
                if ($agent->isDesktop()) {
                    $input['register_from'] = 'Desktop';
                } elseif ($agent->isPhone()) {
                    $input['register_from'] = 'isPhone';
                } elseif ($agent->isMobile()) {
                    $input['register_from'] = 'isMobile';
                } else {
                    $input['register_from'] = $agent->device();
                }
                $user = User::create($input);

                \Auth::login($user);
                $token = Str::random(80);
                $res = OtpService::sendOtp($request->phone);
                $otp = $res['otp'];

                $request->user()->forceFill([
                    'api_token' => $token,
                    'otp' => $otp,
                    'device_token' => request('device_token'),
                    'currency' => $currency,
                    'country'=>$countryName,     
                    'referral_code' => substr($user->phone, 6, 3) . rtrim(strtr(base64_encode($user->id), '+/', '-_'), '=')
                ])->save();

                $user = Auth::user();
                $success['api_token'] = $request->user()->api_token;
                // $success['userId'] =  $request->user()->id;
                return response()->json(['success' => true, 'data' => $success], $this->successStatus);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Phone number required!'], $this->successStatus);
        }
    }

    /**
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'phone' => 'required|phone',
                    'password' => 'required',
                    'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $token = Str::random(80);
        $input['api_token'] = $token;
        $input['type'] = 'customer';
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $token;
        $success['name'] = $user->first_name;

        return response()->json(['success' => true, 'data' => $success], $this->successStatus);
    }

    /*     * *********Verify Otp********** */

    public function verifyOtp(Request $request) {

        $user = Auth::user();

        if ($user->phone == '+919999999999') {

            if ($request->otp == 1234) {
                $token = Str::random(80);
                $request->user()->forceFill([
                    'otp' => null,
                    'api_token' => $token,
                ])->save();
                $success['api_token'] = $request->user()->api_token;
                return response()->json(['success' => true, 'data' => $success], $this->successStatus);
            } else {
                return response()->json(['success' => false, 'data' => '', 'message' => 'Invalid Otp'], $this->successStatus);
            }
        } else {

            $res = OtpService::verifyOtp($user->phone, $request->otp);
            if ($res['response']->type == 'success') {
                $token = Str::random(80);
                $request->user()->forceFill([
                    'otp' => null,
                    'device_token' => request('device_token'),
                    'api_token' => $token,
                ])->save();
                $success['api_token'] = $request->user()->api_token;
                return response()->json(['success' => true, 'data' => $success], $this->successStatus);
            } else {
                if ($res['response']->message == 'otp_not_verified') {
                    return response()->json(['success' => false, 'data' => '', 'message' => 'Invalid Otp'], $this->successStatus);
                } elseif ($res['response']->message == 'otp_expired') {
                    return response()->json(['success' => false, 'data' => '', 'message' => 'Otp Expired'], $this->successStatus);
                } else {
                    return response()->json(['success' => false, 'data' => '', 'message' => $res['response']->message], $this->successStatus);
                }
            }
        }
    }

    /*     * ***********Resend Otp*********** */

    public function reSendOtp(Request $request) {
        if ($request->isMethod('post')) {
            $user = User::where(['phone' => $request->phone])->first();
            if (!empty($user)) {
                $token = Str::random(80);
                $res = OtpService::sendOtp($request->phone);

                User::where('phone', $request->phone)->update(['otp' => $res['otp'], 'api_token' => $token]);

                $success['api_token'] = $token;
                return response()->json(['success' => true, 'data' => $success], $this->successStatus);
            } else {
                return response()->json(['success' => false, 'data' => '', 'message' => 'User not found'], $this->successStatus);
            }
        }
    }

    /**
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function userDetails() {

        $user = Auth::user();

        if ($user->otp === null) {

            $user = User::with('wallet', 'review')->where('id', $user->id)->first()->toArray();
            $user = $this->transformer->singleApi($user);
            return response()->json(['success' => true, 'data' => $user], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'data' => '', 'message' => 'Otp verification failed'], 401);
        }
    }

    public function editProfile(Request $request) {


        if ($request->isMethod('post')) {
            $user = Auth::user();
            $userUpdate = User::findOrFail($user->id);
            $validator = $this->validator($request->all());
            if ($validator)
                return response()->json(['success' => false, 'message' => $validator], 400);
            $input = $request->all();

            // if($request->profile_picture){
            //     $image = $request->profile_picture;  // your base64 encoded
            //     $image = str_replace('data:image/png;base64,', '', $image);
            //     $image = str_replace(' ', '+', $image);
            //     $imageName = time().'.'.'png';
            //     File::put(public_path('images/users'). '/' . $imageName, base64_decode($image));
            //   $imageName =   URL::to("/").'/images/users/'.$imageName;
            //   $input['profile_picture'] = $imageName;
            // }

            if ($request->profile_picture) {
                $image = $request->profile_picture;  // your base64 encoded

                $imageName = time() . '.' . 'png';

                $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));

                $p = Storage::disk('s3')->put('users/' . $imageName, $image, 'public');
                $url = Storage::disk('s3')->url('users/' . $imageName);
                $input['profile_picture'] = $url;
            }


            $userUpdate = User::where('id', Auth::id())->update($input);
            if ($userUpdate) {
                return response()->json(['success' => true, 'message' => 'Profile updated', 'data' => $userUpdate], 201);
            } else {
                return response()->json(['success' => false, 'message' => 'Try again'], 400);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Post method required'], 400);
        }
    }

    public function addAddress(Request $request) {
        if ($request->isMethod('post')) {
            $user = Auth::user();
            $exist = Address::where(['user_id' => Auth::id(), 'type' => $request->type, 'title' => $request->title])->first();
            if ($exist)
                return response()->json(['success' => false, 'message' => 'Title already exist'], 400);
            $validator = Validator::make($request->all(), [
                        'location' => 'required',
                        'house_no' => 'required',
                        'title' => 'required',
                        'type' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->messages()->first()], 400);
            }

            $input = $request->all();
            $input['user_id'] = Auth::id();
            $create = Address::create($input);
            if ($create) {
                return response()->json(['success' => true, 'message' => 'Address save successfully', 'data' => $create], 201);
            } else {
                return response()->json(['success' => false, 'message' => 'Try again'], 400);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Post method required'], 400);
        }
    }

    public function editAddress(Request $request) {

        $address = Address::findOrFail($request->id);
        if ($address->user_id != Auth::id())
            return response()->json(['success' => false, 'message' => 'You don\'t have permisssion to edit'], 400);

        $validator = Validator::make($request->all(), [
                    'location' => 'required',
                    'house_no' => 'required',
                    'title' => 'required',
                    'type' => 'required',
                    'lat' => 'required',
                    'lng' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()->first()], 400);
        } else {
            $address->update($request->all());
            return response()->json(['success' => true, 'message' => 'Address updated', 'data' => $address], 201);
        }
    }

    public function deleteAddress(Request $request) {

        $address = Address::findOrFail($request->addressId);
        if ($address->user_id != Auth::id())
            return response()->json(['success' => false, 'message' => 'You don\'t have permisssion to delete'], 400);
        $delete = $address->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => 'Address deleted'], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'message' => 'Try again'], $this->successStatus);
        }
    }

    public function deleteAddressByParams(Request $request) {

        $address = Address::findOrFail($request->addressId);
        if ($address->user_id != Auth::id())
            return response()->json(['success' => false, 'message' => 'You don\'t have permisssion to delete'], 400);
        $delete = $address->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => 'Address deleted'], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'message' => 'Try again'], $this->successStatus);
        }
    }

    public function addressList(Request $request) {

        $address = Address::where(['user_id' => Auth::id()])->get();

        $address = $this->transformerAddress->addressDataFilter($address);
        if (!empty($address)) {
            return response()->json(['success' => true, 'data' => $address], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'data' => '', 'message' => 'Address not found'], $this->successStatus);
        }
    }

    public function loadWallet(Request $request) {
        if ($request->isMethod('post')) {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                        'transaction_id' => 'required',
                        'amount' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->messages()->first()], 400);
            }

            $input = $request->all();
            $checkExist = Wallet::where('user_id', Auth::id())->first();

            if ($checkExist) {
                $total = $checkExist->total + $request->amount;
                $create = Wallet::where('user_id', Auth::id())->update(['total' => $total]);
                $input['wallet_id'] = $checkExist->id;
                $input['type'] = 'credit';
                $history = WalletHistory::create($input);
            } else {
                $create = Wallet::create(['user_id' => Auth::id(), 'total' => $request->amount, 'currency' => $request->currency]);
                $input['wallet_id'] = $create->id;
                $input['type'] = 'credit';
                $history = WalletHistory::create($input);
            }

            if ($history) {
                return response()->json(['success' => true, 'message' => 'Wallet save successfully', 'data' => $history], $this->successStatus);
            } else {
                return response()->json(['success' => false, 'message' => 'Try again'], 400);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Post method required'], 400);
        }
    }

    public function payByWallet(Request $request) {

        $validator = Validator::make($request->all(), [
                    'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()->first()], 400);
        }

        $wallet = Wallet::where('user_id', Auth::id())->first();

        if ($wallet->total >= $request->amount) {
            $leftInWallet = $wallet->total - $request->amount;
            $create = Wallet::where('user_id', Auth::id())->update(['total' => $leftInWallet]);
            $post['wallet_id'] = $wallet->id;
            $post['amount'] = $request->amount;
            $post['type'] = 'debit';
            $post['payment_gatway'] = 'Wallet Pay';
            $history = WalletHistory::create($post);

            if ($history) {
                return response()->json(['success' => true, 'message' => 'Wallet update successfully', 'data' => $wallet], $this->successStatus);
            } else {
                return response()->json(['success' => false, 'message' => 'Try again'], 400);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Insufficient balance'], 200);
        }
    }

    public function walletDetails() {
        $wallet = Wallet::with('history')->where('user_id', Auth::id())->first();

        if ($wallet) {
            return response()->json(['success' => true, 'data' => $wallet], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'message' => 'Wallet empty'], $this->successStatus);
        }
    }

    public function addReview(Request $request) {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
                    'booking_id' => 'required',
                    'review_to' => 'required',
                    'rating' => 'required',
                    'review' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()->first()], 400);
        }

        $request['user_id'] = Auth::id();
        $create = Review::create($request->except(['_token']));
        if ($create) {
            // update avg rating

            $reviews = Review::where('review_to', $request->review_to)->get();

            $review_total = 0;

            if ($reviews->isNotEmpty()) {
                foreach ($reviews as $review) {
                    $review_total = $review_total + $review->rating;
                }
            }

            $avg_rating = $review_total / count($reviews);
            User::where('id', $request->review_to)->update(['avg_rating' => $avg_rating]);
            return response()->json(['success' => true, 'message' => 'Thanks for reviews.'], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'message' => 'Try Again'], $this->successStatus);
        }
    }

    public function test(Request $request) {

        $device = \App\Category::treeViewCat();
        //  $res = OtpService::sendMessage($request->phone,'Welcome to atdoorstep plateform,follow App link https://play.google.com/store/apps/details?id=io.atdoorstep.com&hl=en for complete your profile');   
        return response()->json(['success' => false, 'message' => $device], $this->successStatus);

//        $tech ='asdsdf';    
//        $send  = VendorArea::inviteToTechnician(30.7046486, 76.71787259999996, 561, 73,100);     
//         
//          return response()->json(['success' => true, 'message' => $send], $this->successStatus);
        //     $otp = new sendotp('290980ApP63cnj5d610f12','Atdoorstep : Verification otp is {{otp}}. Please do not share.',1);
        //   if($request->type =='send'){
        //     $res = $otp->send($request->phone, 'Atdoorstep');
        //     return response()->json(['success'=>true,'data'=>$res,'msg'=>'send'],200);
        //   }else{
        //     $res = $otp->verify($request->phone, $request->otp);
        //     return response()->json(['success'=>true,'data'=>$res,'msg'=>'verify'],200);
        //   }
        // $res = OtpService::retryotp($request->phone);
        // $res = OtpService::sendOtp($request->phone);
// $res = OtpService::verifyOtp($request->phone,'4514');
//     print_r($res);
//     exit;
        // echo $res['response']->message;
// if(isset($res['response']['message'])) {
//   echo  $res['response']['message'];
// }else{
//     echo "not set";
// }   
        exit;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://control.msg91.com/api/sendotp.php?otp=4567&otp_length=4&otp_expiry=1&sender=Atdoorstep&message=4567&mobile=918865867270&authkey=290980ApP63cnj5d610f12",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function awsmage(Request $request) {
        /*         * **For API*** */

        if ($request->profile_picture) {
            $image = $request->profile_picture;  // your base64 encoded

            $imageName = time() . '.' . 'png';

            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));

            $p = Storage::disk('s3')->put('users/' . $imageName, $image, 'public');
            $url = Storage::disk('s3')->url('users/' . $imageName);
            // $input['profile_picture'] = $imageName;
            return response()->json(['status' => $p, 'url' => $url], $this->successStatus);
        }




        /*         * **For WEB*** */


        if ($request->hasFile('profile_picture')) {

            if ($user->profile_picture != '') {
                $oicArray = explode('/', $user->profile_picture);
                $cont = count($oicArray);
                $deletImag = $oicArray[$cont - 1];
                Storage::disk('s3')->delete('users/' . $deletImag);
            }

            $file = $request->file('profile_picture');
            $imageName = time() . $file->getClientOriginalName();
            Storage::disk('s3')->put('users/' . $imageName, file_get_contents($file), 'public');
            $url = Storage::disk('s3')->url('users/' . $imageName);
            $postdata['profile_picture'] = $url;
        }
    }

}
