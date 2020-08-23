<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => 'api','namespace' =>'Api','prefix' => 'v1'], function(){ 
Route::post('login', 'UsersController@login');
Route::post('vendor/login', 'VendorController@login');    
Route::post('register', 'UsersController@register');
Route::post('vendor/becomeApartner', 'VendorController@becomeApartner');  
Route::post('reSendOtp', 'UsersController@reSendOtp'); 

Route::post('test', 'UsersController@test'); 

/*************Config Route********************/
Route::get('/configdata', 'ConfigController@configData');
Route::post('locationByKeyword', 'ConfigController@locationByKeyword');  
Route::get('/homeData', 'ConfigController@homeData');
 
Route::post('/getFieldBykey', 'ConfigController@getFieldBykey');
Route::get('cityList', 'ConfigController@cityList');
Route::get('countryList', 'ConfigController@countryList');
Route::get('offerList', 'ConfigController@offerList');   
Route::get('getDateTimeSlot', 'ConfigController@getDateTimeSlot'); 
Route::get('getBookingStep', 'ConfigController@getBookingStep'); 

/*************Category Route********************/
Route::get('categoryList', 'CategoriesController@categoryList'); 
Route::get('categoryListMultiLevel', 'CategoriesController@categoryListMultiLevel'); 
Route::post('vendorCategoryList', 'CategoriesController@vendorCategoryList');          
Route::get('parentCategory', 'CategoriesController@parentCategory');
Route::post('parentCategoryByLocation', 'CategoriesController@parentCategoryByLocation');
Route::post('categoryByParentId', 'CategoriesController@categoryByParentId');
Route::post('categoryByParentIdWhereLocation', 'CategoriesController@categoryByParentIdWhereLocation');
Route::post('catByKeyword', 'CategoriesController@catByKeyword');
Route::post('catNameById', 'CategoriesController@catNameById');
Route::post('catById', 'CategoriesController@catById');

Route::post('specialRequest', 'CategoriesController@specialRequest');

Route::post('hotDeals', 'CategoriesController@hotDeals');
  
/*************Service Route********************/
Route::get('serviceList', 'ServiceController@serviceList'); 
Route::post('serviceByCatId', 'ServiceController@serviceByCatId');
Route::post('serviceWhereCatIds', 'ServiceController@serviceWhereCatIds');    
Route::post('serviceByKeyword', 'ServiceController@serviceByKeyword');

/*************Pages Route********************/
Route::get('faq', 'PageController@faq');         
Route::get('getPage', 'PageController@getPage');
Route::post('support', 'PageController@support');   

 
});

Route::group(['middleware' => 'myapi','namespace' =>'Api','prefix' => 'v1'], function(){
    Route::post('verifyOtp', 'UsersController@verifyOtp'); 
    Route::get('userDetails', 'UsersController@userDetails');
    Route::post('editProfile', 'UsersController@editProfile');  

    /**
     **
     **Address Route
     ****************/
    Route::post('addAddress', 'UsersController@addAddress'); 
    Route::put('editAddress', 'UsersController@editAddress');
    Route::delete('deleteAddress', 'UsersController@deleteAddress');
    Route::delete('deleteAddressByParams', 'UsersController@deleteAddressByParams');   
    Route::get('addressList', 'UsersController@addressList');

    /*********
     * Booking Route
     * 
     * **/
    Route::post('bookNow', 'BookingsController@createOrder');
    Route::get('myBooking', 'BookingsController@myBooking'); 
    Route::post('bookingCancel', 'BookingsController@bookingCancel'); 
    Route::put('bookingReschedule', 'BookingsController@bookingReschedule');  
    Route::post('removeBooking', 'BookingsController@removeBooking');
    Route::get('/cancellationResaon', 'BookingsController@cancellationResaon'); 
    Route::get('bookingDetails', 'BookingsController@bookingDetails');
    Route::post('savePayment', 'BookingsController@savePayment');  


    /*********
     * Wallet Route
     * 
     * **/
    Route::post('loadWallet', 'UsersController@loadWallet');
    Route::post('payByWallet', 'UsersController@payByWallet');     
    Route::post('addReview', 'UsersController@addReview');
    Route::get('walletDetails', 'UsersController@walletDetails');           
    /*********
     * Contact Route
     * 
     * **/
    Route::post('contactUs', 'PageController@contactUs');      


    /*********
     * Vendor Route
     * 
     * **/
    Route::group(['prefix' => 'vendor'], function () {
       // Route::post('login', 'VendorController@login');         
        Route::get('vendorDetails', 'VendorController@vendorDetails');
        Route::post('saveCategory', 'VendorController@saveCategory'); 
        Route::post('saveArea', 'VendorController@saveArea'); 
        Route::post('saveAddress', 'VendorController@saveAddress');      
        Route::get('myCategory', 'VendorController@myCategory');
        Route::get('myArea', 'VendorController@myArea');   
	Route::get('myLeads', 'VendorController@myLeads');
        Route::post('addCard', 'VendorController@addCard');
        Route::post('addBank', 'VendorController@addBank');     
        Route::delete('deleteCard', 'VendorController@deleteCard');       
        Route::post('addDocument', 'VendorController@addDocument');
        Route::post('addCertificate', 'VendorController@addCertificate');  
        Route::get('myCardList', 'VendorController@myCardList');
        Route::get('myDocumentList', 'VendorController@myDocumentList');
        Route::get('checkProfilePercentage', 'VendorController@checkProfilePercentage'); 
        Route::get('docType', 'VendorController@docType');
        Route::get('serviceLocation', 'VendorController@serviceLocation');   
        
        //job route
        Route::get('myJobs', 'VendorController@myJobs');   
        Route::post('acceptJob', 'VendorController@acceptJob');
        Route::post('startJob', 'VendorController@startJob');
        Route::post('closeJob', 'VendorController@closeJob');      
        Route::post('cancelJob', 'VendorController@cancelJob');
        Route::delete('cancelJobRequest', 'VendorController@cancelJobRequest');    
        Route::post('updateOrder', 'VendorController@updateOrder');        
        Route::get('bookingDetails', 'VendorController@bookingDetails'); 
        
        
        //payment 
        Route::get('paymentHistory', 'VendorController@paymentHistory');
        Route::post('paymentRequest', 'VendorController@paymentRequest'); 
        
        //charges
        Route::post('updateCharge', 'VendorController@updateCharge');      
        
    });     


});


