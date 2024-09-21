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
        .btn-reply{
            border: 1px solid #4caf50;
            color: #4caf50;
        }
        .btn-reply:hover{
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
    
      @if(session('error'))
        <div class="alert alert-danger" id="error-message">
            {{ session('error') }}
        </div>
    @endif
      <a href="{{url('request-report-detail')}}" class="btn-submit ml-3" style="text-decoration: none; padding:4px 14px;"><i class="fa-solid fa-left-long"></i></a>
    <!--<h3 class="text-center" style="color:#000;font-family: Silka-Black;"><b>Request Monthly Sales Report/Statement</b></h3>-->
 <form action="{{ url('admin-reply') }}" method="POST" enctype="multipart/form-data">
      @csrf
    <div class="container block mt-4 mb-4">

       
           
             <input type="hidden" name="id" value="{{ $messages->id }}">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <p></p>
                        <!--<h6>Vendor Entity Name</h6>-->
                        <label for=""><b>Vendor Entity Name</b></label>
                        <input type="hidden" name="id" value="{{ $messages->id }}">
    
                        <input type="text" class="form-control" id="entityName" value="{{ $messages->vendor_name }}"
                            name="vendor_name" >
    
                    </div>
                </div>
                
                 <div class="col-6">
                    <div class="form-group">
                        <label for="" class="mt-3"><b>Subject</b></label>
                        <input type="text" class="form-control" id="entityName" name="subject"
                             value="{{ $messages->subject }}">
                        @error('subject')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <!--<h6>Message (maximum: 300 words)</h6>-->
                    <label for=""><b>Message (maximum: 300 words)</b></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="vendor_message"
                        placeholder="Write Your Message" >{{ old('vendor_message', $messages->vendor_message) }}</textarea>
                    @error('vendor_message')
                        <span style="color: red; font-size: 18px">{{ $message }}</span>
                    @enderror
                </div>

               <div class="form-group col-md-12">
                    <label for=""><b>File (only PDF, Excel, JPG, PNG, Zip)</b></label><br>
                    <input type="file" name="vendor_file" class="form-control" id="vendorFileInput">
                   
                    @if ($messages->vendor_file)
                      <input type="hidden" name="existing_vendor_file" value="{{ $messages->vendor_file }}">
                        @if (in_array(pathinfo($messages->vendor_file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'pdf','doc','txt','bmp','xlsx','xls','csv','zip']))
                            <!-- Display image if file is an image -->
                            <!--<input type="file" name="vendor_file" class="form-control" id="vendorFileInput">-->
                            
                             @if (in_array(pathinfo($messages->vendor_file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png','bmp']))
                            
                                <div id="vendorImagePreview">
                                    <a href="{{ asset('public/assets/upload/' . $messages->vendor_file) }}" download>
                                        <img src="{{ asset('public/assets/upload/' . $messages->vendor_file) }}" alt="Uploaded File" style="max-width: 8%; height: auto;">
                                    </a>
                                    <!--<input type="hidden" name="existing_vendor_file" value="{{ $messages->vendor_file }}">-->
                                </div>
                                
                            @elseif(in_array(pathinfo($messages->vendor_file, PATHINFO_EXTENSION), ['pdf','docx','doc','txt','xlsx','xls','zip']))
                        
                                <div class="form-group">
                                    <a href="{{ asset('public/assets/upload/' . $messages->vendor_file) }}" class="btn-submit" style="text-decoration:none;" download>Download File</a>
                                </div>
                            @endif
                        
                        @endif
                    @else
                         <p>No file uploaded.</p>
                    @endif
                    
                    @error('vendor_file')
                        <span style="color: red; font-size: 18px">{{ $message }}</span>
                    @enderror
                    
                
                    <!-- Container to show the selected image -->
                    <div id="newVendorImagePreview"></div>
                </div>  
                                
             

            </div>
            <!--<button type="submit" class="btn-submit btn-report mr-3 mb-3">Submit</button>-->
            <!--<button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button>-->
        <!--</form>-->
    </div>


    <h3 class="text-center" style="color:#000;font-family: Silka-Black;"><b>Q-Mart Reply</b></h3>

    <div class="container block mt-4 mb-4">

        <!--<form action="{{ url('admin-reply') }}" method="POST" enctype="multipart/form-data">-->
            
            <div class="row">
                <!--<div class="form-group">-->
                <!--    <p></p>-->
                <!--    <h6>Vendor Entity Name</h6>-->

                <!--    <input type="hidden" name="id" value="{{ $messages->id }}">-->

                <!--    <input type="text" class="form-control" id="entityName" value="{{ Session::get('vendor_name') }}"-->
                <!--        name="vendor_name" readonly>-->

                <!--</div>-->
                 <!--<input type="hidden" name="id" value="{{ $messages->id }}">-->
    
                <div class="form-group pt-3">
                    <!--<h6>Message (maximum: 300 words)</h6>-->
                    <label for=""><b>Message (maximum: 300 words)</b></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="admin_message"
                        placeholder="Write Your Message">{{ old('admin_message', $messages->admin_message) }}</textarea>
                  
                </div>
                
                <div class="form-group">
                    <label for=""><b>File (only PDF, Excel, JPG, PNG, and Zip)</b></label>
                    <input type="file" class="form-control" id="adminFileInput" name="admin_file">
                    
                    @if ($messages->admin_file)
                    <input type="hidden" name="existing_admin_file" value="{{ $messages->admin_file }}">
                        @if (in_array(pathinfo($messages->admin_file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'pdf','doc','txt','bmp','xlsx','xls','csv','zip']))
                            <!-- Display image if file is an image -->
                            
                            @if (in_array(pathinfo($messages->admin_file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png','bmp']))
                                <div id="adminImagePreview">
                                    <a href="{{ asset('public/assets/upload/' . $messages->admin_file) }}" download>
                                        <img src="{{ asset('public/assets/upload/' . $messages->admin_file) }}" alt="Uploaded File" style="max-width: 8%; height: auto;">
                                    </a>
                                   
                                </div>
                                
                            @elseif(in_array(pathinfo($messages->admin_file, PATHINFO_EXTENSION),['pdf','docx','doc','txt','xlsx','xls','zip']))
                        
                                <!-- Display file if it is not an image -->
                                <a href="{{ asset('public/assets/upload/' . $messages->admin_file) }}" class="btn-submit mt-3" style="text-decoration:none; font-size:12px;" target="_blank" download>View Uploaded File</a>
                            @endif
                            
                            
                        @endif
                    @else
                        <p>No file uploaded.</p>
                    @endif
                    
                    @error('admin_file')
                        <span style="color: red; font-size: 18px">{{ $message }}</span>
                    @enderror
                
                    <!-- Container to show the selected image -->
                    <div id="newImagePreview"></div>
                </div>

                
                  <div class="col-6">
                    <div class="form-group">
                        <label for="" class="mt-3"><b>Replied By</b></label>
                        <input type="text" class="form-control" id="entityName" name="approved_by" value="{{session()->get('admin_name')}}"  readonly>
                       
                    </div>
                </div>

            </div>
            @if($messages->status == 'Pending')
                <button type="submit" class="btn-submit btn-report mr-3 mb-3">Submit</button>
                {{-- <button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button> --}}
            @elseif($messages->status == 'Replied' && session()->get('adminloginId') == 1)
                 <button type="submit" class="btn-submit btn-report mr-3 mb-3">Submit</button>
                {{-- <button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button> --}}
            @endif
       
    </div>
 </form>
    <script>    
        setTimeout(function() {
            $('#success-message').fadeOut('fast')
        }, 4000);

        setTimeout(function() {
            $('#error-message').fadeOut('fast')
        }, 4000);
        
        
         document.getElementById('adminFileInput').addEventListener('change', function(event) {
        var imagePreview = document.getElementById('adminImagePreview');
        var newImagePreview = document.getElementById('newImagePreview');

        // Remove existing image preview
        if (imagePreview) {
            imagePreview.style.display = 'none';
        }

        // Display the newly selected image
        var file = event.target.files[0];
        if (file && file.type.match('image.*')) {
            var reader = new FileReader();
            reader.onload = function(e) {
                newImagePreview.innerHTML = '<img src="' + e.target.result + '" alt="New Image" style="max-width: 8%; height: auto;">';
            };
            reader.readAsDataURL(file);
        } else {
            newImagePreview.innerHTML = ''; // Clear the preview if the selected file is not an image
        }
    });
    
    
    document.getElementById('vendorFileInput').addEventListener('change', function(event) {
        var vendorImagePreview = document.getElementById('vendorImagePreview');
        var newVendorImagePreview = document.getElementById('newVendorImagePreview');

        // Remove existing image preview
        if (vendorImagePreview) {
            vendorImagePreview.style.display = 'none';
        }

        // Display the newly selected image
        var file = event.target.files[0];
        if (file && file.type.match('image.*')) {
            var reader = new FileReader();
            reader.onload = function(e) {
                newVendorImagePreview.innerHTML = '<img src="' + e.target.result + '" alt="New Image" style="max-width: 8%; height: auto;">';
            };
            reader.readAsDataURL(file);
        } else {
            newVendorImagePreview.innerHTML = ''; // Clear the preview if the selected file is not an image
        }
    });
    
    
    </script>
@endsection
