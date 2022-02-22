<?php
	error_reporting(0);
	ini_set("display_errors", "Off");
   if($_GET['get'] == 'slots') {
	   require_once 'assets/backend/config.php';
	   $SQL = $odb -> query("SELECT `TestsDaily` FROM `users` WHERE `id` = '" . $_SESSION['ID'] . "'");
	   $TestsDaily = $SQL->fetchColumn(0);
	   
	   $max = $_SESSION['maxtests'] - $TestsDaily;
	   echo $max;
	   die();
   }
   
   $themeload = true;
   $page = 'Panel';
   
   include 'assets/backend/header.php';
   //if($userData['rank'] != '10') {
	//die(error("We are under maintaince we will be right back with new updates!"));
   //}
   //Get needed information
   $SQL = $odb -> query("SELECT COUNT(*) FROM `servers`");
   $online_servers = $SQL->fetchColumn(0);
   
   $SQL = $odb -> query("SELECT COUNT(*) FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 ");
   $running_attacks = $SQL->fetchColumn(0);
   
   if (!$hasPlan) {
     die('
     <script>
     location.replace("store");
     </script>
     ');
   }
   
	if($_SESSION['vip'] == 'Yes') {
		$column = 'vip_servers';
	} else {
		$column = 'normal_servers';
	}
   if($_SESSION['vip'] == "Yes"){
   $pps = 1000000;
   }elseif($hasPlan == true && $_SESSION['free'] !== true){
   $pps = 500000;
   }else{
   $pps = 250000;
   }
   ?>
            <br>
			
          
          <!-- Container-fluid starts-->
          <div class="container-fluid">
		  
	   <script type="text/javascript">
   
    var auto_refresh = setInterval(
    function ()
    {
     $('#attacksdiv').load('assets/backend/attacks.php');
    }, 60000);
   </script>
            <div class="row second-chart-list third-news-update">
				<?php
					if($userData['status'] == 2) {
												echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  type: "warning",
  title: "Account Status Warning",
  text: "Reason: ' . $userData['reason'] . '",
  showCloseButton: true,
  
});';
  echo ' }, 1000);</script>';

					}
					?>
			 <div class="col-md-5">
                    <div class="card">
                      <div class="card-header bg-primary">
                        <h5>Attack Hub</h5>
                      </div>
					  
                      <div class="card-body">
					  
					 
                        <form class="theme-form">
							<div class="col-xs-12">
						<div class="form-group">
							<div id="r3sponse"></div>
							</div>
								</div>
						<div class="col-xs-12">
						<div class="form-group">
                            
                            <select class="form-control" type="text" id="layer" name="layer" onclick="checkLayer()">
							<option value="select">Select</option>
							<option value="4">Layer 4</option>
							<option value="7">Layer 7</option>
							</select>
                          </div>
						</div>
						<div class="row">
						<div class="col-lg-7">
                          <div class="form-group animated fadeIn" id="hostl4" style="display: none;">
                            <label class="col-form-label pt-0" for="exampleInputEmail1">Host</label>
                            <input class="form-control" id="host4" name="host4" type="text" placeholder="0.0.0.0">
                          </div>
						   </div>
						   <div class="col-lg-5">
						   <div class="form-group animated fadeIn" id="portl4" style="display: none;">
                            <label for="port">Port</label>
                            <input class="form-control" id="port" name="port" type="text" placeholder="Ex: 80">
                          </div>
						  </div>
						   </div>
						   <div class="col-xs-12">
						   <div class="form-group animated fadeIn" id="sportl4" style="display: none;">
                            <label for="port">Source Port</label>
                            <input class="form-control" id="sport" name="sport" type="text" placeholder="0 for Random">
                          </div>
						  </div>
						   <div class="col-xs-12">
						    <div class="form-group animated fadeIn" id="hostl7" style="display: none;">
                            <label class="col-form-label pt-0" for="exampleInputEmail1">Host</label>
                            <input class="form-control" id="host7" name="host7" type="text" placeholder="https://example.com/">
                          </div>
						  </div>
                          <div class="col-xs-12">
						  <div class="form-group animated fadeIn" id="timel" style="display: none;">
                            <label for="time">Time</label>
                            <input class="form-control" id="time" name="time" type="text" placeholder="Ex: 60">
                          </div>
						  </div>
						  <div class="col-xs-12">
						  <div class="form-group animated fadeIn" id="threadsl4" style="display: none;">
                            <label for="threads">Threads (MAX: <?php echo $_SESSION['totalthreads']; ?>)</label>
							
                            <input class="form-control" id="threads" name="threads" type="number" placeholder="Ex: 1">
                          </div>
						  </div>
						  <div class="col-xs-12">
						  <div class="form-group animated fadeIn" id="methodl4" style="display: none;">
                        
                           <div>
                              <label for="method"><i class="si si-energy text-primary"></i> Method</label>
                              <select class="form-control" type="text" id="method4" name="method4">
                                 <optgroup style="color: #7366ff" label="--> UDP">
                                    <?php
                                       $SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'Layer4_UDP' ORDER BY `id` ASC");
                                       
                                       while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
                                        $name = $getInfo['name'];
                                        $fullname = $getInfo['fullname'];
                                       
                                        $getUserInfoSQL = $odb->query("SELECT `plan` FROM `users` WHERE `username` = '" . $_SESSION['username'] . "'");
                                        $getUserInfo = $getUserInfoSQL->fetch(PDO::FETCH_ASSOC);
                                       
                                        $SQLInfo = $odb->query("SELECT COUNT(*) FROM `plans` WHERE `network` = 'vip' AND `id` = '" . $getUserInfo['plan'] . "'");
                                        $getInfoPlan = $SQLInfo ->fetch(PDO::FETCH_ASSOC);
                                        
                                       if($getInfo['vip'] == '1' && $getInfoPlan['COUNT(*)'] == "0") { 
                                       echo '<option class="" disabled label="' . htmlentities($fullname) . ' (VIP Method)">' . htmlentities($fullname) . ' (VIP Method)</option>';
                                       } else {
								    	$GetServers = $odb->query("SELECT `" . $column . "` FROM `servers` WHERE `layer` = '4' AND `methods` LIKE '%," . $name . ",%' ORDER BY ABS(`last_used`) ASC LIMIT 1;");
										$countServers = $GetServers -> fetchColumn(0);
									   if(empty($countServers)) { $countServers = 'N/A'; }
                                       echo '<option value="' . htmlentities($name) . '" servers="' . $countServers . '">' . htmlentities($fullname) . '</option>';
                                       }
                                       }
                                       ?>
                                 </optgroup>
                                 <optgroup style="color: #115fbc!important;" label="--> TCP">
                                    <?php
                                       $SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'Layer4_TCP' ORDER BY `id` ASC");
                                       
                                       while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
                                        $name = $getInfo['name'];
                                        $fullname = $getInfo['fullname'];
                                       
                                        $getUserInfoSQL = $odb->query("SELECT `plan` FROM `users` WHERE `username` = '" . $_SESSION['username'] . "'");
                                        $getUserInfo = $getUserInfoSQL->fetch(PDO::FETCH_ASSOC);
                                       
                                        $SQLInfo = $odb->query("SELECT COUNT(*) FROM `plans` WHERE `network` = 'vip' AND `id` = '" . $getUserInfo['plan'] . "'");
                                        $getInfoPlan = $SQLInfo ->fetch(PDO::FETCH_ASSOC);
                                        
                                       if($getInfo['vip'] == '1' && $getInfoPlan['COUNT(*)'] == "0") { 
                                       echo '<option class="" disabled label="' . htmlentities($fullname) . ' (VIP Method)">' . htmlentities($fullname) . ' (VIP Method)</option>';
                                       } else {
									   $GetServers = $odb->query("SELECT `" . $column . "` FROM `servers` WHERE `layer` = '4' AND `methods` LIKE '%," . $name . ",%' ORDER BY ABS(`last_used`) ASC LIMIT 1;");
									   $countServers = $GetServers -> fetchColumn(0);
									   if(empty($countServers)) { $countServers = 'N/A'; }
                                       echo '<option value="' . htmlentities($name) . '" servers="' . $countServers . '">' . htmlentities($fullname) . '</option>';
                                       }
                                       }
                                       ?>
                                 </optgroup>
                                 <optgroup style="color: #87139c!important;" label="--> PROTECTED SERVERS">
                                    <?php
                                       $SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'Layer4_BYPASS' ORDER BY `id` ASC");
                                       
                                       while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
                                        $name = $getInfo['name'];
                                        $fullname = $getInfo['fullname'];
                                       
                                        $getUserInfoSQL = $odb->query("SELECT `plan` FROM `users` WHERE `username` = '" . $_SESSION['username'] . "'");
                                        $getUserInfo = $getUserInfoSQL->fetch(PDO::FETCH_ASSOC);
                                       
                                        $SQLInfo = $odb->query("SELECT COUNT(*) FROM `plans` WHERE `network` = 'vip' AND `id` = '" . $getUserInfo['plan'] . "'");
                                        $getInfoPlan = $SQLInfo ->fetch(PDO::FETCH_ASSOC);
                                        
                                       if($getInfo['vip'] == '1' && $getInfoPlan['COUNT(*)'] == "0") { 
                                       echo '<option class="" disabled label="' . htmlentities($fullname) . ' (VIP Method)">' . htmlentities($fullname) . ' (VIP Method)</option>';
                                       } else {
									   $GetServers = $odb->query("SELECT `" . $column . "` FROM `servers` WHERE `layer` = '4' AND `methods` LIKE '%," . $name . ",%' ORDER BY ABS(`last_used`) ASC LIMIT 1;");
									   $countServers = $GetServers -> fetchColumn(0);
									   if(empty($countServers)) { $countServers = 'N/A'; }
                                       echo '<option value="' . htmlentities($name) . '" servers="' . $countServers . '">' . htmlentities($fullname) . '</option>';
                                       }
                                       }
                                       ?>
                                 </optgroup>
                                
                                 <optgroup style="color: #000000!important;" label="--> GAME">
                                    <?php
                                       $SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'Layer4_Game' ORDER BY `id` ASC");
                                       
                                       while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
                                       
                                        $name = $getInfo['name'];
                                       
                                        $fullname = $getInfo['fullname'];
                                       
                                                        $getUserInfoSQL = $odb->query("SELECT `plan` FROM `users` WHERE `username` = '" . $_SESSION['username'] . "'");
                                        $getUserInfo = $getUserInfoSQL->fetch(PDO::FETCH_ASSOC);
                                       
                                        $SQLInfo = $odb->query("SELECT COUNT(*) FROM `plans` WHERE `network` = 'vip' AND `id` = '" . $getUserInfo['plan'] . "'");
                                        $getInfoPlan = $SQLInfo ->fetch(PDO::FETCH_ASSOC);
                                        
                                       if($getInfo['vip'] == '1' && $getInfoPlan['COUNT(*)'] == "0") { 
                                       echo '<option disabled label="' . htmlentities($fullname) . ' (VIP Method)">' . htmlentities($fullname) . ' (VIP Method)</option>';
                                       } else {
									   $GetServers = $odb->query("SELECT `" . $column . "` FROM `servers` WHERE `layer` = 'Game' AND `methods` LIKE '%," . $name . ",%' ORDER BY ABS(`last_used`) ASC LIMIT 1;");
									   $countServers = $GetServers -> fetchColumn(0);
									   if(empty($countServers)) { $countServers = 'N/A'; }
                                       echo '<option value="' . htmlentities($name) . '" servers="' . $countServers . '">' . htmlentities($fullname) . '</option>';
                                       }
                                       
                                       }
                                       
                                       ?>
                                 </optgroup>
                              </select>
                           </div>
                        </div>
                     </div>
					 <div class="col-xs-12">
						  <div class="form-group animated fadeIn" id="amethodl4" style="display: none;">
                        
                           <div>
                              <label for="method"> Method</label>
                              <select class="form-control" type="text" id="amethod4" name="amethod4" onclick="checkMethod()"> 
                                    <?php
                                       $SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'LayerADV' ORDER BY `id` ASC");
                                       
                                       while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
                                        $name = $getInfo['name'];
                                        $fullname = $getInfo['fullname'];
                                       
                                        $getUserInfoSQL = $odb->query("SELECT `plan` FROM `users` WHERE `username` = '" . $_SESSION['username'] . "'");
                                        $getUserInfo = $getUserInfoSQL->fetch(PDO::FETCH_ASSOC);
                                       
                                        $SQLInfo = $odb->query("SELECT COUNT(*) FROM `plans` WHERE `network` = 'vip' AND `id` = '" . $getUserInfo['plan'] . "'");
                                        $getInfoPlan = $SQLInfo ->fetch(PDO::FETCH_ASSOC);
                                        
                                       if($getInfo['vip'] == '1' && $getInfoPlan['COUNT(*)'] == "0") { 
                                       echo '<option class="text-warning" disabled label="' . htmlentities($fullname) . ' (VIP Method)">' . htmlentities($fullname) . ' (VIP Method)</option>';
                                       } else {
									   $GetServers = $odb->query("SELECT `" . $column . "` FROM `servers` WHERE `layer` = 'ADV' AND `methods` LIKE '%," . $name . ",%' ORDER BY ABS(`last_used`) ASC LIMIT 1;");
									   $countServers = $GetServers -> fetchColumn(0);
									   if(empty($countServers)) { $countServers = 'N/A'; }
                                       echo '<option value="' . htmlentities($name) . '" servers="' . $countServers . '">' . htmlentities($fullname) . '</option>';
                                       }
                                       }
                                       ?>
                                
                                 
                              </select>
                           </div>
                        </div>
                     </div>
					  <div class="col-xs-12">
						<div class="form-group animated fadeIn" id="model7" style="display: none;">
                            <label class="col-form-label pt-0" for="layer">Mode</label>
                            <select class="form-control" type="text" id="mode7" name="mode7">
							<option value="request">Heavy(Bypass)</option>
							<option value="proxy">Socket</option>
							<option value="websocket">WebSocket</option>
							<option value="tor">TOR</option>
							</select>
                          </div>
						</div>
					 <div class="col-xs-12">
						<div class="form-group animated fadeIn" id="methodl7" style="display: none;">
                            <label class="col-form-label pt-0" for="layer">Method</label>
                            <select class="form-control" type="text" id="method7" name="method7">
							<option value="GET">GET</option>
							<option value="POST">POST</option>
							<option value="HEAD">HEAD</option>
							</select>
                          </div>
						</div>
						<div class="col-xs-12">
						<div class="form-group animated fadeIn" id="checksuml4" style="display: none;">
                            <label class="col-form-label pt-0" for="layer">Checksum</label>
                            <select class="form-control" type="text" id="checksum" name="checksum">
							<option value="0">False</option>
							<option value="1">True</option>
							</select>
                          </div>
						</div>
					  <div class="col-xs-12">
						<div class="form-group animated fadeIn" id="sipl4" style="display: none;">
                            <label class="col-form-label pt-0" for="layer">Source IP</label>
                            <select class="form-control" type="text" id="sip" name="sip">
							<optgroup label="Providers">
							<option value="cf">Cloudflare</option>
							<option value="google">Google</option>
							<option value="akamai">Akamai</option>
							<option value="incapsula">Incapsula</option>
							<option value="voxility">Voxility</option>
							<option value="ovh">OVH</option>
							<option value="amazon">Amazon</option>
							</optgroup>
							<optgroup label="Countries">
							<option value="any">World Wide</option>
							<option value="usa">United States</option>
							<option value="ch">China</option>
							<option value="ru">Rusia</option>
							<option value="bz">Brazil</option>
							<option value="uk">United Kingdom</option>
							<option value="ca">Canada</option>
							<option value="singapur">Singapur</option>
							</optgroup>
							</select>
                          </div>
						</div>
						<div class="col-xs-12">
						    <div class="form-group animated fadeIn" id="payloadl4" style="display: none;">
                            <label class="col-form-label pt-0" for="data">Payload</label>
                            <input class="form-control" id="payload" name="payload" type="text" placeholder="081e77da">
                          </div>
						  </div>
						  <div class="col-xs-12">
						    <div class="form-group animated fadeIn" id="lenl4" style="display: none;">
                            <label class="col-form-label pt-0" for="data">Packet Length</label>
                            <input class="form-control" id="payload" name="len" type="text" placeholder="Ex: 50(ignore if payload is specified)">
                          </div>
						  </div>
						  <div class="col-xs-12">
						<div class="form-group animated fadeIn" id="ackl4" style="display: none;">
                            <label class="col-form-label pt-0" for="layer">ACK Flag</label>
                            <select class="form-control" type="text" id="ack" name="ack">
							<option value="0">False</option>
							<option value="1">True</option>
							</select>
                          </div>
						</div>
						<div class="col-xs-12">
						<div class="form-group animated fadeIn" id="synl4" style="display: none;">
                            <label class="col-form-label pt-0" for="layer">SYN Flag</label>
                            <select class="form-control" type="text" id="syn" name="syn">
							<option value="0">False</option>
							<option value="1">True</option>
							</select>
                          </div>
						</div>
						<div class="col-xs-12">
						<div class="form-group animated fadeIn" id="pshl4" style="display: none;">
                            <label class="col-form-label pt-0" for="layer">PSH Flag</label>
                            <select class="form-control" type="text" id="psh" name="psh">
							<option value="0">False</option>
							<option value="1">True</option>
							</select>
                          </div>
						</div>
						<div class="col-xs-12">
						<div class="form-group animated fadeIn" id="rstl4" style="display: none;">
                            <label class="col-form-label pt-0" for="layer">RST Flag</label>
                            <select class="form-control" type="text" id="rst" name="rst">
							<option value="0">False</option>
							<option value="1">True</option>
							</select>
                          </div>
						</div>
						<div class="col-xs-12">
						<div class="form-group animated fadeIn" id="finl4" style="display: none;">
                            <label class="col-form-label pt-0" for="layer">FIN Flag</label>
                            <select class="form-control" type="text" id="fin" name="fin">
							<option value="0">False</option>
							<option value="1">True</option>
							</select>
                          </div>
						</div>
						<div class="col-xs-12">
						<div class="form-group animated fadeIn" id="urgl4" style="display: none;">
                            <label class="col-form-label pt-0" for="layer">URG Flag</label>
                            <select class="form-control" type="text" id="urg" name="urg">
							<option value="0">False</option>
							<option value="1">True</option>
							</select>
                          </div>
						</div>
						<div class="col-xs-12">
						    <div class="form-group animated fadeIn" id="seql4" style="display: none;">
                            <label class="col-form-label pt-0" for="data">Sequence</label>
                            <input class="form-control" id="seq" name="seq" type="text" placeholder="1">
                          </div>
						  </div>
						  <div class="col-xs-12">
						    <div class="form-group animated fadeIn" id="ackseql4" style="display: none;">
                            <label class="col-form-label pt-0" for="data">ACK Sequence</label>
                            <input class="form-control" id="ackseq" name="ackseq" type="text" placeholder="1">
                          </div>
						  </div>
						  <div class="col-xs-12">
						    <div class="form-group animated fadeIn" id="optionsl4" style="display: none;">
                            <label class="col-form-label pt-0" for="data"> TCP Options</label>
                            <input class="form-control" id="options" name="options" type="text" placeholder="x,x,x,x(optional)">
                          </div>
						  </div>
						 <div class="col-xs-12">
						 <div class="form-group animated fadeIn" id="ppsl4" style="display: none;">
                        <label class="col-form-label pt-0" for="layer">PPS</label>
                        
                          <input id="pps2" name="pps" type="text">
                        
                      </div>
					  </div>
					  
					  <div class="col-xs-12">
						    <div class="form-group animated fadeIn" id="datal7" style="display: none;">
                            <label class="col-form-label pt-0" for="data">Post Data</label>
                            <input class="form-control" id="data" name="data" type="text" placeholder="username=%RAND%&password=%RAND%">
                          </div>
						  </div>
						  <div class="col-xs-12">
						    <div class="form-group animated fadeIn" id="cookiel7" style="display: none;">
                            <label class="col-form-label pt-0" for="cookie">Cookies</label>
                            <input class="form-control" id="cookie" name="cookie" type="text" placeholder="Optional">
                          </div>
						  </div>
						  <div class="col-xs-12">
						<div class="form-group animated fadeIn" id="ratel7" style="display: none;">
                            <label class="col-form-label pt-0" for="layer">Ratelimit</label>
                            <select class="form-control" type="text" id="rate" name="rate">
							<option value="false">False</option>
							<option value="true">Bypass</option>
							
							</select>
                          </div>
						</div>
						  
                         
                        </form>
                      </div>
                      <div class="card-footer">
					  <div class="row">
					   <div class="col-lg-6">
                        <button type="button" class="btn btn-primary animated bounceIn" id="startl4" onclick="start4()" style="display: none;">Start</button>
						<button type="button" class="btn btn-primary animated bounceIn" id="startl7" onclick="start7()" style="display: none;">Start</button>
						<button type="button" class="btn btn-primary animated bounceIn" id="startl4a" onclick="start4a()" style="display: none;">Start</button>
						</div>
						<div class="col-lg-6">
                        <button onclick="clearlogs()" class="btn btn-secondary float-right">Clear Logs</button>
                      </div>
					  </div>
                    </div>
					</div>
                  </div>
			
			<div class="col-md-7">
			<div class="card" id="blocky">
				   <div class="card-header bg-primary">
					  <h5 class="card-title"> Manage Tests <i style="display: none;" id="manage" class="fa fa-cog fa-spin"></i></h5>
					  
				   </div>
				   <div class="card-body">
					  <div id="attacksdiv" style="display:block;"></div>
				   </div>
			</div>
		</div>
             
            </div>
          </div>
          <!-- Container-fluid Ends-->
       </div>
	   </div>
	   
