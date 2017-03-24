@extends('frontend.layout.master')

@section('content')

<script>
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
@if(Auth::check() && Session::has('error'))
    $.fancybox([ { href : '#paypal_error_information_message' } ]);
@endif    
});
</script>

<div class="container how-to-book">
    <div class="row">
        <h1 class="how_title">Why APARTOLINO ?</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="iespecial"><img src="{!! url('/') !!}/images/globe.png"></div>
                <h1>Only audited providers</h1>
                <p>Every provider is checked by us which gurantees customer satisfaction of 95 %</p>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="iespecial"><img src="{!! url('/') !!}/images/thumb.png"></div>
                <h1>Book with confidence</h1>
                <p>Your payment is released only after receipt of your booked apartment</p>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="iespecial"><img src="{!! url('/') !!}/images/phone.png"></div>
                <h1>We are always there for you</h1>
                <p>Our customer service is available to you and help you with questions</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"><a href="{{ url('/')}}/how-to-book">HOW TO BOOK - READ HERE</a></div>
        </div>
    </div>
</div>

<div class="business_appartment">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1>Where do you want to go ?</h1>
                <p>Discover Business Apartments in all of Switzerland</p>
            </div>
        </div>
        <div class="row mar-t30" id="div_append_city">
            @foreach($cities as $key=>$value)
            @if($key <= 5)
            <?php 
                $city_title = $value['title'];
                $city_price = DB::table('properties')->where('plz_place', 'like', '%' . $city_title . '%')->where('price_per_night', DB::raw("(select min(`price_per_night`) from properties where plz_place like '%" . $city_title . "%')"))->get();
                // print_r($city_price[0]->price_per_night);exit();
            ?>
            <div class="col-md-4 col-sm-6">
                <a target="_blank" href="{{ url('/') }}/search_home_link?address={{ $value['title'] }}">
                    <figure>
                        <img src="{!! url('/') !!}/cities/{{$value['logo']}}" class="grayscale grayscale-fade"/>
                        <span class="city_price">{{ $value['title'] }} ab CHF @if(count($city_price)>0) {{ $city_price[0]->price_per_night }} @endif</span>
                        <h5>{{ $value['description'] }}</h5>
                    </figure>
                </a>
            </div>
            @endif
            @endforeach

        	
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="javascript:void(0)" id="loadCity" class="see_more_btn wow fadeIn" data-wow-duration="2s">SEE MORE CITIES</a>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<div class="latest_offer">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1>Latest Apartments</h1>
                <p class="offer_small_title">Discover the latest offers</p>
            </div>
        </div>
        <div class="row mar-t30">
            @foreach($properties as $key=>$property)
            @if($key == 3)
            
            <div class="col-md-8 col-sm-6 post__image-container texthover-home">
                <a target="_blank" href="{{ url('/')}}/single/{{ $property->id }}">
                    <figure>
                        @if(count($property->images)!= 0)
                        <img src="{!! url('/') !!}/images/thumb/{{$property->images[0]->path}}" class="grayscale grayscale-fade"/>
                        @else
                        <img src="" class="grayscale grayscale-fade post__featured-image" alt="Images Not Found"/>
                        @endif
                        
                    </figure>
                    <p>CHF {{ $property->price_per_night }}</p>
                    <h6 class="titile-property"><!-- Very comfortable and cosy apartment -->{{ str_limit($property->title, $limit=30, $end="...") }}</h6>
                    <?php 
                    $property_type = \App\PropertyType::where('id', $property->property_type_id)->get();
                    ?>
                    <p class="accomo">{{ $property_type[0]->name }} in {{ $property->plz_place}}</p>
                </a>
            </div>
            @else

            <div class="col-md-4 col-sm-6 post__image-container texthover-home">
                <a target="_blank" href="{{ url('/')}}/single/{{ $property->id }}">
                    <figure>
                        @if(count($property->images)!= 0)
                        <img src="{!! url('/') !!}/images/thumb/{{$property->images[0]->path}}" class="grayscale grayscale-fade"/>
                        @else
                        <img src="" class="grayscale grayscale-fade post__featured-image" alt="Images Not Found"/>
                        @endif
                    </figure>
                    <p>CHF {{ $property->price_per_night }}</p>
                    <h6 class="titile-property"><!-- Very comfortable and cosy apartment -->{{ str_limit($property->title, $limit=30, $end="...") }}</h6>
                    <?php 
                    $property_type = \App\PropertyType::where('id', $property->property_type_id)->get();
                    ?>
                    <p class="accomo">{{ $property_type[0]->name }} in {{ $property->plz_place}}</p>
                </a>
            </div>
            @endif
            @endforeach
            
        </div>
   </div>
</div>
<div class="clearfix"></div>
@include('frontend.includes.about-us')
@include('frontend.includes.popups')

@endsection

