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

    <!--<h3 class="text-center" style="color:#000; font-family: Silka-Black;"><b>SKU Registration</b></h3>-->
    <a href="{{ url('user-dashboard') }}" class="btn-submit ml-3" style="text-decoration: none; padding:4px 14px;"><i
            class="fa-solid fa-left-long"></i></a>

    <div class="container block mt-4 mb-4">
        <form id="skuForm" action="{{ url('sku-registration') }}" method="POST">
            @csrf
            <input type="hidden" name="vendor_name" value="{{ $vendor->vendor_name }}">

            <div id="skuRows">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="" class="mt-3"><b>Brand</b></label>
                            <input type="text" class="form-control" id="entityName" name="brand"
                                placeholder="Enter Brand information" value="{{ old('brand') }}" maxlength="60">
                            @error('brand')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="" class="mt-3"><b>Product Name</b></label>
                            <input type="text" class="form-control" id="entityName" placeholder="Enter product name"
                                name="product_name" maxlength="60" value="{{ old('product_name') }}">
                            @error('product_name')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="category"><b>Category</b></label>
                            <input type="text" class="form-control" id="category" placeholder="Enter Category Name"
                                name="category" maxlength="40" value="{{ old('category') }}">

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
                                <option value="Yes" {{ old('rtv') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ old('rtv') == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('rtv')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>Unit</b></label>
                            <select class="form-control" id="exampleFormControlSelect1" name="unit">
                                <option selected disabled>Choose Unit</option>
                                <option value="Unit" {{ old('unit') == 'Unit' ? 'selected' : '' }}>Unit</option>
                                <option value="Kgs" {{ old('unit') == 'Kgs' ? 'selected' : '' }}>Kgs</option>
                                <option value="Gms" {{ old('unit') == 'Gms' ? 'selected' : '' }}>Gms</option>
                            </select>
                            @error('unit')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>Case QTY</b></label>
                            <input type="number" class="form-control" id="entityName" placeholder="Enter Case QTY"
                                name="case_qty" value="{{ old('case_qty') }}">
                            @error('case_qty')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>EAN Code</b></label>
                            <input type="text" class="form-control" id="eanCode" placeholder="Enter EAN Code"
                                name="EAN_Code" maxlength="13" value="{{ old('EAN_Code') }}">
                            @error('EAN_Code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>Shelf Life (in days)</b></label>
                            <input type="number" class="form-control" id="entityName" placeholder="Enter Shelf Life"
                                name="shelf_life" value="{{ old('shelf_life') }}">
                            @error('shelf_life')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>HSN Code</b></label>
                            <input type="text" class="form-control" id="hsnCode" placeholder="Enter HSN Code"
                                name="HSN_Code" maxlength="8" value="{{ old('HSN_Code') }}">
                            @error('HSN_Code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
{{-- 
                    <div class="col-3">
                        <div class="form-group">
                                <label for=""><b>CGST</b></label>
                            <input type="text" class="form-control" placeholder="Enter CGST Code"
                                name="CGST_Code" value="{{ old('CGST_Code') }}">
                            @error('CGST_Code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>SGST</b></label>
                            <input type="text" class="form-control" placeholder="Enter SGST Code"
                                name="SGST_Code" value="{{ old('SGST_Code') }}">
                            @error('SGST_Code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>IGST</b></label>
                            <input type="text" class="form-control" placeholder="Enter IGST Code"
                                name="IGST_Code" value="{{ old('IGST_Code') }}">
                            @error('IGST_Code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}


                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>Cess%</b></label>
                            <input type="text" class="form-control" placeholder="Enter Cess" name="cess_percentage" value="{{ old('cess_percentage') }}" id="cessPercentage" step="0.01" min="0" onblur="formatDecimal(this)">
                            @error('cess_percentage')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="form-group">
                            <label for=""><b>Additional Cess</b></label>
                            <input type="text" class="form-control" placeholder="Enter Additional Cess"
                                name="additional_cess" value="{{ old('additional_cess') }}" id="additionalCess" step="0.01" min="0" onblur="formatDecimal(this)">
                            @error('additional_cess')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="form-group">
                            <label for="gstPercentage"><b>GST%</b></label>
                            <input type="number" class="form-control" id="gstPercentage"
                                placeholder="Enter GST Percentage" name="gst_percentage"
                                value="{{ old('gst_percentage') }}" step="0.01" min="0"
                                onblur="formatDecimal(this)">
                            @error('gst_percentage')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="marginPercentage"><b>Margin%</b></label>
                            <input type="number" class="form-control" id="marginPercentage"
                                placeholder="Enter Margin Percentage" name="margin_percentage"
                                value="{{ old('margin_percentage') }}" step="0.01" min="0"
                                onblur="formatDecimal(this)">
                            @error('margin_percentage')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="mrp"><b>MRP</b></label>
                            <input type="number" class="form-control" id="mrp" placeholder="Enter MRP"
                                name="mrp" value="{{ old('mrp') }}" step="0.01" min="0"
                                onblur="formatDecimal(this)">
                            @error('mrp')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="gstPrice"><b>Cess</b></label>
                            <input type="text" class="form-control" id="cess" name="cess"
                                value="{{ old('cess') }}" readonly>

                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="margin"><b>Margin</b></label>
                            <input type="text" class="form-control" id="margin" name="margin"
                                value="{{ old('margin') }}" readonly>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="landingPrice"><b>Landing Price</b></label>
                            <input type="text" class="form-control" id="landingPrice" name="landing_price"
                                value="{{ old('landing_price') }}" readonly>

                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="gstPrice"><b>GST</b></label>
                            <input type="text" class="form-control" id="gst" name="gst_price"
                                value="{{ old('gst_price') }}" readonly>

                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="basicCost"><b>Basic Cost</b></label>
                            <input type="text" class="form-control" id="basicCost" name="basic_cost" readonly
                                value="{{ old('basic_cost') }}">

                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1"><b>Remark (maximum: 300 words)</b></label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="sku_remark"
                    placeholder="Write your remark">{{ old('sku_remark') }}</textarea>
            </div>

       



            <!--<button type="button" id="addRow" class="btn-submit add-row mt-3"><b>Add More Rows</b></button>-->
            <hr>
            <button type="submit" class="btn-submit mr-3 mb-3">Submit SKU</button>
            <button type="reset" class="btn-submit btn-reset mb-3">Reset</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        setTimeout(function() {
            $('#success-message').fadeOut('fast');
        }, 4000);

        setTimeout(function() {
            $('#error-message').fadeOut('fast');
        }, 4000);


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



        // Function to calculate values
        function calculateValues(row) {
            var gstPercentage = parseFloat(row.find('.gstPercentage').val()) || 0;
            var marginPercentage = parseFloat(row.find('.marginPercentage').val()) || 0;
            var mrp = parseFloat(row.find('.mrp').val()) || 0;

            // Calculate Margin
            var margin = mrp * (marginPercentage / 100);
            $('#margin').val(margin.toFixed(2));

            // Calculate GST
            var gst = mrp * (gstPercentage / 100);
            $('#gst').val(gst.toFixed(2));

            // Calculate Landing Price
            var landingPrice = mrp - margin;
            $('#landingPrice').val(landingPrice.toFixed(2));



            // Calculate Basic Cost
            var basicCost = landingPrice * 100 / (100 + gst);
            $('#basicCost').val(basicCost.toFixed(2));

            // Recalculate GST based on Basic Cost and Landing Price
            gst = basicCost * gst / 100;
            $('#gst').val(gst.toFixed(2));
        }

        // Event delegation for dynamically added rows
        $(document).on('input', '.gstPercentage, .marginPercentage, .mrp', function() {
            var row = $(this).closest('.row');
            calculateValues(row);
        });


        $(document).ready(function() {
            $('#eanCode').on('input', function() {
                var maxLength = 13;
                var value = $(this).val();

                // Remove any non-alphanumeric characters
                value = value.replace(/[^a-zA-Z0-9]/g, '');

                // Limit to 13 characters
                if (value.length > maxLength) {
                    value = value.slice(0, maxLength);
                }

                $(this).val(value);
            });
        });



        $(document).ready(function() {
            $('#hsnCode').on('input', function() {
                var maxLength = 8;
                var value = $(this).val();

                // Remove any non-numeric characters
                value = value.replace(/[^0-9]/g, '');

                // Update the input field value
                $(this).val(value);

                // Limit to 6 digits
                if (value.length > maxLength) {
                    $(this).val(value.slice(0, maxLength));
                }
            });
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
