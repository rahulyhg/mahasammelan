<?php
require_once('config/Query.Inc.php');
$Obj = new Query(DB_NAME);
$error_msg = '';
  

if(isset($_POST['login_submit']) && !empty($_POST['login_submit'])){


	$postfields = array(
					'email_address'=>urlencode(trim($_POST['email_address'])),
					'password'=>urlencode(trim($_POST['password']))
					);

         
	$result = $Obj->httpPost(ADMIN_URL.'api/admin/login',$postfields);
//print_r($result);
	$result = json_decode($result);
		//print_r($result); die;
	if(!empty($result->success)){
			
		$_SESSION['admin_id'] = $result->admin_array->user_id;
		$_SESSION['username'] = $result->admin_array->username;
		$_SESSION['email_address'] = $result->admin_array->email_address;
		$_SESSION['admin_status'] = $result->admin_array->status;
	
		$Obj->Redirect("index.php");
		exit;

	}else{

		$error_msg = $result->msg;

	}

}

?>



<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->

<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->

<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->

<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->



<!-- Mirrored from teamfox.co/themes/pleasure/app/admin1/user-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 Jul 2015 06:05:05 GMT -->

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">



	<title>Sadhu - Dashboard Login</title>



	<meta name="description" content="">

	<meta name="author" content="">



	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="apple-mobile-web-app-capable" content="yes">

	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">



	<!-- BEGIN CORE CSS -->

	<link rel="stylesheet" href="assets/admin1/css/admin1.css">

	<link rel="stylesheet" href="assets/globals/css/elements.css">

	<!-- END CORE CSS -->



	<!-- BEGIN PLUGINS CSS -->

	<link rel="stylesheet" href="assets/globals/plugins/bootstrap-social/bootstrap-social.css">

	<!-- END PLUGINS CSS -->



	<!-- FIX PLUGINS -->

	<link rel="stylesheet" href="assets/globals/css/plugins.css">

	<!-- END FIX PLUGINS -->



	<!-- BEGIN SHORTCUT AND TOUCH ICONS -->

	<link rel="shortcut icon" href="http://localhost/andyw-material/manager-area/assets/globals/img/icons/favicon.ico">

	<link rel="apple-touch-icon" href="assets/globals/img/icons/apple-touch-icon.png">

	<!-- END SHORTCUT AND TOUCH ICONS -->



	<script src="assets/globals/plugins/modernizr/modernizr.min.js"></script>

</head>

