@extends('admin.main.main')

@section('admin-content')
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

<!--<a href="{{url('vendor-detail')}}" class="btn-submit  mt-4 " style="font-size: 12px; padding:8px 8px;">Vendor Detail</a>-->

<div class="container block mb-4 mt-3">
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
                                    <th scope="col">Vendor Name</th>
                                    <th scope="col">GST Number</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Subject/Document No</th>
                                    
                                     <th scope="col">Q-Mart</th>
                                     <th scope="col">Vendor</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($users as $item)
                                    <tr onclick="window.location='{{url('edit-vendor-registration-detail/'.$item->id)}}'" style="cursor:pointer;">
                                        <!--<td></td>-->
                                        <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d') }}</td>
                                        <td>{{ $item['vendor_name'] }}</td>
                                         <td>
                                            {{$item->gst_number}}
                                        </td>
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
                                            <!--@if ($item->status == 'Pending' && $item->description == 'Request Report')-->
                                            
                                            <!--<a href="{{url('admin-reply/'.$item->id)}}" class="btn-submit btn-pending"><b>{{$item->status}}</b></a>-->

                                            <!--@elseif($item->status == 'Replied' && $item->description == 'Request Report')-->

                                            <!--<a href="{{url('admin-reply/'.$item->id)}}" class="btn-submit btn-reply"><b>{{$item->status}}</a></b>-->

                                            <!--@elseif($item->status == 'Pending' && ($item->description == 'Vendor Registration' || $item->description == 'Sku Registration'))-->

                                            <!--<a href="" class="btn-submit btn-pending"  data-toggle="modal" data-target="#updateModal{{ $item->id }}"><b>{{ $item->status }}</b></a>-->

                                            <!--@elseif($item->status == 'Replied' && ($item->description == 'Vendor Registration' || $item->description == 'Sku Registration'))-->

                                            <!--<a href="" class="btn-submit btn-reply"     data-toggle="modal" data-target="#updateModal{{ $item->id }}"><b>{{ $item->status }}</b></a>-->
                                            <!--@endif-->
                                            
                                            <b>{{$item->status}}</b>

                                        </td>
                                    </tr>
                                @endforeach
                                @foreach ($skuRegistrations as $item)
                                    <tr onclick="window.location='{{url('edit-sku-registration-detail/'.$item->id)}}'" style="cursor:pointer;">
                                        <!--<td></td>-->
                                        <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d') }}</td>
                                        <td>{{ $item['vendor_name'] }}</td>
                                         <td>
                                            {{$item->gst_number}}
                                        </td>
                                        <td>
                                            {{ $item['description'] }}
                                        </td>
                                        <td> {{$item->product_name}}</td>
                                       
                                          <td>
                                            {{$item->approved_by}}
                                        </td>
                                        <td>
                                            {{$item->entered_by}}
                                        </td>
                                        <td>
                                        
                                            <!--@if ($item->status == 'Pending' && $item->description == 'Request Report')-->

                                            <!--<a href="{{url('admin-reply/'.$item->id)}}" class="btn-submit btn-pending"><b>{{$item->status}}</b></a>-->

                                            <!--@elseif($item->status == 'Replied' && $item->description == 'Request Report')-->

                                            <!--<a href="{{url('admin-reply/'.$item->id)}}" class="btn-submit btn-reply"><b>{{$item->status}}</a></b>-->

                                            <!--@elseif($item->status == 'Pending' && ($item->description == 'Vendor Registration' || $item->description == 'Sku Registration'))-->

                                            <!--<a href="" class="btn-submit btn-pending"  data-toggle="modal" data-target="#updateModal{{ $item->id }}"><b>{{ $item->status }}</b></a>-->

                                            <!--@elseif($item->status == 'Replied' && ($item->description == 'Vendor Registration' || $item->description == 'Sku Registration'))-->

                                            <!--<a href="" class="btn-submit btn-reply"     data-toggle="modal" data-target="#updateModal{{ $item->id }}"><b>{{ $item->status }}</b></a>-->
                                            <!--@endif-->
                                            <b>{{$item->status}}</b>

                                        </td>
                                    </tr>
                                @endforeach
                                @foreach ($requestReports as $item)
                                    <!--<tr onclick="window.location='{{url('edit-request-report/'.$item->id)}}'" style="cursor:pointer;">-->
                                    <tr onclick="window.location='{{url('admin-reply/'.$item->id)}}'" style="cursor:pointer;">
                                        <!--<td></td>-->
                                        <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d') }}</td>
                                        <td>{{ $item['vendor_name'] }}</td>
                                        
                                         <td>
                                            {{$item->gst_number}}
                                        </td>
                                        <td>
                                            {{ $item['description'] }}
                                        </td>
                                        <td>{{$item->subject}}</td>
                                     
                                          <td>
                                            {{$item->approved_by}}
                                        </td>
                                        <td>
                                            {{$item->entered_by}}
                                        </td>
                                        <td> 
                                           <b>{{$item->status}}</b>

                                            <!--@if ($item->status == 'Pending' && $item->description == 'Request Report')-->

                                            <!--<a href="{{url('admin-reply/'.$item->id)}}" style="text-decoration: none; color:black;"><b>{{$item->status}}</b></a>-->

                                            <!--@elseif($item->status == 'Approved' && $item->description == 'Request Report')-->

                                            <!--<a href="{{url('admin-reply/'.$item->id)}}" style="text-decoration: none; color:black;"><b>{{$item->status}}</a></b>-->

                                            <!--@elseif($item->status == 'Pending' && ($item->description == 'Vendor Registration' || $item->description == 'Sku Registration'))-->

                                            <!--<a href="" class="btn-submit btn-pending"  data-toggle="modal" data-target="#updateModal{{ $item->id }}" style="text-decoration: none; color:black;"><b>{{ $item->status }}</b></a>-->

                                            <!--@elseif($item->status == 'Approved' && ($item->description == 'Vendor Registration' || $item->description == 'Sku Registration'))-->

                                            <!--<a href="" class="btn-submit btn-reply" style="text-decoration: none; color:black;"    data-toggle="modal" data-target="#updateModal{{ $item->id }}"><b>{{ $item->status }}</b></a>-->
                                            <!--@endif-->

                                        </td>
                                    </tr>
                                @endforeach
                                @foreach ($innvoices as $item)
                                    <!--<tr onclick="window.location='{{url('edit-request-report/'.$item->id)}}'" style="cursor:pointer;">-->
                                    <tr onclick="window.location='{{url('edit-innvoice-message/'.$item->id)}}'" style="cursor:pointer;">
                                        <!--<td></td>-->
                                        <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d') }}</td>
                                        <td>{{ $item['vendor_name'] }}</td>
                                        
                                         <td>
                                            {{$item->gst_number}}
                                        </td>
                                        <td>
                                            {{ $item['description'] }}
                                        </td>
                                        <td>{{$item->admin_document ?? $item->vendor_document}}</td>
                                     
                                          <td>
                                            {{$item->approved_by}}
                                        </td>
                                        <td>
                                            {{$item->entered_by}}
                                        </td>
                                        <td> 
                                           <b>{{$item->status}}</b>

                                            <!--@if ($item->status == 'Pending' && $item->description == 'Request Report')-->

                                            <!--<a href="{{url('admin-reply/'.$item->id)}}" style="text-decoration: none; color:black;"><b>{{$item->status}}</b></a>-->

                                            <!--@elseif($item->status == 'Approved' && $item->description == 'Request Report')-->

                                            <!--<a href="{{url('admin-reply/'.$item->id)}}" style="text-decoration: none; color:black;"><b>{{$item->status}}</a></b>-->

                                            <!--@elseif($item->status == 'Pending' && ($item->description == 'Vendor Registration' || $item->description == 'Sku Registration'))-->

                                            <!--<a href="" class="btn-submit btn-pending"  data-toggle="modal" data-target="#updateModal{{ $item->id }}" style="text-decoration: none; color:black;"><b>{{ $item->status }}</b></a>-->

                                            <!--@elseif($item->status == 'Approved' && ($item->description == 'Vendor Registration' || $item->description == 'Sku Registration'))-->

                                            <!--<a href="" class="btn-submit btn-reply" style="text-decoration: none; color:black;"    data-toggle="modal" data-target="#updateModal{{ $item->id }}"><b>{{ $item->status }}</b></a>-->
                                            <!--@endif-->

                                        </td>
                                    </tr>
                                @endforeach
                                @foreach ($debits as $item)
                                    <!--<tr onclick="window.location='{{url('edit-request-report/'.$item->id)}}'" style="cursor:pointer;">-->
                                    <tr onclick="window.location='{{url('edit-debit-credit-message/'.$item->id)}}'" style="cursor:pointer;">
                                        <!--<td></td>-->
                                        <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d') }}</td>
                                        <td>{{ $item['vendor_name'] }}</td>
                                        
                                         <td>
                                            {{$item->gst_number}}
                                        </td>
                                        <td>
                                            {{ $item['description'] }}
                                        </td>
                                        <td>{{$item->admin_document ?? $item->vendor_document}}</td>
                                     
                                          <td>
                                            {{$item->approved_by}}
                                        </td>
                                        <td>
                                            {{$item->entered_by}}
                                        </td>
                                        <td> 
                                           <b>{{$item->status}}</b>

                                            <!--@if ($item->status == 'Pending' && $item->description == 'Request Report')-->

                                            <!--<a href="{{url('admin-reply/'.$item->id)}}" style="text-decoration: none; color:black;"><b>{{$item->status}}</b></a>-->

                                            <!--@elseif($item->status == 'Approved' && $item->description == 'Request Report')-->

                                            <!--<a href="{{url('admin-reply/'.$item->id)}}" style="text-decoration: none; color:black;"><b>{{$item->status}}</a></b>-->

                                            <!--@elseif($item->status == 'Pending' && ($item->description == 'Vendor Registration' || $item->description == 'Sku Registration'))-->

                                            <!--<a href="" class="btn-submit btn-pending"  data-toggle="modal" data-target="#updateModal{{ $item->id }}" style="text-decoration: none; color:black;"><b>{{ $item->status }}</b></a>-->

                                            <!--@elseif($item->status == 'Approved' && ($item->description == 'Vendor Registration' || $item->description == 'Sku Registration'))-->

                                            <!--<a href="" class="btn-submit btn-reply" style="text-decoration: none; color:black;"    data-toggle="modal" data-target="#updateModal{{ $item->id }}"><b>{{ $item->status }}</b></a>-->
                                            <!--@endif-->

                                        </td>
                                    </tr>
                                @endforeach
                                @foreach ($payments as $item)
                                    <!--<tr onclick="window.location='{{url('edit-request-report/'.$item->id)}}'" style="cursor:pointer;">-->
                                    <tr onclick="window.location='{{url('edit-payment-follow-message/'.$item->id)}}'" style="cursor:pointer;">
                                        <!--<td></td>-->
                                        <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d') }}</td>
                                        <td>{{ $item['vendor_name'] }}</td>
                                        
                                         <td>
                                            {{$item->gst_number}}
                                        </td>
                                        <td>
                                            {{ $item['description'] }}
                                        </td>
                                        <td>{{$item->subject}}</td>
                                     
                                          <td>
                                            {{$item->approved_by}}
                                        </td>
                                        <td>
                                            {{$item->entered_by}}
                                        </td>
                                        <td> 
                                           <b>{{$item->status}}</b>

                                            <!--@if ($item->status == 'Pending' && $item->description == 'Request Report')-->

                                            <!--<a href="{{url('admin-reply/'.$item->id)}}" style="text-decoration: none; color:black;"><b>{{$item->status}}</b></a>-->

                                            <!--@elseif($item->status == 'Approved' && $item->description == 'Request Report')-->

                                            <!--<a href="{{url('admin-reply/'.$item->id)}}" style="text-decoration: none; color:black;"><b>{{$item->status}}</a></b>-->

                                            <!--@elseif($item->status == 'Pending' && ($item->description == 'Vendor Registration' || $item->description == 'Sku Registration'))-->

                                            <!--<a href="" class="btn-submit btn-pending"  data-toggle="modal" data-target="#updateModal{{ $item->id }}" style="text-decoration: none; color:black;"><b>{{ $item->status }}</b></a>-->

                                            <!--@elseif($item->status == 'Approved' && ($item->description == 'Vendor Registration' || $item->description == 'Sku Registration'))-->

                                            <!--<a href="" class="btn-submit btn-reply" style="text-decoration: none; color:black;"    data-toggle="modal" data-target="#updateModal{{ $item->id }}"><b>{{ $item->status }}</b></a>-->
                                            <!--@endif-->

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

