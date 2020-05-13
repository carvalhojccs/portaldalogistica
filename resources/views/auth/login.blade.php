<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema de controle de extoque</title>
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        
        
        <style type="text/css">
            body {
                color: #fff;
                background: #fff;
            }
            .form-control {
                min-height: 41px;
                background: #fff;
                box-shadow: none !important;
                border-color: #e3e3e3;
            }
            .form-control:focus {
                border-color: #70c5c0;
            }
            .form-control, .btn {        
                border-radius: 2px;
            }
            .login-form {
                width: 350px;
                margin: 0 auto;
                padding: 100px 0 30px;		
            }
            .login-form form {
                color: #7a7a7a;
                border-radius: 2px;
                margin-bottom: 15px;
                font-size: 13px;
                background: #ececec;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                border-radius: 10px;
                padding: 30px;	
                position: relative;	
            }
            .login-form h2 {
                font-size: 22px;
                margin: 35px 0 25px;
            }
            .login-form .avatar {
                position: absolute;
                margin: 0 auto;
                left: 0;
                right: 0;
                top: -50px;
                width: 95px;
                height: 95px;
                border-radius: 50%;
                z-index: 9;
                background: #fff;
                padding: 15px;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
            }
            .login-form .avatar img {
                width: 100%;
            }	
            .login-form input[type="checkbox"] {
                margin-top: 2px;
            }
            .login-form .btn {        
                font-size: 16px;
                font-weight: bold;
                background: #70c5c0;
                border: none;
                margin-bottom: 20px;
            }
            .login-form .btn:hover, .login-form .btn:focus {
                background: #50b8b3;
                outline: none !important;
            }    
            .login-form a {
                color: #fff;
                text-decoration: underline;
            }
            .login-form a:hover {
                text-decoration: none;
            }
            .login-form form a {
                color: #7a7a7a;
                text-decoration: none;
            }
            .login-form form a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="login-form">
            <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                {!! csrf_field() !!}
                <div class="avatar">
                    <img src="{{ asset('imgs/logo_comara.png') }}" alt="COMARA">
                </div>
                <h2 class="text-center">PORTAL DA LOGÍSTICA</h2>   
                
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" class="form-control" name="password" placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>        
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Entrar</button>
                </div>

            </form>
            <p class="text-center small">Don't have an account? <a href="#">Sign up here!</a></p>
        </div>
    </body>
</html>                            