@extends('layouts.admin')

@section('content')



 <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Dashboard

      </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Dashboard</li>

      </ol>

    </section>



    <!-- Main content -->

    <section class="content">

      <!-- Info boxes -->

           <div class="row">        

        <div class="col-lg-3 col-xs-6">

          <!-- small box -->

          <div class="small-box bg-aqua">

            <div class="inner">

              <h3>{{$newCount}}</h3>



              <p>New Orders</p>

            </div>

            <div class="icon">

              <i class="ion ion-bag"></i>

            </div> 

            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

          </div>    

        </div>

        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">

          <!-- small box -->

          <div class="small-box bg-green">

            <div class="inner">

              <h3>53<sup style="font-size: 20px">%</sup></h3>



              <p>Bounce Rate</p>

            </div>

            <div class="icon">

              <i class="ion ion-stats-bars"></i>

            </div>

            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

          </div>

        </div>

        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">

          <!-- small box -->

          <div class="small-box bg-yellow">

            <div class="inner">

              <h3>{{$totalUser}}</h3>  



              <p>Total Customer</p>

            </div>

            <div class="icon">

              <i class="ion ion-person-add"></i>

            </div>

            <a href="{{route('admin.users')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

          </div>

        </div>

        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">

          <!-- small box -->

          <div class="small-box bg-red">

            <div class="inner">

              <h3>0</h3>           



              <p>Total Customer</p>

            </div>

            <div class="icon">

              <i class="fa fa-users"></i>

            </div>  

            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

          </div>

        </div>

        <!-- ./col -->

      </div>

      <!-- /.row -->



    

      <!-- Main row -->

      <div class="row">

        <!-- Left col -->

        <div class="col-md-8">

   

          <div class="row">

        

          

              <!-- USERS LIST -->

              <div class="box box-danger">

                <div class="box-header with-border">

                  <h3 class="box-title">Latest Customer</h3>



                  <div class="box-tools pull-right">    

<!--                    <span class="label label-danger">8 New Members</span>-->

                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

                    </button>

                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>

                    </button>

                  </div>

                </div>

                <!-- /.box-header -->



                <!-- /.box-footer -->

              </div>

              <!--/.box -->

        

          </div>  

          <!-- /.row -->



          <!-- TABLE: LATEST ORDERS -->

          <div class="box box-info">

            <div class="box-header with-border">

              <h3 class="box-title">Latest Orders</h3>



              <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

                </button>

                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

              </div>

            </div>

            <!-- /.box-header -->

            <div class="box-body">

              <div class="table-responsive">

                <table class="table no-margin">

                  <thead>

                  <tr>

                    <th>Order ID</th>

                    <th>Phone</th>

                    <th>Status</th>

                    <th>Date</th> 

                  </tr>

                  </thead>

                  <tbody>

                      

                    @if($latestBooking->isNotEmpty()) 

                    @foreach($latestBooking as $list)  

                  <tr>

                    <td><a href="#">{{$list->order_number}}</a></td>

                    <td>{{$list->phone}}</td> 

                    <td><span class="label label-success">Shipped</span></td>

                    <td>

                      <div class="sparkbar" data-color="#00a65a" data-height="20">{{$list->created_at}}</div>

                    </td>

                  </tr>

                   @endforeach 

                   @endif  

            

                 

                  </tbody>

                </table>

              </div>

              <!-- /.table-responsive -->

            </div>

            <!-- /.box-body -->

            <div class="box-footer clearfix"> 

             

              <a href="#" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>

            </div>

            <!-- /.box-footer -->

          </div>

          <!-- /.box -->

        </div>

        <!-- /.col -->



        <div class="col-md-4">

          <!-- Info Boxes Style 2 -->

          <div class="info-box bg-yellow">

            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>



            <div class="info-box-content">

              <span class="info-box-text">Inventory</span>

              <span class="info-box-number">5,200</span>



              <div class="progress">

                <div class="progress-bar" style="width: 50%"></div>

              </div>

              <span class="progress-description">

                    50% Increase in 30 Days

                  </span>

            </div>

            <!-- /.info-box-content -->

          </div>

          <!-- /.info-box -->

          <div class="info-box bg-green">

            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>



            <div class="info-box-content">

              <span class="info-box-text">Mentions</span>

              <span class="info-box-number">92,050</span>



              <div class="progress">

                <div class="progress-bar" style="width: 20%"></div>

              </div>

              <span class="progress-description">

                    20% Increase in 30 Days

                  </span>

            </div>

            <!-- /.info-box-content -->

          </div>

          <!-- /.info-box -->

          <div class="info-box bg-red">

            <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>



            <div class="info-box-content">

              <span class="info-box-text">Downloads</span>

              <span class="info-box-number">114,381</span>



              <div class="progress">

                <div class="progress-bar" style="width: 70%"></div>

              </div>

              <span class="progress-description">

                    70% Increase in 30 Days

                  </span>

            </div>

            <!-- /.info-box-content -->

          </div>

          <!-- /.info-box -->

          <div class="info-box bg-aqua">

            <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>



            <div class="info-box-content">

              <span class="info-box-text">Direct Messages</span>

              <span class="info-box-number">163,921</span>



              <div class="progress">

                <div class="progress-bar" style="width: 40%"></div>

              </div>

              <span class="progress-description">

                    40% Increase in 30 Days

                  </span>

            </div>

            <!-- /.info-box-content -->

          </div>

          <!-- /.info-box -->       

          <!-- PRODUCT LIST -->

          <div class="box box-primary">

            <div class="box-header with-border">

              <h3 class="box-title">Recently Added Category</h3>



              <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

                </button>

                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

              </div>

            </div>

            <!-- /.box-header -->




            <!-- /.box-footer -->

          </div>

          <!-- /.box -->

        </div>

        <!-- /.col -->

      </div>

      <!-- /.row -->

    </section>

    <!-- /.content -->  

  

  @endsection