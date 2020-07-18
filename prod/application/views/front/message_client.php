<?php $this->load->view('front/include/left_side_menu_client'); ?>
  <div class="col-sm-9">
    	<div class="row">
            <div class="col-sm-12">
            	
                <div class="jointable">
                <h3 class="">Messages List</h3>
                 <table class="table table-hover" id="bootstrap-table">
                <thead>
                <tr>
                    <th>Form</th>
                    <th>Subject</th>
                    <th>Date / Time</th>
                    <th>Action</th>
                   
                </tr>
                </thead>
                <tbody>
               <!-- <tr>
                    <td>sathish</td>
                    <td>Logo design</td>
                    <td>read</td>
                    <td>1/04/2016</td>
                    <td>View / Delete</td>
                  
                </tr>
                
                 <tr>
                    <td>sathish</td>
                    <td>Logo design</td>
                    <td>read</td>
                    <td>1/04/2016</td>
                    <td>View / Delete</td>
                  
                </tr> -->
                
                <?php if(isset($messagelist) && !empty($messagelist)){
						foreach( $messagelist as $tmp)
				{
		?>
			 <tr class="<?php echo ($tmp->read == 0)?"unread":""; ?>">
                    <td><?php echo username($tmp->createdby); ?></td>
                    <td><a class='changeread' for='<?php echo $tmp->dcmd_id; ?>' data-modal-id="popup<?php echo $tmp->dcmd_id; ?>" >"<?php  echo contestname($tmp->contest_id); ?> - Message on design from designer"</a></td>
                    <td><?php echo date("d/m/Y", strtotime($tmp->createddate)) ?></td>
                    <td><a class='changeread' for='<?php echo $tmp->dcmd_id; ?>' data-modal-id="popup<?php echo $tmp->dcmd_id; ?>" >View</a>/ <a class='delmsg' for="<?php echo $tmp->dcmd_id; ?>"> Delete</a></td>
                  
                </tr>


					  <div id="popup<?php echo $tmp->dcmd_id; ?>" class="modal-box">
                      <header> 
					  <a class="js-modal-close close" style="top: 1% !important;">×</a>
                        <h4>Comments</h4>
                      </header>
                      <div class="modal-body">
                      
					   <div class="logo_image"><img src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo d_imagename($tmp->design_id); ?>" /></div>
                            
					  <?php
							$prvcomments = design_comment($tmp->design_id);
					  if(isset($prvcomments) && !empty($prvcomments)) { 
								foreach($prvcomments as $tmp2)
								{
						?>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="messanger-name"><b><?php echo $tmp2->createdname; ?></b> <?php  if($tmp2->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                                </div>
                                <div class="message-timming"><?php echo date("d-m-Y h:i a",strtotime($tmp2->createddate)); ?></div>
                            </div>
							<div class="row">
								<div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp2->comment;?></div>
							 </div>
							<div class="ro" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                                
                            </div>
						<?php } } ?>
						
                       	<form action="<?php echo base_url();?>contest/contest_privcomment" name="design_upload" method="post" enctype="multipart/form-data">
                       		 
							 
							 
							 <textarea rows="5" cols="20" class="msg_box" style="width: 550px; height: 106px;" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                                      
                            <input type="hidden" name="contestid" value="<?php echo $tmp->contest_id; ?>" />
                            <input type="hidden" name="clientid" value="<?php echo $tmp->client_id; ?>" />
                            <input type="hidden" name="designid" value="<?php echo $tmp->design_id; ?>" />
                            <input type="hidden" name="shiftpress" value="1" />
							<input type="hidden" name="designerid" value="<?php  echo design_designerid($tmp->design_id); ?>" />
						
                            </br>
                            <input type="submit" class="precomm" value="Add Comment" />
                       	</form>
                       
                      </div>
                      <footer>
						<a class="btn btn-small submit_cmt orange_bttn">Add Comment</a> 
						<a href="#" class="btn btn-small js-modal-close">Close</a> </footer>
                    </div>
					

<?php 			}			
					} ?>
                </tbody>
            </table>
       </div>
            		
                    


            
              
       </div>
        </div>
  </div>
</div>
</div>






</div>
<div class="container">
	<div class="col-md-3"></div>
    
    <div class="col-md-3"></div>
    <div class="col-md-3"></div>
</div>
<div class="gap"></div>


<script>
$(function(){

var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");

	$('a[data-modal-id]').click(function(e) {
		e.preventDefault();
    $("body").append(appendthis);
    $(".modal-overlay").fadeTo(500, 0.7);
    //$(".js-modalbox").fadeIn(500);
		var modalBox = $(this).attr('data-modal-id');
		$('#'+modalBox).fadeIn($(this).data());
	});  
  
  
$(".js-modal-close, .modal-overlay").click(function() {
    $(".modal-box, .modal-overlay").fadeOut(500, function() {
        $(".modal-overlay").remove();
    });
 
});
 
$(window).resize(function() {
    $(".modal-box").css({
        top: ($(window).height() - $(".modal-box").outerHeight()) / 16,
        left: ($(window).width() - $(".modal-box").outerWidth()) / 4
    });
});
 
$(window).resize();
 
});

$(document).ready(function() {
		$(document).on("click",".submit_cmt",function(){
			var tar= $(this).parent("footer").parent("div").find(".precomm");
			$(tar).trigger("click");
		});	
		
		$(document).on("click",".changeread",function(){
			var id = $(this).attr('for');
				
				

 $.ajax({ 
			url: "<?php echo base_url();?>admin/readmessage",
			  data:{
				 dcmdid :id
			  },
			  type: "POST",
			  success: function(data){	
				$('#readch_'+id).html('Read');
			  }
		  });
				
				});
				
		$(document).on("click",".delmsg",function(){
			var id = $(this).attr('for');
				
				var r = confirm("Are You want to Delete This Message !!!");
if (r == true) {
    

 $.ajax({ 
			url: "<?php echo base_url();?>admin/deletemessage",
			  data:{
				 dcmdid :id
			  },
			  type: "POST",
			  success: function(data){	
				location.reload();
			  }
		  });
				
		}

		});		
				
		
		
	});
	

</script> 

<style>
.addbutton {
    background-color: #000;
    border: none;
    color: white;
    padding: 4px 24px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;border: 1px solid transparent;
border-radius: 4px;
}
</style>
