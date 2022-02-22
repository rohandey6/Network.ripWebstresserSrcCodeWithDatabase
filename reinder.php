<?php
     include 'assets/backend/config.php';

   if (isset($_SESSION['username'])) {
       header('Location: home');
   }
   
   ?>
<!DOCTYPE html>
<html lang="en">
  <head>
<meta name="description" content="<?= $sitename; ?> - We here at Network.rip which has been up and running since 2020, pride in it to be the leading legal IP stresser on the market available. We provide desirable features like triple layer (layers 3,4 and 7) protection and all work is finalized from a custom source. We provide our services by the means of Private, Custom or Modded methods. Payment for our users is not a hassle due to the fact that we use Private Payment Bots with enhanced security.">
         <meta name="author" content="<?= $sitename; ?>">
         <meta name="keywords" content="ddos, ddos tool, IP Stresser, Booter, Stresser, Online Booter, best booter, networkrip, network.rip, cheap booter, ip booter, strongest streser, ddos online, best stresser, free stresser, free booter, network source, stresser network source, network.rip source, networkrip source, high booter, high stresser, ovh down, skype resolver, Check hosting power, Botnet, Layer3, Layer4, Layer7, Ampfilection, Raw, Spoofed spoofing">
          <meta name="robots" content="noindex, nofollow">
        <meta property="og:title" content="<?= $sitename; ?> - <?= $page; ?>">
         <meta property="og:locale" content="en_US">
         <meta property="og:site_name" content="<?= $sitename; ?>">
         <meta property="og:description" content="<?= $sitename; ?> - We here at Network.rip which has been up and running since 2020, pride in it to be the leading legal IP stresser on the market available. We provide desirable features like triple layer (layers 3,4 and 7) protection and all work is finalized from a custom source. We provide our services by the means of Private, Custom or Modded methods. Payment for our users is not a hassle due to the fact that we use Private Payment Bots with enhanced security.">
         <meta property="og:type" content="website">
         <meta property="og:url" content="https://network.rip/">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title><?= $sitename; ?> - Reinder
         </title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/feather-icon.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
	  <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="loader-index"><span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">    </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
      <div class="container-fluid">
        <!-- Reset Password page start-->
        <div class="authentication-main mt-0">
          <div class="row">
            <div class="col-md-12 p-0">
			<div class="auth-innerright auth-bg">
              <div class="auth-innerright auth-minibox">
                <div class="authentication-box auth-minibox1">
               <!--    <div class="text-center"><img src="assets/images/logo/logo-icon.png" alt="" height="50"></div>-->
				  <div id="status"></div>
                  <div class="card mt-4 p-4">
                    <form class="theme-form" onsubmit="return false;">
                      <h5 class="f-16 mb-3 f-w-600">Grab Your Password</h5>
                      <div class="form-group">
                        <label class="col-form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" onkeypress="handle(event)" placeholder="Your username...">
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" onkeypress="handle(event)" placeholder="Your password...">
                      </div>
					  <div class="form-group">
                                    <label for="example-nf-email">Your 4 Digits PIN</label>
                                    <input type="text" class="form-control" id="pin" name="pin" onkeypress="handle(event)" placeholder="The pin you created the account with" maxlength="4">
                                 </div>
								 
								 <div class="form-group">
								
								 <div class="row" style="margin-left: 0%;">
								 
                                    <input type="text" class="form-control float-center col-5" id="captcha" name="captcha" placeholder="" > <img width=110 height=35 class="floating" id="img" src="assets/backend/captcha.php" style="margin-left: 1%; margin-top: -1%;" />
                                 
								 </div>
								 
								 </div>
                      
                       <div class="form-group row">
					   <div class="col-7">
                         <button type="submit" onclick="doReinder()" id="changePass" name="changePass" class="btn btn-primary btn-block"> Grab   </button>
									   </div>
									   <div class="col-5">
                                       <a class="btn btn-outline-primary col-md-12" href="login">
                                       Back to Login
                                       </a>
                                    </div>
                        </div>
						
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		</div>
        <!-- Reset Password page end-->
      </div>
    </div>
    <!-- page-wrapper Ends-->
	<script type="text/javascript">
                  function handle(e){
                      if(e.keyCode === 13){
                          e.preventDefault();
                  if(document.getElementById("changePass").disabled == false) {
                  doReinder();
                  }
                      }
                  }
                  
                  function doReinder() {
                  document.getElementById("changePass").disabled = true;
                  var username=$('#username').val();
                  var email=$('#email').val();
                  var pin=$('#pin').val();
                  var captcha=$('#captcha').val();
                  var xmlhttp;
                  
                  if (window.XMLHttpRequest) {
                  xmlhttp = new XMLHttpRequest();
                  }
                  else {
                  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                  }
                  xmlhttp.onreadystatechange = function(){
                  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  var Respone = xmlhttp.responseText
                  if (Respone.indexOf("ERROR:") >= 0) {
                  
                  	$.notify({
                  		icon: 'fa fa-times', 
                  	    message: xmlhttp.responseText
                  
                  			},{
                  type: 'danger',
				  newest_on_top:true ,
							placement:{
							from:'top',
							align:'center'
								},
						    animate:{
							enter:'animated bounceIn',
							exit:'animated bounceOut'
							}
                  			});
							$('#img').attr('src', 'assets/backend/captcha.php');
                  	document.getElementById("changePass").disabled = false;
                  	} else {
                  document.getElementById("status").innerHTML = xmlhttp.responseText;
                  	}
                  }
                  }
					  if(!username || !email || !pin || !captcha) {
						  $.notify({
                     		icon: 'fa fa-times', 
                     	    title: '<strong>ERROR: </strong>',
                     	    message: "Please fill in all fields!"
                     			},{
                     	    type: 'danger',
							newest_on_top:true ,
							placement:{
							from:'top',
							align:'center'
								},
						    animate:{
							enter:'animated bounceIn',
							exit:'animated bounceOut'
							}
                     			});
								document.getElementById("changePass").disabled = false;
					  } else {
					  xmlhttp.open("POST","assets/backend/doReinder.php",true);
					  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					  xmlhttp.send("username=" + username + "&email=" + email + "&pin=" + pin + "&captcha=" + captcha);
					  }
				  }
               </script>		
	
    <!-- latest jquery-->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="assets/js/bootstrap/popper.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.js"></script>
    <!-- feather icon js-->
    <script src="assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="assets/js/sidebar-menu.js"></script>
    <script src="assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="assets/js/login.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <!-- login js-->
	<script src="assets/js/modal-animated.js"></script>
	<script src="assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/notify/notify-script.js"></script>
    <!-- Plugin used-->
  </body>
</html>