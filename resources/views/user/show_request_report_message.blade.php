@extends('user.main.main')

@section('user-content')
    <style>
        .btn-submit{
            letter-spacing: 1px;
            font-weight: 400;
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
            font-size:14px;
        }
        .btn-submit:hover{
          text-decoration: none;
        }
        .btn-reply{
            border: 1px solid #4caf50;
            color: #4caf50;
        }
        .btn-reply:hover{
            background-color: #4caf50;
            color: #fff !important;
        }
        .btn-delete{
            border: 1px solid #f44336;
            /* Red border */
            color: #f44336;
        }
        .btn-delete:hover{
            background-color: #f44336;
            /* Red background on hover */
            color: #fff !important;
        }
        .message-wrap {
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .btn-view{
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
        .btn-view:hover{
          background-color: #f38f21;
          color: #fff !important;
          text-decoration: none;
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

    <div class="mb-4 mt-3">
        <!--<h4 class="ml-3 pt-3 text-center" style="color:#000; font-family:Silka-Black; letter-spacing:1px">-->
        <!--    <b>Messages</b></h4>-->
        <div class="row mt-4" id="my Table">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title">Project Module Details</h4> --}}
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <!--<th scope="col">S.No.</th>-->
                                        <th scope="col">Vendor Name</th>
                                        <th scope="col">Vendor Message</th>
                                        <th scope="col">Q-Mart Reply</th>
                                        <th scope="col">Document</th>
                                        <th scope="col">Status</th>
                                        {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                    @foreach ($messages as $message)
                                        <tr>
                                            <!--<td>{{ $i++ }}</td>-->
                                            <td>{{$message['vendor_name']}}</td>
                                            <td class="message-wrap" id="vendor_message_{{ $i }}">{{ $message['vendor_message'] }}</td>
                                            <td class="message-wrap" id="admin_message_{{ $i }}">{{ $message['admin_message']}}</td>
                                           
                                           
                                            
                                            <td>
                                                <a href="{{ asset('public/assets/upload/' .$message['admin_file'])}}" class="btn-view" download><b>Download</b></a>
                                            </td>
                                            <td>
                                                <b>{{ $message->status}}</b>
                                            </td>
                                            {{-- <td>
                                                <a href="{{url('delete-vendor-reply/'.$message->id)}}" class="btn-submit btn-delete" onclick="return confirmDelete();"><i class="fa-solid fa-trash-can" style="font-size: 20px"></i></a>
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

    @foreach ($messages as $item)
        <div class="modal fade" id="updateModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Message Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="update-message-status" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1"
                                    value="Approved" {{ $item->status == 'Approved' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">Approved</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio2"
                                    value="Pending" {{ $item->status == 'Pending' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Pending</label>
                            </div>

                            <button type="submit" class="btn-view mt-3" style="padding: 10px; font-size:12px">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function wrapText(text, maxWords) {
            let words = text.split(' ');
            let result = '';
            for (let i = 0; i < words.length; i++) {
                result += words[i] + ' ';
                if ((i + 1) % maxWords === 0) {
                    result += '\n';
                }
            }
            return result;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const vendorMessages = document.querySelectorAll('[id^="vendor_message_"]');
            const adminMessages = document.querySelectorAll('[id^="admin_message_"]');
            vendorMessages.forEach(message => {
                message.innerHTML = wrapText(message.textContent, 10).replace(/\n/g, '<br>');
            });
            adminMessages.forEach(message => {
                message.innerHTML = wrapText(message.textContent, 10).replace(/\n/g, '<br>');
            });
        });

        setTimeout(function() {
              $('#success-message').fadeOut('fast')
          }, 4000);

          setTimeout(function() {
              $('#error-message').fadeOut('fast')
          }, 4000);


          function confirmDelete(){
            return confirm('Are You Sure You Want to Delete Vendor reply messages!');
          }
          
    </script>
@endsection
