@extends('user.main.main')


@section('user-content')
    <style>
        .block {
            box-shadow: 0px 0px 10px rgb(171, 161, 161);
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

        .btn-reset {
            border: 1px solid #f44336;
            /* Red border */
            color: #f44336;
            /* Red text */
        }

        .btn-reset:hover {
            background-color: #f44336;
            /* Red background on hover */
            color: #fff !important;
            /* White text on hover */
        }

        .position-relative {
            position: relative;
        }

        .pan-icon {
            position: absolute;
            right: 5px;
            top: 75%;
            transform: translateY(-50%);
            width: 80px;
            height: auto;
            pointer-events: none;
            /* This ensures that the image doesn't interfere with input actions */
        }

        .btn-back {
            border: 1px solid #4caf50;
            /* Green border */
            color: #4caf50;
            /* Green text */
        }

        .btn-back:hover {
            background-color: #4caf50;
            /* Green background on hover */
            color: #fff !important;
            /* White text on hover */
        }
    </style>

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

    <!--<h3 class="text-center" style="color:#000;font-family: Silka-Black;"><b>Vendor Registration</b></h3>-->
    <a href="{{ url('user-dashboard') }}" class="btn-submit ml-3" style="text-decoration: none; padding:4px 14px;"><i
            class="fa-solid fa-left-long"></i></a>

    <div class="container block mt-4 mb-4">
        <form action="{{ url('add-vendor-registration') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label for="" class="mt-3"><b>Subject (upto 60 characters)</b></label>
                        <input type="text" class="form-control" id="entityName" name="subject"
                            placeholder="Enter subject information" value="{{ old('subject', $data->subject ?? '') }}"
                            maxlength="60">
                        @error('subject')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

        


            <div class="col-6">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Vendor Trade Name</b></label>
                    <input type="text" class="form-control" id="entityName" name="vendor_name" readonly value="{{ $vendor->vendor_name }}">
                    @error('vendor_name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Legal Name (As per GST)</b></label>
                    <input type="text" class="form-control" id="entityName" name="legal_name"
                        placeholder="Enter your legal name" value="{{ old('legal_name',$data->legal_name ?? '') }}"
                        >
                    @error('legal_name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <h5 class="text-center mt-2 mb-3"><b>Address</b></h5>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Street/House No :</b></label>
                    <input type="text" class="form-control" id="entityName" name="street_no"
                        placeholder="Enter your street/House number" value="{{ old('street_no' , $data->street_no ?? '') }}">
                    @error('street_no')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>City</b></label>
                    <input type="text" class="form-control" id="entityName" name="city" placeholder="Enter your city"
                        value="{{ old('city' , $data->city ?? '') }}">
                    @error('city')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Postal Code</b></label>
                    <input type="number" class="form-control" id="entityName" name="country_name"
                        placeholder="Enter your Postal Code" value="{{ old('country_name', $data->country_name ??  '') }}">
                    @error('country_name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <h5 class="text-center mt-2 mb-3"><b>Communication</b></h5>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Telephone</b></label>
                    <input type="number" class="form-control" id="entityName" name="telephone_number"
                        placeholder="Enter your telephone number" value="{{ old('telephone_number' , $data->telephone_number ?? '') }}">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Mobile No.1</b></label>
                    <input type="number" class="form-control" id="entityName" name="mobile_number1"
                        placeholder="Enter your mobile number" maxlength="10" value="{{ old('mobile_number1', $data->mobile_number1 ?? '') }}">
                    @error('mobile_number1')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Contact Person</b></label>
                    <input type="text" class="form-control" id="entityName" name="contact_person1"
                        placeholder="Enter your contact person" value="{{ old('contact_person1',$data->contact_person1 ?? '') }}">
                    @error('contact_person1')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Mobile No.2</b></label>
                    <input type="number" class="form-control" id="entityName" name="mobile_number2"
                        placeholder="Enter your alternate mobile number" maxlength="10"
                        value="{{ old('mobile_number2',$data->mobile_number2 ?? '') }}">
                    @error('mobile_number2')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Contact Person</b></label>
                    <input type="text" class="form-control" id="entityName" name="contact_person2"
                        placeholder="Enter your contact person" value="{{ old('contact_person2',$data->contact_person2 ?? '') }}">
                    @error('contact_person2')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>E-Mail</b></label>
                    <input type="email" class="form-control" id="entityName" name="email"
                        placeholder="Enter your Email-Id" value="{{ old('email',$data->email ?? '') }}">
                    @error('email')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <h5 class="text-center mt-2 mb-3"><b>TAX Information</b></h5>

            <div class="col-6">
                <div class="form-group position-relative">
                    <label for="" class="mt-3"><b>GST Number</b></label>
                    <input type="text" class="form-control" id="entityName" name="gst_number" readonly
                        value="{{ $vendor->gstin }}">
                    <img src="{{ asset('public/assets/upload/gst.png') }}" alt="GST Photo" class="pan-icon"
                        style="width: 40px">
                    @error('gst_number')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="form-group position-relative">
                    <label for="" class="mt-3"><b>PAN Number</b></label>
                    <input type="text" class="form-control" maxlength="10" id="panNumber" name="pan_number"
                        style="padding-right: 40px;" readonly>
                    <img src="{{ asset('public/assets/upload/pan_card.png') }}" alt="PAN Photo" class="pan-icon">
                    @error('pan_number')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <!--<div class="col-6">-->
            <!--    <div class="form-group">-->
            <!--      <label for="" ><b>TIN Number</b></label>-->
            <!--      <input type="text" class="form-control" style="margin-top: 14px" id="entityName" name="tin_number" placeholder="Enter your TIN number" maxlength="11" value="{{ old('tin_number') }}">-->
            <!--      @error('tin_number')
        -->
                <!--      <span style="color: red">{{ $message }}</span>-->
                <!--
    @enderror-->
            <!--    </div>-->
            <!--</div>-->

            <div class="col-6">
                <div class="form-group position-relative">
                    <label for="msme_number" class="mt-3"><b>MSME Number, if any</b></label>
                    <input type="text" class="form-control" id="msme_number" name="msme_number"
                        placeholder="Enter MSME number" maxlength="16" value="{{ old('msme_number',$data->msme_number ?? '') }}">
                    <img src="{{ asset('public/assets/upload/msme-1.jpeg') }}" alt="MSME Photo" class="pan-icon"
                        style="width:55px">
                    @error('msme_number')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            {{-- <h5 class="text-center">FSSAI details, if Food Category</h5> --}}
            <div class="col-6">
                <div class="form-group position-relative">
                    <label for="" class="mt-3"><b>FSSAI Number</b></label>
                    <input type="text" class="form-control" id="fssaiNumber" name="fssai_number"
                        placeholder="Enter your FSSAI number" maxlength="14" value="{{ old('fssai_number',$data->fssai_number ?? '') }}"
                        inputmode="numeric" pattern="\d*">
                    <img src="{{ asset('public/assets/upload/fssi.jpg') }}" alt="FSSAI Photo" style="width:55px"
                        class="pan-icon">
                    @error('fssai_number')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <h5 class="text-center mt-2 mb-3"><b>Payment Terms</b></h5>

            <div class="col-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1" class="mt-3"><b>RTV on Expiry/Slow Moving</b></label>
                    <select class="form-control" id="exampleFormControlSelect1" name="rtv_expiry">
                        <option selected disabled>Choose RTV on Expiry</option>
                        <option value="Yes"{{ old('rtv_expiry',$data->rtv_expiry ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ old('rtv_expiry',$data->rtv_expiry ?? '') == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                    @error('rtv_expiry')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1" class="mt-3"><b>RTV on Damages</b></label>
                    <select class="form-control" id="exampleFormControlSelect1" name="rtv_damage">
                        <option selected disabled>Choose RTV on Damages</option>
                        <option value="Yes" {{ old('rtv_damage',$data->rtv_damage ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ old('rtv_damage',$data->rtv_damage ?? '') == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                    @error('rtv_damage')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1" class="mt-3"><b>Payment Cycle, if Payment on Sale</b></label>
                    <select class="form-control" id="payment_cycle" name="payment_cycle">
                        <option selected disabled>Choose Payment Cycle</option>
                        <option value="Monthly" {{ old('payment_cycle',$data->payment_cycle ?? '') == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="Fortnight" {{ old('payment_cycle',$data->payment_cycle ?? '') == 'Fortnight' ? 'selected' : '' }}>Fortnight
                        </option>
                        <option value="Weekly" {{ old('payment_cycle',$data->payment_cycle ?? '') == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="Bill-to-Bill" {{ old('payment_cycle',$data->payment_cycle ?? '') == 'Bill-to-Bill' ? 'selected' : '' }}>
                            Bill-to-Bill</option>
                        <option value="Not Applicable" {{ old('payment_cycle',$data->payment_cycle ?? '') == 'Not Applicable' ? 'selected' : '' }}>
                            Not Applicable</option>
                    </select>
                    @error('payment_cycle')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3" id="creditDaysDiv" style="display: none;">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Credit Days, if applicable</b></label>
                    <input type="text" class="form-control" id="credit_day" name="credit_day"
                        placeholder="Enter credit day" value="{{ old('credit_day',$data->credit_day ?? '') }}">
                    @error('credit_day')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <h5 class="text-center mt-2 mb-3"><b>Bank Information</b></h5>

            <div class="col-3">
                <div class="form-group position-relative">
                    <label for=""><b>Cancelled Cheque (only PDF, Excel, JPG, PNG, Zip)</b></label>
                    <input type="file" class="form-control" id="cancelled_cheque" name="cancelled_cheque"
                        value="{{ old('cancelled_cheque',$data->cancelled_cheque ?? '') }}">
                    <img src="{{ asset('public/assets/upload/cancle_cheque.png') }}" alt="Cheque Photo"
                        style="width: 40px; top:70%" class="pan-icon">
                    @error('cancelled_cheque')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3 mt-4">
                <div class="form-group">
                    <label for=""><b>Beneficiary Name</b></label>
                    <input type="text" class="form-control" id="entityName" name="beneficiary_name"
                        placeholder="Enter Beneficiary Name" value="{{ old('beneficiary_name',$data->beneficiary_name ?? '') }}">
                    @error('beneficiary_name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3 mt-4">
                <div class="form-group">
                    <label for=""><b>Bank Name</b></label>
                    <input type="text" class="form-control" id="entityName" name="bank_name"
                        placeholder="Enter your Bank Name" value="{{ old('bank_name',$data->bank_name ?? '') }}">
                    @error('bank_name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3 mt-4">
                <div class="form-group">
                    <label for=""><b>Branch Address</b></label>
                    <input type="text" class="form-control" id="entityName" name="bank_address"
                        placeholder="Enter your Branch Address" value="{{ old('bank_address',$data->bank_address ?? '') }}">
                    @error('bank_address')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Postal/Zip Code</b></label>
                    <input type="number" class="form-control" id="entityName" name="postal_zip_code"
                        placeholder="Enter your Postal/Zip Code" value="{{ old('postal_zip_code',$data->postal_zip_code ?? '') }}">
                    @error('postal_zip_code')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Country</b></label>
                    <input type="text" class="form-control" id="entityName" name="bank_country_name"
                        placeholder="Enter your country name" value="{{ old('bank_country_name',$data->bank_country_name ?? '') }}">
                    @error('bank_country_name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Beneficiary Account Type</b></label>
                    <select class="form-control" id="exampleFormControlSelect1" name="beneficiary_account_type">
                        <option selected disabled>Choose Beneficiary Ac/type</option>
                        <option value="Saving" {{ old('beneficiary_account_type',$data->beneficiary_account_type ?? '') == 'Saving' ? 'selected' : '' }}>Saving
                        </option>
                        <option value="Current" {{ old('beneficiary_account_type',$data->beneficiary_account_type ?? '') == 'Current' ? 'selected' : '' }}>
                            Current</option>
                    </select>
                    @error('beneficiary_account_type')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Beneficiary Account Name</b></label>
                    <input type="text" class="form-control" id="entityName" name="beneficiary_account_name"
                        placeholder="Enter Beneficiary A/C Name" value="{{ old('beneficiary_account_name', $data->beneficiary_account_name ?? '') }}">
                    @error('beneficiary_account_name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Beneficiary Account Number</b></label>
                    <input type="text" class="form-control" id="entityName" name="beneficiary_account_number"
                        placeholder="Enter Beneficiary A/C No." maxlength="18"
                        value="{{ old('beneficiary_account_number', $data->beneficiary_account_number ?? '') }}">
                    @error('beneficiary_account_number')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Branch MICR Code (Optional)</b></label>
                    <input type="text" class="form-control" id="entityName" name="branch_micr_code"
                        placeholder="Enter Branch MICR Code" value="{{ old('branch_micr_code' , $data->branch_micr_code ?? '') }}">
                    <!--@error('branch_micr_code')
        -->
                        <!--<span style="color: red">{{ $message }}</span>-->
                        <!--
    @enderror-->
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Branch IFSC Code</b></label>
                    <input type="text" class="form-control" id="entityName" name="branch_ifsc_code"
                        placeholder="Enter Branch IFSC Code" value="{{ old('branch_ifsc_code' , $data->branch_ifsc_code ?? '') }}">
                    @error('branch_ifsc_code')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Listing Charges</b></label>
                    <select class="form-control" id="listing_charges" name="listing_charges">
                        <option selected disabled>Choose Listing Charges</option>
                        <option value="Paid" {{ old('listing_charges',$data->listing_charges ?? '') == 'Paid' ? 'selected' : '' }}>Paid</option>
                        <option value="Due" {{ old('listing_charges',$data->listing_charges ?? '') == 'Due' ? 'selected' : '' }}>Due</option>
                        <option value="Not Applicable" {{ old('listing_charges',$data->listing_charges ?? '') == 'Not Applicable' ? 'selected' : '' }}>
                            Not Applicable</option>
                    </select>
                    @error('listing_charges')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3" id="paymentRefDiv" style="display: none;">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Payment Ref</b></label>
                    <input type="text" class="form-control" id="entityName" name="q_mart_retail"
                        placeholder="Enter Payment Ref" value="{{ old('q_mart_retail',$data->q_mart_retail ?? '') }}">
                    @error('q_mart_retail')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <p><b>Q-Mart Retail Pvt Limited<br>
                    HDFC Bank Limited<br>
                    03178640000260<br>
                    HDFC0002391</b></p>
            <div class="form-group">
                <label for=""><b>Remark (maximum:300 words)</b></label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="vendor_remark"
                    placeholder="Write Your remark">{{ old('vendor_remark',$data->vendor_remark ?? '') }}</textarea>
            </div>
    </div>






    
    <button type="submit" class="btn-submit btn-report mr-3 mb-3">Submit</button>
    @if(!old('subject',$data->subject ?? ''))
        <button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button>
    @endif
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        setTimeout(function() {
            $('#success-message').fadeOut('fast')
        }, 4000);

        setTimeout(function() {
            $('#error-message').fadeOut('fast')
        }, 4000);




        document.addEventListener('DOMContentLoaded', function() {
            // Assuming vendor GSTIN is stored in this variable (replace with actual vendor GSTIN)
            var gstin = "{{ $vendor->gstin }}";

            // Extract PAN number (10 characters starting from the 3rd character)
            if (gstin.length >= 13) { // Ensure GSTIN has enough characters
                var pan = gstin.substring(2, 12);
                document.getElementById('panNumber').value = pan;
            }
        });



        $(document).ready(function() {
            // Show the Payment Ref field if "Paid" is selected on page load
            if ($('#listing_charges').val() === 'Paid') {
                $('#paymentRefDiv').show();
            } else {
                $('#paymentRefDiv').hide();
            }

            // Show or hide the Payment Ref field based on the selected option
            $('#listing_charges').change(function() {
                if ($(this).val() === 'Paid') {
                    $('#paymentRefDiv').show();
                } else {
                    $('#paymentRefDiv').hide();
                }
            });
        });

        $(document).ready(function() {
            // Check the selected value on page load
            if ($('#payment_cycle').val() === 'Not Applicable') {
                $('#creditDaysDiv').show();
            } else {
                $('#creditDaysDiv').hide();
            }

            // Show or hide the Credit Days field based on the selected option
            $('#payment_cycle').change(function() {
                if ($(this).val() === 'Not Applicable') {
                    $('#creditDaysDiv').show();
                } else {
                    $('#creditDaysDiv').hide();
                }
            });
        });


        document.getElementById('fssaiNumber').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
@endsection
