@extends('frontend.layout.master')

@section('content')
<style type="text/css">
    .banner-content {
        margin-top: 180px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
$('#close-search-specific-page').hide();
$('#change-text-specific-page').html("DISCOVER HOW " + "<br />" + " APARTOLINO WORKS");
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
            	<h1 class="wow fadeIn" data-wow-duration="2s">Why work with APARTOLINO?</h1>
                <p class="wow fadeIn" data-wow-duration="2s">Your benefits when you advertise with APARTOLINO</p>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-4">
            	<div class="rent-box wow fadeIn" data-wow-duration="2s">
                	<img src="images/icon1.png" />
                    <h4>Targeted Approach</h4>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. </p>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="rent-box wow fadeIn" data-wow-duration="2s">
                	<img src="images/icon2.png" />
                    <h4>Fast Processing</h4>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. </p>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="rent-box wow fadeIn" data-wow-duration="2s">
                	<img src="images/icon3.png" />
                    <h4>Reduce your costs</h4>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. </p>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="savetime">
	<div class="container">
    	<div class="row">
        	<div class="col-md-6 col-xs-12 promo-img">
                <img src="images/APARTOLINO-Promo.png" alt="" />
            </div>
            <div class="col-md-6 col-xs-12">
            	<h1 class="wow fadeIn" data-wow-duration="2s">APARTOLINO HELPS YOU TO IMPROVE YOUR BUSINESS</h1>
            </div>
        </div>
    </div>
</div>

<div class="work_provide">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1 class="wow fadeIn" data-wow-duration="2s">How to start as a provider</h1>
                <p class="wow fadeIn" data-wow-duration="2s">In a few steps to the ad</p>
            </div>
        </div>
        <div class="how-to-book">
            <div class="row">
            	<div class="col-md-4">
                    <div class="circle wow fadeIn" data-wow-duration="2s">
                        <img src="images/Register-Icon.png">
                        <div class="circle-number">1</div>
                    </div>
                    <h1 class="wow fadeIn" data-wow-duration="2s">Register</h1>
                    <p class="wow fadeIn" data-wow-duration="2s">
                    Bei Serviced Apartments handelt es sich um die ,,goldene Mitte" zwichen den Freiheiten und dem komfort einer mobilerten Wohnung sowie der Sicherheit und dem Service (Reinigung, Check-In, Wascheservice, Wartung) eines Hotelaufenthalts. In einer vollausgestatteten wohnung mit kuche / Kitchenette sowie getrennten Wohn- und Schlafbereichen, meist inklusive Schreibtisch und WLAN, ist diese Ubernachtungslosung vor allem durch Monatsraten fur Projekt- und Langzeitgeschaftsreisende geeignet.
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="circle wow fadeIn" data-wow-duration="2s">
                        <img src="images/Verify-your-email.png">
                        <div class="circle-number">2</div>
                    </div>
                    <h1 class="wow fadeIn" data-wow-duration="2s">Verify your E-Mail</h1>
                    <p class="wow fadeIn" data-wow-duration="2s">
                    Bei Serviced Apartments handelt es sich um die ,,goldene Mitte" zwichen den Freiheiten und dem komfort einer mobilerten Wohnung sowie der Sicherheit und dem Service (Reinigung, Check-In, Wascheservice, Wartung) eines Hotelaufenthalts. In einer vollausgestatteten wohnung mit kuche / Kitchenette sowie getrennten Wohn- und Schlafbereichen, meist inklusive Schreibtisch und WLAN, ist diese Ubernachtungslosung vor allem durch Monatsraten fur Projekt- und Langzeitgeschaftsreisende geeignet.
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="circle wow fadeIn" data-wow-duration="2s">
                        <img src="images/Approved-Provider2.png">
                        <div class="circle-number">3</div>
                    </div>
                    <h1 class="wow fadeIn" data-wow-duration="2s">Get Approved</h1>
                    <p class="wow fadeIn" data-wow-duration="2s">
                    Bei Serviced Apartments handelt es sich um die ,,goldene Mitte" zwichen den Freiheiten und dem komfort einer mobilerten Wohnung sowie der Sicherheit und dem Service (Reinigung, Check-In, Wascheservice, Wartung) eines Hotelaufenthalts. In einer vollausgestatteten wohnung mit kuche / Kitchenette sowie getrennten Wohn- und Schlafbereichen, meist inklusive Schreibtisch und WLAN, ist diese Ubernachtungslosung vor allem durch Monatsraten fur Projekt- und Langzeitgeschaftsreisende geeignet.
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="circle wow fadeIn" data-wow-duration="2s">
                        <img src="images/Calendar-booking.png">
                        <div class="circle-number">4</div>
                    </div>
                    <h1 class="wow fadeIn" data-wow-duration="2s">Complete Account</h1>
                    <p class="wow fadeIn" data-wow-duration="2s">
                    Bei Serviced Apartments handelt es sich um die ,,goldene Mitte" zwichen den Freiheiten und dem komfort einer mobilerten Wohnung sowie der Sicherheit und dem Service (Reinigung, Check-In, Wascheservice, Wartung) eines Hotelaufenthalts. In einer vollausgestatteten wohnung mit kuche / Kitchenette sowie getrennten Wohn- und Schlafbereichen, meist inklusive Schreibtisch und WLAN, ist diese Ubernachtungslosung vor allem durch Monatsraten fur Projekt- und Langzeitgeschaftsreisende geeignet.
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="circle wow fadeIn" data-wow-duration="2s">
                        <img src="images/Add-Listing.png">
                        <div class="circle-number">5</div>
                    </div>
                    <h1 class="wow fadeIn" data-wow-duration="2s">Add Listings</h1>
                    <p class="wow fadeIn" data-wow-duration="2s">
                    Bei Serviced Apartments handelt es sich um die ,,goldene Mitte" zwichen den Freiheiten und dem komfort einer mobilerten Wohnung sowie der Sicherheit und dem Service (Reinigung, Check-In, Wascheservice, Wartung) eines Hotelaufenthalts. In einer vollausgestatteten wohnung mit kuche / Kitchenette sowie getrennten Wohn- und Schlafbereichen, meist inklusive Schreibtisch und WLAN, ist diese Ubernachtungslosung vor allem durch Monatsraten fur Projekt- und Langzeitgeschaftsreisende geeignet.
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="circle wow fadeIn" data-wow-duration="2s">
                        <img src="images/Get-bookings.png">
                        <div class="circle-number">6</div>
                    </div>
                    <h1 class="wow fadeIn" data-wow-duration="2s">Get Bookings</h1>
                    <p class="wow fadeIn" data-wow-duration="2s">
                    Bei Serviced Apartments handelt es sich um die ,,goldene Mitte" zwichen den Freiheiten und dem komfort einer mobilerten Wohnung sowie der Sicherheit und dem Service (Reinigung, Check-In, Wascheservice, Wartung) eines Hotelaufenthalts. In einer vollausgestatteten wohnung mit kuche / Kitchenette sowie getrennten Wohn- und Schlafbereichen, meist inklusive Schreibtisch und WLAN, ist diese Ubernachtungslosung vor allem durch Monatsraten fur Projekt- und Langzeitgeschaftsreisende geeignet.
                    </p>
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
