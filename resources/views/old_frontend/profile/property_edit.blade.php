@extends('frontend.layout.master-profile')
@section('content')
<script>
var proper_id = <?php echo $properties[0]->id;?>;
@if($properties[0]->ical_path != "")
$("#startdate").datepicker({ dateFormat: 'mm/dd/yy' }).datepicker();
$("#enddate").datepicker({ dateFormat: 'mm/dd/yy' }).datepicker();
@endif
</script>
<script type="text/javascript" src="{!! url('/') !!}/js/custom/propertyedit.js"></script>

<ul id="wheel-tab" data-tabs="tabs" style="list-style: none;">
     <li class="active"><a href="#tab-1" data-toggle="tab"></a></li>
     <li><a href="#tab-2" data-toggle="tab"></a></li>
</ul>

<form method="post" enctype="multipart/form-data" action="{{ url('/saveEditProperty') }}" id="property_form">
{!! csrf_field() !!}
<input type="hidden" name="property_id" id="property_id" value="{{ $properties[0]->id }}">
<div class="create-add">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Edit ads.</h1>
            </div>
            @if(Session::has('message'))
                        <div class="alert-box success" id="successMessage">
                        <h4 style="color:{{ Session::get('color') }}">{{ Session::get('message') }}</h4>
                        </div>
            @endif
        </div>
    </div>
</div>

<div class="tab-content">
    <div class="tab-pane active" id="tab-1">
        


