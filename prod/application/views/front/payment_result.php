<div class="gap-low"></div>
<section>
	<div class="container">
		<div class="row">
			
			<div class="col-md-6 col-lg-6 col-md-offset-3">
				<div class="text-center" style="background: #f7f7f7;padding: 75px 25px;">
					<div class="contest-head" style="margin-bottom: 40px;">
					<h2>Payment Result</h2>
					</div>
				   <?php 
				   if(!empty($contest_data)){
					   if($contest_data->status=="1"){
					?>
					<h4 style="margin-bottom:10px;">Your Payment was completed. Here are the details of this transaction for your reference.</h4>
					<h4 style="margin-bottom:10px;">Transaction Number: <?php echo $contest_data->txnid;?></h4>
					<?php if($contest_data->atom_amt > 0){ ?>
						<h4 style="margin-bottom:10px;">Amount Paid : Rs. <?php echo $contest_data->atom_amt;?></h4>	
					<?php }else{ ?>
						<h4 style="margin-bottom:10px;">Amount Paid : $ <?php echo $contest_data->payable_amt;?></h4>	
					<?php } ?>
					<a href="<?php echo base_url()."contest/particular_contest/". $contest_data->contest_id;?>" style="background:#f14b15; color: #fff; margin-top: 20px;" class="btn">View Contest</a> 
					<?php
					   }
					   else{
					?>
					<p>Payment Failed. Please Try Again Later</p>		
					<?php   
					   }
				   }
				   ?>
			    </div>
			</div>
		</div>
	</div>
</section>

<div class="gap"></div>