
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
                            <strong>Transfers</strong>
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
                        <h5>Transfers</h5>
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
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                          <th>Property Title</th>
                          <th>Provider</th>
                          <th>Tenant</th>
                          <th>Check In</th>
                          <th>Check Out</th>
                          <th>Booking Date</th>
                          {{-- <th>Host Paid</th> --}}
                          <th>Deposit Paid</th>
                          {{-- <th>Total Amount</th> --}}
                          <th>Service Fee</th>
                          <th>Transferred to Host</th>
                          <th>Tenant Booking Status</th>
                          {{-- <th>Host Booking Status</th> --}}
                          <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($bookings))
                    @foreach($bookings as $booking)
                    <?php
                       $properties = \App\Property::where('id', $booking->billing_id)->get();

                       $transaction = \App\Transaction::where('booking_id', $booking->id)->first();

                       // $amount = $booking->initial;
                       // 
                       // 
                       
                       $amount = $booking->amount;
                       $amount1 = $booking->initial; //dd($amount1);
                       $deduct = 3.5;
                       if($booking->booking->booking_status_tenant == 1 && $booking->booking->booking_status_host == 1)
                       {
                           if(count($properties) < 50)
                           { 
                              $deduct = 3.5; 
                           }else if(count($properties) > 50 && count($properties) < 100)
                           {
                              $deduct = 3.0;
                           }else if(count($properties) > 100 && count($properties) < 200)
                           {
                              $deduct = 2.5;
                           }else if( count($properties) >= 200)
                           {
                              $deduct = 2.0;
                              
                           }
                       }else
                       {
                           $amount = $booking->initial;
                       }      
                          $fee_paid = $booking->amount * $deduct / 100;
                           $amount = $amount1 - $fee_paid;
                       
                    ?>
                    <tr class="gradeX">
                          <td>@if (count($properties) > 0) {{ $properties[0]->title }} @endif</td>
                          <td>@if (count($properties) > 0){{ $properties[0]->user->name }} {{ $properties[0]->user->surname }} @endif</td>
                          <td>{{ $booking->booking->name }} {{ $booking->booking->surname }}</td>
                          <td data-order="{{ strtotime(date('d-m-Y', strtotime( $booking->booking->check_in))) }}">{{ date('d-m-Y', strtotime($booking->booking->check_in)) }}</td>
                          <td data-order="{{ strtotime(date('d-m-Y', strtotime( $booking->booking->check_out))) }}">{{ date('d-m-Y', strtotime($booking->booking->check_out)) }}</td>
                          <td data-order="{{ strtotime(date('d-m-Y', strtotime( $booking->created_at))) }}">{{ date('d-m-Y h:i:s', strtotime($booking->created_at)) }} </td>
                          <td>{{ $booking->initial }}</td>
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
                          @if($booking->booking->booking_status_tenant == 1)
                          Confirmed<br/>({{ date('d-m-Y h:i:s', strtotime($booking->created_at)) }})
                          @elseif($booking->booking->booking_status_tenant == 2)
                          Cancelled<br/>({{ date('d-m-Y h:i:s', strtotime($booking->updated_at)) }})
                          @else
                          Unknown
                          @endif
                          </td>
                          {{-- <td>
                          @if($booking->booking->booking_status_host == 0)
                          Accept/Reject<br/>({{ date('d-m-Y h:i:s', strtotime($booking->booking->created_at)) }})
                          @elseif($booking->booking->booking_status_host == 1)
                          Adopted<br/>({{ date('d-m-Y h:i:s', strtotime($booking->booking->updated_at)) }})
                          @else
                          Rejected<br/>({{ date('d-m-Y h:i:s', strtotime($booking->booking->updated_at)) }})
                          @endif

                          </td> --}}
                          <td>
                           <a href="javascript:void(0)" class="btn btn-primary btn-xs">Transfered</a></td>
                         </td>
                  
                    </tr>
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
                          <th>Host Paid</th>
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



