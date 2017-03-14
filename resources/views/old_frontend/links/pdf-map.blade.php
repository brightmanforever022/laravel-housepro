
    <?php 
         $booked_user = App\User::where('id', $properties[0]->booking->user_id)->get(); 
         $host_user = App\User::where('id', $properties[0]->booking->host_id)->get()
    ?>
    <body>
    <div class="container">

        <div class="logo"><img src="images/logo-black.png"></div>

        <div class="customer-info">
            <h1>{{ $booked_user[0]->saluation }}<br>{{ $booked_user[0]->name }} {{ $booked_user[0]->surname }}<br>{{ $booked_user[0]->address }}<br>{{ $booked_user[0]->place }}</h1>
        </div>

    </div>

    <div class="customer-info-table">
        
        <div class="container">
             <h1>Booking confirmation</h1>
             <h2>{{ $properties[0]->title }} ,  <span>{{ $properties[0]->street }}, {{ $properties[0]->plz_place }}</span> </h2>
             <div class="left">
                <table>
                    <tr>
                        <td width="80%">
                            <table>
                                 <tr>
                                     <th width="25%">Check In</th>
                                     <th width="10%">&nbsp;</th>
                                     <th width="25%">Check Out</th>
                                     <th width="20%">Total Amount</th>
                                     <th width="20%">Paid Deposit</th>

                                 </tr>
                                 <tr>
                                     <td width="25%">{{  date('D, d, F Y', strtotime($properties[0]->booking->booking->check_in)) }}</td>
                                     <td width="10%">-</td>
                                     <td width="25%">{{  date('D, d, F Y', strtotime($properties[0]->booking->booking->check_out)) }}</td>
                                     <td width="20%">{{$properties[0]->booking->amount}} CHF<br>({{ $properties[0]->booking->booking->nights }} Nights)</td>
                                     <td width="20%">{{$properties[0]->booking->initial}} CHF</td>
                                     
                                 </tr>
                             </table>
                        </td>
                        <td width="20%">
                        
                           <img src="images/thumb/{{ $properties[0]->images[0]->path }}" style="width:130px !important; height: 100px !important; object-fit: cover">
                        
                        </td>
                    </tr>
                 
                 </table> 
             </div>

             


        </div>

    </div>
    <div class="container">

        <p>You will be contacted by the provider for the key handover.</p>

        <div class="invoice">
            <h1>INVOICE</h1>
            <table>
                <tr>
                    <td>Date:</td>
                    <td>{{ date('d.m.Y') }}</td>
                    <td>Your Contact:</td>
                    <td>{{ $properties[0]->user->company }}</td>
                </tr>
                <tr>
                    <td>Invoice - Nr.:</td>
                    <td>0001521</td>
                    <td>Booking - Nr.:</td>
                    <td>45600045</td>
                </tr>
            </table>
        </div>

        <p>Dear {{ $booked_user[0]->saluation }}. {{ $booked_user[0]->surname }}</p>
        <p>You will find below the invoice about your booking.</p>

        <div class="invoice-detail">
            <table>
                <tr>
                    <th width="5%">Pos.</th>
                    <th width="35%">Description</th>
                    <th width="20%">Nights</th>
                    <th width="20%">Price / Night</th>
                    <th width="20%">Amount</th>
                </tr>
                
                <tr>
                    <td>1</td>
                    <td>{{ $properties[0]->title }} <br>{{ $properties[0]->street }}, {{ $properties[0]->plz_place }}</td>
                    <td>{{ $properties[0]->booking->booking->nights }}</td>
                    <td>{{ $properties[0]->price_per_night }} CHF</td>
                    <td>{{ sprintf('%0.2f', $properties[0]->booking->amount) }} CHF</td>
                </tr>
                
                <tr>
                    <td>&nbsp;</td>
                    <td>Type of Accomodation:Apartment</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                
                <tr>
                    <td>2</td>
                    <td>Deposite (paid by Paypal)</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>-{{ $properties[0]->booking->initial }} CHF</td>
                </tr>
                
            </table>
        </div>
        <div class="invoice-detail-bottom">
            <table>
                <tr>
                    <td width="5%">&nbsp;</td>
                    <td width="35%"><strong>Final amount</strong></td>
                    <td width="20%">&nbsp;</td>
                    <td width="20%">&nbsp;</td>
                    <td width="20%"><strong>{{$properties[0]->booking->amount -  $properties[0]->booking->initial}} CHF</strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>VAT included 3.8%</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>{{ \ApartHelper::apartolino_round(round(3.8 * $properties[0]->booking->amount/ 100, 2)*10) }}  CHF</td>
                </tr>
            </table>
        </div>
        <p><strong>Terms of payment</strong></p>
        <p class="mar-t10">The invoice must be paid after the key handover, please take care of the bank connection of provider below.<br> For more information, please contact the provider.</p>
        <p class="mar-t10">Thank you</p>

    </div>

    <div class="table-grey">
        <div class="container">
            <table>
                <tr>
                    <th>provider information</th>
                    <th>bank information</th>
                    <th>vat-nr.</th>
                </tr>
                
                <tr>
                    <td>{{ $host_user[0]->company }}</td>
                    <td>IBAN CH {{ $host_user[0]->account->iban }}</td>
                    <td>{{ $host_user[0]->account->vat_nr }}</td>
                </tr>
                <tr>
                    <td>{{ $host_user[0]->address }}</td>
                    <td>BIC {{ $host_user[0]->account->bic }}</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>{{ $host_user[0]->place }}</td>
                    <td>BLZ {{ $host_user[0]->account->blz }}</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>T +41 {{ $host_user[0]->phone }}</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
    </div>
 </body>
