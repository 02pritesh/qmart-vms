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

    <!--<h3 class="text-center" style="color:#000; font-family: Silka-Black;"><b>Update User Registration</b></h3>-->
    <a href="{{url('user-dashboard')}}" class="btn-submit ml-3" style="text-decoration: none; padding:4px 14px;"><i class="fa-solid fa-left-long"></i></a>
    <div class="container block mt-4 mb-4">
      <form action="{{url('update-user-registration')}}" method="POST">
        @csrf
        <div class="row">
          <input type="hidden" name="id" value="{{$data->id}}">
          <div class="col-6">
            <div class="form-group">
              <label for="username"><b>Vendor Entity Name</b></label>
              <input type="text" id="name" name="vendor_name" value="{{$data->vendor_name}}" class="form-control" >
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="gstin"><b>GSTIN</b></label>
              <input type="text" id="gstin" name="gstin" value="{{$data->gstin}}" class="form-control" maxlength="15">
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="username"><b>Contact Person</b></label>
              <input type="text" id="contact_person" name="contact_person" value="{{$data->contact_person}}" class="form-control">
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="username"><b>Phone Number</b></label>
              <input type="text" id="phone_number" name="phone_number" value="{{$data->phone_number}}" class="form-control">
            </div>
          </div>
          <!--<div class="col-6">-->
          <!--  <div class="form-group">-->
          <!--    <label for="username"><b>Email ID</b></label>-->
          <!--    <input type="email" id="email" name="email" value="{{$data->email}}" class="form-control">-->
          <!--  </div>-->
          <!--</div>-->
          <div class="col-6">
            <div class="form-group">
              <label for="username"><b>Brands Supplied</b></label>
              <input type="text" id="brands" name="brands" value="{{$data->brands}}" class="form-control">
            </div>
          </div>
        </div>
 
        <button type="submit" class="btn-submit mr-3 mb-3">Update</button>
      </form>
    </div>

    <script>
      // Success and error message timeout
      setTimeout(function() {
                $('#success-message').fadeOut('fast');
            }, 4000);
    
            setTimeout(function() {
                $('#error-message').fadeOut('fast');
            }, 4000);
    </script>
@endsection
