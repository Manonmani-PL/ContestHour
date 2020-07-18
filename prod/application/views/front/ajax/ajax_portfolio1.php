    <section id="testimonials_portfolios">
    	<!-- <div class="owl-carousel testimonials-carousel owl-loaded owl-drag"> -->
      <div class="container owl-stage-outer">

      <div id="change_contain">		
 
      
        	
		 <ul class="row design-list" style="list-style: none"> 
			     <?php 
	if(!empty($portfolio_list)) 
	{
	 foreach ($portfolio_list as $tmp){ 
	
	?>		
          			 <li class="col-md-4 design-item">
						<div class="design-img">
							<a href="<?php echo base_url()?>contest/contest_entries/<?php echo $tmp->id;?>">
					 <img class="imagesize" src="<?php echo base_url();?>uploads/designer_designs/<?php echo $tmp->design_name; ?>"> 
					<!-- <img src="<?php echo base_url(); ?>assets/images/testimonial-2.jpg">  -->
				<!--</ a>
					 <p>
              "<?php //echo contest_testimoney($tmp->id);?>." <span> - <?php // echo ucwords(username($tmp->client_id));?></span>
            </p> -->
					</div>

					 </li> 
				
					
				
			
          <?php } } else { ?>  
          
       </ul> 
        
          </div>
          </div>
           <div class="row" style="border:1px solid rgba(0,0,0,0.1);border-right:0px solid red;border-left:0px solid red;">
                <div class="col-md-12 col-lg-12">
                    <p class="text-center" style="height:408px; line-height:60px;">No Contest Found....</p>
                </div>
                </div>
                <?php } ?>
      </section>