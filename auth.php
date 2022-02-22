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
    <title><?= $sitename; ?> - Login / Register
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
      <div class="container-fluid p-0">
        <!-- login page start-->
        <div class="authentication-main mt-0">
          <div class="row">
            <div class="col-md-12">
              <div class="auth-innerright auth-bg">
                <div class="authentication-box">
                  <div class="mt-6">
                    <div class="card-body p-0">
                      <div class="cont text-center">
                        <div> 
                          <form class="theme-form" onsubmit="return false;">
						  <h3>NETWORK.RIP</h3>
                            <h4>LOGIN</h4>
                            <h6>Enter your Username and Password</h6>
                            <div class="form-group">
                              <label class="col-form-label pt-0">Username</label>
                               <input type="text" class="form-control" id="username2" name="username2" onkeypress="handle(event)" placeholder="Your username...">
                            </div>
                            <div class="form-group">
                              <label class="col-form-label">Password</label>
                              <input type="password" class="form-control" id="password2" name="password2" onkeypress="handle(event)" placeholder="Your password...">
                            </div>
							<div class="form-group">
                                    <label for="example-nf-email">Captcha</label>
                                    <div class="row" style="margin-left: 0%;">
                                       <input type="text" class="form-control col-7" id="captcha2" name="captcha2"  placeholder="Replace the numbers"> <img width=110 height=35 class="floating" id="img" src="assets/backend/captcha.php" style="margin-left: 1%; margin-top: -1%;" />
                                    </div>
                                 </div>
                           <div class="checkbox checkbox-solid-primary float-right">
                              <input name="hideme" id="hideme" type="checkbox">
                              <label for="hideme">Hide me</label>
                            </div>
                            <div class="form-group row mt-3 mb-0">
                              <button type="submit" class="btn btn-pill btn-primary btn-air-primary" onclick="doLogin()" id="LoginBtn" name="LoginBtn">
                                        <i class="si si-login mr-10"></i> Sign In
                                    </button>
                            </div>
							
                         
                           
                         
						  <hr>
							<span></span><a href="reinder.php" style="color:blue;"> <style=>Reset Your password</a>
							 </form>
                        </div>
                        <div class="sub-cont">
                          <div class="img">
                            <div class="img__text m--up">
                              <h2>New User?</h2>
                              <p>Sign up and discover great amount of new opportunities!</p>
                            </div>
                            <div class="img__text m--in">
                              <h2>One of us?</h2>
                              <p>If you already has an account, just sign in. We've missed you!</p>
                            </div>
                            <div class="img__btn"><span class="m--up">Sign up</span><span class="m--in">Sign in</span></div>
                          </div>
                          <div>
                            <form class="theme-form" onsubmit="return false;">
							
                              <h5 class="text-center">REGISTER</h5>
                              
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                   <input type="text" class="form-control" id="username" name="username" placeholder="Your username...">
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                     <input type="text" class="form-control" id="email" name="email" placeholder="Your email...">
                                  </div>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Your password...">
									<div class="row col-md-12">
										<span id="password_bar" style="width: 0%;position: absolute;height: 3px;display: block;"></span>
										<span id="password_error" class="mt-0" style="font-size: 12.5px;"></span>
									</div>
                              </div>
							  <div class="form-group">
                                 <input type="password" class="form-control" id="rpassword" name="rpassword" placeholder="Password Confirmation">
									
                              </div>
							  
							  <div class="form-group">
                                     <input type="text" class="form-control" id="pin" name="pin" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Your 4 Digits PIN" maxlength="4">
									
                              </div>
							  <div class="form-group">
                                   
                                    <div class="row" style="margin-left: 0%;">
                                       <input type="text" class="form-control col-7" id="captcha" name="captcha"  placeholder="Replace the numbers"> <img width=110 height=35 class="floating" id="img2" src="assets/backend/captcha.php" style="margin-left: 1%; margin-top: -1%;" />
                                    </div>
                                 </div>
							<div class="checkbox checkbox-solid-primary float-right">
                              <input name="tos" id="tos" type="checkbox" checked disabled>
                              <label for="tos">TOS</label>
                            </div>
							  
                              
                                <div class="form-group row mt-3 mb-0">
                                  <button type="submit" class="btn btn-pill btn-secondary btn-air-secondary" onclick="doRegister()" id="RegisterBtn" name="RegisterBtn">
                                        <i class="si si-login mr-10"></i> Sign Up
                                    </button>
                                </div>
                                
                              
                             
                              
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- login page end-->
      </div>
    </div>
	<script type="text/javascript">
                     function handle(e){
                         if(e.keyCode === 13){
                             e.preventDefault();
                     if(document.getElementById("LoginBtn").disabled == false) {
                     doLogin();
                     }
                         }
                     }
                     
                     function doLogin() {
                     document.getElementById("LoginBtn").disabled = true;
                     var username=$('#username2').val();
                     var password=$('#password2').val();
					 var captcha=$('#captcha2').val();
                     var hideme = "0"
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
                     
                     if((Respone.indexOf("you already logged in") >= 0)) {
                     					window.setInterval(function(){
                     				window.location	= "home"
                     				}, 5000);
                     }
                     
                     	$.notify({
                     		icon: 'fa fa-warning', 
							title: '<strong>ERROR: </strong>',
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
                     	document.getElementById("LoginBtn").disabled = false;
                     	} else {
                     		 var snd = new Audio("assets/sounds/success.mp3"); 
                         //snd.play();
                     							$.notify({
                     		icon: 'fa fa-check', 
                     	    title: '<strong>SUCCESS: </strong>',
                     	    message: xmlhttp.responseText
                     			},{
                     	    type: 'success',
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
								
                     			window.setInterval(function(){
                     				window.location	= "home"
                     				}, 5000);
                     	}
                     }
                     }
                     if($('#hideme').prop('checked')) {
                     hideme = "1";
                     } else {
                     hideme = "0";
                     }
						 if(!username || !password || !captcha) {
							 $.notify({
                     		icon: 'fa fa-warning', 
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
								document.getElementById("LoginBtn").disabled = false;
						 } else {
						 xmlhttp.open("POST","assets/backend/doLogin.php",true);
						 xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						 xmlhttp.send("login-username=" + username + "&login-password=" + password + "&login-hideme=" + hideme + "&captcha=" + captcha);
						 }
					 }
                  </script>		
				  
				   <script>
                  function handle2(e2){
                      if(e2.keyCode === 13){
                          e2.preventDefault();
						 if(document.getElementById("RegisterBtn").disabled == false) {
							doRegister();
						 }
					  }
                  }
                  
                  function doRegister() {
                  document.getElementById("RegisterBtn").disabled = true;
                  var username=$('#username').val();
                  var password=$('#password').val();
                  var rpassword=$('#rpassword').val();
                  var email=$('#email').val();
                  var captcha=$('#captcha').val();
                  var pin=$('#pin').val();
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
                  		icon: 'fa fa-warning', 
					    title: '<strong>ERROR: </strong>',
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
							$('#img2').attr('src', 'assets/backend/captcha.php');
                  	document.getElementById("RegisterBtn").disabled = false;
                  	} else {
                  							$.notify({
                  		icon: 'fa fa-check', 
                  	    message: xmlhttp.responseText
                  			},{
                  	    type: 'success',
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
                  			window.setInterval(function(){
                  				window.location	= "home"
                  				}, 3000);
                  	}
                  }
                  }
					  if(!username || !password || !email || !rpassword || !captcha || !pin) {
						  $.notify({
                     		icon: 'fa fa-warning', 
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
								document.getElementById("RegisterBtn").disabled = false;
					  } else {
						  xmlhttp.open("POST","assets/backend/doRegister.php",true);
						  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						  xmlhttp.send("signup-username=" + username + "&signup-password=" + password + "&signup-email=" + email + "&signup-password-confirm=" + rpassword + "&captcha=" + captcha + "&pin=" + pin);
					  }
				  }
				  
				var m_strUpperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				var m_strLowerCase = "abcdefghijklmnopqrstuvwxyz";
				var m_strNumber = "0123456789";
				var m_strCharacters = "!@#$%^&*?_~"

				function checkPassword(strPassword)
				{
					var nScore = 0;

					if (strPassword.length < 5)
					{
						nScore += 5;
					}

					else if (strPassword.length > 4 && strPassword.length < 8)
					{
						nScore += 10;
					}

					else if (strPassword.length > 7)
					{
						nScore += 25;
					}


					var nUpperCount = countContain(strPassword, m_strUpperCase);
					var nLowerCount = countContain(strPassword, m_strLowerCase);
					var nLowerUpperCount = nUpperCount + nLowerCount;
					if (nUpperCount == 0 && nLowerCount != 0) 
					{ 
						nScore += 10; 
					}

					else if (nUpperCount != 0 && nLowerCount != 0) 
					{ 
						nScore += 20; 
					}


					var nNumberCount = countContain(strPassword, m_strNumber);
					if (nNumberCount == 1)
					{
						nScore += 10;
					}

					if (nNumberCount >= 3)
					{
						nScore += 20;
					}


					var nCharacterCount = countContain(strPassword, m_strCharacters);

					if (nCharacterCount == 1)
					{
						nScore += 10;
					}   
		
					if (nCharacterCount > 1)
					{
						nScore += 25;
					}
					if (nNumberCount != 0 && nLowerUpperCount != 0)
					{
						nScore += 2;
					}

					if (nNumberCount != 0 && nLowerUpperCount != 0 && nCharacterCount != 0)
					{
						nScore += 3;
					}

					if (nNumberCount != 0 && nUpperCount != 0 && nLowerCount != 0 && nCharacterCount != 0)
					{
						nScore += 5;
					}


					return nScore;
				}

				function runPassword(strPassword, strFieldID) 
				{
					var nScore = checkPassword(strPassword);
						var password = document.getElementById("password"); 
						var ctlBar = document.getElementById(strFieldID + "_bar"); 
						var ctlText = document.getElementById(strFieldID + "_error");
						if (!ctlBar || !ctlText)
							return;
						ctlBar.style.width = nScore + "%";
					
					if (nScore >= 90)
					{
						var strText = "Your password is 90% Uncrakeable";
						var strColor = "#0ca908";
					}
					else if (nScore >= 80)
					{
						var strText = "Your password is Strong.";
						var strColor = "#008000";
					}

					else if (nScore >= 60)
					{
						var strText = "Your password is Regular";
						var strColor = "#006000";
					}
					else if (nScore >= 40)
					{
						var strText = "You can do it better.";
						var strColor = "#e3cb00";
					}
					else if (nScore >= 20)
					{
						var strText = "Your password is Weak";
						var strColor = "#Fe3d1a";
					}
					else
					{
						var strText = "this is really a password?";
						var strColor = "#e71a1a";
					}

					if(strPassword.length == 0)
					{
					password.style.border = "1px #314350 solid";
					ctlBar.style.backgroundColor = "";
					ctlText.innerHTML =  "";
					}
				else
					{
						if(ctlText.innerHTML != strText) {
							password.style.border = "1px " + strColor + " solid";
							ctlBar.style.backgroundColor = strColor;
							ctlText.innerHTML = strText;
						}
				}
				}


				function countContain(strPassword, strCheck)
				{ 

					var nCount = 0;

					for (i = 0; i < strPassword.length; i++) 
					{
						if (strCheck.indexOf(strPassword.charAt(i)) > -1) 
						{ 
								nCount++;
						} 
					} 

					return nCount; 
				} 
				
				var auto_refresh = setInterval(
				function ()
				{
					runPassword($("#password").val() , 'password')
				}, 100);
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
	<script src="../assets/js/modal-animated.js"></script>
	<script src="assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/notify/notify-script.js"></script>
    <!-- Plugin used-->
  </body>
</html>