@extends('user.main.main')

@section('user-content')
    <style>
        .block {
            box-shadow: 0px 0px 10px rgb(171, 161, 161);
            padding: 20px;
        }

        .btn-submit {
            letter-spacing: 1px;
            font-weight: 400;
            border: 1px solid #f38f21;
            color: #f38f21;
            margin: 0px;
            padding: 6px 14px;
            border-radius: 9px;
            vertical-align: top;
            display: inline-block;
            background: transparent;
            text-transform: uppercase;
            text-decoration: none;
            font-family: 'Silka-SemiBold';
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #f38f21;
            color: #fff !important;
        }

        .add-row {
            border: 1px solid #4caf50;
            /* Green border */
            color: #4caf50;
            /* Green text */
        }

        .add-row:hover {
            background-color: #4caf50;
            /* Green background on hover */
            color: #fff !important;
            /* White text on hover */
        }

        .btn-reset {
            border: 1px solid #f38f21;
            color: #f38f21;
            /* Orange text */
        }

        .btn-reset:hover {
            background-color: ;
            color: #fff !important;
        }

        .btn-remove {
            border: 1px solid #f44336;
            /* Red border */
            color: #f44336;
            /* Red text */
        }

        .btn-remove:hover {
            background-color: #f44336;
            /* Red background on hover */
            color: #fff !important;
            /* White text on hover */
        }



        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        tr,
        th {
            padding: 8px !important;
            border: 1px solid #96C9F4;
        }

        table,
        td {
            border: 2px solid #505050;
        }

        th,
        td {
            padding: 2px !important;
            text-align: left;
        }

        .th-row {
            background-color: #96C9F4;
        }

        table,
        .change-row-color-blue {
            background-color: #cadef3;
        }

        table,
        .change-row-color-white {
            background-color: #fff;
        }
    </style>

    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert" id="success-message">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (session('fail'))
            <div class="alert alert-danger" id="error-message">
                {{ session('fail') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" id="error-message">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!--<h3 class="text-center" style="color:#000; font-family: Silka-Black;"><b>Edit SKU Registration Detail</b></h3>-->
    <a href="{{ url('vendor-show-sku-registration-detail') }}" class="btn-submit ml-3"
        style="text-decoration: none; padding:4px 14px;"><i class="fa-solid fa-left-long"></i></a>

    @if($skuDetail->approved_by)
    
        <div class="container block mt-4 mb-4">
        <!--<form id="skuForm" action="{{ url('edit-sku-registration-detail') }}" method="POST">-->
        @csrf

            <input type="hidden" name="id" value="{{ $skuDetail->id }}">

            <div id="skuRows">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="" class="mt-3"><b>Brand</b></label>
                            <input type="text" class="form-control" id="entityName" name="subject"
                                placeholder="Enter brand information" value="{{ $skuDetail->subject }}" maxlength="60" readonly>
                            @error('subject')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="col-4">
                        <div class="form-group">
                            <label for="" class="mt-3"><b>Vendor Name</b></label>
                            <input type="text" class="form-control" id="entityName" value="{{ $skuDetail->vendor_name }}"
                                name="vendor_name" readonly>
    
                        </div>
                    </div>
    
                    <div class="col-4">
                        <div class="form-group">
                            <label for="" class="mt-3"><b>Product Name</b></label>
                            <input type="text" class="form-control" id="entityName" value="{{ $skuDetail->product_name }}"
                                name="product_name" maxlength="60" readonly>
                            @error('product_name')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    
                     <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>Unit</b></label>
                            <input type="text" class="form-control" id="entityName" value="{{ $skuDetail->unit }}"
                                name="unit" readonly>
                        </div>
                    </div>
                    
                    
    
                    <div class="col-6">
                        <div class="form-group">
                            <label for="category"><b>Category</b></label>
                            <input type="text" class="form-control" id="category" value="{{ $skuDetail->category }}"
                                name="category" maxlength="40" readonly>
    
                            @error('category')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                            <span style="color: red; display: none;" id="error-message">Maximum 40 characters
                                allowed.</span>
                        </div>
                    </div>
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>RTV</b></label>
                            <select class="form-control" id="exampleFormControlSelect1" name="rtv" readonly>
                                <option selected disabled>Choose RTV</option>
                                <option value="Yes" {{ $skuDetail->rtv == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ $skuDetail->rtv == 'No' ? 'selected' : '' }}>No</option>
                            </select>
    
                        </div>
                    </div>
    
                   
                    
                    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>Case QTY</b></label>
                            <input type="text" class="form-control" id="entityName" value="{{ $skuDetail->case_qty }}"
                                name="case_qty" readonly>
                            @error('case_qty')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>EAN Code</b></label>
                            <input type="number" class="form-control" id="entityName" value="{{ $skuDetail->EAN_Code }}"
                                name="EAN_Code" maxlength="13" readonly>
                            @error('EAN_Code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>Shelf Life (in days)</b></label>
                            <input type="text" class="form-control" id="entityName" value="{{ $skuDetail->shelf_life }}"
                                name="shelf_life" value="{{ old('shelf_life') }}" readonly>
                            @error('shelf_life')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>HSN Code</b></label>
                            <input type="text" class="form-control" id="entityName" value="{{ $skuDetail->HSN_Code }}"
                                name="HSN_Code" minlength="6" readonly>
                            @error('HSN_Code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
    {{-- 
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>CGST</b></label>
                            <input type="text" class="form-control" value="{{ $skuDetail->CGST_Code }}" readonly>
                            @error('CGST_Code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>SGST</b></label>
                            <input type="text" class="form-control" value="{{ $skuDetail->SGST_Code }}" readonly>
                            @error('SGST_Code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>IGST</b></label>
                            <input type="text" class="form-control" name="IGST_Code" value="{{ $skuDetail->IGST_Code }}" readonly>
                            @error('IGST_Code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="mrp"><b>MRP</b></label>
                            <input type="number" class="form-control" id="mrp" value="{{ $skuDetail->mrp }}"
                                name="mrp" readonly>
                            @error('mrp')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="marginPercentage"><b>Margin%</b></label>
                            <input type="number" class="form-control" id="marginPercentage" name="margin_percentage"
                                value="{{ $skuDetail->margin_percentage }}" readonly>
                            @error('margin_percentage')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="margin"><b>Margin</b></label>
                            <input type="text" class="form-control" id="margin" name="margin"
                                value="{{ $skuDetail->margin }}" readonly>
                        </div>
                    </div>
                    
                    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="landingPrice"><b>Landing Price</b></label>
                            <input type="text" class="form-control" id="landingPrice" name="landing_price"
                                value="{{ $skuDetail->landing_price }}" readonly>
    
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="gstPercentage"><b>GST%</b></label>
                            <input type="number" class="form-control" id="gstPercentage"
                                value="{{ $skuDetail->gst_percentage }}" name="gst_percentage" readonly>
                            @error('gst_percentage')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>Cess%</b></label>
                            <input type="text" class="form-control" value="{{ $skuDetail->cess_percentage }}" name="cess_percentage" readonly>
                            @error('cess')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    

                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>Additional Cess</b></label>
                            <input type="text" class="form-control" name="additional_cess" value="{{ $skuDetail->additional_cess }}" readonly>
                            @error('additional_cess')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="basicCost"><b>Basic Cost</b></label>
                            <input type="text" class="form-control" id="basicCost" name="basic_cost" readonly
                                value="{{ $skuDetail->basic_cost }}">
    
                        </div>
                    </div>
                   
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="gstPrice"><b>GST</b></label>
                            <input type="text" class="form-control" id="gstPrice" name="gst_price"
                                value="{{ $skuDetail->gst_price }}" readonly>
    
                        </div>
                    </div>
    
    
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="gstPrice"><b>Cess</b></label>
                            <input type="text" class="form-control" id="gstPrice" name="cess"
                                value="{{ $skuDetail->cess }}" readonly>
    
                        </div>
                    </div>
    
    
    
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="basicCost"><b>ERP Product Code</b></label>
                            <input type="text" class="form-control" id="erpCode" name="erp_code" readonly
                                value="{{ $skuDetail->erp_code }}">
    
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="form-group">
                <label for="exampleFormControlTextarea1"><b>Remark (maximum: 300 words)</b></label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="sku_remark" readonly>{{ $skuDetail->sku_remark }}</textarea>
            </div>



                <!--<button type="button" id="addRow" class="btn-submit add-row mt-3"><b>Add More Rows</b></button>-->
                <hr>
                <!--<button type="submit" class="btn-submit mr-3 mb-3">Submit SKU</button>-->
                <!--<button type="reset" class="btn-submit btn-reset mb-3">Reset</button>-->
                </form>
        </div>
        
    @else
        
        <div class="container block mt-4 mb-4">
        <form id="skuForm" action="{{ url('edit-sku-registration') }}" method="POST">
        @csrf

            <input type="hidden" name="id" value="{{ $skuDetail->id }}">

            <div id="skuRows">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="" class="mt-3"><b>Brand</b></label>
                            <input type="text" class="form-control" id="entityName" name="subject"
                                placeholder="Enter brand information" value="{{ $skuDetail->subject }}" maxlength="60">
                            @error('subject')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="col-4">
                        <div class="form-group">
                            <label for="" class="mt-3"><b>Vendor Name</b></label>
                            <input type="text" class="form-control" id="entityName" value="{{ $skuDetail->vendor_name }}"
                                name="vendor_name" readonly>
    
                        </div>
                    </div>
    
                    <div class="col-4">
                        <div class="form-group">
                            <label for="" class="mt-3"><b>Product Name</b></label>
                            <input type="text" class="form-control" id="entityName" value="{{ $skuDetail->product_name }}"
                                name="product_name" maxlength="60" >
                            @error('product_name')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    
                     <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>Unit</b></label>
                            <input type="text" class="form-control" id="entityName" value="{{ $skuDetail->unit }}"
                                name="unit">
                        </div>
                    </div>
                    
                    
    
                    <div class="col-6">
                        <div class="form-group">
                            <label for="category"><b>Category</b></label>
                            <input type="text" class="form-control" id="category" value="{{ $skuDetail->category }}"
                                name="category" maxlength="40">
    
                            @error('category')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                            <span style="color: red; display: none;" id="error-message">Maximum 40 characters
                                allowed.</span>
                        </div>
                    </div>
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>RTV</b></label>
                            <select class="form-control" id="exampleFormControlSelect1" name="rtv">
                                <option selected disabled>Choose RTV</option>
                                <option value="Yes" {{ $skuDetail->rtv == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ $skuDetail->rtv == 'No' ? 'selected' : '' }}>No</option>
                            </select>
    
                        </div>
                    </div>
    
                   
                    
                    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>Case QTY</b></label>
                            <input type="text" class="form-control" id="entityName" value="{{ $skuDetail->case_qty }}"
                                name="case_qty">
                            @error('case_qty')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>EAN Code</b></label>
                            <input type="number" class="form-control" id="entityName" value="{{ $skuDetail->EAN_Code }}"
                                name="EAN_Code" maxlength="13">
                            @error('EAN_Code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>Shelf Life (in days)</b></label>
                            <input type="text" class="form-control" id="entityName" value="{{ $skuDetail->shelf_life }}"
                                name="shelf_life" value="{{ old('shelf_life') }}">
                            @error('shelf_life')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>HSN Code</b></label>
                            <input type="text" class="form-control" id="entityName" value="{{ $skuDetail->HSN_Code }}"
                                name="HSN_Code" minlength="6">
                            @error('HSN_Code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
    {{-- 
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>CGST</b></label>
                            <input type="text" class="form-control" value="{{ $skuDetail->CGST_Code }}" readonly>
                            @error('CGST_Code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>SGST</b></label>
                            <input type="text" class="form-control" value="{{ $skuDetail->SGST_Code }}" readonly>
                            @error('SGST_Code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>IGST</b></label>
                            <input type="text" class="form-control" name="IGST_Code" value="{{ $skuDetail->IGST_Code }}" readonly>
                            @error('IGST_Code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="mrp"><b>MRP</b></label>
                            <input type="number" class="form-control" id="mrp" value="{{ $skuDetail->mrp }}"
                                name="mrp" step="0.01" min="0" onblur="formatDecimal(this)">
                            @error('mrp')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="marginPercentage"><b>Margin%</b></label>
                            <input type="number" class="form-control" id="marginPercentage" name="margin_percentage"
                                value="{{ $skuDetail->margin_percentage }}" step="0.01" min="0" onblur="formatDecimal(this)">
                            @error('margin_percentage')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="margin"><b>Margin</b></label>
                            <input type="text" class="form-control" id="margin" name="margin"
                                value="{{ $skuDetail->margin }}" readonly>
                        </div>
                    </div>
                    
                    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="landingPrice"><b>Landing Price</b></label>
                            <input type="text" class="form-control" id="landingPrice" name="landing_price"
                                value="{{ $skuDetail->landing_price }}" readonly>
    
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="gstPercentage"><b>GST%</b></label>
                            <input type="number" class="form-control" id="gstPercentage"
                                value="{{ $skuDetail->gst_percentage }}" name="gst_percentage" step="0.01" min="0" onblur="formatDecimal(this)">
                            @error('gst_percentage')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>Cess%</b></label>
                            <input type="text" class="form-control" value="{{ $skuDetail->cess_percentage }}" id="cessPercentage" step="0.01" min="0" onblur="formatDecimal(this)" name="cess_percentage"> 
                            @error('cess')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>Additional Cess</b></label>
                            <input type="text" class="form-control" name="additional_cess" id="additionalCess"  value="{{ $skuDetail->additional_cess }}" step="0.01" min="0" onblur="formatDecimal(this)">
                            @error('additional_cess')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="basicCost"><b>Basic Cost</b></label>
                            <input type="text" class="form-control" id="basicCost" name="basic_cost" readonly
                                value="{{ $skuDetail->basic_cost }}">
    
                        </div>
                    </div>
                   
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="gstPrice"><b>GST</b></label>
                            <input type="text" class="form-control" id="gst" name="gst_price"
                                value="{{ $skuDetail->gst_price }}" readonly>
    
                        </div>
                    </div>
    
    
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="gstPrice"><b>Cess</b></label>
                            <input type="text" class="form-control" id="cess" name="cess"
                                value="{{ $skuDetail->cess }}" readonly>
    
                        </div>
                    </div>
    
    
    
    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="basicCost"><b>ERP Product Code</b></label>
                            <input type="text" class="form-control" id="erpCode" name="erp_code" readonly
                                value="{{ $skuDetail->erp_code }}">
    
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="form-group">
                <label for="exampleFormControlTextarea1"><b>Remark (maximum: 300 words)</b></label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="sku_remark" >{{ $skuDetail->sku_remark }}</textarea>
            </div>



                <!--<button type="button" id="addRow" class="btn-submit add-row mt-3"><b>Add More Rows</b></button>-->
                <hr>
                
                @if(!($skuDetail->approved_by))
                    <button type="submit" class="btn-submit mr-3 mb-3">Re-Submit SKU</button>
                    <!--<button type="reset" class="btn-submit btn-reset mb-3">Reset</button>-->
                @endif
               
        </form>
      </div>
    
    @endif


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
          $(document).ready(function() {
            function calculateValues() {
                var gstPercentage = parseFloat($('#gstPercentage').val()) || 0;
                var marginPercentage = parseFloat($('#marginPercentage').val()) || 0;
                var mrp = parseFloat($('#mrp').val()) || 0;
                var cessPercentage = parseFloat($('#cessPercentage').val()) || 0;
                var additionalCess = parseFloat($('#additionalCess').val()) || 0;

                // Calculate Margin
                var margin = mrp * (marginPercentage / 100);
                $('#margin').val(margin.toFixed(2));


                // Calculate GST
                var gst = mrp * (gstPercentage / 100);
                $('#gst').val(gst.toFixed(2));

                // Calculate Landing Price
                // var landingPrice = mrp - margin;
                var landingPrice = mrp - margin;
                $('#landingPrice').val(landingPrice.toFixed(2));



                // Calculate Basic Cost
                var basicCost = (landingPrice - additionalCess) * 100 / (100 + gstPercentage + cessPercentage);
                $('#basicCost').val(basicCost.toFixed(2));

                // Recalculate GST based on Basic Cost and Landing Price
                gst = basicCost * gstPercentage / 100;
                $('#gst').val(gst.toFixed(2));


                var cess = basicCost * cessPercentage / 100;
                $('#cess').val(cess.toFixed(2));
            }

            $('#gstPercentage, #marginPercentage, #mrp,#cessPercentage,#additionalCess').on('input', calculateValues);
        });
        
        function formatDecimal(input) {
            // Convert the value to a float and format to two decimal places
            const value = parseFloat(input.value);
            if (!isNaN(value)) {
                input.value = value.toFixed(2);
            }
        }
    </script>
@endsection
