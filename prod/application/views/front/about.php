<div class="gap-low"></div>

<section>
<div class="container">
    
	<div class="row">
    	<div class="col-md-12 col-lg-12">
        	<div class="contest-head">
            	<h2>Who We Are</h2>
            </div>
        </div>
        <br>
        <div class="col-md-12 col-lg-12">
           
            <p>Contesthours is a platform created to connect startup companies with talented and creative designers from all over the world.</p>
            
            <p>We want to make logo design affordable to everyone. We want people to create an identity for themselves and for their business to stand out.</p>
            
            <p>This site is friendly competition between designers who want to put their best effort to meet the client’s vision.</p>
            
            <p>We’re working hard 24/7 to provide our customers with the best platform for getting their dream designs on demand.</p>
            
            <p>We will continue to bring new platforms to bridge designers, professionals, developers, and web designer with clients.</p>
            
        </div>
    </div>
</div>
</section>

<div class="gap"></div>

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