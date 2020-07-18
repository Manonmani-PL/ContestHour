<div class="gap-low"></div>
<div class="minheight">
<form action="<?php echo base_url(); ?>contest/insert_payment_option" name="payment_option" id="payment_option" method="post" class="formcheck" >
        <input type="hidden" name="contest_id" value="<?php echo $contest_id; ?>" />
<div class="container">
	<div class="row">
    	
        <div class="col-md-3 col-lg-3">
        	<div class="choose_cat">
            	<div class="choose_cat_icon "><img class="noimgshawdow" src="<?php echo base_url();?>assets/image/last_choose_cat_icon1.png" width="71" height="72" />&nbsp;&nbsp;<span class="before_page" >Choose category</span></div>
            </div>
        </div>
         <div class="col-md-3 col-lg-3">
         		<div class="creative_brief">
            	<div class="creative_brief_icon"><img class="noimgshawdow" src="<?php echo base_url();?>assets/image/creative_brief_ico_before.png" width="71" height="72" />&nbsp;&nbsp;<span class="before_page">Creative brief</span></div>
            </div>
         </div>
          <div class="col-md-3 col-lg-3">
          	<div class="payment_option">
            	<div class="payment_icon"><img class="noimgshawdow" src="<?php echo base_url();?>assets/image/payment_icon_active.png" width="71" height="72" />&nbsp;&nbsp;<span class="select">Payment options</span></div>
            </div>
          </div>
           <div class="col-md-3 col-lg-3">
           
           <div class="conform_order">
            	<div class="conform_ordert_icon"><img class="noimgshawdow" src="<?php echo base_url();?>assets/image/conformorder_icon.png" width="71" height="72" />&nbsp;&nbsp;<span>Confirm order</span></div>
            </div>
           
           </div>
        
    </div>
</div>

<section>
	<div class="col-md-12 col-lg-12">
    	<div class="col-sm-3">
        	<div class="line"></div>
        </div>
        <div class="col-sm-6">
        	<div class="creative_breif-header">
            	<b>Which package do you prefer?</b>
                <p>Choose a package that will get the results you desire</p>
            </div>
        </div>
        <div class="col-sm-3">
        	<div class="line"></div>
        </div>
    </div>
</section>

