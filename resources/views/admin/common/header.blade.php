<header class="main-header">  

<!-- Logo -->
<a href="#" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>A</b>P</span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg">
  @if(\App\Config::get_field('logo') != '')
  <img src="{{ url('/') }}/images/config/{{ \App\Config::get_field('logo') }}" alt="LogoImage">
  @else
  {{ \App\Config::get_field('site_title') }}
  @endif
  </span>
</a>

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
     

      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{App\Helper::userimg(Auth::user()->profile_picture)}}" class="user-image" alt="User Image">
          <span class="hidden-xs">{{Auth::user()->name}}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="{{App\Helper::userimg(Auth::user()->profile_picture)}}" class="img-circle" alt="User Image">

            <p>
            {{Auth::user()->name}}
              <small>{{Auth::user()->created_at}}</small>
            </p>
          </li>
     
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="{{route('admin.profile',Auth::user()->id)}}" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <a href="{{route('admin.logout')}}" class="btn btn-default btn-flat">Sign out</a> 
            </div>
          </li>
        </ul>
      </li>  
   
    </ul>
  </div>

</nav>
</header>