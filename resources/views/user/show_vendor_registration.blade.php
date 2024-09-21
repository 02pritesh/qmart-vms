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
            pointer-events: none; /* This ensures that the image doesn't interfere with input actions */
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

    <!--<h3 class="text-center" style="color:#000;font-family: Silka-Black;"><b>Edit Vendor Registration Details</b></h3>-->
    <a href="{{url('vendor-show-vendor-registration-detail')}}" class="btn-submit ml-3" style="text-decoration: none; padding:4px 14px;"><i class="fa-solid fa-left-long"></i></a>

    <div class="container block mt-4 mb-4">
        <!--<form action="{{ url('edit-vendor-registration-detail') }}" method="POST" enctype="multipart/form-data">-->
            @csrf
            
         
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label for="" class="mt-3"><b>Subject</b></label>
                        <input type="text" class="form-control" id="entityName" name="subject"  value="{{$vendorDetail->subject}}" maxlength="60" readonly>
                        @error('subject')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="form-group">
                        <label for="" class="mt-3"><b>Vendor Trade Name</b></label>
                        <input type="text" class="form-control" id="entityName" name="vendor_name"  value="{{$vendorDetail->vendor_name}}" readonly>
                        @error('vendor_name')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Legal Name (As per GST)</b></label>
                      <input type="text" class="form-control" id="entityName" name="legal_name"  value="{{$vendorDetail->legal_name}}" readonly>
                      @error('legal_name')
                        <span style="color: red">{{$message}}</span>
                      @enderror
                    </div>
                </div>

                <h5 class="text-center mt-2 mb-3"><b>Address</b></h5>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Street/House No :</b></label>
                      <input type="text" class="form-control" id="entityName" name="street_no"  value="{{$vendorDetail->street_no}}" readonly>
                      @error('street_no')
                        <span style="color: red">{{$message}}</span>
                      @enderror
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>City</b></label>
                      <input type="text" class="form-control" id="entityName" name="postal_code" value="{{$vendorDetail->postal_code}}" readonly>
                      @error('postal_code')
                      <span style="color: red">{{$message}}</span>
                      @enderror
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Postal Code</b></label>  
                      <input type="text" class="form-control" id="entityName" name="country_name"  value="{{$vendorDetail->country_name}}" readonly>
                      @error('country_name')
                      <span style="color: red">{{$message}}</span>
                      @enderror
                    </div>
                </div>

                <h5 class="text-center mt-2 mb-3"><b>Communication</b></h5>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Telephone</b></label>
                      <input type="number" class="form-control" id="entityName" name="telephone_number" value="{{$vendorDetail->telephone_number}}" readonly>
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Mobile No.1</b></label>
                      <input type="number" class="form-control" id="entityName" name="mobile_number1"  maxlength="10" value="{{$vendorDetail->mobile_number1}}" readonly> 
                      @error('mobile_number1')
                      <span style="color: red">{{$message}}</span>
                      @enderror
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Contact Person</b></label>
                      <input type="text" class="form-control" id="entityName" name="contact_person1"  value="{{$vendorDetail->contact_person1}}" readonly>
                      @error('contact_person1')
                      <span style="color: red">{{$message}}</span>
                      @enderror
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Mobile No.2</b></label>
                      <input type="number" class="form-control" id="entityName" name="mobile_number2"  maxlength="10" value="{{$vendorDetail->mobile_number2}}" readonly>
                      @error('mobile_number2')
                      <span style="color: red">{{$message}}</span>
                      @enderror
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Contact Person</b></label>
                      <input type="text" class="form-control" id="entityName" name="contact_person2"  value="{{$vendorDetail->contact_person2}}" readonly>
                      @error('contact_person2')
                      <span style="color: red">{{$message}}</span>
                      @enderror
                    </div>

                </div>

                <div class="col-4">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>E-Mail</b></label>
                      <input type="email" class="form-control" id="entityName" name="email"  value="{{$vendorDetail->email}}" readonly>
                      @error('email')
                      <span style="color: red">{{$message}}</span>
                      @enderror
                    </div>
                </div>
              

                <h5 class="text-center mt-2 mb-3"><b>TAX Information</b></h5>

                <div class="col-6">
                    <div class="form-group position-relative">
                      <label for="" class="mt-3"><b>GST Number</b></label>
                      <input type="text" class="form-control" id="entityName" name="gst_number"  value="{{$vendorDetail->gst_number}}" readonly>
                      <img src="{{asset('public/assets/upload/gst.png')}}" alt="GST Photo" class="pan-icon"  style="width: 40px">
                      @error('gst_number')
                      <span style="color: red">{{$message}}</span>
                      @enderror
                    </div>
                </div>

                <div class="col-6">
                  <div class="form-group position-relative">
                      <label for="" class="mt-3"><b>PAN Number</b></label>
                      <input type="text" class="form-control" maxlength="10" id="entityName" name="pan_number"  style="padding-right: 40px;" value="{{$vendorDetail->pan_number}}" readonly>
                      <img src="{{asset('public/assets/upload/pan_card.png')}}" alt="PAN Photo" class="pan-icon">
                      @error('pan_number')
                      <span style="color: red">{{$message}}</span>
                      @enderror
                  </div>
                </div>
              

                <!--<div class="col-6">-->
                <!--    <div class="form-group">-->
                <!--      <label for="" ><b>TIN Number</b></label>-->
                <!--      <input type="text" class="form-control" style="margin-top: 14px" id="entityName" name="tin_number"  maxlength="11" value="{{$vendorDetail->tin_number}}" readonly>-->
                <!--      @error('tin_number')-->
                <!--      <span style="color: red">{{$message}}</span>-->
                <!--      @enderror-->
                <!--    </div>-->
                <!--</div>-->

                <div class="col-6">
                    <div class="form-group position-relative">
                      <label for="" class="mt-3"><b>MSME Number, if any</b></label>
                      <input type="text" class="form-control" id="entityName" name="msme_number" maxlength="12" value="{{$vendorDetail->msme_number}}" readonly>
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
                      <input type="text" class="form-control" id="entityName" name="fssai_number"  maxlength="14" value="{{$vendorDetail->fssai_number}}" readonly>
                      <img src="{{asset('public/assets/upload/fssi.jpg')}}" alt="FSSAI Photo" style="width: 58px;" class="pan-icon">
                      @error('fssai_number')
                      <span style="color: red">{{$message}}</span>
                      @enderror
                    </div>
                </div>
                
                

                <h5 class="text-center mt-2 mb-3"><b>Payment Terms</b></h5>
                
                  <div class="col-3">
                  <div class="form-group">
    <label for="exampleFormControlSelect1" class="mt-3"><b>RTV on Expiry/Slow Moving</b></label>
    <select class="form-control" id="exampleFormControlSelect1" name="rtv_expiry" readonly>
        <option selected disabled>Choose RTV on Expiry</option>
        <option value="Yes" {{ old('rtv_expiry', $vendorDetail->rtv_expiry) == 'Yes' ? 'selected' : '' }}>Yes</option>
        <option value="No" {{ old('rtv_expiry', $vendorDetail->rtv_expiry) == 'No' ? 'selected' : '' }}>No</option>
    </select>
    @error('rtv_expiry')
        <span style="color: red">{{ $message }}</span>
    @enderror
