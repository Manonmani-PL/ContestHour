
<?php 
if($this->session->userdata('user_type') == 1)
	require('include/designer_contest_menu.php');
else	
	require('include/contest_menu.php'); 

?>
<section>
<div class="container" style="background-color:#f4f2ed; margin-top:15px;">
	<div class="row">
    	<div class="col-md-4 col-lg-4">
        	<div class="contest-head">
            	<h4>Open Contests (<?php echo isset($count_contests)? $count_contests:0; ?>)</h4>
            </div>
        </div>
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-6 col-lg-6">
        	<div class="col-sm-6 col-xs-12">
            <div class="categories">
            	<select size="1" class="drop_ajax" name="category" id="category">
                	<option value="">Select Categories</option>
                    <?php foreach ($category as $cats) { ?>
                    <option <?php echo 'value='. $cats->code; ?>><?php echo $cats->display_name; ?></option>
            		<?php } ?>                   
                </select>
               </div> 
            </div>
            <div class="col-sm-6 col-xs-12">
            	<div class="industry">
                	<select class="drop_ajax" size="1" name="industry" id="industry">
                    	<option value=""> Select Industries</option>
                        <?php foreach ($industry as $indus) { ?>
                        <option <?php echo 'value'. $indus->id; ?>><?php echo $indus->industry_name; ?></option>
                        <?php } ?>                                        
					</select>

                   
                </div>
            </div>
        </div>
    </div>
</div>
							
</section>

