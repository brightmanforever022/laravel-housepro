 
<header class="bg_white">
    <div class="row">
        <div class="col-lg-2 col-sm-4 col-xs-9 ">
            <div class="logo"><a href="{{ url('/') }}"><img src="{{ url('/') }}/images/logo-black.png" /></a></div>
        </div>
        <div class="col-lg-4 hidden-xs hidden-md hidden-sm">
        	<p>Rent unique accomodation of professional providers.</p>
        </div>
        <div class="col-lg-6 col-sm-8 col-xs-3">
            <div class="main-nav ">
                <ul>
                    @if(Auth::check() && Auth::user() && Auth::user()->path == "" )
                    @if(Auth::check() && Auth::user()->user_type ==1)
                    <li class="after-login"><a href="javasrcipt:void()" id="href_fesh1"><img src="{{ url('/') }}/images/img.png" />{{Auth::user()->company}}</a>
                    @else
                    <li class="after-login"><a href="javasrcipt:void()" id="href_fesh1"><img src="{{ url('/') }}/images/img.png" />{{Auth::user()->name}} {{Auth::user()->surname}}</a>
                    @endif
                    @elseif(Auth::check() && Auth::user() && Auth::user()->user_type ==1)
                    <li class="after-login"><a href="javasrcipt:void()" id="href_fresh2"><img src="{{ url('/') }}/profilepics/{!! Auth::user()->path !!}" />{{Auth::user()->company}}</a>
                    @elseif(Auth::check())
                    <li class="after-login"><a href="javasrcipt:void()" id="href_fresh2"><img src="{{ url('/') }}/profilepics/{!! Auth::user()->path !!}" />{{Auth::user()->name}} {{Auth::user()->surname}}</a>
                    @endif

                        <div class="login_dropdown">
                            <ul>
                                 @if(Auth::user() && Auth::user()->user_type ==1)

                                <li><a href="{!! url('/provider-dashboard') !!}" >Dashboard</a></li>
                                <li><a href="{!! url('/create_new_add') !!}" class="create-add-btn-property"  data-userid="{{ Auth::user()->id }}">Add Listing</a></li>
                                <li><a href="{{ url('/listing') }}">My Listings</a></li>
                                <li><a href="{{ url('/edit-profile-host') }}">Edit Profile/Account</a></li>
                                <li><a href="{{ url('/booking') }}">Bookings</a></li>
                                @else
                                <li><a href="{{ url('/edit-profile-tenant') }}">Edit Profile/Account</a></li>
                                <li><a href="{{ url('/booking-tenant') }}">Bookings</a></li>
                                <li><a href="{{ url('/favorites') }}">My Favorites</a></li>
                                @endif
                                <li><a href="{{ url('/logout') }}">Sign Out</a></li>
                            </ul>
                        </div>
                    </li>
                        @if(!Auth::check())
                        <li><a href="#register_user" class="fancybox">Register</a></li>
                        <li><a href="#login" class="fancybox">Log-in</a></li>
                        @endif
                        
                        @if(Auth::check() && Auth::user()->user_type == 1)
                         <li><a href="{{ url('/')}}/how-it-work">Help</a></li>
                         <li><a href="{{url('/')}}/create_new_add" class="create-add-btn-property" data-userid="{{ Auth::user()->id }}">Offer Apartment
                        @else
                        <li><a href="{{ url('/')}}/how-to-book">Help</a></li>
                        @endif
                </ul>
            </div>
            <div class="res-nav top15">
                <a href="javascript:void(0)" style="color: #333"><i class="fa fa-bars"></i></a>
            </div>
        </div>
    </div>
</header>
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
                <li><a href="{{ url('/listing') }}">My Listings</a></li>
                <li><a href="{{ url('/edit-profile-host') }}">Edit Profile/Account</a></li>
                <li><a href="{{ url('/booking') }}">Bookings</a></li>
                @else(Auth::user() && Auth::user()->user_type ==0)
                <li><a href="{{ url('/edit-profile-tenant') }}">Edit Profile/Account</a></li>
                <li><a href="{{ url('/booking-tenant') }}">Bookings</a></li>
                <li><a href="{{ url('/favorites') }}">My Favorites</a></li>
                @endif
                <li><a href="{!! url('/') !!}/logout">Sign Out</a></li>
                   
                
                <li><a href="javascript:void(0)">Help</a></li>
                @if(Auth::check() && Auth::user()->user_type == 1)
                  <li><a href="{{url('/')}}/create_new_add"  class="create-add-btn-property"  data-userid="{{ Auth::user()->id }}">Offer Appartment</a></li>
                @endif

            </ul>   
    </div>
   
    @else
      <div class="responsive-nav">
        <div class="close">
            <a href="javascript:void(0)" class="close-toggle-bar"><img src="{{ url('/') }}/images/close-btn.png"></a>  
        </div>
        <ul>
            <li><a href="javascript:void(0)">register</a></li>
            <li><a href="#login"  class="fancybox">login</a></li>
            <li><a href="javascript:void(0)">help</a></li>
             <li><a href="#register"  class="fancybox">offer Apartment</a></li>
        </ul>    
    </div>
    @endif
    @if(Auth::check())
