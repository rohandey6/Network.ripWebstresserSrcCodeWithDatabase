<?php
   $themeload = true;
   $page = 'Home';
   
   include 'assets/backend/header.php';
   
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
   
       $monthdaysago = time() - 2628000;
   		$monthdaysago_after = $monthdaysago + 86400;
   		
   		$today = time();
   
   		
   //Get needed information
   $SQL = $odb -> query("SELECT COUNT(*) FROM `servers` WHERE `status` = '1'");
   $online_servers = intval($SQL->fetchColumn(0));
   
   $SQL = $odb -> query("SELECT COUNT(*) FROM `users`");
   $registered_users = intval($SQL->fetchColumn(0));
   
   $SQL = $odb -> query("SELECT COUNT(*) FROM `logs`");
   $total_attacks = intval($SQL->fetchColumn(0));
   
   $SQL = $odb -> query("SELECT COUNT(*) FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 ");
   $running_attacks = intval($SQL->fetchColumn(0));
   
   		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` > :date AND `stopped` = '0'");
   		$SQL -> execute(array(":date" => $onedayago));
   		$started_count_one = $SQL->fetchColumn(0);
   
   		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after AND `stopped` = '0'");
   		$SQL -> execute(array(":before" => $twodaysago, ":after" => $twodaysago_after));
   		$started_count_two = $SQL->fetchColumn(0);
   
   		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after AND `stopped` = '0'");
   		$SQL -> execute(array(":before" => $threedaysago, ":after" => $threedaysago_after));
   		$started_count_three = $SQL->fetchColumn(0);
   
   		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after AND `stopped` = '0'");
   		$SQL -> execute(array(":before" => $fourdaysago, ":after" => $fourdaysago_after));
   		$started_count_four = $SQL->fetchColumn(0);
   
   		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after AND `stopped` = '0'");
   		$SQL -> execute(array(":before" => $fivedaysago, ":after" => $fivedaysago_after));
   		$started_count_five = $SQL->fetchColumn(0);
   
   		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after AND `stopped` = '0'");
   		$SQL -> execute(array(":before" => $sixdaysago, ":after" => $sixdaysago_after));
   		$started_count_six = $SQL->fetchColumn(0);
   
   		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after AND `stopped` = '0'");
   		$SQL -> execute(array(":before" => $sevendaysago, ":after" => $sevendaysago_after));
   		$started_count_seven = $SQL->fetchColumn(0);
   		
   	
   		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` > :date AND `stopped` = '1'");
   		$SQL -> execute(array(":date" => $onedayago));
   		$stopped_count_one = $SQL->fetchColumn(0);
   
   		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after AND `stopped` = '1'");
   		$SQL -> execute(array(":before" => $twodaysago, ":after" => $twodaysago_after));
   		$stopped_count_two = $SQL->fetchColumn(0);
   
   		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after AND `stopped` = '1'");
   		$SQL -> execute(array(":before" => $threedaysago, ":after" => $threedaysago_after));
   		$stopped_count_three = $SQL->fetchColumn(0);
   
   		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after AND `stopped` = '1'");
   		$SQL -> execute(array(":before" => $fourdaysago, ":after" => $fourdaysago_after));
   		$stopped_count_four = $SQL->fetchColumn(0);
   
   		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after AND `stopped` = '1'");
   		$SQL -> execute(array(":before" => $fivedaysago, ":after" => $fivedaysago_after));
   		$stopped_count_five = $SQL->fetchColumn(0);
   
   		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after AND `stopped` = '1'");
   		$SQL -> execute(array(":before" => $sixdaysago, ":after" => $sixdaysago_after));
   		$stopped_count_six = $SQL->fetchColumn(0);
   
   		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after AND `stopped` = '1'");
   		$SQL -> execute(array(":before" => $sevendaysago, ":after" => $sevendaysago_after));
   		$stopped_count_seven = $SQL->fetchColumn(0);
   
   
   		$date_one = date('d/m/Y', time());
   		$date_two = date('d/m/Y', $onedayago);
   		$date_three = date('d/m/Y', $twodaysago);
   		$date_four = date('d/m/Y', $threedaysago);
   		$date_five = date('d/m/Y', $fourdaysago);
   		$date_six = date('d/m/Y', $fivedaysago);
   		$date_seven = date('d/m/Y', $sixdaysago);
   
       $SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
   		$SQL -> execute(array(":before" => $monthdaysago, ":after" => time()));
   		$count_month = $SQL->fetchColumn(0);
   
   ?>

            <br>
			
          
          <!-- Container-fluid starts-->
          <div class="container-fluid">
		  
		  <div class="row">
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="database"></i></div>
                      <div class="media-body"><span class="m-0">Total Tests</span>
                        <h4 class="mb-0 counter"><?= $total_attacks; ?></h4><i class="icon-bg" data-feather="database"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="zap"></i></div>
                      <div class="media-body"><span class="m-0">Running</span>
                        <h4 class="mb-0 counter"><?= $running_attacks+0; ?></h4><i class="icon-bg" data-feather="zap"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="server"></i></div>
                      <div class="media-body"><span class="m-0">Servers</span>
                        <h4 class="mb-0 counter"><?= $online_servers; ?> </h4><i class="icon-bg" data-feather="server"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="users"></i></div>
                      <div class="media-body"><span class="m-0">Total Users</span>
                        <h4 class="mb-0 counter"><?= $registered_users; ?></h4><i class="icon-bg" data-feather="users"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
			  </div>
			  
			  
		  
		  
            <div class="row second-chart-list third-news-update">
			 
			
			<div class="col-sm-12 col-xl-7 box-col-7">
                <div class="card">
                  <div class="card-header bg-primary">
                    <h5>News & Updates</h5>
                    
                  </div>
                  <div class="card-body">
				  <ul class="crm-activity">
