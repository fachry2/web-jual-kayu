@extends('layouts.app-user')
@section('css')
    <style>
        .btn-facebook{
            background: #337ab7;
            color: white;
        }
        .btn-facebook:hover{
            background:#2e6da4;
            color: white;
        }
    </style>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-4 col-md-offset-4">
		<div class="signup-form"><!--sign up form-->
			<h2>DAFTAR DI E-FURNITURE's</h2>
			Sudah punya akun ? masuk <a href="/login">disini</a>
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
				{{ csrf_field() }}
				<input name="nama" type="text" value="{{ old('nama') }}" required autofocus placeholder="Nama Lengkap">
				@if ($errors->has('nama'))
					<span class="help-block">
					<strong>{{ $errors->first('nama') }}</strong>
				</span>
				@endif
				<input name="username" type="text" value="{{ old('username') }}" required autofocus placeholder="Username">
				@if ($errors->has('username'))
					<span class="help-block">
					<strong>{{ $errors->first('username') }}</strong>
				</span>
				@endif
				<input name="email" type="email" value="{{ old('email') }}" required  placeholder="Email">
				@if ($errors->has('email'))
					<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
				<input name="password" type="password" required placeholder="Kata Sandi (Min 6 Karakter)">
				@if ($errors->has('password'))
					<span class="help-block">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
				@endif
				<input name="password_confirmation" id="password_confirmation" type="password" required placeholder="Konfirmasi Kata Sandi">
				
				<button type="submit" class="btn btn-default" style="margin-bottom:10px; width:100%">Daftar</button>
			</form>
		</div><!--/sign up form-->

        <div class="col-sm-1 col-md-offset-5">
            <h2 class="or">OR</h2>
        </div>
        <button onclick="loginFacebook()" type="submit" class="btn btn-facebook" style="margin-bottom:10px; width:100%">
            Facebook
        </button>
        <button onclick="loginGoogle()" type="submit" class="btn btn-danger" style="width:100%">
            Google
        </button>
	</div>
</div>
<br><br><br>
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