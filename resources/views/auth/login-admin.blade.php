<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>MASUK ADMIN FURNITURE</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('admin-login/css/bootstrap.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('admin-login/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="{{ asset('admin-login/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-login/css/style-responsive.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.css') }} IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.css') }}"></script>
      <script src="https://oss.maxcdn.com/libs/respond.css') }}/1.4.2/respond.min.css') }}"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" role="form" method="POST" action="{{route('admin.login.submit')}}">
				<input type="hidden" value="{{ csrf_token() }}">
				{{ csrf_field() }}
		        <h2 class="form-login-heading">Login Admin</h2>
		        <div class="login-wrap">

                    @if ($errors->has('email') && $errors->has('password'))                    
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Error Login!</strong> {{ $errors->first('email') }}
							<strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                    @if ($errors->has('email') && !$errors->has('password'))                    
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Error Login!</strong> {{ $errors->first('email') }}
                        </div>
                    @endif
                    @if ($errors->has('password') && !$errors->has('email'))                    
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>{{ $errors->first('password') }}</strong>
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
                        </div>
                    </div>
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		
		        </div>
			</form>

			<form method="post">
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="text" name="email-reset" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="button">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ asset('admin-login/js/jquery.js') }}"></script>
    <script src="{{ asset('admin-login/js/bootstrap.min.js') }}"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="{{ asset('admin-login/js/jquery.backstretch.min.js') }}"></script>
    <script>
        $.backstretch("{{ asset('admin-login/img/login-bg.jpg') }}", {speed: 500});
    </script>


  </body>
</html>
