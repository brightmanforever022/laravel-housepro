@extends('frontend.layout.master')
 @section('content')
    <div class="container">
	<div class="row">
    	<div class="col-lg-4 col-md-5 col-sm-6">
        </div>
        <div class="col-lg-8 col-md-7 col-sm-6">
            <div class="profile-edit">
            	<h1>Jhon Doe <a href="{{ route('profile.edit') }}">Edit Profile</a></h1>
                <div class="clearfix"></div>
                <ul>
                	<li>
                    	<fieldset>
                        	<label><i class="fa fa-circle"></i> Used ID</label>
                            <p>Jhone_doe497</p>
                        </fieldset>
                    </li>
                    <li>
                    	<fieldset>
                        	<label><i class="fa fa-circle"></i> First Name</label>
                            <p>Jhone7</p>
                        </fieldset>
                    </li>
                    <li>
                    	<fieldset>
                        	<label><i class="fa fa-circle"></i> Last Name</label>
                            <p>Doe</p>
                        </fieldset>
                    </li>
                    <li>
                    	<fieldset>
                        	<label><i class="fa fa-circle"></i> Age</label>
                            <p>24 Years</p>
                        </fieldset>
                    </li>
                    <li>
                    	<fieldset>
                        	<label><i class="fa fa-circle"></i> Facebook URL</label>
                            <p><a href="">www.facebook.com/jhonedoe</a></p>
                        </fieldset>
                    </li>
                    <li>
                    	<fieldset>
                        	<label><i class="fa fa-circle"></i> Gender</label>
                            <p>Male</p>
                        </fieldset>
                    </li>
                    <li>
                    	<fieldset>
                        	<label><i class="fa fa-circle"></i> Timezone</label>
                            <p>UTC+5:30, Delhi</p>
                        </fieldset>
                    </li>
                    <li>
                    	<fieldset>
                        	<label><i class="fa fa-circle"></i> Language</label>
                            <p>English</p>
                        </fieldset>
                    </li>
                    <li>
                    	<fieldset>
                        	<label><i class="fa fa-circle"></i> Email</label>
                            <p>Jhone_doe@gmail.com</p>
                        </fieldset>
                    </li>
                    <li>
                    	<fieldset>
                        	<label><i class="fa fa-circle"></i> Date of Birth</label>
                            <p>06 July 1991</p>
                        </fieldset>
                    </li>
                    <li>
                    	<fieldset>
                        	<label><i class="fa fa-circle"></i> Zodiac Sign</label>
                            <p>Libra</p>
                        </fieldset>
                    </li>
                    <li>
                    	<fieldset>
                        	<label><i class="fa fa-circle"></i> Location</label>
                            <p>New York, USA</p>
                        </fieldset>
                    </li>
                </ul>
            </div>  
        </div>
    </div>
</div>
@include('frontend.includes.popups')
 @stop