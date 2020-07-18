<div class="gap-low"></div>
<section>
    <div class="container" style="background-color:#f4f2ed; margin-top:15px;">
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <div class="contest-head">
                    <h4>Design Report List</h4>
                </div>
            </div>
			 
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-md-6 col-lg-6">
				
            </div>
        </div>
    </div>
</section>
<?php foreach($designer_report as $temp){ ?>
<section>
   <div class="container">
      <div id="change_contain">
         <div class="row" style="border:1px solid rgba(0,0,0,0.1);">
            <div class="col-md-6 col-lg-6">
               <div class="Judging-Contests">
				<p>
					<a href="<?php echo base_url().'admin/report_data_view/'. $temp->id;?>"><b style="padding-right:70px"><?php  echo  contestname($temp->contest_id);  ?></b></a>	
				</p>
				<p> 
					<b>Reported By:</b><span class="contest_category"><?php  echo username($temp->report_designer); ?></span>
                    <b>Violated By:</b> <span class="contest_category"><?php  echo username($temp->copy_designer); ?></span>
                </p>
				<p>
                    <b>Reported For:</b> <?php echo ($temp->report_type == 0)? "Copy Violation":"Use Of Stock";?>
				</p>
               </div>
			   
            </div>
            <div class="col-md-6 col-lg-6">
               <div class="Judging-Contests-prize">
                  <span>
					<strong class="contest_list_price">
						<p style='padding-right:50px'><?php echo ($temp->report_type == 0)?"Open":"Close" ;?></p>
					</strong>
				  </span>
				  <span>
				  <b style='color:#000;padding-right:5px'>Posted:</b>
				  <strong class="contest_list_price"><?php echo  date("d M, Y h:i a", strtotime($temp->createdtime)); ?></strong></span>
               </div>			   
            </div>
      </div>
   </div>
</section>

<?php } ?>
<section >
 <!---Pagination----->
        <?php echo pagination("admin/designerCourt",$count_contests,10);?>
        <!---Pagination Ends----->	
</section>
<div class="gap"></div>
