<?php
   $themeload = true;
   $page = 'Transfer Money';
   
   include 'assets/backend/home.php';
   
   	?>
            <br>
			
          
          <!-- Container-fluid starts-->
          <div class="container-fluid">
		  
			  
			  
		  
		  
            <div class="row second-chart-list third-news-update">
			 
			  <div class="col-sm-12 col-xl-6 box-col-7">
                <div class="card">
                  <div class="card-header   bg-primary">
                    <h5>Transfer Money </h5>
                  </div>
                  <div class="card-body">
					  
					 
                        <form class="theme-form">
						<div class="col-xs-12">
                          <div class="form-group">
                            <label class="col-form-label pt-0" for="exampleInputEmail1">Name</label>
                             <input type="text" class="form-control" id="username" name="username" placeholder="Enter the username you want to send the money to.">
                  
                          </div>
						   </div>
						   <div class="col-xs-12">
						   <div class="form-group">
                            <label for="port">Amount to send</label>
                             <input type="number" class="form-control" id="money-to-send" name="money-to-send" placeholder="Enter the amount you'd like to send">
                  
                          </div>
						  </div>
						  
						   <div class="col-xs-12">
						     <div class="form-group">
                     <label for="example-nf-email">Date</label>
                     <div class="row">
                        <div class="col-md-4">
						<div class="media">
                          <label class="col-form-label m-r-10">Now:</label>
						  <div class="media-body text-left icon-state">
                          <label class="switch">
                     <input type="checkbox" id="TimeToSend" onChange="checkDate()" name="ecom-product-published" checked="">
                    <span class="switch-state"></span>
                     </label>
                        </div>
						</div>
						</div>
						<div class="col-md-8">
                           <input type="text" class="datepicker-here form-control digits" disabled id="datepicker" name="datepicker" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy" style="border: 1px solid #cd3c3c;" data-language="en">
                        </div>
					<script>
					function checkDate() {
						var check = $("#TimeToSend").is(":checked");
						if(check == true) {
							document.getElementById("datepicker").disabled = true;
							document.getElementById("datepicker").style.border = "1px solid #cd3c3c";
						} else {
							document.getElementById("datepicker").disabled = false;
							document.getElementById("datepicker").style.border = "1px solid #9ccc65";
						}
					}
					</script>
                        
                     </div>
                  </div>
						  </div>
                          <div class="col-xs-12">
						  <div class="form-group">
                     <label for="example-nf-email">From</label>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="media">
                          <label class="col-form-label m-r-10">Hidden:</label>
						  <div class="media-body text-left icon-state">
                             <label class="switch">
                     <input type="checkbox" id="MoneyFrom" name="MoneyFrom" onclick="checkFrom()">
                    <span class="switch-state"></span>
                     </label>
                        </div>
						</div>
						</div>
                        <div class="col-md-8">
                           <input type="text" class="form-control" id="from" name="from" placeholder="Anonymous" disabled="" style="border: 1px solid #cd3c3c;">
                        </div>
                     </div>
                  </div>
						  </div>
						  <script>
					function checkFrom() {
						var check = $("#MoneyFrom").is(":checked");
						if(check == true) {
							document.getElementById("from").disabled = false;
							document.getElementById("from").style.border = "1px solid #9ccc65";
						} else {
							document.getElementById("from").disabled = true;
							document.getElementById("from").style.border = "1px solid #cd3c3c";
						}
					}
					</script>
						  
						  
					  <div class="col-xs-12">
						<div class="form-group row">
                     <div class="col-md-9"><label for="example-nf-email">Message</label>
                        <textarea class="form-control" id="content" rows="4" dir="ltr"></textarea>
                     </div>
                     <div class="col-md-3 row mt-25 text-right" style="
                        margin-top: 25px !important;
                        ">
                        <div class="col-md-6"><button type="button" class="btn btn-xs  btn-outline-warning" onclick="document.getElementById('content').value += '(D)'">😁</button> </div>
                        <div class="col-md-6"><button type="button" class="btn btn-xs  btn-outline-warning ml-1" onclick="document.getElementById('content').value += '(P)'">😄</button></div>
                        <div class="col-md-6"><button type="button" class="btn btn-xs  btn-outline-warning" onclick="document.getElementById('content').value += '(L)'">😍</button> </div>
                        <div class="col-md-6"><button type="button" class="btn btn-xs  btn-outline-warning ml-1" onclick="document.getElementById('content').value += '(K)'">😘  </button></div>
                        <div class="col-md-6"><button type="button" class="btn btn-xs  btn-outline-warning" onclick="document.getElementById('content').value += '(M)'">🤑</button> </div>
                        <div class="col-md-6"><button type="button" class="btn btn-xs  btn-outline-warning ml-1" onclick="document.getElementById('content').value += '(W)'">🤩</button></div>
                     </div>
                  </div>
						</div>
					
						  
                         
                        </form>
                      </div>
					  <div class="card-footer">
					   <div class="col-xs-12">
                           <button type="button" class="btn btn-success min-width-125 mb-10" data-toggle="modal" data-target="#verify" ><i class="fa fa-rocket"></i> Send Money</button> 
                  </div>
						
                    </div>
                </div>
              </div>
