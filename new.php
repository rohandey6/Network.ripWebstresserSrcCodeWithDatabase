<?php 

   //By Complex
session_start();
$page = "Dashboard";
include 'header.php';

       $lastactive = $odb -> prepare("UPDATE `users` SET activity=UNIX_TIMESTAMP() WHERE username=:username");
       $lastactive -> execute(array(':username' => $_SESSION['username']));

		$onedayago = time() - 86400;

		$twodaysago = time() - 172800;
		$twodaysago_after = $twodaysago + 86400;

		$threedaysago = time() - 259200;
		$threedaysago_after = $threedaysago + 86400;

		$fourdaysago = time() - 345600;
		$fourdaysago_after = $fourdaysago + 86400;

		$fivedaysago = time() - 432000;
		$fivedaysago_after = $fivedaysago + 86400;

		$sixdaysago = time() - 518400;
		$sixdaysago_after = $sixdaysago + 86400;

		$sevendaysago = time() - 604800;
		$sevendaysago_after = $sevendaysago + 86400;
		
		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` > :date");
		$SQL -> execute(array(":date" => $onedayago));
		$count_one = $SQL->fetchColumn(0);

		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
		$SQL -> execute(array(":before" => $twodaysago, ":after" => $twodaysago_after));
		$count_two = $SQL->fetchColumn(0);

		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
		$SQL -> execute(array(":before" => $threedaysago, ":after" => $threedaysago_after));
		$count_three = $SQL->fetchColumn(0);

		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
		$SQL -> execute(array(":before" => $fourdaysago, ":after" => $fourdaysago_after));
		$count_four = $SQL->fetchColumn(0);

		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
		$SQL -> execute(array(":before" => $fivedaysago, ":after" => $fivedaysago_after));
		$count_five = $SQL->fetchColumn(0);

		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
		$SQL -> execute(array(":before" => $sixdaysago, ":after" => $sixdaysago_after));
		$count_six = $SQL->fetchColumn(0);

		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
		$SQL -> execute(array(":before" => $sevendaysago, ":after" => $sevendaysago_after));
		$count_seven = $SQL->fetchColumn(0);
		
		$date_one = date('d/m/Y', $onedayago);
		$date_two = date('d/m/Y', $twodaysago);
		$date_three = date('d/m/Y', $threedaysago);
		$date_four = date('d/m/Y', $fourdaysago);
		$date_five = date('d/m/Y', $fivedaysago);
		$date_six = date('d/m/Y', $sixdaysago);
		$date_seven = date('d/m/Y', $sevendaysago);

			$plansql = $odb -> prepare("SELECT `users`.`expire`, `plans`.`name`, `plans`.`concurrents`, `plans`.`mbt` FROM `users`, `plans` WHERE `plans`.`ID` = `users`.`membership` AND `users`.`ID` = :id");
			$plansql -> execute(array(":id" => $_SESSION['ID']));
			$row = $plansql -> fetch(); 
			$date2 = date("m-d-Y, h:i:s a", $row['expire']);
			if (!$user->hasMembership($odb)){
				$row['mbt'] = 0;
				$row['concurrents'] = 0;
				$row['name'] = 'No membership';
				$date = '0-0-0';
				$SQLupdate = $odb -> prepare("UPDATE `users` SET `expire` = 0 WHERE `username` = ?");
				$SQLupdate -> execute(array($_SESSION['username']));
			}
			
			$SQL2      = $odb->prepare("SELECT * FROM `PaidUsers` WHERE `username` = :name");
			$SQL2->execute(array(
			":name" => $_SESSION['username']
			));
			$rows = $SQL2->fetch(); 
			
			
			$concus = $rows["concurrents"];
			$secs =   $rows["seconds"];
			$pri   =   $rows["price"];
			$mo   =   $rows["months"];
			$ap   =   $rows["api"];
			$net   =   $rows["network"];
			

		
		//total stats
		$seconds = $row['mbt']+$secs;
		$concurrents = $row['concurrents']+$concus;
		
			$SQLexpire = $odb -> prepare("SELECT * FROM `users` WHERE `username` = :usuario");
                    $SQLexpire -> execute(array(":usuario" => $_SESSION['username']));
                    $getexoire = $SQLexpire -> fetch();
					
				//expire shit start
                    $expira = $getexoire['expire'];
						if (!$user->hasMembership($odb)){
						$daysleft = "N/A";
						$hours = "N/A";
			} else{ 
					//$expiration = date("m-d-Y, h:i:s a", $expira);
					$future = $expira;  //Future date.
							$timefromdb = time();
							$timeleft = $future-$timefromdb;
							$daysleft = (int)($timeleft/86400);
							$hours = round(($timeleft-$daysleft*60*60*24)/(60*60));
					
			}
			//expire shit end
			$SQL = $odb -> prepare("SELECT * FROM `users` WHERE `username` = :usuario");
                    $SQL -> execute(array(":usuario" => $_SESSION['username']));
                    $balancebyripx = $SQL -> fetch();
                    $balance = $balancebyripx['balance'];
					
					
					if ($user -> isAdmin($odb)){ 
				
				$rank ='Admin';
				 
				}
				
				else if ($user -> isVip($odb)){ 
				
					$rank =' Advance User';
				}
				else if ($user -> hasMembership($odb)){ 
				
					$rank ='Paid User';
				}
				else if ($user -> isSupport($odb)){ 
				
					$rank ='Staff';
				}
				else { 
				
					$rank =' Visitor';
				}
				
			
		
			if (isset($_GET['wel']))
		{
				
				{
					
					echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  position: "top-end",
  toast: "true",
  type: "info",
  title: "Welcome back '. $_SESSION['username'] .' to Stress Layer!",
  showConfirmButton: false,
  timer: 4500
  
});';
  echo ' }, 1000);</script>';
  
				}
				
			}
			
			
			
		?>
		<style>
	
	/* Activity */
.activity-feed {
  padding: 15px 15px 0 15px;
  list-style: none;
}

.activity-feed .feed-item {
  position: relative;
  padding-bottom: 29px;
  padding-left: 30px;
  border-left: 2px solid rgba(0, 0, 0, 0.15);
}

.activity-feed .feed-item:last-child {
  border-color: transparent;
}

.activity-feed .feed-item::after {
  content: "";
  display: block;
  position: absolute;
  top: -4px;
  left: -9px;
  width: 16px;
  height: 16px;
  border-radius: 30px;
  background: #02a499;
}

.activity-feed .feed-item .date {
  display: block;
  position: relative;
  top: -5px;
  color: #8c96a3;
  text-transform: uppercase;
  font-size: 13px;
}

.activity-feed .feed-item .activity-text {
  position: relative;
  top: -3px;
}


.card .tab-content{
	padding: 1rem 0 0 0;
}
	</style>
        <div class="lime-container">
            <div class="lime-body">
                <div class="container">
                    <div class="row">
                             
                                              
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <h5 class="card-title">Registered Members</h5>
                                    <h2 class="float-right"><?php echo $TotalUsers+1267; ?></h2>
                                    <p>All Time</p>
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <h5 class="card-title">SERVERS</h5>
                                    <h2 class="float-right"><?php echo $TotalPools+15; ?> </h2>
                                    <p>Connected Servers</p>
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card stat-card">
                                <div class="card-body">
																<?php 
								$SQL = $odb -> query("SELECT COUNT(*) FROM `logs2`");
   $total_attacks = intval($SQL->fetchColumn(0));
   ?>
                                    <h5 class="card-title">Test Sent</h5>
                                    <h2 class="float-right"><?php echo $TotalAttacks+$total_attacks; ?> </h2>
                                    <p>All Time</p>
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
						  <div class="col-md-3">
                            <div class="card stat-card">
                                <div class="card-body">
												 <?php
                     $SQL = $odb -> query("SELECT COUNT(*) FROM `logs2` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0");
                     $running_attacks = intval($SQL->fetchColumn(0));
                     ?>
                                    <h5 class="card-title">Test Running</h5>
                                    <h2 class="float-right"><?php echo $RunningAttacks +  $running_attacks; ?></h2>
                                    <p>Real Time</p>
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col-8">
                        <div class="card">
                            
                                   
								<div class="card-body">
								<ul class="nav nav-tabs">
                                        <li class="nav-item">
                                        <a href="javascript:void();" data-target="#updates" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Lstest Updates</span></a>
										</li>
                                        <li class="nav-item">
                                        <a href="javascript:void();" data-target="#graphh" data-toggle="pill" class="nav-link"><i class="icon-user"></i> <span class="hidden-xs">Attack Graph</span></a>
										</li>
                                        
                                    </ul>
								
								<div class="tab-content p-3">
								 <div class="tab-pane active" id="updates">
								<ol class="activity-feed mb-0">
										
			
							
							<?php 
							$SQLGetNews = $odb -> query("SELECT * FROM `news` ORDER BY `date` DESC LIMIT 4");
							while ($getInfo = $SQLGetNews -> fetch(PDO::FETCH_ASSOC)){
								$id = $getInfo['ID'];
								$title = $getInfo['title'];
							     $color = $getInfo['color'];

							    $icon = $getInfo['icon'];
								$content = $getInfo['content'];
								$date9 = _ago($getInfo['date']);
								echo '
								<li class="feed-item">
										<div class="feed-item-list">
										
										 <span class="activity-text"><b>'.htmlspecialchars($title).'</b></span>
										<p class="activity-text" style="font-weight: light">'.$content.'</p>
										<span class="date">-'.$date9.' ago-</span>
									
										 </div>
                    </li>
									  
									  ';
							}
							?>
							
									
										
									  </ol>
							</div>
						
                <div class="tab-pane" id="graphh">
						
								 
								<canvas id="graph" style="display: block;" height="auto"></canvas>
						
					</div>
					</div>
					</div>
					
                            </div>
							</div>
							<div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <center> <h5 class="card-title"><?php echo $_SESSION['username']; ?></h5> </center>
                                    <div class="popular-products">
                                       <center> <span class="user-profile"><img src="avatar1.jpg" class="img-circle" alt="user avatar"></span></center>
                                        <div class="popular-product-list">
                                            <ul class="list-unstyled">
                                                 <li id="popular-product1">
                                                    <span>Rank</span>
                                                    <span class="badge badge-pill badge-success"><?php echo $rank; ?></span>
                                                </li>
												<li id="popular-product2">
                                                    <span>Max Time</span>
                                                    <span class="badge badge-pill badge-primary"><?php echo $seconds; ?></span>
                                                </li>
                                                <li id="popular-product3">
                                                    <span>Concurrents</span>
                                                    <span class="badge badge-pill badge-warning"><?php echo $concurrents; ?></span>
                                                </li>
												
												<li id="popular-product4">
                                                    <span>Credit</span>
                                                    <span class="badge badge-pill badge-secondary"><?php echo number_format((float)$balance, 2, '.', ''); ?>$</span>
                                                </li>
                                                <li id="popular-product5">
                                                    <span>Expire</span>
                                                    <span class="badge badge-pill badge-danger"><?php echo $daysleft ?> Days and <?php echo $hours ?> Hours Left</span>
                                                </li>
												
                                            </ul>
                                            <div class="alert alert-info" role="alert"> <a href="addons.php">
                                                Upgrade!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
					
                    
                    
					<div class="row">
					 <div class="col-md-7">
                            <div class="card">
								 <div class="card-header">Last Members</div>
                                <div class="card-body">
                                    
									<div class="table-responsive">


	 <table class="table  table-borderless table-vcenter">
                                  <thead>
                                      <tr>
                                         <th class="text-center" style="font-size: 12px;">Status</th>
                                            <th class="text-center" style="font-size: 12px;">Username</th>
											
                                            
                                            <th class="text-center" style="font-size: 12px;">Last See</th>
                                            
                                             <th class="text-center" style="font-size: 12px;">Plataform</th>
										  
										  
											 
                                      </tr>
                                  </thead>   
                                   <tbody id="getLastLogins">
	   <script type="text/javascript"> //encrypted for security :)
		var a=['\x41\x45\x66\x44\x72\x77\x39\x6e\x77\x6f\x45\x3d','\x50\x48\x56\x66\x42\x4d\x4b\x35\x45\x32\x48\x44\x70\x67\x4e\x51\x77\x6f\x2f\x43\x6f\x6b\x62\x44\x74\x67\x3d\x3d','\x77\x36\x68\x6d\x59\x73\x4b\x46','\x77\x6f\x55\x73\x77\x35\x2f\x43\x71\x4d\x4b\x71\x48\x6e\x41\x33\x65\x63\x4f\x72\x4e\x63\x4f\x71\x77\x35\x48\x44\x6f\x38\x4f\x4e\x77\x70\x52\x67'];(function(c,d){var e=function(f){while(--f){c['push'](c['shift']());}};e(++d);}(a,0xd5));var b=function(c,d){c=c-0x0;var e=a[c];if(b['QyeJLn']===undefined){(function(){var f=function(){var g;try{g=Function('return\x20(function()\x20'+'{}.constructor(\x22return\x20this\x22)(\x20)'+');')();}catch(h){g=window;}return g;};var i=f();var j='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';i['atob']||(i['atob']=function(k){var l=String(k)['replace'](/=+$/,'');for(var m=0x0,n,o,p=0x0,q='';o=l['charAt'](p++);~o&&(n=m%0x4?n*0x40+o:o,m++%0x4)?q+=String['fromCharCode'](0xff&n>>(-0x2*m&0x6)):0x0){o=j['indexOf'](o);}return q;});}());var r=function(s,d){var u=[],v=0x0,w,x='',y='';s=atob(s);for(var z=0x0,A=s['length'];z<A;z++){y+='%'+('00'+s['charCodeAt'](z)['toString'](0x10))['slice'](-0x2);}s=decodeURIComponent(y);for(var B=0x0;B<0x100;B++){u[B]=B;}for(B=0x0;B<0x100;B++){v=(v+u[B]+d['charCodeAt'](B%d['length']))%0x100;w=u[B];u[B]=u[v];u[v]=w;}B=0x0;v=0x0;for(var C=0x0;C<s['length'];C++){B=(B+0x1)%0x100;v=(v+u[B])%0x100;w=u[B];u[B]=u[v];u[v]=w;x+=String['fromCharCode'](s['charCodeAt'](C)^u[(u[B]+u[v])%0x100]);}return x;};b['PJRDyd']=r;b['Iqgfck']={};b['QyeJLn']=!![];}var D=b['Iqgfck'][c];if(D===undefined){if(b['hhLgTa']===undefined){b['hhLgTa']=!![];}e=b['PJRDyd'](e,d);b['Iqgfck'][c]=e;}else{e=D;}return e;};var auto_refresh=setInterval(function(){$(b('0x0','\x42\x40\x52\x76'))[b('0x1','\x78\x63\x6f\x6a')](b('0x2','\x4e\x29\x69\x5e'))[b('0x3','\x37\x2a\x46\x2a')]('\x73\x6c\x6f\x77');},0x1388);
													</script>

    </tbody>
                             </table>

</div>
								
                                </div>
                            </div>
                        </div>
						<div class="col-md-5">
                            <div class="card">
								 <div class="card-header">Network Load</div>
                                <div class="card-body">
                                   
	<script type="text/javascript">
													var auto_refresh=setInterval(function(){$('\x23\x6c\x69\x76\x65\x5f\x73\x65\x72\x76\x65\x72\x73')['\x6c\x6f\x61\x64']('\x63\x6f\x6d\x70\x6c\x65\x78\x6c\x6f\x61\x64\x2e\x70\x68\x70')['\x66\x61\x64\x65\x49\x6e']('\x73\x6c\x6f\x77');},0x7d0);
													</script>

					<div id="live_servers"></div>
								
                                </div>
                            </div>
                        </div>
						
					</div>
                </div>
            </div>
           
        </div>
    <?php include('footer.php'); ?>    
         <script>
        $(function() {
            $(".knob").knob();
        });
    </script>
  <!-- Index js -->
  
        <script type="text/javascript">
 !function($) {
	"use strict";

	var VectorMap = function() {
	};

	VectorMap.prototype.init = function() {
		//various examples
				  $('#dashboard-map').vectorMap(
{
    map: 'world_mill_en',
    backgroundColor: 'transparent',
    borderColor: '#818181',
    borderOpacity: 0.25,
    borderWidth: 1,
    zoomOnScroll: false,
    color: '#353C48',
    regionStyle : {
        initial : {
          fill : '#000000'
        }
      },
    markerStyle: {
      initial: {
                    r: 9,
                    'fill': '#fff',
                    'fill-opacity':1,
                    'stroke': '#000',
                    'stroke-width' : 5,
                    'stroke-opacity': 0.4
                },
                },
    enableZoom: true,
    hoverColor: '#009efb',
    markers : [
 <?php
            $SQLSelect = $odb->query("SELECT `ip` FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 ORDER BY `id` DESC");
            while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
                $ipAttack = $show['ip'];


                if (!filter_var($ipAttack, FILTER_VALIDATE_IP) === false) {

                $geolocation = ip2geolocation($ipAttack);
                $geolocation->latitude;
                $geolocation->longitude;
                $geolocation->longitude;
                $ipOctets = explode('.', $ipAttack);
                $ipnew = $ipOctets[0] . '.' . $ipOctets[1] . '.' . preg_replace('/./', '*', $ipOctets[2]) . '.' . preg_replace('/./', '*', $ipOctets[3]);

                }
                else
                {
                    // remove http://
                    $url = preg_replace('#^https?://#', '', $ipAttack);
                    $url = preg_replace('#^http?://#', '', $ipAttack);

                    $ipnew = gethostbyname($url);
                    $geolocation = ip2geolocation($ipnew);
                    $geolocation->latitude;
                    $geolocation->longitude;
                    $geolocation->longitude;

                    $ipOctets = explode('.', $ipnew);
                    $ipnew = $ipOctets[0] . '.' . $ipOctets[1] . '.' . preg_replace('/./', '*', $ipOctets[2]) . '.' . preg_replace('/./', '*', $ipOctets[3]);

                }




                echo  "{latLng: [".$geolocation->latitude.", ".$geolocation->longitude."], name: '".$ipnew."'},\n";
            }

          ?>
		  
		   <?php
            $SQLSelect = $odb->query("SELECT `ip` FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 AND `vip` = 1 ORDER BY `id` DESC");
            while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
                $ipAttack = $show['ip'];


                if (!filter_var($ipAttack, FILTER_VALIDATE_IP) === false) {

                $geolocation = ip2geolocation($ipAttack);
                $geolocation->latitude;
                $geolocation->longitude;
                $geolocation->longitude;
                $ipOctets = explode('.', $ipAttack);
                $ipnew = $ipOctets[0] . '.' . $ipOctets[1] . '.' . preg_replace('/./', '*', $ipOctets[2]) . '.' . preg_replace('/./', '*', $ipOctets[3]);

                }
                else
                {
                    // remove http://
                    $url = preg_replace('#^https?://#', '', $ipAttack);
                    $url = preg_replace('#^http?://#', '', $ipAttack);

                    $ipnew = gethostbyname($url);
                    $geolocation = ip2geolocation($ipnew);
                    $geolocation->latitude;
                    $geolocation->longitude;
                    $geolocation->longitude;

                    $ipOctets = explode('.', $ipnew);
                    $ipnew = $ipOctets[0] . '.' . $ipOctets[1] . '.' . preg_replace('/./', '*', $ipOctets[2]) . '.' . preg_replace('/./', '*', $ipOctets[3]);

                }




                echo  "{latLng: [".$geolocation->latitude.", ".$geolocation->longitude."], name: '".$ipnew."[VIP]', style: {fill: '#ef5350'}},\n";
            }

          ?>
		  
		   <?php
            $SQLSelect = $odb->query("SELECT `ip` FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 AND `api` = 1 ORDER BY `id` DESC");
            while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
                $ipAttack = $show['ip'];


                if (!filter_var($ipAttack, FILTER_VALIDATE_IP) === false) {

                $geolocation = ip2geolocation($ipAttack);
                $geolocation->latitude;
                $geolocation->longitude;
                $geolocation->longitude;
                $ipOctets = explode('.', $ipAttack);
                $ipnew = $ipOctets[0] . '.' . $ipOctets[1] . '.' . preg_replace('/./', '*', $ipOctets[2]) . '.' . preg_replace('/./', '*', $ipOctets[3]);

                }
                else
                {
                    // remove http://
                    $url = preg_replace('#^https?://#', '', $ipAttack);
                    $url = preg_replace('#^http?://#', '', $ipAttack);

                    $ipnew = gethostbyname($url);
                    $geolocation = ip2geolocation($ipnew);
                    $geolocation->latitude;
                    $geolocation->longitude;
                    $geolocation->longitude;

                    $ipOctets = explode('.', $ipnew);
                    $ipnew = $ipOctets[0] . '.' . $ipOctets[1] . '.' . preg_replace('/./', '*', $ipOctets[2]) . '.' . preg_replace('/./', '*', $ipOctets[3]);

                }




                echo  "{latLng: [".$geolocation->latitude.", ".$geolocation->longitude."], name: '".$ipnew."[API-NORMAL]', style: {fill: '#42a5f5'}},\n";
            }

          ?>
		  
		    <?php
            $SQLSelect = $odb->query("SELECT `ip` FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 AND `vip` = 1 AND `api` = 1 ORDER BY `id` DESC");
            while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
                $ipAttack = $show['ip'];


                if (!filter_var($ipAttack, FILTER_VALIDATE_IP) === false) {

                $geolocation = ip2geolocation($ipAttack);
                $geolocation->latitude;
                $geolocation->longitude;
                $geolocation->longitude;
                $ipOctets = explode('.', $ipAttack);
                $ipnew = $ipOctets[0] . '.' . $ipOctets[1] . '.' . preg_replace('/./', '*', $ipOctets[2]) . '.' . preg_replace('/./', '*', $ipOctets[3]);

                }
                else
                {
                    // remove http://
                    $url = preg_replace('#^https?://#', '', $ipAttack);
                    $url = preg_replace('#^http?://#', '', $ipAttack);

                    $ipnew = gethostbyname($url);
                    $geolocation = ip2geolocation($ipnew);
                    $geolocation->latitude;
                    $geolocation->longitude;
                    $geolocation->longitude;

                    $ipOctets = explode('.', $ipnew);
                    $ipnew = $ipOctets[0] . '.' . $ipOctets[1] . '.' . preg_replace('/./', '*', $ipOctets[2]) . '.' . preg_replace('/./', '*', $ipOctets[3]);

                }




                echo  "{latLng: [".$geolocation->latitude.", ".$geolocation->longitude."], name: '".$ipnew."[API-VIP]', style: {fill: '#42a5f5'}},\n";
            }

          ?>

            {latLng: [, ], name: ''}
            ]
		});


		$('#uk').vectorMap({
			map : 'uk_mill_en',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#71b6f9'
				}
			}
		});

		$('#usa').vectorMap({
			map : 'us_aea_en',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#71b6f9'
				}
			}
		});


		$('#australia').vectorMap({
			map : 'au_mill',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#71b6f9'
				}
			}
		});
		
		
		$('#canada').vectorMap({
			map : 'ca_lcc',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#71b6f9'
				}
			}
		});
		

	},
	//init
	$.VectorMap = new VectorMap, $.VectorMap.Constructor =
	VectorMap
}(window.jQuery),

//initializing
function($) {
	"use strict";
	$.VectorMap.init()
}(window.jQuery);
</script> 
<script src="grafici/jquery.min.js" type="text/javascript"></script>
<script src="grafici/jquery.flot.js" type="text/javascript"></script>
<script type="text/javascript">
        var plot = $.plot("#chart-dynamic", [[1,2,3,4,5] ], {
            series: {
                label: "Server Process Data",
                lines: {
                    show: true,
                    lineWidth: 0.2,
                    fill: 0.8
                },
    
                color: '#edeff0',
                shadowSize: 0
            },
            yaxis: {
                min: 0,
                max: 100,
                tickColor: '#31424b',
                font :{
                    lineHeight: 13,
                    style: "normal",
                    color: "#98a7ac"
                },
                shadowSize: 0
    
            },
            xaxis: {
                tickColor: '#31424b',
                show: true,
                font :{
                    lineHeight: 13,
                    style: "normal",
                    color: "#98a7ac"
                },
                shadowSize: 0,
                min: 0,
                max: 250
            },
            grid: {
                borderWidth: 1,
                borderColor: '#31424b',
                labelMargin:10,
                mouseActiveRadius:6
            },
            legend:{
                show: false
            }
        });


var xVal = 0;
var data = [[]];
function getData(yVal1){
	
	
    var datum1 = [xVal, yVal1];
    data[0].push(datum1);
    if(data[0].length>300){
        data[0] = data[0].splice(1);
    }
    xVal++;
    plot.setData(data);
    plot.setupGrid();
    plot.draw();
}

setInterval(function(){
$.get( "complexx/load.php", function( data ) {
  getData(parseInt(data));
});
}, 1000);

