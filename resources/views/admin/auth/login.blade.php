<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login/Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            /* background: url('{{ asset('assets/images/auth/bg1.png') }}') no-repeat center center fixed; */
            background-size: cover;
            background-color: #eae3e3;
          
        }

        h2 {
            color: rgb(93, 90, 90);
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
            color: white;
            max-width: 422px;
            width: 100%;
            box-sizing: border-box;
            background-color:#dddbdb;
        }

        .login-form h2 {
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
            letter-spacing:1px;
            font-weight: 400;
            
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px !important;
            outline: none;
            /* box-sizing: border-box; */
        }

        button,.register {
            letter-spacing: 1.4px;
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

        button:hover,.register:hover {
            background-color: #f38f21;
            color: #fff !important;
        }
    </style>


</head>

<body>

   
    <div class="login-container">
        <form class="login-form" action="{{url('login')}}" method="POST">

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
            @csrf
            <h2 style="color: #f38f21; font-family: Silka-Black; letter-spacing:1.2px"><b>Login</b></h2>
            <div class="input-group">
                <label for="username">Email ID</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">
                @error('email')
                    <span style="color: red;">{{$message}}</span>
                @enderror
            </div>
            <div class="input-group mb-4">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">
                @error('password')
                    <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
            
              
                <button type="submit"><b>Login</b></button>
                {{-- <a href="{{url('register')}}" class="register"><b>Register</b></a> --}}
                
            
            
        </form>
    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>


    setTimeout(function() {
        $('#success-message').fadeOut('fast')
    },3000);

    setTimeout(function() {
        $('#error-message').fadeOut('fast')
    },3000);
</script>

</html>
