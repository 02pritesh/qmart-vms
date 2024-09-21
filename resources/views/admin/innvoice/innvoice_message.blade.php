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

    <h3 class="text-center" style="color:#000;font-family: Silka-Black;"><b>Q-Mart Message</b></h3>
    <div class="container block mt-4 mb-4">
       
        <form action="{{ url('innvoice-message') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="hidden" name="name" value="{{$admin->vendor_name}}">
                
                <div class="col-6">
                    <div class="form-group">
                        <label for="" class="mt-3"><b>Subject (upto 60 character)</b></label>
                        <input type="text" class="form-control" id="entityName" name="subject"
                        value="{{old('subject')}}">
                        @error('subject')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-3">
                  <div class="form-group">
                      <label for="inputState" class="mt-3"><b>Vendor Name</b></label>
                      <select id="inputState" class="form-control" name="id">
                          <option selected>Choose Name</option>
                          @foreach ($details as $item)
                              <option value="{{$item->id}}">{{ $item->vendor_name }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
                
                <div class="col-3">
                    <div class="form-group">
                        <label for="gstin" class="mt-3"><b>GSTIN Number</b></label>
                        <input type="text" id="gstin"  name="gst_number" class="form-control" readonly>
                    </div>
                </div>
              

                <div class="form-group">
                    <!--<h6>Message (maximum: 300 words)</h6>-->
                    <label for=""><b>Message (maximum: 300 words)</b></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="admin_message"
                        placeholder="Write Your Message">{{old('admin_message')}}</textarea>
                    @error('admin_message')
                        <span style="color: red; font-size: 18px">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">  
                    <label for="" ><b>File  (only PDF, Excel, JPG, PNG, Zip)</b></label><br>       
                   <input type="file" class="form-control" id="entityName" name="admin_file">
                    @error('admin_file')
                        <span style="color: red; font-size:18px">{{ $message }}</span>
                    @enderror
                </div>   

            </div>
            <button type="submit" class="btn-submit btn-report mr-3 mb-3">Submit</button>
            <button type="reset" class="btn-submit btn-reset btn-danger mb-3">Reset</button>
        </form>
    </div>


    {{-- <h3 class="text-center" style="color:#000;font-family: Silka-Black;"><b>Q-Mart Reply</b></h3> --}}

    <div class="container block mt-4 mb-4">

        
            <div class="row">
     

                <div class="form-group pt-3">
                    <!--<h6>Message (maximum: 300 words)</h6>-->
                    <label for=""><b>Message (maximum: 300 words)</b></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="vendor_message"
                        placeholder="Write Your Message" readonly></textarea>
                   
                </div>

                <div class="form-group">
                     <label for=""><b>File (only PDF, Excel, JPG, PNG, Zip)</b></label>
                    <!--<h6>File (only PDF, Excel, JPG, PNG, Zip)</h6>-->

                    <input type="file" class="form-control" id="entityName" name="vendor_file">
                
                </div>

            </div>
           
        </form>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    


    <script>
        setTimeout(function() {
            $('#success-message').fadeOut('fast')
        }, 4000);

        setTimeout(function() {
            $('#error-message').fadeOut('fast')
        }, 4000);



        $(document).ready(function() {
    $('#inputState').on('change', function() {
        var vendorId = $(this).val();
        console.log('Vendor ID selected:', vendorId); // Debugging
        if (vendorId) {
            $.ajax({
                url: '/get-gstin', 
                type: 'GET',
                data: { id: vendorId },
                success: function(response) {
                    console.log('AJAX Success:', response); // Debugging

                    if (response.gstin) {
                        $('#gstin').val(response.gstin); // Set GSTIN in the input
                    } else {
                        $('#gstin').val('GSTIN not found'); // If GSTIN not found
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', error); // Log the error for debugging
                }
            });
        } else {
            $('#gstin').val(''); // Clear GSTIN input if no vendor is selected
        }
    });
});


    </script>
@endsection
