@extends('frontend.layout.master-profile')
@section('content')

<?php
      $visitor = $properties[0]->visitors;
      if(Auth::check() && Auth::user()->user_type == 0)
      $visitor++;
      else if(!Auth::check())
      $visitor++;
      
      \App\Property::where('id', $properties[0]->id)->update(['visitors' => $visitor]);

      $initials = \DB::table('admin_initials')->get();
      

?>

<?php
      $x = "";
      if(count($properties[0]->event))
      {
        
        foreach($properties[0]->event as $key=>$event)
        {
          $x = $x.date('d/m/y', strtotime($event->start_date)).",";
        }
        
      }

      $payments_disabled = \App\Payment::where('billing_id', $properties[0]->id)->get()->toArray();
      $date_list = array();
      if(count($payments_disabled)){
          foreach ($payments_disabled as $key => $value) {
                $billingInfo      = \App\BillingInfo::where('id', $value['id'])->get()->toArray();
                if(count($billingInfo)){
                $start_time = strtotime($billingInfo[0]['check_in']);
                $end_time = strtotime($billingInfo[0]['check_out']);
                $current_time = $start_time;

                while($current_time < $end_time) {
                    $current_time += 86400;
                    $date_list[] = date('Y-m-d',$current_time);
                }
                
              }
          }

          foreach (array_unique($date_list) as  $value) {
              $x = $x.date('d/m/y', strtotime($value)).",";
          }
      }
     

      

?>


<style type="text/css">
    .sticky-div {
        margin-left: 67.85% !important;
        z-index: 9999 !important;
    }
</style>
<script>



