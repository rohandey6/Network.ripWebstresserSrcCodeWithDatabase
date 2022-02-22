<html lang="en" class="no-focus"><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <title>Human verification</title>
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
      <link rel="stylesheet" id="css-main" href="admin/assets/css/dark.css">
      <link rel="stylesheet" id="css-main" href="admin/assets/css/animations.css">
   </head>
   <body style="background: linear-gradient(to right, rgba(143, 58, 224) 0, rgba(1, 0, 138) 100%), url(assets/img/title-background.svg) !important;">
      <header id="page-header">
         <div id="page-header-loader" class="overlay-header bg-gd-bluedark">
            <div class="content-header content-header-fullrow text-center">
               <div class="content-header-item">
                  <i class="fa fa-2x fa-cog fa-spin text-white"></i>
               </div>
            </div>
         </div>
      </header>
      <main id="main-container" style="min-height: 657px;">
         <div class="hero-inner">
            <div class="content content-full">
               <div class="py-30 text-center">
                  
                  <bb class="h2 font-w700 mt-30 text-danger" style="
                     font-size: 24px;
                     text-shadow: 2px 2px 5px #7f2c2b;
                     "><i class="fa fa-warning animiated tossing" style="
                     font-size: 37px;
                     "></i><br>Oops something went wrong</bb>
                  <br><br>
                  <bb class="text-white" style="
                     font-size: 17px;
                     box-shadow: 0 0 black;
                     text-shadow: 2px 2px 6px #2c2c2c;
                     ">looks like there is a lot of requests incoming from your ip, please verify you are not a robot</bb>
                  <br></br>
                  <center>
                  <div class="col-md-3 text-left">
				 <div id="respone"></div>
                                    
                                    <div class="row">
                                       <input type="text" class="form-control col-7"maxlength="6" id="captcha" name="captcha" style="
                                          background-color: transparent;
                                          border: 1px solid #314350;
                                          color: #FFF !important;
                                          box-shadow: 0 0 4px 0px #426c8e;
                                          "> <img width="130" height="50" id="img" class="floating" src="assets/backend/captcha" style="margin-left: 1%; margin-top: -1%;">
                                    </div>
                                    <div class="text-center"><label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" checked disabled>
                                    <span class="css-control-indicator"></span>
                                    I agree to <a href="javascript:void(0)">Terms &amp; Conditions</a>
                                    </label></div>
                                 </div>
								 <div class="col-md-2">
								 <button type="submit" onclick="Verify()" id="doVerify" name="doVerify" class="btn btn-outline-primary col-md-12" style="box-shadow: 2px 2px 1px #15344d;">
                                          <i class="si si-login mr-10"></i> Verify
                                          </button>
								</div>
								 </center>
               </div>
            </div>
         </div>
		 
				<script> 
					function Verify() {
        				var captcha = $('#captcha').val();

        				var xmlhttp;
        				if (window.XMLHttpRequest) {
        					xmlhttp=new XMLHttpRequest();
        				}
        				else {
        					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        				}
        				xmlhttp.onreadystatechange=function() {
        					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        						$('#img').attr('src', 'assets/backend/captcha')
								var response = xmlhttp.responseText;
								
								if(response == "ERROR:INCORRECT") {
									document.getElementById("respone").innerHTML='<div class="alert alert-success text-center animated flipInX"><strong style="font-size: 14.4px;">ERROR: </strong>The code you entered is incorrect, please try again!</div>';
								} else if(response == "SUCCESS") {
									document.getElementById("respone").innerHTML='<div class="alert alert-success text-center animated flipInX">SUCCESS: </strong>Verification successful, redirecting you to the login page!</div>';
									document.getElementById("doVerify").disabled = true;
									window.setInterval(function(){
										window.location	= "login"
                     				}, 5000);
								}
								
        					}
        				}
						if(!captcha) {
							document.getElementById("respone").innerHTML='<div class="alert alert-success text-center animated flipInX" >ERROR: </strong> Please fill in all fields!</div>';
						} else {
							xmlhttp.open("POST","assets/backend/doVerify",true);
							xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							xmlhttp.send("captcha=" + captcha);
						}
        			}
			</script>
      </main>
      <script src="admin/assets/js/core/jquery.min.js"></script>
      <script src="admin/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
      <script src="admin/assets/js/plugins/sweetalert2/es6-promise.auto.min.js"></script>
      <script src="admin/assets/js/plugins/sweetalert2/sweetalert2.min.js"></script>
      <script src="/adminassets/js/codebase.min.js"></script>
   
</body></html>