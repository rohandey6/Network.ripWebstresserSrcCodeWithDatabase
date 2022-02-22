<?php
$themeload = true;
$page = 'My Profile';

include 'assets/backend/header.php';
include 'assets/backend/bulletproof.php'; //upload security

$ip = realIP();

$ip_items = explode('.', $ip);

$filtered_ip = ''; //The var to store the filtered ip

foreach($ip_items as $item) {
  if($item == end($ip_items)) { //check if its the last part of the IP
    $ip_part = 'XXX';
  } else {
    $ip_part = $item . '.';
  }

$filtered_ip .= $ip_part;

}

$image = new Bulletproof\Image($_FILES);

if($image["pictures"]){
	
	if($_SESSION['vip'] == 'Yes'){
		//continuy my boy
	}else{
		$uploaderror = "You need VIP Rank in order to use this feature.";
	}
	if (empty($uploaderror)) {
	
  $upload = $image->upload(); 
  if($upload){
    $location = $upload->getFullPath(); // uploads/cat.gif
	
    $SQLUpdate = $odb -> prepare("UPDATE `users` SET `avatar`= :location WHERE `username` = :username");
	$SQLUpdate -> execute(array(':location' => $location,':username' => $_SESSION['username']));
	
	echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  type: "success",
  title: "<bb style=\"font-size:18px\">Success, New profile pic set!</bb>",
  showCloseButton: true,
  
});';
  echo ' }, 1000);</script>';
   echo ' <meta http-equiv="refresh" content="3;url=profile">' ;
  }else{
    $uploaderror = $image->getError(); 
  }
}
}

?>

            <br>
			
          
          <!-- Container-fluid starts-->
          <div class="container-fluid">
		  <div class="user-profile">
		  			    <?php
	if (!empty($uploaderror)) {
		echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  type: "error",
  title: "<bb style=\"font-size:18px\">'. $uploaderror. '</bb>",
  showCloseButton: true,
  
});';
  echo ' }, 1000);</script>';
	}
		  ?>
			  <div class="col-sm-12">
                  <div class="card hovercard text-center">
                    <div class="cardheader"></div>
                    <div class="user-image">
                      <div class="avatar"><img alt="" src="<?php echo $userData['avatar']; ?>"></div>
                      <div class="icon-wrapper"><i class="icofont icofont-pencil-alt-5" data-toggle="modal" data-target="#upload"></i></div>
					  
                    </div>
                    <div class="info">
                      <div class="row">
                        <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="ttl-info text-left">
                                <h6><bb class="text-warning">Max Boot Time</bb> <i class="fa fa-clock-o"></i></h6><span>[<bb class="text-primary"><?php echo $_SESSION['mbt']; ?></bb>]</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="ttl-info text-left">
                                <h6><bb class="text-warning">Concurrents</bb> <i class="fa fa-bolt"></i></h6><span>[<bb class="text-primary"><?php echo $_SESSION['concurrents']; ?></bb>]</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                          <div class="user-designation">
                            <div class="title"><a target="_blank" href=""><?php echo ucfirst($_SESSION['username']); ?></a></div>
							<?php
			   if($userData['rank'] == '10') {
				    $rankdesign = '<bb class="text-danger">Administrator</bb>';
			   }elseif($_SESSION['vip'] == 'Yes' && $hasPlan) {
				   $rankdesign = '<bb class="text-warning">VIP</bb>';
			   } elseif($_SESSION['vip'] == 'No' && $hasPlan) {
				    $rankdesign = '<bb class="text-success">Membership</bb>';
			   } else {
				    $rankdesign = '<bb class="text-gray">User</bb>';
			   }
			   ?>
                            <div class="desc mt-2"><?php echo $rankdesign; ?></div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="ttl-info text-left">
                                <h6><bb class="text-warning">Threads</bb> <i class="fa fa-code"></i></h6><span>[<bb class="text-primary"><?php echo $_SESSION['totalthreads']; ?></bb>]</span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="ttl-info text-left">
                                <h6><bb class="text-warning"> Max per day</bb> <i class="fa fa-bug"></i></h6><span>[<bb class="text-primary"><?php echo $userData['TestsDaily']; ?>/<?php echo $_SESSION['maxtests']; ?></bb>]</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>
					  <div class="social-media">
                        <ul class="list-inline">
                          <li class="list-inline-item"><button type="button" class="btn btn-sm btn-success " data-toggle="modal" data-target="#modal-updateProfile">
