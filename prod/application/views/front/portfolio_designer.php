<?php $this->load->view('front/include/left_side_menu_designer'); ?>
  <div class="col-sm-9">
    <div class="right-border">
    	<div class="row">
            <div class="col-sm-12">
                <div class="payment">
                	<h3>Designer Portfolio</h3>
                    <div class="col-sm-6">
                    	<div class="p_a_n">
                        	<h4>WINNIG DESIGNS</h4>
                        </div>
                        <div class="p_a_m">
                        	<h4>MY DESIGN PORTFOLIO</h4>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                    	<div class="r_p_o">
                    		<a href="#" class="js-open-modal btn" data-modal-id="popup1">Add New Portfolio</a>
                        </div>    
                    </div>
                    
                </div>
            		
                    <div id="popup1" class="modal-box">
  <header> <a href="#" class="js-modal-close close">×</a>
    <h3>ADD NEW DESIGN PORTFOLIO</h3>
  </header>
  <div class="portfolio-body">
  		<table width="100%" cellpadding="4" cellspacing="25">
        	<tr>
            <td>Portfolio Title:</td>
            </tr>
            <tr>
            <td><input type="text" name="portfolio_title" class="portfolio_title" id="portfolio_title" /></td>
            </tr>
            <tr>
            <td><input type="file" /></td>
            </tr>
            <tr>
            <td><input type="submit" value="Upload" name="p_upload" /></td>
            </tr>
        </table>
        
  </div>
 <!-- <footer> <a href="#" class="add_btn">Add</a>&nbsp;&nbsp;<a href="#" class=" btn-small js-modal-close">Close</a> </footer>-->
</div>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> 
<script>
$(function(){

var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");

	$('a[data-modal-id]').click(function(e) {
		e.preventDefault();
    $("body").append(appendthis);
    $(".modal-overlay").fadeTo(500, 0.7);
    //$(".js-modalbox").fadeIn(500);
		var modalBox = $(this).attr('data-modal-id');
		$('#'+modalBox).fadeIn($(this).data());
	});  
  
  
$(".js-modal-close, .modal-overlay").click(function() {
    $(".modal-box, .modal-overlay").fadeOut(500, function() {
        $(".modal-overlay").remove();
    });
 
});
 
$(window).resize(function() {
    $(".modal-box").css({
        top: ($(window).height() - $(".modal-box").outerHeight()) / 10,
        left: ($(window).width() - $(".modal-box").outerWidth()) / 6
    });
});
 
$(window).resize();
 
});
</script> 
            
              
       </div>
        </div>
    </div>
  </div>
</div>
</div>






</div>
<div class="container">
	<div class="col-md-3"></div>
    
    <div class="col-md-3"></div>
    <div class="col-md-3"></div>
</div>
<div class="gap"></div>
