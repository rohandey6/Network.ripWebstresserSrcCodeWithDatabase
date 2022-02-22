<?php
$themeload = true;
$page = 'Support';

include 'assets/backend/header.php';
?>

            <br>
			
          
          <!-- Container-fluid starts-->
          <div class="container-fluid">
		   <div class="email-wrap">
			 <div class="modal fade" id="newticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="exampleModalLabel2">Create a new ticket <i style="display: none;" id="icon" class="fa fa-cog fa-spin"></i></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
							
							<div class="form-group">
							
							<div id="div"></div>
                  </div>
				  <form class="form-horizontal push-10-t push-10" onsubmit="return false;">
					<div class="form-group">
					   <label for="example-nf-email">Subject:</label>
					   <input type="text" class="form-control" id="subject">
					</div>
					<div class="form-group">
					   <label for="dep" class="">Department:</label>
					   <select name="dep" id="dep" class="form-control">
						  <?php
						  $getDep = $odb->query("SELECT * FROM `department`");
						  while($row = $getDep->fetch(PDO::FETCH_ASSOC)){
							  echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
						  }
						  ?>
					   </select>
					</div>
					<div class="form-group">
					   <label for="priority" class="">Priority:</label>
					   <select name="priority" id="priority" class="form-control">
						  <option value="Low">Low</option>
						  <option value="Med" selected="">Medium</option>
						  <option value="High">High priority</option>
					   </select>
					</div>
					<div class="form-group">
					   <label for="example-nf-email">Message:</label>
					   <textarea type="text" class="form-control" id="content" rows="3"></textarea>
					</div>
				 </form>
                     
                          </div>
                          <div class="modal-footer text-center">
		  <button onclick="newticket()" type="button" class="btn btn-success">
		  <i class="fa fa-check"></i> Create Ticket
		  </button>
	   </div>
						  
                        </div>
                      </div>
                    </div>

			  
			  
			<div class="row">
  <div class="content" id="messages"></div>
  </div>
              
             
            </div>
          </div>
          <!-- Container-fluid Ends-->
       </div>
	   </div>
	   
<?php require_once 'assets/backend/footer.php'; ?>
<script>
        			inbox();

        			function inbox() {
        				var xmlhttp;
        				if (window.XMLHttpRequest) {
        					xmlhttp = new XMLHttpRequest();
        				}
        				else {
        					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        				}
        				xmlhttp.onreadystatechange = function(){
        					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        						document.getElementById("messages").innerHTML = xmlhttp.responseText;
        					}
        				}
        				xmlhttp.open("GET","assets/backend/tickets/inbox",true);
        				xmlhttp.send();
        			}



        			function unread() {
        				var xmlhttp;
        				if (window.XMLHttpRequest) {
        					xmlhttp = new XMLHttpRequest();
        				}
        				else {
        					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        				}
        				xmlhttp.onreadystatechange = function(){
        					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        						document.getElementById("messages").innerHTML = xmlhttp.responseText;
        					}
        				}
        				xmlhttp.open("GET","assets/backend/tickets/unread",true);
        				xmlhttp.send();
        			}
					
					function history() {
        				var xmlhttp;
        				if (window.XMLHttpRequest) {
        					xmlhttp = new XMLHttpRequest();
        				}
        				else {
        					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        				}
        				xmlhttp.onreadystatechange = function(){
        					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        						document.getElementById("messages").innerHTML = xmlhttp.responseText;
        					}
        				}
        				xmlhttp.open("GET","assets/backend/tickets/history",true);
        				xmlhttp.send();
        			}
					
					function newticket() {
        				var subject = $('#subject').val();
						var dep = $('#dep').val();
						var pri = $('#priority').val();
        				var content = $('#content').val();
        				document.getElementById("icon").style.display="inline";
        				var xmlhttp;
        				if (window.XMLHttpRequest) {
        					xmlhttp=new XMLHttpRequest();
        				}
        				else {
        					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        				}
        				xmlhttp.onreadystatechange=function() {
        					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        						document.getElementById("icon").style.display="none";
        						document.getElementById("div").innerHTML=xmlhttp.responseText;
        						if (xmlhttp.responseText.search("SUCCESS") != -1) {
								swal(
								  'Ticket Sent!',
								  'The ticket has been successfully sent!',
								  'success'
								  )
        							inbox();

								} else {
								  swal(
								  'Oops...',
								  xmlhttp.responseText,
								  'error'
								  )
								}
        					}
        				}
        				xmlhttp.open("POST","assets/backend/tickets/newticket.php",true);
						xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        				xmlhttp.send("subject=" + subject + "&content=" + content + "&department=" + dep + "&priority=" + pri);
        			}
</script>
    