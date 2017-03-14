@extends('frontend.layout.master-profile')
@section('content')
<script>
 setTimeout(function() {
            $('#successMessage').fadeOut('fast');
            }, 10000);
</script>

<div class="create-add">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>CURRENT ADS AND STATISTICS.</h1>
                 @if(Session::has('message'))
                        <div class="alert-box success" id="successMessage">
                        <h4 style="color:{{ Session::get('color') }}">{{ Session::get('message') }}</h4>
                        </div>
                 @endif
            </div>
            <div class="col-md-6">
                <a href="{!! url('/create_new_add') !!}" class="create-add-btn create-add-btn-property"  data-userid="{{ Auth::user()->id }}">+ Create new ads</a>
            </div>
        </div>
    </div>
</div>
<div class="overview">
    <div class="container">
        @if(count($properties))
        <div class="row">
            @foreach($properties as $key=>$val)
            <?php
            $book_count = count(\App\Payment::where('host_id', Auth::user()->id)->where('billing_id', $val->id)->get());;
            ?>
            <div class="col-md-4">
                
                <div class="overview-ads-box">
                    
                        <a  href="{{ url('/')}}/single/{{ $val->id }}">
                       <figure>
                       @if(count($val->images)!= 0)
                       <img src="{{url('/')}}/images/thumb/{{ $val->images[0]->path }}">
                        @else
                        <img src="" class="grayscale grayscale-fade" alt="Images Not Found"/>
                        @endif

                        <div class="text">
                            <span>{{ $val->plz_place }}</span>
                            <p>CHF {{ $val->price_per_night }}</p>
                        </div>
                        </figure>
                        </a>
                    
                    <div class="row">
                        <div class="col-xs-6 pad-r0">
                            <ul>
                                <li><a href=""><img src="{{ url('/') }}/images/view.png" /></a></li>
                                <li><a href=""><img src="{{ url('/') }}/images/message.png" /></a></li>
                                <li><a href=""><img src="{{ url('/') }}/images/days.png" /></a></li>
                                <li><a href=""><img src="{{ url('/') }}/images/search.png" /></a></li>
                            </ul>
                        </div>
                        <div class="col-xs-6 pad-l0">
                            <p>Views<span class="pull-right">{{  $val->visitors }}</span></p>
                            <p>Bookings<span class="pull-right">{{ $book_count }}</span></p>
                            <p>Days online<span class="pull-right"><?php 

                            $then = strtotime($val->created_at);
                            $now = time();
                             
                            //Calculate the difference.
                            $difference = $now - $then;
                             
                            //Convert seconds into days.
                            $days = floor($difference / (60*60*24) );
                             
                            echo $days;

                            ?></span></p>
                            <p>Object-Ref.:<span class="pull-right">{{ $val->reference }}</span></p>
                        </div>
                    </div>
                    <a href="{{ url('/editProperty') }}/{{ $val->id }}" class="edit"><i class="fa fa-pencil"></i> Edit</a>
                    <a href="{{ url('/deleteProperty') }}/{{ $val->id }}" class="delet" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</a>
                    <div class="clearfix"></div>
                </div>
            </div>
            @endforeach

        </div>
        @else
        <div class="row">
        <div style="text-align: center;">No Result Found</div>
        </div>
        @endif
    </div>
</div>
@include('frontend.includes.popups')
@endsection