@foreach ($users as $item)
    <div class="modal fade" id="updateModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Vendor Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('update-sku-registration-status') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sku_status" id="pendingRadio" value="Pending" {{ $item->status == 'Pending' ? 'checked' : '' }}>
                            <label class="form-check-label" for="pendingRadio">Pending</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sku_status" id="repliedRadio" value="Replied" {{ $item->status == 'Replied' ? 'checked' : '' }}>
                            <label class="form-check-label" for="repliedRadio">Approved</label>
                        </div>
                        
                        <button type="submit" class="btn-submit mt-3">Update</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
@endforeach

@foreach ($skuRegistrations as $item)
    <div class="modal fade" id="updateModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Vendor Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('update-sku-registration-status') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sku_status" id="pendingRadio" value="Pending" {{ $item->status == 'Pending' ? 'checked' : '' }}>
                            <label class="form-check-label" for="pendingRadio">Pending</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sku_status" id="repliedRadio" value="Replied" {{ $item->status == 'Replied' ? 'checked' : '' }}>
                            <label class="form-check-label" for="repliedRadio">Approved</label>
                        </div>
                        
                        <button type="submit" class="btn-submit mt-3">Update</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
@endforeach

<!--@foreach ($requestReports as $item)-->
<!--    <div class="modal fade" id="updateModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<!--        <div class="modal-dialog" role="document">-->
<!--            <div class="modal-content">-->
<!--                <div class="modal-header">-->
<!--                    <h5 class="modal-title" id="exampleModalLabel">Update Vendor Status</h5>-->
<!--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                        <span aria-hidden="true">&times;</span>-->
<!--                    </button>-->
<!--                </div>-->
<!--                <div class="modal-body">-->
<!--                    <form action="{{ url('update-sku-registration-status') }}" method="POST">-->
<!--                        @csrf-->
<!--                        <input type="hidden" name="id" value="{{ $item->id }}">-->
                        
<!--                        <div class="form-check">-->
<!--                            <input class="form-check-input" type="radio" name="sku_status" id="pendingRadio" value="Pending" {{ $item->status == 'Pending' ? 'checked' : '' }}>-->
<!--                            <label class="form-check-label" for="pendingRadio">Pending</label>-->
<!--                        </div>-->
                        
<!--                        <div class="form-check">-->
<!--                            <input class="form-check-input" type="radio" name="sku_status" id="repliedRadio" value="Replied" {{ $item->status == 'Replied' ? 'checked' : '' }}>-->
<!--                            <label class="form-check-label" for="repliedRadio">Approved</label>-->
<!--                        </div>-->
                        
<!--                        <button type="submit" class="btn-submit mt-3">Update</button>-->
<!--                    </form>-->
<!--                </div>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--@endforeach-->

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
