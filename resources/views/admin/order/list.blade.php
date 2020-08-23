@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->

    <section class="content-header">

    <h1>

    {{__('Orders')}} 

    

         <small></small>

    </h1>

      <ol class="breadcrumb">

        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>

        <li><a href="#">{{__('Orders')}}</a></li>

      </ol>

    </section>



    <!-- Main content -->

    <section class="content">



      <!-- Default box -->

      <div class="box">

    

            <!-- /.box-header -->

            <div class="box-body">

			

				<form  role="search">

				{{ csrf_field() }}

				<div class="input-group">

					<input type="text" class="form-control" name="q" value="{{Request('q')}}"

						placeholder="Search booking"> <span class="input-group-btn">

						<button type="submit" class="btn btn-default">

							<i class="fa fa-search" aria-hidden="true"></i>

						</button>

					</span>

				</div>

				</form>

              <table id="example1" class="table table-bordered table-striped">

                <thead>

           

                 <tr>

                  <th>{{__('Order Number')}}</th>

                  <th>{{__('Customer Number')}}</th>

                  <th>{{__('Name')}}</th>

                  <th>{{__('Payment Mode')}}</th>

                  <th>{{__('Total')}}</th>
                  <th>{{__('Status')}}</th>

                  <th>{{__('Created')}}</th>

                  <th>{{__('Actions')}}</th>

                </tr>

                </thead>

                <tbody>

                @if($all->isNotEmpty())

                @foreach($all as $list)

                <tr>

                  <td>{{$list->order_number}}</td>

                  <td>{{$list->phone}}</td>

                  <td>{{ucfirst($list->first_name)}} </td>

                  <td>{{$list->payment_mode}}</td>

                  <td>{{$list->total}}</td>
                  <td>{{$list->orderStatus?$list->orderStatus->name:''}}</td>

                  <td>{{$list->created_at}}</td>

                  <td>

                  <a href="{{route('orders.view',$list->id)}}" title="View" class="btn btn-info btn-xs"><span class="fa fa-eye"></span><span class="sr-only">View</span></a>

                   </td>

                </tr>

                @endforeach

                @endif

                </tbody>

              </table>

			{{ $all->links() }}

            </div>

            <!-- /.box-body -->

          </div>

      <!-- /.box -->



    </section>

    <!-- /.content -->





@endsection