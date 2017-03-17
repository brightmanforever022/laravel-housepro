@extends('frontend.layout.master-profile')
@section('content')

<script type="text/javascript">
  $(document).ready(function()
  {

     var x = $( window ).height() - 190;
     $('.listing-left').css('height', x);
     $('.listing-right').css('height', x);
     $('#map').css('height', x);

     $(document).on('change', '#bedroom_search', function(){
        $('#search_button').click();
     });

     $(document).on('change', '#city_price_id', function(){
        $('#search_button').click();
     });

  });
</script>
<div class="listing-search">
    <!--form action="{{ url('/search') }}" method="post"-->
    <div class="listing-left">
      <div class="row">
      <!-- Form -->
   {!! Form::open(array('url' => '/search_search', 'id' => 'index_search_search', 'method' => 'post')) !!}

   {{ csrf_field() }}
    <ul>
        <li><?php echo Form::text('city_where_met_search',$some_place, array('id' => 'city_where_met_search', 'placeholder' => 'e.g. Zurich,Luzern')); ?></li>
        <li>
            <div class="select-icon">
                <?php 
                                    echo Form::select('price', array('' => 'Price', '1-500' => '1-500 CHF', '500-1000' => '500-1000 CHF', '1000-5000' => '1000-5000 CHF', '5000-10000' => '5000-10000 CHF'), "$price");
                                    ?>
            </div>
        </li>
        <li>
            <div class="select-icon" >
                                   <?php 
                                    echo Form::select('bedroom', array('' => 'Guests', '1' => '1', '2' => '2','3' => '3','4' => '4','5' => '5','6' => '6', '7' => '7',), "$bedroom");
                                    ?>
                
            </div>
        </li>
        <li>
            <div class="select-icon">
                    @if($start_date != '')
                    <input type="text" class="datepicker" name="start_date"  placeholder="Check In" id="startdate_start" value="{{ date('d/m/y',strtotime($start_date)) }}" data-date-format='dd/mm/yy'/>
                    @else
                    <input type="text" class="datepicker" name="start_date"  placeholder="Check In" id="startdate_start" value="" data-date-format='dd/mm/yy'/>
                    @endif
                
            </div>
        </li>
        <li>
            <div class="select-icon">
                     @if($end_date)
                     <input type="text" class="datepicker" name="end_date" placeholder="Check Out" id="end_date_end" value="{{ date('d/m/y',strtotime($end_date)) }}" data-date-format='dd/mm/yy'/>
                     @else
                     <input type="text" class="datepicker" name="end_date" placeholder="Check Out" id="end_date_end" data-date-format='dd/mm/yy'/>
                     @endif
               
            </div>
        </li>
        <li><button type="submit" id="search_button">SEARCH</button></li>
    </ul>
    <div class="clearfix"></div>
  </div>
    <div class="row more_option_block">
      <p class="more_options">More Options +</p>
      <div class="more_search_options">
        <p class="close_options">Close Options x</p>
        <ul>
          <li class="more_search_options_list">
            <ul>
              <li>
                <div class="select-icon">
                  {{ Form::select('bedroom', array('' => 'Bedroom', '1' => '1', '2' => '2','3' => '3','4' => '4','5' => '5','6' => '6', '7' => '7',)) }}
                </div>
              </li>
              <li>
                <div class="select-icon">
                  {{ Form::select('bathroom', array('' => 'Bathroom', '1' => '1', '2' => '2','3' => '3','4' => '4','5' => '5','6' => '6', '7' => '7',)) }}
                </div>
              </li>
              <li>
                <div class="select-icon">
                  {{ Form::select('bed', array('' => 'Beds', '1' => '1', '2' => '2','3' => '3','4' => '4','5' => '5','6' => '6', '7' => '7',)) }}
                </div>
              </li>
              <li>
                <div class="select-icon">
                  {{ Form::select('lining_space', array('' => 'Living Space m2', '32' => '32', '45' => '45','55' => '55','75' => '75', '100' => '100',)) }}
                </div>
              </li>
              <li>
                <div class="select-icon">
                  {{ Form::select('property_type_id', array('' => 'Property Type', '1' => '1', '2' => '2','3' => '3','4' => '4','5' => '5','6' => '6', '7' => '7',)) }}
                </div>
              </li>
            </ul>
          </li>
          <li class="more_search_options_list">
            <ul>
              <li><label for="non_smoking"><input type="checkbox" id="non_smoking" name="non_smoking" />Non Smoking</label></li>
              <li><label for="tv"><input type="checkbox" id="tv" name="tv" />TV</label></li>
              <li><label for="w_lan"><input type="checkbox" id="w_lan" name="w_lan" />W-LAN</label></li>
              <li><label for="bed_linen"><input type="checkbox" id="bed_linen" name="bed_linen" />Bed linen</label></li>
              <li><label for="work_desk"><input type="checkbox" id="work_desk" name="work_desk" />Work desk</label></li>
              <li><label for="towels"><input type="checkbox" id="towels" name="towels" />Towels</label></li>
              <li><label for="pods"><input type="checkbox" id="pods" name="pods" />Pods, dishes</label></li>
            </ul>
          </li>
          <li class="more_search_options_list">
            <ul>
              <li><label for="hairdryer"><input type="checkbox" id="hairdryer" name="hairdryer" />Hairdryer</label></li>
              <li><label for="iron"><input type="checkbox" id="iron" name="iron" />Iron</label></li>
              <li><label for="phone"><input type="checkbox" id="phone" name="phone" />Phone</label></li>
              <li><label for="safe"><input type="checkbox" id="safe" name="safe" />Safe</label></li>
              <li><label for="washing_machine"><input type="checkbox" id="washing_machine" name="washing_machine" />Washing machine</label></li>
              <li><label for="fridge"><input type="checkbox" id="fridge" name="fridge" />Fridge</label></li>
              <li><label for="dishwasher"><input type="checkbox" id="dishwasher" name="dishwasher" />Dishwasher</label></li>
            </ul>
          </li>
          <li class="more_search_options_list">
            <ul>
              <li><label for="wardrobe"><input type="checkbox" id="wardrobe" name="wardrobe" />Built-in wardrobe</label></li>
              <li><label for="parking"><input type="checkbox" id="parking" name="parking" />Parking</label></li>
              <li><label for="concierge"><input type="checkbox" id="concierge" name="concierge" />Concierge</label></li>
              <li><label for="laundry"><input type="checkbox" id="laundry" name="laundry" />Laundry</label></li>
            </ul>
          </li>
          <li class="more_search_options_list">
            <ul>
              <li><label for="wheelchair_access"><input type="checkbox" id="wheelchair_access" name="wheelchair_access" />Wheelchair access</label></li>
              <li><label for="fitness_center"><input type="checkbox" id="fitness_center" name="fitness_center" />Fitness Center</label></li>
              <li><label for="elevator"><input type="checkbox" id="elevator" name="elevator" />Elevator</label></li>
              <li><label for="cellar"><input type="checkbox" id="cellar" name="cellar" />Cellar</label></li>
            </ul>
          </li>
          <div class="clearfix"></div>
        </ul>
      </div>
    </div>
    <!--/form --> 
    {!! Form::close() !!}

    <!-- <div class="listing-left"> -->
        <div class="row">
            <?php if($price == "") $price = "1-10000"; ?>
            @if(count($porperties) != 0)
            @foreach($porperties as $key=>$property)
            <div class="col-md-6 texthover"> 
                @if($start_date == "" && $end_date == "")
                @if(intVal($bedroom)) 
                <a href="{{ url('/')}}/single/{{ $property->id }}/0/0/{{$bedroom}}/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank">
                @else
                <a href="{{ url('/')}}/single/{{ $property->id }}/0/0/0/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank">
                @endif
                @elseif($start_date != "" && $end_date == "")
                @if(intVal($bedroom))
                <a href="{{ url('/')}}/single/{{ $property->id }}/{{ strtotime($start_date) }}/0/{{$bedroom}}/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank">
                @else
                <a href="{{ url('/')}}/single/{{ $property->id }}/{{ strtotime($start_date) }}/0/0/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank">
                @endif

                @elseif($start_date == "" && $end_date != "")
                @if(intVal($bedroom))
                <a href="{{ url('/')}}/single/{{ $property->id }}/0/{{ strtotime($end_date) }}/{{$bedroom}}/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank">
                @else
                <a href="{{ url('/')}}/single/{{ $property->id }}/0/{{ strtotime($end_date) }}/0/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank">
                @endif
                @else
                @if(intVal($bedroom))
                <a href="{{ url('/')}}/single/{{ $property->id }}/{{ strtotime($start_date) }}/{{ strtotime($end_date) }}/{{$bedroom}}/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}">
                @else
                <a href="{{ url('/')}}/single/{{ $property->id }}/{{ strtotime($start_date) }}/{{ strtotime($end_date) }}/0/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank">
                @endif

                @endif
                    <figure>
                        @if(count($property->images))
                        <div class="offer-detail-bg">
                          <div class="flexslider">
                            <ul class="slides">
                                @foreach($property->images as $image)
                                  <li><img src="{{ url('/')}}/images/profile/{{$image->path}}" /></li>
                                @endforeach
                                <!--li><img src="images/detail-bg.jpg" /></li-->
                            </ul>
                          </div>
                        </div>
                        @else
                        <img src="http://development.hestawork.com/apartolino1/public/images/img4.jpg">
                        @endif
                    </figure>
                    
                    <p>CHF {{ $property->price_per_night }}</p>
                    <h6 class="titile-property">{{ $property->title }}</h6>
                    <?php 
                    $property_type = \App\PropertyType::where('id', $property->property_type_id)->get();
                    ?>
                    <p>{{ $property_type[0]->name }} in {{ $property->plz_place}}</p>
                </a>
                
            </div>
            @endforeach
            @else
            <div class="col-md-4">
            <h3>No result found.</h3>
            </div>
            @endif
            
        </div>
    </div>
