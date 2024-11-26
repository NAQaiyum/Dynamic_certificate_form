@extends('layouts.frontend')
@section('contents') 
@php
use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp
<style>
    @page {
        size: legal; /* Set the page size to Legal */
        /* margin: 20mm; Adjust the margins as needed */
        padding:  10px 10px 10px 10px;
		background-color : #FAEBF0 !important;
    }
	.table {
		background-color : #FAEBF0 !important;
	}
	tr{
		background-color : #FAEBF0 !important;
		td{
			padding : 10px;
		}
	}
	body {
	  -webkit-print-color-adjust: exact !important;
	}
    .table-size {
        width: 100%; /* Adjust the width as needed for Legal size */
        /* Other CSS styles for your table and content */
    }
	.qr svg{
		width: 100%;
		aspect-ratio: 1;
		height: auto;
	}
</style>
<form method="POST" action="{{route('frontend::invoice.save')}}"  enctype="multipart/form-data" style="background-color :#FAEBF0 !important ">
    @csrf
    <table class=" table-bordered table-size" style="background-color: #FAEBF0 !important;">
        <tbody style="background-color : #FAEBF0 !important">
            <tr style="background-color : #FAEBF0 !important">
                <td style="width: 50% ; height:15px">
                <b> 1. Exporter (Name & Address)</b><br>
                    <div class="form-group">
                    {{ $getData->ex_name }}
                    </div>
                    <div class="form-group">
                    <!-- {{ $getData->ex_address }} -->
                    {!! nl2br($getData->ex_address) !!}
                    <!-- <textarea> {{ $getData->ex_address }}</textarea> -->
                    </div>
                    
                    <!-- <input type="text" placeholder="" style="width: 70%;" /><br>
                    <input type="text" placeholder="" style="width: 70%;" /> -->
                </td>
                <td rowspan="2" style="width: 50%; text-align : center; padding: 20px 40px">
                    <h6 class="pb-3">REPUBLIC OF SINGAPORE</h6>
                    <img class="pb-3" src="{{ URL('storage/logo.png') }}" alt="" style="width : 20%;">
                    <!-- <img src="https://justspas.com.au/wp-content/uploads/2021/01/Signature-logo.png" style="width : 30%;" id="signature_1"/> -->

                    <h4><b>CERTIFICATE OF ORIGIN</b></h4>
                    <div class="form-group pt-5 pb-5">
                        <label style="text-align : center"><b>NO </b>{{ $getData->certificate_origin_no }}</label>
                        <!-- <center><input type="text" class="form-control" name="certificate_origin_no" placeholder="" required style="width : 80%"></center> -->
                    </div>
                    <p><b>NO UNAUTHORISED ADDITION/ALTERATION MAY BE MADE TO THIS CERTIFICATE ONCE IT IS ISSUED</b></p>
                </td>
            </tr>
            <tr style="background-color : #FAEBF0 !important">
                <td style="height:15px">
                <b> 2. Consignee (Name, Full Address & Country)</b>
                    <div class="form-group">
                    {{ $getData->con_name }}
                    </div>
                    <div class="form-group">
                    <!-- {{ $getData->con_full_address }} -->
                    {!! nl2br($getData->con_full_address) !!}
                    </div>
                    <div class="form-group">
                    {{ $getData->con_country }}
                    </div>
                </td>
            </tr>
            <tr>
                <td style="height:15px">
                    <div class="">
                        <label><b>3. Departure Date </b></label>
                        {{ $getData->dep_date }}
                    </div>
                </td>
                <td rowspan="5">
                    <div style="width : 80%">
                        <p style="text-aligh : justify">
                        <b> 8. DECLARATION BY THE EXPORTER</b><br>
                            We hereby declare that the details and statements provided in
                            this Certificate are true and correct.
                        </p>
                    </div>
                    
                    <div class="">
                        <lable><b>Signature:</b></lable><br><br><br>
                    </div>
                    <div class="">
                        <lable><b>Name:</b></lable>
                        {{ $getData->name }}
                    </div>
                    <div class="">
                        <lable><b>Designation:</b></lable>
                        {{ $getData->designation }}
                    </div>
                    <div class="">
                        <lable><b>Date:</b></lable>
                        {{ $getData->date_1 }}
                    </div>
                </td>
            </tr>
            <tr>
                <td style="height:15px">
                <b>4. Vessel&rsquo;s Name/Flight No. </b>
                    {{ $getData->vessels_name }}
                </td>
            </tr>
            <tr>
                <td style="height:15px">
                <b> 5. Port of Discharge </b> {{ $getData->port_of_discharge }}
                </td>
            </tr>
            <tr>
                <td style="height:15px"><b>6. Country of Final Destination </b>{{ $getData->country_destination }}</td>
            </tr>
            <tr>
                <td style="height:15px"><b>7. Country of Origin of Goods</b> {{ $getData->country_origin }}</td>
            </tr>
            <tr>
                <td colspan="2" style= "padding: 0px 0px 170px 0px">
                    <div class="flex-container">
                        <div class="column left" style ="flex:2">
                            <p><b>9. Marks & Numbers</b></p>
                            {{!! nl2br($getData->marksno) !!}}
                            <!-- {{ $getData->marksno }} -->
                        </div>
            
                        <div class="column center" >
                            <p><b>10. No. & Kind of Package<br>Description of Goods</b><br>(include brand names if necessary)<br><br></p>
                            <p>
                            {!! nl2br($getData->package) !!}
                            </p>
                        </div>
            
                        <div class="column right">
                            <p><b>11. H.S. Code</b></p>
                            {{ $getData->h_s_code }}
                        </div>
            
                        <div class="column new">
                            <p><b>12. Quantity & Unit</b></p>
                            {{ $getData->quantity_unit }}
                        </div>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td colspan="2" class="text-justify" >
                    <p><b>13. CERTIFICATION BY THE COMPETENT AUTHORITY</b><br>
                    We hereby certify that evidence has been produced to satisfy us that the goods specified 
                    above originate in/were processed in the country shown in box 7. This Certificate is 
                    therefore issued and certified to the best of our knowledge and belief to be correct and without any
                    liability on our part.</p>

                    <div class="row" >
                        <div class="col-md-6" style="width: 30%">
                            <!-- Content on the left side (if any) -->
                            <div class="qr">
                            	{!! QrCode::size(200)->backgroundColor(250,235,240)->generate(url()->full()) !!} 
                            <!-- url()->full() -->
                            </div>    
                        </div>

                        <div class="col-md-6" style="width: 70%">
                            <!-- Nested box on the right side -->
                            <div class="nested-div" style="border: 2px solid black; padding: 10px 10px 0px 10px; margin-bottom: 0;" >
                                <div style="display: flex; flex-direction: column">
                                    <div style="display flex-grow: 1;">
                                        <img src="{{ URL('storage/logo.png') }}" alt="Company Logo" style="width: 10%;">
                                        
                                            <!-- <b>SINGAPORE INTERNATIONAL CHAMBER OF COMMERCE.</b><br>
                                            6 Raffles Quay 10-01. Singapore 048580  Tel: +65 65000988<br> -->
                                            <span>
                                                <b style="font-size: 16px;">SINGAPORE INTERNATIONAL CHAMBER OF COMMERCE. </b>
                                               <p> 6 Raffles Quay 10-01. Singapore 048580  Tel: +65 65000988</p>
                                            </span>
                                            
                                        
                                        <div class="form-group">
                                                <label><b>SICC Serial No:</b></label>
                                                {{ $getData->serialno }}
                                        </div><br><br><br><br><br>
  
                                    </div>
                                    <p style="margin-bottom: -2px" >
                                        <span style="font-weight : bold">Senior Certification Officer</span> 
                                        <span style="float : right">for SECRETARY - GENERAL</span>
                                    </p>
                                </div>
                            </div>
                        </div>      
                    </div>   
                    <div class="form-group">
                        <center>
                            <label><b>Date:</b></label>
                            {{ $getData->date_2 }}
                        </center>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</form>
@stop