<div class="create-add-form">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="steps-box">
                    <h1>Step 1</h1>
                    <p>Where is the apartment?</p>
                    <fieldset>
                        
                        <input type="text" name="plz_place" id="plz_place" placeholder="City*" value="{{ $properties[0]->plz_place }}"/>
                    </fieldset>
                    <fieldset>   
                        <input type="text" name="street" placeholder="Street, Nr.*" value="{{ $properties[0]->street }}" id="street_create_edit"/>
                        <input type="hidden" name="lat" id="street_lat_edit" value="{{ $properties[0]->lat }}">
                        <input type="hidden" name="lng" id="street_lng_edit" value="{{ $properties[0]->lng }}">
                    </fieldset>
                    <fieldset>
                         <div class="select-icon">
                            <select name="country" class="valid" aria-invalid="false">
                                <option value="0">Country*</option>
                                @foreach($countries as $key=>$val)
                                <option value="{!! $val->id !!}" selected="">{!! $val->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </fieldset>
                    <fieldset class="mar-t245">
                        <p>Please enter the address of the apartment. The will seen later on the map.</p>
                    </fieldset>
                </div>
            </div>
            <div class="col-md-4">
                <div class="steps-box">
                    <h1>Step 2</h1>
                    <p>Enter key data on the apartment</p>
                    <fieldset>
                        <input type="text" name="bedroom" placeholder="Bedroom*" value="{{ $properties[0]->bedroom }}"/>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="bathroom" placeholder="Bathroom*" value="{{ $properties[0]->bathroom }}"/>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="bed" placeholder="Beds*" value="{{ $properties[0]->bed }}"/>
                    </fieldset>
                    <fieldset>
                        <div class="select-icon firstSelect">
                            <select name="apartment_for">
                                <option>Apartment for*</option>
                                @foreach($guests as $key=>$guest)
                                @if($guest == $properties[0]->apartment_for)
                                <option value="{{ $guest }}" selected="selected">{{ $guest }}</option>
                                @else
                                 <option value="{{ $guest }}">{{ $guest }}</option>
                                @endif
                                @endforeach
                                <!--option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option-->
                            </select>
                        </div>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="lining_space" placeholder="Living space m2*" value="{{ $properties[0]->lining_space }}"/>
                    </fieldset>
                    <fieldset>
                        <div class="select-icon secondSelect">
                            <select name="property_type_id">
                                <option>Property type*</option>
                                @foreach($property_types as $key=>$val)
                                 @if($val->id == $properties[0]->property_type_id)
                                 <option value="{!! $val->id !!}" selected=selected>{!! $val->name !!}</option>
                                 @else
                                  <option value="{!! $val->id !!}" >{!! $val->name !!}</option>
                                 @endif 


                                @endforeach
                            </select>
                        </div>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="reference" maxlength="10" id="addReference" placeholder="Object Reference*" value="{{ $properties[0]->reference }}"/>
                    </fieldset>
                    <fieldset>
                        <p>Specify the key data of their apartments. Thus, it falls propective easier to choose your apartment.</p>
                    </fieldset>
                </div>
            </div>
            <div class="col-md-4">
                <div class="steps-box">
                    <h1>Step 3</h1>
                    <p>Price in CHF</p>
                    <fieldset>
                        <input type="text" name="price_per_night" placeholder="Price per night*" value="{{ $properties[0]->price_per_night }}"/>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="price_per_week" placeholder="Price per week*" value="{{ $properties[0]->price_per_week }}"/>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="cleaning_fee" placeholder="Cleaning Fee" value="{{ $properties[0]->cleaning_fee }}"/>
                    </fieldset>
                    
                        <!--div id='calendar'></div-->
                        @if($properties[0]->ical_path == "")
                        <input type="hidden" name="ical_path" value=""/>
                        <input type="hidden" name="start_date" value="{{ date('d/m/y',strtotime($properties[0]->start_date)) }}">
                        <input type="hidden" name="end_date" value="{{ date('d/m/y',strtotime($properties[0]->end_date)) }}">
                        @else
                        <fieldset>
                        <input type="text" name="ical_path" placeholder="Availability:connect with .ical" value="{{ $properties[0]->ical_path }}"/>
                         <input type="hidden" name="start_date" value="{{ date('d/m/y',strtotime($properties[0]->start_date)) }}">
                        <input type="hidden" name="end_date" value="{{ date('d/m/y',strtotime($properties[0]->end_date)) }}">
                        </fieldset>
                        @endif
                    
                   
                        @if($properties[0]->ical_path == "")
                        <fieldset>
                        <div class="row">
                            <div class="col-md-12">
                                <h6>Availability</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="select-icon thirdSelect">
                                   <input type="text" class="datepicker" data-date-format="dd/mm/yy" name="start_date"  placeholder="From*" id="startdate" value="{{ date('d/m/y',strtotime($properties[0]->start_date)) }}"/>
                                </div>
                                <!--div class="select-icon">
                                    <select>
                                        <option>From*</option>
                                    </select>
                                </div-->
                            </div>
                            <div class="col-lg-6">
                               <div class="select-icon fourthSelect">
                                   <input type="text" data-date-format="dd/mm/yy" class="datepicker" name="end_date" placeholder="To*" id="enddate" value="{{ date('d/m/y',strtotime($properties[0]->end_date)) }}"/>
                                </div>
                                <!--div class="select-icon">
                                    <select>
                                        <option>To*</option>
                                    </select>
                                </div-->
                            </div>
                        </div>
                        </fieldset>
                        @endif
                    

                   
                    <fieldset>
                        <input type="text" name="min_stay" placeholder="Minimum stay / night*" value="{{ $properties[0]->min_stay }}"/>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="cancel_day" placeholder="Cancel day in advance*" value="{{ $properties[0]->cancel_day }}"/>
                    </fieldset>
                    <fieldset>
                        <div class="select-icon fifthSelect" >
                            <select name="cancel_fee">
                                @if($properties[0]->cancel_fee == 15)
                                <option>Cancellation fee*</option>
                                <option value="15" selected=selected>15%</option>
                                <option value="20">20%</option>
                                <option value="30">25%</option>
                                @elseif($properties[0]->cancel_fee == 20)
                                <option>Cancellation fee*</option>
                                <option value="15" selected=selected>15%</option>
                                <option value="20" selected=selected>20%</option>
                                <option value="30">25%</option>
                                @else
                                <option>Cancellation fee*</option>
                                <option value="15" selected=selected>15%</option>
                                <option value="20">20%</option>
                                <option value="30" selected=selected>25%</option>
                                @endif

                            </select>
                        </div>
                    </fieldset>
                    <fieldset>
                        <p>Specify different tariffs , price per night per week. In addition to costs, the final cleaning is included. Availability : Connect with .ical or manually enter a date.</p>
                    </fieldset>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <a href="#" id="wheel-right" class="continue-btn">CONTINUE</a>
            </div>
        </div>
    </div>
</div>


    </div>
    <div class="tab-pane" id="tab-2">
       <div class="create-add-form">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="steps-box">
                    <h1>Step 4</h1>
                    <p>Features and amenities</p>
                    @foreach($properties[0]->features as $key=>$val)
                    
                    @endforeach
                        <?php $count =1; $checkbox=0;?>
                        @foreach($features as $key=>$feature)

                        @if($count == 1)
                        
                        @foreach($properties[0]->features as $key=>$val)
                        @if($val->feature_id == $feature->id)
                        <?php $checkbox = 1?>
                        @break;
                        @endif
                        @endforeach 
                        @if($checkbox == 1)
                        <div class="row mar-t25">
                            <div class="col-md-6 pad-lr0">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name='checkboxvar[]' value="{{ $feature->id }}" checked="checked"> {{ $feature->name }} 
                                    </label>
                                </div>
                        </div>
                           <?php $checkbox = 0; ?>
                        @else
                        <div class="row mar-t25">
                            <div class="col-md-6 pad-lr0">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name='checkboxvar[]' value="{{ $feature->id }}"> {{ $feature->name }} 
                                    </label>
                                </div>
                        </div>
                        @endif

                        @endif    
                        @if($count == 2)
                            @foreach($properties[0]->features as $key=>$val)
                        @if($val->feature_id == $feature->id)
                        <?php $checkbox = 1?>
                        @break;
                        @endif
                        @endforeach 
                        @if($checkbox == 1)
                        <div class="col-md-6 pad-lr0">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name='checkboxvar[]' value="{{ $feature->id }}" checked="checked"> {{ $feature->name }} 
                                    </label>
                                </div>
                            </div>
                        </div>
                           <?php $checkbox = 0; ?>
                        @else
                        <div class="col-md-6 pad-lr0">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name='checkboxvar[]' value="{{ $feature->id }}"> {{ $feature->name }} 
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endif

                            
                        @endif
                        @if($count%2 == 1 && $count>2)
                        @foreach($properties[0]->features as $key=>$val)
                        @if($val->feature_id == $feature->id)
                        <?php $checkbox = 1?>
                        @break;
                        @endif
                        @endforeach 
                        @if($checkbox == 1)
                        <div class="row">
                            <div class="col-md-6 pad-lr0">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name='checkboxvar[]' value="{{ $feature->id }}" checked="checked"> {{ $feature->name }} 
                                    </label>
                                </div>
                            </div>
                           <?php $checkbox = 0; ?>
                        @else
                        <div class="row">
                            <div class="col-md-6 pad-lr0">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name='checkboxvar[]' value="{{ $feature->id }}"> {{ $feature->name }} 
                                    </label>
                                </div>
                            </div>
                        @endif

                        @endif
                        @if($count%2 == 0 && $count>2)
                        @foreach($properties[0]->features as $key=>$val)
                        @if($val->feature_id == $feature->id)
                        <?php $checkbox = 1?>
                        @break;
                        @endif
                        @endforeach 
                        @if($checkbox == 1)
                         <div class="col-md-6 pad-lr0">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name='checkboxvar[]' value="{{ $feature->id }}" checked="checked"> {{ $feature->name }} 
                                    </label>
                                </div>
                            </div>
                        </div>
                           <?php $checkbox = 0; ?>
                        @else
                        <div class="col-md-6 pad-lr0">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name='checkboxvar[]' value="{{ $feature->id }}"> {{ $feature->name }} 
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endif

                           
                        @endif
                        <?php $count++; ?>
                        @endforeach


                        <fieldset class="mar-lr-15">
                            <p>Please share with interested parties as the apartment is equipped.</p>
                        </fieldset>
                </div>
            </div>
            <div class="col-md-4">
                <div class="steps-box">
                    <h1>Step 5</h1>
                    <p>Upload pictures (max. 9)</p>
                    <div class="upload-pic">
                        <div class="upload">
                            <input type="file" 
                             name="upload[]"  class="imageUpload" id="imageUploadFile" multiple="multiple" />

                        </div>
                        <p>Maximum size: 8 MB</p>
                        
                        <div class="row imageOutput" id="simpleList">
                            @foreach($properties[0]->images as $key=>$val)
                            <div class="col-xs-4"><div class="image-box"><img data-imageid="{{ $val->id }}" src="{{ url('/') }}/images/profile/{{ $val->path }}" /><div> <a href="javascript:void(0)" data-imageid="{{ $val->id }}"  data-count="{{ count($properties[0]->images) }}" class="cross delete_image_one"><img src="{{ url('/') }}/images/cross.png" /></a></div></div></div>
                            @endforeach
                           
                        </div>
                    </div>
                    <fieldset>
                        <p>Good pictures increase the attractiveness of their apartments particularly. A few Tips:<br><br>
                        Recording quality (min . 1920 x 1080 px)<br><br>
                        Acceptable image formats : JPG , PNG</p>
                    </fieldset>
                </div>
            </div>
            <div class="col-md-4">
                <div class="steps-box">
                    <h1>Step 6</h1>
                    <p>Describe the apartment</p>
                    <fieldset>
                        <input type="text" name="title" placeholder="Title* (short und appealing)" value="{{ $properties[0]->title }}"/>
                    </fieldset>
                    <fieldset>
                        <textarea name="description" placeholder="Description*">{{ $properties[0]->description }}</textarea>
                    </fieldset>
                    
                    <fieldset>
                        <p>Enter a brief description of the apartments. Tell also what can seek guest around. Public transport , shopping opportunities , or restaurants.</p>
                    </fieldset>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <!--div class="col-md-4">
            <a href="#" id="wheel-left" >PREVIOUS</a>
            </div-->
            <div class="col-md-4">
                <a href="#" id="wheel-left" class="continue-btn">PREVIOUS</a>
            </div>


            <div class="col-md-4">
                <a href="javascript:void(0);" class="continue-btn continue-btn-save-form"><i class="fa fa-save"></i> SAVE</a>
            </div>

        </div>
    </div>
</div>
    
</div>
</div>
</form>

@include('frontend.includes.popups')
@endsection