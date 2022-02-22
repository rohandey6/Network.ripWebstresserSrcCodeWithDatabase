<?php
$themeload = true;
$page = 'Store';
	include 'assets/backend/header.php';
	if(isset($_POST['purchase'])){
		$id = htmlspecialchars(htmlentities($_POST['purchase']));
		if(!is_numeric($id)) {
			if($id !== 'Blacklist_Monthly' && $id !== 'Blacklist_Lifetime') {
				die("<script>window.location = 'store';</script>");
			}
		}
		$result = $odb -> prepare("SELECT id,COUNT(id) FROM `plans` WHERE `id` = :id");
		$result->execute(array(":id" => $id));
		$row = $result ->fetch(PDO::FETCH_ASSOC);
		
		if($row['COUNT(id)'] == '0' && $id !== 'Blacklist_Monthly' && $id !== 'Blacklist_Lifetime') {
			echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  type: "error",
  title: "<bb style=\"font-size:22px\">Oops, The package is currently unavailable!</bb>",
  showCloseButton: true,
  
});';
  echo ' }, 1000);</script>';
			
		} else {
			if($id == 'Blacklist_Monthly') {
				if(empty($_POST['host-monthly'])) {
					echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  type: "error",
  title: "<bb style=\"font-size:22px\">Host cannot be empty!</bb>",
  showCloseButton: true,
  
});';
  echo ' }, 1000);</script>';
				
				} else {
				if($_POST['PanelBlacklist-Monthly'] == '1') {
					$panel_Blacklist = 1;
				} else {
					$panel_Blacklist = '0';
				}
				
				die('<script>window.location="invoice?id=Blacklist&panel=' . $panel_Blacklist . '&host=' . htmlentities($_POST['host-monthly']) . '&month=1"</script>');
				}
			} elseif($id == 'Blacklist_Lifetime') {
				if(empty($_POST['host-lifetime'])) {
						echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  type: "error",
  title: "<bb style=\"font-size:22px\">Host cannot be empty!</bb>",
  showCloseButton: true,
  
});';
  echo ' }, 1000);</script>';
				
				} else {
				if($_POST['PanelBlacklist-Lifetime'] == '1') {
					$panel_Blacklist = 1;
				} else {
					$panel_Blacklist = '0';
				}
				die('<script>window.location="invoice?id=Blacklist&panel=' . $panel_Blacklist . '&host=' . htmlentities($_POST['host-lifetime']) . '&lifetime=1"</script>');
				}
			} else {
				$th = $_POST['thr'];
				$sec = $_POST['sec'];
				$con = $_POST['con'];
				$api = $_POST['api'];
				die('<script>window.location="invoice?id=' . $row['id'] . '&concurrents=' . $con . '&seconds=' . $sec . '&threads=' . $th . '&api=' . $api . '"</script>');
			}
		}
	}
	
?>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-zrnmn8R8KkWl12rAZFt4yKjxplaDaT7/EUkKm7AovijfrQItFWR7O/JJn4DAa/gx" crossorigin="anonymous">
			<br>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
		  
			  
            <div class="row second-chart-list third-news-update">
			    <?php
	if($_GET['error'] == 'spam') {
		echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  type: "error",
  title: "<bb style=\"font-size:18px\">Spam detected, Please create a ticket If you think it was an error.</bb>",
  showCloseButton: true,
  
});';
  echo ' }, 1000);</script>';
	} elseif($_GET['error'] == 'host') {
				echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  type: "error",
  title: "<bb style=\"font-size:18px\">The host entered is not standard or not correctly!<bb>",
  showCloseButton: true,
  
});';
  echo ' }, 1000);</script>';
	}
  
		  ?>
			  <div class="col-sm-12 col-xl-12 box-col-5">
                <div class="card">
                  <div class="card-header  bg-primary">
                    <h5>Basic Memberships</h5>
                  </div>
                  <div class="card-body p-0 chart-block">
                    <div class="table-responsive">
					  <table class="table table-responsive-sm">
                       <thead>
						<th class="text-center"><i class="fad fa-info text-primary"></i> Name</th>
						<th class="text-center"><i class="fad fa-server text-primary"></i> VIP</th>
						<th class="text-center"><i class="fad fa-ghost text-primary"></i> Concurrents</th>
						<th class="text-center"><i class="fad fa-clock text-primary"></i> Max Boot Time</th>
						<th class="text-center"><i class="fad fa-calendar text-primary"></i> Length</th>
						<th class="text-center"><i class="fad fa-bug text-primary"></i> PPS</th>
						<th class="text-center"><i class="fad fa-code text-primary"></i> Threads</th>
						<th class="text-center"><i class="fad fa-wallet text-primary"></i> Price</th>
						<th class="text-center"><i class="fad fa-comment-alt-dollar text-primary"></i> Payment</th>
