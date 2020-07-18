<style>
/*img{-webkit-box-shadow: 0px 2px 5px 0px rgb(218, 218, 218)!important;
    -moz-box-shadow: 0px 2px 5px 0px rgb(218, 218, 218)!important;
    box-shadow: 0px 0px 0px 0px rgb(218, 218, 218)!important;}
.d-pro-img{-webkit-box-shadow: 0px 2px 5px 0px rgb(218, 218, 218)!important;
    -moz-box-shadow: 0px 2px 5px 0px rgb(218, 218, 218)!important;
    box-shadow: 0px 2px 5px 0px rgb(218, 218, 218)!important;}
	.search-area-btn input[type="submit"]{width: 60px;border:none;background-color: #fbb03b;padding: 7px;margin-left: -3px;
border-radius: 0px 5px 5px 0px;color: rgb(255, 255, 255);}
a {
  color: #4c2670;
  transition: 0.5s;
}
a:hover, a:active, a:focus {
  color: #4c2670;
  outline: none;
  text-decoration: none;
}
.list-icons_new img {
    width: 100px;
    margin-right: 5px;
}*/

</style>
<?php 

if($this->session->userdata('user_type') == 1)
	require('include/designer_contest_menu.php');
else	
	require('include/contest_menu.php'); ?>

<main id="main">
	<section id="contest-list-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<h3 class="list-header-title">Designers</h3>
				</div>
				<div class="col-lg-8 option-box">
					<div class="search-area-btn">
				<form action="#" method="post" onsubmit="#">
					<input type="text" class="designer_search" id="designer-search" name="designer-search"/>
					<input type="submit" style="background-color:#fbb03b;" value="Search" name="search" />
				</form>   
			</div>
					
				</div>
			</div>
		</div>
	</section>

 <!--==========================
      Clients Section
    ============================-->
    <div class="page_list">
    <section id="portfolio" class="wow fadeInUp" >
      <div class="container">
   	
        <div class="owl-carousel clients-carousel"   >
           <?php 
	if(!empty($result)) { foreach($result as $res) { ?>
      <div  class="portfolio-items" style="background-color: #000000 !important;"  >
        <div class="item-block">
          <span><?php 
      
		$uid=$res->users_id;
		$wincount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'design_status'=>1));
		$finalcount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'final_status'=>1));
		$Participatcount=$this->Common_model->counts('designs','distinct(contest_id)',array('designer_id'=>$uid));
          echo $res->designer_name; ?> </span>
        	<a href="<?php echo base_url()."admin/designer_portfolio/".$uid ;?>">
           <img style="height: 320px; width: 357px;" src="<?php if(!empty($res->designer_profile)) { echo base_url();?>uploads/designer_profile/<?php echo $res->designer_profile; } else { echo base_url();?>assets/images/designer-signup.png<?php }?>"></a>
            
    <?php// } ?> 
        </div>
        
        
      </div>
      <?php } } else { ?>
    <div class="row" style="padding:10px; border:1px solid rgba(0,0,0,0.1);">
     	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
        	
            	No records available..
            
     	</div>
    </div>
      <?php } ?>
        </div>
         <div class="row">
 <?php echo pagination("admin/designer",$total_designers,20);?>
          </div>
    </section><!-- #clients -->
</div>
    <!--==========================
      Clients Section
    ============================-->

  <section class="search_list" style="display:none">
</section>
 </main>
<div class="gap-low"></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
		$(document).on("keyup",".designer_search",function () {
			var search= $(this).val().toLowerCase();
			$(".search_list").hide();
			if(search !=''){
				$(".page_list").hide();
				$(".search_list").show();

				$.ajax({
					type: "POST",
					url: "<?php echo base_url().'admin/designer_search/';?>",
					data:{search_text:search},
					beforeSend: function() {
						var loading='<div class="row" style="padding:10px; border:1px solid rgba(0,0,0,0.1);"><div class="col-md-12 col-lg-12 col-sm-12 col-xs-12"><div class="text-center"><img src="<?php echo base_url();?>assets/image/loading.gif" width="120px"></div></div></div>';
						$('.search_list').html(loading);
					},
					success: function(result) {
						$('.search_list').html(result).fadeIn( 100 );
					}
				});
			}
			else{
				$(".page_list").show();
				$(".search_list").hide();
			}
			
			
		});
});	
</script>