@extends('user.main.main')

@section('user-content')

  <style>
        .btn-view {
            letter-spacing: 1px;
            font-weight: 400;
            border: 1px solid #f38f21;
            color: #f38f21;
            margin: 0px;
            padding: 14px 14px;
            border-radius: 9px;
            vertical-align: top;
            display: inline-block;
            background: transparent;
            text-transform: uppercase;
            text-decoration: none;
            font-family: 'Silka-SemiBold';
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            background-color: #f38f21;
            color: #fff !important;
            text-decoration: none;
        }

        .btn-submit {
            letter-spacing: 1px;
            font-weight: 400;
            border: 1px solid #f38f21;
            color: #f38f21;
            margin: 0px;
            padding: 8px 10px;
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

        .btn-edit {
            border: 1px solid #4caf50;
            /* Green border */
            color: #4caf50;
            /* Green text */
        }

        .btn-edit:hover {
            background-color: #4caf50;
            /* Green background on hover */
            color: #fff !important;
            /* White text on hover */
        }

        .btn-remove {
            border: 1px solid #f44336;
            /* Red border */
            color: #f44336;
            /* Red text */
        }

        .btn-remove:hover {
            background-color: #f44336;
            /* Red background on hover */
            color: #fff !important;
        }
    </style>

  @if (Session::has('success'))
  <div class="alert alert-success" role="alert" id="success-message">
      {{Session::get('success')}}
  </div>
  @endif

  @if(session('fail'))        
    <div class="alert alert-danger" id="error-message">
        {{session('fail')}}
    </div>          
  @endif
  
    @if(session('error'))
        <div class="alert alert-danger" id="error-message">
            {{ session('error') }}
        </div>
    @endif


 <a href="{{url('show-sku-registration')}}" class="btn-submit btn-edit ml-3" style="text-decoration: none;">Back</a>

    <div class="mb-4 mt-3">
        <!--<h4 class="ml-3 pt-3 text-center" style="color:#000; font-family:Silka-SemiBold; letter-spacing:1px">-->
        <!--    <b>SKU Registrations List</b>-->
        <!--</h4>-->
        <div class="row mt-4" >
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" style="border-collapse: collapse; width: 100%;" id="myTable">
                                <thead>
                                    <tr>
                                        <!--<th scope="col">S.No.</th>-->
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">RTV</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Case Qty</th>
                                        <th scope="col">EAN Code</th>
                                        <th scope="col">Shelf Life</th>
                                        <th scope="col">HSN Code</th>
                                        <th scope="col">Gst Percentage</th>
                                        <th scope="col">Margin Percentage</th>
                                        <th scope="col">MRP</th>
                                        <th scope="col">Margin</th>
                                        <th scope="col">Landing Price</th>
                                        <th scope="col">Gst Price</th>
                                        <th scope="col">Basic Cost</th>
                                        <th scope="col">Sku Remark</th>
                                        <th scope="col">Status</th>
                                        {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($skuProducts as $item)
                                        <tr>
                                            <!--<td>{{ $i++ }}</td>-->
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item->category }}</td>
                                            <td>{{ $item->rtv }}</td>
                                            <td>{{ $item->unit }}</td>
                                            <td>{{ $item->case_qty }}</td>
                                            <td>{{ $item->EAN_Code }}</td>
                                            <td>{{ $item->shelf_life }}</td>
                                            <td>{{ $item->HSN_Code }}</td>
                                            <td>{{ $item->gst_percentage }}</td>
                                            <td>{{ $item->margin_percentage }}</td>
                                            <td>{{ $item->mrp }}</td>                  
                                            <td>{{ $item->margin }}</td>
                                            <td>{{ $item->landing_price }}</td>
                                            <td>{{ $item->gst_price }}</td>
                                            <td>{{ $item->basic_cost }}</td>
                                            <td>{{ $item->sku_remark }}</td>  
                                            <td>
                                                @if ($sku->status == 'Pending')
                                                    <b>{{$sku->status}}</b>
                                                @elseif($sku->status == 'Approved')
                                                    <b>{{$sku->status}}</b>
                                                @endif
                                            </td>
                                            {{-- <td>
                                                <a href="{{ url('delete-sku-vendor-entity-detail/' . $item->id) }}" class="btn-submit btn-remove" onclick="return confirmDelete()">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                            </td> --}}
                                            
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


<script>
   setTimeout(function() {
        $('#success-message').fadeOut('fast')
    },4000);

    setTimeout(function() {
        $('#error-message').fadeOut('fast')
    },4000);
</script>
@endsection