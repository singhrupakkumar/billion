<style type="text/css">
a.active {
    background: #ecdb72;
    color: #fff !important;
    font-weight: bold;
}	
</style>
<ul>
    <li><a @if($actionName == 'profile') class="active" @endif href="{{ route('profile') }}">{{__('Personal Details')}}</a></li>
    <li><a @if($actionName == 'changepassword') class="active" @endif href="{{ route('changepassword') }}">{{__('Change Password')}}</a></li>
	<li><a @if($actionName == 'myOrder') class="active" @endif href="{{ route('myOrder') }}">{{__('Order History')}}</a></li>
    <li>
       <a href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">{{ __('Sign Out') }}
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form> 
    </li> 
</ul>                            