<?php
                        $newssql = $odb -> query("SELECT * FROM `news` WHERE `popup` = '0' ORDER BY `id` DESC LIMIT 5");
                        while($row = $newssql ->fetch(PDO::FETCH_ASSOC)){ ?>
  <li class="media">
    <span class="mr-3 font-primary"><i class="<?php echo $row['icon']; $row['color'];?>"></i></span>
    <div class="align-self-center media-body">
      <h6 class="mt-0"><?php echo $row['title-span']; ?></h6>
      <ul class="dates">
        <li class="digits"><?php echo $row['message'];?></li>
        <li class="digits"><?php echo time_elapsed_string($row['date']); ?></li>
      </ul>
    </div>
  </li>
  <?php }  ?>
</ul>
                  </div>
                </div>
              </div>
			  <div class="col-sm-12 col-xl-5 box-col-5">
			  <?php
			   if($userData['rank'] == '10') {
				    $rankdesign = '<bb class="text-danger">Admin</bb>';
			   }elseif($_SESSION['vip'] == 'Yes' && $hasPlan) {
				   $rankdesign = '<bb class="text-warning">VIP</bb>';
			   } elseif($_SESSION['vip'] == 'No' && $hasPlan) {
				    $rankdesign = '<bb class="text-success">Membership</bb>';
			   } else {
				    $rankdesign = '<bb class="text-gray">User</bb>';
			   }
			   ?>
                <div class="card custom-card">
                  <div class="card-header"><img class="img-fluid" src="assets/images/user-card/back.jpg" alt=""></div>
                  <div class="card-profile"><img class="img-100 rounded-circle" height="125px" width="125px" src="<?php echo $userData['avatar']; ?>" alt=""></div>
                  
                  <div class="text-center profile-details">
                    <h4><?php echo ucfirst($_SESSION['username']); ?></h4>
                    <h6>[<?= $rankdesign; ?>]</h6>
                  </div>
                  <div class="card-footer row">
                    <div class="col-3 col-sm-3">
                      <h6>Boot time</h6>
                      <h5><span class="counter"><?php echo $max_boot_time; ?></span></h5>
                    </div>
                    <div class="col-3 col-sm-3">
                      <h6>Concurrents</h6>
                      <h5><span class="counter"><?php echo $myconcurrents; ?></span></h5>
                    </div>
					
                    <div class="col-3 col-sm-3">
                      <h6>Balance</h6>
                      <h5><span class="counter">
					  $<?php echo $userData['acc-balance']; ?></span></h5>
                    </div>
					   <div class="col-3 col-sm-3">
                      <h6>Expire</h6>
                      <h5><span class="counter">
					  <?php echo $date2; ?> </span></h5>
                    </div>
                  </div>
                </div>
              </div>
			  <div class="col-sm-12 col-xl-7 box-col-7">
                <div class="card">
                  <div class="card-header   bg-primary">
                    <h5>Attacks Graph </h5>
                  </div>
                  <div class="card-body">
                     <div id="area-spaline"></div>
                  </div>
                </div>
              </div>

			  <div class="col-sm-12 col-xl-5 box-col-5">
                <div class="card">
                  <div class="card-header  bg-primary">
                    <h5>Methods</h5>
                  </div>
                  <div class="card-body p-0 chart-block">
                    <div class="chart-overflow" id="pie-chart2"></div>
                  </div>
                </div>
              </div>
			  
			
              
               <div class="col-lg-12">
                    <div class="card">
					<div class="card-header  bg-primary">
                    <h5>Last Logins</h5>
                  </div>
                      <div class="card-body">
					  
                          
					  <div class="table-responsive">
					  <table class="table table-responsive-sm table-bordernone">
                        <thead>
                           <tr>
                              <th class="text-center" style="width: 50px; padding: 5px;">Status</th>
                              <th class="text-center" style="width: 50px; padding: 5px;">Rank</th>
                              <th class="text-center" style="width: 50px; padding: 5px;">Username</th>
                              
                              <th class="text-center" style="width: 50px; padding: 5px;">Country</th>
                              <th class="text-center" style="width: 50px; padding: 5px;">Platform</th>
                              <th class="text-center" style="width: 50px; padding: 5px;">Logged In</th>
                           </tr>
                        </thead>
                        <tbody id="getLastLogins">
                           <script type="text/javascript">
   
    var auto_refresh = setInterval(
    function ()
    {
     $('#getLastLogins').load('assets/backend/getLastLogins.php');
    }, 5000);
   </script>
                        </tbody>
                     </table>
                        
                         </div>    
                            
						   
                      </div>
                    </div>
                  </div>
             
            </div>
          </div>
          <!-- Container-fluid Ends-->
       </div>
	   </div>
