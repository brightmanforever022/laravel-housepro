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
            	<h1>EDIT PROFILE AND ACCOUNT.</h1>
                <p>Fill out the payment details, they are also sent to the customer in the booking confirmation.</p>
            </div>
            @if(Auth::check() && Auth::user()->user_type == 1)
            <div class="col-md-6">
            	<a href="{!! url('/create_new_add') !!}" class="create-add-btn">+ Create new ads</a>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="create-add-form">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1>PROFILE INFORMATION</h1>
                 @if(Session::has('message'))
                        <div class="alert-box success" id="successMessage">
                        <h4 style="color:{{ Session::get('color') }}">{{ Session::get('message') }}</h4>
                        </div>
                  @endif
            </div>
        </div>
        <form method="post" action="{!! url('/editUserForm') !!}" id="edit-host-form"  class="edit-host-form" enctype="multipart/form-data">
        {!! csrf_field() !!}
    	<div class="row">
        	<div class="col-md-8">
            	<div class="steps-box min-height-577">
                	<h1 class="text-left">address</h1>
                    <fieldset>
                    	<div class="row">
                        	<div class="col-md-6">
                    			<input type="text" name="company" placeholder="Company*" value="{!! $user_data[0]->company !!}"/>
                            </div>
                            <div class="col-md-6 res-mart-30">
                    			<div class="select-icon">
                                    <select name="saluation">

                                        <option value="Mr" @if($user_data[0]->saluation == 'Mr') selected=selected @endif >Mr</option>
                                        <option value="Mrs" @if($user_data[0]->saluation == 'Mrs') selected=selected @endif >Mrs</option>
                                        <option value="Ms" @if($user_data[0]->saluation == 'Ms') selected=selected @endif >Ms</option>

                                     
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                    	<div class="row">
                        	<div class="col-md-6">
                    			<input type="text" name="name" placeholder="Name*" value="{!! $user_data[0]->name !!}"/>
                            </div>
                            <div class="col-md-6 res-mart-30">
                                <input type="text" name="surname" placeholder="Surname*" value="{!! $user_data[0]->surname !!}"/>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                    	<div class="row">
                        	<div class="col-md-6">
                    			<input type="text" name="address" placeholder="Street, Nr.*" value="{{ $user_data[0]->address }}"/>
                            </div>
                            <div class="col-md-6 res-mart-30">
                                <input type="text" name="city" placeholder="City*" value="{{ $user_data[0]->city }}"/>
                    			<input type="hidden" name="    additional_address" placeholder="Additional address" value="{!! $user_data[0]->additional_address !!}"/>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                    	<div class="row">
                        	<div class="col-md-6">
                                <input type="text" name="zipcode" placeholder="Zipcode*" value="{{ $user_data[0]->zipcode }}"/>
                    			<input type="hidden" name="place" placeholder="Place*" value="{{ $user_data[0]->place }}"/>
                            </div>
                            <div class="col-md-6 res-mart-30">
                    			<div class="select-icon">
                                    <select name="country">
                                        <option value="0">Country*</option>
                                         <option value="1" selected>Switzerland</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    {{-- <fieldset>
                        <div class="row">
                            <div class="col-md-6"> --}}
                                
                            {{-- </div> --}}
                            {{-- <div class="col-md-6 res-mart-30"> --}}
                                
                            {{-- </div> --}}
                        {{-- </div> --}}
                    {{-- </fieldset> --}}
                    <fieldset>
                    	<div class="row">
                        	<div class="col-md-6">
                    			<input type="text" name="phone" placeholder="Phone*" value="+41{{ $user_data[0]->phone }}" id="phone"/>
        <label id="phone-error-some" class="error" for="phone_some"></label>    
                            </div>
                            <div class="col-md-6 res-mart-30">
                    			<input type="text" name="email" placeholder="Email*" value="{!! $user_data[0]->email !!}"/>
                            </div>
                        </div>
                    </fieldset>
                    <h1 class="text-left mar-t30">edit password</h1>
                     <fieldset>
                    	<div class="row">
                        	<div class="col-md-6">
                    			<input type="text" name="password" placeholder="Password*"/>
                            </div>
                            <div class="col-md-6 res-mart-30">
                    			<input type="text" name="cpassword" placeholder="New password*"/>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="steps-box min-height-577">
                	<h1 class="text-left">PROFILE PICTURE </h1>
                    <div class="user-img">
                    	<img id="profilepics" src="profilepics/{!! Auth::user()->path !!}" />
                        <div class="cross">
                        	<a href="{!! url('/deleteImage') !!}"><img src="images/cross.png" /></a>
                        </div>
                    </div>
                    <div class="upload-profile-picture">
                    	<input type="file" name="profile_pic" id="imageFile"/>
                    </div>
                    <p class="small-text">Maximum size: 5 MB</p>
                    <fieldset>
                    	<p class="mar-t40">Please upload high profile image. Best to use your company logo for it. The minimum resolution should be 300 x 300 pixels.</p>
                    </fieldset>
                </div>
            </div>
            
            <div class="clearfix"></div>
        </div>
        <div class="row">
        	<div class="col-md-8"></div>
            <div class="col-md-4">
            	<a href="javascript:void(0)" class="continue-btn continue-btn-user"><i class="fa fa-save"></i> SAVE</a>
            </div>
        </div>
        </form>
        <!--div class="row mar-t100">
        	<div class="col-md-12">
            	<h1>account INFORMATION</h1>
            </div>
        </div>
        <div class="row">
        <form method="post" action="{!! url('/editHostAccount') !!}" id="edit-host-account"  class="edit-host-account">
        {!! csrf_field() !!}
            <div class="col-md-8">
            	<div class="steps-box min-height-577">
                	<h1 class="text-left">service fee</h1>
                    <fieldset class="mar-t10">
                    	<p>Capture unlimited number of adverts for your apartments. You only pay a service fee when you receive and accept bookings. The more bookings you get, the less the service fee.<br /><br />
                        Service fee be settled on the booked amount.<br /><br />
                        In red you can see your current level.</p>
                    </fieldset>
                    <fieldset>
                    	<div class="fees-info">
                        	<ul>
                            	<li class="red">
                                	<div class="row">
                                    	<div class="col-md-8">
                                			3.5 % - 15  bookings per year	  					
                                		</div>
                                        <div class="col-md-4">
                                        	Current: 5 bookings
                                        </div>
                                	</div>
                                </li>
                                <li>
                                	<div class="row">
                                    	<div class="col-md-8">
                                			3.0 % - 50  bookings per year	  					
                                		</div>
                                        <div class="col-md-4">
                                        </div>
                                	</div>
                                </li>
                                <li>
                                	<div class="row">
                                    	<div class="col-md-8">
                                			2.5 % - 100 bookings per year		  					
                                		</div>
                                        <div class="col-md-4">
                                        </div>
                                	</div>
                                </li>
                                <li>
                                	<div class="row">
                                    	<div class="col-md-8">
                                			2.0 % - 200 bookings per year			  					
                                		</div>
                                        <div class="col-md-4">
                                        </div>
                                	</div>
                                </li>
                            </ul>
                        </div>
                    </fieldset>
                    <fieldset class="mar-t30">
                    	<p>The service fee will be deducted directly from the deposit payment of the customer. The payment of the deposit by means of escrow .<br /><br />
                        For questions and assistance, please call the support hotline:<br /><br />
                        Phone +41 52 208 10 20</p>
                    </fieldset>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="steps-box min-height-577">
                	<h1 class="text-left">bank account details</h1>
                    <fieldset>
                    @if(count($user_data[0]->account))
                    <input type="text" name="name" placeholder="Name of bank*" value="{!! $user_data[0]->account->name !!}"/>
                    </fieldset>
                    <fieldset>
                    	<input type="text" name="iban" placeholder="IBAN*" value="{!! $user_data[0]->account->iban  !!}"/>
                    </fieldset>
                    <fieldset>
                    	<input type="text" name="bic" placeholder="BIC"  value="{!! $user_data[0]->account->bic  !!}"/>
                    </fieldset>
                    <fieldset>
                    	<input type="text" name="blz" placeholder="BLZ" value="{!! $user_data[0]->account->blz  !!}"/>
                    </fieldset>
                    	<h1 class="text-left mar-t40">DEPOSIT PAYMENTS</h1>
					<fieldset class="mar-t0">
                        <p>Customers pay a deposit of more than one month rent, (30 days) or less by credit card.</p>
                    </fieldset>
                    <h1 class="text-left mar-t100">VAT-nr.</h1>
                     <fieldset>
                    	<input type="text" name="vat_nr" placeholder="Your VAT-NR.*" value="{!! $user_data[0]->account->vat_nr  !!}"/>
                    </fieldset>
                    @else
                    <input type="text" name="name" placeholder="Name of bank*" />
                    </fieldset>
                    <fieldset>
                        <input type="text" name="iban" placeholder="IBAN*" />
                    </fieldset>
                    <fieldset>
                        <input type="text" name="bic" placeholder="BIC" />
                    </fieldset>
                    <fieldset>
                        <input type="text" name="blz" placeholder="BLZ" />
                    </fieldset>
                        <h1 class="text-left mar-t40">DEPOSIT PAYMENTS</h1>
                    <fieldset class="mar-t0">
                        <p>Customers pay a deposit of more than one month rent, (30 days) or less by credit card.</p>
                    </fieldset>
                    <h1 class="text-left mar-t100">VAT-nr.</h1>
                     <fieldset>
                        <input type="text" name="vat_nr" placeholder="Your VAT-NR.*" />
                    </fieldset>
                    @endif
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
        	<div class="col-md-8"></div>
            <div class="col-md-4">
            	<a href="javascript:void(0)" class="continue-btn continue-btn-account"><i class="fa fa-save"></i> SAVE</a>
            </div>
        </div-->
    </div>
</div>
@endsection