<i class="fa fa-pencil"></i> Update
</button></li>
                          <li class="list-inline-item"><button type="button" data-toggle="modal" data-target="#basic" class="btn btn-sm btn-danger">
<i class="fa fa-times"></i> Deactivate Profile
</button></li>
                        </ul>
                      </div>
                     
                    </div>
                  </div>
                </div>
				
				<div class="col-lg-12">
                    <div class="card">
					<div class="card-header  bg-primary">
                    <h5>History</h5>
                  </div>
                      <div class="card-body">
					  
                          
					  <div class="table-responsive">
					  <table class="table table-responsive-sm table-striped">
                        <thead>
                           <tr>
                  <th class="text-center" style="width: 50px;">Status</th>
				  <th class="text-center" style="width: 50px;">Password</th>
				  <th class="text-center" style="width: 50px;">Country</th>
				  <th class="text-center" style="width: 10px;">Date</th>
               </tr>
                        </thead>
                         <tbody>
               <?php
			   $getLogs = $odb->query("SELECT * FROM `login_history` WHERE `method` != 'System_Login' AND `username` = '" . $_SESSION['username'] . "' ORDER BY `id` DESC LIMIT 5;");
									while($row = $getLogs->fetch(PDO::FETCH_BOTH)){
										
										if($row['status'] == 'success' && $row['method'] == 'System_Logs') {
											$status = '<span class="badge badge-success">Login Successfully</span>';
										} elseif ($row['status'] == 'failed' && $row['method'] == 'System_Logs') {
											$status = '<span class="badge badge-danger">Login Failed</span>';
										} elseif ($row['status'] == 'success' && $row['method'] == 'System_Reinder') {
											$status = '<span class="badge badge-success">Password Changed</span>';
										} elseif ($row['status'] == 'failed' && $row['method'] == 'System_Reinder') {
											$status = '<span class="badge badge-danger">Password not changed</span>';
										}
									
						echo '
					<tr>
					<td class="text-center" style="width: 50px; padding: 5px;">' . $status . '</td>
					<td class="text-center" style="width: 50px; padding: 5px;">' . $row['password'] . '</td>
					<td class="text-center" style="width: 50px; padding: 5px;"><i class="flag-icon flag-icon-' . strtolower(htmlspecialchars(htmlentities($row['country']))) . '"></i></td>
					<td class="text-center" style="width: 50px; padding: 5px;"><span class="badge badge-primary text-white">' . date("d/m/y - h:i:s", $row['date']). '</span></td></tr>
				';
									}?>
            </tbody>
                     </table>
                        
                         </div>    
                            
						   
                      </div>
                    </div>
                  </div>
				  
				  <div class="modal fade" id="modal-updateProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="exampleModalLabel2">Update Profile</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
							<div id="statusRespone"></div>