<section>
<div class="container">
	<div class="row">
    	<div class="col-md-3 col-lg-3"></div>
        
        <div class="col-md-6 col-lg-6">
        	<div class="creative_brief">
            		<h3>Select Your Contest Prize</h3>
            	
                	<table width="100%" cellpadding="5" cellspacing="5">
                   
                    <tr>
                    <td><input type="text" autocomplete="off" onKeyPress="return isNumberKey(event)" name="payment_option_amt" id="payment_option_amt" class="contest_pay" required placeholder="Amount"/></td>
                    </tr>
                    <tr>
                    <td><label>Minimum contest prize is $<?php echo $min_price;?> . Higher prize will attract more designer</label></td>
                    </tr>
                    </table>
                   <h3>Listing Fee</h3>
                   <table width="100%" cellpadding="5" cellspacing="5">
                   <tr>
                   <td>
				   <label>$<?php echo $setpack->list_fee;?></label>
				   </td>
                   </tr>
                   <tr>
                   <td><label>Contest hours Designs flat $<?php echo $setpack->list_fee;?> fee for listing and carrying out your contest</label>
				   <input type="hidden" name="listing_fee" class="listing_fee" value="<?php echo $setpack->list_fee; ?>"/></td>
                   </tr>
                   </table>
				   
                   <h3>Express Hours</h3>
                   <table width="100%" cellpadding="5" cellspacing="5">
                  <tr>
                  <td><input type="radio" name="hours" class="exp_hours" data_val='<?php echo $setpack->hours24; ?>' value="24" /> &nbsp;24 Hours ($<?php echo $setpack->hours24; ?>)</td>
                  <td><input type="radio" name="hours" class="exp_hours" data_val='<?php echo $setpack->hours48; ?>' value="48" /> &nbsp;48 Hours ($<?php echo $setpack->hours48; ?>)</td>
                  </tr>
                  </table>
				  <input type="hidden" name="exp_pay" class="exp_pay" value="0">
                  <h3>Contest Duration</h3>
                  <table>
                  <tr>
                   <td><input type="radio" name="dur" class="con_duration" for="<?php echo $setpack->days3; ?>" value="3" />&nbsp; 3 Days - Prize $<?php echo $setpack->days3;?></td>
                   </tr>
                   <tr>
                   <td ><input type="radio" name="dur" class="con_duration" for="<?php echo $setpack->days4; ?>" value="4" />&nbsp; 4 Days - Prize $<?php echo $setpack->days4; ?></td>
				   </tr>
                   <tr>
                   <td ><input type="radio" name="dur" class="con_duration" for="<?php echo $setpack->days5; ?>" value="5" />&nbsp; 5 Days - Prize $<?php echo $setpack->days5; ?></td>
                   </tr>
                   <tr>
                    <td><input type="radio" name="dur" class="con_duration" for="<?php echo $setpack->days6; ?>" value="6" />&nbsp; 6 Days - Prize $<?php echo $setpack->days6; ?></td>
                    </tr>
                    <tr>
                    <td><input type="radio" name="dur" class="con_duration" for="<?php echo $setpack->days7; ?>" value="7" />&nbsp; 7 Days - Prize $<?php echo $setpack->days7; ?> </td>
                    </tr>
                   </table>
                  
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
        	<div class="pay_amount_total">
            <span>TOTAL : $ <i class="contest_total">00</i><i>.00</i></span>
			<input type="hidden" class="contest_total" name="contest_total">
            </div>
        </div>
        </div>
        	
            <div class="row">
        	  <div class="col-md-3"></div>
            <div class="col-md-6 col-lg-6">
            	<div class="project_upgrade">
                    <span>
                    <h2>Project upgrades</h2>
                    <p>Choose to upgrade and improve your project below</p>
                    </span>
					<!--
                    <div class="col-sm-2 col-xs-6">
                    	<div class="pay_opt_img1"><img src="<?php echo base_url();?>assets/image/payment_opt1.png" /></div>
                    </div>
                    <div class="col-sm-7 col-xs-6">
                    	<div class="pay_contant">
                        	<h4>Top Designers</h4>
                            <p>A personal invite is automatically sent out to our 5 top designers for your project.</p>


                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-6">
                    	<div class="pay_price">
                        	<p>+$<?php echo $setpack->top_des; ?></p>
                        </div>
                    </div>
                    <div class="col-sm-1 col-xs-6">
                    	<div class="amount_add">
                        	<input type="button" class="add_amount" id="add_top_designer" data_val="<?php echo $setpack->top_des; ?>" name="add_amount" value="+Add" />
							<input type="hidden" class="extra_pay" name="top_desgigner" />
                        </div>
                    </div>
                    -->
                </div>   
                </div>
            <div class="col-md-3"></div>
          
        </div>
        <!--
        <div class="row">
        	  <div class="col-md-3"></div>
            <div class="col-md-6 col-lg-6">
            	<div class="project_upgrade">
                   
                    <div class="col-sm-2 col-xs-6">
                    	<div class="pay_opt_img1"><img src="<?php echo base_url();?>assets/image/payment_opt2.png" /></div>
                    </div>
                    <div class="col-sm-7 col-xs-6">
                    	<div class="pay_contant">
                        	<h4>Choose Designers</h4>
                            <p>A personal invite is automatically sent out to ANY OF our 3 designers for your project.</p>


                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-6">
                    	<div class="pay_price">
                        	<p>+$<?php echo $setpack->design_fee;  ?></p>
                        </div>
                    </div>
                    <div class="col-sm-1 col-xs-6">
                    	<div class="amount_add">
                        	<input type="button" class="add_amount" id="choose_designer" data_val="<?php echo $setpack->design_fee;  ?>" name="add_amount" value="+Add" />
							<input type="hidden" class="extra_pay" name="choose_designer" />
                        </div>
                    </div>
                    
                </div>   
                </div>
            <div class="col-md-3"></div>
          
        </div>
        
        <div class="row">
        	  <div class="col-md-3"></div>
            <div class="col-md-6 col-lg-6">
            	<div class="project_upgrade">
                   
                    <div class="col-sm-2 col-xs-6">
                    	<div class="pay_opt_img1"><img src="<?php echo base_url();?>assets/image/payment_opt3.png" /></div>
                    </div>
                    <div class="col-sm-7 col-xs-6">
                    	<div class="pay_contant">
                        	<h4>Celebrity Contest</h4>
                            <p>Your contest will be listed among celebrity contests and will be treated with top priority.Almost all the designers will participate.</p>


                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-6">
                    	<div class="pay_price">
                        	<p>+$<?php echo $setpack->celebrity_fee; ?></p>
                        </div>
                    </div>
                    <div class="col-sm-1 col-xs-6">
                    	<div class="amount_add">
                        	<input type="button" class="add_amount" id="add_celebrity_contest" data_val="<?php echo $setpack->celebrity_fee; ?>" name="add_amount" value="+Add" />
							<input type="hidden" class="extra_pay" name="celebrity_contest" />
                        </div>
                    </div>
                    
                </div>   
                </div>
            <div class="col-md-3"></div>
          
        </div>
        -->
        <div class="row">
        	  <div class="col-md-3"></div>
            <div class="col-md-6 col-lg-6">
            	<div class="project_upgrade">
                   
                    <div class="col-sm-2 col-xs-6">
                    	<div class="pay_opt_img1"><img src="<?php echo base_url();?>assets/image/payment_opt4.png" /></div>
                    </div>
                    <div class="col-sm-7 col-xs-6">
                    	<div class="pay_contant">
                        	<h4>Private Contest</h4>
                            <p>Hide your Contest from the public and search engines.Its only visible to our logo designers.</p>


                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-6">
                    	<div class="pay_price">
                        	<p>+$ <?php echo $setpack->priv_fee; ?></p>
                        </div>
                    </div>
                    <div class="col-sm-1 col-xs-6">
                    	<div class="amount_add">
                        	<input type="button" class="add_amount" id="add_private_contest" data_val="<?php echo $setpack->priv_fee; ?>" name="add_amount" value="+Add" />
							<input type="hidden" class="extra_pay" name="private_contest" />
                        </div>
                    </div>
                    
                </div>   
                </div>
            <div class="col-md-3"></div>
          
        </div>
        
        <div class="row">
        	  <div class="col-md-3"></div>
            <div class="col-md-6 col-lg-6">
            	<div class="project_upgrade">
                   
                    <div class="col-sm-2 col-xs-6">
                    	<div class="pay_opt_img1"><img src="<?php echo base_url();?>assets/image/payment_opt5.png" /></div>
                    </div>
                    <div class="col-sm-7 col-xs-6">
                    	<div class="pay_contant">
                        	<h4>Featured Contest</h4>
                            <p>Featured contests are highlighted above our regular projects to attract more designers .</p>
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-6">
                    	<div class="pay_price">
                        	<p>+$ <?php echo $setpack->featured_fee; ?></p>
                        </div>
                    </div>
                    <div class="col-sm-1 col-xs-6">
                    	<div class="amount_add">
                        	<input type="button" class="add_amount" id="add_featured_contest" data_val="<?php echo $setpack->featured_fee; ?>" name="add_amount" value="+Add" />
							<input type="hidden" class="extra_pay" name="featured_contest" />
                        </div>
                    </div>
                </div>   
               </div>
            <div class="col-md-3"></div>
          
        </div>
    </div>

