<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');  
Route::get('/apilist', 'HomeController@apilist')->name('apilist');
Route::any('customlogin', 'HomeController@customlogin')->name('customlogin');
 
Route::get('language/{lang}', function ($lang) {
    /**
      * whenever you change locale 
      * by passing language ISO code (like en, pl, pt-BR etc.)
      * add/update passed language to a session value with key 'locale'
      */
      Session::put('locale', $lang);

     /**
      * and now return back to a page 
      * on which you changed language
      */
      return back();
})->name('langroute'); //this is route name - for ease of using it anywhere

/*******************Pages Route********************** */
 Route::group(['prefix' => 'pages'], function () {
    Route::get('/{name}', 'PageController@index')->name('pages');
 });

 Route::group(['prefix' => 'page'], function () {
 Route::get('/howWeWork', 'PageController@howWeWork')->name('howWeWork');
 Route::any('/contact', 'PageController@contact')->name('contact');
 Route::get('/faq', 'PageController@faq')->name('faq');
});

/*******************User Route********************** */
Route::group(['prefix' => 'account'], function () {
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::any('/editprofile', 'UserController@editprofile')->name('editprofile');
    Route::any('/changepassword', 'UserController@changepassword')->name('changepassword');
    Route::get('/myOrder', 'UserController@myOrder')->name('myOrder');
    Route::get('/orderDetails/{id}', 'UserController@orderDetails')->name('orderDetails');  

}); 

Route::group(['prefix' => 'product'], function () { 
    Route::post('addToCart', 'ProductController@addToCart')->name('addToCart');
    Route::get('view/{slug}', 'ProductController@show')->name('product.view');
    Route::any('search', 'ProductController@search')->name('search');
    Route::get('cart', 'ProductController@cart')->name('cart');
    Route::get('webdisplaycart', 'ProductController@displayCart'); 
    Route::post('cartRemoveItem', 'ProductController@cartRemoveItem');  
    Route::post('cartIncreaseQty', 'ProductController@cartIncreaseQty');
    Route::post('cartDecreaseQty', 'ProductController@cartDecreaseQty');
    Route::get('ajaxData/{id}', 'ProductController@ajaxData')->name('product.ajaxData'); 
});

Route::group(['prefix' => 'plans'], function () { 
    Route::any('/', 'HomeController@plans')->name('plan'); 
});  

Route::group(['prefix' => 'category'], function () {  
    Route::get('/{name}', 'ProductController@category')->name('category'); 
});   

Route::group(['middleware' => 'auth'], function(){ 
    Route::group(['prefix' => 'shop'], function () { 
            Route::any('checkout', 'ProductController@checkout')->name('checkout');
            Route::any('payment', 'ProductController@payment')->name('payment');
            Route::any('paymentSuccess', 'ProductController@paymentSuccess');
            Route::any('ipn', 'ProductController@ipn'); 

            Route::any('buyPlan', 'HomeController@buyPlan')->name('buyPlan');
            Route::any('planSuccess', 'HomeController@planSuccess');
            Route::any('planipn', 'HomeController@planipn'); 

            Route::get('liveAuction/{slug}', 'ProductController@liveAuction')->name('liveAuction');
            Route::post('bid', 'ProductController@bidNow')->name('bidNow');    
    });    

});  


/*******************Admin Route********************** */
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () { 
    Route::any('/', 'AuthController@login')->name('admin.login'); 
    Route::get('/logout', 'UserController@logout')->name('admin.logout');
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('/users', 'UserController@index')->name('admin.users');
    Route::any('/adduser', 'UserController@adduser')->name('admin.adduser');
    Route::any('/edituser/{id}', 'UserController@edituser')->name('admin.edituser'); 
    Route::get('/deleteuser/{id}', 'UserController@deleteuser')->name('admin.deleteuser');
    Route::get('/users', 'UserController@index')->name('admin.users');
    Route::get('/profile/{id}', 'UserController@profile')->name('admin.profile');
    Route::any('/changepassword/{id}', 'UserController@changepassword')->name('admin.changepassword');
    Route::get('/changeStatus/{id}', 'UserController@changeStatus')->name('admin.changeStatus');
    Route::any('/config', 'DashboardController@config')->name('admin.config');


    /************************Country route**********************************/
    Route::get('/countries', 'CountryController@index')->name('admin.countries'); 
    Route::any('/editCountry/{id}', 'CountryController@edit')->name('admin.countryEdit');

    /************************Testimonials route**********************************/
    Route::group(['prefix' => 'testimonials'], function () { 
    Route::get('/', 'TestimonialController@index')->name('admin.testimonials'); 
    Route::any('/add', 'TestimonialController@add')->name('admin.testiAdd'); 
    Route::any('/edit/{id}', 'TestimonialController@edit')->name('admin.testiEdit');
    Route::get('/delete/{id}', 'TestimonialController@delete')->name('admin.testiDelete');
    }); 

    /************************FAQ route**********************************/
    Route::group(['prefix' => 'faqs'], function () { 
    Route::get('/', 'FaqController@index')->name('admin.faqs'); 
    Route::any('/add', 'FaqController@add')->name('admin.faqAdd'); 
    Route::any('/edit/{id}', 'FaqController@edit')->name('admin.faqEdit');
    Route::get('/delete/{id}', 'FaqController@delete')->name('admin.faqDelete'); 
    }); 
    
    
    /************************Pages route**********************************/
    Route::group(['prefix' => 'pages'], function () { 
        Route::get('/', 'PageController@index')->name('admin.pages'); 
        Route::any('/add', 'PageController@add')->name('pages.add'); 
        Route::any('/edit/{id}', 'PageController@edit')->name('pages.edit');
        Route::get('/view/{id}', 'PageController@view')->name('pages.view');
        Route::get('/delete/{id}', 'PageController@delete')->name('pages.delete'); 
    }); 

    /************************Need help route**********************************/
    Route::group(['prefix' => 'contacts'], function () { 
        Route::get('/', 'PageController@contacts')->name('admin.contacts'); 
        Route::any('/view/{id}', 'PageController@contactview')->name('contacts.view');
    }); 
    

    /************************Orders route**********************************/
    Route::group(['prefix' => 'orders'], function () { 
        Route::get('/list', 'OrderController@index')->name('neworders');  
        Route::any('/view/{id}', 'OrderController@show')->name('orders.view');
    }); 

    Route::resource('products', 'ProductController', ['names' => 'products']);
    Route::resource('vouchers', 'VoucherController', ['names' => 'vouchers']);
    Route::resource('categories', 'CategoryController', ['names' => 'categories']); 
    //Order Route
    Route::resource('orders', 'OrderController', ['names' => 'orders']);
    Route::resource('plans', 'PlanController', ['names' => 'plans']);          


}); 