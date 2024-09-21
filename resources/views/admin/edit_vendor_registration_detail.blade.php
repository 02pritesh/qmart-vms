@extends('admin.main.main')

@section('admin-content')

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


  @if(session('error'))
        <div class="alert alert-danger" id="error-message">
            {{ session('error') }}
        </div>
    @endif

@if(session('error'))
    <div class="alert alert-danger" id="error-message">
        {{ session('error') }}
    </div>
@endif

<!--<h3 class="text-center" style="color:#000;font-family: Silka-Black;"><b>Edit Vendor Registration Details</b></h3>-->
<a href="{{url('vendor-registration-detail')}}" class="btn-submit ml-3" style="text-decoration: none; padding:4px 14px;"><i class="fa-solid fa-left-long"></i></a>

  <div class="container block mt-4 mb-4">
    <div class="row col-12">
        <form action="{{ url('edit-vendor-registration-detail') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$vendorDetail->id}}">

            <div class="row">
                <!-- Subject Field -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="" class="mt-3"><b>Subject</b></label>
                        <input type="text" class="form-control" id="entityName" name="subject" value="{{$vendorDetail->subject}}" maxlength="60">
                        @error('subject')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <!-- Vendor Trade Name Field -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="" class="mt-3"><b>Vendor Trade Name</b></label>
                        <input type="text" class="form-control" id="entityName" name="vendor_name" value="{{$vendorDetail->vendor_name}}">
                        @error('vendor_name')
                        <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Legal Name (As per GST)</b></label>
                    <input type="text" class="form-control" id="entityName" name="legal_name" value="{{$vendorDetail->legal_name}}">
                    @error('legal_name')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>
             <div class="row">
            <h5 class="text-center mt-2 mb-3"><b>Address</b></h5>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Street/House No :</b></label>
                    <input type="text" class="form-control" id="entityName" name="street_no" value="{{$vendorDetail->street_no}}">
                    @error('street_no')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>City</b></label>
                    <input type="text" class="form-control" id="entityName" name="city" value="{{$vendorDetail->city}}">
                    @error('city')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Postal Code</b></label>
                    <input type="number" class="form-control" id="entityName" name="country_name" value="{{$vendorDetail->country_name}}">
                    @error('country_name')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <h5 class="text-center mt-2 mb-3"><b>Communication</b></h5>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Telephone</b></label>
                    <input type="number" class="form-control" id="entityName" name="telephone_number" value="{{$vendorDetail->telephone_number}}">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Mobile No.1</b></label>
                    <input type="number" class="form-control" id="entityName" name="mobile_number1" maxlength="10" value="{{$vendorDetail->mobile_number1}}">
                    @error('mobile_number1')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Contact Person</b></label>
                    <input type="text" class="form-control" id="entityName" name="contact_person1" value="{{$vendorDetail->contact_person1}}">
                    @error('contact_person1')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Mobile No.2</b></label>
                    <input type="number" class="form-control" id="entityName" name="mobile_number2" maxlength="10" value="{{$vendorDetail->mobile_number2}}">
                    @error('mobile_number2')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Contact Person</b></label>
                    <input type="text" class="form-control" id="entityName" name="contact_person2" value="{{$vendorDetail->contact_person2}}">
                    @error('contact_person2')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>

            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="" class="mt-3"><b>E-Mail</b></label>
                    <input type="email" class="form-control" id="entityName" name="email" value="{{$vendorDetail->email}}">
                    @error('email')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>


            <h5 class="text-center mt-2 mb-3"><b>TAX Information</b></h5>

            <div class="col-6">
                <div class="form-group position-relative">
                    <label for="" class="mt-3"><b>GST Number</b></label>
                    <input type="text" class="form-control" id="entityName" name="gst_number" maxLength="15" value="{{$vendorDetail->gst_number}}">
                    <img src="{{asset('public/assets/upload/gst.png')}}" alt="GST Photo" class="pan-icon" style="width: 40px">
                    @error('gst_number')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="form-group position-relative">
                    <label for="" class="mt-3"><b>PAN Number</b></label>
                    <input type="text" class="form-control" maxlength="10" id="entityName" name="pan_number" style="padding-right: 40px;" value="{{$vendorDetail->pan_number}}">
                    <img src="{{asset('public/assets/upload/pan_card.png')}}" alt="PAN Photo" class="pan-icon">
                    @error('pan_number')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>


            <!--<div class="col-6">-->
            <!--    <div class="form-group">-->
            <!--      <label for="" ><b>TIN Number</b></label>-->
            <!--      <input type="text" class="form-control" style="margin-top: 14px" id="entityName" name="tin_number"  maxlength="11" value="{{$vendorDetail->tin_number}}">-->
            <!--      @error('tin_number')-->
            <!--      <span style="color: red">{{$message}}</span>-->
            <!--      @enderror-->
            <!--    </div>-->
            <!--</div>-->

            <div class="col-6">
                <div class="form-group position-relative">
                    <label for="" class="mt-3"><b>MSME Number, if any</b></label>
                    <input type="text" class="form-control" id="entityName" name="msme_number" maxlength="12" value="{{$vendorDetail->msme_number}}">
                    <img src="{{asset('public/assets/upload/msme-1.jpeg')}}" alt="MSME Photo" class="pan-icon" style="width:55px">
                    @error('msme_number')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            {{-- <h5 class="text-center">FSSAI details, if Food Category</h5> --}}

            <div class="col-6">
                <div class="form-group position-relative">
                    <label for="" class="mt-3"><b>FSSAI Number</b></label>
                    <input type="number" class="form-control" id="entityName" name="fssai_number" maxlength="14" value="{{$vendorDetail->fssai_number}}">
                    <img src="{{asset('public/assets/upload/fssi.jpg')}}" alt="FSSAI Photo" style="width: 58px;" class="pan-icon">
                    @error('fssai_number')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>



            <h5 class="text-center mt-2 mb-3"><b>Payment Terms</b></h5>

            <div class="col-3 mt-4">
                <div class="form-group">
                    <label for="exampleFormControlSelect1" class="mt-3"><b>RTV on Expiry/Slow Moving</b></label>
                    <select class="form-control" id="exampleFormControlSelect1" name="rtv_expiry">
                        <option selected disabled>Choose RTV on Expiry</option>
                        <option value="Yes" {{ old('rtv_expiry', $vendorDetail->rtv_expiry) == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ old('rtv_expiry', $vendorDetail->rtv_expiry) == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                    @error('rtv_expiry')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="col-3 mt-4">
                <div class="form-group">
                    <label for="exampleFormControlSelect1" class="mt-3"><b>RTV on Damages</b></label>
                    <select class="form-control" id="exampleFormControlSelect1" name="rtv_damage">
                        <option selected disabled>Choose RTV on Damages</option>
                        <option value="Yes" {{ old('rtv_damage', $vendorDetail->rtv_damage ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ old('rtv_damage', $vendorDetail->rtv_damage ?? '') == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                    @error('rtv_damage')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1" class="mt-3"><b>Payment Cycle,if Payment on Sale</b></label>
                    <select class="form-control" id="payment_cycle" name="payment_cycle">
                        <option selected disabled>Choose Payment Cycle</option>
                        <option value="Monthly" {{ old('payment_cycle', $vendorDetail->payment_cycle ?? '') == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="Fortnight" {{ old('payment_cycle', $vendorDetail->payment_cycle ?? '') == 'Fortnight' ? 'selected' : '' }}>Fortnight</option>
                        <option value="Weekly" {{ old('payment_cycle', $vendorDetail->payment_cycle ?? '') == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="Bill-to-Bill" {{ old('payment_cycle', $vendorDetail->payment_cycle ?? '') == 'Bill-to-Bill' ? 'selected' : '' }}>Bill-to-Bill</option>
                        <option value="Not Applicable" {{ old('payment_cycle', $vendorDetail->payment_cycle ?? '') == 'Not Applicable' ? 'selected' : '' }}>Not Applicable</option>
                    </select>
                    @error('payment_cycle')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3 mt-4" id="creditDaysDiv" style="display: none;">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Credit Days, if applicable</b></label>
                    <input type="text" class="form-control" id="credit_day" name="credit_day" placeholder="Enter credit day" value="{{ old('credit_day', $vendorDetail->credit_day ?? '') }}">
                    @error('credit_day')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <h5 class="text-center mt-2 mb-3"><b>Bank Information</b></h5>

            <div class="col-3">
                <div class="form-group position-relative">
                    <label for="cancelledCheque"><b>Cancelled Cheque (Only PDF, Excel, JPG, PNG, and Zip)</b></label>
                    <!-- File input for a new file upload -->
                    
                    
                    <input type="file" class="form-control" id="cancelledCheque" name="cancelled_cheque">

                    <!-- Hidden input to retain the existing file if no new file is uploaded -->
                    <input type="hidden" name="existing_cancelled_cheque" value="{{ $vendorDetail->cancelled_cheque }}">

                    <!-- Display the existing image -->
                    <!--<img src="{{ asset('public/assets/upload/' . $vendorDetail->cancelled_cheque) }}" alt="Cheque Photo" style="position: absolute; top: 50%; right: 10px; width: 40px; transform: translateY(-50%);" class="pan-icon">-->

                    <!--<img src="{{ asset('public/assets/upload/' . $vendorDetail->cancelled_cheque) }}" alt="Cheque Photo" download>-->
                    @if($vendorDetail->cancelled_cheque)
                        <a href="{{ asset('public/assets/upload/' . $vendorDetail->cancelled_cheque) }}" class="btn-submit mt-2" style="text-decoration:none;" download>Available File</a>
                    @endif

                    @error('cancelled_cheque')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>



            <div class="col-3  mt-4">
                <div class="form-group">
                    <label for=""><b>Beneficiary Name</b></label>
                    <input type="text" class="form-control" id="entityName" name="beneficiary_name" value="{{$vendorDetail->beneficiary_name}}">
                    @error('beneficiary_name')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3 mt-4">
                <div class="form-group">
                    <label for=""><b>Bank Name</b></label>
                    <input type="text" class="form-control" id="entityName" name="bank_name" value="{{$vendorDetail->bank_name}}">
                    @error('bank_name')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3 mt-4">
                <div class="form-group">
                    <label for=""><b>Branch Address</b></label>
                    <input type="text" class="form-control" id="entityName" name="bank_address" value="{{$vendorDetail->bank_address}}">
                    @error('bank_address')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3 ">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Postal/Zip Code</b></label>
                    <input type="number" class="form-control" id="entityName" name="postal_zip_code" value="{{$vendorDetail->postal_zip_code}}">
                    @error('postal_zip_code')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Country</b></label>
                    <input type="text" class="form-control" id="entityName" name="bank_country_name" value="{{$vendorDetail->bank_country_name}}">
                    @error('bank_country_name')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1" class="mt-3"><b>Beneficiary Account Type</b></label>
                    <select class="form-control" id="exampleFormControlSelect1" name="beneficiary_account_type">
                        <option selected disabled>Choose Beneficiary Ac/type</option>
                        <option value="Saving" {{ old('beneficiary_account_type', $vendorDetail->beneficiary_account_type ?? '') == 'Saving' ? 'selected' : '' }}>Saving</option>
                        <option value="Current" {{ old('beneficiary_account_type', $vendorDetail->beneficiary_account_type ?? '') == 'Current' ? 'selected' : '' }}>Current</option>
                    </select>
                    @error('beneficiary_account_type')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <div class="col-3">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Beneficiary Account Name</b></label>
                    <input type="text" class="form-control" id="entityName" name="beneficiary_account_name" value="{{$vendorDetail->bank_name}}">
                    @error('beneficiary_account_name')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Beneficiary Account Number</b></label>
                    <input type="text" class="form-control" id="entityName" name="beneficiary_account_number" maxlength="11" value="{{$vendorDetail->beneficiary_account_number}}">
                    @error('beneficiary_account_number')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Branch MICR Code (Optional)</b></label>
                    <input type="text" class="form-control" id="entityName" name="branch_micr_code" value="{{$vendorDetail->branch_micr_code}}">
                    @error('branch_micr_code')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Branch IFSC Code</b></label>
                    <input type="text" class="form-control" id="entityName" name="branch_ifsc_code" value="{{$vendorDetail->branch_ifsc_code}}">
                    @error('branch_ifsc_code')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1" class="mt-3"><b>Listing Charges</b></label>
                    <select class="form-control" id="listing_charges" name="listing_charges">
                        <option selected disabled>Choose Listing Charges</option>
                        <option value="Paid" {{ old('listing_charges', $vendorDetail->listing_charges ?? '') == 'Paid' ? 'selected' : '' }}>Paid</option>
                        <option value="Due" {{ old('listing_charges', $vendorDetail->listing_charges ?? '') == 'Due' ? 'selected' : '' }}>Due</option>
                        <option value="Not Applicable" {{ old('listing_charges', $vendorDetail->listing_charges ?? '') == 'Not Applicable' ? 'selected' : '' }}>Not Applicable</option>
                    </select>
                    @error('listing_charges')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-3" id="paymentRefDiv" style="display: none;">
                <div class="form-group">
                    <label for="" class="mt-3"><b>Payment Ref</b></label>
                    <input type="text" class="form-control" id="entityName" name="q_mart_retail" value="{{ old('q_mart_retail', $vendorDetail->q_mart_retail ?? '') }}">
                    @error('q_mart_retail')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for=""><b>Remark (maximum:300 words)</b></label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="vendor_remark">{{ $vendorDetail->vendor_remark }}</textarea>
            </div>

</div>

            <div class="col-6">
                <div class="form-group">
                    <label for="" class=""><b>Approved By</b></label>
                    <input type="text" class="form-control" id="entityName" name="approved_by" value="{{session()->get('admin_name')}}" readonly>
                    @error('approved_by')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            @if($vendorDetail->status == 'Pending')

            <button type="submit" class="btn-submit btn-report mr-3 mb-3">Submit</button>
            {{-- <button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button> --}}

            @elseif($vendorDetail->status == 'Approved' && session()->get('adminloginId') == 1)
            <button type="submit" class="btn-submit btn-report mr-3 mb-3">Submit</button>
            {{-- <button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button> --}}
            @endif
            
        </form>
    </div>
    </div>






    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        setTimeout(function() {
            $('#success-message').fadeOut('fast')
        }, 4000);

        setTimeout(function() {
            $('#error-message').fadeOut('fast')
        }, 4000);

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
    </script>
    @endsection