@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
        {{__('Product')}}
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
        <li class="active">{{__('Add Product')}}</li>
    </ol>
</section>

<section class="content">



    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('Add Product')}}</h3> 
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="products-form" method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Product Category')}}</label>
                                    <div class="input text">
                                      {!!App\Category::treeView(0,'category_id')!!}       
                                        @error('category_id')  
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Product Name')}}</label>
                                    <div class="input text">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" required>
                                       @error('name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Price')}}</label>
                                    <div class="input text">
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" min="0" id="price" name="price" placeholder="Price" required>
                                       @error('price')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror 
                                    </div>
                                </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('Currency')}}</label> 
                                <div class="input text">
                                    <select id="currency" name="currency" class="form-control" required>
                                        <option value="">Select Currency</option>
                                        <option value="INR">INR</option>  
                                        <option value="AED">AED</option>  
                                    </select>    
                                </div>
                            </div> 

                      

                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('Min Qty')}}</label>
                                <div class="input number">
                                    <input type="number" name="min_qty" id="min_qty" min="1" class="form-control">
                                </div>  
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('Max Qty')}}</label>
                                <div class="input number">
                                    <input type="number" name="max_qty" id="max_qty" min="1" class="form-control">
                                </div>  
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('Stock')}}</label>
                                <div class="input number">
                                    <input type="number" name="stock" id="stock" min="1" class="form-control">
                                </div>  
                            </div>


                            <div class="form-group inline">
                                    <div class="input inline">
                                    <input style="margin-right:8px" type="checkbox" id="is_voucher" name="is_voucher" value="1"/>   
                                    <label for="exampleInputEmail1">{{__('Is Voucher?')}}</label>
                                    </div>  
                            </div>

                            <div id="hideGroup" style="display: none;">
                                   <div class="form-group">
                                      <div class="after-add-more">  
                                          
                                        @if(\App\VoucherBrand::get()->isNotEmpty())
                                        @foreach(\App\VoucherBrand::get() as $list)    

                                        <div class="control-group input-group" style="margin-top:10px">
                                            <div class="row">
                                                <div class="col-md-6"> 
                                                    <label>{{$list->name}}</label>
                                                    <input type="checkbox" id="voucher_brand_id{{$list->id}}" name="voucher_brand_id[]" value="{{$list->id}}">
                                                </div> 
                                                <div class="col-md-6">
                                                    <input type="number" name="no_of_voucher[{{$list->id}}]" class="form-control" min="0" value="1" placeholder="No. Of Voucher">  
                                                </div>          
                                            </div>          

                                        </div>
                                        @endforeach
                                        @endif 

                       
                                    </div>
                                        </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputTangs">{{__('Coupon Description')}}</label>
                                <div class="input ans required"> 
                                    <textarea name="coupon_description" class="form-control textarea  @error('coupon_description') is-invalid @enderror"  id="coupon_description"></textarea>
                                    @error('coupon_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror  
                                </div>      
                            </div> 

                            <div class="form-group">
                                <label for="exampleInputTangs">{{__('Product Description')}}</label>
                                <div class="input ans required"> 
                                    <textarea name="description" class="form-control textarea  @error('description') is-invalid @enderror"  id="description"></textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror  
                                </div>      
                            </div> 

                            <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Winner Prize Image')}}</label>
                                    <div class="input file">
                                        <input type="file" name="prize_image" id="prize_image" class="form-control">
                                     </div>   
                            </div>  


                            <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Image')}}</label>
                                    <div class="input file">
                                        <input type="file" name="image" id="image" class="form-control">
                                     </div>  
                            </div>  


                        </div> 
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-info" type="submit">{{__('Add')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $().ready(function () {
        $("#products-form").validate({
            rules: {
				
				name: {
                    required: true
                },
                stock: {
                    required: true
                },
                max_qty: {
                    required: true
                },
				min_qty: {
                    required: true
                },
				price: {
                    required: true
                },
				category_id: {
                    required: true
                }
            }
        });

        $('#is_voucher').on('change',function(){
            if ($(this).is(':checked')) {  
                $('#hideGroup').show('slow'); 
            }else{
                $('#hideGroup').hide('fast');  
            }
            
        }); 

        $(".add-more").click(function(){ 
            var html = $(".copy").html();
            $(".after-add-more").after(html);    
        });    


        $(function () {
            //Initialize Select2 Elements
         $('.select2').select2()
        })

    });
</script>       
@endsection
