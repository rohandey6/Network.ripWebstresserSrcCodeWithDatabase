<?php
   $themeload = true;
   $page = 'API DOC';
   
   include 'assets/backend/header.php';
	if(isset($_POST['gen_key']) && $userData['api'] == 1){
		if(isset($_SESSION['username'])){
			genKey($_SESSION['username'], $odb);
			die("<script>window.location = 'resellerpanel';</script>");
		}
	}
	if(isset($_POST['disable_key']) && $userData['api'] == 1){
		if(isset($_SESSION['username'])){
			disableKey($_SESSION['username'], $odb);
			die("<script>window.location = 'resellerpanel';</script>");
		}
	}

	function genKey($username, $odb){
		//$newkey = generateRandomString(32);
		$newkey = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 32), 24));
		$stmt2 = $odb->query("UPDATE users SET api_key='$newkey' WHERE username='$username'");
	}
	function disableKey($username, $odb){
		$stmt2 = $odb->query("UPDATE users SET api_key='0' WHERE username='$username'");
	}
	function generateRandomString($length = 10){
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for($i=0;$i<$length;$i++){
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	
	if(isset($_POST['save']) && $userData['api'] == 1){
	$ip = $_POST['ip'];
	$a = $_POST['wh'];
	
	$isIP = (bool)ip2long($ip);
	if($a == 0){
		$ip = 0;
		$a = 0;
	}
	$username = $_SESSION['username'];
	$save = $odb->query("UPDATE users SET allowed_ip='$ip' WHERE username='$username'");
	$save2 = $odb->query("UPDATE users SET whitelist='$a' WHERE username='$username'");
	die("<script>window.location = 'resellerpanel';</script>");
	}

	
	
    if($userData['api'] == 0){
		$disable = "disabled";
		
	}
	$key = $userData['api_key'];
	$whitelist = $userData['whitelist'];
	$allowed = $userData['allowed_ip'];
	if($whitelist == 1){
		$whitelist = "ON";
		$on = "block";
	}else {
		$whitelist = "OFF";
		$allowed = "N/A";
		$on = "none";
	}
   ?>

            <br>
			
          
          <!-- Container-fluid starts-->
          <div class="container-fluid">
		  
			  
			  
		  
		  
            <div class="row second-chart-list third-news-update">
			
			  <div class="col-sm-12 col-xl-6 box-col-7">
                <div class="card">
                  <div class="card-header   bg-primary">
                    <h5>Key Manager</h5>
                  </div>
                  <div class="card-body">
                     <form method="POST">
		  		<?php if($key == '0'){?>
	            <input class="form-control" type="text" value="API is unavailable Click 'Generate new key'." readonly="">
	            <?php }else{?>
			
				<input class="form-control" type="text" value="<?php echo $key;?>" readonly="" style="color:black;">
	            <?php }?>
				
	            <br><button type="submit" class="btn btn-primary" name="gen_key" <?php echo $disable;?>>Generate new key</button> <button type="submit" class="btn btn-danger" name="disable_key" <?php echo $disable;?>>Disable api-key</button>
	        </form>
                  </div>
                </div>
              </div>
<div class="col-sm-12 col-xl-6 box-col-7">
                <div class="card">
                  <div class="card-header   bg-primary">
                    <h5>Whitelist Settings</h5>
                  </div>
                  <div class="card-body">
                     <form method="POST">
					   <div class="col-xs-12">
						<div class="form-group animated fadeIn">
                            <label class="col-form-label pt-0" for="wh">Whitelist</label>
                            <select class="form-control" type="text" id="wh" name="wh" onclick="checkEN()">
							<option value="0" <?php if($whitelist == "OFF") { echo 'selected="selected"'; } ?>>Disable</option>
							<option value="1" <?php if($whitelist == "ON") { echo 'selected="selected"'; } ?>>Enable</option>
							</select>
                          </div>
						</div>
						<div class="col-xs-12">
						    <div class="form-group animated fadeIn" id="allowed" style="display: <?php echo $on;?>;">
                            <label class="col-form-label pt-0" for="data">Allowed IP</label>
                            <input class="form-control" id="ip" name="ip" type="text" value="<?php echo $allowed;?>">
                          </div>
						  </div>
                 
	           
	            <br><button type="submit" class="btn btn-primary" name="save" <?php echo $disable;?>>Save Settings
	        </form>
                  </div>
                </div>
				
              </div>
			  
			  
			  
			
              
               
             
            </div>
			<div class="faq-wrap">
			 <div class="row default-according style-1 faq-accordion" id="accordionoc">
			 <div class="col-xl-12 col-lg-12 col-md-7">
			 <div class="card">
			 
                        <div class="card-header">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed pl-0" data-toggle="collapse" data-target="#collapseicon1" aria-expanded="false"><i data-feather="help-circle"></i> How to Use</button>
                          </h5>
                        </div>
                        <div class="collapse" id="collapseicon1" aria-labelledby="collapseicon1" data-parent="#accordionoc">
                          <div class="card-body">
						  
				<p class="text-primary">
				Layer 4</p><br>
				<p class="text-muted">
				URL:   https://network.rip/api/l4?key=<?php echo $key;?>&host=[host]&port=[port]&time=[time]&method=[method]&pps=[pps]&threads=[threads]<br><br>
				 <div class="table-responsive">
					  <table class="table table-responsive-sm">
                        <thead>
                           <tr>
                              <th class="" style="width: 50px; padding: 5px;">Variable</th>
                              <th class="" style="width: 50px; padding: 5px;">Info</th>
                              
                           </tr>
                        </thead>
                        <tbody>
						<tr>
                         <th class="" style="width: 50px; padding: 5px;">host</th> 
						 <th class="" style="width: 50px; padding: 5px;">IPv4 Target 1.1.1.1</th> 
						 </tr>
						 <tr>
                         <th class="" style="width: 50px; padding: 5px;">port</th> 
						 <th class="" style="width: 50px; padding: 5px;">Dest Port (1-65535)</th> 
						 </tr>
						  <tr>
                         <th class="" style="width: 50px; padding: 5px;">time</th> 
						 <th class="" style="width: 50px; padding: 5px;">Attack Time (30 - 10800)</th> 
						 </tr>
						 <tr>
                         <th class="" style="width: 50px; padding: 5px;">threads</th> 
						 <th class="" style="width: 50px; padding: 5px;">Attack threads (1 - 1)</th> 
						 </tr>
						 <tr>
                         <th class="" style="width: 50px; padding: 5px;">pps</th> 
						 <th class="" style="width: 50px; padding: 5px;">Packets per second (500000)</th> 
						 </tr>
                        </tbody>
                     </table>
                        
                         </div> <br>
				Ex:    https://network.rip/api/l4?key=<?php echo $key;?>&host=0.0.0.0&port=80&time=60&method=NTP&pps=500000&threads=1<br><br>
				Stop:  https://network.rip/api/l4?key=<?php echo $key;?>&host=0.0.0.0&port=80&time=60&method=STOP&pps=500000&threads=1<br><br>
				
				</p>
				<p class="text-primary">Layer 7</p>
				<p class="text-muted">
				URL:   https://network.rip/api/l7?key=<?php echo $key;?>&host=[host]&mode=[mode]&time=[time]&method=[method]&data=[data]&cookie=[cookie]&ratelimit=[ratelimit]<br><br>
				<div class="table-responsive">
					  <table class="table table-responsive-sm">
                        <thead>
                           <tr>
                              <th class="" style="width: 50px; padding: 5px;">Variable</th>
                              <th class="" style="width: 50px; padding: 5px;">Info</th>
                              
                           </tr>
                        </thead>
                        <tbody>
						<tr>
                         <th class="" style="width: 50px; padding: 5px;">host</th> 
						 <th class="" style="width: 50px; padding: 5px;">URL https://example.com</th> 
						 </tr>
						 <tr>
                         <th class="" style="width: 50px; padding: 5px;">mode</th> 
						 <th class="" style="width: 50px; padding: 5px;">request, proxy, websocket, tor</th> 
						 </tr>
						  <tr>
                         <th class="" style="width: 50px; padding: 5px;">time</th> 
						 <th class="" style="width: 50px; padding: 5px;">Attack Time (30 - 10800)</th> 
						 </tr>
						 <tr>
                         <th class="" style="width: 50px; padding: 5px;">method</th> 
						 <th class="" style="width: 50px; padding: 5px;">HTTP  request method (GET,HEAD,POST,etc.)</th> 
						 </tr>
						 <tr>
                         <th class="" style="width: 50px; padding: 5px;">data</th> 
						 <th class="" style="width: 50px; padding: 5px;">post data(username=%RAND%~password=%RAND%)</th> 
						 </tr>
						  <tr>
                         <th class="" style="width: 50px; padding: 5px;">cookie</th> 
						 <th class="" style="width: 50px; padding: 5px;">cookie value(PHPSESSID=123)</th> 
						 </tr>
						 <tr>
                         <th class="" style="width: 50px; padding: 5px;">ratelimit</th> 
						 <th class="" style="width: 50px; padding: 5px;">true/false</th> 
						 </tr>
                        </tbody>
                     </table>
                        
                         </div> <br>
				Ex:    https://api.network.rip/l7?key=<?php echo $key;?>&host=https://example.com&mode=request&time=60&method=GET&data=&cookie=&ratelimit=false<br><br>
				Stop:  https://api.network.rip/l7?key=<?php echo $key;?>&host=https://example.com&mode=request&time=60&method=GET&data=&cookie=&ratelimit=false<br><br>
				Note: if you dont want to use "data" and "cookie" just leave empty like the example.
				
				</p>
				<p class="text-primary">Advance</p>
				<p class="text-muted">
				Comming Soon!
				</p>
				
						  </div>
                        </div>
                      </div>
			 <div class="card">
			 
                        <div class="card-header">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed pl-0" data-toggle="collapse" data-target="#collapseicon2" aria-expanded="false"><i data-feather="help-circle"></i> Avalible Methods</button>
                          </h5>
                        </div>
                        <div class="collapse" id="collapseicon2" aria-labelledby="collapseicon2" data-parent="#accordionoc">
                          <div class="card-body">
						  
				<p class="text-primary">
				Layer 4 UDP</p>
				<p>
				<?php
		$methodfetch = $odb -> query("SELECT * FROM `methods` WHERE `type` = 'Layer4_UDP'");
		while($row = $methodfetch ->fetch(PDO::FETCH_ASSOC)){
	echo ' ---> <bb class="badge badge-primary"> '. $row['name'] .' </bb>';
}
?>
				</p>
				<p class="text-primary">
				Layer 4 TCP</p>
				<p>
				<?php
		$methodfetch = $odb -> query("SELECT * FROM `methods` WHERE `type` = 'Layer4_TCP'");
		while($row = $methodfetch ->fetch(PDO::FETCH_ASSOC)){
	echo ' ---> <bb class="badge badge-primary"> '. $row['name'] .' </bb>';
}
?>
				</p>
				<p class="text-primary">
				Layer 4 Game</p>
				<p>
				<?php
		$methodfetch = $odb -> query("SELECT * FROM `methods` WHERE `type` = 'Layer4_Game'");
		while($row = $methodfetch ->fetch(PDO::FETCH_ASSOC)){
	echo ' ---> <bb class="badge badge-primary"> '. $row['name'] .' </bb>';
}
?>
				</p>
				<p class="text-primary">
				Layer 4 Protected Servers</p>
				<p>
				<?php
		$methodfetch = $odb -> query("SELECT * FROM `methods` WHERE `type` = 'Layer4_BYPASS'");
		while($row = $methodfetch ->fetch(PDO::FETCH_ASSOC)){
	echo ' ---> <bb class="badge badge-primary"> '. $row['name'] .' </bb>';
}
?>
				</p>
				<p class="text-primary">
				Layer 7</p>
				<p>
				---> <bb class="badge badge-primary"> N/A </bb><br/>
				Note: no need specify any method in l7 just the HTTP method(get,post,etc)
				</p>
				<p class="text-primary">
				Advance</p>
				<p>
				---> <bb class="badge badge-primary"> Soon! </bb>
				</p>
				
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
											function checkEN() {
												var checks = document.getElementById("wh");
												if(checks.value == '1') {
													document.getElementById("allowed").style.display = "block";
											}else{
													document.getElementById("allowed").style.display = "none";
											}
											}
         </script>
<?php require_once 'assets/backend/footer.php'; ?>

    