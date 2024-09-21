@extends('admin.main.main')

@section('admin-content')
<style>
    .btn-submit {
        letter-spacing: 1px;
        font-weight: 400;
        border: 1px solid #f38f21;
        color: #f38f21;
        margin: 0px;
        padding: 12px 12px;
        border-radius: 9px;
        vertical-align: top;
        display: inline-block;
        background: transparent;
        text-transform: uppercase;
        text-decoration: none;
        font-family: 'Silka-SemiBold';
        transition: all 0.3s ease;
        font-size:14px;
    }

    .btn-submit:hover {
        background-color: #f38f21;
        color: #fff !important;
        text-decoration: none;
    }

    .btn-approved {
        border: 1px solid #4caf50;
        /* Green border */
        color: #4caf50;
        /* Green text */
    }

    .btn-approved:hover {
        background-color: #4caf50;
        /* Green background on hover */
        color: #fff !important;
        /* White text on hover */
    }

    .btn-pending {
        border: 1px solid #f44336;
        /* Red border */
        color: #f44336;
        /* Red text */
    }

    .btn-pending:hover {
        background-color: #f44336;
        /* Red background on hover */
        color: #fff !important;
    }
    .block {
            box-shadow: 0px 0px 10px rgb(171, 161, 161);
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

  <a href="{{url('dashboard')}}" class="btn-submit ml-3" style="text-decoration: none; padding:4px 14px;"><i class="fa-solid fa-left-long"></i></a>
  
    <div class="container block mb-4 mt-3">

        <form action="{{url('add-sub-admin')}}" method="POST">
            @csrf
          <div class="form-group pt-3">
            <label for="exampleInputEmail1"><b>SubAdmin Name</b></label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Sub-Admin Name" name="name">
            @error('name')
                 <span style="color: red">{{ $message }}</span>
            @enderror
          </div>
         
          <div class="form-group">
            <label for="exampleInputEmail1"><b>Email</b></label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Sub-Admin Email" name="email">
             @error('email')
                 <span style="color: red">{{ $message }}</span>
            @enderror
       
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1"><b>Password</b></label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Sub-Admin Password" name="password">
            @error('password')
                <span style="color: red">{{ $message }}</span>
            @enderror
          </div>
         
          <button type="submit" class="btn-submit mb-4" style="padding:8px 12px;">Submit</button>
        </form>
    </div>



       <div class="container mb-4 mt-3">

        <!--<h4 class="ml-3 pt-3 text-center" style="color:#000; font-family:Silka-Black; letter-spacing:1px">-->
        <!--    <b>Registration Detail</b></h4>-->
        <div class="row mt-4" >
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title">Project Module Details</h4> --}}
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Sub-Admin Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                   @foreach ($data as $item)
                                   <tr>
                                       <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d') }}</td>
                                       <td>{{ $item['vendor_name'] }}</td>
                                       <td>{{ $item['email'] }}</td>
                                       <td >
                                           @if ($item->status == 'Active')
                                               <a href="" class="btn-submit btn-approved" data-toggle="modal" data-target="#updateModal{{ $item->id }}">
                                                   <b>{{ $item->status }}</b>
                                               </a>
                                           @elseif($item->status == 'De-Active')
                                               <a href="" class="btn-submit btn-pending" data-toggle="modal" data-target="#updateModal{{ $item->id }}">
                                                   <b>{{ $item->status }}</b>
                                               </a>
                                           @endif
                                       </td>
                                   </tr>
                                   @endforeach
                                   
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    @foreach($data as $item)
    <div class="modal fade" id="updateModal{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Vendor Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="update-vendor-status" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vendor_status" id="inlineRadio1"
                                value="De-Active" {{ $item->status == 'De-Active' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio1">De-Active</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vendor_status" id="inlineRadio2"
                                value="Active" {{ $item->status == 'Active' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio2">Active</label>
                        </div>

                        <button type="submit" class="btn-submit mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="/DataTables/datatables.js"></script>

<script>
     setTimeout(function() {
              $('#success-message').fadeOut('fast')
          }, 4000);

          setTimeout(function() {
              $('#error-message').fadeOut('fast')
          }, 4000);
          
          


</script>


@endsection
