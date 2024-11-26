@extends('layouts.frontend')
@section('contents')
<form method="POST" action="{{route('frontend::invoice.save')}}"  enctype="multipart/form-data">
    @csrf
    <table class="table table-bordered table-size">
        <tbody>
            <tr>
                <td style="width: 50%">
                    1. Exporter (Name & Address)<br>
                    <div class="form-group">
                        <input type="text" class="form-control" name="ex_name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <textarea name="ex_address" class="form-control" placeholder="address" ></textarea>
                    </div>
                    
                    <!-- <input type="text" placeholder="" style="width: 70%;" /><br>
                    <input type="text" placeholder="" style="width: 70%;" /> -->
                </td>
                <td rowspan="2" style="width: 50%; text-align : center; padding: 20px 40px">
                    <h6 class="pb-5">REPUBLIC OF SINGAPORE</h6>
                    <img src="{{ URL('assets/images/logo/') }}" alt="" style="width : 30%;">
                    <!-- <img src="https://justspas.com.au/wp-content/uploads/2021/01/Signature-logo.png" style="width : 30%;"/> -->

                    <h4>CERTIFICATE OF ORIGIN</h4>
                    <div class="form-group pt-5 pb-5">
                        <label style="text-align : center">NO</label>
                        <center><input type="text" class="form-control" name="certificate_origin_no" placeholder="" required style="width : 80%"></center>
                    </div>
                    <p>NO UNAUTHORISED ADDITION/ALTERATION MAY BE MADE TO THIS CERTIFICATE ONCE IT IS ISSUED</p>
                </td>
            </tr>
            <tr>
                <td>
                    2. Consignee (Name, Full Address & Country)
                    <div class="form-group">
                        <input type="text" class="form-control" name="con_name" placeholder="Name" >
                    </div>
                    <div class="form-group">
                        <textarea name="con_full_address" class="form-control"  placeholder="Address"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="con_country" placeholder="Country" >
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <label>3. Departure Date </label>
                        <input type="date" class="form-control" name="dep_date" placeholder="Departure Date" >
                    </div>
                </td>
                <td rowspan="5">
                    <div style="width : 80%">
                        <p style="text-aligh : justify">
                            8. DECLARATION BY THE Exporter<br>
                            We hereby declare that the details and statements provided in
                            this Certificate are true and correct.
                        </p>
                    </div>
                    <div class="column">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="https://justspas.com.au/wp-content/uploads/2021/01/Signature-logo.png" style="width : 100%;" id="signature_1"/>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <lable>Signature:<lable>
                                    <!-- <input type="file" class="form-control" name="signature_1" onchange="document.getElementById('signature_1').src = window.URL.createObjectURL(this.files[0])"/> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <lable>Name:<lable>
                        <input type="text" class="form-control" name="name"/>
                    </div>
                    <div class="form-group">
                        <lable>Designation:<lable>
                        <input type="text" class="form-control" name="designation"/>
                    </div>
                    <div class="form-group">
                        <lable>Date:<lable>
                        <input type="date" class="form-control" name="date_1" value="{{date('Y-m-d')}}"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    4. Vessel&rsquo;s Name/Flight No. 
                    <input type="text" class="form-control" placeholder="" name="vessels_name">
                </td>
            </tr>
            <tr>
                <td>
                    5. Port of Discharge  <input type="text" class="form-control" placeholder="" name="port_of_discharge">
                </td>
            </tr>
            <tr>
                <td>6. Country of Final Destination <input type="text" class="form-control" placeholder="" name="country_destination"></td>
            </tr>
            <tr>
                <td>7. Country of Origin of Goods <input type="text" class="form-control" placeholder="" name="country_origin"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="flex-container">
                        <div class="column left">
                            <p>9. Marks & Numbers</p>
                            <textarea type="text"  name="marksno" placeholder=""></textarea>
                        </div>
            
                        <div class="column center">
                            <p>10. No. & Kind of Package<br>Description of Goods<br>(include brand names if necessary)<br><br></p>
                            <p>
                            <textarea type="string"  name="package" placeholder=""></textarea>
                            </p>
                        </div>
            
                        <div class="column right">
                            <p>11. H.S. Code</p>
                            <input type="text" style="width: 40%;" name="h_s_code" />
                        </div>
            
                        <div class="column new">
                            <p>12. Quantity & Unit</p>
                            <input type="text" style="width: 40%;"  name="quantity_unit"/>
                        </div>
                    </div>
                </td>
            </tr>
            
            <tr >
                <td colspan="2" class="text-justify">
                    <p>12. CERTIFICATION BY THE COMPLEMENT AUTHORITY<br>
                    We hereby certify that evidance has been produced to satisfy us that the goods specified 
                    above originate in/were processed in the country shown in box 7. This Certificate is 
                    therefore issued and certified to the best of our knowledge and belief to be correct and without any
                    liability on our part.<p>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://justspas.com.au/wp-content/uploads/2021/01/Signature-logo.png" style="width : 100%; padding: 0px 100px;" id="signature_2"/>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <lable>Serial No:<lable>
                                <input type="string" class="form-control" name="serialno" placeholder="" >
                            </div>
                            <!-- <div class="form-group">
                                <lable>Signature:<lable>
                                <input type="file" class="form-control" name="signature_2" onchange="document.getElementById('signature_2').src = window.URL.createObjectURL(this.files[0])"/>
                            </div> -->
                            <div class="form-group">
                                <lable>Date:<lable>
                                <input type="date" class="form-control" name="date_2" value="{{date('Y-m-d')}}"/>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-info btn-block">Save changes</button>
                </td>
            </tr>
        </tbody>
    </table>
</form>
@stop