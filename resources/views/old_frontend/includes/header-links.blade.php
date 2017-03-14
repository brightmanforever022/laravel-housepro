 @if(Auth::user())
 <script>
 $('#href-varias').click(function(e)
 {
    e.preventDefault();
 });
 </script>
<header class="bg_white">
        <div class="row">
            <div class="col-sm-3 col-xs-9">
                <div class="logo"><a href="{{ url('/') }}"><img src="{{ url('/') }}/images/logo-black.png" /></a></div>
            </div>
            <div class="col-sm-9 col-xs-3">
                <div class="main-nav home">
                    <ul>
                    @if(Auth::user() && Auth::user()->path == "" )
                    @if(Auth::user()->user_type == 1)
                    <li class="after-login"><a href="javasrcipt:void()" id="href_fesh1"><img src="{{ url('/') }}/images/img.png" />{{Auth::user()->company}}</a>
                    @else
                    <li class="after-login"><a href="javasrcipt:void()" id="href_fesh1"><img src="{{ url('/') }}/images/img.png" />{{Auth::user()->name}} {{Auth::user()->surname}}</a>
                    @endif
                    @elseif(Auth::user() && Auth::user()->user_type ==1)
                    <li class="after-login"><a href="javasrcipt:void()" id="href_fresh2"><img src="{{ url('/') }}/profilepics/{!! Auth::user()->path !!}" />{{Auth::user()->company}}</a>
                    @else
                    <li class="after-login"><a href="javasrcipt:void()" id="href_fresh2"><img src="{{ url('/') }}/profilepics/{!! Auth::user()->path !!}" />{{Auth::user()->name}} {{Auth::user()->surname}}</a>
                    @endif
                            <div class="login_dropdown">
                                <ul>
                                @if(Auth::user() && Auth::user()->user_type ==1)

                                <li><a href="{!! url('/create_new_add') !!}" class="create-add-btn-property" data-userid="{{ Auth::user()->id }}">Add Listing</a></li>
                                <li><a href="{{ url('/listing') }}">My Listing</a></li>
                                <li><a href="{{ url('/edit-profile-host') }}">Edit Profile/Account</a></li>
                                <li><a href="{{ url('/booking') }}">Bookings</a></li>
                                @else
                                <li><a href="{{ url('/edit-profile-tenant') }}">Edit Profile/Account</a></li>
                                <li><a href="{{ url('/booking-tenant') }}">Bookings</a></li>
                                @endif

                                <li><a href="{!! url('/') !!}/logout">Sign Out</a></li>
                               </ul>
                            </div>   
                                </li>
                                <li><a href="javascript:void(0)">Help</a></li>
                                @if(Auth::check() && Auth::user()->user_type ==1)
                                   <li><a href="{!! url('/create_new_add') !!}" class="create-add-btn-property" data-userid="{{ Auth::user()->id }}">Offer Appartment</a></li>
                                @endif
                    </ul>
                </div>
                <div class="res-nav res-top color-grey">
                    <a href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                 </div>
            </div>
        
        </div>
        
</header>
 @else
  <header class="bg_white">
        <div class="row">
        @if ($errors->has('email'))
            <span class="help-block errorMessage">
            <strong style="color:red">{{ $errors->first('email') }}</strong>
            </span>
        @endif
            <div class="col-sm-3 col-xs-9">
                <div class="logo"><a href="{{ url('/') }}"><img src="images/logo-black.png" /></a></div>
            </div>
            <div class="col-sm-9 col-xs-3">
                <div class="main-nav css-before-login">
                    <ul>
                        <li><a href="#register_user" class="fancybox">Register</a></li>
                        <li><a href="#login" class="fancybox">Log-in</a></li>
                        <li><a href="javascript:void(0)">Help</a></li>
                        <li class="offer-apartment"><a href="#register" class="fancybox">Offer Apartment</a></li>
                       </ul>
                </div>
                <div class="res-nav color-grey">
                    <a href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                 </div>
            </div>
        </div>
</header>
@endif

<!-- Google Analitic -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-84963219-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- Google Analitic -->
    @if(Auth::user())
    <div class="responsive-nav">
       
        <ul>
            @if(Auth::user()->user_type == 1)
            <li class="after-login"><a href="javascript:void(0)">{{Auth::user()->company}}</a></li>
            @elseif(Auth::user())
            <li class="after-login"><a href="javascript:void(0)">{{Auth::user()->name}} {{Auth::user()->surname}}</a></li>
            @endif
            

                @if(Auth::user() && Auth::user()->user_type ==1)
                
                <li><a href="{!! url('/create_new_add') !!}" class="create-add-btn-property"  data-userid="{{ Auth::user()->id }}">Add Listing</a></li>
                <li><a href="{{ url('/listing') }}">My Listing</a></li>
                <li><a href="{{ url('/edit-profile-host') }}">Edit Profile/Account</a></li>
                <li><a href="{{ url('/booking') }}">Bookings</a></li>
                @elseif(Auth::user() && Auth::user()->user_type == 0)
                <li><a href="{{ url('/edit-profile-tenant') }}">Edit Profile/Account</a></li>
                <li><a href="{{ url('/booking-tenant') }}">Bookings</a></li>
                @endif
                <li><a href="{!! url('/') !!}/logout">Sign Out</a></li>
                   
                
                <li><a href="javascript:void(0)">Help</a></li>
                @if(Auth::check() && Auth::user()->user_type ==1)
                   <li><a href="{!! url('/create_new_add') !!}" class="create-add-btn-property" data-userid="{{ Auth::user()->id }}">Offer Appartment</a></li>
                @endif   
            </ul>   
    </div>
   
    @else
      <div class="responsive-nav">
        <div class="close">
            <a href="javascript:void(0)" class="close-toggle-bar"><img src="{{ url('/') }}/images/close-btn.png"></a>  
        </div>
        <ul>
            <li><a href="#register_user" class="fancybox">register</a></li>
            <li><a href="#login"  class="fancybox">login</a></li>
            <li><a href="javascript:void(0)">help</a></li>
             <li><a href="#register"  class="fancybox">offer Apartment</a></li>
        </ul>    
    </div>
    @endif

    
    @if(Session::has('flash_message'))
    <div style="color: #5EC8D6;padding: 5px 0px;display: block;font-size: 14px;  font-weight: bold;" class="status-post-shared-response">{!! session('flash_message') !!}</div>
    <script>
    
        setTimeout(function() {
            $('.status-post-shared-response').empty();
                              }, 5000);
    </script>

    @endif

