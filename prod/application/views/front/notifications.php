<div class="gap-low"></div>
<section>
    <div class="container" style="margin-top:15px;">
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <div class="contest-head">
                    <h4>Announcement List</h4>
                </div>
            </div>
			
        </div>
        </div>
    </div>
</section>
<?php foreach($announcement as $temp){ ?>
<section>
   <div class="container">
      <div id="change_contain">
         <div class="row" style="border:1px solid rgba(0,0,0,0.1);">
            <div class="col-md-6 col-lg-6">
               <div class="Judging-Contests">
				<p>
					<a href="#"><b style="padding-right:70px background-color: #fbb03b;"><?php echo $temp->title; ?></b></a>	
				</p>
				<p><?php echo $temp->message; ?></p>
               </div>
			   
            </div>
            <div class="col-md-6 col-lg-6">
               <div class="Judging-Contests-prize">
                <span>
				  <b style="color:#000;padding-right:5px">Posted:</b>
				  <strong class="contest_list_price"><?php echo date("d M, Y h:i a", strtotime($temp->createdtime));?></strong>
				</span>
               </div>			   
            </div>
		</div>
	</div>
	</div>
</section>
<?php } ?>
<section >
 <!---Pagination----->
        <?php echo pagination("admin/notifications",$count_contests,10);?>
        <!---Pagination Ends----->	
</section>
<div class="gap"></div>