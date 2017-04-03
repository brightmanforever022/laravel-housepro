@extends('frontend.layout.master')

@section('content')
<script type="text/javascript">
    $(document).ready(function() {

setTimeout(function() {
            $('.errorMessage').fadeOut('fast');
            }, 10000);
@if(Auth::check())
var user_type = {{ Auth::user()->user_type }};
var path = "{{ Auth::user()->path }}";
var paypal_email = "{{ Auth::user()->paypal_email }}";

if(user_type == 1 )
{
   if(path == "" || paypal_email == "")
   {
     $.fancybox([ { href : '#welcome-to-appartolino' } ]);
   }
}
@endif
});
</script>
<div class="rent">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1 class="wow fadeIn" data-wow-duration="2s">Rent efficiency with APARTOLINO</h1>
                <p class="wow fadeIn" data-wow-duration="2s">Your benefits when you advertise with APARTOLINO</p>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-4">
            	<div class="rent-box wow fadeIn" data-wow-duration="2s">
                	<img src="images/icon1.png" />
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. </p>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="rent-box wow fadeIn" data-wow-duration="2s">
                	<img src="images/icon2.png" />
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. </p>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="rent-box wow fadeIn" data-wow-duration="2s">
                	<img src="images/icon3.png" />
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. </p>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="savetime">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1 class="wow fadeIn" data-wow-duration="2s">APARTOLINO HELPS YOU TO IMPROVE YOUR BUSINESS</h1>
            </div>
        </div>
    </div>
</div>

<div class="work_provide">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1 class="wow fadeIn" data-wow-duration="2s">How this work for providers</h1>
                <p class="wow fadeIn" data-wow-duration="2s">In a few steps to the ad</p>
            </div>
        </div>
        
        <div class="row">
        	<div class="col-md-4">
            	<div class="work_provide_box wow fadeIn" data-wow-duration="2s">
                	<img src="images/login.png" />
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. </p>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="work_provide_box wow fadeIn" data-wow-duration="2s">
                	<img src="images/add-listings.png" />
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="work_provide_box wow fadeIn" data-wow-duration="2s">
                	<img src="images/getbooking.png" />
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="providers">
	<div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="wow fadeIn" data-wow-duration="2s">Providers already Benefits</h1>
                <p class="wow fadeIn" data-wow-duration="2s">Benefit from the large audience</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="flexslider">
                      <ul class="slides">
                            
                            <li>
                                <table>
                                    <tr>
                                        <td><img src="images/logo1.jpg" /></td>
                                        <td><img src="images/logo3.jpg" /></td>
                                        <td><img src="images/logo4.jpg" /></td>
                                    </tr>
                                    <tr>
                                        <td><img src="images/logo2.jpg" /></td>
                                        <td><img src="images/logo5.jpg" /></td>
                                        <td><img src="images/logo6.jpg" /></td>
                                    </tr>
                                </table>
                            </li>
                            
                            <li>
                                <table>
                                    <tr>
                                        <td><img src="images/logo1.jpg" /></td>
                                        <td><img src="images/logo3.jpg" /></td>
                                        <td><img src="images/logo4.jpg" /></td>
                                    </tr>
                                    <tr>
                                        <td><img src="images/logo2.jpg" /></td>
                                        <td><img src="images/logo5.jpg" /></td>
                                        <td><img src="images/logo6.jpg" /></td>
                                    </tr>
                                </table>
                            </li>
                            
                      </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@include('frontend.includes.popups')

@endsection
