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
                <h1 class="wow fadeIn" data-wow-duration="2s">FAQ</h1>
                <p class="wow fadeIn" data-wow-duration="2s">Please find all frequently asked questions here.<br>If you need more support, please contact us.</p>
            </div>
        </div>
        <div class="faq">
            <div class="row">
                <div class="col-md-9">
                    <div class="faq-left">
                        <ul>
                            <li>
                                <h1 class="wow fadeIn" data-wow-duration="2s">Who is offering apartments?</h1>
                                <p class="wow fadeIn" data-wow-duration="2s">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
</p>
                            </li>
                            <li>
                                <h1 class="wow fadeIn" data-wow-duration="2s">How can i do a booking?</h1>
                                <p class="wow fadeIn" data-wow-duration="2s">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
</p>
                            </li>
                            <li>
                                <h1 class="wow fadeIn" data-wow-duration="2s">How does the payment working?</h1>
                                <p class="wow fadeIn" data-wow-duration="2s">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
</p>
                            </li>
                            <li>
                                <h1 class="wow fadeIn" data-wow-duration="2s">Can i do cancel booking?</h1>
                                <p class="wow fadeIn" data-wow-duration="2s">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
</p>
                            </li>
                            <li>
                                <h1 class="wow fadeIn" data-wow-duration="2s">What can i do if iam not satisfied with apartment?</h1>
                                <p class="wow fadeIn" data-wow-duration="2s">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
</p>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="faq-right">
                        <h1 class="wow fadeIn" data-wow-duration="2s">Overview</h1>
                        <ul>
                            <li><a href="">Who is offering apartments</a></li>
                            <li><a href="">How can i do a booking</a></li>
                            <li><a href="">How does the payment working</a></li>
                            <li><a href="">Can i do cancel booking?</a></li>
                            <li><a href="">What happens if iam not satisfied?</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('frontend.includes.popups')

@endsection
