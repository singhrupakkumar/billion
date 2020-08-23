<footer>
        <div class="container">
          <div class="row">
            <div class="col-6 col-sm-6 col-md-3 col-lg-3">
              <div class="footer_box">
                <h6>{{ __('Quick Links') }}</h6>
                <ul>
                  <li><a href="{{url('/pages/about')}}">{{__('About Us')}}</a></li>
                  <li><a href="@if(Route::currentRouteName() == 'home') #campaign-section  @else {{url('/')}}#campaign-section  @endif">{{ __('Campaigns') }}</a></li>
                  <li><a href="@if(Route::currentRouteName() == 'home') #product-section  @else {{url('/')}}#product-section  @endif">{{ __('Products') }}</a></li>
                </ul>
              </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3 col-lg-3">
              <div class="footer_box">
                <h6>{{ __('Campaign') }}</h6>
                <ul>
                  @if(\App\Category::get()->isNotEmpty())
                  @foreach(\App\Category::get() as $list)
                  <li><a  href="{{url('/')}}?Rcampaign={{$list->slug}}">{{$list->name}}</a></li> 
                  @endforeach
                  @endif
                </ul>
              </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3 col-lg-3">
              <div class="footer_box">
                <h6>{{ __('Customer Service') }}</h6>
                <ul>
                  <li><a href="{{route('contact')}}">{{__('Contact Us')}}</a></li>
                  <li><a href="{{route('faq')}}">{{ __('FAQs') }}</a></li>
                  <li><a href="{{ url('/') }}/pages/how-it-works">{{ __('How it Works') }}</a></li> 
                  <li><a href="{{ url('/') }}/pages/charities">{{ __('Charities') }}</a></li> 
                  <li><a href="{{url('/pages/termofuse')}}">{{ __('Campaign Draw Terms & Conditions') }}</a></li>
                </ul>
              </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3 col-lg-3">
              <div class="footer_box">
                <h6>{{ __('Get in Touch') }}</h6>
                <div class="footer_contact_info">
                  <p class="golden_color">{{ __('Business Hours:') }} </p>
                  <p class="grey-color">@if(\App\Config::get_field('business_hours')) {{ \App\Config::get_field('business_hours') }} @endif</p>
                </div>
                <div class="footer_contact_info">
                  <p class="golden_color">{{ __('Call us now') }}</p>
                  <p class="grey-color">@if(\App\Config::get_field('phone')) {{ \App\Config::get_field('phone') }} @endif</p>
                </div>
                <div class="footer_contact_info">
                  <p class="golden_color">{{ __('Write us an email') }}</p>
                  <p class="grey-color">@if(\App\Config::get_field('email')) {{ \App\Config::get_field('email') }} @endif</p>
                </div>
              </div>
            </div>
          </div>

          <div class="footer_bottom text-center">
            <a href="#"><img src="{{url('/')}}/images/logo.png"></a>
            <div class="social_link">
              <a target="_blank" href="{{ \App\Config::get_field('facebook_link') != '' ?  \App\Config::get_field('facebook_link') : '#' }}"><i class="fab fa-facebook-f"></i></a>
               <a target="_blank" href="{{ \App\Config::get_field('google_link') != '' ?  \App\Config::get_field('google_link') : '#' }}"><i class="fab fa-google-plus"></i></a>
              <a target="_blank" href="{{ \App\Config::get_field('twitter_link') != '' ?  \App\Config::get_field('twitter_link') : '#' }}"><i class="fab fa-twitter"></i></a>
              <a target="_blank" href="{{ \App\Config::get_field('instagram_link') != '' ?  \App\Config::get_field('instagram_link') : '#' }}"><i class="fab fa-instagram"></i></a>
              <a target="_blank" href="{{ \App\Config::get_field('youtube_link') != '' ?  \App\Config::get_field('youtube_link') : '#' }}"><i class="fab fa-youtube"></i></a>
            </div> 
            <div class="copyright">
              <p>@if(\App\Config::get_field('copyright')) {!! \App\Config::get_field('copyright') !!} @endif</p>
            </div> 
          </div>

        </div>
</footer>
<script type="text/javascript">
  $(window).scroll(function () {
  if ($(window).scrollTop() > 28) {
    $('.navbar').addClass('navbar-fixed');
  }
  if ($(window).scrollTop() < 29) {
    $('.navbar').removeClass('navbar-fixed');
  }
});
</script>