<style>
#map img {
  max-width: none;
}
</style>
<script>
    $(document).ready(function()
    {
    
      var map;
      var infowindow;
      var geocoder;
      geocoder = new google.maps.Geocoder();

      var radius_circle = null;
      var markers_on_map = [];
      var infowindow = null;
  
      //all_locations is just a sample, you will probably load those from database
      var all_locations = [];
      var markers_collection = [];
     
      $('#mapbuttonform').submit(function(e)
      {
          e.preventDefault();
          var address = $('#address').val();
          var radius_km = $('#radius_km').val();
          if(address == "")
          {
            alert("Please Select Location");
            return false;
          }else if(radius_km != "")
          {
              geocoder.geocode( { 'address': $('#address').val()}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                  var lat = results[0].geometry.location.lat();
                  var lng = results[0].geometry.location.lng();
                  $('#map_lat').val(lat.toFixed(6));
                  $('#map_lng').val(lng.toFixed(6));
                  document.getElementById('mapbuttonform').submit();
                  //alert( "Handler for .focus() called." );
                }
          });     
          }else 
          {
            $.fancybox([ { href : '#error_message' } ]);
            $('#errorCustomMessage').text("Please choose radius.");
            return false;
          }

      });


      $( "#address" ).blur(function() {
           geocoder.geocode( { 'address': $('#address').val()}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                  var lat = results[0].geometry.location.lat();
                  var lng = results[0].geometry.location.lng();
                  $('#map_lat').val(lat.toFixed(6));
                  $('#map_lng').val(lng.toFixed(6));
                  //alert( "Handler for .focus() called." );
                }
          });      

        
      });
 

 $('#index_search_search').validate({
        rules: {
            city_where_met_search: {
                required: true
            },
        },
        messages: {
            city_where_met_search: {
                required: "<h6 style='color:red'>Please Add your location.</h6>"
            },
        },
      errorPlacement: function(error, element) {
            if (element.attr("name") == "fname" || element.attr("name") == "lname" ) {
              error.insertAfter("#lastname");
            } else {
              error.insertAfter(element);
            }
          },
        submitHandler: function (form) {
           //Handle Ajax Method and success  / error here
            form.submit();
        }
    });

       $(initMap);
      function initMap() {
        geocoder.geocode( { 'address': '<?php echo $city_where_met_location; ?>'}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                 
                  var pyrmont = results[0].geometry.location;
                  infowindow = new google.maps.InfoWindow();
                  $('#map_lat').val(results[0].geometry.location.lat());
                  $('#map_lng').val(results[0].geometry.location.lng());
                  map = new google.maps.Map(document.getElementById('map'), {
                    center: pyrmont,
                    zoom: 17
                  });

                  infowindow = new google.maps.InfoWindow();
                  var service = new google.maps.places.PlacesService(map);
                  


                  service.nearbySearch({
                    location: pyrmont,
                    radius: 500,
                    type: ['store']
                  }, callback);

                  var radius_km = <?php echo $radius; ?>;
                  //alert(radius_km);
                  if(radius_km)
                  {
                    if (radius_circle) {
                      radius_circle.setMap(null);
                      radius_circle = null;
                    }
                    for (i = 0; i < markers_on_map.length; i++) {
                      if (markers_on_map[i]) {
                        markers_on_map[i].setMap(null);
                        markers_on_map[i] = null;
                      }
                    }
                    
                    radius_circle = new google.maps.Circle({
                      center: pyrmont,
                      radius: radius_km * 1000,
                      clickable: false,
                    map: map
                    });

                    map.fitBounds(radius_circle.getBounds());
                  }
            }
          });
      }

      function callback(results, status) {
       

        <?php
          
         
          foreach($porperties as $key=>$property)
          {
             
              
              
          ?> 
            
            
               var temp = new Object();
              
              temp['type'] = 'Restaurant'; 
              temp['name'] = 'Restaurant 1'; 
              temp['lat'] = '<?php echo $property->lat;?>';
              temp['lng'] = '<?php echo $property->lng;?>';
              all_locations.push(temp); 
              
              
          
               var icon_path = "<?php echo $property->icon_path;?>";
                var price = "<?php echo $property->price_per_night;?>"
                
                <?php 
                if(count($property->images)!= 0)
                {

                 if($start_date == "" && $end_date == "")
                 {
                 if(intVal($bedroom))
                 $a =  Request::root().'/single/'.$property->id.'/0/0/'.$bedroom;
                 else
                 $a =  Request::root().'/single/'.$property->id.'/0/0/0';
                 }else if($start_date != "" && $end_date == "")
                 {
                 if(intVal($bedroom))
                 $a =  Request::root().'/single/'.$property->id.'/'.strtotime($start_date).'/0/'.$bedroom;
                 else
                  $a =  Request::root().'/single/'.$property->id.'/'.strtotime($start_date).'/0';
                 }else if($start_date == "" && $end_date != "")
                 {
                 if(intVal($bedroom))
                 $a =  Request::root().'/single/'.$property->id.'/0/'.strtotime($end_date).'/'.$bedroom;
                 else
                   $a =  Request::root().'/single/'.$property->id.'/0/'.strtotime($end_date).'/0';
                 }else
                 {
                 if(intVal($bedroom))
                  $a =  Request::root().'/single/'.$property->id.'/'.strtotime($start_date).'/'.strtotime($end_date).'/'.$bedroom;
                 else
                 $a =  Request::root().'/single/'.$property->id.'/'.strtotime($start_date).'/'.strtotime($end_date).'/0';
                 
                }

                
                ?>  

                

                var html = ' <div class="map-pointer" id="mappointer{{$key}}"> <figure> <img src="{{ url('/') }}/images/thumb/{{ $property->images[0]->path}}" /> <div class="price">CHF {{ $property->price_per_night}}</div> </figure> @if($start_date == "" && $end_date == "") @if(intVal($bedroom))                 <a href="{{ url('/')}}/single/{{ $property->id }}/0/0/{{$bedroom}}/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank">@else <a href="{{ url('/')}}/single/{{ $property->id }}/0/0/0/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank"> @endif @elseif($start_date != "" && $end_date == "") @if(intVal($bedroom)) <a href="{{ url('/')}}/single/{{ $property->id }}/{{ strtotime($start_date) }}/0/{{$bedroom}}/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank"> @else <a href="{{ url('/')}}/single/{{ $property->id }}/{{ strtotime($start_date) }}/0/0/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank">  @endif                 @elseif($start_date == "" && $end_date != "") @if(intVal($bedroom)) <a href="{{ url('/')}}/single/{{ $property->id }}/0/{{ strtotime($end_date) }}/{{$bedroom}}/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank"> @else <a href="{{ url('/')}}/single/{{ $property->id }}/0/{{ strtotime($end_date) }}/0/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank"> @endif @else @if(intVal($bedroom)) <a href="{{ url('/')}}/single/{{ $property->id }}/{{ strtotime($start_date) }}/{{ strtotime($end_date) }}/{{$bedroom}}/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}"> @else <a href="{{ url('/')}}/single/{{ $property->id }}/{{ strtotime($start_date) }}/{{ strtotime($end_date) }}/0/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank"> @endif  @endif{{ $property->street }} ({{ $property->title }})</a></div>';
                 <?php 
                 }else
                 {
                  ?>
                var html = ' <div class="map-pointer"> <figure> <img src="" alt="Images Not found"/> <div class="price">CHF {{ $property->price_per_night}}</div> </figure> @if($start_date == "" && $end_date == "") @if(intVal($bedroom))                 <a href="{{ url('/')}}/single/{{ $property->id }}/0/0/{{$bedroom}}/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank">@else <a href="{{ url('/')}}/single/{{ $property->id }}/0/0/0/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank"> @endif @elseif($start_date != "" && $end_date == "") @if(intVal($bedroom)) <a href="{{ url('/')}}/single/{{ $property->id }}/{{ strtotime($start_date) }}/0/{{$bedroom}}/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank"> @else <a href="{{ url('/')}}/single/{{ $property->id }}/{{ strtotime($start_date) }}/0/0/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank">  @endif                 @elseif($start_date == "" && $end_date != "") @if(intVal($bedroom)) <a href="{{ url('/')}}/single/{{ $property->id }}/0/{{ strtotime($end_date) }}/{{$bedroom}}/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank"> @else <a href="{{ url('/')}}/single/{{ $property->id }}/0/{{ strtotime($end_date) }}/0/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank"> @endif @else @if(intVal($bedroom)) <a href="{{ url('/')}}/single/{{ $property->id }}/{{ strtotime($start_date) }}/{{ strtotime($end_date) }}/{{$bedroom}}/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}"> @else <a href="{{ url('/')}}/single/{{ $property->id }}/{{ strtotime($start_date) }}/{{ strtotime($end_date) }}/0/{{$some_place}}/{{$price}}" id="mappointer{{$key}}" data-black="{{url('/')}}/product/{{$property->icon_path}}" data-red="{{url('/')}}/product_red/{{$property->icon_path}}" target="_blank"> @endif  @endif{{ $property->street }} ({{ $property->title }})</a></div>';
                 <?php 
                 }
                 ?>
                 
                //console.log(html);
                 var latlng = new Object();
                 latlng['lat'] = <?php echo $property->lat;?>;
                 latlng['lng'] = <?php echo $property->lng;?>;
                 
                createMarker(latlng, html, icon_path);
                
              
          <?php 
               }
          ?>


      }

      function createMarker(place, html, icon_path) {
        
        var placeLoc = place;
        var marker = new google.maps.Marker({
          icon: "{{url('/')}}/product/" + icon_path,
          //icon : "{!! url('/') !!}/product/map-marker.png",
          map: map,
          position: place,
          // title:html,
          tooltip: html
        });
        markers_collection.push(marker);
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(this.tooltip);
            infowindow.open(map, this);
            $('.flexslider').flexslider({
                    animation: "slide",
                  });
        });
       
        google.maps.event.addListener(marker, 'mouseover', function (e) {

          $('#'+marker.tooltip.split('"')[3]+'').focus();
          $('#'+marker.tooltip.split('"')[3]+' .text p').css("background", "#F35A57");
          if(marker.getIcon().indexOf("product_") == -1)
          {
          //alert(marker.getIcon().replace("product", "product_red"));
          marker.setIcon(marker.getIcon().replace("product", "product_red"));
          }else 
          {
            marker.setIcon(marker.getIcon());
          }
        });

        google.maps.event.addListener(marker, 'mouseout', function (e) {

          $('#'+marker.tooltip.split('"')[3]+' .text p').css("background", "rgba(0,0,0,0.4)");

          if(marker.getIcon().indexOf("product_") != -1)
          {
            marker.setIcon(marker.getIcon().replace("product_red", "product"));
          }
        });
          
        
      }     
   
      function initialize_location() { 
            var input = document.getElementById('address');

            var options = {
              types: ['(cities)'],
              componentRestrictions: {country: "ch"}
             };
            if(input) { 
                var autocomplete = new google.maps.places.Autocomplete(input, options);
            }
        }
          initialize_location();

        $( ".texthover" ).mouseenter(function() {
           var id = $(this).children("a").attr("id");
           $('#'+$(this).children("a").attr("id")+' .text p').css("background", "#F35A57");

           $('div#'+$(this).children("a").attr("id")+'').trigger('mouseover');

            // markers_collection.forEach(function(marker)
            // {
            //    alert(id);
            //    if(marker.title.split('"')[3] == $(this).children("a").attr("id"))
            //    {
            //     marker.setIcon('http://localhost:8000/images/map-marker_red.png');
            //    }
            // });

            for (var i = 0, len = markers_collection.length; i < len; i++) {
              var marker = markers_collection[i];
              if(marker.tooltip.split('"')[3] == $(this).children("a").attr("id"))
                {
                 map.setCenter(marker.getPosition());  
                 marker.setIcon($(this).children("a").attr("data-red"));
                }
            }

      });

 
      $( ".texthover" ).mouseleave(function() {
           $('#'+$(this).children("a").attr("id")+' .text p').css("background", "rgba(0,0,0,0.4)");

           for (var i = 0, len = markers_collection.length; i < len; i++) {
              var marker = markers_collection[i];
              if(marker.tooltip.split('"')[3] == $(this).children("a").attr("id"))
                {
                 map.setCenter(marker.getPosition()); 
                 marker.setIcon($(this).children("a").attr("data-black"));
                }
            }
      }); 

      $('.more_options').on('click', function(){ // popup more search options
        $('.more_search_options').css('display', 'block');
        $('.more_options').css('display', 'none');
      });
      $('.close_options').on('click', function(){ // pop off more search options
        $('.more_search_options').css('display', 'none');
        $('.more_options').css('display', 'block');
        // reset form elements
        $('#index_search_search')[0].reset();
        
      });
      
    });     
