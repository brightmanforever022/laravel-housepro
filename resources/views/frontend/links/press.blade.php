@extends('frontend.layout.master')
 
@section('content')
<script type="text/javascript">
    $(document).ready(function() {
$('#close-search-specific-page').hide();
$('#change-text-specific-page').text("Press");
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
        <div class="row">
            <div class="col-md-3 pull-right">
                <?php
                $users = \App\User::where('id', 49)->get()->toArray();
                if(count($users))
                {
                ?>
                <div class="short-profile-right">
                    <h1 class="wow fadeIn" data-wow-duration="2s">Contact</h1>
                    <h2 class="wow fadeIn" data-wow-duration="2s">{{$users[0]['company']}}</h2>
                    <p class="wow fadeIn" data-wow-duration="2s">{{$users[0]['address']}}</p>
                    <p class="wow fadeIn" data-wow-duration="2s">{{$users[0]['place']}}</p>
                    <p class="wow fadeIn" data-wow-duration="2s">Switzerland</p>
                    <div class="row mar-tb50">
                        <div class="col-md-3 col-sm-2 col-xs-2">
                            <img class="img-circle" src="{{ url('/')}}/profilepics/{!! $users[0]['path'] !!}">
                        </div>
                        <div class="col-md-9 col-sm-10 col-xs-10">
                            <p class="wow fadeIn" data-wow-duration="2s">{{$users[0]['name']}} {{$users[0]['surname']}}<span>PR Manager</span></p>
                            <a href="" class="wow fadeIn" data-wow-duration="2s">{{$users[0]['email']}}</a>
                        </div>
                    </div>
                    <h1>Downloads</h1>
                    <div class="downloads-pdf">
                        <ul>
                            @if($value['rows'] == 4)
                            
                            <li class="wow fadeIn" data-wow-duration="2s"><a href="{{url('/')}}/downLoadLogo/<?=$value['title']?>">Logo <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></li>
                            <li class="wow fadeIn" data-wow-duration="2s"><a href="{{url('/')}}/downLoadLogo/<?=$value['description']?>">Management <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></li>
                            <li class="wow fadeIn" data-wow-duration="2s"><a href="{{url('/')}}/downLoadLogo/<?=$value['logo']?>">Press Release <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <?php 
                }else {
                ?>
                <div class="short-profile-right">
                    <h1 class="wow fadeIn" data-wow-duration="2s">Contact</h1>
                    <h2 class="wow fadeIn" data-wow-duration="2s">APARTOLINO GmbH</h2>
                    <p class="wow fadeIn" data-wow-duration="2s">Zürcherstrasse 137</p>
                    <p class="wow fadeIn" data-wow-duration="2s">8406 Winterthur</p>
                    <p class="wow fadeIn" data-wow-duration="2s">Switzerland</p>
                    <div class="row mar-tb50">
                        <div class="col-md-3 col-sm-2 col-xs-2">
                            <img class="img-circle" src="http://localhost/apartolino1/public/profilepics/Singh1466161398.jpg">
                        </div>
                        <div class="col-md-9 col-sm-10 col-xs-10">
                            <p class="wow fadeIn" data-wow-duration="2s">Raphael Michel<span>PR Manager</span></p>
                            <a href="" class="wow fadeIn" data-wow-duration="2s">support@apartolino.ch</a>
                        </div>
                    </div>
                    <h1>Downloads</h1>
                    <div class="downloads-pdf">
                        <ul>
                            @if($value['rows'] == 4)
                            
                            <li class="wow fadeIn" data-wow-duration="2s"><a href="{{url('/')}}/downLoadLogo/<?=$value['title']?>">Logo</a></li>
                            <li class="wow fadeIn" data-wow-duration="2s"><a href="{{url('/')}}/downLoadLogo/<?=$value['description']?>">Managment</a></li>
                            <li class="wow fadeIn" data-wow-duration="2s"><a href="{{url('/')}}/downLoadLogo/<?=$value['logo']?>">Press Release</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="col-md-9 pull-left">
                <div class="short-profile">

                    @foreach($rows as $key=>$value)
                    @if($value['rows'] == 2)
                    <p class="wow fadeIn" data-wow-duration="2s">{!! $value['description'] !!}</p>
                    @endif
                    @endforeach
                    <hr>

                    <h1 class="wow fadeIn" data-wow-duration="2s">PRESS REVIEW</h1>

                    <ul id="div-append">
                        @foreach($rows as $key=>$value)
                        @if($value['rows'] == 3 && $key <= 3)
                        <li>
                            <h2 class="wow fadeIn" data-wow-duration="2s">{!! $value['title'] !!}</h2>
                            <p class="wow fadeIn" data-wow-duration="2s">{!! $value['description'] !!}</p>
                            <span>{!! date('d.m.Y',strtotime($value['created_at'])) !!}</span>
                            <div class="arrow"><a href=""><i class="fa fa-angle-right"></i></a></div>
                        </li>
                        @endif
                        @endforeach

                        

                    </ul>
                    
                    <a href="javascript:void(0)" id="loadMore">Load More</a>
                </div>
            </div>
            
        </div>
    </div>
</div>


@include('frontend.includes.popups')

@endsection
