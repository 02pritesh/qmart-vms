@extends('user.main.main')

@section('user-content')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="/DataTables/datatables.css" />

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
    }
    

    .btn-submit:hover {
        background-color: #f38f21;
        color: #fff !important;
        text-decoration: none;
    }

    .btn-reply {
        border: 1px solid #4caf50;
        /* Green border */
        color: #4caf50;
        /* Green text */
    }

    .btn-reply:hover {
        background-color: #4caf50;
        /* Green background on hover */
        color: #fff !important;
        /* White text on hover */
    }

    .btn-pending {
        border: 1px solid #f44336;
        /* Red border */
        color: #f44336;
        
    }

    .btn-pending:hover {
        background-color: #f44336;
        /* Red background on hover */
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
<a href="{{url('user-dashboard')}}" class="btn-submit ml-3" style="text-decoration: none; padding:4px 14px;"><i class="fa-solid fa-left-long"></i></a>

<!--<a href="{{url('vendor-detail')}}" class="btn-submit  mt-4 " style="font-size: 12px; padding:8px 8px;">Vendor Detail</a>-->

<div class="mb-4 mt-3">
    <!--<h4 class="ml-3 pt-3 text-center" style="color:#000; font-family:Silka-Black; letter-spacing:1px">-->
    <!--    <b>Vendor Registrations</b>-->
    <!--</h4>-->
    <div class="row mt-4" id="my Table">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <!--<th scope="col"></th>-->
                                    <th scope="col">Date</th>
                                    <!--<th scope="col">Vendor Name</th>-->
                                    <th scope="col">Type</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Q-Mart</th>
                                    <th scope="col">Vendor</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($messages as $item)
                                    <tr onclick="window.location='{{ url('vendor-show-message/'.$item->id) }}'" style="cursor:pointer;">
                                        <!--<td></td>-->
                                        <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d') }}</td>
                                        <!--<td>{{ $item['vendor_name'] }}</td>-->
                                        <td>
                                            {{ $item['description'] }}
                                        </td>
                                        <td>
                                            {{$item->subject}}
                                        </td>
                                        <td>
                                            {{$item->approved_by}}
                                        </td>
                                        <td>
                                            {{$item->entered_by}}
                                        </td>
                                        <td>
                                            <b>{{$item->status}}</b>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="/DataTables/datatables.js"></script>

<script>
    setTimeout(function() {
        $('#success-message').fadeOut('fast');
    }, 4000);

    setTimeout(function() {
        $('#error-message').fadeOut('fast');
    }, 4000);


</script>

@endsection