<?php require_once 'assets/backend/footer.php'; ?>
<script id="ajax">
            <?php
               echo 'document.getElementById("ajax").innerHTML = '."' try {";
                   $SQLSelect = $odb->query("SELECT * FROM `logs` WHERE user='{$_SESSION['username']}' ORDER BY `id` DESC LIMIT 7");
                   while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
                       $time = $show['time'];
                       $rowID = $show['id'];
                       $date = $show['date'];
                       $expires = $date + $time - time();
                       if ($expires < 0 || $show['stopped'] != 0) {} else {
               			echo 'eval(document.getElementById("as'.$rowID.'").innerHTML);';
               		}
               	}
                 echo "} catch (err) { }';";
               ?>
         </script>
		 <script>
		 function checkLayer() {
												var check = document.getElementById("layer");
												if(check.value == '4') {
													document.getElementById("hostl4").style.display = "block";
													document.getElementById("portl4").style.display = "block";
													document.getElementById("timel").style.display = "block";
													document.getElementById("methodl4").style.display = "block";
													document.getElementById("threadsl4").style.display = "block";
													document.getElementById("ppsl4").style.display = "block";
													document.getElementById("startl4").style.display = "block";
													document.getElementById("hostl7").style.display = "none";
													document.getElementById("methodl7").style.display = "none";
													document.getElementById("model7").style.display = "none";
													document.getElementById("datal7").style.display = "none";
													document.getElementById("cookiel7").style.display = "none";
													document.getElementById("ratel7").style.display = "none";
													document.getElementById("startl7").style.display = "none";
													document.getElementById("sportl4").style.display = "none";
													document.getElementById("amethodl4").style.display = "none";
													document.getElementById("checksuml4").style.display = "none";
													document.getElementById("sipl4").style.display = "none";
													document.getElementById("payloadl4").style.display = "none";
													document.getElementById("startl4a").style.display = "none";
													document.getElementById("ackl4").style.display = "none";
													document.getElementById("synl4").style.display = "none";
													document.getElementById("pshl4").style.display = "none";
													document.getElementById("rstl4").style.display = "none";
													document.getElementById("finl4").style.display = "none";
													document.getElementById("urgl4").style.display = "none";
													document.getElementById("lenl4").style.display = "none";
													document.getElementById("seql4").style.display = "none";
													document.getElementById("ackseql4").style.display = "none";
													document.getElementById("optionsl4").style.display = "none";
												}else if(check.value == '7') {
													document.getElementById("hostl7").style.display = "block";
													document.getElementById("timel").style.display = "block";
													document.getElementById("methodl7").style.display = "block";
													document.getElementById("model7").style.display = "block";
													document.getElementById("datal7").style.display = "block";
													document.getElementById("cookiel7").style.display = "block";
													document.getElementById("ratel7").style.display = "block";
													document.getElementById("startl7").style.display = "block";
													document.getElementById("hostl4").style.display = "none";
													document.getElementById("portl4").style.display = "none";
													document.getElementById("threadsl4").style.display = "none";
													document.getElementById("ppsl4").style.display = "none";
													document.getElementById("methodl4").style.display = "none";
													document.getElementById("startl4").style.display = "none";
													document.getElementById("sportl4").style.display = "none";
													document.getElementById("amethodl4").style.display = "none";
													document.getElementById("checksuml4").style.display = "none";
													document.getElementById("sipl4").style.display = "none";
													document.getElementById("payloadl4").style.display = "none";
													document.getElementById("startl4a").style.display = "none";
													document.getElementById("ackl4").style.display = "none";
													document.getElementById("synl4").style.display = "none";
													document.getElementById("pshl4").style.display = "none";
													document.getElementById("rstl4").style.display = "none";
													document.getElementById("finl4").style.display = "none";
													document.getElementById("urgl4").style.display = "none";
													document.getElementById("lenl4").style.display = "none";
													document.getElementById("seql4").style.display = "none";
													document.getElementById("ackseql4").style.display = "none";
													document.getElementById("optionsl4").style.display = "none";
												}else if(check.value == 'a') {
													document.getElementById("hostl4").style.display = "block";
													document.getElementById("portl4").style.display = "block";
													document.getElementById("timel").style.display = "block";
													document.getElementById("threadsl4").style.display = "block";
													document.getElementById("ppsl4").style.display = "block";
													document.getElementById("sportl4").style.display = "block";
													document.getElementById("amethodl4").style.display = "block";
													document.getElementById("checksuml4").style.display = "block";
													document.getElementById("sipl4").style.display = "block";
													document.getElementById("payloadl4").style.display = "block";
													document.getElementById("lenl4").style.display = "block";
													document.getElementById("startl4a").style.display = "block";
													document.getElementById("hostl7").style.display = "none";
													document.getElementById("methodl7").style.display = "none";
													document.getElementById("model7").style.display = "none";
													document.getElementById("datal7").style.display = "none";
													document.getElementById("cookiel7").style.display = "none";
													document.getElementById("ratel7").style.display = "none";
													document.getElementById("startl7").style.display = "none";
													document.getElementById("startl4").style.display = "none";
													document.getElementById("methodl4").style.display = "none";
													
												}else {
													document.getElementById("hostl4").style.display = "none";
													document.getElementById("portl4").style.display = "none";
													document.getElementById("timel").style.display = "none";
													document.getElementById("methodl4").style.display = "none";
													document.getElementById("threadsl4").style.display = "none";
													document.getElementById("ppsl4").style.display = "none";
													document.getElementById("hostl7").style.display = "none";
													document.getElementById("methodl7").style.display = "none";
													document.getElementById("model7").style.display = "none";
													document.getElementById("datal7").style.display = "none";
													document.getElementById("cookiel7").style.display = "none";
													document.getElementById("ratel7").style.display = "none";
													document.getElementById("startl4").style.display = "none";
													document.getElementById("startl7").style.display = "none";
													document.getElementById("sportl4").style.display = "none";
													document.getElementById("amethodl4").style.display = "none";
													document.getElementById("checksuml4").style.display = "none";
													document.getElementById("sipl4").style.display = "none";
													document.getElementById("payloadl4").style.display = "none";
													document.getElementById("startl4a").style.display = "none";
													document.getElementById("ackl4").style.display = "none";
													document.getElementById("synl4").style.display = "none";
													document.getElementById("pshl4").style.display = "none";
													document.getElementById("rstl4").style.display = "none";
													document.getElementById("finl4").style.display = "none";
													document.getElementById("urgl4").style.display = "none";
													document.getElementById("lenl4").style.display = "none";
													document.getElementById("seql4").style.display = "none";
													document.getElementById("ackseql4").style.display = "none";
													document.getElementById("optionsl4").style.display = "none";
												}
											}
											
											function checkMethod() {
												var checks = document.getElementById("amethod4");
												if(checks.value == 'TCP-RIP') {
													document.getElementById("ackl4").style.display = "block";
													document.getElementById("synl4").style.display = "block";
													document.getElementById("pshl4").style.display = "block";
													document.getElementById("rstl4").style.display = "block";
													document.getElementById("finl4").style.display = "block";
													document.getElementById("urgl4").style.display = "block";
													document.getElementById("seql4").style.display = "block";
													document.getElementById("ackseql4").style.display = "block";
													document.getElementById("optionsl4").style.display = "block";
													
											}else{
													document.getElementById("ackl4").style.display = "none";
													document.getElementById("synl4").style.display = "none";
													document.getElementById("pshl4").style.display = "none";
													document.getElementById("rstl4").style.display = "none";
													document.getElementById("finl4").style.display = "none";
													document.getElementById("urgl4").style.display = "none";
													document.getElementById("seql4").style.display = "none";
													document.getElementById("ackseql4").style.display = "none";
													document.getElementById("optionsl4").style.display = "none";
											}
											}
		 </script>
         <script>
		 
		
		function replaceSubstring(inSource, inToReplace, inReplaceWith) {
		  var outString = inSource;
		  while (true) {
			var idx = outString.indexOf(inToReplace);
			if (idx == -1) {
			  break;
			}
			outString = outString.substring(0, idx) + inReplaceWith +
			  outString.substring(idx + inToReplace.length);
		  }
		  return outString;
		}

            function start4() {
			document.getElementById("manage").style.display = "inline-block";
              var host = $('#host4').val();
              var port = $('#port').val();
              var time = $('#time').val();
			  var pps = $('#pps2').val();
              var method = $('#method4').val();
              var threads = $('#threads').val();
            swal({
            		buttonsStyling: !1,
                            confirmButtonClass: "btn btn-success m-5",
                            cancelButtonClass: "btn btn-danger m-5",
                            inputClass: "form-control",
                                title: "Are you sure?",
                                text: "Are you sure you want to start the attack on " + host + ":" + port + "?",
                                type: "warning",
                                showCancelButton: !0,
                                confirmButtonColor: "#d26a5c",
                                confirmButtonText: "Yes",
                                html: !1,
                                preConfirm: function() {
                                    return new Promise(function(n) {
                                        setTimeout(function() {
                                            n()
                                        }, 50)
                                    })
                                }
                            }).then(function(n) {
            	
            
              var xmlhttp;
            
              if (window.XMLHttpRequest) {
            
                xmlhttp=new XMLHttpRequest();
            
              }
            
              else {
            
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            
              }
            
              xmlhttp.onreadystatechange=function() {
            
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
             document.getElementById("manage").style.display = "none";
            
                //  document.getElementById("r3sponse").innerHTML=xmlhttp.responseText;
                  var resp = xmlhttp.responseText;
                  if (xmlhttp.responseText.search("Attack") != -1) {
            $.notify('<i class="fa fa-check"></i><strong>Success: </strong>' + resp,{
                     	    type: 'success',
							showProgressbar: true,
							allow_dismiss: true,
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
            
                   // var snd = new Audio("assets/sounds/attacksent.mp3"); 
                    //snd.play();
            
            		attacks();
            		
            
                  }
                  else {
					  $.notify('<i class="fa fa-warning"></i><strong>Error: </strong> ' + resp,{
                     	    type: 'danger',
							showProgressbar: true,
							allow_dismiss: true,
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
                  }
            
                }
            
              }
            
              xmlhttp.open("POST","assets/backend/kinda.php",true);
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			  xmlhttp.send("type=start&host=" + host + "&port=" + port + "&time=" + time + "&method=" + method + "&servers=" + threads + "&pps=" + pps );
			  
             }, function(n) {})
            }
			
			  function start7() {
				  document.getElementById("manage").style.display = "inline-block";
              var host = $('#host7').val();
              var mode = $('#mode7').val();
              var time = $('#time').val();
			  var rate = $('#rate').val();
              var method = $('#method7').val();
              var data = $('#data').val();
			  var cookie = $('#cookie').val();
            swal({
            		buttonsStyling: !1,
                            confirmButtonClass: "btn btn-success m-5",
                            cancelButtonClass: "btn btn-danger m-5",
                            inputClass: "form-control",
                                title: "Are you sure?",
                                text: "Are you sure you want to start the attack on " + host + "?",
                                type: "warning",
                                showCancelButton: !0,
                                confirmButtonColor: "#d26a5c",
                                confirmButtonText: "Yes",
                                html: !1,
                                preConfirm: function() {
                                    return new Promise(function(n) {
                                        setTimeout(function() {
                                            n()
                                        }, 50)
                                    })
                                }
                            }).then(function(n) {
            	
            
              var xmlhttp;
            
              if (window.XMLHttpRequest) {
            
                xmlhttp=new XMLHttpRequest();
            
              }
            
              else {
            
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            
              }
            
              xmlhttp.onreadystatechange=function() {
            
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("manage").style.display = "none";
            
            //      document.getElementById("r3sponse").innerHTML=xmlhttp.responseText;
            var resp = xmlhttp.responseText;
                  if (xmlhttp.responseText.search("Attack") != -1) {
            $.notify('<i class="fa fa-check"></i><strong>Success: </strong>' + resp,{
                     	    type: 'success',
							showProgressbar: true,
							allow_dismiss: true,
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
            
                   // var snd = new Audio("assets/sounds/attacksent.mp3"); 
                    //snd.play();
            
            		attacks();
            		
            
                  }
                  else {
					  $.notify('<i class="fa fa-warning"></i><strong>Error: </strong>' + resp,{
                     	    type: 'danger',
							showProgressbar: true,
							allow_dismiss: true,
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
                  }
            
                }
            
              }
            
              xmlhttp.open("POST","assets/backend/kinda-l7.php",true);
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			  xmlhttp.send("type=start&host=" + host + "&mode=" + mode + "&time=" + time + "&method=" + method + "&data=" + data + "&cookie=" + cookie + "&rate=" + rate );
			  
             }, function(n) {})
            }
			
			
			function start4a() {
			document.getElementById("manage").style.display = "inline-block";
              var host = $('#host4').val();
              var port = $('#port').val();
			  var sport = $('#sport').val();
              var time = $('#time').val();
			  var pps = $('#pps2').val();
              var method = $('#amethod4').val();
              var threads = $('#threads').val();
			  var checksum = $('#checksum').val();
			  var sip = $('#sip').val();
			  var payload = $('#payload').val();
			  var len = $('#len').val();
			  var ack = $('#ack').val();
			  var syn = $('#syn').val();
			  var psh = $('#psh').val();
			  var fin = $('#fin').val();
			  var rst = $('#rst').val();
			  var urg = $('#urg').val();
			  var seq = $('#seq').val();
			  var ackseq = $('#ackseq').val();
			  var options = $('#options').val();
			  
            swal({
            		buttonsStyling: !1,
                            confirmButtonClass: "btn btn-success m-5",
                            cancelButtonClass: "btn btn-danger m-5",
                            inputClass: "form-control",
                                title: "Are you sure?",
                                text: "Are you sure you want to start the attack on " + host + ":" + port + "?",
                                type: "warning",
                                showCancelButton: !0,
                                confirmButtonColor: "#d26a5c",
                                confirmButtonText: "Yes",
                                html: !1,
                                preConfirm: function() {
                                    return new Promise(function(n) {
                                        setTimeout(function() {
                                            n()
                                        }, 50)
                                    })
                                }
                            }).then(function(n) {
            	
            
              var xmlhttp;
            
              if (window.XMLHttpRequest) {
            
                xmlhttp=new XMLHttpRequest();
            
              }
            
              else {
            
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            
              }
            
              xmlhttp.onreadystatechange=function() {
            
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("manage").style.display = "none";
            
                  //document.getElementById("r3sponse").innerHTML=xmlhttp.responseText;
            var resp = xmlhttp.responseText;
                  if (xmlhttp.responseText.search("Attack") != -1) {
            $.notify('<i class="fa fa-check"></i><strong>Success: </strong>' + resp,{
                     	    type: 'success',
							showProgressbar: true,
							allow_dismiss: true,
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
            
                   // var snd = new Audio("assets/sounds/attacksent.mp3"); 
                    //snd.play();
            
            		attacks();
            		
            
                  }
                  else {
					  $.notify('<i class="fa fa-warning"></i><strong>Error: </strong>' + resp,{
                     	    type: 'danger',
							showProgressbar: true,
							allow_dismiss: true,
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
                  }
            
                }
            
              }
            if(method == "TCP-RIP"){
			xmlhttp.open("POST","assets/backend/kinda-tcp.php",true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("type=start&host=" + host + "&port=" + port + "&time=" + time + "&method=" + method + "&servers=" + threads + "&pps=" + pps + "&sport=" + sport + "&checksum=" + checksum + "&sip=" + sip + "&payload=" + payload + "&len=" + len + "&ack=" + ack + "&syn=" + syn + "&psh=" + psh + "&fin=" + fin + "&rst=" + rst + "&urg=" + urg + "&seq=" + seq + "&ackseq=" + ackseq + "&options=" + options);
			}else{
			xmlhttp.open("POST","assets/backend/kinda-udp.php",true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("type=start&host=" + host + "&port=" + port + "&time=" + time + "&method=" + method + "&servers=" + threads + "&pps=" + pps + "&sport=" + sport + "&checksum=" + checksum + "&sip=" + sip + "&payload=" + payload + "&len=" + len);
			}
             }, function(n) {})
            }
			
            function clearlogs() {
            swal({
            		buttonsStyling: !1,
                            confirmButtonClass: "btn btn-success m-5",
                            cancelButtonClass: "btn btn-danger m-5",
                            inputClass: "form-control",
                                title: "Are you sure?",
                                text: "Are you sure you want to clear all your attack logs?",
                                type: "warning",
                                showCancelButton: !0,
                                confirmButtonColor: "#d26a5c",
                                confirmButtonText: "Yes",
                                html: !1,
                                preConfirm: function() {
                                return new Promise(function(n) {
                                setTimeout(function() {
                                    n()
                                }, 50)
                            })
                        }
                            }).then(function(n) {
            
              var xmlhttp;
            
              if (window.XMLHttpRequest) {
            
                xmlhttp=new XMLHttpRequest();
            
              }
            
              else {
            
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            
              }
            
              xmlhttp.onreadystatechange=function() {
            
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            
                  if (xmlhttp.responseText.search("SUCCESS") != -1) {
            
                     $.notify('<i class="fa fa-warning"></i><strong>Success: </strong> All attack logs cleared successfully!',{
                     	    type: 'success',
							showProgressbar: true,
							allow_dismiss: true,
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
					
                    attacks();
            
                  }
                  else {
					   $.notify('<i class="fa fa-warning"></i><strong>Error: </strong> You have no any attack logs yet!',{
                     	    type: 'danger',
							showProgressbar: true,
							allow_dismiss: true,
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
           
                  }
            
                }
            
              }
            
              xmlhttp.open("GET","clearlogs.php",true);
            
              xmlhttp.send();
             }, function(n) {})
            }
</script>
<script>
   attacks();
   function attacks() {
   
     
     document.getElementById("manage").style.display = "inline-block";
   
     var xmlhttp;
   
     if (window.XMLHttpRequest) {
       xmlhttp = new XMLHttpRequest();
     }
     else {
       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
     }
   
     xmlhttp.onreadystatechange=function() {
       if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
         document.getElementById("attacksdiv").innerHTML = xmlhttp.responseText;
         document.getElementById("manage").style.display = "none";
         
   		try {
   			  eval(document.getElementById("counters").innerHTML);
   			  eval(document.getElementById("ajax").innerHTML);
   		}
   		catch (err) {
   
   		}
   		if(xmlhttp.responseText.indexOf("Waiting") >= 0) {
   			setTimeout(function() {
   			attacksInBackground();
   			}, 1500);
   		}
       } 
     }
   
     xmlhttp.open("GET","assets/backend/attacks.php",true);
     xmlhttp.send();
   
   }
   
   function attacksInBackground() {
   	setTimeout(function() {
     var xmlhttp;
   
     if (window.XMLHttpRequest) {
       xmlhttp = new XMLHttpRequest();
     }
     else {
       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
     }
   
     xmlhttp.onreadystatechange=function() {
       if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
   		var Respone = xmlhttp.responseText;
   		if(Respone.indexOf("Waiting") >= 0) {
   			attacksInBackground();
   		} else {
         document.getElementById("attacksdiv").innerHTML = xmlhttp.responseText;
   		try {
   			  eval(document.getElementById("counters").innerHTML);
   			  eval(document.getElementById("ajax").innerHTML);
   		}
   		catch (err) {
   
   		}
   		}
       } 
     }
   
     xmlhttp.open("GET","assets/backend/attacks.php",true);
     xmlhttp.send();
   }, 1500);
   }
   
   function renew(id) {
   swal({
   		buttonsStyling: !1,
                   confirmButtonClass: "btn btn-success m-5",
                   cancelButtonClass: "btn btn-danger m-5",
                   inputClass: "form-control",
                       title: "Renew Attack?",
                       text: "Are you sure you want to renew the attack?",
                       type: "warning",
                       showCancelButton: !0,
                       confirmButtonColor: "#d26a5c",
                       confirmButtonText: "Yes",
                       html: !1,
                       preConfirm: function() {
                           return new Promise(function(n) {
                               setTimeout(function() {
                                   n()
                               }, 50)
                           })
                       }
                   }).then(function(n) {
                       document.getElementById("manage").style.display="inline-block";
   
     var xmlhttp;
   
     if (window.XMLHttpRequest) {
   
       xmlhttp=new XMLHttpRequest();
   
     }
   
     else {
   
       xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   
     }
   
     xmlhttp.onreadystatechange=function() {
   
       if (xmlhttp.readyState==4 && xmlhttp.status==200) {
   
         //document.getElementById("r3sponse").innerHTML=xmlhttp.responseText;
   var resp = xmlhttp.responseText;
         document.getElementById("manage").style.display="none";
         if (xmlhttp.responseText.search("success") != -1) {
   
  $.notify('<i class="fa fa-check"></i><strong>Success: </strong>' + resp,{
                     	    type: 'success',
							showProgressbar: true,
							allow_dismiss: true,
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
   
           attacks();
   
         }
         else {
   $.notify('<i class="fa fa-times"></i><strong>Error: </strong>' + resp,{
                     	    type: 'danger',
							showProgressbar: true,
							allow_dismiss: true,
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
         }
   
       }
   
     }

	 xmlhttp.open("POST","assets/backend/kinda",true);
	 xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xmlhttp.send("type=renew&id=" + id);
	 
                   }, function(n) {})
   
   }
   
   function stop(id) {
   swal({
   		buttonsStyling: !1,
                   confirmButtonClass: "btn btn-success m-5",
                   cancelButtonClass: "btn btn-danger m-5",
                   inputClass: "form-control",
                       title: "Stop the Attack?",
                       text: "Are you sure you want to stop the attack?",
                       type: "warning",
                       showCancelButton: !0,
                       confirmButtonColor: "#d26a5c",
                       confirmButtonText: "Yes",
                       html: !1,
                       preConfirm: function() {
                           return new Promise(function(n) {
                               setTimeout(function() {
                                   n()
                               }, 50)
                           })
                       }
                   }).then(function(n) {
     document.getElementById("manage").style.display="inline-block";
     var xmlhttp;
   
     if (window.XMLHttpRequest) {
   
       xmlhttp=new XMLHttpRequest();
   
     }
   
     else {
   
       xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   
     }
   
     xmlhttp.onreadystatechange=function() {
   
       if (xmlhttp.readyState==4 && xmlhttp.status==200) {
         document.getElementById("manage").style.display="none";
         if (xmlhttp.responseText.search("STOPPING_SENT") != -1) {
			 $.notify('<i class="fa fa-check"></i><strong>Success: </strong> Attack Stopped',{
                     	    type: 'primary',
							showProgressbar: true,
							allow_dismiss: true,
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
           attacks();
         } else {
   		$.notify('<i class="fa fa-warning"></i><strong>Error: </strong>Something Went Wrong',{
                     	    type: 'danger',
							showProgressbar: true,
							allow_dismiss: true,
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
         }
   
       }
   
     }
   
     xmlhttp.open("POST","assets/backend/kinda.php",true);
     xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xmlhttp.send("type=stop&id=" + id);
   }, function(n) {})
   }
   $('#servers').load('assets/backend/serverslist.php?count=15').fadeIn("slow");
   
	function setClipboard(value) {
		var tempInput = document.createElement("input");
		tempInput.style = "position: absolute; left: -1000px; top: -1000px";
		tempInput.value = value;
		document.body.appendChild(tempInput);
		tempInput.select();
		document.execCommand("copy");
		document.body.removeChild(tempInput);
	}
	
	//SLIDER
	var pps = "<?php echo $pps; ?>";
	var th = "<?php echo $_SESSION["totalthreads"]; ?>";
	var range_slider_custom = {
    init: function() { 
        $("#notused").ionRangeSlider({
            min: 1,
            max: th
        }),
        $("#pps2").ionRangeSlider({
            min: 50000,
            max: pps
        });
    }
};
(function($) {
    "use strict";
    range_slider_custom.init();
})(jQuery);
</script>