</thead>
                        <tbody>
<?php
$harta = $odb -> query("SELECT * FROM `plans` WHERE `network` = 'normal' ORDER BY `id`");
while($row = $harta ->fetch(PDO::FETCH_ASSOC)){
	$network = '<span class="font-w700"><i class="fa fa-wifi text-primary"></i> Normal Network</i></span>';
	$concurrents = $row['cons'];
echo '
<tr>
<td class="text-center font-w700 text-primary">'.$row['name'].'</td>
<td class="text-center"><i class="fad fa-times-square text-danger fa-2x"></i></td>
<td class="text-center font-w700">'.$concurrents.'</td>
<td class="text-center font-w700">'.$row['maxboot'].' seconds.</td>
<td class="text-center font-w700">'.$row['length'].'</td>
<td class="text-center font-w700">500,000</td>
<td class="text-center font-w700">'.$row['servers'].'</td>
<td class="text-center text-success font-w700" style="font-size: 15px">$'.$row['price'].'</td>
<td class="text-center">
<button class="btn btn-outline-success btn-sm" type="button" data-toggle="modal" data-target="#basic'.$row['id'].'" data-whatever="basic"><i class="fa fa-money text-success"></i> Buy</button>
</td>
</tr>
';
?>
<div class="modal fade" id="basic<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2"><?php echo $row['name']?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
							<div class="form-group">
						  <div class="alert alert-primary dark alert-dismissible fade show" role="alert"><i data-feather="help-circle"></i>
                      <p> One Step More!</p>
                      <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div></div>
                            <form method="POST" action="">
                              <div class="form-group">
                                <label class="col-form-label" for="recipient-name">Extra seconds(+10$ each)</label>
                                <select class="form-control" type="text" id="sec" name="sec">
								<option value="0">Select</option>
								<option value="1">600</option>
								<option value="2">1200</option>
								<option value="3">1800</option>
								<option value="4">2400</option>
								<option value="5">3000</option>
								<option value="6">3600</option>
								<option value="7">4200</option>
								<option value="8">4800</option>
								<option value="9">5400</option>
								<option value="10">6000</option>
							
							</select>
                              </div>
                              <div class="form-group">
                                <label class="col-form-label" for="message-text">Extra concurrents(+35$ each)</label>
                                <select class="form-control" type="text" id="con" name="con">
								<option value="0">Select</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							
							</select>
                              </div>
							   <div class="form-group">
                                <label class="col-form-label" for="message-text">Extra threads(+20$ each)</label>
                                <select class="form-control" type="text" id="thr" name="thr">
								<option value="0">Select</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							
							</select>
                              </div>
							   <div class="form-group">
                                <label class="col-form-label" for="message-text">Enable API Access (+40$)</label>
                                <select class="form-control" type="text" id="api" name="api">
								<option value="0">No</option>
								<option value="1">Yes</option>
								
							
							</select>
                              </div>
                            
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="purchase" value="<?php echo $row['id']; ?>">
							<button type="submit" class="btn btn-outline-dark btn-sm" href="hey"><i class="fad fa-shopping-cart text-success"></i> Buy</button>
                          </div>
						  </form>
                        </div>
                      </div>
                    </div>

<?php
}
?>
</tbody>
                     </table>
                        
                         </div> 
                  </div>
                </div>
              </div>
			  
			   <div class="col-sm-12 col-xl-12 box-col-5">
                <div class="card">
                  <div class="card-header  bg-primary">
                    <h5>VIP Memberships</h5>
                  </div>
                  <div class="card-body p-0 chart-block">
                    <div class="table-responsive">
					  <table class="table table-responsive-sm ">
                       <thead>
						<th class="text-center"><i class="fad fa-info text-primary"></i> Name</th>
						<th class="text-center"><i class="fad fa-server text-primary"></i> VIP</th>
						<th class="text-center"><i class="fad fa-ghost text-primary"></i> Concurrents</th>
						<th class="text-center"><i class="fad fa-clock text-primary"></i> Max Boot Time</th>
						<th class="text-center"><i class="fad fa-calendar text-primary"></i> Length</th>
						<th class="text-center"><i class="fad fa-bug text-primary"></i> PPS</th>
						<th class="text-center"><i class="fad fa-code text-primary"></i> Threads</th>
						<th class="text-center"><i class="fad fa-wallet text-primary"></i> Price</th>
						<th class="text-center"><i class="fad fa-comment-alt-dollar text-primary"></i> Payment</th>
