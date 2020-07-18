<script type="text/javascript" src="<?php echo base_url();?>assets/js/jscolor.js"></script>
<style>
[tabbed]{border:1px solid red;}
</style>
<div class="gap-low"></div>
<div class="minheight">
<center>
   <h3 style="color:blue"><?php echo $this->session->flashdata('msgs');?></h3>
</center>
<?php 
	$contest_category= contest_category();
   $user_id = $this->session->userdata('user_id');
   $username = $this->session->userdata('user_name');
   
   if($this->session->flashdata('design_upload')){ echo $this->session->flashdata('design_upload');}
   	//Find industry name
   	$ins = array();
   	foreach ($industry as $in){
   		$ins[$in->id]=$in->industry_name;
   	}
   	//Find designer name
   	$sign = array();
   	foreach($users_list as $ul){
   		$sign[$ul->user_id]=$ul->user_name;
   	}
   	 if(isset($error)) echo $error;
   ?>
<section>
   <div class="container" style="background-color:#f4f2ed; margin-top:15px;">
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div class="contest-head">
               <h3> <?php
                  if($single_contest[0]->contest_type=="logodesign" || $single_contest[0]->contest_type=="webdesign" || $single_contest[0]->contest_type=="movielogodesign")
                  	echo ucfirst($single_contest[0]->org_name);
                  else
                  	 echo ucfirst($single_contest[0]->contest_title);
                  ?> </h3>
            </div>
         </div>
      </div>
   </div>
