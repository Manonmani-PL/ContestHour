<?php $this->load->view('front/include/left_side_menu_designer'); ?>
<div class="col-sm-9">

   <form action="#" method="post" enctype="multipart/form-data">
      <div class="row right-border" style="border:0px solid red;">
         <div class="col-sm-12 col-xs-12">
			
			<div class="row">
				<div class="jointable">
				 <h3 class="">Designer Referral Code</h3>
				</div>
					<div class="col-md-4 col-lg-4">
						<span style="background:#c3bcbc; padding:10px; margin-top:10px; display:table; width:100%; font-size: 18px; color: #fff; text-align: center;"><?php echo $referral_code; ?></span>
					</div>
				<div class="col-md-4 col-lg-4">
				   <a style="background:#713365; padding:10px; margin-top:10px; display:table; width:100%; font-size: 18px; color: #fff; text-align: center;" href="<?php echo base_url();?>admin/update_clientinfo">Share</a>
				  
				</div>
			</div>
         </div>
      </div>
   </form>
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