<div class="form-group">
<label for="example-nf-email">Current Password</label>
<input type="password" class="form-control" id="cpassword"  name="cpassword" placeholder="to continue please enter the current password.">
</div>
<div class="form-group">
<label for="example-nf-email">PIN</label>
<input type="password" class="form-control" id="pin"  name="pin" maxlength="4" placeholder="to continue please enter the 4 digits numbers.">
</div>
<div class="dropdown-divider" style="border-top: 1px solid #3c8fd2;"></div>
</br>
<div class="form-group">
<label for="example-nf-email">New Password</label>
<input type="password" class="form-control" id="password" name="password" placeholder="Enter the new password you want">
<div class="row col-md-12">
<span id="password_bar" style="width: 0%;position: absolute;height: 3px;display: block;"></span>
<span id="password_error" class="mt-0" style="font-size: 12.5px;"></span>
</div>
</div>
<div class="form-group">
<label for="example-nf-email">Confrim new Password</label>
<input type="password" class="form-control" id="rpassword" name="rpassword" placeholder="Enter the new password again">
</div>
<div class="form-group">
<label for="example-nf-email">New Email</label>
<input type="email" class="form-control" id="nemail" name="nemail" placeholder="Enter the new email you want.">
</div>
</br>
<div class="col-md-12">
<center><button type="submit" class="btn btn-primary" onclick="Update()"><i class="fa fa-check"></i> Update</button></center>
</div>                      
                              
                              
							   
							   
                            
                          </div>
                          
						  
                        </div>
                      </div>
                    </div>
					
					<div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="exampleModalLabel2">Account Verification</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
							<div id="status4Digits"></div>
                  <p class="text-center"> In order to cancel your account need verify the ownership</p>
                  <div class="form-group">
                     <label for="example-nf-email">4 Digits numbers:</label>
                     <input type="password" class="form-control" maxlength="4" id="pinDelete">
                  </div>
                  <div class="col-md-12 text-right">
                     <center><button type="submit" class="btn btn-danger" onclick="cancel($('#pinDelete').val())"><i class="fa fa-times"></i> Deactivate Profile</button></center>
                  </div>
                          </div>
                         
						  
                        </div>
                      </div>
                    </div>
					
					<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="exampleModalLabel2">Image Uploader</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
						  <form class="form theme-form" method="POST" enctype="multipart/form-data"> 
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Upload File</label>
                            <div class="col-sm-9">
                               <input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
								<input type="file" name="pictures" accept="image/*"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                    <div class="card-footer">
                      <button class="btn btn-primary" type="submit">Submit</button>
                      <input class="btn btn-secondary" type="reset" value="Cancel">
                    </div>
                  </form>
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
			function Update() {
			var pin=$('#pin').val();		
			var cpassword=$('#cpassword').val();
			var npassword=$('#password').val();
			var rpassword=$('#rpassword').val();
			var nemail=$('#nemail').val();
			var xmlhttp;
			
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			}
			else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function(){
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("statusRespone").innerHTML = xmlhttp.responseText;
					
				}
			}

			xmlhttp.open("POST","assets/backend/updateProfile.php",true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("pin=" + pin + "&cpassword=" + cpassword + "&npassword=" + npassword + "&rpassword=" + rpassword + "&nemail=" + nemail);
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
						var strText = "Your password would take centuries to crack.";
						var strColor = "#0ca908";
					}
					else if (nScore >= 80)
					{
						var strText = "Your password would take 3 years to crack.";
						var strColor = "#008000";
					}

					else if (nScore >= 60)
					{
						var strText = "Your password would take 12 days to crack.";
						var strColor = "#006000";
					}
					else if (nScore >= 40)
					{
						var strText = "Your password would take 3 hours to crack.";
						var strColor = "#e3cb00";
					}
					else if (nScore >= 20)
					{
						var strText = "Your password would take 1 hour to crack.";
						var strColor = "#Fe3d1a";
					}
					else
					{
						var strText = "Your password would take less than a second to crack.";
						var strColor = "#e71a1a";
					}

					if(strPassword.length == 0)
					{
					password.style.border = "1px #3c8ccd solid";
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
<?php require_once 'assets/backend/footer.php'; ?>
<script>
function cancel(pin) {
swal.queue([{
  title: 'Cancel Account?',
  confirmButtonText: 'Yes',
  showCancelButton: true,
  text:
    'Are you sure you want to cancel your Account? ' +
    'Your account will permanently deleted, This action is "un-recoverable", And you may has no access to your account anymore!',
  showLoaderOnConfirm: true,
  preConfirm: function () {
    return new Promise(function (resolve) {
			var pin = $("#pinDelete").val();
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
					document.getElementById("status4Digits").innerHTML = xmlhttp.responseText;
					
					if(respone.indexOf("successfully canceled") >= 0) {
						window.location = "login";
					} else {
						document.getElementById("status4Digits").innerHTML = xmlhttp.responseText;
						resolve()
					}
					
				}
			}
			
			if(!pin) {
				
				resolve()
				document.getElementById("status4Digits").innerHTML = '<div class="alert alert-danger animated flipInX"><center><i class="fa fa-times"></i> ERROR: Please fill in all fields! <i class="fa fa-times"></i></center></div>';
			} else {
			xmlhttp.open("GET","assets/backend/cancel.php?pin=" + pin,true);
            xmlhttp.send();
			}
    })
  }
}])
}
</script>