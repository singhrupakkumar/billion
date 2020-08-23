<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- Sidebar user panel -->
      <!-- <div class="user-panel">
        <div class="pull-left image">
          <img src="{{App\Helper::userimg(Auth::user()->profile_picture)}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p> 
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a> 
        </div>
      </div> -->

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="@php if($controller == 'DashboardController'){ echo 'active'; } @endphp">
          <a href="{{route('admin.dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
     
        </li>









        <li class="@php if($controller == 'UserController'){ echo 'active'; } @endphp">
          <a href="{{route('admin.users')}}">
            <i class="fa fa-user"></i> <span>Customer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
     
        </li>
        





        <li class="@php if($controller == 'CategoryController'){ echo 'active'; } @endphp">
          <a href="{{route('categories.index')}}">
            <i class="fa fa-tag"></i> <span>Categories</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a> 
     
        </li>

        <li class="@php if($controller == 'ProductController'){ echo 'active'; } @endphp">
            <a href="{{route('products.index')}}"> 
                <i class="fa fa-list"></i> <span>Products</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>

        </li>

        <li class="@php if($controller == 'VoucherController'){ echo 'active'; } @endphp">
            <a href="{{route('vouchers.index')}}"> 
                <i class="fa fa-gift"></i> <span>Coupon</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>

        </li>


        <li class="@php if($controller == 'PlanController'){ echo 'active'; } @endphp">
            <a href="{{route('plans.index')}}"> 
                <i class="fa fa-tasks"></i> <span>Subscription Plans</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>

        </li>

        <li class="@php if($controller == 'OrderController'){ echo 'active'; } @endphp">
            <a href="{{route('neworders')}}">  
                <i class="fa fa-shopping-cart"></i> <span>Orders</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>

        </li>

        <li class="treeview @php if($controller == 'PageController'){ echo 'active'; } @endphp">
          <a href="#">
            <i class="fa fa-file"></i>
            <span>Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  class="@php if($controller == 'PageController'){ echo 'active'; } @endphp"><a href="{{route('admin.pages')}}"><i class="fa fa-circle-o"></i> Pages</a></li>
   
          </ul> 
        </li>


        <li class="@php if(in_array(Route::currentRouteName(),['admin.contacts'])){ echo 'active'; } @endphp">
          <a href="{{route('admin.contacts')}}">
            <i class="fa fa-phone"></i> <span>Contacts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
     
        </li>

        <li class="@php if(in_array(Route::currentRouteName(),['admin.config'])){ echo 'active'; } @endphp">
          <a href="{{route('admin.config')}}">
            <i class="fa fa-gear"></i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
     
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>