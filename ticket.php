<?php
$themeload = true;
$page = 'Ticket Converstation';

include 'assets/backend/header.php';


if(!is_numeric($_GET['id'])) {


echo "<script>
swal(
  'Oops...',
  'Invalid Ticket #ID!',
  'error'
)
</script>";

  exit;
}

else {
	$id = htmlspecialchars(htmlentities($_GET['id']));
	
	$SQLGetTickets = $odb -> prepare("SELECT * FROM `tickets` WHERE `id` = :id");
	$SQLGetTickets->execute(array(":id" => $id));
	while ($getInfo = $SQLGetTickets -> fetch(PDO::FETCH_ASSOC)){
	  $username = htmlentities($getInfo['username']);
	  $subject = htmlentities($getInfo['subject']);
	  $status = htmlentities($getInfo['status']);
	  $original = htmlentities($getInfo['content']);
	  $date = htmlentities(date("m-d-Y, h:i:s a" ,$getInfo['date']));
	  $date1 = $getInfo['date'];
	}

	$checkUpdating = $odb -> prepare("SELECT COUNT(*) FROM `messages` WHERE `ticketid` = :id AND `readed` = '0'");
	$checkUpdating->execute(array(":id" => $id));
	$checkUpdating = $checkUpdating->fetchColumn(0);

	if($checkUpdating != '0') {
		$SQLUpdate = $odb -> prepare("UPDATE `messages` SET `readed` = '1' WHERE `ticketid` = :id");
		$SQLUpdate -> execute(array(':id' => $id));
	}
	
if (!isset($original)) {

echo "<script>
swal(
  'Oops...',
  'Invalid Ticket #ID!',
  'error'
)
</script>";

  exit;
}

	$getAccess = $odb->prepare("SELECT COUNT(*) FROM tickets WHERE `id` = :id AND `username` = :username");
	$getAccess -> execute(array(":id" => $id, ":username" => htmlentities($_SESSION['username'])));
	$getAccess = $getAccess -> fetchColumn(0);
	
	if($getAccess != 1 && $userData['rank'] != 10) {
	die(error("You do not have permission to see this ticket!"));
	}
	
if ($userData['rank'] > 1 || isset($username)) {
  if (!isset($subject) || $subject == '') {
  }
}
else {

echo "<script>
swal(
  'Oops...',
  'Invalid Ticket #ID!',
  'error'
)
</script>";

  exit;
}

}

if ($userData['rank'] == 1)
    {
      if ($myusername == $username) {

      }
      else {

echo "<script>
swal(
  'Oops...',
  'Invalid Ticket #ID!',
  'error'
)
</script>";

  exit;

      }
    }

?>

            <br>
			
          
          <!-- Container-fluid starts-->
          <div class="container-fluid">
		  <div class="row">

<div class="col-lg-12" id="div"></div>

            <div class="col-lg-7">

                <div class="card">

                    <div class="card-header bg-primary">

                        <h5 class="card-title"><i class="fad fa-comments"></i> Conversation [<?= $subject; ?>]
      </h5>

                    </div>

                    <div class="card-body">

      <blockquote class="blockquote" style="border: 1px #fff solid;
    padding: 3px 10px;
    border-radius: 7px;
    background: #191e24">

        <p style="background-color: transparent; margin-bottom: 0px; font-size:22px !important"><?php echo $original; ?></p>

        <p class="text-muted text-right" style ="font-size:12px">-<?php echo ucfirst($username) . ' [ ' . $date . ' ]'; ?></p>

      </blockquote>

      <div id="response"></div>

                    </div>

                </div>

            </div>

<div class="col-lg-5">

                <div class="card">

                    <div class="card-header bg-primary">
