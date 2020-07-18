<style type="text/css">
	@media (max-width: 768px) {
  .portfolio_mob {
       margin: 0px -30px !important;
  }
}
</style>

<main id="main" class="non-intro">
	<section id="contest-list-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<h3 class="list-header-title">PORTFOLIO</h3>
				</div>
				<div class="col-lg-8 option-box">
					<select size="1" class="drop_ajax" name="category" id="category">
                	<option value="">Select Categories</option>
						<?php foreach ($category as $cats) { ?>
						<option <?php echo 'value='. $cats->code; ?>><?php echo $cats->display_name; ?></option>
						<?php } ?>                
                </select>
					<select class="drop_ajax" size="1" name="industry" id="industry">
							<option value=""> Select Industries</option>
							<?php foreach ($industry as $indus) { ?>
							<option <?php echo 'value'. $indus->id; ?>><?php echo $indus->industry_name; ?></option>
							<?php } ?> 
						</select>
				</div>
			</div>
		</div>
	</section>

       
    <section id="testimonials_portfolios">
    	<!-- <div class="owl-carousel testimonials-carousel owl-loaded owl-drag"> -->
      <div class="container ">

      <div id="change_contain">		
 
      
        	
	 <ul class="row design-list "style="list-style: none"> 
			     <?php 
	if(isset($contest_list) && !empty($contest_list))
	{
		//$total_contestlist1 = count($contest_list);
		//$total_contestlist = echo  get_portfoliolist_count();
	 foreach ($contest_list as $con_list){ 
	
	?>		
          			 <li class="col-md-4 design-item">
					<div class="design-img">
					
						<a href="<?php echo base_url()?>contest/contest_entries/<?php echo $con_list->id;?>">
						<br>	
				<img  class="imagesize portfolio_mob"style="width: 314px!important;" src="<?php echo base_url();?>uploads/designer_designs/<?php echo $con_list->design_name; ?>"> 
					
					<!-- <img src="<?php echo base_url(); ?>assets/images/testimonial-2.jpg">  -->
					</a>
					</div>
					 </li> 
				
					
				
			
          <?php }  ?>  
          
       </ul>
   <?php } else { ?>
    <div class="row" style="padding:10px; border:1px solid rgba(0,0,0,0.1);">
     	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
        	
            	No records available..
            
     	</div>
    </div>
    <?php } ?> 
   <!--  <div class="row">
 <?php //echo pagination("admin/portfolios",$total_contestlist,20);?>
          </div> -->
      </div>
  </div>
  <!-- </div> -->
      </section>
 </main>
<div class="gap-low"></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$( ".drop_ajax" ).change(function(e){
		e.preventDefault();	
		var category=$("#category").val();
		var industry=$("#industry").val(); 
		var userid = "<?php echo $this->session->userdata('user_id');?>";
		if(userid!=""){
		$.ajax({
			type:'POST',
			data:{industry:industry,category:category},
			url:'<?php echo base_url();?>admin/portfolio_filter',
			success:function(data)
			{
				$('#change_contain').html(data);
			}
		});	
	} else{
		window.location.href = "<?php echo base_url()?>admin/loginForm";
	}
});
</script>