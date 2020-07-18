<?php $this->load->view('front/include/left_side_menu_client'); ?>
  <div class="col-sm-9">
    	<div class="row">
            <div class="col-sm-12">
            	
                <div class="jointable">
                <h3 class="">Client Notifications</h3>
                 <table class="table table-hover" id="bootstrap-table">
                <thead>
                <tr>
                    <th>Form</th>
                    <th>Subject</th>
                    <th>Date / Time</th>
                   
                </tr>
                </thead>
                <tbody>
                
                <?php if(isset($messagelist) && !empty($messagelist)){
						foreach( $messagelist as $tmp)
				{
		?>
			 <tr class="<?php echo ($tmp->read_status == 0)?"unread":""; ?>">
                    <td><?php echo username($tmp->from_id); ?></td>
                    <td><a class='changeread' href="<?= base_url();?>contest/contest_designpackage/<?php echo $tmp->contest_id;?>"  for='<?php echo $tmp->to_id;?>'><?php  echo $tmp->subject; ?></a></td>
                    <td><?php echo date("d/m/Y", strtotime($tmp->created_time)) ?></td>  
					<td><a href="<?= base_url();?>contest/contest_designpackage/<?php echo $tmp->contest_id;?>">View</a></td>                
                </tr>				

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