<div class="judging-contest">
<section>
<div class="container" >
	<div id="change_contain">
	<!--<div class="row" style="background-color:rgba(244,242,237,0.4); border:1px solid rgba(0,0,0,0.1);">
    	<div class="col-md-12 col-lg-12">
        	<div class="contest-completed">
            	<p>Open Contests (<?php echo isset($count_contests)? $count_contests:0; ?>)</p>
            </div>
        </div>
    </div>-->
    <?php 
	$contest_category= contest_category();
	$userid= is_user_logged_in();
	if(isset($contest_list) && !empty($contest_list)){
	foreach ($contest_list as $con_list) { 
	if(!($con_list->upgrade_private_contest > 0)){
	?>
    <div class="row" style="border:1px solid rgba(0,0,0,0.1);border-right:0px solid red;border-left:0px solid red;">
    	<div class="col-md-6 col-lg-6">
        	<div class="Judging-Contests">
            
            	<p><a href="<?php echo base_url();?>contest/particular_contest/<?php echo $con_list->id; ?>">
				<b class="contest_list_title">
                	<?php
						if($con_list->contest_type=="logodesign" || $con_list->contest_type=="webdesign" || $con_list->contest_type=="movielogodesign")
							echo ucwords($con_list->org_name);
						else
							 echo ucwords($con_list->contest_title);
					?>
                </b></a>
				<?php if($con_list->upgrade_featured_contest > 0){?>
				<span><img src="<?php echo base_url()?>assets/images/feature.png" class="noimgshawdow" title="Featured Contest"></span>
				<?php } ?>
				<?php if($con_list->pay_option== 1){?>
				<span style="color: #ff2121; font-size: 18px;"><i class="fa fa-flag" title="Guaranteed Payment"></i></span>
				<?php } ?>
				<span class="contest_category"><?php echo $contest_category[$con_list->contest_type];?></span>
				</p>
				<p><?php echo $con_list->business_description; ?></p>
            
            </div>
        </div>
		
        <div class="col-md-6 col-lg-6">
        	<div class="Judging-Contests-prize">
            	<span><strong class="contest_list_price">Prize: $. <?php echo $con_list->contest_prize; ?></strong> | Entries: <?php echo designcount($con_list->id); ?></span>
				
				<?php if($con_list->close_date < date("Y-m-d H:i:s")){?>
					<p>Time Remaining: Finished</p>
				<?php } else{ ?>
					<p>Time Remaining: <?php echo remaining_time(date("Y-m-d H:i:s"),$con_list->close_date);?></p>
				<?php } ?>
				
				<p style="color:#333">Posted: <?php echo date("h:i A, d M, Y.",strtotime($con_list->published_date)); ?></p>
            </div>
        </div>
    </div>
	<?php 
	}
	elseif(($con_list->upgrade_private_contest>0) && ($userid!='')){
	?>
	<div class="row" style="border:1px solid rgba(0,0,0,0.1);border-right:0px solid red;border-left:0px solid red;">
    	<div class="col-md-6 col-lg-6">
        	<div class="Judging-Contests">
            
            	<p><a href="<?php echo base_url();?>contest/particular_contest/<?php echo $con_list->id; ?>"><b>
                	<?php
						if($con_list->contest_type=="logodesign" || $con_list->contest_type=="webdesign" || $con_list->contest_type=="movielogodesign")
							echo ucwords($con_list->org_name);
						else
							 echo ucwords($con_list->contest_title);
					?>
                </b></a>  
				<?php if($con_list->upgrade_featured_contest > 0){?>
				<span><img src="<?php echo base_url()?>assets/images/feature.png" class="noimgshawdow" title="Featured Contest"></span>
				<?php } ?>				
				<span><img src="<?php echo base_url()?>assets/images/private-contest.png" class="noimgshawdow" title="Private Contest"></span>
				<span class="contest_category"><?php echo $contest_category[$con_list->contest_type];?></span>
				</p>
				<p><?php echo $con_list->business_description; ?></p>
            
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
        	<div class="Judging-Contests-prize">
            	<span><strong class="contest_list_price">Prize: $. <?php echo $con_list->contest_prize; ?></strong> | Entries: <?php echo designcount($con_list->id); ?></span>
				<?php if($con_list->close_date < date("Y-m-d H:i:s")){?>
					<p>Time Remaining: Finished</p>
				<?php } else{ ?>
					<p>Time Remaining: <?php echo remaining_time(date("Y-m-d H:i:s"),$con_list->close_date);?></p>
				<?php } ?>
				<p style="color:#333">Posted: <?php echo date("h:i A, d M, Y.",strtotime($con_list->published_date)); ?></p>
            </div>
        </div>
    </div>
    <?php } } }else{?>
	
	<div class="row" style="border:1px solid rgba(0,0,0,0.1);border-right:0px solid red;border-left:0px solid red;">
    	<div class="col-md-12 col-lg-12">
			<p class="text-center" style="height: 100px;line-height: 100px;color: #ff1414;">Sorry!!! No Contest to display...</p>
        </div>
    </div>
	
    <?php }?>
    </div>
	
	<!-------Pagination----->
    <?php echo pagination("admin/openContests",$count_contests,20);?>
	<!-------Pagination Ends----->
    
</div>
</section>
</div>


</div>
<div class="gap"></div>

<script type="text/javascript">
/*$( "#category" ).change(function(e) {
		 e.preventDefault();	
		var category=$("#category").val(); 
		if(category!=0)
		{
		$.ajax
			({
				type:'POST',
				data:{category:category},
				url:'<?php echo base_url();?>contest/categoryWise_openContests/',
				success:function(data)
				{
					$('#change_contain').html(data);
				}
			});
		}
});

$( "#industry" ).change(function(e) {
		 e.preventDefault();	
		var industry=$("#industry").val(); 
		if(industry!=0)
		{
		$.ajax
			({
				type:'POST',
				data:{industry:industry},
				url:'<?php echo base_url();?>contest/industryWise_openContests/',
				success:function(data)
				{
					$('#change_contain').html(data);
				}
			});
		}
});*/

$( ".drop_ajax" ).change(function(e) {
		 e.preventDefault();	
		var category=$("#category").val();
		var industry=$("#industry").val(); 
		
		$.ajax
			({
				type:'POST',
				data:{industry:industry,category:category},
				url:'<?php echo base_url();?>contest/choose_openContests/',
				success:function(data)
				{
					$('#change_contain').html(data);
				}
			});
		
});
</script>