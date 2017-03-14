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
                <h1>Your personal dashboard.</h1>
                <p>In the dashboard you have an overview of all functions.</p>
            </div>
           
        </div>
    </div>
</div>
<div class="booking">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>dashboard</h1>
            </div>
        </div>
        
        <div class="dashboard-box">  
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="{!! url('/create_new_add') !!}">
                        <div class="circle"><img src="images/dashboard-icon1.png"></div>
                        <h1>Add listings</h1>
                    </a>
                </div> 
                 <div class="col-md-3 col-sm-6">
                    <a href="{{ url('/listing') }}">
                        <div class="circle"><img src="images/dashboard-icon2.png"></div>
                        <h1>My listings</h1>
                    </a>
                </div>
                 <div class="col-md-3 col-sm-6">
                    <a href="{{ url('/edit-profile-host') }}">
                        <div class="circle"><img src="images/dashboard-icon3.png"></div>
                        <h1>Edit Profile / Account</h1>
                    </a>
                </div>
                 <div class="col-md-3 col-sm-6">
                    <a href="{{ url('/booking') }}">
                        <div class="circle"><img src="images/dashboard-icon4.png"></div>
                        <h1>Bookings</h1>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mar-tb100">
            <div class="col-md-12">
                <h1>Notifications</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if(!empty($messages))
                @foreach($messages as $message)
                    <div class="notification-box">
                        <p>{{$message->message}}</p>
                    </div>
                @endforeach
                @else
                    <div class="notification-box">
                        <p>Sorry, There are no messagefor you.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<style>
.fancybox-close {
    display: block !important;
    box-shadow: none !important;
}
.fancybox-close:hover{
    box-shadow: none !important;
}
</style>
@include('frontend.includes.popups')
@endsection


