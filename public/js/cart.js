jQuery(document).ready(function () {
  $.getJSON(BaseUrl+"/product/webdisplaycart", function (data) {
    jQuery('#cartcount').html(data['data']['cartInfo']['quantity']);
    var myvar = '';
    if (data['data']['cartInfo']['quantity'] == "0") {
      myvar += '<img  class="empty-cart-image" src="'+BaseUrl+'/images/empty-cart-icon-1.jpg" alt="img" />';
    } else {
      myvar =   '<div class="col-md-8">  ';

        $.each(data['data']['items'], function (index, value) {    
              var str = value.product.description;
  myvar +='        <div class="cart_item_list">  '  + 
 '                 <div class="cartitem_add">  '  + 
 '                   <div class="cart_box">  '  + 
 '                     <div class="cartproduct">  '  + 
 '                       <img src="' + value.product.image+ '">  '  + 
 '                     </div>  '  + 
 '                     <div class="cartproduct_text">  '  + 
 '                       <p>Product</p>  '  + 
 '                       <h5>' + value.product.name + '</h5>  '  + 
 '                       <h4>' + value.product.currency + ' ' + value.product.price + '</h4>  '  + 
 '                     </div>  '  + 
 '                   </div>  '  + 
 '                   <div class="cart_box"> '  + 
 '                     <div class="cartproduct"> '  + 
 '                       <img src="' +BaseUrl+ '/images/voucher.jpg">  '  + 
 '                     </div>  '  + 
 '                     <div class="cartproduct_text">  '  + 
 '                       <p>' + value.product.coupon_description+ '</p>  '  + 
 '                     </div>  '  + 
 '                   </div>  '  + 
 '                 </div>  '  + 
 '                 <div class="cartprice_item"><i class="fa fa-trash remove_item" id=' + value.id + ' aria-hidden="true"></i>  '  + 
 '                   <div class="cartprice">  '  + 
 '                     <h4><span>Sub Total</span>' + value.product.currency + ' ' + value.price*value.qty + '</h4>  '  + 
 '                   </div>  '  + 
 '                   <div class="cart_qty"><p style="color:red;" class="stock"></p>  '  + 
 '                     <div class="add_product_count">  '  + 
 '                       <button type="button"><i id="' + value.product.id + '" class="fas fa-minus cmins" aria-hidden="true"></i></button>  '  + 
 '                       <input type="text" value="' + value.qty + '">  '  +  
 '                       <button type="button"><i id="' + value.product.id + '" class="fas fa-plus cplus" aria-hidden="true"></i></button>  '  + 
 '                     </div>  '  + 
 '                   </div>  '  + 
 '                 </div>  '  + 
 '               </div>  ';
       }); 
myvar +='     '  + 
 '             </div>  '  + 
 '             <div class="col-md-4">  '  + 
 '               <div class="cart_item">  '  + 
 '                 <ul>  '  + 
 '                   <li>Total Products <span>'+data['data']['cartInfo']['quantity']+'</span></li>  '  + 
 '                   <li>Total Items <span>'+data['data']['cartInfo']['order_item_count']+'</span></li>  '  + 
 '                 </ul>  '  + 
 '                 <p>You will earn 141i-Points from this purchase</p>  '  + 
 '                 <div class="grand_total">  '  + 
 '                   <div class="grandtotal_left">  '  + 
 '                     <h4>Grand Total</h4>  '  + 
 '                     <p>Prices inclusive of VAT</p>  '  + 
 '                   </div>  '  + 
 '                   <h5>'+data['data']['cartInfo']['currency']+' '+data['data']['cartInfo']['total']+'</h5>  '  + 
 '                 </div>  '  + 
 '                 <a href="'+BaseUrl+'/shop/checkout" class="btn btn-primary btn-block mt-3">Select Payment Method</a>  '  + 
 '               </div>  '  + 
 '            </div>  ';

    }
  $('#added_items').html(myvar);     
  jQuery('.stock').html(data.message);  
    rmv(); 
    //$('#total_items').delay(2000).fadeIn('slow');
  });


  function rmv() {
    jQuery('.remove_item').off("click").on('click', function () {
      jQuery.ajax({
        type: "POST",
        url: BaseUrl+"/product/cartRemoveItem",
        data: {
          cart_id: jQuery(this).attr("id")
        }, 
        dataType: "json",
        success: function (data) {

          jQuery('#cartcount').html(data['data']['cartInfo']['quantity']);
          var myvar = '';
          if (data['data']['cartInfo']['quantity'] == "0") {
            myvar += '<img src="'+BaseUrl+'/images/empty-cart-icon-1.jpg" alt="img" />';
          } else {
              myvar =   '<div class="col-md-8">  ';

        $.each(data['data']['items'], function (index, value) {   
              var str = value.product.description;
  myvar +='        <div class="cart_item_list">  '  + 
 '                 <div class="cartitem_add">  '  + 
 '                   <div class="cart_box">  '  + 
 '                     <div class="cartproduct">  '  + 
 '                       <img src="' + value.product.image+ '">  '  + 
 '                     </div>  '  + 
 '                     <div class="cartproduct_text">  '  + 
 '                       <p>Product</p> '  + 
 '                       <h5>' + value.product.name + '</h5>  '  + 
 '                       <h4>' + value.product.currency + ' ' + value.product.price + '</h4>  '  + 
 '                     </div>  '  + 
 '                   </div>  '  + 
 '                   <div class="cart_box">  '  + 
 '                     <div class="cartproduct">  '  + 
 '                       <img src="' +BaseUrl+ '/images/voucher.jpg"> '  + 
 '                     </div>  '  + 
 '                     <div class="cartproduct_text">  '  + 
 '                       <p>' + value.product.coupon_description+ '</p>  '  + 
 '                       <h4>' + value.product.currency + ' ' + value.product.prize_amount + '</h4>  '  + 
 '                     </div>  '  + 
 '                   </div>  '  + 
 '                 </div>   '  + 
 '                 <div class="cartprice_item"><i class="fa fa-trash remove_item" id=' + value.id + ' aria-hidden="true"></i>  '  + 
 '                   <div class="cartprice">  '  + 
 '                     <h4><span>Sub Total</span>' + value.product.currency + ' ' + value.price*value.qty + '</h4>  '  + 
 '                   </div>  '  + 
 '                   <div class="cart_qty"><p style="color:red;" class="stock"></p>  '  + 
 '                     <div class="add_product_count">  '  + 
 '                       <button type="button"><i id="' + value.product.id + '" class="fas fa-minus cmins" aria-hidden="true"></i></button>  '  + 
 '                       <input type="text" value="' + value.qty + '">  '  +  
 '                       <button type="button"><i id="' + value.product.id + '" class="fas fa-plus cplus" aria-hidden="true"></i></button>  '  + 
 '                     </div>  '  + 
 '                   </div>  '  + 
 '                 </div>  '  + 
 '               </div>  ';
       }); 
myvar +='     '  + 
 '             </div>  '  + 
 '             <div class="col-md-4">  '  + 
 '               <div class="cart_item">  '  + 
 '                 <ul>  '  + 
 '                   <li>Total Products <span>'+data['data']['cartInfo']['quantity']+'</span></li>  '  + 
 '                   <li>Total Items <span>'+data['data']['cartInfo']['order_item_count']+'</span></li>  '  + 
 '                 </ul>  '  + 
 '                 <p>You will earn 141i-Points from this purchase</p>  '  + 
 '                 <div class="grand_total">  '  + 
 '                   <div class="grandtotal_left">  '  + 
 '                     <h4>Grand Total</h4>  '  + 
 '                     <p>Prices inclusive of VAT</p>  '  + 
 '                   </div>  '  + 
 '                   <h5>'+data['data']['cartInfo']['currency']+' '+data['data']['cartInfo']['total']+'</h5>  '  + 
 '                 </div>  '  + 
 '                 <a href="'+BaseUrl+'/shop/checkout" class="btn btn-primary btn-block mt-3">Select Payment Method</a>  '  + 
 '               </div>  '  + 
 '            </div>  ';
          }
          $('#added_items').html(myvar);
            jQuery('.stock').html(data.message);  

          rmv();
        },
        error: function () {
          alert('Error!');
        }
      });
      return false;
    });


    /*****************Increase Decrease**********************/

    jQuery('.cplus').off("click").on('click', function () {
      jQuery.ajax({
        type: "POST",
        url: BaseUrl+"/product/cartIncreaseQty",
        data: {
          product_id: jQuery(this).attr("id"),
        },
        dataType: "json",
        success: function (data) {

          jQuery('#cartcount').html(data['data']['cartInfo']['quantity']);
          var myvar = '';
          if (data['data']['cartInfo']['quantity'] == "0") {
            myvar += '<img src="'+BaseUrl+'/images/empty-cart-icon-1.jpg" alt="img" />';
          } else {
            myvar =   '<div class="col-md-8">  ';

        $.each(data['data']['items'], function (index, value) {  
              var str = value.product.description;
  myvar +='        <div class="cart_item_list">  '  + 
 '                 <div class="cartitem_add">  '  + 
 '                   <div class="cart_box">  '  + 
 '                     <div class="cartproduct">  '  + 
 '                       <img src="' + value.product.image+ '">  '  + 
 '                     </div>  '  + 
 '                     <div class="cartproduct_text">  '  + 
 '                       <p>Product</p>  '  + 
 '                       <h5>' + value.product.name + '</h5>  '  + 
 '                       <h4>' + value.product.currency + ' ' + value.product.price + '</h4>  '  + 
 '                     </div>  '  + 
 '                   </div>  '  + 
 '                   <div class="cart_box">  '  + 
 '                     <div class="cartproduct">  '  + 
 '                       <img src="' +BaseUrl+ '/images/voucher.jpg">  '  + 
 '                     </div>  '  + 
 '                     <div class="cartproduct_text">  '  + 
 '                       <p>' + value.product.coupon_description+ '</p>  ' +  
 '                     </div> '  + 
 '                   </div>  '  + 
 '                 </div>   '  + 
 '                 <div class="cartprice_item"> <i class="fa fa-trash remove_item" id=' + value.id + ' aria-hidden="true"></i> '  + 
 '                   <div class="cartprice">  '  + 
 '                     <h4><span>Sub Total</span>' + value.product.currency + ' ' + value.price*value.qty + '</h4>  '  + 
 '                   </div>  '  + 
 '                   <div class="cart_qty">  <p style="color:red;" class="stock"></p>'  + 
 '                     <div class="add_product_count">  '  + 
 '                       <button type="button"><i id="' + value.product.id + '" class="fas fa-minus cmins" aria-hidden="true"></i></button>  '  + 
 '                       <input type="text" value="' + value.qty + '">  '  +  
 '                       <button type="button"><i id="' + value.product.id + '" class="fas fa-plus cplus" aria-hidden="true"></i></button>  '  + 
 '                     </div>  '  + 
 '                   </div>  '  + 
 '                 </div>  '  + 
 '               </div>  ';
       }); 
myvar +='     '  + 
 '             </div>  '  + 
 '             <div class="col-md-4">  '  + 
 '               <div class="cart_item">  '  + 
 '                 <ul>  '  + 
 '                   <li>Total Products <span>'+data['data']['cartInfo']['quantity']+'</span></li>  '  + 
 '                   <li>Total Items <span>'+data['data']['cartInfo']['order_item_count']+'</span></li>  '  + 
 '                 </ul>  '  + 
 '                 <p>You will earn 141i-Points from this purchase</p>  '  + 
 '                 <div class="grand_total">  '  + 
 '                   <div class="grandtotal_left">  '  + 
 '                     <h4>Grand Total</h4>  '  + 
 '                     <p>Prices inclusive of VAT</p>  '  + 
 '                   </div>  '  + 
 '                   <h5>'+data['data']['cartInfo']['currency']+' '+data['data']['cartInfo']['total']+'</h5>  '  + 
 '                 </div>  '  + 
 '                 <a href="'+BaseUrl+'/shop/checkout" class="btn btn-primary btn-block mt-3">Select Payment Method</a>  '  + 
 '               </div>  '  + 
 '            </div>  ';
          }
          $('#added_items').html(myvar);
           jQuery('.stock').html(data.message);    
          rmv();
        },
        error: function () {
          console.log('Error!');
        }
      });
      return false;
    });
    jQuery('.cmins').off("click").on('click', function () {
      jQuery.ajax({
        type: "POST",
        url: BaseUrl+"/product/cartDecreaseQty",
        data: {
          product_id: jQuery(this).attr("id"),
        },
        dataType: "json",
        success: function (data) {

          jQuery('#cartcount').html(data['data']['cartInfo']['quantity']);

          var myvar = '';
          if (data['data']['cartInfo']['quantity'] == "0") {
            myvar += '<img src="'+BaseUrl+'/images/empty-cart-icon-1.jpg" alt="img" />';
          } else {
               myvar =   '<div class="col-md-8">  ';

        $.each(data['data']['items'], function (index, value) {  
              var str = value.product.description;
  myvar +='        <div class="cart_item_list">  '  + 
 '                 <div class="cartitem_add">  '  + 
 '                   <div class="cart_box">  '  + 
 '                     <div class="cartproduct">  '  + 
 '                       <img src="' + value.product.image+ '">  '  + 
 '                     </div>  '  + 
 '                     <div class="cartproduct_text">  '  + 
 '                       <p>Product</p>  '  + 
 '                       <h5>' + value.product.name + '</h5>  '  + 
 '                       <h4>' + value.product.currency + ' ' + value.product.price + '</h4>  '  + 
 '                     </div>  '  + 
 '                   </div>  '  + 
 '                   <div class="cart_box">  '  + 
 '                     <div class="cartproduct">  '  + 
 '                       <img src="' +BaseUrl+ '/images/voucher.jpg">  '  + 
 '                     </div>  '  + 
 '                     <div class="cartproduct_text">  '  + 
 '                       <p>' + value.product.coupon_description+ '</p>  '  + 
 '                     </div>  '  + 
 '                   </div>  '  + 
 '                 </div>   '  + 
 '                 <div class="cartprice_item"><i class="fa fa-trash remove_item" id=' + value.id + ' aria-hidden="true"></i>  '  + 
 '                   <div class="cartprice">  '  + 
 '                     <h4><span>Sub Total</span>' + value.product.currency + ' ' + value.price*value.qty + '</h4>  '  + 
 '                   </div>  '  + 
 '                   <div class="cart_qty"> <p style="color:red;" class="stock"></p> '  + 
 '                     <div class="add_product_count">  '  + 
 '                       <button type="button"><i id="' + value.product.id + '" class="fas fa-minus cmins" aria-hidden="true"></i></button>  '  + 
 '                       <input type="text" value="' + value.qty + '">  '  +  
 '                       <button type="button"><i id="' + value.product.id + '" class="fas fa-plus cplus" aria-hidden="true"></i></button>  '  + 
 '                     </div>  '  + 
 '                   </div>  '  + 
 '                 </div>  '  + 
 '               </div>  ';
       }); 
myvar +='     '  + 
 '             </div>  '  + 
 '             <div class="col-md-4">  '  + 
 '               <div class="cart_item">  '  + 
 '                 <ul>  '  + 
 '                   <li>Total Products <span>'+data['data']['cartInfo']['quantity']+'</span></li>  '  + 
 '                   <li>Total Items <span>'+data['data']['cartInfo']['order_item_count']+'</span></li>  '  + 
 '                 </ul>  '  + 
 '                 <p>You will earn 141i-Points from this purchase</p>  '  + 
 '                 <div class="grand_total">  '  + 
 '                   <div class="grandtotal_left">  '  + 
 '                     <h4>Grand Total</h4>  '  + 
 '                     <p>Prices inclusive of VAT</p>  '  + 
 '                   </div>  '  + 
 '                   <h5>'+data['data']['cartInfo']['currency']+' '+data['data']['cartInfo']['total']+'</h5>  '  + 
 '                 </div>  '  + 
 '                 <a href="'+BaseUrl+'/shop/checkout" class="btn btn-primary btn-block mt-3">Select Payment Method</a>  '  + 
 '               </div>  '  + 
 '            </div>  '; 
          }
          $('#added_items').html(myvar);
           jQuery('.stock').html(data.message);    
          rmv();
        },
        error: function () {
          console.log('Error!');  
        }
      });
      return false;
    });


  }


});