</section>
<?php 	$time=time2string(strtotime($single_contest[0]->close_date) - time()); ?>
<div class="judging-view">
   <div class="container">
      <!--price-btn--->
      <div class="row">
         <div class="col-sm-2 col-xs-6">
            <div class="judging-price">
               <b>$ <?php echo $single_contest[0]->contest_prize; ?></b>
            </div>
         </div>
         <div class="col-sm-6 col-xs-6">
            <div class="hours-entries">
               <?php if($single_contest[0]->status == 'open' || $single_contest[0]->status == 'draft' ){ ?>
               <h2><?php echo time2string(strtotime($single_contest[0]->close_date) - time())?></h2>
               <?php 	
                  $time=time2string(strtotime($single_contest[0]->close_date) - time()); 
                  ?>
               <p>left to submit design concepts.</p>
               <?php } ?>
            </div>
         </div>
         <div class="col-sm-4 col-xs-6">
            <div class="judging-entries">
               <ul>
                  <!--
                     <li><img width="18" src="<?php echo base_url(); ?>assets/images/private-contest.png"><i class="fa fa-shield"></i> Private Contest</li>-->
					<?php
                     $select=(round($single_contest[0]->pay_option)==1)?"select":"non-select";
                     ?>
					<li class="<?php echo $select?>"><span><i class="fa fa-check"></i></span> Guaranteed Contest</li>
                  
                  <?php if(round($single_contest[0]->upgrade_private_contest) >0):?>
                  <li class="select"><span><i class="fa fa-shield"></i></span> Private Contest</li>
                  <?php 
                   endif; 
                   if(round($single_contest[0]->upgrade_featured_contest) >0):
                  ?>
                  <li class="select"><span><i class="fa fa-star"></i></span> Featured Contest</li>
                  <?php endif;?>
               </ul>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-4 col-sm-offset-8 col-xs-6 pull-right">
            <?php 
               $usertype = $this->session->userdata('user_type');
               
               
                if(isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1) && (!isset($winningcontest) && empty($winningcontest)))
               	{
               		?>
            <div class="">
               <a class="js-open-modal btn btn-submit" data-modal-id="popup1">FINALIST SUBMIT YOUR DESIGN</a>
            </div>
            <?php } else if(isset($usertype) && !empty($usertype) && ($usertype !='0') && (!isset($winningcontest) && empty($winningcontest)) && $time!="Time Out" && $single_contest[0]->status !="judging"){ ?>
            <div class="">
               <a class="js-open-modal btn btn-submit" data-modal-id="popup1">SUBMIT YOUR DESIGN</a>
            </div>
            <?php }
               else if($usertype=='' && $single_contest[0]->status =="open")
               { ?>
            <?php print_r($usertype); ?>
            <div class="">
               <a href="<?php echo base_url();?>Admin/loginForm " class="js-open-modal btn btn-submit">SUBMIT YOUR DESIGN</a>
            </div>
            <?php $this->session->set_flashdata('message_name', 'please Login after then submit your design'); }
               ?>	
         </div>
         <!-------------POP BOX --------------->	
         <div id="popup1" class="modal-box">
            <header>
               <a href="#" class="js-modal-close close">X</a>
               <h3>Please upload yours file here</h3>
            </header>
            <div class="modal-body">
               <form action="<?php echo base_url();?>contest/design_upload" name="design_upload" id="design_upload"  method="post" enctype="multipart/form-data">
                  <input type="file" name="for_upload" id="for_upload" />
                  <div class="help-block"> Please Upload the Files Only in (320px * 250px) Dimension</div>
                  <div id="preview1"></div>
                  <input type="hidden" name="contest_id" value="<?php echo $single_contest[0]->id; ?>" />
                  <input type="hidden" name="client_id" value="<?php echo $single_contest[0]->client_id; ?>" />
                  <?php	
                     if(isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1))
                     {
                     ?>
                  <input type="hidden" id="final_status" name="final_status" value="<?php echo $subcheck->final_status; ?>" />
                  <?php	} ?>
                  </br>
                  <input type="submit" value="Upload" onclick="return Upload()" />
               </form>
            </div>
            <footer> <a href="#" class="btn btn-small js-modal-close">Close</a> </footer>
         </div>
         <!-------------END POP BOX --------------->
      </div>
      <!---mode--->
      <?php if(isset($single_contest[0]->status) && !empty($single_contest[0]->status) && ($single_contest[0]->status == 'completed' )){ ?>
      <div class="row">
         <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
            <div class="completed-mode">
               QUALIFYING STAGE
            </div>
         </div>
         <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
            <div class="completed-mode">
               JUDGING STAGE
            </div>
         </div>
         <?php if(($winningcontest->designer_id == $user_id || $winningcontest->client_id==$user_id)&&($single_contest[0]-> package_status<3)):?>
         <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
            <div class="open-mode-active">
               WINNER SELECTED
            </div>
         </div>
         <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
            <div class="completed-mode">
               CONTEST COMPLETED
            </div>
         </div>
         <?php elseif(($winningcontest->designer_id == $user_id || $winningcontest->client_id==$user_id)&&($single_contest[0]-> package_status==3)):?>
         <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
            <div class="completed-mode">
               WINNER SELECTED
            </div>
         </div>
         <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
            <div class="open-mode-active">
               CONTEST COMPLETED
            </div>
         </div>
         <?php else:?>
         <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
            <div class="open-mode-active">
               CONTEST COMPLETED
            </div>
         </div>
         <?php endif;?>
      </div>
      <?php } else if(isset($single_contest[0]->status) && !empty($single_contest[0]->status) && ($single_contest[0]->status == 'judging' )) { ?>
      <div class="row">
         <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="completed-mode">
               <span>1</span>&nbsp;OPEN
            </div>
         </div>
         <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="open-mode-active">
               <span>2</span>&nbsp;JUDGING MODE
            </div>
         </div>
         <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="completed-mode">
               <span>3</span>&nbsp;COMPLETED
            </div>
         </div>
      </div>
      <?php } else { ?> 
      <div class="row">
         <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="open-mode-active">
               <span>1</span>&nbsp;OPEN
            </div>
         </div>
         <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="completed-mode">
               <span>2</span>&nbsp;JUDGING MODE
            </div>
         </div>
         <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="completed-mode">
               <span>3</span>&nbsp;COMPLETED
            </div>
         </div>
      </div>
      <?php } ?>
      <!--tab-->
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div class="tab">
               <ul tabbed style="border:0px solid red;">
                  <li>
                     <div style="border:1px solid red;">BRIEF</div>
                     <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                           <div class="d-name_desc">
                              <p>NAME & DESCRIPTION</p>
                           </div>
                        </div>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                           <div class="d-name_desc_detail">
                              <?php
                                 $many = unserialize($single_contest[0]->extras);
                                 
                                 
                                 
                                 if($single_contest[0]->contest_type=="logodesign" || $single_contest[0]->contest_type=="webdesign" || $single_contest[0]->contest_type=="movielogodesign") {?>								
                              <b>COMPANY TITLE (LOGO NAME)</b>
                              <?php } else {?>
                              <b>CONTEST TITLE</b>
                              <?php }?>
                              <p>
                                 <?php
                                    if($single_contest[0]->contest_type=="logodesign" || $single_contest[0]->contest_type=="webdesign" || $single_contest[0]->contest_type=="movielogodesign")
                                    	echo $single_contest[0]->org_name;
                                    else
                                    	 echo $single_contest[0]->contest_title;
                                    ?>
                              </p>
                              <b>PLEASE DESCRIBE WHAT YOUR BUSINESS DOES IN ONE SENTENCE</b>
                              <p><?php echo $single_contest[0]->business_description; ?></p>
                              <b>INDUSTRY</b>
                              <p><?php echo $ins[$single_contest[0]->industry]; ?></p>
                              <?php if($single_contest[0]->contest_type=="logodesign"){ ?>
                              <b>TAGLINE</b>
                              <?php } else {?>
                              <b>BACKGROUND INFO</b>
                              <?php } ?>
                              <p>
                                 <?php if($single_contest[0]->contest_type=="logodesign") 
                                    echo $many['tagline'];
                                    else
                                    echo $single_contest[0]->background_info;
                                    ?>
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                           <div class="d-style_desc">
                              <p>
                                 <?php		
                                    $data = @unserialize($single_contest[0]->visual_style);
                                    if ($data !== false) 
                                    	$vis = unserialize($single_contest[0]->visual_style);		
                                    if($single_contest[0]->contest_type == "logodesign") 
                                                         	echo "STYLE SLIDERS";
                                    else
                                    	echo "VISUAL STYLE";	
                                    ?>
                              </p>
                           </div>
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-12">
                           <div class="d-style_desc_detail">
                              <?php if($single_contest[0]->contest_type=="logodesign") { ?>
                              <p><span>FEMININE</span>&nbsp;&nbsp;</span><span><input type="range" class="range" readonly value="<?php echo $many['slider1']; ?>" /></span>&nbsp;&nbsp;<span>MASCULINE</span></p>
                              <p><span>SIMPLE</span>&nbsp;&nbsp;</span><span><input type="range" class="range" readonly  value="<?php echo $many['slider2']; ?>" /></span>&nbsp;&nbsp;<span>COMPLEX</span></p>
                              <p><span>MODEST</span>&nbsp;&nbsp;</span><span><input type="range" class="range" readonly  value="<?php echo $many['slider3']; ?>" /></span>&nbsp;&nbsp;<span>LUXURY</span></p>
                              <p><span>PLAYFUL</span>&nbsp;&nbsp;</span><span><input type="range" class="range" readonly  value="<?php echo $many['slider4']; ?>" /></span>&nbsp;&nbsp;<span>SERIOUS</span></p>
                              <p><span>MODERN</span>&nbsp;&nbsp;</span><span><input type="range" class="range" readonly  value="<?php echo $many['slider5']; ?>" /></span>&nbsp;&nbsp;<span>VINTAGE</span></p>
                              <p><span>SPORTY</span>&nbsp;&nbsp;</span><span><input type="range" class="range" readonly  value="<?php echo $many['slider6']; ?>" /></span>&nbsp;&nbsp;<span>ELEGANT</span></p>
                              <?php } elseif($single_contest[0]->contest_type=="webdesign"){ ?>
                              <b>ORG NAME</b>
                              <p><?php if(isset($vis) && !empty($vis)) { echo $vis['org_name']; } ?></p>
                              <b>WEBSITE ADDRESS</b>
                              <p><?php if(isset($vis) && !empty($vis)) { echo $vis['website_address']; } ?></p>
                              <?php } elseif($single_contest[0]->contest_type=="tshirtdesign"){ ?>                            
                              <b>SPECIFIC COLOR</b>
                              <p><?php if(isset($vis) && !empty($vis)) { echo $vis['specific_color']; } ?></p>
                              <?php } else {?>
                              <b>VISUAL STYLE</b>
                              <p><?php echo $single_contest[0]->visual_style;?></p>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                     <?php if($single_contest[0]->contest_type=="logodesign") { ?>
                     <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                           <div class="d-color_desc">
                              <p>COLORS</p>
                           </div>
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-12">
                           <div class="d-style_desc_detail">
                              <button style="background-color:#<?php echo $many['color1'];?>" class="r-color"></button>
                              <button style="background-color:#<?php echo $many['color2'];?>" class="r-color"></button>
                              <button style="background-color:#<?php echo $many['color3'];?>" class="r-color"></button>
                              <button style="background-color:#<?php echo $many['color4'];?>" class="r-color"></button>
                           </div>
                        </div>
                     </div>
                     <?php } elseif($single_contest[0]->contest_type=="webdesign" || $single_contest[0]->contest_type=="businesscarddesign") { 
                        $chother = @unserialize($single_contest[0]->other_details); 
                        if( $chother !== false)
                        $other = unserialize($single_contest[0]->other_details); 
                        
                        ?>
                     <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                           <div class="d-idea_desc">
                              <p>OTHER DETAILS</p>
                           </div>
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-12">
                           <div class="d-idea_desc_detail">
                              <p><?php if(isset($chother) && !empty($chother)){ echo $other['designersinfo'];} ?></p>
                           </div>
                        </div>
                     </div>
                     <?php } else {?>
                     <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                           <div class="d-idea_desc">
                              <p>OTHER DETAILS</p>
                           </div>
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-12">
                           <div class="d-idea_desc_detail">
                              <p><?php echo $single_contest[0]->other_details; ?></p>
                           </div>
                        </div>
                     </div>
                     <?php } ?>
                     <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                           <div class="d-idea_desc">
                              <p>IDEAS</p>
                           </div>
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-12">
                           <div class="d-idea_desc_detail">
                              <p><?php
                                 if($single_contest[0]->contest_type == "logodesign") 
                                 	echo $many['ideas']; 
                                 else if(isset($vis) && !empty($vis))
                                 	echo $vis['ideas'];
                                 ?></p>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                           <div class="d-attach_desc">
                              <p>FILE ATTACHED</p>
                           </div>
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-12">
                           <?php if(!empty($single_contest[0]->filename)):?>
                           <div class="d-logo_desc_detail">
                              <a target="_blank" download class="js-open-modal btn"style="line-height: 0; font-size: 0; color: transparent; " href="<?php echo base_url(); ?>uploads/brief/<?php echo $single_contest[0]->filename; ?>" ><img src="<?php echo base_url();?>uploads/brief/<?php echo $single_contest[0]->filename;?>" width=200 height=200></a>
                           </div>
                           <?php 
                              else: echo "No reference files.";
                              endif;?>
                        </div>
                     </div>
                     <div id="popup1" class="modal-box">
                        <header>
                           <a href="#" class="js-modal-close close">×</a>
                           <h3><?php echo $single_contest[0]->filename; ?></h3>
                        </header>
                        <div class="modal-body">
                           <img src="<?php echo base_url();?>uploads/brief/<?php echo $single_contest[0]->filename ?>" width="100%"/>
                        </div>
                        <footer> <a  class="btn btn-small js-modal-close">Close</a> </footer>
                     </div>
                     <!------------------------------------->
                  </li>
                  <li>
                     <div>ENTRIES (<?php echo $count_designs;?>)</div>
                     <?php												
                        if(isset($winningcontest) && !empty($winningcontest)){ 
                        ?>
                     <div class="row" style="background-color:#f4f2ed; padding:10px;">
                        <div class="col-md-6 col-lg-6">
                           <div class="submit-design">WINNING DESIGN </div>
                        </div>
                     </div>
                     <div class="row">
                        <?php 
                           if(isset($winningcontest) && !empty($winningcontest))
                            {
                           		$prvcomments = design_comment($winningcontest->design_id);
                           ?>
                        <div class="col-md-5 col-lg-5">
                           <div class="logo_design_model" >
                              <div class="logo_d_name">
                                 # <?php echo $winningcontest->design_no;?> by <a href="#"><?php echo $sign[$winningcontest->designer_id];?></a>
                              </div>
                              <div class="logo_image winning_design" >
                                 <img src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $winningcontest->design_name;?>" width="100%" />
                                 <span class="logo-status">
                                 <i class="logo-rank">1st</i>
                                 </span>
								 <span class="logo-status-img">
                                  <img src="http://addobyte.com/demo/contestdemo/assets/images/client-signup.png" style="" width="70%" />
                                 </span>
                              </div>
                              <div class="user_review">
                              </div>
                           </div>
                           <div class="col-sm-8 col-xs-4">
                           </div>
                           <?php if(isset($single_contest[0]->win_comments) && empty($single_contest[0]->win_comments)){
                              if($user_id == $winningcontest->client_id)
                              { 
                              ?>
                           <div>
                              <label>Comments</label>
                              <form action="<?php echo base_url();?>contest/contest_wincomment" name="windesign_upload" method="post" enctype="multipart/form-data">
                                 <textarea name="win_comments" id="win_comments" style="width: 723px; height: 106px;" class="msg_box" cols='20' rows="20" ></textarea>
                                 <input type="hidden" name="wincontestid" value="<?php echo $single_contest[0]->id; ?>" />
                                 <input type="hidden" name="windesignid" value="<?php echo $winningcontest->design_id; ?>" />
                                 <input class="precomm" type="submit" value="SUBMIT" />
                              </form>
                           </div>
                           <?php } } else { ?>
                           <div>
                              <label>Comments Given By Client</label>
                              <p><?php echo $single_contest[0]->win_comments; ?></p>
                           </div>
                           <?php } ?>
                        </div>
                        <div class="col-md-7 col-lg-7">
                           <div class="client-description">
                              <p><b><?php echo ucwords(username($winningcontest->client_id));?></b> has selected <b><?php echo ucwords(username($winningcontest->designer_id));?></b> as the winner from <b> <?php echo $count_designs;?> </b> designers </p>
                           </div>
                        </div>
                        <?php }  ?>
                     </div>
                     <br><br>.
                     <?php } ?>
                     <?php 
                        if(isset($subfinaldesigns) && !empty($subfinaldesigns)){
                        ?>
                     <div class="row" style="background-color:#f4f2ed; padding:10px;">
                        <div class="col-md-6 col-lg-6">
                           <div class="submit-design">ENTERIES BY FINALIST DESIGNERS</div>
                        </div>
                     </div>
                     <div class="row">
                        <?php 
                           $sdno=0;
                           if(isset($subfinaldesigns) && !empty($subfinaldesigns))
                            {
                           $rcount=$this->Common_model->get_records_count('designs',array('design_status'=>1,'contest_id'=>$subfinaldesigns[0]->contest_id));	 
                           
                           		foreach($subfinaldesigns as $subfdes) { 
                           		$prvcomments = design_comment($subfdes->design_id);
                           		$sdno++;
                           ?>
                        <div class="col-md-4 col-lg-4">
                           <div class="logo_design_model" style="width:300px;">
                              <div class="logo_d_name">
                                 # <?php echo $subfdes->design_no;?> by <a href="#"><?php echo $sign[$subfdes->designer_id];?></a>
                              </div>
                              <div class="logo_image" style="width:300px;">
                                 <?php  if( ($single_contest[0]->status != "completed") && ($user_id != $subfdes->client_id) && ($user_id != $subfdes->designer_id) ) { ?>
                                 <img class="imagesize" style="width:300px!important;" src="<?php echo base_url(); ?>assets/image/hidden.jpg"  />
                                 <?php } else{ ?>
                                 <img class="imagesize" style="width:300px!important;" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_name;?>"  />
                                 <?php } ?>
                                 <span class="logo-status">
                                 <i class="logo-rank"><?php echo $sdno.suffix($sdno);?></i>
                                 </span>
                              </div>
                              <div class="user_review row">
                                 <div class="col-sm-12 col-xs-12">
                                    <div class="star-rating">
                                       <input for="<?php echo $subfdes->design_id; ?>" id="input-21b"  <?php 
                                          if($user_id != $subfdes->client_id){ echo 'readonly'; } ?> value="<?php echo $subfdes->design_rating; ?>" type="number" class="rating checkrate" min=0 max=5 step=1 data-size="md">
                                    </div>
                                 </div>
                                 <?php
                                    if($rcount==0)
                                    {
                                    ?>
                                 <div class="col-md-6" >		
                                    <?php if($user_id == $subfdes->client_id){ ?>
                                    <a  for='<?php echo $subfdes->design_id;  ?>' data-modal-id="subfinpopup<?php echo $subfdes->design_id; ?>" class="choose_winner">Choose Winner</a>
                                    <?php } ?>
                                 </div>
                                 <?php } ?>
                                 <div class="col-md-6 text-right" >
                                    <?php 
                                       if(($user_id == $subfdes->client_id) || (($user_id == $subfdes->designer_id) && (count($prvcomments) > 0))){
                                       ?>
                                    <?php echo count($prvcomments); ?> &nbsp;<a  style='color:#f14b15'  data-modal-id="finpopup<?php echo $subfdes->design_id; ?>" >Comments</a>
                                    <?php } else { ?>  	<?php echo count($prvcomments); ?> &nbsp;<span>Comments</span>
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="subfinpopup<?php echo $subfdes->design_id; ?>" class="modal-box">
                           <header>
                              <a class="js-modal-close close" style="top: 1% !important;">×</a>
                              <h3>Choose Winner</h3>
                           </header>
                           <form action="<?php echo base_url();?>contest/winn_contest" name="design_upload" method="post" enctype="multipart/form-data">
                              <div class="modal-body">
                                 <label>Do You Want Choose As A Winner ?</label>    
                                 <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                                 <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                                 <input type="hidden" name="designid" value="<?php echo $subfdes->design_id; ?>" />
                                 <input type="hidden" name="designer_id" value="<?php echo $subfdes->designer_id; ?>" />
                                 </br> 
                                 <div class="row" style="margin-top:20px;">
                                    <div class="col-md-6"><img style="width:300px!important;"  class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_name;?>"  /></div>
                                 </div>
                              </div>
                              <footer> <a class="btn btn-small js-modal-close">Close</a> <input type="submit" class="btn btn-small" value="Winner" /> </footer>
                           </form>
                        </div>
                        <div id="finpopup<?php echo $subfdes->design_id; ?>" class="modal-box">
                           <header>
                              <a  class="js-modal-close close" style="top: 1% !important;">×</a>
                              <h3>Comments</h3>
                           </header>
                           <div class="modal-body">
                              <div class="logo_image"><img style="width:300px!important;"  class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_name;?>" /></div>
                              <?php
                                 $finalprvcomments = design_comment($subfdes->design_id);
                                 
                                  if(isset($finalprvcomments) && !empty($finalprvcomments)) { 
                                 		foreach($finalprvcomments as $tmp3)
                                 		{
                                 			
                                 ?>
                              <div class="row">
                                 <div class="col-md-6 col-lg-6">
                                    <div class="messanger-name"><b><?php echo $tmp3->createdname; ?></b> <?php  if($tmp3->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                                 </div>
                                 <div class="message-timming"><?php echo date("d-m-Y H:i ",strtotime($tmp3->createddate)); ?></div>
                              </div>
                              <div class="row">
                                 <div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp3->comment;?></div>
                              </div>
                              <div class="row" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                              </div>
                              <?php } } ?>
                              <form action="<?php echo base_url();?>contest/contest_privcomment" name="design_upload" method="post" enctype="multipart/form-data">
                                 <textarea rows="5" cols="20" class="msg_box" style="width: 723px; height: 106px;" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                                 <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                                 <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                                 <input type="hidden" name="designid" value="<?php echo $subfdes->design_id; ?>" />
                                 <input type="hidden" name="designerid" value="<?php echo $subfdes->designer_id; ?>" />
                                 </br>
                                 <input type="submit" class="precomm" value="Add Comment" />
                              </form>
                           </div>
                           <footer> <a  class="btn btn-small js-modal-close">Close</a> </footer>
                        </div>
                        <?php } } ?>
                     </div>
                     <br><br>
                     <?php } ?>
                     <?php 
                        /*	if(isset($finaldesigns) && !empty($finaldesigns)){
                        	?>				
                     <div class="row" style="background-color:#f4f2ed; padding:10px;">
                        <div class="col-md-6 col-lg-6">
                           <div class="submit-design">THE ELECTED FINALIST DESIGNERS</div>
                        </div>
                     </div>
                     <div class="row">
                        <?php 
                           foreach($finaldesigns as $fdes) { 
                           	$prvcomments = design_comment($fdes->design_id);
                           	
                           	
                           //		echo $fdes->design_id;
                           ?>
                        <div class="col-md-4 col-lg-4">
                           <div class="logo_design_model">
                              <div class="logo_d_name">
                                 # <?php echo $fdes->design_no;//$fdes->design_id;?> by <?php echo $sign[$fdes->designer_id];?>
                              </div>
                              <div class="logo_image">
                                 <?php  if( ($single_contest[0]->status != "completed") && ($user_id != $fdes->client_id) && ($user_id != $fdes->designer_id) ) { ?>
                                 <img class="imagesize" src="<?php echo base_url(); ?>assets/image/hidden.jpg"  />
                                 <?php } else{ ?>
                                 <img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $fdes->design_name;?>"  />
                                 <?php } ?>
                              </div>
                              <div class="user_review">
                                 <div class="col-sm-8 col-xs-12">
                                    <div class="star-rating">
                                       <input for="<?php echo $fdes->design_id; ?>" id="input-21b"  <?php 
                                          if($user_id != $fdes->client_id){ echo 'readonly'; } ?> value="<?php echo $fdes->design_rating; ?>" type="number" class="rating checkrate" min=0 max=5 step=1 data-size="md">
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-xs-12">
                                    <div class="commend">										
                                       <?php 
                                          if(($user_id == $fdes->client_id) || (($user_id == $fdes->designer_id) && (count($prvcomments) > 0))){
                                          ?>
                                       <?php echo count($prvcomments); ?> &nbsp;<a  data-modal-id="popup<?php echo $fdes->design_id; ?>" >Comments</a>
                                       <?php } else { ?>  	<?php echo count($prvcomments); ?> &nbsp;<span>Comments</span>
                                       <?php } ?>
                                    </div>
                                 </div>
                              </div>
                              <?php if($user_id != $fdes->client_id){ 
                                 $bv=$fdes->design_id;
                                 $us=$this->Common_model->get_records_count('design_likes',array('user_id'=>$user_id,'design_id'=>$bv));
                                 echo $us;
                                 echo "this is your result";
                                 
                                 ?>
                              <div id="demo" style="float:right;">
                                 <div class="wrapper">
                                    <?php if(($fdes->designer_id != $user_id) && ($single_contest[0]->status == "completed")){
                                       ?>
                                    <div class="content">
                                       <ul>
                                          <?php	if($usertype!=0)
                                             { ?>
                                          <a data-modal-id="spopup<?php echo $fdes->design_id; ?>" class="rep">
                                             <li><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report</li>
                                          </a>
                                          <?php	} ?>
                                          <button class="like_design" data-id="<?php echo $fdes->design_id;?>"  <?php if($us!=0){ ?> disabled <?php }?>
                                             >
                                             <li class="sa"><i class="fa fa-heart" aria-hidden="true"></i> Like(<span class="lcount" > <?php echo $us ?> </span>)</li>
                                          </button>
                                       </ul>
                                    </div>
                                    <div class="parent"><img src="<?php echo base_url(); ?>assets/images/like-im.png"></div>
                                    <?php 
                                       } ?>
                                 </div>
                              </div>
                              <?php } ?>
                           </div>
                        </div>
                        <div id="spopup<?php echo $fdes->design_id;?>" class="modal-box">
                           <header>
                              <a class="js-modal-close close" style="top: 1% !important;">×</a>
                              <h3>Report Logo Design Violation</h3>
                           </header>
                           <form class="form-horizontal fname" action="<?php echo base_url();?>contest/report_contest" name="design_upload" method="post" enctype="multipart/form-data">
                              <div class="modal-body">
                                 <div class="report_option">
                                    <label>I want to report:</label>    
                                    <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                                    <input type="hidden" name="clientid" value="<?php echo $fdes->designer_id; ?>" />
                                    <input type="hidden" name="designerid" value="<?php echo $user_id;?>"/>
                                    <input type="hidden" name="designid" value="<?php echo $fdes->design_id;?>"/> 
                                    <div class="radio">
                                       <label class="report1"><input type="radio" class="radiooption" id="rdo1_a" name="report_type" value="0">Someone copied my logo design.</label>
                                    </div>
                                    <div class="radio">
                                       <label class="report2"><input type="radio" class="radiooption" id="rdo1_a" name="report_type" value="1">Use of copyrighted images</label>
                                    </div>
                                 </div>
                                 <div class="report_form">
                                    <p>Note: Please file a report only when your designs being copied.</p>
                                    <div class="form-group">
                                       <label class="control-label col-sm-2">Your Design (#):</label>
                                       <div class="col-sm-6">
                                          <input type="text" class="form-control userdesign_id"  name="userdesign" required>
                                          <div class="help-block check22"></div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-sm-2">Design(#) that copying yours:</label>
                                       <div class="col-sm-6"> 
                                          <input type="text" class="form-control"   name="copydesign" value="<?php echo $fdes->design_no; ?>" readonly>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-sm-2" for="pwd">Your Message To Moderator:</label>
                                       <div class="col-sm-6"> 
                                          <textarea class="form-control" placeholder="Enter password" name="msg" required></textarea>
                                       </div>
                                    </div>
                                    <input type="hidden" value="<?php echo base64_encode($current_page);?>" name="rpage">
                                    <input type="hidden" value="<?php 	echo $single_contest[0]->id;?>" name="contest_id">	
                                 </div>
                              </div>
                              <footer> 
                                 <a class="btn btn-small back">Back</a> 
                                 <a class="btn btn-small js-modal-close close2">Close</a>
                                 <input type="submit" class="btn btn-small myBtn2" value="Report" /> 
                              </footer>
                           </form>
                        </div>
                        <?php }?>
                     </div>
                     <?php }  */?>
                     <br><br>
                     <div class="row" style="background-color:#f4f2ed; padding:10px;">
                        <div class="col-md-6 col-lg-6">
                           <div class="submit-design">ENTERIES FROM QUALIFYING STAGE</div>
                        </div>
                        <div class="col-md-3 col-lg-3"></div>
                        <div class="col-md-3 col-lg-3">
                           <div class="design-rate">
                              <!--<select size="1" class="s_rane">
                                 <option>Rank</option>
                                 <option>Star Rating</option>
                                 <option>Posted Rating</option>
                                 </select>-->
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <?php 
                           $dno=0;
                           if(isset($finaldesigns) && !empty($finaldesigns)){
                           ?>				
                        <?php 
                           foreach($finaldesigns as $fdes) {
                           	
                           	$dno++;
                           	$prvcomments = design_comment($fdes->design_id);
                           	
                           	
                           //		echo $fdes->design_id;
                           ?>
                        <div class="col-md-4 col-lg-4">
                           <div class="logo_design_model">
                              <div class="logo_d_name">
                                 # <?php echo $fdes->design_no;//$fdes->design_id;?> by <?php echo $sign[$fdes->designer_id];?>
                              </div>
                              <div class="logo_image">
                                 <?php  if( ($single_contest[0]->status != "completed") && ($user_id != $fdes->client_id) && ($user_id != $fdes->designer_id) ) { ?>
                                 <img class="imagesize" style="width:300px!important;"  src="<?php echo base_url(); ?>assets/image/hidden.jpg"  />
                                 <?php } else{ ?>
                                 <img class="imagesize" style="width:300px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $fdes->design_name;?>"  />
                                 <?php } 
								 if($ctfinaldes ==2)
								 { ?>
                                 <span class="logo-status">
                                 <i class="logo-rank"><?php echo $dno.suffix($dno);?></i>
                                 </span>
								 <?php } ?>
                              </div>
                              <div class="user_review">
                                 <div class="col-sm-8 col-xs-12">
                                    <div class="star-rating">
                                       <input for="<?php echo $fdes->design_id; ?>" id="input-21b"  <?php 
                                          if($user_id != $fdes->client_id){ echo 'readonly'; } ?> value="<?php echo $fdes->design_rating; ?>" type="number" class="rating checkrate" min=0 max=5 step=1 data-size="md">
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-xs-12">
                                    <div class="commend">										
                                       <?php 
                                          if(($user_id == $fdes->client_id) || (($user_id == $fdes->designer_id) && (count($prvcomments) > 0))){
                                          ?>
                                       <?php echo count($prvcomments); ?> &nbsp;<a  data-modal-id="popup<?php echo $fdes->design_id; ?>" >Comments</a>
                                       <?php } else { ?>  	<?php echo count($prvcomments); ?> &nbsp;<span>Comments</span>
                                       <?php } ?>
                                    </div>
                                 </div>
                                 <?php
                                     if($ctfinaldes ==2 && $usertype == 0 && $user_id == $fdes->client_id && $win_design !=	1 && $single_contest[0]->status == "judging")
                                    		{ ?>
                                 <div class="col-sm-12 col-xs-12">
                                    <div class="col-md-6" >
                                       <a  for='<?php echo $fdes->design_id;  ?>'  data-modal-id="apopup<?php echo $fdes->design_id; ?>"  class="choose_winner" >Choose Winner</a>
                                    </div>
                                 </div>
                                 <?php }
                                    ?>
                              </div>
                              <?php if($user_id != $fdes->client_id){ 
                                 $bv=$fdes->design_id;
                                 $us=$this->Common_model->get_records_count('design_likes',array('user_id'=>$user_id,'design_id'=>$bv));
                                 
                                 
                                 ?>
                              <div id="demo" style="float:right;">
                                 <div class="wrapper">
                                    <?php if(($fdes->designer_id != $user_id) && ($single_contest[0]->status == "completed")){
                                       ?>
                                    <div class="content">
                                       <ul>
                                          <?php	if($usertype!=0)
                                             { ?>
                                          <a data-modal-id="spopup<?php echo $fdes->design_id; ?>" class="rep">
                                             <li><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report</li>
                                          </a>
                                          <?php	} ?>
                                          
                                             <li class="sa"><a href="#" class="like_design" data-id="<?php echo $fdes->design_id;?>"  <?php if($us!=0){ ?> disabled <?php }?>
                                             ><i class="fa fa-heart" aria-hidden="true"></i> Like(<span class="lcount" > <?php echo $us ?> </span>)</a></li>
                                          
                                       </ul>
                                    </div>
                                    <div class="parent"><img src="<?php echo base_url(); ?>assets/images/like-im.png"></div>
                                    <?php 
                                       } ?>
                                 </div>
                              </div>
                              <?php } ?>
                           </div>
                        </div>
                        <div id="spopup<?php echo $fdes->design_id;?>" class="modal-box">
                           <header>
                              <a class="js-modal-close close" style="top: 1% !important;">×</a>
                              <h3>Report Logo Design Violation</h3>
                           </header>
                           <form class="form-horizontal fname" action="<?php echo base_url();?>contest/report_contest" name="design_upload" method="post" enctype="multipart/form-data">
                              <div class="modal-body">
                                 <div class="report_option">
                                    <label>I want to report:</label>    
                                    <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                                    <input type="hidden" name="clientid" value="<?php echo $fdes->designer_id; ?>" />
                                    <input type="hidden" name="designerid" value="<?php echo $user_id;?>"/>
                                    <input type="hidden" name="designid" value="<?php echo $fdes->design_id;?>"/> 
                                    <div class="radio">
                                       <label class="report1"><input type="radio" class="radiooption" id="rdo1_a" name="report_type" value="0">Someone copied my logo design.</label>
                                    </div>
                                    <div class="radio">
                                       <label class="report2"><input type="radio" class="radiooption" id="rdo1_a" name="report_type" value="1">Use of copyrighted images</label>
                                    </div>
                                 </div>
                                 <div class="report_form">
                                    <p>Note: Please file a report only when your designs being copied.</p>
                                    <div class="form-group">
                                       <label class="control-label col-sm-2">Your Design (#):</label>
                                       <div class="col-sm-6">
                                          <input type="text" class="form-control userdesign_id"  name="userdesign" required>
                                          <div class="help-block check22"></div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-sm-2">Design(#) that copying yours:</label>
                                       <div class="col-sm-6"> 
                                          <input type="text" class="form-control"   name="copydesign" value="<?php echo $fdes->design_no; ?>" readonly>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-sm-2" for="pwd">Your Message To Moderator:</label>
                                       <div class="col-sm-6"> 
                                          <textarea class="form-control" placeholder="Enter password" name="msg" required></textarea>
                                       </div>
                                    </div>
                                    <input type="hidden" value="<?php echo base64_encode($current_page);?>" name="rpage">
                                    <input type="hidden" value="<?php 	echo $single_contest[0]->id;?>" name="contest_id">	
                                 </div>
                              </div>
                              <footer> 
                                 <a class="btn btn-small back">Back</a> 
                                 <a class="btn btn-small js-modal-close close2">Close</a>
                                 <input type="submit" class="btn btn-small myBtn2" value="Report" /> 
                              </footer>
                           </form>
                        </div>
                        <div id="apopup<?php echo $fdes->design_id; ?>" class="modal-box">
                           <header>
                              <a class="js-modal-close close" style="top: 1% !important;">×</a>
                              <h3>Choose Winner</h3>
                           </header>
                           <form action="<?php echo base_url();?>contest/winn_contest" name="design_upload" method="post" enctype="multipart/form-data">
                              <div class="modal-body">
                                 <label>Do You Want Choose As A Winner ?</label>    
                                 <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                                 <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                                 <input type="hidden" name="designid" value="<?php echo $fdes->design_id; ?>" />
                                 <input type="hidden" name="designer_id" value="<?php echo $fdes->designer_id; ?>" />
                                 </br> 
                                 <div class="row" style="margin-top:20px;">
                                    <div class="col-md-6"><img class="imagesize" style="width:300px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $fdes->design_name;?>"  /></div>
                                 </div>
                              </div>
                              <footer> <a class="btn btn-small js-modal-close">Close</a> <input type="submit" class="btn btn-small" value="Winner" /> </footer>
                           </form>
                        </div>
                        <?php }?>
                        <?php }  
                           if(!empty($designs))
                           {
							   foreach($designs as $rating)
							   {
								   $design_rating=$rating->design_rating;
								   if($design_rating !=0)
								   {
									   $rating_count=$design_rating;
									   break;
								   }
								   else{
									   $rating_count=0;
									}
								   
							   }
                           foreach($designs as $des) {
                           $dno++;
                           $prvcomments = design_comment($des->design_id);											
                           ?>
                        <div class="col-md-4 col-lg-4">
                           <div class="logo_design_model">
                              <div class="logo_d_name">
                                 <?php if($user_id == $des->client_id){ ?>	
                                 <!--<select name='desrank' class='setrank' for="<?php echo $des->design_id; ?>" >
                                    <option value='0'>Rank</option>
                                    <?php 
                                       for($i=1; $i<=10; $i++)
                                       {	
                                       	if(isset($des->design_rank) && !empty($des->design_rank) &&($des->design_rank == $i))
                                       		echo "<option selected='selected' value='".$i."'>".$i."</option>";						
                                       	else
                                       		echo "<option value='".$i."'>".$i."</option>";						
                                       
                                       }
                                       ?></select>-->
                                 <?php } else if(isset($des->design_rank) && !empty($des->design_rank))
                                    { echo 'Rank-'.$des->design_rank; } ?> 
                                 # <?php echo $des->design_no;?> by <a href="#"> <?php echo $sign[$des->designer_id];?></a>
                              </div>
                              <div class="logo_image">
                                 <?php  if( ($single_contest[0]->status != "completed") && ($user_id != $des->client_id) && ($user_id != $des->designer_id) ) { ?>
                                 <img class="imagesize" style="width:300px!important;"  src="<?php echo base_url(); ?>assets/image/hidden.jpg"  />
                                 <?php } else{ ?>
                                 <img class="imagesize" style="width:300px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  />
                                 <?php } 
								 if($rating_count !=0)
								 { ?>
                                 <span class="logo-status-grey">
                                 <i class="logo-rank"><?php echo $dno.suffix($dno);?></i>
                                 </span>
							<?php	 } ?>
                              </div>
                              <div class="user_review row">
                                 <div class="col-sm-8 col-xs-12">
                                    <div class="star-rating">
                                       <input for="<?php echo $des->design_id; ?>" id="input-21b"  <?php 
                                          if($user_id != $des->client_id){ echo 'readonly'; } ?> value="<?php echo $des->design_rating; ?>" type="number" class="rating checkrate" min=0 max=5 step=1 data-size="md">
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-xs-12">
                                    <div class="commend">										
                                       <?php 
                                          if(($user_id == $des->client_id) || (($user_id == $des->designer_id) && (count($prvcomments) > 0))){
                                          ?>
                                       <?php echo count($prvcomments); ?> &nbsp;<a  data-modal-id="popup<?php echo $des->design_id; ?>" >Comments</a>
                                       <?php } else { ?>  	<?php echo "(".count($prvcomments).")"; ?> <span>Comments</span>
                                       <?php } ?>
                                    </div>
                                 </div>
                                 <?php if($user_id == $des->client_id && $single_contest[0]->status == "judging"){ ?>
                                 <div class="col-sm-48 col-xs-12">
                                    <!--
                                       <div class="col-md-6" >	<a  for='<?php echo $des->design_id;  ?>'  data-modal-id="apopup<?php echo $des->design_id; ?>" >Choose Winner</a>
                                       </div>	
                                       -->
                                    <div class="col-md-6" >
                                       <?php 								 
                                          $lcount=$this->Common_model->get_records_count('designs',array('final_status'=>1,'contest_id'=>$des->contest_id,'designer_id'=>$des->designer_id));
                                          
                                          	 if(isset($ctfinaldes) && ($ctfinaldes < 2) && ($lcount==0) ){ ?>
                                       <a for='<?php echo $des->design_id;  ?>'  data-modal-id="bpopup<?php echo $des->design_id; ?>" >Choose Finalist</a>
                                       <?php }
                                          else if($ctfinaldes==2)
                                          { ?>
                                       <a  for='<?php echo $des->design_id;  ?>'  data-modal-id="apopup<?php echo $des->design_id; ?>"   class="choose_winner" >Choose Winner</a>
                                       <?php } ?>
                                    </div>
                                 </div>
                                 <?php }  ?>	
                              </div>
                              <?php 	
                                 $ds=$des->design_id;
                                 $ls=$this->Common_model->get_records_count('design_likes',array('user_id'=>$user_id,'design_id'=>$ds));
                                 		?>
                              <?php if($user_id != $des->client_id){ ?>
                              <div id="demo" style="float:right;">
                                 <div class="wrapper">
                                    <?php if(($des->designer_id != $user_id) && ($single_contest[0]->status == "completed")){?>
                                    <div class="content">
                                       <ul>
                                          <?php	if($usertype!=0)
                                             {    ?>
                                          <a data-modal-id="rpopup<?php echo $des->design_id; ?>" class="rep">
                                             <li><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report</li>
                                          </a>
                                          <?php	}	?>
                                          
                                             <li><a href="#" class="like_design" data-id="<?php echo $des->design_id;?>" <?php if($ls!=0){ ?> disabled <?php }?>
                                             ><i class="fa fa-heart" aria-hidden="true"></i> Likess(<span class="lcount"><?php echo $ls ?> </span>) </a></li>
                                         
                                       </ul>
                                    </div>
                                    <div class="parent"><img src="<?php echo base_url(); ?>assets/images/like-im.png"></div>
                                    <?php 
                                       } 
                                       elseif(($des->designer_id == $user_id) && ($single_contest[0]->status != "completed")){?>
                                    <div class="content">
                                       <ul>
                                          <a for='<?php echo $des->design_id;  ?>'  data-modal-id="withdraw_pop<?php echo $des->design_id; ?>" >
                                             <li><i class="fa fa-download" aria-hidden="true"></i> Withdraw</li>
                                          </a>
                                       </ul>
                                    </div>
                                    <div class="parent"><img src="<?php echo base_url(); ?>assets/images/like-im.png"></div>
                                    <?php } ?>
                                 </div>
                              </div>
                              <?php } ?>
                           </div>
                        </div>
                        <!---------------POP BOX--------------->
                        <div id="rpopup<?php echo $des->design_id; ?>" class="modal-box">
                           <header>
                              <a class="js-modal-close close" style="top: 1% !important;">×</a>
                              <h3>Report Logo Design Violation</h3>
                           </header>
                           <form class="form-horizontal fname" action="<?php echo base_url();?>contest/report_contest" name="design_upload" method="post" enctype="multipart/form-data">
                              <div class="modal-body">
                                 <div class="report_option">
                                    <label>I want to report:</label>    
                                    <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                                    <input type="hidden" name="clientid" value="<?php echo $des->designer_id; ?>" />
                                    <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                                    <input type="hidden" name="designerid" value="<?php echo $user_id;?>"/>
                                    <div class="radio">
                                       <label class="report1"><input type="radio" class="radiooption" id="rdo1_a" name="report_type" value="copy" >Someone copied my logo design.</label>
                                    </div>
                                    <div class="radio">
                                       <label class="report2"><input type="radio" class="radiooption" id="rdo1_a" name="report_type" value="copyright">Use of copyrighted images</label>
                                    </div>
                                 </div>
                                 <div class="report_form">
                                    <p>Note: Please file a report only when your designs being copied.</p>
                                    <div class="form-group">
                                       <label class="control-label col-sm-2" for="email">Your Design (#):</label>
                                       <div class="col-sm-6">
                                          <input type="text" class="form-control userdesign_id"  name="userdesign" required>
                                          <div class="help-block check22"></div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-sm-2" for="pwd">Design(#) that copying yours:</label>
                                       <div class="col-sm-6"> 
                                          <input type="text" class="form-control" id="pwd" name="copydesign" value="<?php echo $des->design_no; ?>" readonly>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-sm-2" for="pwd">Your Message To Moderator:</label>
                                       <div class="col-sm-6"> 
                                          <textarea class="form-control" placeholder="Enter password" name="msg" required></textarea>
                                       </div>
                                    </div>
                                    <input type="hidden" value="<?php echo base64_encode($current_page);?>" name="rpage">
                                    <input type="hidden" value="<?php echo $single_contest[0]->id;?>" name="contest_id">	
                                 </div>
                              </div>
                              <footer> 
                                 <a class="btn btn-small back">Back</a> 
                                 <a class="btn btn-small js-modal-close close2">Close</a>
                                 <input type="submit" class="btn btn-small myBtn2" value="Report" /> 
                              </footer>
                           </form>
                        </div>
                        <div id="bpopup<?php echo $des->design_id; ?>" class="modal-box">
                           <header>
                              <a class="js-modal-close close" style="top: 1% !important;">×</a>
                              <h3>Choose A Finalist</h3>
                           </header>
                           <form action="<?php echo base_url();?>contest/final_contest" name="design_upload" method="post" enctype="multipart/form-data">
                              <div class="modal-body">
                                 <label>Do You Want Choose As A Finalist ?</label>    
                                 <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                                 <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                                 <input type="hidden" name="designer_id" value="<?php echo $des->designer_id; ?>" />
                                 <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                                 </br> 
                                 <div class="row" style="margin-top:20px;">
                                    <div class="col-md-6"><img class="imagesize" style="width:300px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  /></div>
                                 </div>
                              </div>
                              <footer> <a class="btn btn-small js-modal-close">Close</a> <input type="submit" class="btn btn-small" value="Finalist" /> </footer>
                           </form>
                        </div>
                        <div id="apopup<?php echo $des->design_id; ?>" class="modal-box">
                           <header>
                              <a class="js-modal-close close" style="top: 1% !important;">×</a>
                              <h3>Choose Winner</h3>
                           </header>
                           <form action="<?php echo base_url();?>contest/winn_contest" name="design_upload" method="post" enctype="multipart/form-data">
                              <div class="modal-body">
                                 <label>Do You Want Choose As A Winner ?</label>    
                                 <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                                 <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                                 <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                                 <input type="hidden" name="designer_id" value="<?php echo $des->designer_id; ?>" />
                                 </br>
                                 <div class="row" style="margin-top:20px;">
                                    <div class="col-md-6"><img class="imagesize" style="width:300px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  /></div>
                                 </div>
                              </div>
                              <footer> <a class="btn btn-small js-modal-close">Close</a> <input type="submit" class="btn btn-small" value="Winner" /> </footer>
                           </form>
                        </div>
                        <div id="withdraw_pop<?php echo $des->design_id; ?>" class="modal-box">
                           <header>
                              <a class="js-modal-close close" style="top: 1% !important;">×</a>
                              <h3>Withdraw A Design</h3>
                           </header>
                           <form action="<?php echo base_url();?>contest/withdraw_design" name="design_upload" method="post">
                              <div class="modal-body">
                                 <label>Do You Want to Withdraw the Design?</label>    
                                 <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                                 <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                                 <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                                 </br>                       
                              </div>
                              <footer> <a class="btn btn-small js-modal-close">Cancel</a> 
                                 <input type="submit" class="btn btn-small" value="Yes, Do It" /> 
                              </footer>
                           </form>
                        </div>
                        <div id="popup<?php echo $des->design_id; ?>" class="modal-box">
                           <header>
                              <a class="js-modal-close close" style="top: 1% !important;">×</a>
                              <h3>Comments</h3>
                           </header>
                           <div class="modal-body">
                              <div class="logo_image"><img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  /></div>
                              <?php
                                 foreach($prvcomments as $tmp2)
                                 {
                                 ?>
                              <div class="row">
                                 <div class="col-md-6 col-lg-6">
                                    <div class="messanger-name"><b><?php echo $tmp2->createdname; ?></b> <?php  if($tmp2->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                                 </div>
                                 <div class="message-timming"><?php echo date("d-m-Y H:i ",strtotime($tmp2->createddate)); ?></div>
                              </div>
                              <div class="row">
                                 <div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp2->comment;?></div>
                              </div>
                              <div class="ro" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                              </div>
                              <?php }  ?>
                              <form action="<?php echo base_url();?>contest/contest_privcomment" name="design_upload" method="post" enctype="multipart/form-data">
                                 <textarea rows="5" cols="20" class="msg_box" style="width: 723px; height: 106px;" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                                 <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                                 <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                                 <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                                 <input type="hidden" name="designerid" value="<?php echo $des->designer_id; ?>" />
                                 </br>
                                 <input type="submit" class="precomm" value="Add Comment" />
                              </form>
                           </div>
                           <footer> <a  class="btn btn-small js-modal-close">Close</a> </footer>
                        </div>
                        <div id="popup<?php echo $des->design_id; ?>" class="modal-box">
                           <header>
                              <a  class="js-modal-close close" style="top: 1% !important;">×</a>
                              <h3>Comments</h3>
                           </header>
                           <div class="modal-body">
                              <div class="logo_image"><img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  /></div>
                              <?php
                                 if(isset($prvcomments) && !empty($prvcomments)) { 
                                 	foreach($prvcomments as $tmp2)
                                 	{
                                 ?>
                              <div class="row">
                                 <div class="col-md-6 col-lg-6">
                                    <div class="messanger-name"><b><?php echo $tmp2->createdname; ?></b> <?php  if($tmp2->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                                 </div>
                                 <div class="message-timming"><?php echo date("d-m-Y H:i ",strtotime($tmp2->createddate)); ?></div>
                              </div>
                              <div class="row">
                                 <div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp2->comment;?></div>
                              </div>
                              <div class="ro" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                              </div>
                              <?php } } ?>
                              <form action="<?php echo base_url();?>contest/contest_privcomment" name="design_upload" method="post" enctype="multipart/form-data">
                                 <textarea rows="5" cols="20" class="msg_box" style="width: 723px; height: 106px;" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                                 <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                                 <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                                 <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                                 <input type="hidden" name="designerid" value="<?php echo $des->designer_id; ?>" />
                                 </br>
                                 <input type="submit" class="precomm" value="Add Comment" />
                              </form>
                           </div>
                           <footer> <a  class="btn btn-small js-modal-close">Close</a> </footer>
                        </div>
                        <!------------------------------------->
                        <?php }
                           }								
                           		else if(empty($designs) && $ctfinaldes==0)
                           		{	
                           			echo "<center><h4 style='color:red'>No design<h4>";
                           			
                           		}
                           			?>
                     </div>
                  </li>
                  <li>
                     <div> DISCUSSIONS</div>
                     <?php
                        $user_id = $this->session->userdata('user_id');
                        ?>
                     <div class="contain" style="background-color:#f4f2ed; margin-top:15px;">
                        <div class="row">
                           <div class="col-md-4 col-lg-4">
                              <div class="contest-head">
                                 <h4>Public Discussion Board</h4>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="contain" style="border:1px solid rgba(0,0,0,0.1);">
                        <?php 
                           if(isset($allcomments) && !empty($allcomments)) { 
                           	foreach($allcomments as $tmp1){
                           ?>
                        <div class="row">
                           <div class="col-md-6 col-lg-6">
                              <div class="messanger-name"><b><?php echo $tmp1->createdname; ?></b> <?php  if($tmp1->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                           </div>
                           <div class="message-timming"><?php echo date("d-m-Y H:i ",strtotime($tmp1->createddate)); ?></div>
                        </div>
                        <div class="row">
                           <?php if(!empty($tmp1->attachment)){?>
                           <div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12">
                              <img src="<?php echo base_url()."uploads/brief/".$tmp1->attachment;?>">
                           </div>
                           <?php } ?>
                           <div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp1->comment;?></div>
                        </div>
                        <div class="ro" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                        </div>
                        <?php } } ?>                            
                        <div class="row" style="padding:20px;">
                           <div class="col-md-12 col-lg-12">
                              <form action="<?php echo base_url();?>Contest/contest_comment" method="post" onsubmit="#" enctype="multipart/form-data">
                                 <input type="hidden" value="<?php echo $contestid; ?>" id='contestid' name='contestid' />
                                 <table width="100%" cellpadding="5">
                                    <?php if($user_id == $single_contest[0]->client_id){ ?>
                                    <tr>
                                       <td><input type="file" name="comment_file" required style="padding-left:20px; margin-bottom:30px;" ></td>
                                    </tr>
                                    <?php } ?>										
                                    <tr>
                                       <td>
                                          <textarea rows="10" cols="20" class="msg_box" id="msg_box" name="msg_box" required ></textarea>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <input type="submit" value="Add Comment" class="comment-btn" id="comment-btn" />
                                       </td>
                                    </tr>
                                 </table>
                              </form>
							<?php  if(isset($des->design_id))
							  { ?>
                              <div id="popup<?php echo $des->design_id; ?>" class="modal-box">
                                 <header>
                                    <a  class="js-modal-close close" style="top: 1% !important;">×</a>
                                    <h3>Comments</h3>
                                 </header>
                                 <div class="modal-body">
                                    <form action="<?php echo base_url();?>contest/contest_privcomment" name="design_upload" method="post" enctype="multipart/form-data">
                                       <textarea rows="5" cols="20" class="msg_box" style="width: 723px; height: 106px;" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                                       <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                                       <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                                       <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                                       <input type="hidden" name="designerid" value="<?php echo $des->designer_id; ?>" />
                                       </br>
                                       <input type="submit" class="precomm" value="Add Comment" />
                                    </form>
                                 </div>
                                 <footer> <a  class="btn btn-small js-modal-close">Close</a> </footer>
                              </div>
							 <?php } ?>
                           </div>
                        </div>
                     </div>
                  </li>
                  <?php if(($single_contest[0]->status =='completed') &&(($user_id==$winningcontest->designer_id)||($user_id==$winningcontest->client_id))){?>
                  <li>
                     <div> DESIGN PACKAGE</div>
                     <?php
                        $user_id = $this->session->userdata('user_id');
                        $payreq_date=$single_contest[0]->payment_reqtime;
                        $req_diff = $single_contest[0]->req_gap;
                        $release_diff=$single_contest[0]->release_gap;
                        
                        
                        if(isset($winningcontest) && !empty($winningcontest))
                        { 
                        ?>
                     <div class="row" style="background-color:#f4f2ed; padding:10px;">
                        <div class="col-md-6 col-lg-6">
                           <div class="submit-design">DESIGN PACKAGE </div>
                        </div>
                     </div>
                     <?php if($user_id==$winningcontest->client_id){?>
                     <div class="row">
                        <div class="col-md-8 col-lg-8">
                           <h3>Your design package : (<?php echo ucwords($single_contest[0]->contest_type);?>)</h3>
                        </div>
                        <div class="col-md-4 col-lg-4">
                           <?php if($single_contest[0]->package_status==1):?>	
                           <a href="<?php echo base_url()?>uploads/package_uploads/<?php echo $single_contest[0]->package_path?>" class=" downloadPackage download_pack">DOWNLOAD PACKAGE</a>
                           <?php elseif($single_contest[0]->package_status==2):?>	
                           <a href="<?php echo base_url()?>contest/confirmpackage/<?php echo $single_contest[0]->id?>" class="download_pack">CONFIRM PACKAGE</a>
                           <?php endif;?>								
                        </div>
                        <div class="col-md-12 col-lg-12">
                           <div class="download_content">
                              <?php if($single_contest[0]->package_status==0):?>
                              <p>Dear Client,</p>
                              <p><b><?php echo ucwords(username($winningcontest->designer_id));?> </b>has not uploaded the package till. Please wait for some time.</p>
                              <?php elseif($single_contest[0]->package_status>=1):?>
                              <p>Dear Client,</p>
                              <p><b><?php echo ucwords(username($winningcontest->designer_id));?> </b>has uploaded the package for the winning design, kindly download it , check and if any queries send a message to the designer . If everything is correct please CONFIRM the package .</p>
                              <?php endif;?>
                           </div>
                        </div>
                        <?php if(($single_contest[0]->package_status==2) && ($req_diff>=2)):?>	
                        <div class="col-md-12 col-lg-12">
                           <div class="download_content">
                              <p>Dear Client,</p>
                              <p>Kindly let us know if the project is completed or not or else the payment will be released to the winning designer.</p>
                           </div>
                        </div>
                        <?php endif;
                           ?>
                        <div class="lastmsg">
                           <?php 
                              $ms1=$this->Common_model->get_records_order_by('message_table','',array('contest_id'=>$winningcontest->contest_id),'created_time');
                              
                                        foreach($ms1 as $msg2)
                              	 {
                              		 $messner=$this->Common_model->get_record('user_table','',array('user_id'=>$msg2->from_id))
                              		?>
                           <div class="col-md-12 col-lg-12">
                              <div class="download_content">
                                 <p><?php echo $messner->user_name;?>:</p>
                                 <p class="usersmsg"><?php echo $msg2->subject;?></p>
                              </div>
                           </div>
                           <?php  }	?>
                        </div>
                        <div class="col-md-12 col-lg-12">
                           <div class="download_msgbox">
                              <input type="hidden" class="check_condition" name="contest_id" value="">
                              <textarea rows="3" cols="60"  class="msg_box1 txtarea" name="winner_message" placeholder="Send your message to the designer" ></textarea>
                              <input type="submit" value="Send" class="comment-btn1 submit2" id="comment-btn1" />
                           </div>
                        </div>
                     </div>
                     <?php } 
					 else if($user_id==$winningcontest->designer_id){?>
                     <div class="row">
                        <?php if($single_contest[0]->package_status ==0){?>
                        <div class="col-md-8 col-lg-8">
                           <h3>Your design package : (<?php echo $single_contest[0]->contest_type;?>)</h3>
                        </div>
                        <div class="col-md-4 col-lg-4">
                           <a  data-modal-id="depack_pop" class="uploadFile start-now">Upload Package</a>
                           <div id="depack_pop" class="modal-box">
                              <header>
                                 <a  class="js-modal-close close" style="top: 1% !important;">×</a>
                                 <h3>Desgin Package</h3>
                              </header>
                              <div class="modal-body">
                                 <form action="<?php echo base_url()?>contest/upload_package" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="contest_id" value="<?php echo $single_contest[0]->id;?>">
                                    <div class="fileUpload">
                                       <span class="uploadFile">Upload</span>
                                       <input type="file" name="upload_package" class="uploadBtn upload" />
                                    </div>
                                    <input type="submit" value="Send" class="comment-btn1" id="comment-btn1"/>
                                 </form>
                              </div>
                              <footer> <a  class="btn btn-small js-modal-close">Close</a> </footer>
                           </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                           <div class="download_content">
                              <p>Dear <b><?php echo ucwords(username($winningcontest->designer_id));?></b>,</p>
                              <p>Please upload the packge for <b>Wining Design</b>.</p>
                           </div>
                        </div>
						<div class="lastmsg">
                           <?php 
                              $ms4=$this->Common_model->get_records_order_by('message_table','',array('contest_id'=>$winningcontest->contest_id),'created_time');
                                        foreach($ms4 as $msg5)
                               {
                              	 $messner=$this->Common_model->get_record('user_table','',array('user_id'=>$msg5->from_id))
                              	?>
                           <div class="col-md-12 col-lg-12">
                              <div class="download_content">
                                 <p><?php echo $messner->user_name;?>:</p>
                                 <p class="usersmsg"><?php echo $msg5->subject;?></p>
                              </div>
                           </div>
                           <?php  }?>
                        </div>
                        <?php 
                           } 
                           else{
                           	
                           ?>
                        <div class="col-md-8 col-lg-8">
                           <h3>Your design package : (<?php echo $single_contest[0]->contest_type;?>)</h3>
                        </div>
                        <div class="col-md-4 col-lg-4">
                           <?php if(($single_contest[0]->package_status==2) && $payreq_date=="0000-00-00 00:00:00"):?>	
                           <a href="<?php echo base_url()?>contest/requestpayment/<?php echo $single_contest[0]->id?>" class="download_pack">REQUEST PAYMENT</a>
                           <?php elseif(($single_contest[0]->package_status==2)&&($req_diff>=2) && $release_diff ==0):
                              ?>	
                           <a href="<?php echo '#'/*echo base_url()?>contest/releasepayment/<?php echo $single_contest[0]->id*/?>" class="download_grey">RELEASE PAYMENT</a>	
                           <?php elseif($single_contest[0]->package_status==3 && $single_contest[0]->payment_release_reqtime=="0000-00-00 00:00:00"):
                              ?>	
                           <a href="<?php echo '#'/*base_url()?>contest/releasepayment/<?php echo $single_contest[0]->id */?>" class="download_grey">RELEASE PAYMENT</a>			
                           <?php elseif(($single_contest[0]->package_status>=2) && $single_contest[0]->payment_release_reqtime !="0000-00-00 00:00:00" && ($release_diff<1)):
                              ?>	
                           <span class="download_grey">RELEASE PAYMENT</span>	
                           <?php elseif(($single_contest[0]->package_status==3) || (($single_contest[0]->package_status==2) && ($release_diff>=1))):?>	
                           <span class="download_pack">RELEASE PAYMENT</span>
                           <?php	
                              endif;
                              ?>								
                        </div>
                        <div class="col-md-12 col-lg-12">
                           <div class="download_content">
                              <?php if($single_contest[0]->package_status==0):?>
                              <p>Dear Client,</p>
                              <p><b><?php echo ucwords(username($winningcontest->designer_id));?> </b>has not uploaded the package till. Please wait for some time.</p>
                              <?php elseif($single_contest[0]->package_status>=1):?>
                              <p>Dear Client,</p>
                              <p><b><?php echo ucwords(username($winningcontest->designer_id));?> </b>has uploaded the package for the winning design, kindly download it , check and if any queries send a message to the designer . If everything is correct please CONFIRM the package .</p>
                              <?php endif;?>
                           </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                           <div class="download_content text-center">
                              <?php if($single_contest[0]->package_status==1):?>	
                              <p>Client not downloaded the package yet.</p>
                              <?php else:?>
                              <p>Client has downloaded the package.</p>
                              <?php endif;?>
                           </div>
                        </div>
                        <?php if(($single_contest[0]->package_status==2) && ($req_diff>=2)):?>	
                        <div class="col-md-12 col-lg-12">
                           <div class="download_content">
                              <p>Dear Client,</p>
                              <p>Kindly let us know if the project is completed or not or else the payment will be released to the winning designer.</p>
                           </div>
                        </div>
                        <?php endif;?>
                        <?php if(($single_contest[0]->package_status==3) || (($single_contest[0]->package_status==2) && ($release_diff>=1))):?>	
                        <div class="col-md-12 col-lg-12">
                           <div class="download_content text-center">
                              <p>Payment Released.</p>
                           </div>
                        </div>
                        <?php endif;?>	
                        <div class="lastmsg">
                           <?php 
                              $ms4=$this->Common_model->get_records_order_by('message_table','',array('contest_id'=>$winningcontest->contest_id),'created_time');
                                        foreach($ms4 as $msg5)
                               {
                              	 $messner=$this->Common_model->get_record('user_table','',array('user_id'=>$msg5->from_id))
                              	?>
                           <div class="col-md-12 col-lg-12">
                              <div class="download_content">
                                 <p><?php echo $messner->user_name;?>:</p>
                                 <p class="usersmsg"><?php echo $msg5->subject;?></p>
                              </div>
                           </div>
                           <?php  }?>
                        </div>
						
                        <div class="col-md-12 col-lg-12">
                           <div class="download_msgbox">
						   
							<input type="hidden" class="check_condition" name="contest_id" value="4">
                              <textarea rows="3" cols="60" class="msg_box1 txtarea" name="msg_box" placeholder="Send your message to the designer" ></textarea>
                              <input type="submit" value="Send" class="comment-btn1 submit2" id="comment-btn1" />
                           </div>
                        </div>
                        <?php }?>
                     </div>
                     <?php }?>
                     <?php } ?>                        
                  </li>
                  <?php } ?>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="gap"></div>
<script>
   $(document).ready(function(){
   
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
           top: ($(window).height() - $(".modal-box").outerHeight()) / 16,
           left: ($(window).width() - $(".modal-box").outerWidth()) / 4
       });
   });
    
   $(window).resize();
    
   	$(document).on('change','.uploadBtn',function () {
   		var Name = $(this).val().split( '\\' ).pop();
   		var fileName= (Name!='')?Name:"UPLOAD";
   		$(".uploadFile").html(fileName);
   	});
   	
   	$(document).on('click','.downloadPackage',function() {   
   			$.ajax({ 
   			  url: "<?php echo base_url();?>contest/packagedownload",
   			  data:{
   				  contest_id:<?php echo $single_contest[0]->id;?>
   			  },
   			  type: "POST",
   			  success: function(data){
   				  if(data=='success'){
   					 window.location="<?php echo base_url();?>contest/particular_contest/<?php echo $single_contest[0]->id;?>"; 
   				  }
   			  }
   		  	}); 
       });
   });
   
</script> 
<script>
   $('.checkrate').on('rating.change', function() {
             var rateval = $(this).val();			
   	var desid = $(this).attr('for');
   	
   	
   	 $.ajax({ 
   	  url: "<?php echo base_url();?>Contest/design_rate",
   	  data:{
   		  designid:desid,
   		  rateval:rateval
   		  },
   	  type: "POST",
   	  success: function(data){
   		
   	  }
     	});			
         });
   
   $('.setrank').on('change', function() {
             var rankval = $(this).val();			
   	var desid = $(this).attr('for');
   	
    	 $.ajax({ 
   	  url: "<?php echo base_url();?>Contest/design_rank",
   	  data:{
   		  designid:desid,
   		  rankval:rankval
   		  },
   	  type: "POST",
   	  success: function(data){
   		
   	  }
     	}); 				
         });
   
   $(document).on('click','.like_design',function() {
   	var user_id=<?php echo (!empty($user_id))? $user_id:"''";?>;
   	var desid = $(this).attr('data-id');
   	var old =$(this).find('.lcount').html();
   	var target=$(this);
   				
   	if(user_id!=''){
   		$.ajax({ 
   		  url: "<?php echo base_url();?>contest/design_like",
   		  data:{
   			  designid:desid,
   			  user_id: user_id
   		  },
   		  type: "POST",
   		  success: function(data){
   			if(data!='')
   			{
   				var ne=parseInt(old)+1;
   				target.find('.lcount').html(ne);
   				$(this).attr('data-id');
   				target.attr('disabled','disabled');
   				
   			}
   		  } 
   		});	
   	}else{
   		alert("please login to like.");
   	}			
     });		
</script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/imagepreview/src/imagepreview.js"></script>
<script type="text/javascript">
   jQuery(function($) { 
       $('#preview1').imagepreview({
           input: '[name="for_upload"]',       
           preview: '#preview1'
       });
   });
   
   $(document).ready(function(){
        $(document).on('keyup','.userdesign_id',function(){
   		var email = $(this).val();
   		
   	if(email)
    {
   	var user_id=<?php echo (!empty($user_id))? $user_id:"''";?>;
     $.ajax({
     type: 'post',
     url: "<?php echo base_url();?>contest/design_verification",
     data: {
      design_id:email,
   	designer_id:user_id,
   	contest_id:<?php echo $single_contest[0]->id ?>
     },
     success: function (response) {
      if(response==1)	
      {
   	 $(".check22").html("<span style='color:#00FF00'>valid</span>");
   	$(function(){
     $("input.myBtn2").attr("disabled", false);
   });
   
   }
      else
      {
    $(".check22").html("<span style='color:#cc0000'>invalid designid:</span>");
   		$(function(){
     $("input.myBtn2").attr("disabled",true);
   });
   	
   	 }
     }
     });
    }
   		
       });
   });
</script> 
<script type="text/javascript">
   $("#design_upload").submit( function( e ) {
   	
    var form = this;
      e.preventDefault(); //Stop the submit for now
                                  //Replace with your selector to find the file input in your form
      var fileInput = $(this).find("input[type=file]")[0],
          file = fileInput.files && fileInput.files[0];
   
      if( file ) {
          var img = new Image();
   
          img.src = window.URL.createObjectURL( file );
   
          img.onload = function() {
              var width = img.naturalWidth,
                  height = img.naturalHeight;
   
              window.URL.revokeObjectURL( img.src );
   
              if( width <= 320 && height <= 250 ) {
                  form.submit();
              }
              else {
                  //fail
   			  alert("Uploaded image has valid Height and Width.");
   			return false;
              }
          };
      }
      else { //No file was input or browser doesn't support client side reading
          form.submit();
      }	
   });
</script>
<script>
   $(document).ready(function(){
   	
   	$(".report_form").hide();
   	
   	$(".rep").click(function(){
   		$(".report_form").hide();
   	});
   	
   	$(".radiooption").change(function(){
   		$(".report_form").show();
   		$(".report_option").hide();
   	});
   	$(".close2").click(function(){
   	 	$(".report_option").show();
   		$(".fname").find('input:radio').removeAttr('checked').removeAttr('selected');
   		$(".fname").trigger('reset');
   		$(".check22").html("<span></span>");
   		$("input.myBtn2").attr("disabled",false);
   	
   	});
   		
   	$(".back").click(function(){
   		$(".report_form").hide();
   		$(".fname").find('input:radio').removeAttr('checked').removeAttr('selected');
   		$(".fname").trigger('reset');
   		$(".check22").html("<span></span>");
   		$("input.myBtn2").attr("disabled",false);
   		$(".report_option").show();
   	});
   	
   });
   
   /* $(document).ready(function(){
   	$(document).on('click','.choose_winner',function(){
   		var pop_id=$(this).attr('data-modal-id');
   		var pop_img= $(this).prev('.logo_image');
   		
   	});
   }); */
   
</script>
<?php if(!empty($winningcontest)):?>
<script>
   $(document).ready(function() {
   			$(".submit2").click(function() {
                   var msg = $(".txtarea").val();
                   var values = $(".check_condition").val();
                   var usertypes = "<?php echo $usertype ?>";
                   if (values == "") {
   
                       var from1 = <?php echo $winningcontest->client_id; ?>;
                       var to = <?php echo $winningcontest->designer_id;?>;
                   } else {
   
                       var from1 = <?php echo $winningcontest->designer_id;?>;
                       var to = <?php echo $winningcontest->client_id; ?>;
                   }
                   $.ajax({
                       type: 'post',
                       url: "<?php echo base_url();?>contest/message",
                       data: {
                           from2: from1,
                           to1: to,
                           contest_id: <?php echo $winningcontest->contest_id;?>,
                           subject: msg
                       },
                       success: function(response) {
                           if (usertypes == 0) {
                               $(".lastmsg").append("<div class='col-md-12 col-lg-12'><div class='download_content'><p><?php echo $username;?></p><p>" + msg + "</p></div></div>");
   								$(".txtarea").val("");						
   						
   						} else {
                               $(".lastmsg").append("<div class='col-md-12 col-lg-12'><div class='download_content'><p><?php echo $username;?></p><p>" + msg + "</p></div></div>");
   							$(".txtarea").val("");
                           }
   						
                       }
                   });
               });
   });
   
</script>
<?php endif;?>