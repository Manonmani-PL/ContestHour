<style>
img{-webkit-box-shadow: 0px 2px 5px 0px rgb(218, 218, 218)!important;
    -moz-box-shadow: 0px 2px 5px 0px rgb(218, 218, 218)!important;
    box-shadow: 0px 0px 0px 0px rgb(218, 218, 218)!important;}
.d-pro-img{-webkit-box-shadow: 0px 2px 5px 0px rgb(218, 218, 218)!important;
    -moz-box-shadow: 0px 2px 5px 0px rgb(218, 218, 218)!important;
    box-shadow: 0px 2px 5px 0px rgb(218, 218, 218)!important;}
	.search-area-btn input[type="submit"]{width: 60px;border:none;background-color: #fbb03b;padding: 7px;margin-left: -3px;
border-radius: 0px 5px 5px 0px;color: rgb(255, 255, 255);}
a {
  color: #0a0a0a;
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
}
.list-header-name {
    color: #713365;
    font-weight: 900;
    margin: 0px;
}

.design-item .desginer-pic1 {
    position: initial;
    width: 150px;
    height: 150px;
    right: -75px;
    bottom: -50px;
    overflow: hidden;
    text-align: center;
    border-radius: 50%;
    box-shadow: 5px 5px 20px 0 rgba(0, 0, 0, 0.2);
}
	@media (max-width: 768px) {
  .designer_mob {
          margin: 0px 65px !important;
  } 
  .designer_msg {
          margin: 0px 80px !important;
  }
    #listing-block-mob{
	padding-top: 0px !important;
}
#contest-list-header {
    margin-top: 0px !important;
    padding: 110px 0px !important;
}
}
.d-pro-img{
    /*height: 100px;
    width: 100px;*/
    max-height: 150px;
    display: block;
    max-width: 150px;
    border-radius: 50%;
    overflow: hidden;

}

.d-pro-img img{
	margin: auto auto;
    display: block;
    vertical-align: bottom;
    width: 100%;
    box-shadow: 0px 0px 0px 0px rgb(218, 218, 218)!important;
}
.listing-block{
	padding-top: 108px !important;
}
</style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<?php 

if($this->session->userdata('user_type') == 1)
	//require('include/designer_contest_menu.php');
//else	
	//require('include/contest_menu.php'); ?>

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
					<input type="submit" value="Search" name="search" />
				</form>   
			</div>
					
				</div>
			</div>
		</div>
	</section>

       
   <section id="contests" class="page_list">
      <div class="container">		
        <div class="listing-block" id="listing-block-mob">
		<?php 
	if(!empty($result)) { foreach($result as $res) {
		$uid=$res->users_id;
		$wincount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'design_status'=>1));
		$finalcount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'final_status'=>1));
		$Participatcount=$this->Common_model->counts('designs','distinct(contest_id)',array('designer_id'=>$uid));
	?>		
         <div class="item-block wow fadeInUp">
			<a href="<?php echo base_url()."admin/designer_portfolio/".$uid ;?>">
				<div class="row">
					<div class="col-md-3 design-item">
						<div class="d-pro-img designer_mob">
							 <img src="<?php if(!empty($res->designer_profile)) { echo base_url();?>uploads/designer_profile/<?php echo $res->designer_profile; } else { echo base_url();?>assets/images/designer-signup.png<?php }?>">
							
						</div>

					</div>
					
					<!-- <div class="col-md-6"> -->
						<div class="col-md-3 designer_msg">
						
							 <h3 class="list-header-name"><?php echo $res->designer_name; ?></h3>
							 <?php $rating = get_designer_rating($uid); 
							// var_dump($rating);exit;
							 
							 foreach($rating as $star){
							 	if($star->design_count !="0"){
							 	 $avg=($star->design_rating/$star->design_count);
							 	
							 	 $avg1 =round($avg); 
									
							 	?>
							  <!----Star-->
									    <div id="rateYo_<?php echo $star->design_id; ?>" style="margin-left:-10px !important;"></div>
										 <script>
											$(function () {
										 
										  $("#rateYo_<?php echo $star->design_id; ?>").rateYo({
											fullStar: true,
											rating : <?php echo $avg1; ?>,
											 spacing: "10px",
											   starWidth: "25px",
											//readOnly: true
											
										  }).on("rateyo.set", function (e, data) { 
											  updateStar(<?php echo $star->design_id; ?>,data.rating);
										  });
										 
										});
										</script>
									   <!----Star-->
							<?php } else { echo "No Star Ratings"."<br>"; } } 
							 ?>
							 <span> <?php echo $wincount;?> Wining Designs</span><br>
							<!--  <span style="background-color: #674269;color: #fff;border-color: #713365;  border-radius: 2px;">Invite</span>  -->
					</div>
					<?php $images = get_design_image($uid);
					foreach($images as $img){ ?>
						<div class="col-md-2 col-6 list-icons">
					 <img class="imagesize" style="height: 132px!important; width: 150px!important;border-radius:5px!important; " src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $img->design_name;?>">
					</div>
					<?php }
					?>
				</div>
			</a>
          </div>		
         
             <?php } } else { ?>
    <div class="row" style="padding:10px; border:1px solid rgba(0,0,0,0.1);">
     	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
        	
            	No records available..
            
     	</div>
    </div>
    <?php } ?> 
    <div class="row">
 <?php echo pagination("admin/designer",$total_designers,20);?>
          </div>
          </div>

      </div>

  </section>

  <section class="search_list" style="display:none">
</section>
 </main>
<div class="gap-low"></div>

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