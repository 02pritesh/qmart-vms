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

        .btn-reply {
            border: 1px solid #4caf50;
            color: #4caf50;
        }

        .btn-reply:hover {
            background-color: #4caf50;
            color: #fff !important;
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

    <a href="{{ url('vendor-show-innvoices-detail') }}" class="btn-submit ml-3"
        style="text-decoration: none; padding:4px 14px;"><i class="fa-solid fa-left-long"></i></a>


    @if ($messages->admin_message)

        <h3 class="text-center" style="color:#000;font-family: Silka-Black;"><b>Q-Mart Message</b></h3>

        <div class="container block mt-4 mb-4">

            <form action="{{ url('admin-reply') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <input type="hidden" name="id" value="{{ $messages->id }}">

                    <div class="col-4">
                        <div class="form-group">
                            <label for="" class="mt-3"><b>Document No (upto 40 characters)</b></label>
                            <input type="text" class="form-control" id="entityName" name="admin_document"
                                value="{{ $messages->admin_document }}" readonly>
                            @error('admin_document')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> 
                    
                    <div class="col-4">
                        <div class="form-group">
                            <label for="" class="mt-3"><b>Amount</b></label>
                            <input type="text" class="form-control" id="entityName" name="admin_amount"
                                value="{{ $messages->admin_amount }}" readonly>
                            @error('admin_amount')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> 

                    <div class="form-group pt-3">
                        <h6>Message (maximum: 300 words)</h6>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="admin_message"
                            placeholder="Write Your Message" readonly>{{ old('admin_message', $messages->admin_message) }}</textarea>
                        @error('admin_message')
                            <span style="color: red; font-size: 18px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">

                        <label for=""><b>File</b></label><br>

                        @if ($messages->admin_file)
                            @if (in_array(pathinfo($messages->admin_file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                <!-- Display image if file is an image -->
                                <a href="{{ asset('public/assets/upload/innvoices/' . $messages['admin_file']) }}" download>
                                    <img src="{{ asset('public/assets/upload/innvoices/' . $messages['admin_file']) }}"
                                        alt="Uploaded File" style="max-width: 8%; height: auto;">
                                </a>

                                <input type="hidden" name="existing_admin_file" value="{{ $messages->admin_file }}">
                            @else
                                <!-- Display file if it is not an image -->
                                <a href="{{ asset('public/assets/upload/innvoices/' .$messages['admin_file']) }}"
                                    class="btn-submit" style="text-decoration:none; font-size:12px;" target="_blank"
                                    download>View Uploaded File</a>
                            @endif
                        @else
                            <p>No file uploaded.</p>
                        @endif
                    </div>

            

                </div>

            </form>
        </div>

        <h3 class="text-center" style="color:#000;font-family: Silka-Black;"><b>Vendor Message</b></h3>
        
        <div class="container block mt-4 mb-4">

            <form action="{{ url('vendor-innvoice-reply') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <p></p>
                            <h6>Vendor Entity Name</h6>

                            <input type="hidden" name="id" value="{{ $messages->id }}">

                            <input type="text" class="form-control" id="entityName"
                                value="{{ Session::get('vendor_name') }}" name="vendor_name" readonly>

                        </div>
                    </div>
                    
                    @if(!($messages->vendor_document))
                         <div class="col-4">
                            <div class="form-group">
                                <label for="" class="mt-3"><b>Document No (upto 40 characters)</b></label>
                                <input type="text" class="form-control" id="entityName" name="vendor_document"
                                    value="{{ $messages->vendor_document }}" placeholder="Enter Document" >
                                @error('vendor_document')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> 
                    
                    @else
                        <div class="col-4">
                            <div class="form-group">
                                <label for="" class="mt-3"><b>Document No (upto 40 characters)</b></label>
                                <input type="text" class="form-control" id="entityName" name="vendor_document"
                                    value="{{ $messages->vendor_document }}" placeholder="Enter Document" readonly>
                                @error('vendor_document')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> 
                    
                    @endif
                    
                   
                    @if(!($messages->vendor_amount))
                        <div class="col-4">
                            <div class="form-group">
                                <label for="" class="mt-3"><b>Amount</b></label>
                                <input type="text" class="form-control" id="amount" name="vendor_amount"
                                    value="{{ $messages->vendor_amount }}" placeholder="Enter Amount">
                                @error('vendor_amount')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                    @else
                    
                        <div class="col-4">
                            <div class="form-group">
                                <label for="" class="mt-3"><b>Amount</b></label>
                                <input type="text" class="form-control" id="amount" name="vendor_amount"
                                    value="{{ $messages->vendor_amount }}" placeholder="Enter Amount" readonly>
                                @error('vendor_amount')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                    @endif
                     


                    @if (!($messages->vendor_message))
                        <div class="form-group">
                            <h6>Message (maximum: 300 words)</h6>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="vendor_message"
                                placeholder="Write Your Message">{{ old('vendor_message', $messages->vendor_message) }}</textarea>
                            @error('vendor_message')
                                <span style="color: red; font-size: 18px">{{ $message }}</span>
                            @enderror
                        </div>
                    @else
                        <div class="form-group">
                            <h6>Message (maximum: 300 words)</h6>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="vendor_message"
                                placeholder="Write Your Message" readonly>{{ old('vendor_message', $messages->vendor_message) }}</textarea>
                            @error('vendor_message')
                                <span style="color: red; font-size: 18px">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <div class="form-group col-md-12">
                        <label for=""><b>File</b></label><br>
                        @if ($messages->vendor_file)
                            @if (in_array(pathinfo($messages->vendor_file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                <!-- Display image if file is an image -->
                                <a href="{{ asset('public/assets/upload/innvoices/' . $messages['vendor_file']) }}" download>
                                    <img src="{{ asset('public/assets/upload/innvoices/' . $messages['vendor_file']) }}"
                                        alt="Uploaded File" style="max-width: 8%; height: auto;">
                                </a>

                                <input type="hidden" name="existing_vendor_file" value="{{ $messages->vendor_file }}">
                            @else
                                <div class="form-group">
                                    <a href="{{ asset('public/assets/upload/innvoices/' . $messages['vendor_file']) }}"
                                        class="btn-submit" style="text-decoration:none;" download>Download File</a>
                                </div>
                            @endif
                        @else
                            <input type="file" name="vendor_file" class="form-control">
                        @endif
                    </div>
                    
                    @if(!($messages->entered_by))
                    
                     <div class="col-4">
                        <div class="form-group">
                                <label for="" class="mt-3"><b>Entered by</b></label>
                                <input type="text" class="form-control" id="entityName" name="entered_by" placeholder="Enter your Name"
                                    value="{{ $messages->entered_by  }}">
                                @error('entered_by')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                    
                    @else
                    
                     <div class="col-4">
                        <div class="form-group">
                                <label for="" class="mt-3"><b>Entered by</b></label>
                                <input type="text" class="form-control" id="entityName" name="entered_by" placeholder="Enter your Name"
                                    value="{{ $messages->entered_by  }}" readonly>
                                @error('entered_by')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                    
                    @endif
                    
                   



                </div>
               @if (!($messages->vendor_message))
                <button type="submit" class="btn-submit btn-report mr-3 mb-3">Submit</button>
                <button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button>
               @endif
            </form>
        </div>
    @else
        <h3 class="text-center" style="color:#000;font-family: Silka-Black;"><b>Vendor Message</b></h3>
         
        <div class="container block mt-4 mb-4">

            <form action="{{ url('edit-innvoices-mrn') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $messages->id }}">
                @if($messages->admin_message)
                    
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <p></p>
                                <h6>Vendor Entity Name</h6>
    
                                <input type="hidden" name="id" value="{{ $messages->id }}">
    
                                <input type="text" class="form-control" id="entityName"
                                    value="{{ Session::get('vendor_name') }}" name="vendor_name" readonly>
    
                            </div>
                        </div>
    
                        <div class="col-4">
                            <div class="form-group">
                                <label for="" class="mt-3"><b>Document No (upto 40 characters)</b></label>
                                <input type="text" class="form-control" id="entityName" name="vendor_document"
                                    value="{{ $messages->vendor_document }}" readonly>
                                @error('vendor_document')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> 
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label for="" class="mt-3"><b>Amount</b></label>
                                <input type="text" class="form-control" id="amount" name="vendor_amount"
                                    value="{{ $messages->vendor_amount }}" readonly>
                                @error('vendor_amount')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> 
    
                        <div class="form-group">
                            <h6>Message (maximum: 300 words)</h6>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="vendor_message"
                                placeholder="Write Your Message" readonly>{{ old('vendor_message', $messages->vendor_message) }}</textarea>
                            @error('vendor_message')
                                <span style="color: red; font-size: 18px">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <div class="form-group col-md-12">
                            <label for=""><b>File</b></label><br>
                            @if ($messages->vendor_file)
                                @if (in_array(pathinfo($messages->vendor_file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                    <!-- Display image if file is an image -->
                                    <a href="{{ asset('public/assets/upload/innvoices/' . $messages->vendor_file) }}" download>
                                        <img src="{{ asset('public/assets/upload/innvoices/' . $messages->vendor_file) }}"
                                            alt="Uploaded File" style="max-width: 8%; height: auto;">
                                    </a>
    
                                    <input type="hidden" name="existing_vendor_file" value="{{ $messages->vendor_file }}">
                                @else
                                    <div class="form-group">
                                        <a href="{{ asset('public/assets/upload/innvoices/' . $messages->vendor_file) }}"
                                            class="btn-submit" style="text-decoration:none;" download>Download File</a>
                                    </div>
                                @endif
                            @else
                                <input type="file" name="vendor_file" class="form-control">
                            @endif
                        </div>
                        
                         <div class="col-4">
                            <div class="form-group">
                                    <label for="" class="mt-3"><b>Entered by</b></label>
                                    <input type="text" class="form-control" id="entityName" name="entered_by" placeholder="Enter your Name"
                                        value="{{ $messages->entered_by  }}" readonly>
                                    @error('entered_by')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                
                @else
                    
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <p></p>
                                <h6>Vendor Entity Name</h6>
    
                                <input type="hidden" name="id" value="{{ $messages->id }}">
    
                                <input type="text" class="form-control" id="entityName"
                                    value="{{ Session::get('vendor_name') }}" name="vendor_name">
    
                            </div>
                        </div>
    
                        <div class="col-4">
                            <div class="form-group">
                                <label for="" class="mt-3"><b>Document No (upto 40 characters)</b></label>
                                <input type="text" class="form-control" id="entityName" name="vendor_document"
                                    value="{{ $messages->vendor_document }}">
                                @error('vendor_document')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> 
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label for="" class="mt-3"><b>Amount</b></label>
                                <input type="text" class="form-control" id="amount" name="vendor_amount"
                                    value="{{ $messages->vendor_amount }}">
                                @error('vendor_amount')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> 
    
                        <div class="form-group">
                            <h6>Message (maximum: 300 words)</h6>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="vendor_message"
                                placeholder="Write Your Message">{{ old('vendor_message', $messages->vendor_message) }}</textarea>
                            @error('vendor_message')
                                <span style="color: red; font-size: 18px">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <div class="form-group col-md-12">
                            <label for=""><b>File</b></label><br>
                            <input type="file" name="vendor_file" class="form-control">
                            @if ($messages->vendor_file)
                                @if (in_array(pathinfo($messages->vendor_file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                    <!-- Display image if file is an image -->
                                    <a href="{{ asset('public/assets/upload/innvoices/' . $messages->vendor_file) }}" download>
                                        <img src="{{ asset('public/assets/upload/innvoices/' . $messages->vendor_file) }}"
                                            alt="Uploaded File" style="max-width: 8%; height: auto;">
                                    </a>
    
                                    <input type="hidden" name="existing_vendor_file" value="{{ $messages->vendor_file }}">
                                @else
                                    <div class="form-group">
                                        <a href="{{ asset('public/assets/upload/innvoices/' . $messages->vendor_file) }}"
                                            class="btn-submit" style="text-decoration:none;" download>Download File</a>
                                    </div>
                                @endif
                          
                            @endif
                        </div>
                        
                        <div class="col-4">
                            <div class="form-group">
                                    <label for="" class="mt-3"><b>Entered by</b></label>
                                    <input type="text" class="form-control" id="entityName" name="entered_by" placeholder="Enter your Name"
                                        value="{{ $messages->entered_by  }}" >
                                    @error('entered_by')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    
                @endif
                
                @if(!$messages->admin_message)
                    <button type="submit" class="btn-submit btn-report mr-3 mb-3">Re-Submit</button>
                    <button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button>
                @endif
              
            </form>
        </div>

        <h3 class="text-center" style="color:#000;font-family: Silka-Black;"><b>Q-Mart Message</b></h3>

        <div class="container block mt-4 mb-4">

            <form action="{{ url('admin-reply') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <input type="hidden" name="id" value="{{ $messages->id }}">
                    
                    <div class="col-4">
                        <div class="form-group">
                            <label for="" class="mt-3"><b>Document No (upto 40 characters)</b></label>
                            <input type="text" class="form-control" id="entityName" name="admin_document"
                                value="{{ $messages->admin_document }}" readonly>
                            @error('admin_document')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> 
                    
                    <div class="col-4">
                        <div class="form-group">
                            <label for="" class="mt-3"><b>Amount</b></label>
                            <input type="text" class="form-control" id="amount" name="admin_amount"
                                value="{{ $messages->admin_amount }}" readonly>
                            @error('admin_amount')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> 
                    <div class="form-group pt-3">
                        <h6>Message (maximum: 300 words)</h6>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="admin_message"
                            placeholder="Write Your Message" readonly>{{ old('admin_message', $messages->admin_message) }}</textarea>
                        @error('admin_message')
                            <span style="color: red; font-size: 18px">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">

                        <label for=""><b>File</b></label><br>

                        @if ($messages->admin_file)
                            @if (in_array(pathinfo($messages->admin_file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                <!-- Display image if file is an image -->
                                <a href="{{ asset('public/assets/upload/innvoices/' . $messages->admin_file) }}" download>
                                    <img src="{{ asset('public/assets/upload/innvoices/' . $messages->admin_file) }}"
                                        alt="Uploaded File" style="max-width: 8%; height: auto;">
                                </a>

                                <input type="hidden" name="existing_admin_file" value="{{ $messages->admin_file }}">
                            @else
                                <!-- Display file if it is not an image -->
                                <a href="{{ asset('public/assets/upload/innvoices/' . $messages->admin_file) }}"
                                    class="btn-submit" style="text-decoration:none; font-size:12px;" target="_blank"
                                    download>View Uploaded File</a>
                            @endif
                        @else
                            <p>No file uploaded.</p>
                        @endif
                    </div>

                    <div class="form-group">

                    </div>

                </div>
                <!--<button type="submit" class="btn-submit btn-report mr-3 mb-3">Submit</button>-->
                <!--<button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button>-->
            </form>
        </div>

    @endif


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        setTimeout(function() {
            $('#success-message').fadeOut('fast')
        }, 4000);

        setTimeout(function() {
            $('#error-message').fadeOut('fast')
        }, 4000);
        
        
         // jQuery to format the input to two decimal places
    $(document).ready(function() {
        $('#amount').on('blur', function() {
            let value = parseFloat($(this).val()).toFixed(2);  // Format to 2 decimal places
            if (!isNaN(value)) {
                $(this).val(value);  // Set the formatted value
            } else {
                $(this).val('0.00');  // Default to 0.00 if the value is invalid
            }
        });
    });
    </script>
@endsection