<div class="col-sm-12 col-xl-6 box-col-7">
                <div class="card">
                  <div class="card-header   bg-primary">
                    <h5>Latests Transfers </h5>
                  </div>
                  <div class="card-body">
                     <div id="Transfers"><center><div class="loader-box">
                        <div class="loader-37">       </div>
                      </div></center></div>
			  <script type="text/javascript">
			  var auto_refresh = setInterval(
			  function ()
			  {
				$('#Transfers').load('assets/backend/Wallet.php?action=get_transfers').fadeIn("slow");
			  }, 5000);
			</script>
                  </div>
                </div>
              </div>
			  
			  <div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="exampleModalLabel2">Account Verification</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
						   <div class="form-group">
							<div id="statusRespone"></div>
							</div>
                  <p class="text-white text-center"> In order to make transfer need verify your account</p>
                  <div class="form-group">
                     <label for="example-nf-email">4 Digits numbers:</label>
                     <input type="password" class="form-control" maxlength="4" id="pin">
                  </div>
                  <div class="col-md-12 text-right">
                     <center><button type="submit" class="btn btn-success" onclick="makeMoneyTransfer()"><i class="fa fa-money"></i> Send</button></center>
                  </div>
                          </div>
                         
						  
                        </div>
                      </div>
                    </div>
             
            </div>
          </div>
          <!-- Container-fluid Ends-->
       </div>
	   </div>
   <script>
   function makeMoneyTransfer() {
			var touser=$('#username').val();	
			var pin=$('#pin').val();		
			var moneyToSend=$('#money-to-send').val();
			var timeToSend="";
			if($("#TimeToSend").is(":checked") == true) {
				timeToSend = "Now";
			} else {
				timeToSend= $('#datepicker').val();
			}
			var hidden="";
			if($("#MoneyFrom").is(":checked") == false) {
				hidden = "<?= $_SESSION['username']; ?>";
			} else {
				hidden=$('#from').val();
			}
			var content=$('#content').val();
			
			var xmlhttp;
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			}
			else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function(){
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					var respone = xmlhttp.responseText;
					document.getElementById("statusRespone").innerHTML = xmlhttp.responseText;
					
					if(respone.indexOf("SUCCESS") >= 0) {
						$('#Transfers').load('assets/backend/Wallet.php?action=get_transfers').fadeIn("slow");
					}
				}
			}
			
			if(!touser || !pin || !moneyToSend || !timeToSend || !hidden) {
				document.getElementById("statusRespone").innerHTML = '<div class="alert alert-danger animated flipInX"><center><i class="fa fa-times"></i> ERROR: Please fill in all fields! <i class="fa fa-times"></i></center></div>';
			} else {
			xmlhttp.open("POST","assets/backend/Wallet.php?action=transfer_money&pin=" + pin,true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("username=" + touser + "&moneysend=" + moneyToSend + "&timesend=" + timeToSend + "&from=" + hidden + "&content=" + content);
			}
		}
		 $('#Transfers').load('assets/backend/Wallet.php?action=get_transfers').fadeIn("slow");
	</script>
   
</main>
<?php require_once 'assets/backend/footer.php'; ?>
<script>
   jQuery(function () {
       Codebase.helpers(['datepicker']);
   });
</script>    