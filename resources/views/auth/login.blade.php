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
		<div class="login-form"><!--login form-->
			@if(session('status'))
			<div class="alert alert-success">{{ session('status') }}</div>
			@endif
			@if(session('warning'))
			<div class="alert alert-warning">{{ session('warning') }}</div>
			@endif
			<h2><center>MASUK DI E-FURNITURE</center></h2>
			Belum punya akun ? daftar <a href="/register">disini</a>
			<form class="form-horizontal" role="form" method="POST" action="{{ url('login') }}">
				{{ csrf_field() }}
				<input type="text" name="email" placeholder="Email or Username" value="{{ old('email') }}" autofocus required/>
				@if ($errors->has('email'))
					<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
				<input type="password" name="password" placeholder="Password" required/>
				@if ($errors->has('password'))
					<span class="help-block">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
				@endif
				<span>
					<input type="checkbox" class="checkbox"> 
					Ingat saya
				</span>
				<div>
					<button type="submit" class="btn btn-default" style="margin-bottom:10px; width:100%">Login</button>
				</div>

				<a class="btn btn-link pull-right" href="">
					Lupa Kata Sandi?
				</a>
			</form>
		</div><!--/login form-->

		<div class="row">
			<div class="col-sm-1 col-md-offset-5">
				<h2 class="or">OR</h2>
			</div>
		</div>
		<hr>

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