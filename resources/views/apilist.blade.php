<?php

	$baseurl = $baseurl.'/api/v1/';  
	$indexInfo['description'] = "Login (Post method)";
	$indexInfo['url'] = $baseurl. "login";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=,";
	$indexInfo['parameters'] = "phone:8865867270,device_token:dfdsafdfdsf, iso_code_2:IN/AE, type:technician(only for technician app)"; 
	$indexarr[] = $indexInfo;  
  	  
	 
	$indexInfo['description'] = "Verify Otp (Post method)";
	$indexInfo['url'] = $baseurl. "verifyOtp";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=,Accept : application/json, Authorization:Bearer api_token";
	$indexInfo['parameters'] = "otp:2353,device_token:sadsad";
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Resend Otp (Post method)";
	$indexInfo['url'] = $baseurl. "reSendOtp";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=,Accept : application/json";
	$indexInfo['parameters'] = "phone:8865867270";
	$indexarr[] = $indexInfo;
	
	
	$indexInfo['description'] = "User Details (Get method)";
	$indexInfo['url'] = $baseurl. "userDetails";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo; 
	
	$indexInfo['description'] = "Edit Profile (Post method)";
	$indexInfo['url'] = $baseurl. "editProfile";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "name:Atdoorstep ,about_me:weff,  only For Vendor(dob,parent_name,gender)"; 
	$indexarr[] = $indexInfo; 


	$indexInfo['description'] = "All Category list (Get method)";
	$indexInfo['url'] = $baseurl. "categoryList";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo; 
        
        $indexInfo['description'] = "All Category list with child (Get method)";
	$indexInfo['url'] = $baseurl. "categoryListMultiLevel";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo; 
	
        
        $indexInfo['description'] = "All Category By Location (POST method)";
	$indexInfo['url'] = $baseurl. "vendorCategoryList";           
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "city_ids:1,2,3";
	$indexarr[] = $indexInfo;     
        
	$indexInfo['description'] = "Parent Category list (Get method)";
	$indexInfo['url'] = $baseurl. "parentCategory";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo; 

	$indexInfo['description'] = "Category By ParentId (Post method)";
	$indexInfo['url'] = $baseurl. "categoryByParentId";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "parentId:1";
	$indexarr[] = $indexInfo;


	$indexInfo['description'] = "Parent Category list where location (Post method)";
	$indexInfo['url'] = $baseurl. "parentCategoryByLocation";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "lat:434353, lng:23235";
	$indexarr[] = $indexInfo; 

	$indexInfo['description'] = "Category By ParentId where location (Post method)";
	$indexInfo['url'] = $baseurl. "categoryByParentIdWhereLocation";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "lat:434353, lng:23235, parentId:1";
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Category By keyword (Post method)";
	$indexInfo['url'] = $baseurl. "catByKeyword";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "keyword:abc"; 
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Category name by Id (Post method)";
	$indexInfo['url'] = $baseurl. "catNameById";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "catId:1"; 
	$indexarr[] = $indexInfo;


	$indexInfo['description'] = "Category details (Post method)";
	$indexInfo['url'] = $baseurl. "catById";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "catId:1"; 
	$indexarr[] = $indexInfo;



	$indexInfo['description'] = "City list (Get method)";
	$indexInfo['url'] = $baseurl. "cityList";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo;
        
        $indexInfo['description'] = "Location By Keyword (Post method)";
	$indexInfo['url'] = $baseurl. "locationByKeyword";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "keyword:mohali"; 
	$indexarr[] = $indexInfo;     


	$indexInfo['description'] = "Country list (Get method)";
	$indexInfo['url'] = $baseurl. "countryList";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = ""; 
	$indexarr[] = $indexInfo;	


	$indexInfo['description'] = "All Service list (Get method)";
	$indexInfo['url'] = $baseurl. "serviceList";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo;	

	
	$indexInfo['description'] = "Service By Category Id (Post method)";
	$indexInfo['url'] = $baseurl. "serviceByCatId";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "catId:1,lat:67.6243,lng:45.474";
	$indexarr[] = $indexInfo;   
        
        $indexInfo['description'] = "Service By Multiple Category Id (Post method)";
	$indexInfo['url'] = $baseurl. "serviceWhereCatIds";  
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "catIds:[1,3,6],lat:67.6243,lng:45.474";
	$indexarr[] = $indexInfo;  

	$indexInfo['description'] = "Service By keyword (Post method)";
	$indexInfo['url'] = $baseurl. "serviceByKeyword";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "keyword:abc,lat:67.6243,lng:45.474";
	$indexarr[] = $indexInfo; 


	$indexInfo['description'] = "Config list (Get method)";
	$indexInfo['url'] = $baseurl. "configdata";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo;
        
        $indexInfo['description'] = "Home Content (Get method)";
	$indexInfo['url'] = $baseurl. "homeData";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "";  
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Get config Field By key (Post method)";
	$indexInfo['url'] = $baseurl. "getFieldBykey";
	$indexInfo['header'] = "Content-Type:application/x-wwwg-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "key:abc";
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Offer list (Get method)";
	$indexInfo['url'] = $baseurl. "offerList";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo;


	$indexInfo['description'] = "Add Address (Post method)";
	$indexInfo['url'] = $baseurl. "addAddress";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "location:It Park Chandigarh, lat:30.7333, lng:76.7794, house_no:348, title:Office1, type:Office , Next paramenter Only for Vendor(location,house_no,type,title,city,state,pin_code)";
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Edit Address (PUT method)";
	$indexInfo['url'] = $baseurl. "editAddress";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "id:1, location:sdfsfd, house_no:dfsf, title:dds, type:sdf, lat:355466, lng:44556 , Next paramenter Only for Vendor(location,house_no,type,title,city,state,pin_code)";
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Delete Address (DELETE method)";
	$indexInfo['url'] = $baseurl. "deleteAddress";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "addressId:1";
	$indexarr[] = $indexInfo; 
        
        $indexInfo['description'] = "Delete Address By Params(DELETE method)";
	$indexInfo['url'] = $baseurl. "deleteAddressByParams?addressId:1";  
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "addressId:1";
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Address list (Get method)";
	$indexInfo['url'] = $baseurl. "addressList";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Hot deals (Post method)";
	$indexInfo['url'] = $baseurl. "hotDeals";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "lat:434353, lng:23235";
	$indexarr[] = $indexInfo;


	$indexInfo['description'] = "Booking (Post method)";
	$indexInfo['url'] = $baseurl. "bookNow";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "phone:8865867270, addressId:1, payment_currency:$,categoryId:1, name:rupak, serviceDate:2019-01-01, time_from:9:00,time_to:9:30,subtotal:28,total:28, payment_mode:cash/online,bookingItem[0][serviceId]:1
