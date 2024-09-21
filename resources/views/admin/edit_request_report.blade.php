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

    <!--<h3 class="text-center" style="color:#000;font-family: Silka-Black;"><b>Edit Request Monthly Sales Report/Statement</b></h3>-->
    
        <a href="{{url('dashboard')}}" class="btn-submit ml-3" style="text-decoration: none; padding:4px 14px;"><i class="fa-solid fa-left-long"></i></a>
        
    <div class="container block mt-4 mb-4">

        <form action="{{ url('edit-request-report') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <p></p>
                        <h6>Vendor Entity Name</h6>
    
                        <input type="hidden" name="id" value="{{ $messages->id }}">
    
                        <input type="text" class="form-control" id="entityName" value="{{ $messages->vendor_name }}"
                            name="vendor_name">
    
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
                    <h6>Message (maximum: 300 words)</h6>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="vendor_message"
                        placeholder="Write Your Message">{{ old('vendor_message', $messages->vendor_message) }}</textarea>
                    @error('vendor_message')
                        <span style="color: red; font-size: 18px">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">  
                
                <label for="cancelledCheque"><b>File</b></label>
                <!-- File input for a new file upload -->
                <input type="file" class="form-control" id="cancelledCheque" name="vendor_file">
                
                <!-- Hidden input to retain the existing file if no new file is uploaded -->
                <input type="hidden" name="exists_vendor_file" value="{{ $messages->vendor_file }}">
                
                <!-- Display the existing image -->
                <img src="{{ asset('public/assets/upload/' . $messages->vendor_file) }}" alt="Uploaded File" style="max-width: 8%; height: auto;">
                
        
                    <!--<label for="" ><b>File</b></label><br>       -->
                    <!--@if ($messages->vendor_file)-->
                    <!--    @if (in_array(pathinfo($messages->vendor_file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))-->
                            <!-- Display image if file is an image -->
                    <!--        <input type="file" class="form-control" id="entityName" name="exists_vendor_file" value="{{$messages->vendor_file}}">-->
                    <!--        <img src="{{ asset('public/assets/upload/' . $messages->vendor_file) }}" alt="Uploaded File" style="max-width: 8%; height: auto;">-->
                    <!--    @else-->
                            <!-- Display file if it is not an image -->
                    <!--        <input type="file" class="form-control" id="entityName" name="vendor_file">-->
                    <!--        <a href="{{ asset('public/assets/upload/' . $messages->vendor_file) }}" target="_blank" download>View Uploaded File</a>-->
                    <!--    @endif-->
                    <!--@else-->
                    <!--    <p>No file uploaded.</p>-->
                    <!--@endif-->
                </div>   

            </div>
            <button type="submit" class="btn-submit btn-report mr-3 mb-3">Report</button>
            {{-- <button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button> --}}
        </form>
    </div>


    <!--<h3 class="text-center" style="color:#000;font-family: Silka-Black;"><b>Q-Mart Reply</b></h3>-->

    <!--<div class="container block mt-4 mb-4">-->

    <!--    <form action="{{ url('admin-reply') }}" method="POST" enctype="multipart/form-data">-->
    <!--        @csrf-->
    <!--        <div class="row">-->
                <!--<div class="form-group">-->
                <!--    <p></p>-->
                <!--    <h6>Vendor Entity Name</h6>-->

                <!--    <input type="hidden" name="id" value="{{ $messages->id }}">-->

                <!--    <input type="text" class="form-control" id="entityName" value="{{ Session::get('vendor_name') }}"-->
                <!--        name="vendor_name" readonly>-->

                <!--</div>-->

    <!--            <div class="form-group pt-3">-->
    <!--                <h6>Message (maximum: 300 words)</h6>-->
    <!--                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="admin_message"-->
    <!--                    placeholder="Write Your Message">{{ old('admin_message', $messages->admin_message) }}</textarea>-->
    <!--                @error('admin_message')-->
    <!--                    <span style="color: red; font-size: 18px">{{ $message }}</span>-->
    <!--                @enderror-->
    <!--            </div>-->

    <!--            <div class="form-group">-->
    <!--                <h6>File</h6>-->

    <!--                <input type="file" class="form-control" id="entityName" name="admin_file">-->
    <!--                @error('admin_file')-->
    <!--                    <span style="color: red; font-size:18px">{{ $message }}</span>-->
    <!--                @enderror-->
    <!--            </div>-->

    <!--        </div>-->
    <!--        <button type="submit" class="btn-submit btn-report mr-3 mb-3">Submit</button>-->
    <!--        <button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button>-->
    <!--    </form>-->
    <!--</div>-->

    <script>
        setTimeout(function() {
            $('#success-message').fadeOut('fast')
        }, 4000);

        setTimeout(function() {
            $('#error-message').fadeOut('fast')
        }, 4000);
    </script>
@endsection