</thead>
                        <tbody>
<?php
$harta = $odb -> query("SELECT * FROM `plans` WHERE `network` = 'vip' ORDER BY `id`");
while($row = $harta ->fetch(PDO::FETCH_ASSOC)){
	$network = '<span class="font-w700"><i class="fa fa-wifi text-danger"></i> VIP Network</i></span>';
	$concurrents = $row['cons'];
echo '
<tr>
<td class="text-center font-w700 text-primary" >'.$row['name'].'</td>
<td class="text-center"><i class="fad fa-check-square text-success fa-2x"></i></td>
<td class="text-center font-w700">'.$concurrents.'</td>
<td class="text-center font-w700">'.$row['maxboot'].' seconds.</td>
<td class="text-center font-w700">'.$row['length'].'</td>
<td class="text-center font-w700">1M</td>
<td class="text-center font-w700">'.$row['servers'].'</td>
<td class="text-center text-success font-w700" style="font-size: 15px">$'.$row['price'].'</td>
<td class="text-center">
<button class="btn btn-outline-success btn-sm" type="button" data-toggle="modal" data-target="#basic'.$row['id'].'" data-whatever="vip"><i class="fa fa-money text-success"></i> Buy</button>
</td>
</tr>
';
?>
<div class="modal fade" id="basic<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2"><?php echo $row['name']?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
						   <div class="form-group">
						  <div class="alert alert-primary dark alert-dismissible fade show" role="alert"><i data-feather="help-circle"></i>
                      <p> One Step More!</p>
                      <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div></div>
					
                            <form method="POST" action="">
                              <div class="form-group">
                                <label class="col-form-label" for="recipient-name">Extra seconds(+10$ each)</label>
                                <select class="form-control" type="text" id="sec" name="sec" onchange="se();">
								<option value="0">Select</option>
									<option value="1">600</option>
								<option value="2">1200</option>
								<option value="3">1800</option>
								<option value="4">2400</option>
								<option value="5">3000</option>
								<option value="6">3600</option>
								<option value="7">4200</option>
								<option value="8">4800</option>
								<option value="9">5400</option>
								<option value="10">6000</option>
							
							</select>
                              </div>
                              <div class="form-group">
                                <label class="col-form-label" for="message-text">Extra concurrents(+35$ each)</label>
                                <select class="form-control" type="text" id="con" name="con" onchange="co();">
								<option value="0">Select</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							
							</select>
                              </div>
							   <div class="form-group">
                                <label class="col-form-label" for="message-text">Extra threads(+20$ each)</label>
                                <select class="form-control" type="text" id="thr" name="thr" onchange="th();">
								<option value="0">Select</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							
							</select>
                              </div>
							   <div class="form-group">
                                <label class="col-form-label" for="message-text">Enable API Access (+40$)</label>
                                <select class="form-control" type="text" id="api" name="api" onchange="ap();">
								<option value="0">No</option>
								<option value="1">Yes</option>
								
							
							</select>
                              </div>
                            
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="purchase" value="<?php echo $row['id']; ?>">
							<button type="submit" class="btn btn-outline-dark btn-sm" href="hey"><i class="fad fa-shopping-cart text-success"> </i> Buy</button>
                          </div>
						  </form>
                        </div>
                      </div>
                    </div>

<?php
}
?>
</tbody>
                     </table>
                        
                         </div> 
                  </div>
                </div>
              </div>
			  
			  <div class="col-sm-12 col-xl-6 box-col-5">
                <div class="card">
                  <div class="card-header  bg-primary">
                    <h5>Blacklist Monthly</h5>
                  </div>
                  <div class="card-body">
                    <span>Blacklist panel buttom allow you edit the host anytime you want </span>
					<hr>
		 <form method="POST" action="">
         <div class="row">
            <div class="form-group text-center col-md-7">
               <label for="example-nf-email">Host</label>
               <input type="text" class="form-control" id="host-monthly" name="host-monthly" maxlength="30" onkeydown="checkHostMonthly()" placeholder="0.0.0.0 / Example.com">
            </div>
			<div class="form-group text-right col-md-5">
            <div class="form-group">
               <label for="example-nf-email">Panel Access</label>
               <div class="row">
			   
                  <div class="col-md-12 text-right">
                     <label class="switch">
                     <input type="checkbox" onChange="checkPanelBlacklistMonthly()" id="PanelBlacklist-Monthly" name="PanelBlacklist-Monthly" value="0">
                    <span class="switch-state"></span>
                     </label>
                  </div>
               </div>
            </div>
         </div>
		 </div>
         <div class="form-group text-right">
            <div class="row">
               <div class="col-md-6 text-left">Total cost: <button id="totalCost-Monthly" class="btn btn-sm btn-pill btn-primary text-white">
                  <i class="fa fa-usd"></i><bb id="cost-Monthly">15</bb>
                  </button>
               </div>
               <div class="col-md-6">
						<input type="hidden" name="purchase" value="Blacklist_Monthly">
						<button id="totalCost-Monthly" class="btn btn-primary text-white">Buy
                  </button>
               </div>
			   </form>
                  </div>
                </div>
              </div>
			   </div>
			    </div>
						 <script>
		 var auto_refresh = setInterval(
			function ()
			{
			checkHostMonthly();
			}, 10);
			
		 function checkHostMonthly() {
			var ip = checkIsIPV4($("#host-monthly").val())
			var host = isValidURL($("#host-monthly").val())
			if(ip == false & host == false) {
				$('#purchase-monthly').prop('disabled', true);
			} else {
				$('#purchase-monthly').prop('disabled', false);
			}
		 }
		 
			function checkPanelBlacklistMonthly() {
				if (document.querySelector('#PanelBlacklist-Monthly').checked) {
					document.getElementById('PanelBlacklist-Monthly').setAttribute('value', '1');
					$("#totalCost-Monthly").removeClass("animated bounceIn")
					$("#totalCost-Monthly").addClass("animated bounceIn")
					$("#cost-Monthly").text("25")
				} else {
					document.getElementById('PanelBlacklist-Monthly').setAttribute('value', '0');
					$("#totalCost-Monthly").removeClass("animated bounceIn")
					$("#cost-Monthly").text("15")
				}
			}
		</script>
			  <div class="col-sm-12 col-xl-6 box-col-5">
                <div class="card">
                  <div class="card-header  bg-primary">
                    <h5>Blacklist Lifetime</h5>
                  </div>
                  <div class="card-body">
                    <span>Blacklist panel buttom allow you edit the host anytime you want</span>
					<hr>
		 <form method="POST" action="">
         <div class="row">
            <div class="form-group text-center col-md-7">
               <label for="example-nf-email">Host</label>
               <input type="text" class="form-control" id="host-lifetime" maxlength="30" name="host-lifetime" onkeydown="checkHostLifetime()" placeholder="0.0.0.0 / Example.com">
            </div>
			<div class="form-group text-right col-md-5">
            <div class="form-group">
               <label for="example-nf-email">Panel Access</label>
               <div class="row">
			   <div class="col-md-12 text-right">
                     <label class="switch">
                     <input type="checkbox" onChange="checkPanelBlacklistLifetime()" id="PanelBlacklist-Lifetime" name="PanelBlacklist-Lifetime" value="0">
                    <span class="switch-state"></span>
                     </label>
                  </div>
			   
               </div>
            </div>
			 </div>
         </div>
         <div class="form-group text-right">
            <div class="row">
               <div class="col-md-6 text-left">Total cost: <button id="totalCost-Lifetime" class="btn btn-sm btn-pill btn-primary text-white">
                  <i class="fa fa-usd"></i><bb id="cost-Lifetime">200</bb>
                  </button>
               </div>
               <div class="col-md-6">
						<input type="hidden" name="purchase" value="Blacklist_Lifetime">
						<button id="totalCost-Monthly" class="btn btn-primary text-white">Buy
                  </button>
               </div>
			   </form>
                  </div>
                </div>
              </div>
			   </div>
			    </div>
				<div class="col-sm-12 col-xl-4 box-col-5">
                <div class="card">
                  <div class="card-header  bg-primary">
                    <h5>Addon seconds</h5>
                  </div>
                  <div class="card-body">
                    
            <div class="form-group text-center col-lg-12">
               
                <select class="form-control" type="text" id="seconds" name="seconds" oninput="checkseconds()">
								<option value="0">Select</option>
								<option value="1">600</option>
								<option value="2">1200</option>
								<option value="3">1800</option>
								<option value="4">2400</option>
								<option value="5">3000</option>
								<option value="6">3600</option>
								<option value="7">4200</option>
								<option value="8">4800</option>
								<option value="9">5400</option>
								<option value="10">6000</option>
							
							</select>
            </div>
			
		 
         <div class="form-group text-right">
            <div class="row">
               <div class="col-md-6 text-left">Cost:
                  <bb class="badge badge-primary" id="ani"> $<bb id="cost-sec">0</bb></bb>
                  
               </div>
               <div class="col-md-6">
						<button id="buy1" onclick="buy_sec()"class="btn btn-primary text-white btn-sm">Buy
                  </button>
               </div>
                  </div>
                </div>
              </div>
			   </div>
			    </div>
				<div class="col-sm-12 col-xl-4 box-col-5">
                <div class="card">
                  <div class="card-header  bg-primary">
                    <h5>Addon Concurrents</h5>
                  </div>
                  <div class="card-body">
                    
            <div class="form-group text-center col-lg-12">
               
                <select class="form-control" type="text" id="concu" name="concu" oninput="checkconcu()">
								<option value="0">Select</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							
							</select>
            </div>
			
		 
         <div class="form-group text-right">
            <div class="row">
               <div class="col-md-6 text-left">Cost: 
                  <bb class="badge badge-primary" id="ani2"> $<bb id="cost-concu">0</bb></bb>
               </div>
               <div class="col-md-6">
						<button id="buy2" onclick="buy_concu()"class="btn btn-primary text-white btn-sm">Buy
                  </button>
               </div>
                  </div>
                </div>
              </div>
			   </div>
			    </div>
				<div class="col-sm-12 col-xl-4 box-col-5">
                <div class="card">
                  <div class="card-header  bg-primary">
                    <h5>Addon Threads</h5>
                  </div>
                  <div class="card-body">
                    
            <div class="form-group text-center col-lg-12">
               
                <select class="form-control" type="text" id="threads" name="threads" oninput="checkth()">
								<option value="0">Select</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							
							</select>
            </div>
			
		 
         <div class="form-group text-right">
            <div class="row">
               <div class="col-md-6 text-left">Cost:
                  <bb class="badge badge-primary" id="ani3"> $<bb id="cost-th">0</bb></bb>
                 
               </div>
               <div class="col-md-6">
						<button id="buy2" onclick="buy_th()"class="btn btn-primary text-white btn-sm">Buy
                  </button>
               </div>
                  </div>
                </div>
              </div>
			   </div>
			    </div>
				
				<script>
		  function checkseconds() {
			$("#ani").addClass("animated bounceIn")
			  var price = $('#seconds').val()*10;
			$("#cost-sec").text(price)
				
			}
			function checkconcu() {
			$("#ani2").addClass("animated bounceIn")
			  var price = $('#concu').val()*35;
			$("#cost-concu").text(price)
				
			}
			function checkth() {
			$("#ani3").addClass("animated bounceIn")
			  var price = $('#threads').val()*20;
			$("#cost-th").text(price)
				
			}
			
			function buy_sec() {
				var amount=$('#seconds').val();
                    swal({
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-success m-5",
                        cancelButtonClass: "btn btn-danger m-5",
                        inputClass: "form-control",
                        title: "Confirm",
                        text: "Are you sure you want to Buy?",
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
      
      				 if(xmlhttp.responseText == "SUCCESS:ADDED") {
						 swal('Success!', 'Seconds was successfully added', 'success');
						
      				} else {
      					swal('Opss!', xmlhttp.responseText, 'error')
      				}
      
      					}
      				}
      			
      			
      			xmlhttp.open("GET","assets/backend/addons.php?amount=" + amount + "&action=seconds",true);
      			xmlhttp.send();
      			
					   
                    }, function(n) {})

                }
			
			function buy_concu() {
				var amount=$('#concu').val();
                    swal({
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-success m-5",
                        cancelButtonClass: "btn btn-danger m-5",
                        inputClass: "form-control",
                        title: "Confirm",
                        text: "Are you sure you want to Buy?",
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
      
      				 if(xmlhttp.responseText == "SUCCESS:ADDED") {
						 swal('Success!', 'Concurrents was successfully added', 'success');
						
      				} else {
      					swal('Opss!', xmlhttp.responseText, 'error')
      				}
      
      					}
      				}
      			
      			
      			xmlhttp.open("GET","assets/backend/addons.php?amount=" + amount + "&action=concurrent",true);
      			xmlhttp.send();
      			
					   
                    }, function(n) {})

                }
				
				function buy_th() {
				var amount=$('#threads').val();
                    swal({
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-success m-5",
                        cancelButtonClass: "btn btn-danger m-5",
                        inputClass: "form-control",
                        title: "Confirm",
                        text: "Are you sure you want to Buy?",
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
      
      				 if(xmlhttp.responseText == "SUCCESS:ADDED") {
						 swal('Success!', 'Threads was successfully added', 'success');
						
      				} else {
      					swal('Opps!', xmlhttp.responseText, 'error')
      				}
      
      					}
      				}
      			
      			
      			xmlhttp.open("GET","assets/backend/addons.php?amount=" + amount + "&action=threads",true);
      			xmlhttp.send();
      			
					   
                    }, function(n) {})

                }
			
		
		</script>
				
						 <script>
		  var auto_refresh = setInterval(
			function ()
			{
			checkHostLifetime();
			}, 10);
			
		 function checkHostLifetime() {
			var ip = checkIsIPV4($("#host-lifetime").val())
			var host = isValidURL($("#host-lifetime").val())
			if(ip == false & host == false) {
				$('#purchase-lifetime').prop('disabled', true);
			} else {
				$('#purchase-lifetime').prop('disabled', false);
			}
		 }

			function checkPanelBlacklistLifetime() {
				if (document.querySelector('#PanelBlacklist-Lifetime').checked) {
					document.getElementById('PanelBlacklist-Lifetime').setAttribute('value', '1');
					$("#totalCost-Lifetime").removeClass("animated bounceIn")
					$("#totalCost-Lifetime").addClass("animated bounceIn")
					$("#cost-Lifetime").text("300")
				} else {
					document.getElementById('PanelBlacklist-Lifetime').setAttribute('value', '0');
					$("#totalCost-Lifetime").removeClass("animated bounceIn")
					$("#cost-Lifetime").text("200")
				}
			}
			
			function checkIsIPV4(entry) {
			  var blocks = entry.split(".");
			  if(blocks.length === 4) {
				return blocks.every(function(block) {
				  return parseInt(block,10) >=0 && parseInt(block,10) <= 255;
				});
			  }
			  return false;
			}
			
			function isValidURL(str) {
				var pattern = new RegExp('^((https?:)?\\/\\/)?'+ 
					'(?:\\S+(?::\\S*)?@)?' + 
					'((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ 
					'((\\d{1,3}\\.){3}\\d{1,3}))'+
					'(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+
					'(\\?[;&a-z\\d%_.~+=-]*)?'+ 
					'(\\#[-a-z\\d_]*)?$','i');
				if (!pattern.test(str)) {
					return false;
				} else {
					return true;
				}
			}
		
		</script>
		
			
             
            </div>
          </div>
          <!-- Container-fluid Ends-->
       </div>
	   </div>
<?php require_once 'assets/backend/footer.php'; ?>
    