
 @if(Auth::user())
 <script>
 $('#href-varias').click(function(e)
 {
    e.preventDefault();
 });
 </script>
<header>
        <div class="row">
            <div class="col-sm-3 col-xs-9">
                <div class="logo"><a href="{{ url('/') }}"><img src="{{ url('/') }}/images/apartlino-logo.png" /></a></div>
            </div>
            <div class="col-sm-9 col-xs-3">
                <div class="main-nav home">
                    <ul>
                    @if(Auth::user() && Auth::user()->path == "" )
                    @if(Auth::user()->user_type ==1)
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
                                 <li><a href="{!! url('/provider-dashboard') !!}" >Dashboard</a></li>
                                <li><a href="{!! url('/create_new_add') !!}" class="create-add-btn-property" data-userid="{{ Auth::user()->id }}">Add Listing</a></li>
                                <li><a href="{{ url('/listing') }}">My Listing</a></li>
                                <li><a href="{{ url('/edit-profile-host') }}">Edit Profile/Account</a></li>
                                <li><a href="{{ url('/booking') }}">Bookings</a></li>
                                @else
                                 <li><a href="{{ url('/edit-profile-tenant') }}">Edit Profile/Account</a></li>
                                 <li><a href="{{ url('/booking-tenant') }}">Booking</a></li>
                                 <li><a href="{{ url('/favorites') }}">My Favorites</a></li>
                                @endif

                                <li><a href="{!! url('/') !!}/logout">Sign Out</a></li>
                               </ul>
                            </div>   
                                </li>
                                @if(Auth::check() && Auth::user()->user_type == 1)
                                <li><a href="{{ url('/')}}/how-it-work">Help</a></li>
                                @else
                                <li><a href="{{ url('/')}}/how-to-book">Help</a></li>
                                @endif
                                @if(Auth::check() && Auth::user()->user_type == 1)
                                <li><a href="{{url('/')}}/create_new_add" class="create-add-btn-property" data-userid="{{ Auth::user()->id }}">Offer Appartment</a></li>
                                @endif
                    </ul>
                </div>
            </div>
        <div class="res-nav res-top">
                    <a href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                 </div>
        </div>
        
</header>
 @else
  <header>
        <div class="row">
        @if ($errors->has('email'))
            <span class="help-block errorMessage">
            <strong style="color:red">{{ $errors->first('email') }}</strong>
            </span>
        @endif
            <div class="col-sm-3 col-xs-9">
                <div class="logo"><a href="{{ url('/') }}"><img src="{{ url('/') }}/images/apartlino-logo.png" /></a></div>
            </div>
            <div class="col-sm-9 col-xs-3">
                <div class="main-nav css-before-login">
                    <ul>
                        <li><a href="#register_user" class="fancybox">Register</a></li>
                        <li><a href="#login" class="fancybox">Log-in</a></li>
                        <li><a href="{{ url('/')}}/how-to-book">Help</a></li>
                        <li class="offer-apartment"><a href="#register" class="fancybox">Offer Apartment</a></li>
                       </ul>
                </div>
                <div class="res-nav">
                    <a href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                 </div>
            </div>
        </div>
</header>
@endif

    @if(Auth::user())
    <div class="responsive-nav">
        <div class="close">
            <a href="javascript:void(0)" class="close-toggle-bar"><img src="{{ url('/') }}/images/close-btn.png"></a>  
        </div>
        <ul>
            @if(Auth::user()->user_type == 1)
            <li class="after-login"><a href="javascript:void(0)">{{Auth::user()->company}}</a></li>
            @elseif(Auth::user())
            <li class="after-login"><a href="javascript:void(0)">{{Auth::user()->name}} {{Auth::user()->surname}}</a></li>
            @endif
            

                @if(Auth::user() && Auth::user()->user_type ==1)
                 <li><a href="{!! url('/provider-dashboard') !!}" >Dashboard</a></li>
                <li><a href="{!! url('/create_new_add') !!}" class="create-add-btn-property"  data-userid="{{ Auth::user()->id }}">Add Listing</a></li>
                <li><a href="{{ url('/listing') }}">My Listing</a></li>
                <li><a href="{{ url('/edit-profile-host') }}">Edit Profile/Account</a></li>
                <li><a href="{{ url('/booking') }}">Bookings</a></li>
                @else(Auth::user() && Auth::user()->user_type ==0)
                <li><a href="{{ url('/edit-profile-tenant') }}">Edit Profile/Account</a></li>
                <li><a href="{{ url('/booking-tenant') }}">Booking</a></li>
                <li><a href="{{ url('/favorites') }}">My Favorites</a></li>
                @endif
                <li><a href="{!! url('/') !!}/logout">Sign Out</a></li>
                   
                
                <li><a href="{{ url('/')}}/how-to-book">Help</a></li>
                @if(Auth::check() && Auth::user()->user_type == 1)
                  <li><a href="{{url('/')}}/create_new_add" class="create-add-btn-property" data-userid="{{ Auth::user()->id }}">Offer Appartment</a></li>
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
            <li><a href="{{ url('/')}}/how-to-book">help</a></li>
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
