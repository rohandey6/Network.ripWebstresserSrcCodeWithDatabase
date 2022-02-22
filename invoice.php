<?php
   $themeload = true;
   $page = 'Invoice';
   ini_set("display_errors", "Off");
   include 'assets/backend/header.php';
   $id = htmlspecialchars(htmlentities($_GET['id']));
   $conc = htmlspecialchars(htmlentities($_GET['concurrents']));
   $sec = htmlspecialchars(htmlentities($_GET['seconds']));
   $threads = htmlspecialchars(htmlentities($_GET['threads']));
   $api = htmlspecialchars(htmlentities($_GET['api']));
   if(!empty($id)) {
   		if(!is_numeric($id) && $id !== "Blacklist") {
   			die('<script>window.location="store";</script>');
   		}
   }
   
   	
    $GetInfo = $odb -> query("SELECT * FROM `users` WHERE `username`= '" . $_SESSION['username'] . "'");
    $userInfo = $GetInfo ->fetch(PDO::FETCH_ASSOC); 
    
    $SQL = $odb -> prepare("SELECT COUNT(*),`planID`,`btc-address` FROM `payments` WHERE `invoiceID` = :invid AND `status` != '2'");
    $SQL -> execute(array(':invid' => htmlentities($_GET['number'])));
    $rowPlani = $SQL ->fetch(PDO::FETCH_ASSOC); 
    if(empty($_GET['number']) || $rowPlani['COUNT(*)'] == '0') {
   	$rand = rand(1111111,9999999);		
       $GetPlanInfo = $odb -> prepare("SELECT *,COUNT(*) FROM `plans` WHERE `id`= :id");
	   $GetPlanInfo->execute(array(":id" => $id));
       $planInfo = $GetPlanInfo ->fetch(PDO::FETCH_ASSOC); 
   
   	 if($planInfo['COUNT(*)'] == '0' && $id !== 'Blacklist') {
   		die('<script>window.location = "store"</script>');
   	 } else {	
   		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `payments` WHERE `username` = :username AND `status` = '0'");
   		$SQL -> execute(array(':username' => $_SESSION['username']));
   		$Payments = $SQL ->fetch(PDO::FETCH_ASSOC); 
   			if(5 <= $Payments['COUNT(*)']) {
   				die('<script>window.location = "store?error=spam";</script>');
   			} else {		 
   			 if($id == "Blacklist") {
   				 $host = htmlentities($_GET['host']);
   				 if(empty($host)) {
   					 die('<script>window.location = "store?error=host";</script>');
   				 }
   				
   				if (!(preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", $host)) && !(preg_match('/^[-a-z0-9]+\.[a-z]{2,6}$/', $host))){
   					 die('<script>window.location = "store?error=host";</script>');
   				}
   	
   				 if($_GET['lifetime'] == '1' && $_GET['panel'] == '1') {
   					$expireBlacklist = "Lifetime";
   					$panel = '1';
   					$cost = '300';
   				 } elseif($_GET['month'] == '1' && $_GET['panel'] == '1') {
   					 $expireBlacklist = "Monthly";
   					 $panel = '1';
   					$cost = '25';
   				 } elseif($_GET['lifetime'] == '1' && $_GET['panel'] == '0') {
   					$expireBlacklist = "Lifetime";
   					$panel = '0';
   					$cost = '200';
   				 } elseif($_GET['month'] == '1' && $_GET['panel'] == '0') {
   					 $expireBlacklist = "Monthly";
   					 $panel = '0';
   					$cost = '15'; 
   				 } else {
   					 die('<script>window.location = "store"</script>');
   				 }
   				 
   				 $id = "Blacklist_" . $expireBlacklist . "_" . $host . "_" . $panel . "_" . $cost;
   				 
   			 }
   $cprice = $conc*35;
   $sprice = $sec*10;
   $tprice = $threads*20;
   $aprice = $api*40;
   $extraprice = $cprice+$sprice+$tprice+$aprice;
   			 $btc = btc("new_address", "label=Order No : #" . $rand, "address");
   			 $InsertSQL = $odb -> prepare("INSERT INTO `payments`(`ID`, `IP`, `planID`, `invoiceID`, `status`, `btc-address`, `username`, `date`, `e_concu`, `e_sec`, `e_threads`, `api`,`eprice`) VALUES (NULL, :IP, :planID,:invoiceID,'0',:btc,:username,UNIX_TIMESTAMP(NOW()),:concu,:sec,:threads,:api,:eprice)");
   			 $InsertSQL -> execute(array(':IP' => htmlentities($_SESSION['ip']),':planID' => $id, ':invoiceID' => $rand, ':btc' => $btc, ':username' => $_SESSION['username'], ':concu' => $conc, ':sec' => $sec, ':threads' => $threads, ':api' => $api, ':eprice' => $extraprice));	
   			 die("<script>window.location = 'invoice?number=" . $rand . "'</script>");
   			}
   	 }
   	 
    } else {
   	$rand = htmlentities($_GET['number']);
   	if(!is_numeric($rand)) {
   		die("<script>window.location = 'store';</script>");
   	}
   	$_SESSION['invoiceID'] = $rand;
       if(strpos($rowPlani['planID'], "Blacklist") === false) {
       $GetPlanInfo = $odb -> query("SELECT *,COUNT(*) FROM `plans` WHERE `id`= '" . htmlentities($rowPlani['planID']) . "'");
       $planInfo = $GetPlanInfo ->fetch(PDO::FETCH_ASSOC); 
   	} else {
   		$row = explode("_", $rowPlani['planID']);
   	}
    }	
   $GetPricesInfo = $odb -> query("SELECT *,COUNT(*) FROM `payments` WHERE `invoiceID`= '" . htmlentities($_GET['number']) . "'");
   $priceInfo = $GetPricesInfo ->fetch(PDO::FETCH_ASSOC); 
   $cprice = $priceInfo['e_concu']*35;
   $sprice = $priceInfo['e_sec']*10;
   $tprice = $priceInfo['e_threads']*20;
   $aprice = $priceInfo['api']*40;
   $globalprice = $planInfo['price']+$cprice+$sprice+$tprice+$aprice;
   
   if($priceInfo['api'] == 1){
	   $apia = "Yes";
   }else{
	   $apia = "No";
   }
   
   				
				$SQLGetInfo = $odb -> prepare("SELECT * FROM `users` WHERE `id` = :id");
$SQLGetInfo -> execute(array(':id' => $userid));
$userData = $SQLGetInfo -> fetch(PDO::FETCH_ASSOC);

 if($row[0] == "Blacklist") {
                              	$globalprice =$row[4];
                              }
   	?>
    <br>
 <div class="container-fluid">
		  
		  
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="invoice">
                      <div>
                        <div>
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="media">
                                <div class="media-left"><i class="fad fa-terminal font-primary fa-3x"> </i></div>
                                <div class="media-body m-l-20">
                                  <h4 class="media-heading">Network.rip</h4>
                                  <p>support@network.rip<br></p>
                                </div>
                              </div>
                              <!-- End Info-->
                            </div>
                            <div class="col-sm-6">
                              <div class="text-md-right">
                                <h3>Invoice #<span class="digits counter"><?= $rand; ?></span></h3>
                              </div>
                              <!-- End Title-->
                            </div>
                          </div>
                        </div>
                        <hr>
                        <!-- End InvoiceTop-->
						
                        <div class="row">
                          <div class="col-md-4">
                            <div class="media">
                              <div class="media-left"><img class="media-object rounded-circle img-60" src="<?php echo $userData['avatar']; ?>" alt=""></div>
                              <div class="media-body m-l-20">
                                <h4 class="media-heading"><?= $_SESSION['username']; ?></h4>
								 <p><?= $userData['email']; ?><br><span class="digits">User ID: <?= $userData['id']; ?></span></p>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="text-md-right" id="project">
                              <h6>Important</h6>
                              <p>By buying our products You agree to the <a class="text-danger" href="tos">Terms Of Service</a></p>
                            </div>
                          </div>
                        </div>
						<br>
                        <!-- End Invoice Mid-->
                        <div>
                          <div class="table-responsive invoice-table" id="table">
                            <table class="table table-bordered table-striped">
                              <tbody>
                                <tr>
                                  <td class="item">
                                    <h6 class="p-2 mb-0">Item</h6>
                                  </td>
                                  <td class="Hours">
                                    <h6 class="p-2 mb-0">Amount</h6>
                                  </td>
                                  <td class="Rate">
                                    <h6 class="p-2 mb-0">Unit</h6>
                                  </td>
                                  <td class="subtotal">
                                    <h6 class="p-2 mb-0">Sub-total</h6>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <label><?php
                              if($row[0] == "Blacklist") {
                              	echo '<p class="font-w600 mb-5" style="background-color: transparent;">Blacklist ' . $row[1] . '</p>';
                              } else {
                              	echo '<p class="font-w600 mb-5" style="background-color: transparent;">'. $planInfo['name'] . ' Plan.</p>';
                              }
                              ?></label>
                                     <p class="m-0"> <?php
                              if($row[0] !== "Blacklist") {
                              	if($planInfo['network'] == "normal") {
                              		$vipAccess = '<bb class="text-danger">No</bb>';
                              	} else {
                              		$vipAccess = '<bb class="text-success">Yes</bb>';
                              	}
                              }
                              ?>
                           <?php
                              if($row[0] == "Blacklist") {
                              	if($row[3] == '1') {
                              		$blacklist = '<bb class="text-success">Yes</bb>';
                              	} else {
                              		$blacklist = '<bb class="text-danger">No</bb>';
                              	}
                              	echo '<div class="text-muted">Blacklist host for <bb class="text-warning">' . $row[2] . '</bb>, Panel blacklist: ' . $blacklist . '.</div>';
                              } else {
                              ?>
                           <div class="text-muted">
                              Max boot time: 
                              <bb class="text-primary"><?= $planInfo['maxboot']; ?></bb>
                              , Concurrents: 
                              <bb class="text-primary"><?= $planInfo['cons']; ?></bb>
                              , VIP Access: <?= $vipAccess; ?>, Length: 
                              <bb class="text-warning"><?= $planInfo['length']; ?></bb>
                              .
                           </div>
                           <?php
                              }
                              ?></p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits text-right">1</p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits text-right"><?php
                           if($row[0] == "Blacklist") {
                           echo '$' . $row[4];
                           } else {
                           echo '$' . $planInfo['price'];
                           	  
                           }
                           ?></p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits text-right"><?php
                           if($row[0] == "Blacklist") {
                           echo '$' . $row[4];
                           } else {
                           echo '$' . $planInfo['price'];
                           	  
                           }
                           ?></p>
                                  </td>
                                </tr>
								<?php
                              if($row[0] !== "Blacklist") {
                              	
                               
                              ?>
                                <tr>
                                  <td>
                                    <label>Extra Concurrents</label>
                                    <p class="m-0 text-muted">Increase the amout of simultaneous attacks you are allowed to send</p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits text-right"><?= $priceInfo['e_concu']; ?></p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits text-right">$35</p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits text-right">$<?= $cprice; ?></p>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <label>Extra Seconds</label>
                                    <p class="m-0 text-muted">Increase the time you are allowed to hold a target</p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits text-right"><?= $priceInfo['e_sec']; ?></p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits text-right">$10</p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits text-right">$<?= $sprice; ?></p>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <label>Extra Threads</label>
                                    <p class="m-0 text-muted">Increase the amout of threads for each attack you send</p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits text-right"><?= $priceInfo['e_threads']; ?></p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits text-right">$20</p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits text-right">$<?= $tprice; ?></p>
                                  </td>
                                </tr>
                                 <tr>
                                  <td>
                                    <label>API Access</label>
                                     <p class="m-0 text-muted">Enable the API Access in your account</p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits text-right"><?= $apia; ?></p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits text-right">$40</p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits text-right">$<?= $aprice; ?></p>
                                  </td>
                                </tr>
								<?php
                             
							  }
                              ?>
							  <tr>
                                  <td></td>
                                  <td></td>
                                  <td class="Rate">
                                    <h6 class="mb-0 p-2">Dicount</h6>
                                  </td>
                                  <td class="payment digits text-right" id="totalDiscount">0%</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td class="Rate">
                                    <h6 class="mb-0 p-2">Total</h6>
                                  </td>
                                  <?php
                           if($row[0] == "Blacklist") {
                           echo '<td class="payment digits text-right" id="totalDue">$' . $row[4] .'</td>';
                           } else {
						   echo '<td class="payment digits text-right" id="totalDue">$' . $globalprice .'</td>';
                           	  
                           }
                           ?>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <!-- End Table-->
						  <br>
                          
						  <center>
                            <div class="col-md-5">
							<div class="form-group">
                            
                            <div class="input-group mb-4">
                              <input class="form-control" type="text" placeholder="Enter a coupon" aria-label="Recipient's username" id="couponText">
                              <div class="input-group-append"><button onclick="checkCoupon()" class="btn btn-sm btn-success" id="couponBtn"><i class="fa fa-tags"></i> Enable coupon</button></div>
                            </div>
                          </div>
            
                            </div>
							</center>
                         
                        </div>
                        <!-- End InvoiceBot-->
                      </div>
                      <div class="col-sm-12 text-center mt-3">
					 
                        <button class="btn btn btn-info mr-2" type="button" onclick="myFunction()">Print</button>
                       <button class="btn btn-primary mr-2" type="button" data-toggle="modal" data-target="#basic"><i class="fa fa-credit-card text-success"></i> Buy</button>
						<button class="btn btn btn-danger mr-2" type="button" onclick="CancelInvoice()">Cancel</button>
					</div>
                      <!-- End Invoice-->
                      <!-- End Invoice Holder-->
                    </div>
					
					
					<div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="exampleModalLabel2">Account Verification</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
							<p class="text-center"> In order to buy need verify your account</p>
							<div class="form-group">
                     <label for="example-nf-email">4 Digits numbers:</label>
                     <input type="password" class="form-control" maxlength="4" id="4digits">
                  </div>
                     <div class="col-md-12 text-right">
                     <center><button type="submit" class="btn btn-success" onclick="buyviaMyWallet()"><i class="fa fa-check"></i> Buy via my Wallet</button></center>
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
          <!-- Container-fluid Ends-->
       </div>
	   </div>
	      <script>
      var auto_refresh = setInterval(
        function ()
        {
      			if (window.XMLHttpRequest) {
      				xmlhttp = new XMLHttpRequest();
      			}
      			else {
      				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      			}
      			xmlhttp.onreadystatechange = function(){
      				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      					var Respone = xmlhttp.responseText;
      					var res = Respone.split("_");
      					if (res[2] == "2") {
      						setTimeout(function() {
      							window.location.replace('hub');
      						}, 5000)
      						swal('Order successfully!', 'The order has been placed to your account, Thank you for choosing us, you can to use with our service now, Redirecting you to the hub page in 5 seconds.', 'success')
      					} else {
      						document.getElementById("last_checking").innerText = res[0];
      						document.getElementById("next_checking").innerText = res[1];
      					}
      				}
      			}
      			xmlhttp.open("GET","invoice?payment=status",true);
      			xmlhttp.send();
      			
        }, 15000);
   </script>
   <script>
      <?php
         if ($_COOKIE['gift'] == "Yes") {
         	?>
      	$('#couponText').val('<?= $_COOKIE['giftCoupon']; ?>');
      	<?php
         } else {
         ?>
      $('#couponText').val(" ");
      <?php
         }
         ?>
      
      	function checkCoupon() {
      				
      			var couponCode=$('#couponText').val();
      			
      			if (window.XMLHttpRequest) {
      				xmlhttp = new XMLHttpRequest();
      			}
      			else {
      				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      			}
      			xmlhttp.onreadystatechange = function(){
      				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      					if (xmlhttp.responseText == "Coupon expire or not valid") {
      						swal('ERROR', xmlhttp.responseText, 'error')
      					} else {
      						if($('#couponBtn').html() == '<i class="fa fa-tags"></i> Enable coupon') {
      						swal('Coupon added Successfully', 'Coupon activated successfully, You received ' + xmlhttp.responseText + '% Discount!', 'success')
      						$("#couponBtn").html('<i class="fa fa-tags"></i> Disable coupon');  
      						$("#couponBtn").removeClass("btn-success");
      						$("#couponBtn").addClass("btn-danger");
      						$("#totalDiscount").html(xmlhttp.responseText + '%'); 
      						var totalDue = <?= $globalprice; ?> - (<?= $globalprice; ?> * (xmlhttp.responseText / 100));
      						$("#totalDue").html('$' + totalDue);  
      						} else {
      						swal('Coupon removed!', 'Coupon has been removed', 'success')
      						$("#couponBtn").html('<i class="fa fa-tags"></i> Enable coupon');  
      						$("#couponBtn").addClass("btn-success");
      						$("#couponBtn").removeClass("btn-danger");
      						$("#totalDiscount").html('0%');  
      						$("#totalDue").html('$<?= $globalprice; ?>');  
      						$('#couponText').val(" ");
      						}
      
      					}
      				}
      			}
      			
      			if($('#couponBtn').html() == '<i class="fa fa-tags"></i> Disable coupon') {
      			xmlhttp.open("GET","assets/backend/checkCoupon.php?coupon=" + couponCode + "&disable=1",true);
      			xmlhttp.send();
      			} else {
      			xmlhttp.open("GET","assets/backend/checkCoupon.php?coupon=" + couponCode,true);
      			xmlhttp.send();
      			}
      		}
      		
      			function buyviaMyWallet() {
      				
      			var couponCode=$('#couponText').val();
      			var pin=$('#4digits').val();
      			if (window.XMLHttpRequest) {
      				xmlhttp = new XMLHttpRequest();
      			}
      			else {
      				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      			}
      			xmlhttp.onreadystatechange = function(){
      				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      
      				if (xmlhttp.responseText == "ERROR:NOT_MONEY") {
      					swal('Order Failed!', 'Please check your account balance if you got the correct balance but you still can\'t make an order please contact us via ticket.', 'error')
      				} else if(xmlhttp.responseText == "ERROR:4_DIGITS") {
      					swal('Order Failed!', 'Your 4 digits are incorrect, please try again.', 'error')
      				} else if(xmlhttp.responseText == "SUCCESS:CANCELED") {
      					swal('Order Canceled!', 'Your Order was Canceled, Redireting...', 'error')
						setTimeout(function() {
                              window.location.replace('payments');
                          }, 5000)
      				}else {
      					<?php if($row[0] != 'Blacklist') { ?>
      					setTimeout(function() {
                              window.location.replace('hub');
                          }, 5000)
      					swal('Order successfully!', 'The order has been placed to your account, Thank you for choosing us, you can to use with our service now, Redirecting you to the hub page in 5 seconds.', 'success')
      					<?php } else { ?>
      					setTimeout(function() {
                              window.location.replace('blacklistpanel');
                          }, 5000)
      					swal('Order successfully!', 'The order has been placed to your account, Thank you for choosing us, Redirecting you to the blacklist panel page in 5 seconds.', 'success')
      					<?php } ?>
      				}
      
      					}
      				}
      			
      			<?php if($row[0] != 'Blacklist') { ?>
      			if(couponCode == null || couponCode == " " || $('#couponBtn').html() == '<i class="fa fa-tags"></i> Enable coupon') {
      			xmlhttp.open("GET","assets/backend/Wallet.php?invoiceid=<?= $rand; ?>&pin=" + pin + "&action=purchase_plan",true);
      			} else {
      			xmlhttp.open("GET","assets/backend/Wallet.php?invoiceid=<?= $rand; ?>&coupon=" + couponCode + "&pin=" + pin + "&action=purchase_plan",true);
      			}
      			xmlhttp.send();
      			<?php } else { ?>
      			if(couponCode == null || couponCode == " " || $('#couponBtn').html() == '<i class="fa fa-tags"></i> Enable coupon') {
      			xmlhttp.open("GET","assets/backend/Wallet.php?invoiceid=<?= $rand; ?>&pin=" + pin + "&action=purchase_plan",true);
      			} else {
      			xmlhttp.open("GET","assets/backend/Wallet.php?invoiceid=<?= $rand; ?>&coupon=" + couponCode + "&pin=" + pin + "&action=purchase_plan",true);
      			}
      			xmlhttp.send();
      			<?php } ?>
      			}
				
      		
      		
			 function CancelInvoice() {
                    swal({
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-success m-5",
                        cancelButtonClass: "btn btn-danger m-5",
                        inputClass: "form-control",
                        title: "Cancel invoice",
                        text: "Are you sure you want to cancel this invoice?",
                        type: "warning",
                        showCancelButton: !0,
                        confirmButtonColor: "#d26a5c",
                        confirmButtonText: "Yes, do it!",
                        html: !1,
                        preConfirm: function() {
                            return new Promise(function(n) {
                                setTimeout(function() {
                                    n()
                                }, 50)
                            })
                        }
                    }).then(function(n) {
                       if (window.XMLHttpRequest) {
      				xmlhttp = new XMLHttpRequest();
      			}
      			else {
      				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      			}
      			xmlhttp.onreadystatechange = function(){
      				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      
      				 if(xmlhttp.responseText == "SUCCESS:CANCELED") {
						 swal('Order Canceled!', 'Your order was canceled, redireting...', 'success');
						setTimeout(function() {
                              window.location.replace('payments')
                          }, 5000)
      				} else {
      					swal('Error!', 'An Unknown Error Has Occurred', 'error')
      				}
      
      					}
      				}
      			
      			<?php if($row[0] != 'Blacklist') { ?>
      			xmlhttp.open("GET","assets/backend/Wallet.php?invoiceid=<?= $rand; ?>&action=cancel",true);
      			xmlhttp.send();
      			<?php } else { ?>
      			xmlhttp.open("GET","assets/backend/Wallet.php?invoiceid=<?= $rand; ?>&action=cancel",true);
      			xmlhttp.send();
      			<?php }  ?>
					   
                    }, function(n) {})

                }
      		
   </script>
<?php require_once 'assets/backend/footer.php'; ?>
