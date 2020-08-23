<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>{{config('app.name')}} Admin</title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

   <link rel="shortcut icon" href="{{ url('/') }}/images/config/{{App\Config::get_field('favicon')}}" type="image/x-icon" sizes="16x16">

  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="{{url('/')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="{{url('/')}}/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="{{url('/')}}/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="{{url('/')}}/dist/css/AdminLTE.min.css">

  <!-- iCheck -->

  <link rel="stylesheet" href="{{url('/')}}/plugins/iCheck/square/blue.css">



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->

 <!------------Custom css file--------------->

 <link rel="stylesheet" href="{{url('/')}}/css/admin/style.css"> 

  <!-- Google Font -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition login-page">

<div class="login-box">

@include('flash-message') 

  <div class="login-logo">

    <a href="{{url('/')}}">
    <img src="{{ url('/') }}/images/config/{{App\Config::get_field('logo')}}" alt="{{config('app.name')}}">	
    </a> 

  </div>

  <!-- /.login-logo -->

  <div class="login-box-body">

    <p class="login-box-msg">Sign in to start your session</p> 



     <form method="POST" action="{{ route('admin.login') }}">

      @csrf

      <div class="form-group has-feedback">

      <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid_e @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

        @error('email')

            <span class="invalid-feedback" role="alert">

                <strong>{{ $message }}</strong>

            </span>

         @enderror

      </div>

      <div class="form-group has-feedback">

      <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid_e @enderror" name="password" required autocomplete="current-password">

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        @error('password')

                <span class="invalid-feedback" role="alert">

                    <strong>{{ $message }}</strong>

                </span>

        @enderror

      </div>

      <div class="row">

        <!-- /.col -->

        <div class="col-xs-4">

          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>

        </div>

        <!-- /.col -->

      </div>

    </form>



       @if (Route::has('password.request'))

          

          <p class="mb-1">

          <a class="btn btn-link" href="{{ route('password.request') }}">

              {{ __('Forgot Your Password?') }}

          </a>

          </p>

      @endif  



  </div>

  <!-- /.login-box-body -->

</div>

<!-- /.login-box -->



<!-- jQuery 3 -->

<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>

<!-- Bootstrap 3.3.7 -->

<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- iCheck -->

<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>  

<script>

  $(function () {

    $('input').iCheck({

      checkboxClass: 'icheckbox_square-blue',

      radioClass: 'iradio_square-blue',

      increaseArea: '20%' /* optional */

    });

  });

</script>

</body> 

</html>

