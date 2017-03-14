
    <?php  
         $booked_user = App\User::where('id', $properties[0]->booking->user_id)->get(); 
         $host_user = App\User::where('id', $properties[0]->booking->host_id)->get();

         /***************Calculate service fee*************/
         if ($properties_count < 50) {
            $service_fee_percent = 3.5;
         }elseif ($properties_count > 50 && $properties_count <= 100) {
            $service_fee_percent = 3.0;
         }elseif ($properties_count > 100 && $properties_count  <= 200) {
            $service_fee_percent = 2.5;
         }elseif ($properties_count > 200) {
            $service_fee_percent = 2.0;
         }else{
            $service_fee_percent = 1.0;
         }



         $service_amount = $properties[0]->booking->amount * $service_fee_percent / 100 ;
         $total_amount =  $properties[0]->booking->initial - $service_amount;
         

//var_dump($properties[0]->booking->initial);
         //dd($service_amount);
         //$vat_amount = ($host_user[0]->account->vat_nr/100) * ($properties[0]->booking->amount);
        // $vat_amount = ($host_user[0]->account->vat_nr/100) * ($service_amount);

         // $final_amount = $service_amount + $vat_amount;
         // $tax_final_amount = (8/100) * ($final_amount);
    ?>
    <body>
    <div class="container">

        <div class="logo"><img src="images/logo-black.png"></div>

        <div class="customer-info">
            <h1>{{ $host_user[0]->company }}<br>{{ $host_user[0]->name }} {{ $host_user[0]->surname }}<br>{{ $host_user[0]->address }}<br> @if ($host_user[0]->zipcode != NULL){{ $host_user[0]->zipcode }}@endif @if ($host_user[0]->city != NULL){{ $host_user[0]->city }}@endif</h1>
        </div>

    </div>
    <div class="container">      

        <div class="invoice">
            <h1>SERVICE FEE</h1>
            <p>(FOR USING APARTOLINO ONLINE PLATFORM)</p>
            <table>
                <tr>
                    <td>Date:</td>
                    <td>{{ date('d.m.Y') }}</td>
                    <td>Your Contact:</td>
                    <td>{{ $properties[0]->user->company }}</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Invoice - Nr.:</td>
                    <td>{{ $service_invoice_number }}</td>
                    <td>Booking - Nr.:</td>
                    <td>{{ $booking_number }}</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>

        <p>Dear {{ $booked_user[0]->saluation }}. {{ $booked_user[0]->surname }}</p>
        <p>You will find below the invoice about the paid service fee.</p>

        <div class="invoice-detail">
            <table>
                <tr>
                    <th width="5%" align="left">Pos.</th>
                    <th width="35%" align="left">Description</th>
                    <th width="50%" align="right">Amount</th>
                    <th width="10%">&nbsp;</th>
                </tr>
                
                <tr>
                    <td>1</td>
                    <td>{{ $properties[0]->title }} <br>{{ $properties[0]->street }}, {{ $properties[0]->plz_place }}</td>
                   
                    <td align="right">{{ $properties[0]->booking->initial }} CHF</td>
                    <td>&nbsp;</td>
                </tr>
                
                <tr>
                    <td></td>
                    <td>Value-added tax<br>({{ $service_fee_percent }}%)</td>
                    <td align="right">{{ round($service_amount, 2) }} CHF</td>
                    <td>&nbsp;</td>
                </tr>
                
            </table>
        </div>
        <div class="invoice-detail-bottom">
            <table>
                <tr>
                    <td width="40%"><strong>Total Service Fee</strong></td>
                    <td width="50%" align="right"><strong>{{ round($total_amount, 2) }} CHF</strong></td>
                    <td>&nbsp;</td>
                    <td width="10%">&nbsp;</td>
                </tr>
            </table>
        </div>
        {{-- <p><strong>Terms of payment</strong></p> --}}
        <p class="mar-t10">The service fee for using the APARTOLINO platform will be deducted directly from the customer's paid deposit. On the day of the check-in of the guest, the deposit minus service fee is paid to the provider.</p>
        <p class="mar-t10">Thank you</p>
        <div class="service-fees-footer">
            <h1>APPARTOLINO GmbH</h1>
            <p>Zürcherstrasse 137 // CH-8408 Winterthur</p>
            <p>T +41 52 208 10 08 // support@appartolino.ch</p>
            <p>www.apartolino.ch</p>
            <p>CHE-156.15.53</p>
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
.invoice table tr td:nth-child(4){
    text-align: right;
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
/*.invoice-detail table tr th:nth-child(2) , .invoice-detail table tr td:nth-child(2){
    text-align: center;
}*/
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
.service-fees-footer{
    margin-top: 200px;
    text-align: center;
}
.service-fees-footer h1{
    line-height: 17px;
    font-size: 12px;
    color: #000;
    font-weight: 600;
    font-family: 'Roboto', sans-serif;
    display: block;
    text-align: center;
}
.service-fees-footer p{
    line-height: 17px;
    font-size: 11px;
    color: #000;
    font-weight: 300;
    font-family: 'Roboto', sans-serif;
    display: block;
    text-align: center;
    margin-bottom: 5px;
}
</style>
