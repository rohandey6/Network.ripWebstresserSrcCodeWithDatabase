<?php
$themeload = true;
$page = 'Blacklist Panel';

include 'assets/backend/header.php';
$checkBlacklisted = $odb->query("SELECT COUNT(id) FROM `blacklisted` WHERE `username` = '" . $_SESSION['username'] . "'");
$row = $checkBlacklisted->fetch(PDO::FETCH_BOTH);

?>
 <br>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
		  
		  <div class="row">
		  <?php
$blacklist = $odb->query("SELECT *,COUNT(id) FROM `blacklisted` WHERE `username` = '" . $_SESSION['username'] . "'");
$BlacklistStatus = $blacklist->fetch(PDO::FETCH_BOTH);
?>
              <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="dollar-sign"></i></div>
                      <div class="media-body"><span class="m-0">Purchased</span>
                        <h4 class="mb-0 counter"><?= $BlacklistStatus['COUNT(id)']; ?></h4><i class="icon-bg" data-feather="dollar-sign"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
			  <?php
$blacklist = $odb->query("SELECT COUNT(id) FROM `blacklisted` WHERE `username` = '" . $_SESSION['username'] . "' AND `expire` > UNIX_TIMESTAMP(NOW())");
$BlacklistStatus = $blacklist->fetch(PDO::FETCH_BOTH);
?>
              <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="zap"></i></div>
                      <div class="media-body"><span class="m-0">Available</span>
                        <h4 class="mb-0 counter"><?= $BlacklistStatus['COUNT(id)']; ?></h4><i class="icon-bg" data-feather="zap"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
			  <?php
$blacklist = $odb->query("SELECT COUNT(id) FROM `blacklisted` WHERE `username` = '" . $_SESSION['username'] . "' AND `expire` < UNIX_TIMESTAMP(NOW())");
$BlacklistStatus = $blacklist->fetch(PDO::FETCH_BOTH);
?>
              <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="zap-off"></i></div>
                      <div class="media-body"><span class="m-0">Expired</span>
                        <h4 class="mb-0 counter"><?= $BlacklistStatus['COUNT(id)']; ?></h4><i class="icon-bg" data-feather="zap-off"></i>
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
                    <h5>Active Host</h5>
                  </div>
                      <div class="card-body">
					  
                          
					  <div class="table-responsive">
					  <table class="table table-responsive-sm">
                        <thead>
                           <tr>
<th class="text-center" style="width: 50px;">#</th>
<th class="text-center" style="width: 50px;">Host</th>
<th class="text-center" style="width: 50px;">Expire</th>
<th class="text-center" style="width: 50px;">Action</th>
</tr>
                        </thead>
                       <tbody><?php
	$newsList = $odb -> query("SELECT * FROM `blacklisted` WHERE `username` = '" . $_SESSION['username'] . "' AND `expire` > UNIX_TIMESTAMP(NOW()) ORDER BY `id` DESC;");

while($row = $newsList ->fetch(PDO::FETCH_ASSOC)){
if($row['panelaccess'] == '0') {
	$disabled = "disabled"; 
} else {
	$disabled = ""; 
}
echo '
<tr>
<td class="text-center"><bb class="badge" style="background: #00000024;">' . $row['id'] . '</bb></td>
<td class="text-center"><bb class="badge" style="background: #00000024;">' . $row['value'] . '</bb></td>
<td class="text-center"><bb class="badge badge-primary">' . date('m/d/y - h:i:s', $row['expire']) . '</bb></td>

<td class="text-center">
<button type="button" class="btn btn-primary btn-pill btn-sm" data-toggle="modal" data-target="#editnew-' . $row['id'] . '"' . $disabled . '><i class="fa fa-edit"></i></button>
</td>
</tr>

'; ?>
<?php if($row['panelaccess'] !== '0') { ?>
<div class="modal fade" id="editnew-<?= $row['id']?>" tabindex="-1" role="dialog" aria-labelledby="modal-popout" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-dialog-popout" role="document">
<div class="modal-content">
<div class="modal-header bg-primary">
<h5 class="modal-title"><i class="fa fa-edit"></i> Update</h5>
 <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
<div class="form-group">
<div id="ResponeHost<?= $row['id']; ?>"></div>
</div>
<div class="form-group">
<label for="example-nf-email">Host</label>
<input type="text" class="form-control" id="host<?= $row['id'];?>" value="<?= $row['value']; ?>" name="host<?= $row['id'];?>">
</div>

<div class="col-md-12">
<center><button type="submit" class="btn btn-primary" onclick="updateHost(<?= $row['id'];?>)"><i class="fa fa-plus"></i> Update host</button></center>
</div>
</br>
</div>

</div>
</div>
</div>
<?php
}}
?>
<script>
function updateHost(id) {
			var host=$('#host' + id).val();
			
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			}
			else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function(){
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					if(xmlhttp.responseText == "SUCCESS") {
						 setTimeout(function() {
                                    window.location ="blacklistpanel";
                                }, 1500)
						document.getElementById("ResponeHost" + id).innerHTML = '<div class="alert alert-success inverse alert-dismissible fade show" role="alert"><i class="icon-check"></i><p>The host has been updated!</p> <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> </div>'
					} else {
						document.getElementById("ResponeHost" + id).innerHTML = xmlhttp.responseText
					}
					}
				}
				
			xmlhttp.open("POST","assets/backend/blacklist.php?action=update_host",true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("id=" + id + "&host=" + host);
			}
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
