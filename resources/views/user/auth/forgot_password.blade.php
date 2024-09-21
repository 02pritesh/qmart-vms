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
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background-color: #eae3e3;
        }

        .login-container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-form {
            background: rgba(246, 243, 243, 0.1);
            backdrop-filter: blur(80px);
            border-radius: 10px;
            padding: 20px 40px;
            box-shadow: 0 10px 30px rgba(44, 43, 43, 0.3);
            max-width: 422px;
            width: 100%;
            box-sizing: border-box;
            background-color: #dddbdb;
        }

        .login-form h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #f38f21;
            font-family: 'Silka-SemiBold';
            letter-spacing: 1.2px;
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
            border-radius: 8px;
            outline: none;
            box-sizing: border-box;
        }

        button,
        .register {
            letter-spacing: 1.4px;
            font-weight: 400;
            border: 1px solid #f38f21;
            color: #f38f21;
            padding: 6px 14px;
            border-radius: 9px;
            background: transparent;
            text-transform: uppercase;
            text-decoration: none;
            font-family: 'Silka-SemiBold';
            transition: all 0.3s ease;
        }

        button:hover,
        .register:hover {
            background-color: #f38f21;
            color: #fff !important;
        }

        .text-danger {
            color: red;
        }
    </style>
</head>

<body>
    
    <div class="login-container">
        <form class="login-form" action="{{ url('send-otp') }}" method="POST" id="login-form">
            @csrf

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

            <h2><b>Forgot Password</b></h2>
            <div class="input-group">
                <label for="email">Email ID</label>
                <input type="email" id="email" name="email" placeholder="Enter registerd email">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
               
            <div>
                 <a href="{{url('/')}}" class="register" style="text-decoration: none; padding:4px 14px; margin-right:10px"><i class="fa-solid fa-left-long mt-3"></i></a>
                <button type="submit" style="margin-left:40px"><b>Send OTP</b></button>

            </div>
           
        
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Set the email value from localStorage if it exists
        $(document).ready(function() {
            var storedEmail = localStorage.getItem('userEmail');
            if (storedEmail) {
                $('#email').val(storedEmail);
            }
        });

        // Save the email value to localStorage before form submission
        $('#login-form').on('submit', function() {
            var email = $('#email').val();
            localStorage.setItem('userEmail', email);
        });

        // Fade out success message after 6 seconds
        setTimeout(function() {
            $('#success-message').fadeOut('fast');
        }, 5000);

        // Fade out error message after 6 seconds
        setTimeout(function() {
            $('#error-message').fadeOut('fast');
        }, 5000);
    </script>
</body>

</html>
