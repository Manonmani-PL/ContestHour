<?php $designes= $this->session->userdata('user_id');?>
<br>
<br>
<br>
<div class="gap-low"></div>
<div class="minheight">
   <div class="container">
      <div class="row">
         <div class="col-md-3 col-lg-3">
            <div class="choose_cat">
               <div class="choose_cat_icon "><img class="noimgshawdow" src="<?php echo base_url();?>assets/image/choose_cat_icon1.png" width="71" height="72" />&nbsp;&nbsp;<span class="select">Choose category</span></div>
            </div>
         </div>
         <div class="col-md-3 col-lg-3">
            <div class="creative_brief">
               <div class="creative_brief_icon"><img class="noimgshawdow" src="<?php echo base_url();?>assets/image/creative_brief_icon.png" width="71" height="72" />&nbsp;&nbsp;<span>Creative brief</span></div>
            </div>
         </div>
         <div class="col-md-3 col-lg-3">
            <div class="payment_1">
               <div class="payment_icon"><img class="noimgshawdow" src="<?php echo base_url();?>assets/image/payment_icon.png" width="71" height="72" />&nbsp;&nbsp;<span>Payment options</span></div>
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
         <div class="col-sm-4">
            <div class="line"></div>
         </div>
         <div class="col-sm-4">
            <div class="startpage-header">
               <b>What design do you need?</b>
               <p>Select the type of design you need designed.</p>
            </div>
         </div>
         <div class="col-sm-4">
            <div class="line"></div>
         </div>
      </div>
   </section>
   <section>
      <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-3">
               <a href="<?php echo base_url(); ?>contest/brief?type=logodesign">
                  <div class="icon-col">
                     <div class="logo_icon"></div>
                     <p>Logo design</p>
                  </div>
               </a>
            </div>
            <div class="col-md-3 col-lg-3">
               <a href="<?php echo base_url(); ?>contest/brief?type=tshirtdesign">
                  <div class="icon-col">
                     <div class="t-shirt_icon"></div>
                     <p>T-shirt design</p>
                  </div>
               </a>
            </div>
            <div class="col-md-3 col-lg-3">
               <a href="<?php echo base_url(); ?>contest/brief?type=flyerdesign">
                  <div class="icon-col">
                     <div class="flyerdesign_icon"></div>
                     <p>Flyer design</p>
                  </div>
               </a>
            </div>
            <div class="col-md-3 col-lg-3">
               <a href="<?php echo base_url(); ?>contest/brief?type=businesscarddesign">
                  <div class="icon-col">
                     <div class="business_card_icon"></div>
                     <p>Business card design</p>
                  </div>
               </a>
            </div>
         </div>
         <div class="row">
            <div class="col-md-3 col-lg-3">
               <a href="<?php echo base_url(); ?>contest/brief?type=stationerydesign">
                  <div class="icon-col">
                     <div class="stationery_icon"></div>
                     <p>Stationery design</p>
                  </div>
               </a>
            </div>
            <div class="col-md-3 col-lg-3">
               <a href="<?php echo base_url(); ?>contest/brief?type=fbcoverdesign">
                  <div class="icon-col">
                     <div class="fb_cover_icon"></div>
                     <p>Facebook Cover Design</p>
                  </div>
               </a>
            </div>
            <div class="col-md-3 col-lg-3">
               <a href="<?php echo base_url(); ?>contest/brief?type=movielogodesign">
                  <div class="icon-col">
                     <div class="movie_icon"></div>
                     <p>Movie Logo design</p>
                  </div>
               </a>
            </div>
            <div class="col-md-3 col-lg-3" id="sumthingelse">
               <a class="somethings">
                  <div class="icon-col">
                     <div class="sumthingelse_icon"></div>
                     <p>Something else?</p>
                  </div>
               </a>
            </div>
         </div>
         <div class="row">
         </div>
      </div>
   </section>
   
   <section>
      <div class="container">
         <div class="col-md-12 col-lg-12 other_design"  id="some_else" onclick="">
            <div id="other_design">
               <div class="col-sm-4">
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/packaging24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=packagingdesign&name=Packaging%20Design"> Package Design</a></div>
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/banner24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=bannerdesign&name=Banner%20Design"> Banner Design</a></div>
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/calender24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=calenderdesign&name=Calender%20Design">Calender Design</a></div>
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/invitation24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=invitationdesign&name=Invitation%20Design">Invitation Design</a></div>
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/cat24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=cateloguedesign&name=Catelogue%20Design">Catelogue Design</a></div>
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/cd24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=cdcoverdesign&name=Cd%20Cover%20Design">Cd Cover Design</a></div>
				  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/ad24 (1).png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=icondesign&name=Icon%20Design">Icon Design</a></div>
               </div>
               <div class="col-sm-4">
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/ad24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=addesign&name=Ad%20Design">Ad Design</a></div>
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/label24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=labeldesign&name=Label%20Design"> Label Design</a></div>
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/letterhead24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=letterheaddesign&name=Letterhead%20Design"> Letterhead Design</a></div>
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/menu24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=menudesign&name=Menu%20Design"> Menu Design</a></div>
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/broucher24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=brochuredesign&name=Brochure%20Design">Brochure Design</a></div>
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/vehicle24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=vehiclewrapdesign&name=Vehicle%20Wrap%20Design">Vehicle Wrap Design</a></div>
               </div>
               <div class="col-sm-4">
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/invitation24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=envelopedesign&name=Envelope%20Design">Envelope Design</a></div>
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/ppt24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=powerpointdesign&name=Powerpoint%20Design">Powerpoint Design</a></div>
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/poster24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=posterdesign&name=Poster%20Design">Poster Design</a></div>
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/book24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=bookcoverdesign&name=Book%20Cover%20Design">Book Cover Design</a></div>
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/email24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=emailtemplatedesign&name=Email%20Template%20Design">Email Template Design</a></div>
                  <div class="other_design_col"><img src="<?php echo base_url();?>assets/image/mascot24.png" align="celebrate" /> &nbsp;&nbsp;<a href="<?php echo base_url(); ?>contest/brief?type=mascotdesign&name=Mascot%20Design">Mascot Design</a></div>                  
               </div>
            </div>
         </div>
      </div>
   </section>
   <section>
      <hr/>
   </section>
   <section>
      <div class="container">
         <div class="col-md-3"></div>
         <div class="col-md-8">
            <div class="col-sm-2">
               <div class="guarantee_icon"><img src="<?php echo base_url();?>assets/image/garuntee_icon.png" /></div>
            </div>
            <div class="col-sm-8">
               <div class="garentee_text">
                  <b>Money Back Guarantee!</b>
                  <p>Get the design you want or get your money back*</p>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<div class="gap"></div>
<script type="text/javascript">
   $(document).ready(function(){
		$('#some_else').hide();
		$("#sumthingelse").click(function () {
			$('#some_else').slideDown(1000);
		});
   });
</script>