<?php if($status != 'Closed') { ?>
	<h5 class="card-title"><i class="fad fa-paper-plane"></i> Post a reply
        <i style="display: none;" id="image" class="fa fa-cog fa-spin"></i>
      </h5>
<?php } else { ?>
<h5 class="card-title"><i class="fad fa-info-circle"></i> Ticket details
        <i style="display: none;" id="image" class="fa fa-cog fa-spin"></i>
      </h5>
<?php } ?>
	  <?php if($status != 'Closed') { ?>
	  
	  <?php } ?>
                    </div>

                    <div class="card-body">

      <form class="form-horizontal push-10-t push-10" action="" method="post" onsubmit="return false;">

        <div class="form-group">
		<div class="row">
			<div class="col-md-12 text-center">
			<?php
			$getDep = $odb -> prepare("SELECT `department`,`priority`,`department`.`name` FROM `tickets`,`department` WHERE `tickets`.`id` = :id AND `department`.`id` = `tickets`.`department`");
			$getDep->execute(array(":id" => htmlspecialchars(htmlentities($_GET['id']))));
			$getDep = $getDep->fetch(PDO::FETCH_ASSOC);
			
			if($getDep['priority'] == 'Med') {
				$getDep['priority'] = 'Medium';
			}
			?>
			<?php if($status != 'Closed') { ?>
			<bb style="font-size: 16px"><u>Ticket details</u>:</bb></br>
			<?php } ?>
		  Department: <bb style="border-bottom: thin dotted #3c8fd1;"><bb style="font-size: 14px"><?= $getDep['name']; ?>.</bb></bb></br>
		  Priority: <bb style="border-bottom: thin dotted #3c8fd1;"><bb style="font-size: 14px"><?= $getDep['priority']; ?>.</bb></bb></br>
		  Date Created: <bb style="border-bottom: thin dotted #3c8fd1;"><bb style="font-size: 14px"><?= date('m/d/y - h:i:s', $date1); ?></bb></bb></br>
		  </div>
		 </div>
	</div>
		 <?php if($status != 'Closed') { ?>
		 <hr style="background-color: #fff; box-shadow: 0px 2px 1px #3c8fd1">
		  
          <div class="col-xs-12">
              <textarea class="form-control" id="reply" rows="5" style="background-color: #1e2125;"></textarea>
          </div>
        </div>
		<div class="card-footer">
			<div class="row">
					   <div class="col-lg-6">
                        <button class="btn btn-sm btn-outline-success float-left" onclick="message()"><i class="fa fa-plus"></i> Reply</button>
						</div>
						<div class="col-lg-6">
                       <button class="btn btn-sm btn-outline-danger float-right" onclick="closeticket()"><i class="fa fa-ban"></i> Close</button>
                      </div>
					  </div>
					  
					  
		 <?php } ?>
                        </form>

                    </div>

                </div>

            </div>

        </div>
			 
			  
			  

			  
             
            </div>
          
          <!-- Container-fluid Ends-->
       </div>
	   </div>
<?php require_once 'assets/backend/footer.php'; ?>
<script>



response();



function response(){

var xmlhttp;

if (window.XMLHttpRequest) {

xmlhttp=new XMLHttpRequest();

}

else {

xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

}

xmlhttp.onreadystatechange=function() {

if (xmlhttp.readyState==4 && xmlhttp.status==200) {

document.getElementById("response").innerHTML=xmlhttp.responseText;

}

}

xmlhttp.open("GET","assets/backend/tickets/tickets.php?id=<?php echo $_GET['id']; ?>",true);

xmlhttp.send();

}



function closeticket(){

document.getElementById("image").style.display="inline";

document.getElementById("div").style.display="none";

var xmlhttp;

if (window.XMLHttpRequest) {

xmlhttp=new XMLHttpRequest();

}

else {

xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

}

xmlhttp.onreadystatechange=function() {

if (xmlhttp.readyState==4 && xmlhttp.status==200) {

document.getElementById("div").innerHTML=xmlhttp.responseText;

document.getElementById("div").style.display="inline";

document.getElementById("image").style.display="none";

}

}

xmlhttp.open("GET","assets/backend/tickets/closeticket.php?id=<?php echo $_GET['id']; ?>",true);

xmlhttp.send();

}



function message() {

var reply=$('#reply').val();

document.getElementById("image").style.display="inline";

document.getElementById("div").style.display="none";

var xmlhttp;

if (window.XMLHttpRequest) {

xmlhttp=new XMLHttpRequest();

}

else {

xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

}

xmlhttp.onreadystatechange=function() {

if (xmlhttp.readyState==4 && xmlhttp.status==200) {

document.getElementById("div").innerHTML=xmlhttp.responseText;

document.getElementById("div").style.display="inline";

document.getElementById("image").style.display="none";

if (xmlhttp.responseText.search("SUCCESS") != -1) {

  swal(
  'Reply Sent!',
  'The reply has been sent successfully!',
  'success'
  )

  response();

}
else {

  swal(
  'Oops...',
  xmlhttp.responseText,
  'error'
  )
  
}

}

}

xmlhttp.open("GET","assets/backend/tickets/reply.php?id=<?php echo $_GET['id']; ?>" + "&message=" + reply,true);

xmlhttp.send();

}



</script>