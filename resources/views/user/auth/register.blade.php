<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Q-Mart VMS - Vendor Portal</title>
    
    <link rel="shortcut icon" href="{{asset('public/assets/upload/Q-Logo.png')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background-size: cover;
            background-color: #eae3e3;
        }

        h4 {
            color: #000;
        }

        .register-container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-form {
            background: rgba(246, 243, 243, 0.1);
            backdrop-filter: blur(80px);
            border-radius: 10px;
            padding: 20px 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            color: white;
            max-width: 620px;
            width: 100%;
            box-sizing: border-box;
            background-color: #dddbdb;
        }

        .register-form h4 {
            margin-bottom: 20px;
            text-align: center;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #000;
            font-family: Arial, Helvetica, sans-serif;
            letter-spacing: 1px;
            font-weight: 400;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px !important;
            outline: none;
            box-sizing: border-box;
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
            margin-top: 12px;
        }

        .btn-submit:hover {
            background-color: #f38f21;
            color: #fff !important;
        }

        button {
            letter-spacing: 1px;
            font-weight: 400;
            border: 1px solid #f38f21;
            color: #f38f21;
            margin-top: 8px;
            margin-left: 10px;
            margin-right: 5px;
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

        button:hover {
            background-color: #f38f21;
            color: #fff !important;
        }

        #reset {
            border: 1px solid #f44336;
            color: #f44336;
        }

        #reset:hover {
            background-color: #f44336;
            color: #fff !important;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <form class="register-form" action="{{url('register')}}" method="POST">
            @csrf
            <h2 style="color: #f38f21; font-family: Silka-Black; letter-spacing:1.2px; text-align: center; margin-bottom:20px"><b>Registration</b></h2>
            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <label for="name">Vendor Entity Name</label>
                        <input type="text" id="name" name="vendor_name" placeholder="Enter your name" value="{{ old('vendor_name') }}">
                        @error('vendor_name')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="input-group">
                        <label for="gstin">GSTIN</label>
                        <input type="text" id="gstin" name="gstin" placeholder="Enter your gstin number" value="{{ old('gstin') }}" maxlength="15">
                        @error('gstin')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <label for="contact_person">Contact Person</label>
                        <input type="text" id="contact_person" name="contact_person" placeholder="Enter your contact person" value="{{ old('contact_person') }}">
                        @error('contact_person')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" placeholder="Enter your phone number" value="{{ old('phone_number') }}" maxlength="10">
                        @error('phone_number')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <label for="email">Email ID</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}">
                        @error('email')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
               

                <div class="col-6">
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password">
                        @error('password')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                
                 <div class="col-12 mb-2">
                    <div class="form-group">
                        <label for="brands" style="color:black; margin-bottom:6px;">Brands Supplied</label>
                        <textarea class="form-control" id="brands" name="brands" placeholder="Enter your brands supplied name" row="3">{{ old('brands') }}</textarea>
                        @error('brands')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <a href="{{url('/')}}" class="btn-submit" style="text-decoration: none; padding:4px 14px;"><i class="fa-solid fa-left-long"></i></a>
            <button type="submit">Submit</button>
            <button type="reset" id="reset">Reset</button>
            
        </form>
    </div>
</body>

</html>
