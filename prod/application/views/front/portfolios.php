<div class="gap-low"></div>
<div class="minheight">
<section>
	<div class="container" style="background-color:#f4f2ed; margin-top:15px;">
		<div class="row">
			<div class="col-md-6 col-lg-6">
				<div class="contest-head">
					<h4>PORTFOLIO</h4>
				</div>
			</div>
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

<section>
<div class="container" id="change_contain">
	<div class="row">
	<?php
	if(isset($contest_list) && !empty($contest_list))
	{
	 foreach ($contest_list as $con_list){ 
	?>
	<div class="col-md-3 col-lg-3">
		<div class="logo_design_model">
			<div class="logo_d_name">
				<div class="logo_image">
					<a href="<?php echo base_url()?>contest/contest_entries/<?php echo $con_list->id;?>">
					<img width="250px" height="200px" src="<?php echo base_url();?>uploads/designer_designs/<?php echo $con_list->design_name; ?>">
					</a>
				</div>
			</div>
		</div>
	</div>
	<?php } }?>   
	</div>
</div>
</section>
</div>
<div class="gap-low"></div>
<script type="text/javascript">
$( ".drop_ajax" ).change(function(e){
		e.preventDefault();	
		var category=$("#category").val();
		var industry=$("#industry").val(); 
		$.ajax({
			type:'POST',
			data:{industry:industry,category:category},
			url:'<?php echo base_url();?>admin/portfolio_filter',
			success:function(data)
			{
				$('#change_contain').html(data);
			}
		});	
});
</script>