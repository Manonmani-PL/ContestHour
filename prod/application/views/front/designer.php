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
  color: #4c2670;
  transition: 0.5s;
}
a:hover, a:active, a:focus {
  color: #4c2670;
  outline: none;
  text-decoration: none;
}
</style>

<div class="gap-low"></div>
<div class="minheight">
<section>
<div class="container" style="background-color:#f4f2ed; margin-top:15px;">
	<div class="row">
    	<div class="col-md-4 col-lg-4">
        	<div class="contest-head">
            	<h4>Designers</h4>
            </div>
        </div>
        <div class="col-md-4 col-lg-4"></div>
        <div class="col-md-4 col-lg-4">
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

<section>
<div class="container">
	<div class="row" style="background-color:rgba(244,242,237,0.4); ">
    	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6"></div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
        	<div class="col-sm-3 col-xs-3">
            	<div class="won">Rank</div>
            </div>
        	<div class="col-sm-3 col-xs-3">
            	<div class="won">Won</div>
            </div>
            <div class="col-sm-3 col-xs-3">
            	<div class="final">Finalist</div>
            </div>
            <div class="col-sm-3 col-xs-3">
            	<div class="participate">Participate</div>
            </div>
        </div>
    </div>
</div>
</section>


<section class="page_list">
<div class="container">
	<?php 
	if(!empty($result)) { foreach($result as $res) {
		$uid=$res->users_id;
		$wincount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'design_status'=>1));
		$finalcount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'final_status'=>1));
		$Participatcount=$this->Common_model->counts('designs','distinct(contest_id)',array('designer_id'=>$uid));
	?>
	<div class="row" style="padding:10px; border:1px solid rgba(0,0,0,0.1);border-right:0px solid red;border-left:0px solid red;"> 
		<a href="<?php echo base_url()."admin/designer_portfolio/".$uid ;?>">
    	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
			<div class="row">
				<div class="col-sm-3 col-xs-12">
					<div class="d-pro-img">
						<img src="<?php if(!empty($res->designer_profile)) { echo base_url();?>uploads/designer_profile/<?php echo $res->designer_profile; } else { echo base_url();?>assets/images/designer-signup.png<?php }?>">
					</div>
				</div>
				<div class="col-sm-9 col-xs-12">
					<div class="d-pro-name"><?php echo $res->designer_name;?></div>
				</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
        	<div class="col-sm-3 col-xs-3">
            	<div class="won-rate"><?php echo $res->rank;?></div>
            </div>
        	<div class="col-sm-3 col-xs-3">
            	<div class="won-rate"><?php echo $wincount?></div>
            </div>
            <div class="col-sm-3 col-xs-3">
            	<div class="final-rate"><?php echo $finalcount ?></div>
            </div>
            <div class="col-sm-3 col-xs-3">
            	<div class="participate-rate"><?php echo $Participatcount ?></div>
            </div>
        </div>
		</a>
    </div>
    <?php } } else {?>
    <div class="row" style="padding:10px; border:1px solid rgba(0,0,0,0.1);">
     	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
        	
            	No records available..
            
     	</div>
    </div>
    <?php } ?> 
	
		
	
	<!---Pagination-->
    <?php// echo pagination("admin/designer",$total_designers,10);?>
	<!---Pagination Ends-->
	
</div>
<?php echo pagination("admin/designer",$total_designers,20);?>
</section>

<section class="search_list" style="display:none">
</section>

</div>

<div class="gap"></div>

<script>
$(document).ready(function() {
		$(document).on("keyup",".designer_search",function () {
			var search= $(this).val().toLowerCase();
			$(".search_list").hide();
			if(search !=''){

				$(".page_list").hide();
				$(".search_list").show();
				//alert(page_list);
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