</script>

    <div class="listing-right">

         <!--form method="post" id="mapbuttonform" action="{{ url('/') }}/searchMap"-->

         {!! Form::open(array('url' => '/searchMap','id' => 'mapbuttonform', 'method' => 'post')) !!}

         {{ csrf_field() }}
         <h1><img src="images/map.png" />By distance</h1>
         <input id="address" name="address" placeholder="Enter office address" value="{{ $some_place }}"/>
         @if($start_date != '')
         <input type="hidden" class="datepicker" name="start_date"  placeholder="Arrivals"  value="{{ date('m/d/Y',strtotime($start_date)) }}"/>
         @else
         <input type="hidden" class="datepicker" name="start_date"  placeholder="Arrivals"  value=""/>
         @endif

         @if($end_date != '')
         <input type="hidden" class="datepicker" name="end_date"  placeholder="Arrivals"  value="{{ date('m/d/Y',strtotime($end_date)) }}"/>
         @else
         <input type="hidden" class="datepicker" name="end_date"  placeholder="Arrivals"  value=""/>
         @endif
         <input type="hidden" name="price" value="{{ $price }}">
         <input type="hidden" name="bedroom" value="{{ $bedroom }}">
         <input type="hidden" id="map_lat" name="lat">
         <input type="hidden" id="map_lng" name="lng">

         <?php 
            echo Form::select('radius_km', array('' => 'Radius', '1' => '1km', '2' => '2km', '5' => '5km', '30' => '30km'), "$radius", array('class' => 'select-icon', 'id' => 'radius_km'));
          ?>

        
         <button type="submit" id="mapbutton" ><i class="fa fa-search"></i></button>
         {!! Form::close() !!}
         <div id="map" style="height:750px;"></div>
   
    </div>
    <div class="clearfix"></div>
</div>
@include('frontend.includes.popups')
@endsection

