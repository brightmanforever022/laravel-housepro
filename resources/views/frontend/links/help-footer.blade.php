@extends('frontend.layout.master')

@section('content')
<style type="text/css">
    .banner-content {
        margin-top: 230px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
$('#close-search-specific-page').hide();
$('#change-text-specific-page').text("How can we help?");
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
                @foreach($rows as $key=>$value)
                @if($value['rows'] == 1)
                <h1 class="wow fadeIn" data-wow-duration="2s">{!! $value['title'] !!}</h1>
                <p class="wow fadeIn" data-wow-duration="2s">{!! $value['description'] !!}</p>
                @endif
                @endforeach
            </div>
        </div>
        <div class="faq">
            <div class="row">
                <div class="col-md-3 pull-right">
                    <div class="faq-right">
                        <h1 class="wow fadeIn" data-wow-duration="2s">Overview</h1>
                        <ul>
                            @foreach($rows as $key=>$value)
                            @if($value['rows'] == 2)
                            <li><a href="#{{$key}}">{!! $value['title'] !!}</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="faq-left">
                        <ul>
                            @foreach($rows as $key=>$value)
                            @if($value['rows'] == 2)
                            <li>
                                <a name="{{$key}}"></a>
                                <h1 class="wow fadeIn" data-wow-duration="2s">{!! $value['title'] !!}</h1>
                                <p class="wow fadeIn" data-wow-duration="2s">{!! $value['description'] !!}</p>
                            </li>
                            @endif
                            @endforeach
                            

                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>


@include('frontend.includes.popups')

@endsection