bookingItem[0][serviceName]:repaire,bookingItem[0][price]:28,bookingItem[0][qty]:3,bookingItem[0][category_id]:3";
	$indexarr[] = $indexInfo;      

	$indexInfo['description'] = "My Booking (Get method)";
	$indexInfo['url'] = $baseurl. "myBooking";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo;   

	$indexInfo['description'] = "Booking Cancel (Post method)";
	$indexInfo['url'] = $baseurl. "bookingCancel";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "booking_id:3, cancel_reason:dfsf";
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Remove Booking (Post method)";
	$indexInfo['url'] = $baseurl. "removeBooking";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "bookingId:3";
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Booking Reschedule (PUT method)";
	$indexInfo['url'] = $baseurl. "bookingReschedule";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "bookingId:3, service_date:date, time_from:time, time_to:time"; 
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Booking Cancellation Resaon (GET method)";
	$indexInfo['url'] = $baseurl. "cancellationResaon";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo; 

	$indexInfo['description'] = "Booking Details (GET method)";
	$indexInfo['url'] = $baseurl. "bookingDetails?bookingId=2";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo; 


	$indexInfo['description'] = "Save Payment (Post method)";
	$indexInfo['url'] = $baseurl. "savePayment";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "bookingId:3,amount:23, transaction_id: sdasdaf, payment_gatway:xyz, payment_method:card /netbanking/upi";
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Get DateTime Slot (Get method)";
	$indexInfo['url'] = $baseurl. "getDateTimeSlot";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Page by slug (Get method)";
	$indexInfo['url'] = $baseurl. "getPage?slug=termofuse/privacypolicy/refund-policy/about/disclaimer/how-it-works/career/why-join-atdoorstep";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "FAQ (Get method)"; 
	$indexInfo['url'] = $baseurl. "faq";  
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo;
        
    $indexInfo['description'] = "Home Page Booking Step (Get method)";
	$indexInfo['url'] = $baseurl. "getBookingStep";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "";
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Contact Us (Post method)";
	$indexInfo['url'] = $baseurl. "contactUs";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "phone:8865867270,booking_id:1 ,email:rks@gmail.com, name:rks, subject:casdfs, message:sdfsdfsdfsfsdfsdfs";
	$indexarr[] = $indexInfo;  
	
	$indexInfo['description'] = "Support(Post method)";
	$indexInfo['url'] = $baseurl. "support";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "phone:8865867270, email:rks@gmail.com, name:rks, subject:casdfs, message:sdfsdfsdfsfsdfsdfs";
	$indexarr[] = $indexInfo;

	$indexInfo['description'] = "Add Money in wallet (Post method)";
	$indexInfo['url'] = $baseurl. "loadWallet";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "transaction_id:sdf, amount:23, payment_gatway:dsdfsf, receipt:any details";
	$indexarr[] = $indexInfo;
        
        $indexInfo['description'] = "Pay by wallet (Post method)";
	$indexInfo['url'] = $baseurl. "payByWallet";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "amount:23,receipt:any details or remarks";      
	$indexarr[] = $indexInfo;
        
        $indexInfo['description'] = "My Wallet Details(GET method)";
	$indexInfo['url'] = $baseurl. "walletDetails";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "";           
	$indexarr[] = $indexInfo;  

	$indexInfo['description'] = "Add Review (Post method)";
	$indexInfo['url'] = $baseurl. "addReview";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "review_to:2, booking_id:4, rating:5, review:fasdfdgdfgfd";
	$indexarr[] = $indexInfo;
	
	
	$indexInfo['description'] = "Special Service Request (Post method)";
	$indexInfo['url'] = $baseurl. "specialRequest";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json";
	$indexInfo['parameters'] = "name:dfsd, email:4, phone:54344343, location: fasdfdgdfgfd,looking_for: service name ,description: short description, budget: 348";
	$indexarr[] = $indexInfo;




        $indexInfo['description'] = "Vendor Login (Post method)";  
	$indexInfo['url'] = $baseurl. "vendor/login";  
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=,";
	$indexInfo['parameters'] = "phone:8865867270,device_token:dfdsafdfdsf,iso_code_2:IN/AE";
	$indexVendor[] = $indexInfo;          

        $indexInfo['description'] = "Become A partner (Post method)";  
	$indexInfo['url'] = $baseurl. "vendor/becomeApartner";  
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=,";
	$indexInfo['parameters'] = "phone:8865867270";
	$indexVendor[] = $indexInfo;      
        
        $indexInfo['description'] = "Vendor Details (Get method)";
	$indexInfo['url'] = $baseurl. "vendor/userDetails";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "";
	$indexVendor[] = $indexInfo; 

	$indexInfo['description'] = "Save Category (POST method)";
	$indexInfo['url'] = $baseurl. "vendor/saveCategory";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "category_ids[0]:1, category_ids[1]:3,category_ids[2]:4, category_ids[3]:5";
	$indexVendor[] = $indexInfo;
        
        
        $indexInfo['description'] = "Save Address (Post method)";    
	$indexInfo['url'] = $baseurl. "vendor/saveAddress";  
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "location:It Park Chandigarh, lat:30.7333, lng:76.7794, house_no:348, title:Office1, type:Office , Next paramenter Only for Vendor(location,house_no,type,title,city,state,pin_code)";
	$indexVendor[] = $indexInfo;    
        
        
        $indexInfo['description'] = "Save Service Area (POST method)";
	$indexInfo['url'] = $baseurl. "vendor/saveArea";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "area_ids[0]:1, area_ids[1]:3,area_ids[2]:4, area_ids[3]:5";
	$indexVendor[] = $indexInfo;   

	$indexInfo['description'] = "Add Card (POST method)";
	$indexInfo['url'] = $baseurl. "vendor/addCard";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "name,card_number,exp_month,exp_year";
	$indexVendor[] = $indexInfo; 
        
        $indexInfo['description'] = "Add Bank Account (POST method)";
	$indexInfo['url'] = $baseurl. "vendor/addBank";  
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "bank_name,acc_number,ifsc_or_swift,details";  
	$indexVendor[] = $indexInfo;  
        
        $indexInfo['description'] = "Delete Card (POST method)";
	$indexInfo['url'] = $baseurl. "vendor/deleteCard";  
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "card_id:4";
	$indexVendor[] = $indexInfo;     

	$indexInfo['description'] = "My Card List (GET method)";
	$indexInfo['url'] = $baseurl. "vendor/myCardList";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = ""; 
	$indexVendor[] = $indexInfo;


	$indexInfo['description'] = "Add Document (POST method)";
	$indexInfo['url'] = $baseurl. "vendor/addDocument";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "type,name,file,document_number,company_name(if trade lic is selected),name(if emirates id or pasport is selected)";
	$indexVendor[] = $indexInfo; 
        
        $indexInfo['description'] = "Add Certificate (POST method)";
	$indexInfo['url'] = $baseurl. "vendor/addCertificate";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "file";
	$indexVendor[] = $indexInfo;  

	$indexInfo['description'] = "My Document List (GET method)";
	$indexInfo['url'] = $baseurl. "vendor/myDocumentList";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = ""; 
	$indexVendor[] = $indexInfo;


	$indexInfo['description'] = "My Service Category (GET method)";
	$indexInfo['url'] = $baseurl. "vendor/myCategory";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "";
	$indexVendor[] = $indexInfo; 
        
        $indexInfo['description'] = "My Service Area (GET method)";
	$indexInfo['url'] = $baseurl. "vendor/myArea"; 
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "";
	$indexVendor[] = $indexInfo;

	$indexInfo['description'] = "Check Profile Percentage (GET method)";
	$indexInfo['url'] = $baseurl. "vendor/checkProfilePercentage";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "";
	$indexVendor[] = $indexInfo;

	$indexInfo['description'] = "Document Type (GET method)";
	$indexInfo['url'] = $baseurl. "vendor/docType";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = ""; 
	$indexVendor[] = $indexInfo;
        
        $indexInfo['description'] = "Vendor Service Location (GET method)";
	$indexInfo['url'] = $baseurl. "vendor/serviceLocation";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = ""; 
	$indexVendor[] = $indexInfo;  
	
	
	$indexInfo['description'] = "My Leads (GET method)";
	$indexInfo['url'] = $baseurl. "vendor/myLeads";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = ""; 
	$indexVendor[] = $indexInfo;
        
        $indexInfo['description'] = "My jobs (GET method)";
	$indexInfo['url'] = $baseurl. "vendor/myJobs";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = ""; 
	$indexVendor[] = $indexInfo;  
        
        $indexInfo['description'] = "Job Details (GET method)";
	$indexInfo['url'] = $baseurl. "vendor/bookingDetails?bookingId=2"; 
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = ""; 
	$indexVendor[] = $indexInfo; 
        
        $indexInfo['description'] = "Accept Job (POST method)";
	$indexInfo['url'] = $baseurl. "vendor/acceptJob";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "booking_id:4";
	$indexVendor[] = $indexInfo;
        
        $indexInfo['description'] = "Start Job (POST method)";
	$indexInfo['url'] = $baseurl. "vendor/startJob";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "booking_id:4";
	$indexVendor[] = $indexInfo;
        
        $indexInfo['description'] = "Close Job (POST method)";
	$indexInfo['url'] = $baseurl. "vendor/closeJob";
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "booking_id:4,service_otp:2345";  
	$indexVendor[] = $indexInfo;
        
        $indexInfo['description'] = "Cancel Job (POST method)";
	$indexInfo['url'] = $baseurl. "vendor/cancelJob";  
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "booking_id:4";
	$indexVendor[] = $indexInfo;
        
        $indexInfo['description'] = "Cancel Job Lead (DELETE method)";
	$indexInfo['url'] = $baseurl. "vendor/cancelJobRequest";    
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "booking_id:4";    
	$indexVendor[] = $indexInfo;
        
        $indexInfo['description'] = "Update Booking(Add new Item) (POST method)";       
	$indexInfo['url'] = $baseurl. "vendor/updateOrder";    
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "booking_id:4,bookingItem[0][serviceId]:1 bookingItem[0][serviceName]:repaire,bookingItem[0][price]:28,bookingItem[0][qty]:3,bookingItem[0][category_id]:3";
	$indexVendor[] = $indexInfo;
        
        $indexInfo['description'] = "Update Booking Charges(Add new charge) (POST method)";       
	$indexInfo['url'] = $baseurl. "vendor/updateCharge";    
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "booking_id:4, charge_type:cash/online, old_charge:cash/online, charge:23.00";
	$indexVendor[] = $indexInfo;              
        
        $indexInfo['description'] = "Payment History (GET method)";
	$indexInfo['url'] = $baseurl. "vendor/paymentHistory";     
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = ""; 
	$indexVendor[] = $indexInfo; 
        
        $indexInfo['description'] = "Payment Redeem Request(POST method)";       
	$indexInfo['url'] = $baseurl. "vendor/paymentRequest";      
	$indexInfo['header'] = "Content-Type:application/x-www-form-urlencoded, accessToken:base64:mcP33ANGzmG5F7LmzUoXICw/Fkje0yCuiGJkw+xCp+Q=, Accept : application/json,Authorization:Bearer api_token";
	$indexInfo['parameters'] = "acc_id:2, amount:23.00";                
	$indexVendor[] = $indexInfo;     

	

?>

	<h2>Api Get format</h2><br/>

	@foreach($indexarr as $key=>$val) 

		   
		<h2>[{{$key+1}}] {{$val['description']}}</h2>
		<p>Url: {{$val['url']}}</p>
		<p>Header: {{$val['header']}}</p>
		<p>Parameters: {{$val['parameters']}}</p>
		<hr/>
	@endforeach


	<h2>Vendor Api</h2><br/>

	@foreach($indexVendor as $key=>$val)


		
		<h2>[{{$key+1}}] {{$val['description']}}</h2>
		<p>Url: {{$val['url']}}</p>
		<p>Header: {{$val['header']}}</p>
		<p>Parameters: {{$val['parameters']}}</p>
		<hr/>
	@endforeach