<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Roboto:400,300,700,500);
.container{
    margin: 0 auto;
    font-family: 'Roboto', sans-serif;

}
.mar-t10{
    margin-top: 10px;
}

.logo{
    text-align: center;
    margin: 0px 0 30px;
}
.logo img{
    width:160px;
}
.customer-info{
    margin: 80px 0 30px;
}
.customer-info h1{
    line-height: 18px;
    font-size: 12px;
    color: #000;
    letter-spacing: 1px;
    font-weight: 300;
    padding-left: 10px;
}
.customer-info-table{
    background: #233336;
    padding: 10px 10px;
}

.customer-info-table h1{
        line-height: 12px;
    font-size: 12px;
    color: #fff;
    letter-spacing: 1px;
    font-weight: 700;
    text-transform: uppercase;
    margin: 0px;
}

.customer-info-table figure img{
    width: 260px;
    height: 150px;
    object-fit: cover;
}
.customer-info-table table{
    width: 100%;
}
.customer-info-table table tr th{
    color: #fff;
    line-height: 20px;
    font-size: 11px;
    letter-spacing: 1px;
    text-align: left;
    padding: 0px 0;
}
.customer-info-table table tr td{
    color: #fff;
    line-height: 20px;
    font-size: 11px;
    letter-spacing: 1px;
    text-align: left;
    font-weight: 300;
    vertical-align: top;
}
.customer-info-table table tr td img{
    width: 100%;
}
.clear{
    clear: both;
    display: block;
}
.customer-info-table h2{
    line-height: 20px;
    font-size: 11px;
    color: #fff;
    letter-spacing: 1px;
    font-weight: 300;
    margin-bottom: 10px;
    margin: 0;
}
.customer-info-table h2 span{
    font-style: italic;
}
p{
    line-height: 20px;
    font-size: 11px;
    color: #000;
    font-weight: 300;
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding-left: 10px;
}
p strong{
    font-weight: 400;
}
.invoice{
    margin: 10px 0;
}
.invoice h1{
    line-height: 20px;
    font-size: 14px;
    color: #000;
    font-weight: 600;
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding-left: 10px;
}
.invoice table{
    width: 100%;
    border-top: 1px solid #999;
    border-bottom: 1px solid #999;
    margin-top: 5px;
    padding: 2px 0;
    margin-bottom: 15px;
}
.invoice table tr td{
    line-height: 13px;
    font-size: 11px;
    color: #000;
    font-weight: 400;
    font-family: 'Roboto', sans-serif;
    padding-left: 10px;
}
.invoice-detail{
    margin:10px 0 0;
}
.invoice-detail table{
    width: 100%;
}                                                                       
.invoice-detail-bottom table{
    border-top: 1px solid #666;
    border-bottom: 1px solid #666;
    width: 100%;
    padding: 1px;
    margin-bottom: 20px; 
}
.invoice-detail table tr th, .invoice-detail-bottom table tr th{
    line-height: 18px;
    font-size: 11px;
    color: #000;
    font-weight: 500;
    font-family: 'Roboto', sans-serif;
    text-align: left;
    padding-left: 10px;
}
.invoice-detail table tr td, .invoice-detail-bottom table tr td{
    line-height: 18px;
    font-size: 11px;
    color: #000;
    font-weight: 300;
    font-family: 'Roboto', sans-serif;
    vertical-align: top;
    padding-left: 10px;                                                                                     
}
.table-grey{
    background: #f2f2f2;
    padding: 10px;
    margin-top: 40px;
    margin-bottom: 20px;
}
.table-grey table{
    width: 100%;
}
.table-grey table tr th{
    line-height: 20px;
    font-size: 11px;
    color: #000;
    font-weight: 400;
    font-family: 'Roboto', sans-serif;
    text-align: left;
    text-transform: uppercase;
}
.table-grey table tr td{
    line-height: 13px;
    font-size: 11px;
    color: #000;
    font-weight: 300;
    font-family: 'Roboto', sans-serif;
    vertical-align: top;
}
</style>

