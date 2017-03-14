@extends('frontend.layout.master-profile')
@section('content')

<script type="text/javascript" src="{!! url('/') !!}/js/custom/newaddblade.js">

</script>


<ul id="wheel-tab" data-tabs="tabs" style="list-style: none;">
     <li class="active"><a href="#tab-1" data-toggle="tab"></a></li>
     <li><a href="#tab-2" data-toggle="tab"></a></li>
</ul>

<form method="post" enctype="multipart/form-data" action="{{ url('/saveProperty') }}" id="property_form">
{!! csrf_field() !!}
<div class="create-add">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>create new ads.</h1>
            </div>
        </div>
    </div>
</div>

<div class="tab-content">
    <div class="wait_loading" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;"><img src='{{url("/")}}/images/ajax-loader APARTOLINO.gif' width="64" height="64" /><br>Loading..</div>
    <div class="tab-pane active" id="tab-1">
        


<div class="create-add-form">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="steps-box">
                    <h1>Step 1</h1>
                    <p>Where is the apartment?</p>
                    <fieldset>
                        <input type="text" name="plz_place" id="plz_place" placeholder="City*"/>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="street" placeholder="Street, Nr.*" id="street_create"/>
                        <input type="hidden" name="lat"  id="street_lat"/>
                        <input type="hidden" name="lng"  id="street_lng"/>
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
                        <input type="text" name="bedroom" placeholder="Bedroom*"/>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="bathroom" placeholder="Bathroom*"/>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="bed" placeholder="Beds*"/>
                    </fieldset>
                    <fieldset>
                        <div class="select-icon firstSelect">
                            <select name="apartment_for">
                                <option>Apartment for*</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                            </select>
                        </div>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="lining_space" placeholder="Living space m2*"/>
                    </fieldset>
                    <fieldset>
                        <div class="select-icon secondSelect">
                            <select name="property_type_id">
                                <option>Property type*</option>
                                @foreach($property_types as $key=>$val)
                                 <option value="{!! $val->id !!}">{!! $val->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="reference" maxlength="12" id="addReference" placeholder="Object Reference*"/>
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
                        <input type="text" name="price_per_night" placeholder="Price per night*"/>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="price_per_week" placeholder="Price per week*"/>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="cleaning_fee" placeholder="Cleaning Fee"/>
                    </fieldset>
                    <fieldset>
                         <input type="text" name="ical_path" id="connect_with_ical" placeholder="Availability:connect with .ical"/>
                    </fieldset>
                    <div id="not_connect_with_date" >
                           
                    </div>
                    <fieldset class="mar-t0">
                    <div class="row">
                            <div class="col-md-12">
                                <h6 class="text-center">Or</h6>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mar-t0">
                         <button class="avilable-button">Availability: with date</button>
                    </fieldset>
                    <fieldset id="connect_with_date"  class="mar-t0">
                        
                       
                    </fieldset>
                    
                    <fieldset>
                        <input type="text" name="min_stay" placeholder="Minimum stay / night*"/>
                    </fieldset>
                    <fieldset>
                        <input type="text" name="cancel_day" placeholder="Cancel day in advance*"/>
                    </fieldset>
                    <fieldset>
                        <div class="select-icon fifthSelect" >
                            <select name="cancel_fee">
                                <option>Cancellation fee*</option>
                                <option value="15">15%</option>
                                <option value="20">20%</option>
                                <option value="30">25%</option>
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
                <a href="#" id="wheel-right" class="continue-btn continue-refernece">CONTINUE</a>
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
                        <?php $count =1; ?>
                        @foreach($features as $key=>$feature)
                        @if($count == 1)
                        <div class="row mar-t25">
                            <div class="col-md-6 pad-lr0">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name='checkboxvar[]' value="{{ $feature->id }}"> {{ $feature->name }} 
                                    </label>
                                </div>
                            </div>
                        @elseif($count == 2)
                            <div class="col-md-6 pad-lr0">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name='checkboxvar[]' value="{{ $feature->id }}"> {{ $feature->name }} 
                                    </label>
                                </div>
                            </div>
                        </div>
                        @elseif($count%2 == 1)
                        <div class="row">
                            <div class="col-md-6 pad-lr0">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name='checkboxvar[]' value="{{ $feature->id }}"> {{ $feature->name }} 
                                    </label>
                                </div>
                            </div>
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
                            
                            <!--div class="col-xs-4">
                                <div class="image-box"></div>
                            </div>
                            <div class="col-xs-4">
                                <div class="image-box"></div>
                            </div>
                            <div class="col-xs-4">
                                <div class="image-box"></div>
                            </div>
                            <div class="col-xs-4">
                                <div class="image-box"></div>
                            </div>
                            <div class="col-xs-4">
                                <div class="image-box"></div>
                            </div>
                            <div class="col-xs-4">
                                <div class="image-box"></div>
                            </div>
                            <div class="col-xs-4">
                                <div class="image-box"></div>
                            </div>
                            <div class="col-xs-4">
                                <div class="image-box"></div>
                            </div-->
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
                        <input type="text" name="title" placeholder="Title* (short und appealing)"/>
                    </fieldset>
                    <fieldset>
                        <textarea name="description" placeholder="Description*"></textarea>
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