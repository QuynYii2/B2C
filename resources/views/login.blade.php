<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .login-form {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background: #f7f7f7;
            border-radius: 5px;
        }

        .login-form h2 {
            text-align: center;
        }

        .form-control:focus {
            box-shadow: none;
        }

        .login-form .btn {
            font-size: 16px;
            font-weight: bold;
            background: #3498db;
            border: none;
            outline: none;
            border-radius: 5px;
            margin-top: 20px;
            padding: 10px 20px;
            color: #fff;
            cursor: pointer;
        }

        .login-form .btn:hover {
            background: #258cd1;
        }

        .login-form .checkbox {
            font-weight: normal;
        }

        .login-form .form-check-label {
            padding-left: 0;
        }

        .login-form .forgot-password {
            float: right;
            font-size: 14px;
            color: #999;
        }

        .login-form .register {
            margin-top: 20px;
        }
        .animate-charcter
        {
            text-transform: uppercase;
            background-image: linear-gradient(
                -225deg,
                #231557 0%,
                #44107a 29%,
                #ff1361 67%,
                #fff800 100%
            );
            background-size: auto auto;
            background-clip: border-box;
            background-size: 200% auto;
            color: #fff;
            background-clip: text;
            text-fill-color: transparent;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textclip 2s linear infinite;
            font-size: 50px;
        }

        @keyframes textclip {
            to {
                background-position: 200% center;
            }
        }
        .register a {
            background-image: linear-gradient(
                -225deg,
                #231557 0%,
                #44107a 29%,
                #ff1361 67%,
                #fff800 100%
            );
            background-size: auto auto;
            background-clip: border-box;
            background-size: 200% auto;
            color: #fff;
            background-clip: text;
            text-fill-color: transparent;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textclip 2s linear infinite;
        }
        .bg-login {
            background-image: url('{{ asset('images/bg_login_register.jpeg') }}');
            background-size: cover;
            background-position: center;
            height: 100%;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="bg-login">
<div class="login-form">
    <h2 class="animate-charcter">{{ __('auth.sign_in') }}</h2>
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('login.save') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required="required">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required="required">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <div class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                </div>
            </div>
            <div class="col-sm-6">
                <a href="" class="forgot-password">Quên mật khẩu?</a>
            </div>
        </div>
    </form>
    <div class="register">
        <p>Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký tài khoản</a></p>
    </div>
</div>
</body>
</html>
