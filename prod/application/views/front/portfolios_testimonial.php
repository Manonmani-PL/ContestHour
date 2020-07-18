<style type="text/css">
  @media (max-width: 768px) {
  .portfolio_mob {
       margin: 0px -30px !important;
  }
}
#trancy{
/*-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";       
filter: alpha(opacity=50);  
-moz-opacity: 0.5;          
-khtml-opacity: 0.5;      
opacity: 0.5;*/
background-color: transparent; 
}             
</style>

<main id="main" class="non-intro">
  <section id="contest-list-header" style="margin-top: -124px!important;" >
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <h3 class="list-header-title">PORTFOLIO</h3>
        </div>
        <div class="col-lg-8 option-box">
          
        </div>
      </div>
    </div>
  </section>





 <section style="background-image:none; " id="testimonials"  class="section-bg wow fadeInUp">
      <div class="container">
    
    <header class="testimonial-header testimonial-mob">
         
        </header>
    
        <div >
             <ul class="row design-list "style="list-style: none"> 
          <?php
      //print_r($contest_list);
      if(isset($contest_list) && !empty($contest_list)){
        foreach ($contest_list as $res){ 
      ?>

                 <li class="col-md-4 design-item">
          <div class="testimonial-item" id="trancy" >
            
            <a href="<?php echo base_url()?>contest/contest_entries/<?php echo $res->id;?>">
              <img src="<?php  echo base_url();?>uploads/designer_designs/<?php echo $res->design_name; ?>" class="testimonial-img" alt="" width="317px" hight="25%"> 
        
          </a>
            <p>
              "<?php echo contest_testimoney($res->id);?>." <span> - <?php  echo ucwords(username($res->client_id));?></span>
            </p>
          </div>
           </li> 
          <?php  }?>
            </ul>
     <?php } ?>
        
      
        </div>

      </div>
    </section>






 
 </main>
<div class="gap-low"></div>
