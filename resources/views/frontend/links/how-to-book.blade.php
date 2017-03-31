@extends('frontend.layout.master')

@section('content')
<style type="text/css">
    .banner-content {
        margin-top: 230px;
    }
    p.how-to-book-content{
        margin-bottom: 100px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
$('#close-search-specific-page').hide();
$('#change-text-specific-page').text("HOW TO BOOK");
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
<div class="rent pad-b10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach($rows as $key=>$value)
                @if($value['rows'] == 1)
                <h1 class="wow fadeIn" data-wow-duration="2s">{!! $value['title'] !!}</h1>
                <p class="how-to-book-content wow fadeIn" data-wow-duration="2s">{!! $value['description'] !!}</p>
                @endif
                @endforeach
            </div>
        </div>
        <div class="how-to-book">
            <div class="row">
                @foreach($rows as $key=>$value)
                @if($value['rows'] == 2)
                <div class="col-md-4">
                    <div class="circle wow fadeIn" data-wow-duration="2s">
                        <img src="images/{{$value['logo']}}">
                        <div class="circle-number">{{$key+0}}</div>
                    </div>
                    <h1 class="wow fadeIn" data-wow-duration="2s">{!! $value['title'] !!}</h1>
                    <p class="wow fadeIn" data-wow-duration="2s">{!! $value['description'] !!}</p>
                     @if($value['id'] == 4)
                      <img class="paypall" src="images/paypall.png">
                     @endif
                </div>
                @endif
                @endforeach
                <!-- <div class="col-md-4">
                    <div class="circle wow fadeIn" data-wow-duration="2s">
                        <img src="images/how-to-book-2.png">
                        <div class="circle-number">2</div>
                    </div>
                    <h1 class="wow fadeIn" data-wow-duration="2s">Book your favourite</h1>
                    <p class="wow fadeIn" data-wow-duration="2s">Bei Serviced Apartments handelt es sich um die „goldene Mitte“ zwischen den Freiheiten und dem Komfort einer möblierten Wohnung sowie der Sicherheit und dem Service (Reinigung, Check-In, Wäscheservice, Wartung) eines Hotelaufenthalts. In einer vollausgestatteten Wohnung mit Küche / Kitchenette sowie getrennten Wohn- und Schlafbereichen, meist inklusive Schreibtisch und WLAN, ist diese Übernachtungslösung vor allem durch Monatsraten für Projekt- und Langzeitgeschäftsreisende geeignet.</p>
                </div>
                <div class="col-md-4">
                    <div class="circle wow fadeIn" data-wow-duration="2s">
                        <img src="images/how-to-book-3.png">
                        <div class="circle-number">3</div>
                    </div>
                    <h1 class="wow fadeIn" data-wow-duration="2s">Only pay deposit</h1>
                    <p class="wow fadeIn" data-wow-duration="2s">Bei Serviced Apartments handelt es sich um die „goldene Mitte“ zwischen den Freiheiten und dem Komfort einer möblierten Wohnung sowie der Sicherheit und dem Service (Reinigung, Check-In, Wäscheservice, Wartung) eines Hotelaufenthalts. In einer vollausgestatteten Wohnung mit Küche / Kitchenette sowie getrennten Wohn- und Schlafbereichen, meist inklusive Schreibtisch und WLAN, ist diese Übernachtungslösung vor allem durch Monatsraten für Projekt- und Langzeitgeschäftsreisende geeignet.</p>
                    <img src="images/paypall.png">
                </div> -->
            </div>
        </div>
    </div>
    
</div>
<div class="how-to-book how-to-book-grey">
        <div class="container">
            <div class="row">
                @foreach($rows as $key=>$value)
                @if($value['rows'] == 3)
                <div class="col-md-4">
                    <div class="circle wow fadeIn" data-wow-duration="2s">
                        <img src="images/{{$value['logo']}}">
                        <div class="circle-number">{{$key+0}}</div>
                    </div>
                    <h1 class="wow fadeIn" data-wow-duration="2s">{!! $value['title'] !!}</h1>
                    <p class="wow fadeIn" data-wow-duration="2s">{!! $value['description'] !!}</p>
                </div>
                @endif
                @endforeach
                <!-- <div class="col-md-4">
                    <div class="circle wow fadeIn" data-wow-duration="2s">
                        <img src="images/how-to-book-5.png">
                        <div class="circle-number">5</div>
                    </div>
                    <h1 class="wow fadeIn" data-wow-duration="2s">Get pdf confirmation/ivoice</h1>
                    <p class="wow fadeIn" data-wow-duration="2s">Bei Serviced Apartments handelt es sich um die „goldene Mitte“ zwischen den Freiheiten und dem Komfort einer möblierten Wohnung sowie der Sicherheit und dem Service (Reinigung, Check-In, Wäscheservice, Wartung) eines Hotelaufenthalts. In einer vollausgestatteten Wohnung mit Küche / Kitchenette sowie getrennten Wohn- und Schlafbereichen, meist inklusive Schreibtisch und WLAN, ist diese Übernachtungslösung vor allem durch Monatsraten für Projekt- und Langzeitgeschäftsreisende geeignet.</p>
                </div>
                <div class="col-md-4">
                    <div class="circle wow fadeIn" data-wow-duration="2s">
                        <img src="images/how-to-book-6.png">
                        <div class="circle-number">6</div>
                    </div>
                    <h1 class="wow fadeIn" data-wow-duration="2s">Handover by provider</h1>
                    <p class="wow fadeIn" data-wow-duration="2s">Bei Serviced Apartments handelt es sich um die „goldene Mitte“ zwischen den Freiheiten und dem Komfort einer möblierten Wohnung sowie der Sicherheit und dem Service (Reinigung, Check-In, Wäscheservice, Wartung) eines Hotelaufenthalts. In einer vollausgestatteten Wohnung mit Küche / Kitchenette sowie getrennten Wohn- und Schlafbereichen, meist inklusive Schreibtisch und WLAN, ist diese Übernachtungslösung vor allem durch Monatsraten für Projekt- und Langzeitgeschäftsreisende geeignet.</p>

                </div> -->
            </div>
        </div>
    </div>

@include('frontend.includes.popups')

@endsection
