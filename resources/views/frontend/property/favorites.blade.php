@extends('frontend.layout.master-profile')
@section('content')
<script>
 setTimeout(function() {
            $('#successMessage').fadeOut('fast');
            }, 5000);
$(document).ready(function(){
    $('.favorite-close1').click(function(e){
        e.preventDefault();
        var favorite_id = $(this).data('id');
        console.log(favorite_id);
        location.href="{{ url('/favorites') }}" + "/delete/" + favorite_id;
        return false;
    });
});
</script>

<div class="create-add">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>SAVE AND COMPARE.</h1>
                <p>Save your favorite apartments and compare them.</p>
                 @if(Session::has('message'))
                        <div class="alert-box success" id="successMessage">
                        <h4 style="color:{{ Session::get('color') }}">{{ Session::get('message') }}</h4>
                        </div>
                 @endif
            </div>
        </div>
    </div>
</div>
<div class="overview">
    <div class="container">
        @if(count($favorites))
            <div class="row">
                @foreach($favorites as $key=>$val)
                <?php
                    $property = \App\Property::where('id', $val->property_id)->get()[0];
                    $property_type = \App\PropertyType::where('id', $property['property_type_id'])->get()[0];
                    // print_r($property->images[0]);exit;
                ?>
                <div class="col-md-4">
                    
                    <div class="overview-favorite-box">
                        
                        <a  href="{{ url('/')}}/single/{{ $property->id }}">
                           <figure>
                                @if(count($property->images)!= 0)
                                    <img src="{{url('/')}}/images/thumb/{{ $property->images[0]->path }}">
                                @else
                                    <img src="" class="grayscale grayscale-fade" alt="Images Not Found"/>
                                @endif

                                <div class="text1">
                                    <p>CHF {{ $property->price_per_night }}</p>
                                    <span>{{ str_limit($property->title, $limit=30, $end="...") }}</span>
                                    <p>{{ $property_type['name'] }}</p>
                                </div>
                            </figure>
                        </a>
                        <a href="{{ url('/removeFavorite') }}/{{ $val->id }}" class="favorite-close" onclick="return confirm('Are you sure?')"><i class="fa fa-close"></i></a>
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