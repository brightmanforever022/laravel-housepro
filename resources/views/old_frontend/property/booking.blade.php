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
                <h1>all bookings at a glance.</h1>
                <p>Find your adopted, open or rejected bookings. The booking confirmation can be reviewed as a PDF at any time again.</p>
            </div>
            <div class="col-md-6">
                <a href="{!! url('/create_new_add') !!}" class="create-add-btn create-add-btn-property"  data-userid="{{ Auth::user()->id }}">+ Create new ads</a>
            </div>
        </div>
    </div>
</div>
<div class="booking">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>BOOKINGS</h1>
                @if(Session::has('message'))
                        <div class="alert-box success" id="successMessage">
                        <h4 style="color:{{ Session::get('color') }}">{{ Session::get('message') }}</h4>
                        </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="adopt-reject">
                    <ul>
                        @if(Auth::check() && Auth::user()->user_type == 1)
                        <li class="active" ><a href="{!! url('/booking') !!}">Booking requests</a></li>
                        @else
                         <li class="active" ><a href="{!! url('/booking-tenant') !!}">Booking requests</a></li>
                        @endif
                        <li>/</li>
                        <li><a href="{{ url('/') }}/booking-adopt" class="active">Adopted</a></li>
                        <li>/</li>
                        <li><a href="{{ url('/') }}/booking-reject">Rejected</a></li>
                        
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="booking-box">  
                @if(count($properties)) 
                    <ul>
                        @foreach($properties as $property)

                        <li class="delete-parent">
                        <div class="row">
                        <?php $booked_user = App\User::where('id', $property->booking->user_id)->get()?>
                            <div class="col-md-3">
                            @if(count($property->images))
                                <figure><img src="{{ url('/images/thumb/') }}/{{$property->images[0]->path}}" /></figure>
                            @else
                                 <figure><img src="" alt="Image not found" /></figure>
                            @endif
                            </div>

                            <div class="col-md-9">
                                <h2><strong>Request from: {{ date('d.m.Y',strtotime($property->booking->booking->check_in))}} {{$property->title}} ,</strong> {{ $property->street }}, {{ $property->plz_place }} 
                                <?php 
                                $count_read = App\Message::where('owner_id', $property->booking->user_id)->where('is_read', 0)->where('booking_id', $property->booking_id)->count();
                                ?>
                                <div class="notify">
                                    <a href="#login_message" class="fancybox messagebefore" data-propertyid="{{$property->id}}" data-bookingid="{{  $property->booking_id}}" data-ownerid="{{Auth::user()->id}}" ><img src="{{url('/')}}/images/message_new.png"></a>
                                    <div class="circle-red">{{$count_read}}</div>
                                </div>
                                </h2>
                                <div class="row">
                                    <div class="col-md-9">
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="arr-dept">
                                            <table>
                                                <tr>
                                                    <th width="33.33%">Check In</th>
                                                    <th width="33.33%"></th>
                                                    <th width="33.33%">Check Out</th>
                                                </tr>
                                                <tr>                
                                                    <td width="33.33%">{{ date('D, d. M. Y',strtotime($property->booking->booking->check_in))}}</td>
                                                    <td width="33.33%" class="text-center">-</td>
                                                    <td width="33.33%">{{ date('D, d. M. Y',strtotime($property->booking->booking->check_out))}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="arr-dept">
                                            <table>
                                                <tr>
                                                    <th>Total Amount</th>
                                                    <th>Paid Deposit</th>
                                                </tr>
                                                <tr>                
                                                    <td>${{ $property->booking->amount }}</td>
                                                    <td class="paid-color">${{ $property->booking->initial }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    </div>
                                    @if($property->property_booking_status == 0)
                                        <div class="row">
                                            <div class="col-md-5">
                                                <a href="{{ url('/') }}/accept/{{$property->id}}" class="accept">Accept</a>
                                            </div>
                                            <div class="col-md-5">
                                                <a href="{{ url('/') }}/reject/{{$property->id}}" class="reject">Reject</a>
                                            </div>
                                        </div>
                                        @elseif($property->property_booking_status == 1)
                                        <div class="row">
                                            <div class="col-md-5 col-xs-5">
                                                <div class="confirm">Adopted</div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="pdf"><a href="{{ url('/bookings/') }}/{{$property->booking->booking_pdf}}"  target="_blank"><img src="images/Booking-PDF.png" /></a></div>

                                            </div>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-md-5">
                                                <a href="" class="reject">Rejected</a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>


                                    <div class="col-md-3">
                                        <div class="customer-info">
                                             <table>
                                                <tr>
                                                    <th>Customer information</th>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>{{ $booked_user[0]->saluation }}</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>{{ $booked_user[0]->name }} {{ $booked_user[0]->surname }}</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>{{ $booked_user[0]->address}}</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>{{ $booked_user[0]->place}}</td>
                                                    
                                                </tr>
                                                <tr>
                                                <td>Phone +41 {{ $booked_user[0]->phone }}</td>
                                                </tr>
                                                <tr>
                                                <td>Mail {{ $booked_user[0]->email }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                           
                        </div>
                    </li>
                    @endforeach
                        
                    </ul>
                    @else
                    No Booking Found.
                    @endif
                </div>
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