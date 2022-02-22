	<?php
$themeload = true;
$page = 'Payments';

include 'assets/backend/header.php';

	?>


            <br>
			
          
          <!-- Container-fluid starts-->
          <div class="container-fluid">
		  
		  <div class="row">
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="alert-triangle"></i></div>
                      <div class="media-body"><span class="m-0">Pending</span>
					  <?php				
			$SQL = $odb -> prepare("SELECT COUNT(*) FROM `payments` WHERE `username` = :username AND `status` = '0'");
			$SQL -> execute(array(':username' => $_SESSION['username']));
			$count = $SQL -> fetchColumn(0);
			?>
                        <h4 class="mb-0 counter"><?= $count; ?></h4><i class="icon-bg" data-feather="alert-triangle"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="x-circle"></i></div>
                      <div class="media-body"><span class="m-0">Canceled</span>
					  <?php				
			$SQL = $odb -> prepare("SELECT COUNT(*) FROM `payments` WHERE `username` = :username AND `status` = '1'");
			$SQL -> execute(array(':username' => $_SESSION['username']));
			$count = $SQL -> fetchColumn(0);
			?>
                        <h4 class="mb-0 counter"><?= $count; ?></h4><i class="icon-bg" data-feather="x-circle"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="credit-card"></i></div>
                      <div class="media-body"><span class="m-0">Paid</span>
					  <?php				
			$SQL = $odb -> prepare("SELECT COUNT(*) FROM `payments` WHERE `username` = :username AND `status` = '2'");
			$SQL -> execute(array(':username' => $_SESSION['username']));
			$count = $SQL -> fetchColumn(0);
			?>
                        <h4 class="mb-0 counter"><?= $count; ?> </h4><i class="icon-bg" data-feather="credit-card"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="dollar-sign"></i></div>
                      <div class="media-body"><span class="m-0">ALL</span>
					  <?php				
			$SQL = $odb -> prepare("SELECT COUNT(*) FROM `payments` WHERE `username` = :username");
			$SQL -> execute(array(':username' => $_SESSION['username']));
			$count = $SQL -> fetchColumn(0);
			?>
                        <h4 class="mb-0 counter"><?= $count; ?></h4><i class="icon-bg" data-feather="dollar-sign"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
			  </div>
			  
			  
		  
		  
            <div class="row second-chart-list third-news-update">
			  
			  
			
              
               <div class="col-lg-12">
                    <div class="card">
					<div class="card-header  bg-primary">
                    <h5>Invoice Tables</h5>
                  </div>
                      <div class="card-body">
					  
                          
					  <div class="table-responsive">
					  <table class="table table-responsive-sm table-bordernone">
                        <thead>
                           <tr>
                        <th style="width: 100px;" class="text-center">ID</th>
                        <th class="text-center">Status</th>
                        <th class="d-none d-sm-table-cell text-center">Submitted</th>
                        <th class="d-none d-sm-table-cell text-center">IP Address</th>
                        <th class="d-none d-sm-table-cell text-center">Plan</th>
                        <th class="text-center">Value</th>
                    </tr>
                        </thead>
                         <tbody>
                   
                   <?php
$newssql = $odb -> query("SELECT * FROM `payments` WHERE `username` = '" . $_SESSION['username'] . "'ORDER BY `id` DESC LIMIT 50");
while($row = $newssql ->fetch(PDO::FETCH_ASSOC)){
	if($row['status'] == '0') {
		$statusPayment = '<span class="badge badge-warning">Pending</span>';
	} elseif($row['status'] == '1') {
		$statusPayment = '<span class="badge badge-danger">Canceled</span>';
	} elseif($row['status'] == '2') {
		$statusPayment = '<span class="badge badge-success">Completed</span>';
	}
	
	$Planinfo = $odb -> query("SELECT `name`,`price` FROM `plans` WHERE `id` = '" . $row['planID'] . "'");
$rowPlan = $Planinfo ->fetch(PDO::FETCH_ASSOC);
    ?>
	 <tr>
                        <td class="text-center">
                            <a class="font-w600" href="invoice?number=<?= $row['invoiceID']; ?>">#<?= htmlentities($row['invoiceID']); ?></a>
                        </td>
                        <td class="text-center">
                           <?= $statusPayment; ?>
                        </td>
                        <td class="d-none d-sm-table-cell text-center">
                            <?= date("m/d/y - h:i:s", htmlentities($row['date'])); ?></td>
                        <td class="d-none d-sm-table-cell text-center">
                            <a href="javascript:void(0)"><?= htmlentities($row['IP']); ?></a>
                        </td>
                        <td class="d-none d-sm-table-cell text-center">
						<?php
						if(strpos($row['planID'], "Blacklist") !== false) { 
							$rowInfo = explode("_", $row['planID']);
							$rowPlan['price'] = $rowInfo[4];
							echo '<a href="store">Blacklist ' . $rowInfo[1] . '</a>';
						} else {
							echo '<a href="store">' . $rowPlan['name'] . '</a>';
						}
						?>
                        </td>
                        <td class="text-center">
                            <span class="text-grey">$<?= $rowPlan['price']; ?></span>
                        </td>
                    </tr>
	<?php
}
?>
				   
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