<?php require_once 'assets/backend/footer.php'; ?>
<script src="assets/js/config.js"></script>
    <script src="assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="assets/js/tooltip-init.js"></script>
<!-- Page JS Code -->
<script>
		  var one = "<?php echo $date_one; ?>";
          var two = "<?php echo $date_two; ?>";
          var three = "<?php echo $date_three; ?>";
          var four = "<?php echo $date_four; ?>";
          var five = "<?php echo $date_five; ?>";
          var six = "<?php echo $date_six; ?>";
          var seven = "<?php echo $date_seven; ?>";
// area spaline chart
var options1 = {
    chart: {
        height: 340,
        type: 'area',
        toolbar:{
          show: false
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth'
    },
    series: [{
        name: 'Attacks',
        data: [<?php echo $started_count_seven; ?>, <?php echo $started_count_six; ?>, <?php echo $started_count_five; ?>, <?php echo $started_count_four; ?>, <?php echo $started_count_three; ?>, <?php echo $started_count_two; ?>, <?php echo $started_count_one; ?>]
    }, {
        name: 'Stopped',
        data: [<?php echo $stopped_count_seven; ?>, <?php echo $stopped_count_six; ?>, <?php echo $stopped_count_five; ?>, <?php echo $stopped_count_four; ?>, <?php echo $stopped_count_three; ?>, <?php echo $stopped_count_two; ?>, <?php echo $stopped_count_one; ?>]
    }],

    xaxis: {
        type: 'date',
        categories: [seven, six, five, four, three, two, one],
		 labels: {
          show: false,
		 },
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy'
        },
    },
	 legend: {
      show: true,
      position: 'top',
	  horizontalAlign: 'center', 
	  floating: false,
	  itemMargin: {
          horizontal: 12,
          vertical: 5
      },
	  fontSize: '16px'
	 },
        colors: [ CubaAdminConfig.primary , CubaAdminConfig.secondary ],
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.5,
            stops: [0, 80, 100]
        }
    },
}

var chart1 = new ApexCharts(
    document.querySelector("#area-spaline"),
    options1
);

chart1.render();
</script>
    <script src="assets/js/chart/google/google-chart-loader.js"></script>
<script>
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.load('current', {'packages':['line']});
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawBasic);
function drawBasic() {
      var data = google.visualization.arrayToDataTable([
        ['Method', 'Uses'],
 <?php
$i = 1;
$fetchUsers = $odb->query("SELECT `method`, COUNT(*) AS `total` FROM `logs` GROUP BY `method` LIMIT 5");
while ($row = $fetchUsers->fetch(PDO::FETCH_ASSOC)) {
echo "['" . $row['method'] . "', " . $row['total'] . "]";
if ($i < $fetchUsers->rowCount()) echo ",";
$i++;
}
?>
      ]);
      var options = {
        is3D: true,
        width:'100%',
        height: 350,
		 legend: {
      show: true,
      position: 'bottom',
	  horizontalAlign: 'center'
	 },
        colors: ["#f8d62b", "#a927f9" , "#51bb25", CubaAdminConfig.secondary , CubaAdminConfig.primary ]
      };
      var chart = new google.visualization.PieChart(document.getElementById('pie-chart2'));
      chart.draw(data, options);
}
</script>
    