<div class="menu">
	<div class="container">
    	<div class="row">
            @if(Auth::check())
        	<div class="col-md-8">
                @if(Request::segment(1) == 'provider-dashboard' && Auth::user()->user_type == 1)
            	<ul>
                    <li class="active"><a  href="{!! url('/provider-dashboard') !!}">Dashboard</a></li>
                	<li><a href="{!! url('/create_new_add') !!}" class="create-add-btn-property"  data-userid="{{ Auth::user()->id }}">Add Listing</a></li>
                    <li><a href="{{ url('/listing') }}">My Listings</a></li>
                    <li><a href="{{ url('/edit-profile-host') }}">Edit Profile/Account</a></li>
                    <li><a href="{{ url('/booking') }}">Bookings</a><div class="circle-red-booking">{{$count_new_bookings}}</div></li>
                    <li><a href="{{ url('/logout') }}">Sign Out</a></li>
                </ul>
                @elseif(Request::segment(1) == 'listing' && Auth::user()->user_type == 1)
                <ul>
                    <li><a  href="{!! url('/provider-dashboard') !!}" >Dashboard</a></li>
                    <li><a href="{!! url('/create_new_add') !!}" class="create-add-btn-property"  data-userid="{{ Auth::user()->id }}">Add Listing</a></li>
                    <li class="active"><a href="{{ url('/listing') }}">My Listings</a></li>
                    <li><a href="{{ url('/edit-profile-host') }}">Edit Profile/Account</a></li>
                    <li><a href="{{ url('/booking') }}">Bookings</a><div class="circle-red-booking">{{$count_new_bookings}}</div></li>
                    <li><a href="{{ url('/logout') }}">Sign Out</a></li>
                </ul>
                @elseif(Request::segment(1) == 'booking' && Auth::user()->user_type == 1)
                <ul>
                    <li><a  href="{!! url('/provider-dashboard') !!}" >Dashboard</a></li>
                    <li><a href="{!! url('/create_new_add') !!}" class="create-add-btn-property"  data-userid="{{ Auth::user()->id }}">Add Listing</a></li>
                    <li><a href="{{ url('/listing') }}">My Listings</a></li>
                    <li><a href="{{ url('/edit-profile-host') }}">Edit Profile/Account</a></li>
                    <li class="active"><a href="{{ url('/booking') }}">Bookings</a><div class="circle-red-booking">{{$count_new_bookings}}</div></li>
                    <li><a href="{{ url('/logout') }}">Sign Out</a></li>
                </ul>
                @elseif(Request::segment(1) == 'booking-reject' && Auth::user()->user_type == 1)
                <ul>
                    <li><a  href="{!! url('/provider-dashboard') !!}" >Dashboard</a></li>
                    <li><a href="{!! url('/create_new_add') !!}" class="create-add-btn-property"  data-userid="{{ Auth::user()->id }}">Add Listing</a></li>
                    <li><a href="{{ url('/listing') }}">My Listings</a></li>
                    <li><a href="{{ url('/edit-profile-host') }}">Edit Profile/Account</a></li>
                    <li class="active"><a href="{{ url('/booking') }}">Bookings</a><div class="circle-red-booking">{{$count_new_bookings}}</div></li>
                    <li><a href="{{ url('/logout') }}">Sign Out</a></li>
                </ul>
                @elseif(Request::segment(1) == 'booking-adopt' && Auth::user()->user_type == 1)
                <ul>
                    <li><a  href="{!! url('/provider-dashboard') !!}" >Dashboard</a></li>
                    <li><a href="{!! url('/create_new_add') !!}" class="create-add-btn-property"  data-userid="{{ Auth::user()->id }}">Add Listing</a></li>
                    <li><a href="{{ url('/listing') }}">My Listings</a></li>
                    <li><a href="{{ url('/edit-profile-host') }}">Edit Profile/Account</a></li>
                    <li class="active"><a href="{{ url('/booking') }}">Bookings</a><div class="circle-red-booking">{{$count_new_bookings}}</div></li>
                    <li><a href="{{ url('/logout') }}">Sign Out</a></li>
                </ul>
                  @elseif(Request::segment(1) == 'create_new_add' && Auth::user()->user_type == 1)
                <ul>
                    <li><a  href="{!! url('/provider-dashboard') !!}" >Dashboard</a></li>
                    <li class="active" ><a href="{!! url('/create_new_add') !!}" class="create-add-btn-property"  data-userid="{{ Auth::user()->id }}">Add Listing</a></li>
                    <li><a href="{{ url('/listing') }}">My Listings</a></li>
                    <li><a href="{{ url('/edit-profile-host') }}">Edit Profile/Account</a></li>
                    <li ><a href="{{ url('/booking') }}">Bookings</a><div class="circle-red-booking">{{$count_new_bookings}}</div></li>
                    <li><a href="{{ url('/logout') }}">Sign Out</a></li>
                </ul>
                @else
                <ul>
                    @if(Auth::user() && Auth::user()->user_type ==1)
                    <li><a href="{!! url('/provider-dashboard') !!}" >Dashboard</li>
                    <li><a href="{!! url('/create_new_add') !!}" class="create-add-btn-property"  data-userid="{{ Auth::user()->id }}">Add Listing</a></li>
                    <li><a href="{{ url('/listing') }}">My Listings</a></li>
                    @if((\Request::route()->getName() != 'search_search') && (\Request::route()->getName() != 'search') && (\Request::route()->getName() != 'search_home_link') && (substr(Route::getCurrentRoute()->getPath(),0,6) != 'single'))
                    <li class="active"><a href="{{ url('/edit-profile-host') }}">Edit Profile/Account</a></li>
                    @else
                    <li><a href="{{ url('/edit-profile-host') }}">Edit Profile/Account</a></li>
                    @if(Auth::user() && Auth::user()->user_type ==0)
                    <li><a href="{{ url('/booking-tenant') }}">Bookings</a></li>
                    @endif
                    @endif
                    <li><a href="{{ url('/booking') }}">Bookings</a><div class="circle-red-booking">{{$count_new_bookings}}</div></li>
                    <li><a href="{{ url('/logout') }}">Sign Out</a></li>
                    @elseif(Auth::user() && Request::segment(1) == 'booking-tenant')
                    <li><a href="{{ url('/edit-profile-tenant') }}">Edit Profile/Account</a></li>
                    <li class="active"><a href="{{ url('/booking-tenant') }}">Bookings</a></li>
                    <li><a href="{{ url('/favorites') }}">My Favorites</a></li>
                    <li><a href="{{ url('/logout') }}">Sign Out</a></li>
                    @elseif(Auth::user() && Request::segment(1) == 'edit-profile-tenant')
                        <li class="active"><a href="{{ url('/edit-profile-tenant') }}">Edit Profile/Account</a></li>
                        <li><a href="{{ url('/booking-tenant') }}">Bookings</a></li>
                        <li><a href="{{ url('/favorites') }}">My Favorites</a></li>
                        <li><a href="{{ url('/logout') }}">Sign Out</a></li>
                    @elseif(Auth::user() && Request::segment(1) == 'favorites')
                        <li><a href="{{ url('/edit-profile-tenant') }}">Edit Profile/Account</a></li>
                        <li><a href="{{ url('/booking-tenant') }}">Bookings</a></li>
                        <li class="active"><a href="{{ url('/favorites') }}">My Favorites</a></li>
                        <li><a href="{{ url('/logout') }}">Sign Out</a></li>
                    @elseif(Auth::user() && Request::segment(1) == 'search')
                        <li><a href="{{ url('/edit-profile-tenant') }}">Edit Profile/Account</a></li>
                        <li><a href="{{ url('/booking-tenant') }}">Bookings</a></li>
                        <li><a href="{{ url('/favorites') }}">My Favorites</a></li>
                        <li><a href="{{ url('/logout') }}">Sign Out</a></li>
                    @elseif(Auth::user() && Request::segment(1) == 'single')
                        <li><a href="{{ url('/edit-profile-tenant') }}">Edit Profile/Account</a></li>
                        <li><a href="{{ url('/booking-tenant') }}">Bookings</a></li>
                        <li><a href="{{ url('/favorites') }}">My Favorites</a></li>
                        <li><a href="{{ url('/logout') }}">Sign Out</a></li>
                     @endif
                </ul>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@endif