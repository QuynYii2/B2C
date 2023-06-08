<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .login-form {
            max-width: 100%;
            width: 50%;
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
        .bg-login-register {
            background-image: url('{{ asset('images/bg_login_register.jpeg') }}');
            background-size: cover;
            background-position: center;
            height: 100%;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="bg-login-register">
<div class="login-form">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h3 class="text-center animate-charcter">Đăng ký tài khoản</h3>
    <form method="POST" action="{{ route('register.save') }}">
        @csrf
        <div class="form-group row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="address" name="address" id="address" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="password_confirmation">Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </div>
    </form>
    <div class="register" style="text-align: center;">
        <p>Nếu đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a></p>
    </div>
</div>
<!-- Modal đăng ký thành công -->
<div class="modal fade" id="registerSuccessModal" tabindex="-1" role="dialog" aria-labelledby="registerSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerSuccessModalLabel">Đăng ký thành công</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Cảm ơn bạn đã đăng ký tài khoản. Bây giờ bạn có thể đăng nhập.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@if(session('success'))
    <script>
        $(document).ready(function() {
            $('#registerSuccessModal').modal('show');
        });
    </script>
@endif

</body>
</html>
