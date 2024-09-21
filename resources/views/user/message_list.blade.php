@extends('user.main.main')

@section('user-content')
    <style>
        .btn-view{
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
        .btn-view:hover{
          background-color: #f38f21;
          color: #fff !important;
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
    </style>

    <div class="container block mb-4 mt-3">
        <h4 class="ml-3 pt-3 text-center" style="color:#000; font-family:Silka-Black; letter-spacing:1px">
            <b>Messages</b></h4>
        <div class="row mt-4" id="my Table">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title">Project Module Details</h4> --}}
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">S.No.</th>
                                        <th scope="col">Vendor Message</th>
                                        <th scope="col">Admin Message</th>
                                        <th scope="col">Status</th>
                                        {{-- <th scope="col">file</th> --}}
                                        <th scope="col">Document</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                    @if ($messages)
                                        @foreach ($messages as $message)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td class="message-wrap" id="vendor_message_{{ $i }}">{{ $message['vendor_message'] }}</td>
                                            <td class="message-wrap" id="admin_message_{{ $i }}">{{ $message['admin_message']}}</td>
                                            {{-- <td>{{$message->file}}</td> --}}
                                            <td>
                                            @if ($message->status == 'Pending')
                                                <a href="" class="btn-view btn-delete" data-toggle="modal"
                                                    data-target="#updateModal{{ $message->id }}"><b>{{ $message->status }}</b></a>
                                            @elseif($message->status == 'Approved')
                                                <a href="" class="btn-view btn-reply" data-toggle="modal"
                                                    data-target="#updateModal{{ $message->id }}"><b>{{ $message->status }}</b></a>
                                            @endif
                                        </td>
                                            <td>
                                                <a href="{{ asset('public/assets/upload/' . $message['admin_file']) }}" class="btn-view" download><b>Download</b></a>
                                            </td>
                                        </tr>
                                        @endforeach 
                                    @else
                                
                                    @endif
                                  
                               
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    </script>
@endsection