</div>

                </div>

                <div class="col-3">
    <div class="form-group">
        <label for="exampleFormControlSelect1" class="mt-3"><b>RTV on Damages</b></label>
        <select class="form-control" id="exampleFormControlSelect1" name="rtv_damage" readonly>
            <option selected disabled>Choose RTV on Damages</option >
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
        <label for="exampleFormControlSelect1" class="mt-3"><b>Payment Cycle, if Payment on Sale</b></label>
        <select class="form-control" id="exampleFormControlSelect1" name="payment_cycle" readonly>
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


                <div class="col-3">
                    <div class="form-group">
                      <label for="" class="mt-3"><b>Credit Days, if applicable</b></label>
                      <input type="text" class="form-control" id="entityName" name="credit_day" placeholder="Enter credit day" value="{{$vendorDetail->credit_day}}" readonly>
                      @error('credit_day')
                      <span style="color: red">{{$message}}</span>
                      @enderror
                    </div>
                </div>

                <h5 class="text-center mt-2 mb-3"><b>Bank Information</b></h5>

               <div class="col-3">
                    <div class="form-group position-relative">
                        <label for="cancelledCheque"><b>Cancelled Cheque</b></label>
                        <a href="{{ asset('public/assets/upload/' . $vendorDetail->cancelled_cheque) }}" class="btn-submit" style="text-decoration:none;" download>Download File</a>

                    </div>
                </div>



                <div class="col-3">
                    <div class="form-group">
                      <label for=""><b>Beneficiary Name</b></label>
                      <input type="text" class="form-control" id="entityName" name="beneficiary_name"  value="{{$vendorDetail->beneficiary_name}}" readonly>
                      @error('beneficiary_name')
                      <span style="color: red">{{$message}}</span>
                      @enderror
                    </div>
                </div>

                <div class="col-3">
                  <div class="form-group">
                    <label for=""><b>Bank Name</b></label>
                    <input type="text" class="form-control" id="entityName" name="bank_name"  value="{{$vendorDetail->bank_name}}" readonly>
                    @error('bank_name')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                  </div>
              </div>

              <div class="col-3">
                  <div class="form-group">
                    <label for=""><b>Branch Address</b></label>
                    <input type="text" class="form-control" id="entityName" name="bank_address"  value="{{$vendorDetail->bank_address}}" readonly>
                    @error('bank_address')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                  </div>
              </div>

              <div class="col-3">
                <div class="form-group">
                  <label for="" class="mt-3"><b>Postal/Zip Code</b></label>
                  <input type="number" class="form-control" id="entityName" name="postal_zip_code"  value="{{$vendorDetail->postal_zip_code}}" readonly>
                  @error('postal_zip_code')
                  <span style="color: red">{{$message}}</span>
                  @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                  <label for="" class="mt-3"><b>Country</b></label>
                  <input type="text" class="form-control" id="entityName" name="bank_country_name"  value="{{$vendorDetail->bank_country_name}}" readonly>
                  @error('bank_country_name')
                  <span style="color: red">{{$message}}</span>
                  @enderror
                </div>
            </div>

            <div class="col-3">
    <div class="form-group">
        <label for="exampleFormControlSelect1" class="mt-3"><b>Beneficiary Account Type</b></label>
        <select class="form-control" id="exampleFormControlSelect1" name="beneficiary_account_type" readonly>
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
                <input type="text" class="form-control" id="entityName" name="beneficiary_account_name"  value="{{$vendorDetail->bank_name}}" readonly>
                @error('beneficiary_account_name')
                <span style="color: red">{{$message}}</span>
                @enderror
              </div>
          </div>

          <div class="col-3">
            <div class="form-group">
              <label for="" class="mt-3"><b>Beneficiary Account Number</b></label>
              <input type="text" class="form-control" id="entityName" name="beneficiary_account_number"  maxlength="11" value="{{$vendorDetail->beneficiary_account_number}}" readonly>
              @error('beneficiary_account_number')
              <span style="color: red">{{$message}}</span>
              @enderror
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
              <label for="" class="mt-3"><b>Branch MICR Code (Optional)</b></label>
              <input type="text" class="form-control" id="entityName" name="branch_micr_code"  value="{{$vendorDetail->branch_micr_code}}" readonly>
              @error('branch_micr_code')
              <span style="color: red">{{$message}}</span>
              @enderror
            </div>
        </div>

        <div class="col-3">
          <div class="form-group">
            <label for="" class="mt-3"><b>Branch IFSC Code</b></label>
            <input type="text" class="form-control" id="entityName" name="branch_ifsc_code" value="{{$vendorDetail->branch_ifsc_code}}" readonly>
            @error('branch_ifsc_code')
            <span style="color: red">{{$message}}</span>
            @enderror          
          </div>
      </div>

      <div class="col-3">
    <div class="form-group">
        <label for="exampleFormControlSelect1" class="mt-3"><b>Listing Charges</b></label>
        <select class="form-control" id="exampleFormControlSelect1" name="listing_charges" readonly>
            <option selected disabled>Choose Listing Charges</option>
            <option value="Paid" {{ old('listing_charges', $vendorDetail->listing_charges ?? '') == 'Paid' ? 'selected' : '' }}>Paid</option>
            <option value="Due" {{ old('listing_charges', $vendorDetail->listing_charges ?? '') == 'Due' ? 'selected' : '' }}>Due</option>
        </select>
        @error('listing_charges')
        <span style="color: red">{{ $message }}</span>
        @enderror
    </div>
</div>


      <div class="col-3">
        <div class="form-group">
          <label for="" class="mt-3"><b>Payment Ref</b></label>
          <input type="text" class="form-control" id="entityName" name="q_mart_retail"  value="{{$vendorDetail->q_mart_retail}}" readonly>
          @error('q_mart_retail')
          <span style="color: red">{{$message}}</span>
          @enderror           
        </div>
      </div>

      <div class="form-group">
        <label for=""><b>Remark (maximum:300 words)</b></label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="vendor_remark"  readonly>{{ $vendorDetail->vendor_remark }}</textarea>
     </div>
    </div>
  






      <!--  <button type="submit" class="btn-submit btn-report mr-3 mb-3">Submit</button>-->
      <!--  <button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button>-->
      <!--</form>-->
    </div>

    <script>
        setTimeout(function() {
            $('#success-message').fadeOut('fast')
        }, 4000);

        setTimeout(function() {
            $('#error-message').fadeOut('fast')
        }, 4000);
    </script>
@endsection