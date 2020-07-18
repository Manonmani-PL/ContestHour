
<?php if(!empty($portfolio_list)){ ?>
	<div class="row">
	<?php foreach($portfolio_list as $tmp){?>
		<div class="col-md-3 col-lg-3">
			<div class="logo_design_model">
				<div class="logo_d_name">
					<div class="logo_image"><img width="250px" height="200px" src="<?php echo base_url();?>uploads/designer_designs/<?php echo $tmp->design_name; ?>"></div>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>
<?php }else{?>
	
	<div class="row" style="border:1px solid rgba(0,0,0,0.1);">
    	<div class="col-md-12 col-lg-12">
			<p class="text-center" style="height: 100px;line-height: 100px;color: #ff1414;">Sorry!!! No Contest to display...</p>
        </div>
    </div>
<?php }?>