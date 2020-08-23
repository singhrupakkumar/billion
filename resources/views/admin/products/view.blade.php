@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
        Product

        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View</li>
    </ol>    
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$product->name}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tbody>
                            <tr>

                            </tr>
                            <tr>
                                <th>Id</th>
                                <td>{{$product->id}}</td>
                            </tr>

                            <tr>
                                <th>Product Category</th>
                                <td>{{$product->category !=null?$product->category->name:''}}</td>
                            </tr>     
                            <tr> 
                                <th>Name</th>
                                <td>{{$product->name}}</td>
                            </tr>

                            <tr> 
                                <th>Price</th>
                                <td>{{$product->currency}} {{$product->price}}</td>
                            </tr>
                            <tr> 
                                <th>Stock</th>
                                <td>{{$product->stock}}</td>
                            </tr>

                            <tr> 
                                <th>Minimum Qty</th>
                                <td>{{$product->min_qty}}</td>
                            </tr>  

                            <tr> 
                                <th>Maximum Qty</th>
                                <td>{{$product->max_qty}}</td>
                            </tr>

                             <tr> 
                                <th>Avg Rating</th>
                                <td>{{$product->avg_rating}}</td>
                            </tr>

                            <tr> 
                                <th>Discount</th>
                                <td>{{$product->discount}} %</td>
                            </tr>

                            <tr>
                                <th>Description</th>
                                <td>{!! $product->description !!}</td>
                            </tr>



                            <tr>
                                <th>Image</th>
                                <td> 

                                    <img src="{{App\Helper::catImg($product->image)}}" style="width: 190px; margin-bottom: 20px;
                                    " class="previewHolder"/>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>


</div>
</section>

@endsection