<body class="bg-login printable">



	<div class="login-screen">

		<div class="panel-login blur-content">

			<div class="panel-heading"></div><!--.panel-heading-->



			<div id="pane-login" class="panel-body active">

			

				<form action="" class="form-horizontal parsley-validate" method="post">



					<h2>Login to Dashboard</h2>

					<!--<h2>Email Address and Password does not match!</h2>-->

					<?php

						if(!empty($error_msg)){

					?>

						<div class="alert alert-danger-transparent" role="alert"><?php echo $error_msg; ?></div>

					<?php } ?>

					<div class="form-group">

						<div class="inputer">

							<div class="input-wrapper">

								<input type="email" name="email_address" value="<?php echo trim($_POST['email_address']); ?>" class="form-control" placeholder="Enter your email address" required>

							</div>

						</div>

					</div><!--.form-group-->

					<div class="form-group">

						<div class="inputer">

							<div class="input-wrapper">

								<input type="password" name="password" value="<?php echo $_POST['password']; ?>" class="form-control" placeholder="Enter your password" required>

							</div>

						</div>

					</div><!--.form-group-->

					<div class="form-buttons clearfix">

						<label class="pull-left"><input type="checkbox" name="remember" value="1"> Remember me</label>

						<button type="submit" name="login_submit" value="1" class="btn btn-success pull-right">Login</button>

					</div><!--.form-buttons-->

	

					<!--<div class="social-accounts">

						<div class="btn-group btn-merged btn-group-justified">

							<div class="btn-group">

								<a class="btn btn-social btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>

							</div>

							<div class="btn-group">

								<a class="btn btn-social btn-github"><i class="fa fa-github"></i> Github</a>

							</div>

						</div>

					</div>--><!--.social-accounts-->

	

					<!--<ul class="extra-links">

						<li><a href="#" class="show-pane-forgot-password">Forgot your password</a></li>

						<li><a href="#" class="show-pane-create-account">Create a new account</a></li>

					</ul>-->

				</form>

				</div><!--#login.panel-body-->

	

				<div id="pane-forgot-password" class="panel-body">

					<h2>Forgot Your Password</h2>

					<div class="form-group">

						<div class="inputer">

							<div class="input-wrapper">

								<input type="email" class="form-control" placeholder="Enter your email address">

							</div>

						</div>

					</div><!--.form-group-->

					<div class="form-buttons clearfix">

						<button type="submit" class="btn btn-white pull-left show-pane-login">Cancel</button>

						<button type="submit" class="btn btn-success pull-right">Send</button>

					</div><!--.form-buttons-->

			

			</div><!--#pane-forgot-password.panel-body-->



			<div id="pane-create-account" class="panel-body">

				<h2>Create a New Account</h2>

				<div class="form-group">

					<div class="inputer">

						<div class="input-wrapper">

							<input type="text" class="form-control" placeholder="Enter your full name">

						</div>

					</div>

				</div><!--.form-group-->

				<div class="form-group">

					<div class="inputer">

						<div class="input-wrapper">

							<input type="email" class="form-control" placeholder="Enter your email address">

						</div>

					</div>

				</div><!--.form-group-->

				<div class="form-group">

					<div class="inputer">

						<div class="input-wrapper">

							<input type="password" class="form-control" placeholder="Enter your password">

						</div>

					</div>

				</div><!--.form-group-->

				<div class="form-group">

					<div class="inputer">

						<div class="input-wrapper">

							<input type="password" class="form-control" placeholder="Enter your password again">

						</div>

					</div>

				</div><!--.form-group-->

				<div class="form-group">

					<label><input type="checkbox" name="remember" value="1"> I have read and agree to the term of use.</label>

				</div>

				<div class="form-buttons clearfix">

					<button type="submit" class="btn btn-white pull-left show-pane-login">Cancel</button>

					<button type="submit" class="btn btn-success pull-right">Sign Up</button>

				</div><!--.form-buttons-->

			</div><!--#login.panel-body-->



		</div><!--.blur-content-->

	</div><!--.login-screen-->



	<div class="bg-blur dark">

		<div class="overlay"></div><!--.overlay-->

	</div><!--.bg-blur-->



	<svg version="1.1" xmlns='http://www.w3.org/2000/svg'>

		<filter id='blur'>

			<feGaussianBlur stdDeviation='7' />

		</filter>

	</svg>



	<!-- BEGIN GLOBAL AND THEME VENDORS -->

	<script src="assets/globals/js/global-vendors.js"></script>

	<!-- END GLOBAL AND THEME VENDORS -->





	<!-- BEGIN PLUGINS AREA -->

	<script src="assets/globals/plugins/components-summernote/dist/summernote.min.js"></script>

	<script src="assets/globals/plugins/parsleyjs/dist/parsley.min.js"></script>

	<!-- END PLUGINS AREA -->



	<!-- PLUGINS INITIALIZATION AND SETTINGS -->

	<script src="assets/globals/scripts/forms-validations-parsley.js"></script>

	<!-- END PLUGINS INITIALIZATION AND SETTINGS -->





	<!-- PLUGINS INITIALIZATION AND SETTINGS -->

	<script src="assets/globals/scripts/user-pages.js"></script>

	<!-- END PLUGINS INITIALIZATION AND SETTINGS -->



	<!-- PLEASURE Initializer -->

	<script src="assets/globals/js/pleasure.js"></script>

	<!-- ADMIN 1 Layout Functions -->

	<script src="assets/admin1/js/layout.js"></script>



	<!-- BEGIN INITIALIZATION-->

	<script>

	$(document).ready(function () {

		Pleasure.init();

		Layout.init();

		UserPages.login();

		FormsValidationsParsley.init();



	});

	</script>

	<!-- END INITIALIZATION-->



	<!-- BEGIN Google Analytics -->

	<!-- END Google Analytics -->



</body>



<!-- Mirrored from teamfox.co/themes/pleasure/app/admin1/user-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 Jul 2015 06:05:06 GMT -->

</html>
