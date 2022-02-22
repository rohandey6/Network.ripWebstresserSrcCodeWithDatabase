<?php
   $themeload = true;
   $page = 'Add Funds';
   
   include 'assets/backend/header.php';
   
   	?>
            <br>
			
          
          <!-- Container-fluid starts-->
          <div class="container-fluid">
		  
			  
			  
		  
		  
            <div class="row second-chart-list third-news-update">
			 
			  <div class="col-sm-12 col-xl-5 box-col-7">
                <div class="card">
                  <div class="card-header   bg-primary">
                    <h5>Add Funds </h5>
                  </div>
                  <div class="card-body">
					  
					 
                        <form class="theme-form">
						<div class="col-xs-12">
                          <div class="form-group">
                            <label class="col-form-label pt-0" for="exampleInputEmail1">Amount</label>
                             <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter the amount you'd like to add">
                  
                          </div>
						   </div>
						   <div class="col-xs-12">
						   <div class="form-group">
                            <label for="port">Coin</label>
                             <select class="form-control" type="text" id="coin" name="coin">
							<option value="select">Select</option>
							<option value="BTC">Bitcoin</option>
							<option value="ETH">Ethereum</option>
							<option value="XMR">Monero</option>
							</select>
                  
                          </div>
						  </div>
						  
					
						  
                         
                        </form>
                      </div>
					  <div class="card-footer">
					   <div class="col-xs-12">
                           <button type="button" class="btn btn-success min-width-125 mb-10" onclick="generate()"><i class="fa fa-wallet"></i> Add</button> 
                  </div>
						
                    </div>
                </div>
              </div>
<div class="col-sm-12 col-xl-7 box-col-7">
                <div class="card">
                  <div class="card-header   bg-primary">
                    <h5>Transaction History </h5>
                  </div>
                  <div class="card-body">
                     <div id="Transfers"><div class="loader-box">
                        <div class="loader-37">       </div>
                      </div></div>
			  <script type="text/javascript">
			  var auto_refresh = setInterval(
			  function ()
			  {
				$('#Transfers').load('assets/backend/addfunds.php?action=get_transfers').fadeIn("slow");
			  }, 5000);
			</script>
                  </div>
                </div>
              </div>
	<center>		  
<div class="modal fade show" id="transaction" tabindex="-1" role="dialog" aria-labelledby="modal-popout" style="display: none;">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content animated bounceIn">
               <div class="modal-header bg-primary">
                  
                   <h5 class="modal-title text-center"> Transaction Generated <i class="fad fa-spinner fa-spin"></i></h5><bb id="getTime" class="float-right text-warning text-warning badge" style="background: #00000024;"> 0</bb>
                  
               </div>
               <div class="modal-body text-center">
			   <i class="fad fa-circle-notch fa-spin fa-3x font-primary"></i>
			   <br>
                 
                  After the payment the funds will be in your account in minutes. <br><br>
				  <span style="font-size: 15px">Please send  <bb id="getCoin"> BTC</bb>: </span>
		<input class="form-control" id="getAmount" type="text" value="" readonly="" onclick="copyToClipboard('#p1')">
                   <span style="font-size: 15px">To the Address: </span>
		<input class="form-control" id="getAddress" type="text" value="" readonly="" onclick="copyToClipboard('#p2')">
                  
                  <br><br>
                  <div class="row">
                     <div class="col-md-2"></div>
                     <div class="col-md-8" style="text-align: center !important;">
                        <div class="progress push">
                           <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                              <span class="progress-bar-label" style="
                                 text-shadow: -2px 0 5px black;
                                 ">Waiting for your payment.</span>
                           </div>
                        </div>
                        
                     </div>
                  </div>
				  <br><br>
		<button type="button" class="btn btn-primary float-left" onclick="copyToClipboard()">Copy address</button>
		<button type="button" class="btn btn-secondary float-right" onclick="copyToClipboard2()">Copy Amount</button>
                  </br>
               </div>
			   <div class="modal-footer">
            <div class="col-md-12 text-center">
					  <button type="submit" class="btn btn-success" id="privateMessageBtn" onclick="document.getElementById('transaction').style.display = 'none';"><i class="fa fa-check"></i> Ok!</button>
				   </div>
         </div>
		 </div>
      </div>
   </div></center>
			  
             
            </div>
          </div>
          <!-- Container-fluid Ends-->
       </div>
	   </div>
	   	    <script> 
			 function copyToClipboard() {
  var btcaddr = document.getElementById("getAddress");
  btcaddr.disabled = false;
  btcaddr.select();
  document.execCommand("copy");
  swal('BTC Address Copied', 'Done', 'success');
  btcaddr.disabled = true;
}</script>
	  
	     <script> 
			 function copyToClipboard2() {
  var btcaddr = document.getElementById("getAmount");
  btcaddr.disabled = false;
  btcaddr.select();
  document.execCommand("copy");
  swal('BTC Amount Copied', 'Done', 'success');
  btcaddr.disabled = true;
}</script>
   <script>
   function generate() {
			var amount=$('#amount').val();	
			var coin=$('#coin').val();
			
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
					
					if(respone == "ERROR:INVALID") {
						swal('Opps', 'ERROR: No letters acepted', 'error')
					}else if(respone == "ERROR:LOW") {
						swal('Opps', 'ERROR: Please put a higher number', 'error')
					}
					
					if(respone.indexOf("GENERATED_") >= 0) {
						var data = respone.split("_");
								//$("#getAddress").text(data[1]);
								document.getElementById("getAddress").value = data[1];
								//$("#getAmount").text(data[2]);
								document.getElementById("getAmount").value = data[2];
								$("#getCoin").text(data[5]);
								document.getElementById("transaction").style.display = "block";
										var myTimer;
	function clock() {
    myTimer = setInterval(myClock, 1000);
    var c = data[3]; //Initially set to 1 hour


    function myClock() {
        --c
        var seconds = c % 60; // Seconds that cannot be written in minutes
        var secondsInMinutes = (c - seconds) / 60; // Gives the seconds that COULD be given in minutes
        var minutes = secondsInMinutes % 60; // Minutes that cannot be written in hours
        var hours = (secondsInMinutes - minutes) / 60;
        // Now in hours, minutes and seconds, you have the time you need.
        console.clear();
        document.getElementById("getTime").innerHTML = hours + "H, "
		+ minutes + "M, " + seconds + "S left";
        if (c == 0) {
            clearInterval(myTimer);
        }
    }
}

clock();
						$('#Transfers').load('assets/backend/addfunds.php?action=get_transfers').fadeIn("slow");
					} else{
						
					}
				}
			}
			
			if(!amount || !coin || coin == 'select') {
				swal('Opps', 'ERROR: Please fill in all fields!', 'error')
			} else {
			xmlhttp.open("POST","assets/backend/addfunds.php?action=generate" ,true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("amount=" + amount + "&coin=" + coin);
			}
		}
		 $('#Transfers').load('assets/backend/Wallet.php?action=get_transfers').fadeIn("slow");
	</script>
   
</main>
<?php require_once 'assets/backend/footer.php'; ?>
   