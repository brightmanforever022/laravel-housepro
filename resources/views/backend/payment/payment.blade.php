
@extends('backend.layout.master')

@section('content')
        <!-- Page-Level Scripts -->
        <script>
            $(document).ready(function(){
                console.log("Come");
                $('.dataTables-example').DataTable({
                    pageLength: 25,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'ExampleFile'},
                        {extend: 'pdf', title: 'ExampleFile'},

                        {extend: 'print',
                         customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                        }
                        }
                    ]

                });

                $('.dataTables-example-pending').DataTable({
                    pageLength: 5,
                    responsive: true,
                    order: [[ 5, "desc" ]],
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'ExampleFile'},
                        {extend: 'pdf', title: 'ExampleFile'},

                        {extend: 'print',
                         customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                        }
                        }
                    ]

                });


            });

        </script>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        @include('backend.includes.nav-each')
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Data Tables</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="javascript:void(0);">Home</a>
                        </li>
                        <li>
                            <a>Tables</a>
                        </li>
                        <li class="active">
                            <strong>Payments</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Payments</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example-pending" >
                    <thead>
                    <tr>
                          <th>Property Title</th>
                          <th>Provider</th>
                          <th>Tenant</th>
                          <th>Check In</th>
                          <th>Check Out</th>
                          <th>Booking Date</th>
                          <th>Deposit Paid</th>
                          <th>Fee Paid</th>
                          <th>Total Amount</th>
                          <th>Tenant Booking Status</th>
                          <th>Host Booking Status</th>
                          <th>Action</th>
                    </tr>
                    </thead>
                    @if(count($properties)) 
                        @foreach($properties as $property) 
                        <?php 
                           $properties = \App\Property::where('user_id', $property->user_id)->where('booking_id','!=',0)->get();

                           $payments_yearly = \App\Payment::where('host_id', $property->user_id)->where('created_at', 'like', "%{date('Y')}%")->get();
                            
                            if(count($payments_yearly) < 50)
                            {
                              $deduct = 3.5;
                            }else if(count($payments_yearly) > 50 && count($payments_yearly) < 100)
                            {
                              $deduct = 3.0;
                            }else if(count($payments_yearly) > 100 && count($payments_yearly) < 200)
                            {
                              $deduct = 2.5;
                            }else if( count($payments_yearly) >= 200)
                            {
                              $deduct = 2.0;
                            }

                            $fee_paid = $property->booking->amount * $deduct / 100;

                            //$amount = $property->booking->initial - ($property->booking->amount * $deduct / 100);
                            $amount = $property->booking->initial - $fee_paid;
                           
                        ?> 
                        @if($property->booking->refund_status == 0) 
                        <tr class="gradeX">
                            <td>{{ $property->title }}</td>
                          <td>@if ($property->user){{ $property->user->name }} {{ $property->user->surname }} @endif</td>
                          <td>{{ $property->booking->booking->name }} {{ $property->booking->booking->surname }}</td>
                          <td data-order="{{ strtotime(date('d-m-Y', strtotime( $property->booking->check_in))) }}">{{ date('d-m-Y', strtotime($property->booking->booking->check_in)) }}</td>
                          <td data-order="{{ strtotime(date('d-m-Y', strtotime( $property->booking->check_out))) }}">{{ date('d-m-Y', strtotime($property->booking->booking->check_out)) }}</td>
                          <td data-order="{{ strtotime(date('d-m-Y', strtotime( $property->booking->created_at))) }}">{{ date('d-m-Y h:i:s', strtotime($property->booking->created_at)) }} </td>
                          <td>{{ $property->booking->initial }}</td>
                          <td>
                            @if (strstr($fee_paid, '.')) 
                              {{ round($fee_paid, 2) }}
                            @else
                              {{ round($fee_paid, 2) . '.00' }}
                            @endif
                          </td>
                          <td>
                            @if (strstr($amount, '.')) 
                              {{ round($amount, 2) }}
                            @else
                              {{ round($amount, 2) . '.00' }}
                            @endif
                          </td>
                          <td>
                          @if($property->booking->booking->booking_status_tenant == 1)
                          Confirmed<br/>({{ date('d-m-Y h:i:s', strtotime($property->booking->created_at)) }})
                          @elseif($property->booking->booking->booking_status_tenant == 2)
                          Cancelled<br/>({{ date('d-m-Y h:i:s', strtotime($property->booking->booking->updated_at)) }}) 
                          @else
                          Unknown
                          @endif
                          </td>
                          <td>
                          @if($property->property_booking_status == 0)
                          Accept/Reject<br/>
                          @elseif($property->property_booking_status == 1)
                          Adopted<br/>({{ date('d-m-Y h:i:s', strtotime($property->updated_at)) }})
                          @else
                          Rejected<br/>({{ date('d-m-Y h:i:s', strtotime($property->updated_at)) }})
                          @endif

                          </td>
                          <td> 
                           @if($property->booking->booking->booking_status_tenant == 1 && $property->property_booking_status == 1 && $property->booking->refund_status == 0 && $property->booking->booking->check_in <= date('Y-m-d'))
                            <a href="@if ($property->user){{  url('/payToHost/'.$property->user->paypal_email.'/'.$amount.'/'.$property->booking_id.'/'.$property->user_id) }} @endif" class="btn btn-primary btn-xs">Transfer To Host</a></td>
                           @elseif($property->booking->booking->booking_status_tenant == 1 && $property->property_booking_status == 1 && $property->booking->refund_status == 2 && $property->booking->booking->check_in <= date('Y-m-d'))
                            <a href="javascript:void(0)" class="btn btn-primary btn-xs">Transferred</a></td>
                           @elseif($property->booking->booking->booking_status_tenant == 1 && $property->property_booking_status == 1 && $property->booking->refund_status == 0 && $property->booking->booking->check_in > date('Y-m-d'))
                            <a href="javascript:void(0)" class="btn btn-primary btn-xs">Booking Date Not Arrived</a></td>
                           @elseif($property->booking->booking->booking_status_tenant == 1 && $property->property_booking_status == 0 && $property->booking->refund_status == 0)
                            <a href="javascript:void(0)" class="btn btn-primary btn-xs">Host needs to updated status</a> </td>
                           @elseif($property->booking->booking->booking_status_tenant == 2 && $property->booking->refund_status == 0)
                             <a href="{{  url('/refundSale/'.$property->booking->token) }}" class="btn btn-primary btn-xs">Refund To User</a></td>
                           @elseif($property->property_booking_status == 2 && $property->booking->refund_status == 0)
                             <a href="{{  url('/refundSale/'.$property->booking->token) }}" class="btn btn-primary btn-xs">Refund To User</a></td> 
                           @elseif($property->property_booking_status == 2 && $property->booking->refund_status == 1)
                             <a href="javascript:void(0)" class="btn btn-primary btn-xs">Refunded</a></td>
                           @elseif($property->booking->booking->booking_status_tenant == 2 && $property->booking->refund_status == 1)
                             <a href="javascript:void(0)" class="btn btn-primary btn-xs">Refunded</a></td>                        
                           @endif
                         </td>
                        </tr>
                        @endif
                        @endforeach
                        @else
                           No Booking Found.
                        @endif
                        </tbody>
                    <!--tfoot>
                    <tr>
                          <th>Property Title</th>
                          <th>Posted By</th>
                          <th>Tenant</th>
                          <th>Check In</th>
                          <th>Check Out</th>
                          <th>Booking Date</th>
                          <th>Amount Paid</th>
                          <th>Total Amount</th>
                          <th>Tenant Booking Satatus</th>
                          <th>Host Booking Satatus</th>
                          <th>Action</th>
                    </tr>
                    </tfoot-->
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div>

        </div>
   
@endsection