</section>

<section>
<hr />
</section>

<section>
	<div class="container">
		<div class="col-md-7 col-md-offset-3">
			<p style="color: #f14b15;font-weight: 800;">
			Note: Only Listing Fee will be charged for Partial Payments. Pay Rest if you are happy with designs.
			</p>
		</div>
	</div>	
</section>

<section>

<div class="container">
	<div class="col-md-4"></div>
    <div class="col-md-2">
    	<div class="save_progress">
        		<input type="submit" name="sub_btn" value="Save Progress" />
        </div>
    </div>
    <div class="col-md-2">
    	<div class="proceed_payment">
        		<input type="submit" name="sub_btn" value="Proceed" />
        </div>
    </div>
    <div class="col-md-4"></div>
</div>	

</section>

</form>
</div>

<div class="gap"></div>

<script>


function isNumberKey(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 40 && (charCode < 48 || charCode > 57))
	return false;
 return true;
}

$(document).ready(function(event){
	
	var minval = <?php echo $min_price; ?>;
	
	
	$('.contest_pay').on('keyup',function(){
		get_total();
	});
	
	$('.exp_hours').on('change',function(){
		$(".con_duration").removeAttr("checked");
		var exp_pay=$('.exp_hours:checked').attr('data_val');
		$('.exp_pay').val(exp_pay);
		get_total();
	});
	
	$('.con_duration').on('change',function(){
		$(".exp_hours").removeAttr("checked");
		var tot= $(this).attr("for");
		$('.exp_pay').val(tot);
		get_total();
	
		/* if((tot !="") && (parseFloat(payamt) >= parseFloat(tot))){
			
		}
		else{
			$('.con_duration').prop('checked', false);
			alert("Contest Total Should Be More Than $"+minval+" To Select The Contest Duration");
		} */
	});
	
	$('.add_amount').on('click',function(){
		$(this).toggleClass('set');
		$(this).next('.extra_pay').toggleClass('selected');
		var extra=$(this).attr('data_val');
        if($(this).hasClass('set')){
             $(this).next('.extra_pay').val(extra);            
        }
        else{
            $(this).next('.extra_pay').val("");
        }
		
		get_total();
	});
	
	var get_total=function(){
		
		var grand=0;
		
		var spay= $('.contest_pay').val(); 
		
		spay=(spay=="")?0:spay;
		
		var lpay= $('.listing_fee').val(); 
		 lpay=(lpay=="")?0:lpay;
		 
		var exp_pay= $('.exp_pay').val();
		exp_pay =(exp_pay!="")?exp_pay:0;
		//alert(exp_pay);
		
		grand= parseFloat(spay)+ parseFloat(lpay) + parseFloat(exp_pay);
		
		var ex_tot=0;
		$('.selected').each(function(e){
			var eval= $(this).val();
			ex_tot +=(eval=="")?0:parseFloat(eval);
		});
		
		grand += ex_tot;
		
		$('.contest_total').html(grand);
		$('.contest_total').val(grand);
		
		//if(grand < minval ){$('.con_duration').prop('checked', false);}
	}

	
	$("#payment_option").submit(function(e){
        var amtval = $(".contest_pay").val();
		if(amtval < minval)
		{
			e.preventDefault();
			alert("Contest Total Should Be More Than $"+minval );
			$(this).val("");
		}
		else if ($('.exp_hours:checked').length <= 0 && $('.con_duration:checked').length <= 0 ) {
		    e.preventDefault();
			alert("Please select your contest duration.");
		} 
		else{
			
		}
    });
	
	
});
	
</script>