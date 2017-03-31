@extends('frontend.layout.master-profile')
@section('content')


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
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="adopt-reject">
                    <ul>
                        @if(Auth::check() && Auth::user()->user_type == 1)
                        <li><a href="{!! url('/booking') !!}">Booking requests</a></li>
                        @else
                         <li><a href="{!! url('/booking-tenant') !!}">Booking requests</a></li>
                        @endif
                        <li>/</li>
                        <li class="active"><a href="javascript:void(0)">Adopted</a></li>
                        <li>/</li>
                        <li><a href="{{ url('/') }}/booking-reject">Rejected</a></li>
                        
                        
                        

                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="booking-box">  
                @if(count($bookings)) 
                    <ul>
                        @foreach($bookings as $booking)
                        @if($booking->booking->booking_status_tenant == 2)
                        @elseif($booking->booking->booking_status_host == 2)
                        @else
                       
                        <?php 
                        $booked_user = App\User::where('id', $booking->user_id)->get();
                        $property = App\Property::where('id', $booking->billing_id)->where('property_booking_status', 1)->get();
                        
                        ?>
                            @if(count($property))
                            <li>
                            <div class="row">
                            <div class="col-md-3">
                                @if(count($property[0]->images))
                                <figure><img src="{{ url('/images/thumb/') }}/{{$property[0]->images[0]->path}}" /></figure>
                                @else
                                     <figure><img src="" alt="Image not found" /></figure>
                                @endif

                            </div>
                                           <div class="col-md-9">
                                {{-- <h2><strong>Booking from: {{ date('d.m.Y',strtotime($booking->booking->check_in))}} {{$property[0]->title}} ,</strong> {{$property[0]->street }}, {{ $property[0]->plz_place }}  --}}
                                <h2><strong>Booking from: {{ date('d.m.Y',strtotime($booking->booking->created_at))}} {{$property[0]->title}} ,</strong> {{$property[0]->street }}, {{ $property[0]->plz_place }}
                                <?php 
                                $count_read = App\Message::where('owner_id', $booking->user_id)->where('is_read', 0)->where('booking_id', $booking->id)->count();
                                ?>
                                <div class="notify">
                                    <a href="#login_message" class="fancybox messagebefore" data-propertyid="{{$property[0]->id}}" data-bookingid="{{ $booking->id}}" data-ownerid="{{Auth::user()->id}}" ><img src="{{url('/')}}/images/message_new.png"></a>
                                    <div class="circle-red">{{$count_read}}</div>
                                </div>
                                </h2>
                                <div class="row">
                                    <div class="col-md-8">
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
                                                    <td width="33.33%">{{ date('D, d. M. Y',strtotime($booking->booking->check_in))}}</td>
                                                    <td width="33.33%" class="text-center">-</td>
                                                    <td width="33.33%">{{ date('D, d. M. Y',strtotime($booking->booking->check_out))}}</td>
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
                                                    <td>CHF {{ $booking->amount }}</td>
                                                    <td class="paid-color">CHF {{ $booking->initial }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    </div>
                                    @if($property[0]->property_booking_status == 0)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a href="{{ url('/') }}/accept/{{$property[0]->id}}" class="accept">Not Confirmed</a>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="{{ url('/')}}/cancel/{{$property[0]->id}}" class="reject">Cancel Booking</a>
                                            </div>
                                            
                                        </div>
                                        @elseif($property[0]->property_booking_status == 1)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a href="javascript:void(0)" class="confirm">Adopted</a>
                                            </div>
                                            <!--div class="col-md-4">
                                                <a href="{{ url('/')}}/cancel/{{$property[0]->id}}" class="reject">Cancel Booking</a>
                                            </div-->
                                            <div class="col-md-3">
                                            <div class="pdf"><a href="{{ url('/bookings/') }}/{{$booking->booking_pdf}}"  target="_blank"><img src="images/Booking-PDF.png" /></a></div>
                                            </div>
                                            @if ($booking->service_fee_pdf != NULL)
                                            <div class="col-md-3">
                                            <div class="pdf"><a href="{{ url('/service-fee/') }}/{{$booking->service_fee_pdf}}"  target="_blank"><img src="images/service-PDF.png" /></a></div>
                                            </div>
                                            @endif
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-md-5">
                                                <a href="" class="reject">Rejected</a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
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
                                                    <td>
                                                        @if ($booked_user[0]->zipcode)
                                                            <td>{{ $booked_user[0]->zipcode }} {{ $booked_user[0]->city }}</td>
                                                        @else
                                                            <td>{{ $booked_user[0]->place }}</td>
                                                        @endif
                                                    </td>
                                                    
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



                            @endif
                           
                        
                    @endif
                    @if($booking->refund_status == 2)
                        <?php 
                        $booked_user = App\User::where('id', $booking->user_id)->get();
                        $property = App\Property::where('id', $booking->billing_id)->get();
                       
                        ?>
                        @if(count($property))
                        <li>
                            <div class="row">
                            <div class="col-md-3">
                                <figure><img src="{{ url('/images/thumb/') }}/{{$property[0]->images[0]->path}}" /></figure>
                            </div>
                                           <div class="col-md-9">
                                <h2><strong>Booking from: {{ date('d.m.Y',strtotime($booking->booking->check_in))}} {{$property[0]->title}} ,</strong> {{$property[0]->street }}, {{ $property[0]->plz_place }} 
                                <?php 
                                $count_read = App\Message::where('owner_id', $booking->user_id)->where('is_read', 0)->where('booking_id', $booking->id)->count();
                                ?>
                                <div class="notify">
                                    <a href="#login_message" class="fancybox messagebefore" data-propertyid="{{$property[0]->id}}" data-bookingid="{{ $booking->id}}" data-ownerid="{{Auth::user()->id}}" ><img src="{{url('/')}}/images/message_new.png"></a>
                                    <div class="circle-red">{{$count_read}}</div>
                                </div>
                                </h2>
                                <div class="row">
                                    <div class="col-md-8">
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
                                                    <td width="33.33%">{{ date('D, d. M. Y',strtotime($booking->booking->check_in))}}</td>
                                                    <td width="33.33%" class="text-center">-</td>
                                                    <td width="33.33%">{{ date('D, d. M. Y',strtotime($booking->booking->check_out))}}</td>
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
                                                    <td>${{ $booking->amount }}</td>
                                                    <td class="paid-color">${{ $booking->initial }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    </div>
                                    
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a href="javascript:void(0)" class="confirm">Adopted</a>
                                            </div>
                                            <!--div class="col-md-4">
                                                <a href="{{ url('/')}}/cancel/{{$property[0]->id}}" class="reject">Cancel Booking</a>
                                            </div-->
                                            <div class="col-md-4">
                                            <div class="pdf"><a href="{{ url('/bookings/') }}/{{$booking->booking_pdf}}"  target="_blank"><img src="images/Booking-PDF.png" /></a></div>
                                            </div>
                                        </div>
                                       
                                    </div>

                                    <div class="col-md-4">
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
                            @endif
                            @endif
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