$(document).ready(function()
{
    if($( window ).width() > 991)
    $('#my_div').sticky_div();

    if(localStorage.getItem('remember_statics') != undefined)
    {
    $('#remember_statics').html(localStorage.getItem('remember_statics'));
    $('#startdate_single').val(localStorage.getItem('startdate_single'));
    $('#end_date_single').val(localStorage.getItem('end_date_single'));
    $('#guest_check').val(localStorage.getItem('guest_check'));
    $('#total_three').text(localStorage.getItem('total_three'));
    $('#total_initial').text(localStorage.getItem('total_initial'));
    $('#price').val(localStorage.getItem('price'));
    $('#init_price').val(localStorage.getItem('init_price'));
    $('#check_login').val(1);
    var from_start = localStorage.getItem('startdate_single').split("/");
    var fs = new Date(from_start[2], from_start[1] - 1, from_start[0]);
    if (fs.getFullYear() < 1970) {
    fs.setFullYear(fs.getFullYear() + 100);
    }
    var from_end = localStorage.getItem('end_date_single').split("/");
    var fe = new Date(from_end[2], from_end[1] - 1, from_end[0]);
    if (fe.getFullYear() < 1970) {
    fe.setFullYear(fe.getFullYear() + 100);
    }

    if(localStorage.getItem('date_disabled') != null){
        var nowDate = new Date();
        var nextDate = new Date(nowDate.getTime() + (24 * 60 * 60 * 1000));
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        var tomorrow = new Date(nextDate.getFullYear(), nextDate.getMonth(), nextDate.getDate(), 0, 0, 0, 0);

        document.getElementById('date_disabled').value = localStorage.getItem('date_disabled');
        var a = document.getElementById('date_disabled');
        if(a != null)
        {
        var x = new Array();
        datesDisabled = a.value.split(",");
        }else 
        {
          datesDisabled = [];
        }
        $('#startdate_single').datepicker({ 
        startDate: today ,
        datesDisabled: datesDisabled,
        });

        $('#end_date_single').datepicker({ 
        startDate: tomorrow ,
        datesDisabled: datesDisabled,
        });
       

       
    }
    
    var a = $('#startdate_single').datepicker("setDate", fs );
    var b = $('#end_date_single').datepicker("setDate", fe );  
    a = $("#startdate_single").datepicker('getDate').getTime();
    b = $("#end_date_single").datepicker('getDate').getTime();
    var c = 24*60*60*1000;
    diffDays = Math.round(Math.abs((a - b)/(c)));
    $('#nights').val(diffDays);
    //window.localStorage.clear();
    }
    $('#bedroomerrorguest').hide();  
    $('#booking_form_id').submit(function()
    {
            var is_login = parseInt($('#check_login').val());
            if(is_login)
            {
                if($('#booking_form_id').valid())
                {
                    document.getElementById('booking_form_id').submit();
                }else 
                {
                   if($('#guest_check').val() == "" || $('#guest_check').val() == 0)
                    {
                      $('#bedroomerrorguest').show();
                    }else 
                    {
                      $('#bedroomerrorguest').hide();
                    }
                    return false;
                }
            }else 
            {
                if($('#booking_form_id').valid())
                {
                console.log("Else");
                localStorage.setItem('remember_statics', $('#remember_statics').html());
                localStorage.setItem('startdate_single', $('#startdate_single').val())
                localStorage.setItem('end_date_single', $('#end_date_single').val());
                localStorage.setItem('guest_check', $('#guest_check').val())
                $.fancybox([ { href : '#login' } ]);
                localStorage.setItem('total_three', $('#total_three').text());
                localStorage.setItem('total_initial', $('#total_initial').text());
                localStorage.setItem('price', $('#price').val());
                localStorage.setItem('init_price', $('#init_price').val());
                localStorage.setItem('date_disabled', '<?=$x;?>');
                $.fancybox([ { href : '#login' } ]);http://development.hestawork.com/apartolino1/public/
                return false;
                }
                else 
                {
                    if($('#guest_check').val() == "")
                    {
                      $('#bedroomerrorguest').show();
                    }else 
                    {
                      $('#bedroomerrorguest').hide();
                    }
                    return false;
                }
            }
    });

    $('#guest_check').change(function()
    {

      if($('#guest_check').val() == "")
      {
        $('#bedroomerrorguest').show();
      }else 
      {
        $('#bedroomerrorguest').hide();
      }
    });

    $('.previous_go').click(function(e)
    {
            e.preventDefault();
            window.history.back();
    });


    $('#booking_form_id').validate({
        rules: {
            bedroom:{
                required: true,
                min: 1
            },
            saluation: {
                required: true
            },
            name: {
                required: true,
            },
            surname: {
                required: true,
            },
            phone: {
                required: true,
                
            },
            email: {
                required: true,
                email:true,
            },
            
            startdate_single: {
                required: true,
            },
            end_date_single: {
                required:true,
            },

        },
        messages: {
            bedroom: {
                required: "<h6 style='color:red'>Please select Guest.</h6>",
                min: "<h6 style='color:red'>Please select Guest.</h6>"
            },
            company: {
                required: "<h6 style='color:red'>Please select saluation.</h6>"
            },
            name: {
                required: "<h6 style='color:red'>Please enter your Name.</h6",
            },
            surname: {
                required: "<h6 style='color:red'>Please enter your Surname.</h6",
            },
            phone: {
                required: "<h6 style='color:red'>Please enter your phone.</h6",
                
            },
            email: {
                required: "<h6 style='color:red'>Please enter your email address.</h6",
                email   : "<h6 style='color:red'>Please enter valid email address.</h6>"
            },
            
            startdate_single: {
                required: "<h6 style='color:red'>Please select check in date.</h6",
                
            },
            end_date_single: {
                required: "<h6 style='color:red'>Please select check out date.</h6",
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
            //form.submit();
        }
    });

   


});
</script>
<div id="disabledDates">

<form>
<input type="hidden" id="date_disabled" value="{{ $x }}">
</form>
</div>
<!--div class="prev-next">
    <div class="row">
        <div class="col-md-12">
            <ul>
                @if(intVal($prevUser))
                <li class="active"><a href="{{ str_replace($properties[0]->id, intVal($prevUser),Request::fullUrl()) }}"><i class="fa fa-angle-left"></i>Previous Ad</a></li>
                @else
                <li><i class="fa fa-angle-left"></i>Previous Ad</li>
                @endif


                <li><a href="" class="previous_go"><i class="fa fa-angle-up"></i>Back hitlist</a></li>


                @if(intVal($nextUser))
                <li><a class="active" href="{{ str_replace($properties[0]->id, intVal($nextUser),Request::fullUrl()) }}">Next Ad<i class="fa fa-angle-right"></i></a></li>
                @else
                <li>Next Ad<i class="fa fa-angle-right"></i></li>
                @endif
            </ul>
        </div>
    </div>
</div-->
<div class="offer-detail-bg">
    <div class="flexslider">
        <ul class="slides">
            @foreach($properties[0]->images as $image)
        	<li><img src="{{ url('/')}}/images/profile/{{$image->path}}" /></li>
            @endforeach
            <!--li><img src="images/detail-bg.jpg" /></li-->
        </ul>
    </div>	
</div> 
<div class="detail-summary">
	<div class="container">
    	<div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-2">
                        @if($properties[0]->user->path == '')
                        <div class="logo">
                            <img src="{{ url('/')}}/images/v.jpg" />
                        </div>
                        @else
                         <div class="logo">
                            <img class="img-circle" src="{{ url('/')}}/profilepics/{{ $properties[0]->user->path }}" />
                        </div>
                        @endif
                        
                    </div>
                    <div class="col-md-6">
                        <h1>{{ $properties[0]->title }}</h1>
                        <p>{{ $properties[0]->street }}<br /> {{ $properties[0]->plz_place }}, Schweiz</p>
                        <br/>
                        <p>Accomodation set by<br/>{{$properties[0]->user->company}}</p>

                    </div>
                    <div class="col-md-4">
                        <ul>
                            <li>
                                <img src="{{ url('/')}}/images/imgpsh_fullsize.png" width="30px" /> 
                                {{ $properties[0]->lining_space }} m<sup>2</sup>
                            </li>
                            <li>
                                <i class="fa fa-users"></i>
                                {{ $properties[0]->apartment_for }} Guest
                            </li>
                            <li>
                                <i class="fa fa-bed" aria-hidden="true"></i>
                                {{ $properties[0]->bed }} Bed
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="appointment-form">
                	<div class="appointment-form-box" id="my_div">
                    	<h1>CHF {{ $properties[0]->price_per_night }}<span class="pull-right" style="text-transform:none !important;">per Night</span></h1>
                        <form action="{{ url('/') }}/postPayment" method="post" id="booking_form_id">
                        {{ csrf_field() }}
                        	<div class="row">
                            	<div class="col-md-4 pa">
                                	<fieldset>
                                       <input type="hidden" name="date_compare" id="date_compare" value="{{ date('Y-m-d', strtotime($properties[0]->start_date)) }}"/>
                                       <input type="hidden" name="compare_min_stay" id="compare_min_stay" value="{{ $properties[0]->min_stay }}"/>

                                        @if($start_date != 0)
                                    	<input type="text" name="startdate_single" placeholder="Check In" id="startdate_single" value="{{ date('m/d/y', $start_date) }}"  data-date-format='dd/mm/yy'/>
                                        <input type="hidden" id="script_single" value="1">
                                        @else
                                        <input type="text" name="startdate_single" placeholder="Check In" id="startdate_single" value="" data-date-format='dd/mm/yy'/>
                                         <input type="hidden" id="script_single" value="0">
                                        @endif
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                	<fieldset>
                                        @if($end_date != 0)
                                    	<input type="text" placeholder="Check Out" name="end_date_single" id="end_date_single" value="{{ date('m/d/y', strtotime($end_date)) }}" data-date-format='dd/mm/yy'/>
                                        <input type="hidden" id="script_single_end" value="1">
                                        @else
                                        <input type="text" placeholder="Check Out" name="end_date_single" id="end_date_single" data-date-format='dd/mm/yy'/>
                                        <input type="hidden" id="script_single_end" value="0">
                                        @endif
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                	<div class="select-icon">
                                        <?php 
                                            $guest_dynamic = array();
                                            for($i= 0; $i<= $properties[0]->apartment_for; $i++)
                                            {
                                                if($i==0)
                                                $guest_dynamic[$i] = 'Guests';
                                                else
                                                $guest_dynamic[$i] = $i;    
                                            }
                                            
                                            echo Form::select('bedroom', $guest_dynamic, "$bedroom",array('id'=> 'guest_check'));
                                        ?>
                                        
                                    </div>
                                    <div id="bedroomerrorguest">
                                    <label><h6 id="phone-error-some">Please select Guest.</h6></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-md-12 ">
                                	<table>
                                    	<tr id="remember_statics">
                                        	<td width="74%" id="total_one">CHF {{ $properties[0]->price_per_night }} x 0 Nights + <br>CHF {{ $properties[0]->cleaning_fee }} x 0 Cleaning Fee</td>
                                            <td width="26%" id="total_two">CHF 0</td>
                                        </tr>
                                        <tr>
                                        	<td style="font-weight: bold;">Total amount</td>
                                            <td id="total_three">CHF 0</td>
                                            <input type="hidden" name="price_per_night" value="{{ $properties[0]->price_per_night}}" id="price_per_night">
                                             <input type="hidden" name="cleaning_fee" value="{{ $properties[0]->cleaning_fee}}" id="cleaning_fee">
                                            <input type="hidden" name="price" value="{{ $properties[0]->price_per_night * 2}}" id="price">
                                            <input type="hidden" name="init_price" value="{{ $properties[0]->price_per_night * 2}}" id="init_price">

                                            <input type="hidden" name="item_id" value="{{ $properties[0]->id }}">
                                            <input type="hidden" name="host_id" value="{{ $properties[0]->user_id }}">
                                            @if(Auth::check())
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="check_login" id="check_login" value="1">
                                            <input type="hidden" name="nights" id="nights" value="2">
                                            @else
                                             <input type="hidden" name="check_login" id="check_login" value="0">
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Deposit payment</td>
                                            <td id="total_initial">CHF 0</td>
                                            
                                        </tr>    
                                    </table>
                                </div>
                            </div>
                            @if(Auth::check() && Auth::user()->user_type == 0)
                                                    
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" id="percent_pay" value="{{ $initials[0]->percentage }}">
                                    <input type="hidden" name="saluation" value="{{ Auth::user()->saluation }}">
                                    <input type="hidden" name="name" placeholder="Name*" value="{!! Auth::user()->name !!}"/>
                                    <input type="hidden" name="surname" placeholder="Surname*" value="{!! Auth::user()->surname !!}"/>
                                    <input type="hidden" name="phone" placeholder="Phone*" value="+41{!! Auth::user()->phone !!}" id="phone"/>
                                    <input type="hidden" name="email" placeholder="Email*" value="{!! Auth::user()->email !!}"/>
                                	<fieldset>
                                    	<textarea name="remark" placeholder="Message to provider"></textarea>
                                    </fieldset>
                                </div>
                            </div>
                            <!--div class="row">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"><span class="checkbox-material"></span> Send Copy to me
                                        </label>
                                    </div>
                                </div>
                            </div-->
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                        <input type="submit" value="BOOK NOW APARTMENT"/>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label style="text-align: center !important">Pay deposits easy and safe with</label>
                                    <fieldset><center><img src="{{url('/')}}/images/paypal.png"></center></fieldset>
                                </div>
                            </div>

                            @elseif(Auth::check() && Auth::user()->user_type != 0)
                             <input type="hidden" id="percent_pay" value="{{ $initials[0]->percentage }}">
                            @elseif(!Auth::check())
                            <input type="hidden" id="percent_pay" value="30">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                        <input type="submit" value="BOOK NOW APARTMENT"/>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                   <label style="text-align: center !important">Pay deposits easy and safe with</label>
                                    <fieldset><center><img src="{{url('/')}}/images/paypal.png"></center></fieldset>
                                </div>
                            </div>
                            @endif

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="offer-description">
	<div class="container">
    	<div class="row">
        	<div class="col-md-8">
            	<h1>Description</h1>
                <p>{{ $properties[0]->description }}</p>
            </div>
        </div>
        <div class="row mar-t25 p-lineheight-30">
        	<div class="col-md-2">
            	<p>The accomodation</p>
            </div>
            <div class="col-md-3">
            	<p>Type of accomodation: Apartment</p>
                <p>Shelter for: {{ $properties[0]->apartment_for }}</p>
            </div>
            <div class="col-md-3">
            	<p>Bedroom: {{ $properties[0]->bedroom }}</p>
				<p>Bathroom: {{ $properties[0]->bathroom }}</p>
                <p>Beds: {{ $properties[0]->bed }}</p>
            </div>
        </div>
    </div>
</div>
<div class="features">
	<div class="container">
    	<div class="row">
        	<div class="col-md-2">
            	<p>Features &<br> Amenities</p>
            </div>
        	<div class="col-md-5">
            	<table>
                    <?php $count =1; ?>
                    @foreach($properties[0]->features as $feature)
                    <?php $core_feature =  \App\Feature::where('id', $feature->feature_id)->get(); ?>
                    @if($count%2 == 1)
                    <tr>
                        <td width="30%"><img src="{{ url('/')}}/images/feature/{{ $core_feature[0]->path }}" /> <span>{{ $core_feature[0]->name }}</span></td>
                    <?php $count++; ?>
                    @elseif($count%2 == 0)
                    <td width="30%"><img src="{{ url('/')}}/images/feature/{{ $core_feature[0]->path }}" /> <span>{{ $core_feature[0]->name }}</span></td>
                    </tr>
                    <?php $count++; ?>
                    @endif                
                    
                    @endforeach
                    
                </table>
            </div>
        </div>
    </div>
</div>

<div class="features">
	<div class="container">
        <div class="row">
            <div class="col-md-9">
                <table>
                    <tr>
                        <td width="9%">Minimum stay</td>
                        <td width="30%">{{ $properties[0]->min_stay }} Night</td>
                    </tr>
                    <tr>
                        <td>Available</td>
                        <td>{{ date('d.m.Y',strtotime($properties[0]->start_date)) }} </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="prices">
	<div class="container">
        <div class="row">
            <div class="col-md-9">
                <table>
                    
                    <tr>
                        <td width="9%">Prices</td>
                        <td width="30%">Night price: {{ $properties[0]->price_per_night }} CHF / Night</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>Cancellation: {{ $properties[0]->cancel_day }} days</td>
                       
                    </tr> 	

                    <tr>
                        <td>&nbsp;</td>
                        <td>Cancellation fee: {{ $properties[0]->cancel_fee }} % of booking amount</td>
                    </tr>   		
                </table>
            </div>
        </div>
    </div>
</div>
<style>
#map_some{
    height: 450px !important;
}


 

