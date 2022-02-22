<?php
$themeload = true;
$page = 'Servers';

include 'assets/backend/header.php';

//Get needed information
$SQL = $odb -> query("SELECT COUNT(*) FROM `servers`");
$online_servers = $SQL->fetchColumn(0);

?>
<script type="text/javascript">
  var auto_refresh = setInterval(
  function ()
  {
    $('#servers').load('assets/backend/serverslist.php?count=all').fadeIn("slow");
  }, 5000);
</script>

            <br>
			
          
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row second-chart-list third-news-update">
              
               <div class="col-lg-12">
                    <div class="card">
					<div class="card-header  bg-primary">
                    <h5>Servers Status</h5>
                  </div>
                      <div class="card-body">
					  <div id="servers"><center> <div class="loader-box">
                        <div class="loader-37">       </div>
                      </div></center></div>
                            
						   
                      </div>
                    </div>
                  </div>
             
            </div>
          </div>
          <!-- Container-fluid Ends-->
       </div>
	   </div>
<?php require_once 'assets/backend/footer.php'; ?>

    