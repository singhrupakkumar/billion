
    <div class="header_top">
        <div class="container d-flex justify-content-between">
            <div class="contactno">Contact No :<a href="#"> @if(\App\Config::get_field('phone')) {{ \App\Config::get_field('phone') }} @endif</a></div> 
            <div class="header_top_right">
                <a href="{{url('/pages/about')}}">{{ __('About Us') }}</a> 
                <a href="{{route('contact')}}">{{ __('Help Center') }}</a>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark custom_nav">
        <div class="container">
          <div class="menu_logo">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{url('/')}}/images/logo.png">
        </a>
        <div class="dropdown">
          <button class="filter_menu dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{url('/')}}/images/menu.svg">
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
             @if(\App\Category::get()->isNotEmpty())
              @foreach(\App\Category::get() as $list)
              <a class="dropdown-item"  href="{{url('/')}}?Rcampaign={{$list->slug}}">{{$list->name}}</a> 
              @endforeach
              @endif
          </div>
        </div> 
      </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <form class="form-inline my-2 my-lg-0 search_form" action="{{route('search')}}"> 
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" value="{{Request('search')}}" name="search">
                <button class="search_btn" type="submit">
                  <span class="step size-14">
                    <i class="ion-ios-search"></i>
                  </span>
                </button>
            </form>

          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ url('/') }}/pages/how-it-works">{{ __('How it works') }} <span class="sr-only">(current)</span></a>
            </li>            
            <li class="nav-item">
              <a class="nav-link" href="@if(Route::currentRouteName() == 'home') #campaign-section  @else {{url('/')}}#campaign-section  @endif">{{ __('Campaigns') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="@if(Route::currentRouteName() == 'home') #product-section  @else {{url('/')}}#product-section  @endif">{{ __('Products') }}</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{route('plan')}}">{{ __('Subscription') }}</a>
            </li>
          </ul>

         

          <ul class="navbar-nav ml-auto d-flex align-items-center">
            <li class="nav-item dropdown user_login">
              @guest
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('Login or Register') }} <i style="font-size: 22px;" class="far fa-user-circle"></i>
              </a>
              <div class="dropdown-menu login_dropdown dropdown-menu-right" aria-labelledby="navbarDropdown">
                
                <form method="POST" action="{{ route('customlogin') }}">
                  @csrf
                  <div class="form-group">
           
                      <input id="email" type="email" placeholder="Email address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" aria-describedby="emailHelp" autofocus>

                        @error('email')

                          <span class="invalid-feedback" role="alert">

                            <strong>{{ $message }}</strong>

                          </span>

                        @enderror
                  </div>
                  <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">

                        @error('password')

                          <span class="invalid-feedback" role="alert">

                            <strong>{{ $message }}</strong>   

                          </span>

                        @enderror
                  </div>
                  <button type="submit" class="btn btn-dark btn-block">{{ __('Submit') }}</button>
                </form>
                
                <div class="loginmenu">
                  <ul class="loginmenu_list">
                    <li><a href="{{route('register')}}">{{ __('New user? Register now') }}</a></li>
                    <li><a href="{{ route('password.request') }}">{{ __('Password help') }}</a></li>
                  </ul>
                </div>
                
                
              </div>

                @else


              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{Auth::user()->first_name}} {{Auth::user()->last_name}} <span class="user_profile"><img src="{{App\Helper::userimg(Auth::user()->profile_picture)}}" width="30"></span>
              </a>
              <div class="dropdown-menu login_dropdown dropdown-menu-right" aria-labelledby="navbarDropdown">
                <div class="loginmenu">
                  <ul class="loginmenu_list">
                    <li><a href="{{route('profile')}}">{{ __('Profile') }}</a></li>
                    <li><a href="{{route('changepassword')}}">{{ __('Change Password') }}</a></li>
                    <li>
                      <a href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">{{ __('Sign Out') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    </li>
                  </ul>
                </div>
                
                
              </div>

               @endguest
            </li>
            <li class="nav-item"> 
              <a class="nav-link" href="{{route('cart')}}" tabindex="-1" aria-disabled="true">
                   <div class="cart-no" id="cartcount" style="background-color: #ffc600;
    color: #fff;
    width: 20px;
    height: 20px;
    border-radius: 50%;">@if(Session::has('cartInfo')){{Session::get('cartInfo')['quantity']}} @else 0 @endif</div>   
                  <img src="{{url('/')}}/images/cart.svg">  
              </a>
            </li>
          </ul>
          
        </div>
    </div>
      </nav>
    
    