</style>
 <script>
 $(document).ready(function()
    {
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var map;
      var infowindow;
      var geocoder;
      geocoder = new google.maps.Geocoder();


      $('#mapbutton').click(function()
      {
          var address = $('#address').val();
          var radius_km = $('#radius_km').val();
           geocoder.geocode( { 'address': address}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                  map.setCenter(results[0].geometry.location);

                   var radiusOptions = {
                    strokeColor: "#FF0000",
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: 'FFFFFF',
                    fillOpacity: 0.35,
                    map: map,
                    center: results[0].geometry.location, // I want to set the center around the users location
                    radius: 1000 * parseInt(radius_km) // I want the radius to be in miles, how do I do this?
                  };

                  // add the radius circle to the map
                  search_radius = new google.maps.Circle(radiusOptions);
                  search_radius.setMap(map);
                
              } else {
                //alert('Geocode was not successful for the following reason: ' + status);
              }
            });
          //alert(address + ":" + radius_km);

      });


       $(initMap);
      function initMap() {
        var address = "<?php echo $properties[0]->street." ".$properties[0]->plz_place;?>";
        geocoder.geocode( { 'address': address}, function(results, status) {


        var pyrmont = results[0].geometry.location;
        infowindow = new google.maps.InfoWindow();

        map = new google.maps.Map(document.getElementById('map_some'), {
          center: pyrmont,
          zoom: 14
        });

        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        


        service.nearbySearch({
          location: pyrmont,
          radius: 500,
          type: ['store']
        }, callback);

        });
        
      }

      function callback(results, status) {
       

       
            var address = "<?php echo $properties[0]->street." ".$properties[0]->plz_place;?>";
            var icon_path = "<?php echo $properties[0]->icon_path;?>";

            geocoder.geocode( { 'address': address}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
               
                <?php
                if(count($properties[0]->images)!= 0)
                {
                ?>    
                var html = ' <div class="map-pointer"> <figure> <img src="{{ url('/') }}/images/thumb/{{ $properties[0]->images[0]->path}}" /> <div class="price">CHF {{ $properties[0]->price_per_night}}</div> </figure> <a href="">{{ $properties[0]->street }} ({{ $properties[0]->title }})</a></div>';
                <?php
                }else
                {
                ?>
                var html = ' <div class="map-pointer"> <figure> <img src="" alt="No Image Found" /> <div class="price">CHF {{ $properties[0]->price_per_night}}</div> </figure> <a href="">{{ $properties[0]->street }} ({{ $properties[0]->title }})</a></div>';
                <?php
                }
                ?>

                 
                //console.log(html);
                createMarker(JSON.parse(JSON.stringify(results[0].geometry.location)), html, icon_path);
                
              } else {
                //alert('Geocode was not successful for the following reason: ' + status);
              }
            });
          
      }

      function createMarker(place, html, icon_path) {
        
        var placeLoc = place;
        var marker = new google.maps.Marker({
          icon: "{{url('/')}}/product/" + icon_path,
          //icon : "{!! url('/') !!}/product/map-marker.png",  
          map: map,
          position: place,
          title:html
        });
        
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(this.title);
            infowindow.open(map, this);
            $('.flexslider').flexslider({
                    animation: "slide"
                  });
        });

        google.maps.event.addListener(marker, 'mouseover', function (e) {
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
          if(marker.getIcon().indexOf("product_") != -1)
          {
            marker.setIcon(marker.getIcon().replace("product_red", "product"));
          }
        });
          
        
      }     
   
 });     
    </script>
<div class="map" id="map_some">
	
</div>


@include('frontend.includes.popups')
@endsection