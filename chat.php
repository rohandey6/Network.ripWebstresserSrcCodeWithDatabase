<?php
   $themeload = true;
   $page = 'Chat Room';
   
   include 'assets/system/header.php';
   
   
   ?>
<script src="assets/js/be_comp_chat.js"></script>
            <br>
			
          
          <!-- Container-fluid starts-->
          <div class="container-fluid">
		  
		  
            <div class="row second-chart-list third-news-update">
			 
			
			  
			  <div class="col-sm-12 col-xl-7 box-col-7">
                <div class="card">
                  <div class="card-header   bg-primary">
                    <h5>Chat Box </h5>
                  </div>
                  <div class="card-body">
                      <div class="chat-conversation">
                                            <ul class="conversation-list slimscroll" style="max-height: 400px;">
                                        
                                         <div class="tab-content overflow-hidden">
                     <!-- Chat Window #1 -->
                     <div class="tab-pane fade show active" id="chat-window1" role="tabpanel">
                        <!-- Messages (demonstration messages are added with JS code at the bottom of this page) -->
                        <div class="js-chat-talk card-body text-wrap-break-word" data-chat-id="1" style="overflow: hidden; max-height: 418px; min-height: 418px;">
                            <script type="text/javascript">
                              var auto_refresh = setInterval(
                              function ()
                              {
                                $('#getChatRoomID1').load('assets/system/chat.php?type=getchat&roomid=1').fadeIn("slow");
                              }, 5000);
                              
                              var auto_refresh = setInterval(
                              function ()
                              {
                              	  var chatWindow = jQuery('.js-chat-talk[data-chat-id="1"]');
                              chatWindow.animate({ scrollTop: chatWindow[0].scrollHeight }, 150);
                              }, 250);
                              
                              
                           </script>
                           <div id="getChatRoomID1"></div>
                           <script>
                              $('#getChatRoomID1').load('assets/system/chat.php?type=getchat&roomid=1').fadeIn("slow");
                           </script>
                        </div>
                        <!-- Chat Input -->
						 </ul>
                                    </div>
                        <div class="js-chat-form chat-inputbar">

                           <div class="input-group">
                              
                              <input class="form-control chat-input" type="text" id="textMessageID1" name="textMessageID1" placeholder="Type your message and hit enter.." style="background-color: #1e2125; border: 1px solid #3c8ccd">
                              <div class="input-group-append">
							  <span class="input-group-text"><i class="fad fa-paper-plane"></i></span>
                                                        </div>
							  <script> 
                                 $('#textMessageID1').keydown(function (e){
                                     if(e.keyCode == 13){
                                 
                                 	
                                 	var data = document.getElementById("textMessageID1").value;
                                 	var xmlhttp;
                                 	if (window.XMLHttpRequest) {
                                 	xmlhttp=new XMLHttpRequest();
                                 	}
                                 	else {
                                 	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                                 	}
                                 	xmlhttp.onreadystatechange=function() {
                                 
                                 	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                                 	$('#getChatRoomID1').load('assets/system/chat.php?type=getchat&roomid=1').fadeIn("slow");
                                 	}
                                 	
                                 	}
                                 
                                 	xmlhttp.open("GET","assets/system/chat.php?data=" + data + "&type=addmessage&roomid=1",true);
                                 	xmlhttp.send();
                                 	$('#textMessageID1').val("");
                                 	
                                     }
                                 })
                              </script>                                     
                           </div>
                        </div>
                        <!-- END Chat Input -->
					  
                  </div>
                </div>
              </div>

			  
			  
			
              
               
             
            </div>
          </div>
          <!-- Container-fluid Ends-->
       </div>
	   </div>
<?php require_once 'assets/system/footer.php'; ?>