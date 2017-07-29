@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header" align="center">
            <h2>LOGIN FURNITURE ONLINE ADMIN</h2>
            <!--<p class="lead">Belum punya akun ? Daftar <a href="/register">di sini</a></p>-->
        </div>
        <div class="col-md-6 col-md-offset-3">
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{route('admin.login.submit')}}">
                    <input type="hidden" value="{{ csrf_token() }}">
                    {{ csrf_field() }}

                    @if ($errors->has('email'))                    
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Error Login!</strong>Email / Password yang Anda masukkan salah.
                        </div>
                    @endif

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input name="email" type="text" class="form-control" value="{{ old('email') }}" placeholder="Email" required autofocus aria-describedby="basic-addon1">

                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                            <input name="password" type="password" class="form-control" placeholder="Password" required aria-describedby="basic-addon1">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Ingat saya
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary">
                                Masuk
                            </button>

                            <a class="btn btn-link" href="">
                                Lupa Kata Sandi?
                            </a>
                        </div>
                    </div>
                </form>
                <hr width="100%">
            </div>
        </div>
        <!--
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                </div>
            </div>
            -->
    </div>
@endsection

@section('js')
    <script>
        function loginFacebook(){
            window.location.href = "{{URL::to('login/facebook')}}";
        }

        function loginGoogle(){
            window.location.href = "{{URL::to('login/google')}}";
        }
    </script>
@endsection