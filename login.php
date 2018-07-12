<?PHP
ini_set('display_errors', 1);
//Atau
error_reporting(E_ALL && ~E_NOTICE);
require_once("./class/membersite_config.php");

if(isset($_POST['submitted']))
{	
   if($fgmembersite->Login())
   {	   
        $fgmembersite->RedirectToURL("index.php");
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets1/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets1/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Login Page</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets1/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets1/css/demo.css" rel="stylesheet" />
</head>

<body class="login-page sidebar-collapse">
<?php 

	?>
    <div class="page-header" filter-color="orange">
        <div class="page-header-image" style="background-image:url(assets1/img/login.jpg)"></div>
        <div class="container">
            <div class="col-md-4 content-center">
                <div class="card card-login card-plain">                    
					<form id='login' class="form" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
					<input type='hidden' name='submitted' id='submitted' value='1'/>
                        <div class="header header-primary text-center">
                            <div class="logo-container">
                                <img src="assets1/img/now-logo.png" alt="">
                            </div><h5><b>PPLJT Jasamarga Cabang Semarang</b></h5>
                        </div>
                        <div class="content">
						

							<div>
								<span class='error'>
									<?php echo $fgmembersite->GetErrorMessage(); ?>
								</span>
							</div>

                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons users_circle-08"></i>
                                </span>
                                <input type="text" class="form-control" name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" placeholder="Username..." >
                            </div>
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons text_caps-small"></i>
                                </span>
                                <input type="text" name='password' id='password' maxlength="50" placeholder="Password..." class="form-control" />
                            </div>
                        </div>
                        <div class="footer text-center">
						<input type="submit" class="btn btn-primary btn-round btn-lg btn-block" value="Login">
                            <!--<a href="#pablo" class="btn btn-primary btn-round btn-lg btn-block">Login</a> -->
                        </div>
                        <div class="pull-left">
                            <h6>
                                <!-- <a href="#pablo" class="link">Create Account</a> -->
                            </h6>
                        </div>
                        <div class="pull-right">
                            <h6>
                                <a href="#pablo" class="link" onclick='alert("Silahkan Hubungi Admin di +62 851 0858 0009 (Angga)")'>Lupa Password ?</a>
                            </h6>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		<?php
		/*
        <footer class="footer">
            <div class="container">
                <nav>
                    <ul>
                        <li>
                            <a href="https://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="http://presentation.creative-tim.com">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/creativetimofficial/now-ui-kit/blob/master/LICENSE.md">
                                MIT License
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, Designed by
                    <a href="http://www.invisionapp.com" target="_blank">Invision</a>. Coded by
                    <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
                </div>
            </div>
        </footer>
		*/
		?>
    </div>
</body>
<!--   Core JS Files   -->
<script src="assets1/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets1/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets1/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets1/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets1/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="assets1/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="assets1/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>

</html>