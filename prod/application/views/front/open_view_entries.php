<script type="text/javascript" src="<?php echo base_url();?>assets/js/jscolor.js"></script>
 
<div class="gap-low"></div>
<div class="minheight">
<?php
   if($this->session->flashdata('msgs')){
   ?>
<div class="alert alert-<?php echo $this->session->flashdata('type');?> " style="width:50%; margin:auto;">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <?php echo $this->session->flashdata('msgs');?>
</div>
<?php 		
   }
   ?>
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
   <div class="container" style="margin-top:15px;">
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div class="contest-head" style="background-color:#f4f2ed; padding-top: 1px;padding-bottom: 1px;">
				<h3> 
					<?php
					  if($single_contest[0]->contest_type=="logodesign" || $single_contest[0]->contest_type=="webdesign" || $single_contest[0]->contest_type=="movielogodesign")
						echo ucfirst($single_contest[0]->org_name);
					  else
						 echo ucfirst($single_contest[0]->contest_title);
					?>
					<span class="contest_category" style="vertical-align: middle;"><?php echo $contest_category[$single_contest[0]->contest_type];?></span>				  
				</h3>
            </div>
         </div>
      </div>
   </div>
</section>
<?php 	$time=time2string(strtotime($single_contest[0]->close_date) - time()); ?>
<div class="judging-view">
   <div class="container">
     <!--  price-btn -->
      <div class="row">
         <div class="col-sm-2 col-xs-6">
            <div class="judging-price">
               <?php 
                  $select=(round($single_contest[0]->pay_option)==1)?"select":"non-select";
                  $gar_type=(round($single_contest[0]->pay_option)==1)?"status-garentee":"status-nongarantee";
                  ?>
               <div class="<?php echo $gar_type;?>"><i style="margin-top: -44px;position: absolute;display: inline-block;font-size: 19px;color: rgb(255, 255, 255);margin-left: 7px;" class="fa fa-flag" aria-hidden="true"></i> </div>
               <b>$ <?php echo $single_contest[0]->contest_prize; ?></b>
            </div>
         </div>
         <div class="col-sm-6 col-xs-6">
            <div class="hours-entries">
               <?php if($single_contest[0]->status == 'open'){ ?>
               <h2><?php echo time2string(strtotime($single_contest[0]->close_date) - time())?></h2>
               <?php 	
                  $time=time2string(strtotime($single_contest[0]->close_date) - time()); 
                  ?>
               <p>left to submit design concepts.</p>
               <?php 
			    } 
                else if(($single_contest[0]->status == 'judging') && ($single_contest[0]->judging_close_date>= date("Y-m-d H:i:s")) && isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1)){;?>
               <h2><?php echo time2string(strtotime($single_contest[0]->judging_close_date) - time())?></h2>
               <p>left to submit design concepts.</p>
               <?php 
			    }else if(($single_contest[0]->status == 'judging') && ($single_contest[0]->judging_close_date>= date("Y-m-d H:i:s")) && ($user_id==$single_contest[0]->client_id)){ 
				?>
               <h2><?php echo time2string(strtotime($single_contest[0]->judging_close_date) - time())?></h2>
               <p>left to submit design concepts.</p>
               <?php } ?>
			   
			   <?php
			   if(payment_status($single_contest[0]->id)==0 && $single_contest[0]->status == 'judging'){ ?>
					<?php 
					if($user_id == $single_contest[0]->client_id){
					?>
					<h2>Project on hold. Awaiting balance payment from your.</h2>
					<p><a href="<?php echo base_url()?>contest/contest_partial_payment/<?php echo $single_contest[0]->id;?>">Click Here</a> to pay the balance payment.</p>
					<?php
					}
					else{
					?>
						<h2>Project on hold. Awaiting balance payment from client.</h2>
					<?php
					} 
					?>
			   <?php 
				}
				else if(payment_status($single_contest[0]->id)==0 && $single_contest[0]->status == 'open'){
				?>
					<?php 
					if($user_id == $single_contest[0]->client_id){
					?>
					<h2>Awaiting balance payment from your side.</h2>
					<p><a href="<?php echo base_url()?>contest/contest_partial_payment/<?php echo $single_contest[0]->id;?>" style="color:#f14b15;"> Click Here </a>to pay the balance payment.</p>
					<?php
					}
					?>
				<?php	
				} else if(payment_status($single_contest[0]->id)==1 && $single_contest[0]->status == 'judging' && isset($ctfinaldes) && ($ctfinaldes < 2)){ ?>
					<?php 
					if($user_id == $single_contest[0]->client_id){
					?>
						<h2></h2>
					<?php
					}
					else{
					?>
						<h2></h2>
					<?php
					} 
					?>
			   <?php 
				}
			    ?>
            </div>
         </div>
         <div class="col-sm-4 col-xs-6">
            <div class="judging-entries">
               <ul>
                  
                     <!--<li><img width="18" src="<?php echo base_url(); ?>assets/images/private-contest.png"><i class="fa fa-shield"></i> Private Contest</li>-->
                  <?php if(round($single_contest[0]->upgrade_private_contest) >0):?>
                  <li class="select"><span class="private_icon"><i class="fa fa-lock"></i></span> Private Contest</li>
                  <?php 
                   endif; 
                   if(round($single_contest[0]->upgrade_featured_contest) >0):
                  ?>
                  <li class="select"><span class="featured_icon"><i class="fa fa-star"></i></span> Featured Contest</li>
                  <?php endif;?>
               </ul>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-4 col-sm-offset-8 col-xs-6 pull-right">
            <?php 
               $usertype = $this->session->userdata('user_type');
               
               
                if(isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1) && ($single_contest[0]->judging_close_date>= date("Y-m-d H:i:s")) && (!isset($winningcontest) && empty($winningcontest)))
               	{
               		?>
            <div class="">
               <a class="js-open-modal btn btn-submit" data-modal-id="popup1">FINALIST SUBMIT YOUR DESIGN</a>
            </div>
            <?php } else if(isset($usertype) && !empty($usertype) && ($usertype !='0') && (!isset($winningcontest) && empty($winningcontest)) && $time!="Time Out" && $single_contest[0]->status !="judging"){ ?>
            <div >
               <a class="js-open-modal btn btn-submit" data-modal-id="popup1">SUBMIT YOUR DESIGN</a>
            </div>
            <?php }
               else if($usertype=='' && $single_contest[0]->status =="open")
               { ?>
            <div class="">
               <a href="<?php echo base_url();?>Admin/loginForm " class="js-open-modal btn btn-submit">SUBMIT YOUR DESIGN</a>
            </div>
            <?php $this->session->set_flashdata('message_name', 'please Login after then submit your design'); }
               ?>	
         </div>
        <!-- POP BOX -->
         <div id="popup1" class="modal-box">
            <header>
               <a href="#" class="js-modal-close close">x</a>
               <h3>Please upload yours file here</h3>
            </header>
			<form action="<?php echo base_url();?>contest/design_upload" name="design_upload" id="design_upload"  method="post" enctype="multipart/form-data">
               <div class="modal-body" style="margin-top:0px;margin-left:0px;">
			   <div class="col-sm-6 col-xs-6">
			   
                  <input type="file" name="for_upload" id="for_upload" />
                  <div class="help-block"> Please Upload the Files Only in <br><strong style="font-weight:  900; font-size: 16px; color: #000;">(640px * 500px)</strong> Dimension</div>
                  <div id="preview1"></div>
                  <input type="hidden" name="contest_id" value="<?php echo $single_contest[0]->id; ?>" />
                  <input type="hidden" name="client_id" value="<?php echo $single_contest[0]->client_id; ?>" />
                  <?php	
                     if(isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1))
                     {
                     ?>
                  <input type="hidden" id="final_status" name="final_status" value="<?php echo $subcheck->final_status; ?>" />
                  <?php	} ?>
				  <h5 style="margin-left:0px;text-align:left;">Condition</h5>
				  
				  <ul>
				  <li>I Have read <a href="<?php echo base_url()?>admin/codeofconduct" target="_blank" class="link">Designer code of Conduct</a></li>
				  <li>I Have read the design brief</li>
				  <li>I did not use stock or clip art</li>
				  </ul>
				 </div> 
				 
				   <div class="col-sm-6 col-xs-6">
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No Email Address or any contact info in the design submission or messages</p>
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No Flooding with small changes submissions</p>
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No Requesting client's email or contact info</p>
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No Discussions to be made to client regarding fellow designers</p>
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No Stock images or free vectors or using existing logos with minor modifications</p>
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No copying from fellow designers</p>
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No Foul Language during messaging client or fellow desingers</p>
				   <p><i class="fa fa-times-circle" aria-hidden="true"></i> No Borders around the design submissions</p>
				   </div>
				  
				 
               </div>
               <footer> 
                  <input type="submit" value="Upload" onclick="return Upload()" class="btn btn-small orange_bttn" style="margin-righ:10px;" /> 
				  <a href="#" class="btn btn-small js-modal-close">Close</a> 
               </footer>
            </form>
         </div>
         <!-- END POP BOX -->
      </div>
	  <div class=" nopadding">
      <!-- mode -->
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
	  </div>
	   <div class=" nopadding">
      <div class="row">
	 
         <div class="col-md-12 col-lg-12">
            <div class="tab">
               <div class="top_menu" >
                  <ul>
                     <li><a href="<?php echo base_url()."contest/contest_brief/".$contestid?>">BRIEF</a> </li>
                     <li><a class="active" href="#"> DESIGNS <span><?php echo $count_designs;?></span> </a></li>
                     <li><a href="<?php echo base_url()."contest/contest_discussions/".$contestid?>"> CLIENT UPLOADS 
					 <?php echo client_contest_discussioncount($single_contest[0]->id, $single_contest[0]->client_id);?> </a></li>
                     <?php if(($single_contest[0]->status =='completed') &&(($user_id==$winningcontest->designer_id)||($user_id==$winningcontest->client_id))){?>
                     <li>
                        <a href="<?php echo base_url()."contest/contest_designpackage/".$contestid?>" class="design_packag"> DESIGN PACKAGE </a> 
                     </li>
                     <?php } ?>
					<?php if(($user_id==$single_contest[0]->client_id)){?>
					<li><a  class="wnext" style="float:right;" href="<?php echo base_url()."contest/contest_procedure/".$contestid?>"> Help </a></li>
					<?php } ?>
                  </ul>
               </div>
               <?php	

                  if(isset($winningcontest) && !empty($winningcontest)){ 
                  ?>
				<div class="row" style="background-color:#f4f2ed; padding:10px; margin:0px;">
					<div class="col-md-6 col-lg-6">
						<div> WINNING DESIGN </div>
					</div>
					
					
				</div>
               <div class="row" style="margin-bottom:60px;">
                  <?php 
                     if(isset($winningcontest) && !empty($winningcontest))
                      {
                     		$prvcomments = design_comment($winningcontest->design_id);
                     
                     $pic= $this->Common_model->get_record('designer_table','*',array('users_id'=>$winningcontest->designer_id));
                     $profile_pic=$pic->designer_profile;
                     
                     ?>
                  <div class="col-md-5 col-lg-5 entry_box1 design1_<?php echo $winningcontest->designer_id; ?> ">
                     <div class="logo_design_model" >
                        <div class="logo_d_name" style="margin:0px;">
                           # <?php echo $winningcontest->design_no;?> by <a href="#"><?php echo $sign[$winningcontest->designer_id];?></a>
                        </div>
                        <div class="logo_image winning_design text-center" >
                           <img style="width:100%; min-height:350px; max-height:350px" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $winningcontest->design_name;?>" width="100%" />
                           <span class="logo-status">
                           <i class="logo-rank">1<span>st</span></i>
                           </span>
                           <span class="logo-status-img">
                           <?php  if(!empty($profile_pic))
                              { ?>
                           <img src="<?php echo base_url(); ?>uploads/designer_profile/<?php echo $profile_pic ?>" style="" width="70%" />
                           <?php }
                              else
                              {
                               ?>
                           <img src="http://addobyte.com/demo/contestdemo/assets/images/designer-signup.png" style="" width="70%" />
                           <?php } ?>
                           </span>
                        </div>
                        <div class="user_review">
                        </div>
                     </div>
                     <div class="col-sm-6 col-xs-4">
                     </div>
                  </div>
                  <div class="col-md-7 col-lg-7">
                     <div class="client-description">
                        <p><b><?php echo ucwords(username($winningcontest->client_id));?></b> has selected <b><?php echo ($user_id==$winningcontest->designer_id)?"Yourself":ucwords(username($winningcontest->designer_id));?></b> as the winner. </p>
                     </div>
                  </div>
                  <?php }  ?>
               </div>
               <?php } ?>
               <?php 
                  if(isset($subfinaldesigns) && !empty($subfinaldesigns)){
                  ?>
               <div class="row" style="background-color:#f4f2ed; padding:10px; margin: 0px;">
                  <div class="col-md-6 col-lg-6">
                     <div>ENTERIES BY FINALIST DESIGNERS</div>
                  </div>
				  <div class="col-md-3 col-lg-3">
						<div class="design-rate">
							<select size="1"  id="designername1" class="designername1">
								<option value="all">All Designer Name</option>
								 <?php foreach($finalist_designers as $tmp) { ?>
									<option value="<?php echo $tmp->designer_id; ?>">
										<?php echo ucwords($sign[$tmp->designer_id]);?>
									</option>
								 <?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-3 col-lg-3">
						<div class="design-rate"> 
							<select size="1" class="s_rane1" id="rate1">
								<option>Choose Rating</option>
								<option value="oldest">Oldest  Rated</option>
								<option value="latest">Newest Rated</option>
								<option value="lowrating">Lowest Rated</option>
								<option value="highrating">Highest  Rated</option>
							</select>
						</div>
					</div>
               </div>
               <div class="row">
                  <?php 
                     $sdno=0;
                     if(isset($subfinaldesigns) && !empty($subfinaldesigns)){
						$rcount=$this->Common_model->get_records_count('designs',array('design_status'=>1,'contest_id'=>$subfinaldesigns[0]->contest_id));
                     	foreach($subfinaldesigns as $subfdes) { 
                     		$prvcomments = design_comment($subfdes->design_id);
                     		$sdno++;
                     ?>
                  <div class="col-md-4 col-lg-4 entry_box1 design1_<?php echo $subfdes->designer_id; ?>">
                     <div class="logo_design_model ">
                        <div class="logo_d_name">
                           # <?php echo $subfdes->design_no;?> by <a href="#"><?php echo $sign[$subfdes->designer_id];?></a>
                        </div>
                        <div class="logo_image" style="width:300px;">
						   <?php  if(($single_contest[0]->status == "open") && ($user_id != $subfdes->client_id) && ($user_id != $subfdes->designer_id)){ ?>
                           <img class="imagesize" style="width:320px!important;"  src="<?php echo base_url(); ?>assets/image/hidden.jpg" >
                           <?php } elseif($single_contest[0]->pay_option==0 && $usertype =='1'){ ?>
							<img class="imagesize" style="width:320px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_watermark;?>">
                           <?php } else{ ?>
                           <img class="imagesize" style="width:320px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_name;?>">
                           <?php } ?>
						   <!-- <img class="imagesize" style="width:320px!important;" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_name;?>"  />-->
                           <?php
                              if($subfdes->design_rating>0){?>
                           <?php
							  if(!empty($winningcontest->design_id)){
								  $lstatus=( $winningcontest->design_id== $subfdes->design_id)?"logo-status":"logo-status-grey";
							  }
							  else{
								  $lstatus="logo-status-grey";
							  }
						   ?>
                           <span class="<?php echo $lstatus;?>">
                           <i class="logo-rank"><?php echo $sdno."<span>".suffix($sdno)."</span>";?></i>
                           </span>
                           <?php }else {?>
                           <?php } ?>
                        </div>
                        <div class="user_review">
                           <div class="row">
                              <div class="col-md-6 col-sm-6">
                                 <div class="star-rating">
                                    <input for="<?php echo $subfdes->design_id; ?>" id="input-21b"  <?php 
                                       if($user_id != $subfdes->client_id){ echo 'readonly'; } ?> value="<?php echo $subfdes->design_rating; ?>" type="number" class="rating checkrate" min=0 max=5 step=1 data-size="md">
                                 </div>
                              </div>
                              <div class="col-md-6 col-sm-6" >
                                 <div class="commend">
                                    <?php 
                                       if(($user_id == $subfdes->client_id) || (($user_id == $subfdes->designer_id) && (count($prvcomments) > 0))){
                                       ?>
                                   <a class="comment_btn" style='color:#f14b15'  data-modal-id="finpopup<?php echo $subfdes->design_id; ?>" >Comments(<?php echo count($prvcomments); ?>)</a>
                                    <?php } else { ?>  	 &nbsp;<span class="comment_btn">Comments(<?php echo count($prvcomments); ?>)</span>
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                           <div class="row" style="margin-top:10px">
                              <?php
                                 if($rcount==0)
                                 {
                                 ?>
                              <div class="col-md-6" >		
                                 <?php if($user_id == $subfdes->client_id){ ?>
                                 <a for='<?php echo $subfdes->design_id;  ?>' data-modal-id="subfinpopup<?php echo $subfdes->design_id; ?>" class="choose_winner comment_btn">Choose Winner</a>
                                 <?php } ?>
                              </div>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="subfinpopup<?php echo $subfdes->design_id; ?>" class="modal-box">
                     <header>
                        <a class="js-modal-close close"> x </a>
                        <h3>Choose Winner</h3>
                     </header>
                     <form action="<?php echo base_url();?>contest/winn_contest" name="design_upload" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                           <label>Do you want to choose <?php echo strtoupper(username($subfdes->designer_id)); ?> as a winner ?</label>    
                           <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                           <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                           <input type="hidden" name="designid" value="<?php echo $subfdes->design_id; ?>" />
                           <input type="hidden" name="designer_id" value="<?php echo $subfdes->designer_id; ?>" />
                           </br> 
                           <div class="row" style="margin-top:20px;">
                              <div class="col-md-6"><img style="width:320px!important;"  class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_name;?>"  /></div>
                           </div>
                        </div>
                        <footer> <a class="btn btn-small js-modal-close">Close</a> <input type="submit" class="btn btn-small orange_bttn" value="Winner" /> </footer>
                     </form>
                  </div>
                  <div id="finpopup<?php echo $subfdes->design_id; ?>" class="modal-box">
                     <header>
                        <a  class="js-modal-close close">x</a>
                        <h3>Comments</h3>
                     </header>
                     <div class="modal-body" style="padding:0px;">
                        <div class="logo_image" style="margin-bottom:50px;"><img style="width:320px!important;"  class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_name;?>" /></div>
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
                           <div class="message-timming"><?php echo date("d-m-Y h:i a",strtotime($tmp3->createddate)); ?></div>
                        </div>
                        <div class="row">
                           <div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp3->comment;?></div>
                        </div>
                        <div class="row" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                        </div>
                        <?php } } ?>
                        <form action="<?php echo base_url();?>contest/contest_privcomment" name="commentform" method="post" enctype="multipart/form-data">
                           <textarea rows="5" cols="20" class="msg_box" style="width: 723px; height: 106px;" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                           <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                           <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                           <input type="hidden" name="designid" value="<?php echo $subfdes->design_id; ?>" />
                           <input type="hidden" name="designerid" value="<?php echo $subfdes->designer_id; ?>" />
                           </br>
                           <input type="submit" class="precomm" value="Add Comment" />
                        </form>
                     </div>
                     <footer> 
						<a class="btn btn-small submit_cmt orange_bttn">Add Comment</a> 
						<a class="btn btn-small js-modal-close">Close</a> 
					 </footer>
                  </div>
                  <?php } } ?>
               </div>
			   
               <br><br>
               <?php } ?>
               <?php 
                  /*	if(isset($finaldesigns) && !empty($finaldesigns)){
                  	?>				
               <div class="row" style="background-color:#f4f2ed; padding:10px; margin:0px;">
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
                        <a class="js-modal-close close">x</a>
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
                                    <textarea class="form-control" name="msg" required></textarea>
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
			   
				<div class="row" style="background-color:#f4f2ed; padding:10px; margin:0px;">
					<div class="col-md-6 col-lg-6">
						<div>ENTERIES FROM QUALIFYING STAGE</div>
					</div>
					<div class="col-md-3 col-lg-3">
						<div class="design-rate">
							<select size="1"  id="designername" class="designername">
								<option value="all">All Designer Name</option>
								 <?php foreach($designersname as $fdes) { ?>
									<option value="<?php echo $fdes->designer_id; ?>">
										<?php echo $sign[$fdes->designer_id];?>
									</option>
								 <?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-3 col-lg-3">
						<div class="design-rate"> 
							<select size="1" class="s_rane" id="rate">
								<option>Choose Rating</option>
								<option value="oldest">Oldest  Rated</option>
								<option value="latest">Newest Rated</option>
								<option value="lowrating">Lowest Rated</option>
								<option value="highrating">Highest  Rated</option>
							</select>
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
                  ?>
                  <div class="col-md-4 col-lg-4 entry_box design_<?php echo $fdes->designer_id; ?>">
                     <div class="logo_design_model">
                        <div class="logo_d_name">
                           # <?php echo $fdes->design_no;?> by <?php echo ucwords($sign[$fdes->designer_id]);?>
                        </div>
                        <div class="logo_image">
                           <?php  if( ($single_contest[0]->status == "open") && ($user_id != $fdes->client_id) && ($user_id != $fdes->designer_id) ) { ?>
                           <img class="imagesize" style="width:320px!important;"  src="<?php echo base_url(); ?>assets/image/hidden.jpg"  />
						   <?php } elseif($single_contest[0]->pay_option==0 && $usertype =='1'){ ?>
							<img class="imagesize" style="width:320px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_watermark;?>">
                           <?php } else{ ?>
                           <img class="imagesize" style="width:320px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $fdes->design_name;?>"  />
                           <?php }
                              if($ctfinaldes >=1){ 
                              ?>
                           <span class="logo-status">
                           <i class="logo-rank"><?php echo $dno."<span>".suffix($dno)."</span>";?></i>
                           </span>
                           <?php } ?>
                        </div>
                        <div class="user_review">
						  <div class="row">
                           <div class="col-sm-6 col-xs-12">
                              <div class="star-rating">
                                 <input for="<?php echo $fdes->design_id; ?>" id="input-21b"  <?php 
                                    if($user_id != $fdes->client_id){ echo 'readonly'; } ?> value="<?php echo $fdes->design_rating; ?>" type="number" class="rating checkrate" min=0 max=5 step=1 data-size="md">
                              </div>
                           </div>
                           <div class="col-sm-6 col-xs-12">
                              <div class="commend">										
                                 <?php 
                                    if(($user_id == $fdes->client_id) || (($user_id == $fdes->designer_id) && (count($prvcomments) > 0))){
                                    ?>
                                 <a  data-modal-id="popup<?php echo $fdes->design_id; ?>" class="comment_btn" >Comments( <?php echo count($prvcomments); ?> ) </a>
                                 <?php } else { ?>  	 <span class="comment_btn">Comments (<?php echo count($prvcomments); ?> ) </span>
                                 <?php } ?>
                              </div>
                           </div>
						  </div>
                           <?php
                              if($ctfinaldes >=1 && $usertype == 0 && $user_id == $fdes->client_id && $win_design !=	1 && $single_contest[0]->status == "judging")
                              	{ ?>
						  <div class="row" style="margin-top:10px;">
                           <div class="col-md-6 col-xs-12">
							<a  for='<?php echo $fdes->design_id;  ?>'  data-modal-id="apopup<?php echo $fdes->design_id; ?>"  class="choose_winner comment_btn" >Choose Winner</a>
                           </div>
                          </div>
                           <?php }
                              ?>
                        </div>
                        <?php if($user_id != $fdes->client_id){ 
                           $bv=$fdes->design_id;
                           $us=$this->Common_model->get_records_count('design_likes',array('user_id'=>$user_id,'design_id'=>$bv));
                           
                           
                           ?>
                        <div id="demo" class="entry_options">
                           <div class="wrapper">
                              <?php if(($fdes->designer_id != $user_id) && ($single_contest[0]->status != "open")){
                                 ?>
                              <div class="content">
                                 <ul>
                                    <?php	if($usertype!=0)
                                       { ?>
                                    <a data-modal-id="spopup<?php echo $fdes->design_id; ?>" class="rep">
                                       <li><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report</li>
                                    </a>
                                    <?php	} ?>
                                    <li class="sa"><a  class="like_design" data-id="<?php echo $fdes->design_id;?>"  <?php if($us!=0){ ?> disabled <?php }?>
                                       ><i class="fa fa-heart" aria-hidden="true"></i> Like(<span class="lcount" > <?php echo $us ?> </span>)</a>
                                    </li>
                                 </ul>
                              </div>
                              <div class="parent"><img src="<?php echo base_url(); ?>assets/images/like-im.png"></div>
                              <?php 
                                 } ?>
                           </div>
                        </div>
                        <?php } ?>
                     </div>
					 <!--Popups-->
					 <div id="spopup<?php echo $fdes->design_id;?>" class="modal-box">
                     <header>
                        <a class="js-modal-close close">x</a>
                        <h3>Report Logo Design Violation</h3>
                     </header>
					 <form class="form-horizontal fname" action="<?php echo base_url();?>contest/report_contest" name="design_upload" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                           <div class="report_option">
                              <label>I want to report:</label>    
                              <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                              <input type="hidden" name="clientid" value="<?php echo $fdes->designer_id; ?>" />
                              <input type="hidden" name="designid" value="<?php echo $fdes->design_id; ?>" />
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
                                 <label class="control-label col-sm-2 url_text" for="email">Your Design (#):</label>
                                 <div class="col-sm-6">
                                    <input type="text" class="form-control userdesign_id"  name="userdesign" required>
                                    <div class="help-block check22"></div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="control-label col-sm-2" for="pwd">Design(#) that copying yours:</label>
                                 <div class="col-sm-6"> 
                                    <input type="text" class="form-control" id="pwd" name="copydesign" value="<?php echo $fdes->design_no; ?>" readonly>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="control-label col-sm-2" for="pwd">Your Message To Moderator:</label>
                                 <div class="col-sm-6"> 
                                    <textarea class="form-control" name="msg" required></textarea>
                                 </div>
                              </div>
                              <input type="hidden" value="<?php echo base64_encode($current_page);?>" name="rpage">
                              <input type="hidden" value="<?php echo $single_contest[0]->id;?>" name="contest_id">	
                           </div>
                        </div>
                        <footer> 
                           <a class="btn btn-small back">Back</a> 
                           <a class="btn btn-small js-modal-close close2">Close</a>
                           <input type="submit" class="btn btn-small myBtn2 orange_bttn" value="Report"/> 
                        </footer>
                     </form>
                  </div>
                  <div id="popup<?php echo $fdes->design_id; ?>" class="modal-box">
                     <header>
                        <a class="js-modal-close close">x</a>
                        <h3>Comments</h3>
                     </header>
                     <div class="modal-body" style="padding:0px;">
                        <div class="logo_image" style="margin-bottom:50px;"><img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $fdes->design_name;?>"  /></div>
                        <?php
                           foreach($prvcomments as $tmp2)
                           {
                           ?>
                        <div class="row">
                           <div class="col-md-6 col-lg-6">
                              <div class="messanger-name"><b><?php echo $tmp2->createdname; ?></b> <?php  if($tmp2->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                           </div>
                           <div class="message-timming"><?php echo date("d-m-Y h:i a",strtotime($tmp2->createddate)); ?></div>
                        </div>
                        <div class="row">
                           <div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp2->comment;?></div>
                        </div>
                        <div class="ro" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                        </div>
                        <?php }  ?>
                        <form action="<?php echo base_url();?>contest/contest_privcomment" name="commentform" method="post" enctype="multipart/form-data">
                           <textarea rows="5" cols="20" class="msg_box" style="width: 723px; height: 106px;" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                           <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                           <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                           <input type="hidden" name="designid" value="<?php echo $fdes->design_id; ?>" />
                           <input type="hidden" name="designerid" value="<?php echo $fdes->designer_id; ?>" />
                           </br>
                           <input type="submit" class="precomm" value="Add Comment"/>
                        </form>
                     </div>
                     <footer> 
						<a class="btn btn-small submit_cmt orange_bttn">Add Comment</a> 
						<a  class="btn btn-small js-modal-close">Close</a> 
					 </footer>
                  </div>
                  <div id="apopup<?php echo $fdes->design_id; ?>" class="modal-box">
                     <header>
                        <a class="js-modal-close close">x</a>
                        <h3>Choose Winner</h3>
                     </header>
                     <form action="<?php echo base_url();?>contest/winn_contest" name="design_upload" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                           <label>Do you want to choose <?php echo strtoupper(username($fdes->designer_id)); ?> as a winner ?</label>    
                           <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                           <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                           <input type="hidden" name="designid" value="<?php echo $fdes->design_id; ?>" />
                           <input type="hidden" name="designer_id" value="<?php echo $fdes->designer_id; ?>" />
                           </br> 
                           <div class="row" style="margin-top:20px;">
                              <div class="col-md-6"><img class="imagesize" style="width:320px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $fdes->design_name;?>"  /></div>
                           </div>
                        </div>
                        <footer> <a class="btn btn-small js-modal-close">Close</a> <input type="submit" class="btn btn-small orange_bttn" value="Winner" /> </footer>
                     </form>
                  </div>
                  
					 
                  </div>
                  <?php } ?>
                  <?php }  
                     if(!empty($designs))
                     {
                     /* foreach($designs as $rating)
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
                     
                     } */
                     foreach($designs as $des) {
                     $dno++;
                     $prvcomments = design_comment($des->design_id);											
                     ?>
                  <div class="col-md-4 col-lg-4 entry_box design_<?php echo $des->designer_id; ?>">
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
                           # <?php echo $des->design_no;?> by <a href="#"> <?php echo ucwords($sign[$des->designer_id]);?></a>
                        </div>
                        <div class="logo_image">
							<?php if($des->display_status==1){
							?>
								<span class="withdraw-box"></span>
								<span class="withdraw-msg">Widthdrawn</span>
							<?php
							}
							?>
                           <?php  if(($single_contest[0]->status == "open"||$single_contest[0]->status == "judging")&&($ctfinaldes<2) && ($user_id != $des->client_id) && ($user_id != $des->designer_id) ) { ?>
                           <img class="imagesize" style="width:320px!important;"  src="<?php echo base_url(); ?>assets/image/hidden.jpg"  />
                           <?php } elseif($single_contest[0]->pay_option==0 && $usertype =='1'){ ?>
							<img class="imagesize" style="width:320px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_watermark;?>">
                           <?php } else{ ?>
                           <img class="imagesize <?php //echo ($des->display_status==1)?"blur-img":"";?>" style="width:320px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  />
                           <?php } 
                              if($des->design_rating >0)
                              {
						  ?>
                           <span class="logo-status-grey">
                           <i class="logo-rank"><?php echo $dno."<span>".suffix($dno)."</span>";?></i>
                           </span>
                           <?php } else{?>
						   
                           <?php } ?>
                        </div>
                        <div class="user_review">
						  <div class="row">
                           <div class="col-sm-6 col-xs-12">
                              <div class="star-rating">
                                 <input for="<?php echo $des->design_id; ?>" id="input-21b"  <?php 
                                    if($user_id != $des->client_id){ echo 'readonly'; } ?> value="<?php echo $des->design_rating; ?>" type="number" class="rating checkrate" min=0 max=5 step=1 data-size="md">
                              </div>
                           </div>
                           <div class="col-sm-6 col-xs-12">
                              <div class="commend">										
                                 <?php 
                                    if(($user_id == $des->client_id) || (($user_id == $des->designer_id) && (count($prvcomments) > 0))){
                                    ?>
                                  <a  data-modal-id="popup<?php echo $des->design_id; ?>" class="comment_btn">
								  Comments  <?php echo "(".count($prvcomments).")"; ?></a>
                                 <?php } else { ?> <span class="comment_btn">Comments <?php echo "(".count($prvcomments).")"; ?></span>
                                 <?php } ?>
                              </div>
                           </div>
                          </div>
                           <?php if($user_id == $des->client_id && $single_contest[0]->status == "judging"){ ?>
						  <div class="row" style="margin-top:10px;">
                              <!--
                                 <div class="col-md-6" >	<a  for='<?php echo $des->design_id;  ?>'  data-modal-id="apopup<?php echo $des->design_id; ?>" class="comment_btn" >Choose Winner</a>
                                 </div>	
                                 -->
                              <div class="col-md-6">
                                 <?php 								 
                                    $lcount=$this->Common_model->get_records_count('designs',array('final_status'=>1,'contest_id'=>$des->contest_id,'designer_id'=>$des->designer_id));
                                    
                                    if(isset($ctfinaldes) && ($ctfinaldes < 2) && ($lcount==0) && (payment_status($single_contest[0]->id)==1)){ 
                                 ?>
                                 <a for='<?php echo $des->design_id;  ?>' data-modal-id="bpopup<?php echo $des->design_id; ?>" class="comment_btn">Choose Finalist</a>
                                 <?php }
                                    else if($ctfinaldes==2)
                                    { 
                                    ?>
                                 <a  for='<?php echo $des->design_id;  ?>'  data-modal-id="apopup<?php echo $des->design_id; ?>"   class="choose_winner comment_btn" >Choose Winner</a>
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
                        <div id="demo" class="entry_options">
                           <div class="wrapper">
                              <?php if(($des->designer_id != $user_id) && ($single_contest[0]->status != "open")){?>
                              <div class="content">
                                 <ul>
                                    <?php	if($usertype!=0)
                                       {    ?>
                                    <a data-modal-id="rpopup<?php echo $des->design_id; ?>" class="rep">
                                       <li><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report</li>
                                    </a>
                                    <?php	}	?>
                                    <li><a href="#" class="like_design" data-id="<?php echo $des->design_id;?>" <?php if($ls!=0){ ?> disabled <?php }?>
                                       ><i class="fa fa-heart" aria-hidden="true"></i> Likes(<span class="lcount"><?php echo $ls ?> </span>) </a>
                                    </li>
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
                                          <!-- POP BOX -->
                  <div id="rpopup<?php echo $des->design_id; ?>" class="modal-box">
                     <header>
                        <a class="js-modal-close close">x</a>
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
                                 <label class="control-label col-sm-2 url_text" for="email">Your Design (#):</label>
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
                                    <textarea class="form-control" name="msg" required></textarea>
                                 </div>
                              </div>
                              <input type="hidden" value="<?php echo base64_encode($current_page);?>" name="rpage">
                              <input type="hidden" value="<?php echo $single_contest[0]->id;?>" name="contest_id">	
                           </div>
                        </div>
                        <footer> 
                           <a class="btn btn-small back">Back</a> 
                           <a class="btn btn-small js-modal-close close2">Close</a>
                           <input type="submit" class="btn btn-small myBtn2 orange_bttn" value="Report"/> 
                        </footer>
                     </form>
                  </div>
                  <div id="bpopup<?php echo $des->design_id; ?>" class="modal-box">
                     <header>
                        <a class="js-modal-close close">x</a>
                        <h3>Choose A Finalist</h3>
                     </header>
                     <form action="<?php echo base_url();?>contest/final_contest" name="design_upload" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                           <label>Do you want to choose <?php echo strtoupper(username($des->designer_id)); ?> as a finalist ?</label>    
                           <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                           <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                           <input type="hidden" name="designer_id" value="<?php echo $des->designer_id; ?>" />
                           <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                           </br> 
                           <div class="row" style="margin-top:20px;">
                              <div class="col-md-6"><img class="imagesize" style="width:320px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  /></div>
                           </div>
                        </div>
                        <footer> <a class="btn btn-small js-modal-close">Close</a> 
						<input type="submit" class="btn btn-small comment_btn" value="Finalist" /> </footer>
                     </form>
                  </div>
                  <div id="apopup<?php echo $des->design_id; ?>" class="modal-box">
                     <header>
                        <a class="js-modal-close close">x</a>
                        <h3>Choose Winner</h3>
                     </header>
                     <form action="<?php echo base_url();?>contest/winn_contest" name="design_upload" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                           <label>Do you want to choose  <?php echo strtoupper(username($des->designer_id)); ?> as a winner ?</label>    
                           <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                           <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                           <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                           <input type="hidden" name="designer_id" value="<?php echo $des->designer_id; ?>" />
                           </br>
                           <div class="row" style="margin-top:20px;">
                              <div class="col-md-6"><img class="imagesize" style="width:320px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  /></div>
                           </div>
                        </div>
                        <footer> <a class="btn btn-small js-modal-close">Close</a> <input type="submit" class="btn btn-small orange_bttn" value="Winner" /> </footer>
                     </form>
                  </div>
                  <div id="withdraw_pop<?php echo $des->design_id; ?>" class="modal-box">
                     <header>
                        <a class="js-modal-close close">x</a>
                        <h3>Withdraw A Design</h3>
                     </header>
                     <form action="<?php echo base_url();?>contest/withdraw_design" name="design_upload" method="post">
                        <div class="modal-body">
                           <label>Do you want to withdraw the design?</label>    
                           <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                           <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                           <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                           </br>                       
                        </div>
                        <footer> 
							<a class="btn btn-small js-modal-close">Cancel</a> 
                           <input type="submit" class="btn btn-small orange_bttn" value="Yes, Do It" /> 
                        </footer>
                     </form>
                  </div>
                  <div id="popup<?php echo $des->design_id; ?>" class="modal-box">
                     <header>
                        <a  class="js-modal-close close">x</a>
                        <h3>Comments</h3>
                     </header>
                     <div class="modal-body" style="padding:0px;">
                        <div class="logo_image" style="margin-bottom:20px;"><img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  /></div>
                        <?php
                           if(isset($prvcomments) && !empty($prvcomments)) { 
                           	foreach($prvcomments as $tmp2)
                           	{
                           ?>
                        <div class="row">
                           <div class="col-md-6 col-lg-6">
                              <div class="messanger-name"><b><?php echo $tmp2->createdname; ?></b> <?php  if($tmp2->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                           </div>
                           <div class="message-timming"><?php echo date("d-m-Y h:i a",strtotime($tmp2->createddate)); ?></div>
                        </div>
                        <div class="row">
                           <div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp2->comment;?></div>
                        </div>
                        <div class="ro" style="background-color:#f4f2ed; padding:15px; margin-top:10px;">
                        </div>
                        <?php } } ?>
                        <form action="<?php echo base_url();?>contest/contest_privcomment" name="commentform" method="post" enctype="multipart/form-data">
                           <textarea rows="5" cols="20" class="msg_box" style="width: 723px; height: 106px;" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                           <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                           <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                           <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                           <input type="hidden" name="designerid" value="<?php echo $des->designer_id; ?>" />
                           </br>
                           <input type="submit" class="precomm" value="Add Comment" />
                        </form>
                     </div>
                     <footer> 
						<a class="btn btn-small submit_cmt orange_bttn">Add Comment</a> 
						<a  class="btn btn-small js-modal-close">Close</a> 
					 </footer>
                  </div>
                  
                  <?php }
                     }
					 else if(empty($designs) && $ctfinaldes==0){	
                     	echo "<center><h4 style='color:red'>No design<h4>";
                    }
                ?>
               </div>
            </div>
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
	   
	  $(document).on("click",".submit_cmt",function(){
			var tar= $(this).parent("footer").parent("div").find(".precomm");
			$(tar).trigger("click");
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
   $(document).ready(function() {
      $(document).on('keyup', '.userdesign_id', function() {
		 var rtype = $(".radiooption:checked").val();
         var email = $(this).val();
		 
         if (email) {
			 if(rtype=='copy'){
				var user_id = <?php echo (!empty($user_id))? $user_id:"''";?>;
				$.ajax({
				   type: 'post',
				   url: "<?php echo base_url();?>contest/design_verification",
				   data: {
					  design_id: email,
					  designer_id: user_id,
					  contest_id: <?php echo $single_contest[0]->id ?>
				   },
				   success: function(response) {
					  if (response == 1) {
						 $(".check22").html("<span style='color:#429a44'>valid</span>");
						 $(function() {
							$("input.myBtn2").attr("disabled", false);
						 });
					  } else {
						 $(".check22").html("<span style='color:#cc0000'>invalid designid:</span>");
						 $(function() {
							$("input.myBtn2").attr("disabled", true);
						 });
					  }
				   }
				});
			 }
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
   
              if( width == 640 && height == 500 ) {
                  form.submit();
              }
              else {
                  //fail
   			  alert("Incorrect size of image dimensions.");
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
		var rtype= $(this).val();
		var text_label=(rtype=="copy")?"Your Design (#):":"URL link to the copyrighted image:";
		$(".url_text").html(text_label);
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
<script>

   $(document).ready(function() {
   			$(".designername1").change(function() {
				var designerid = $("#designername1").val();
				$( ".entry_box1" ).hide();
				$(".design1_"+designerid).show();
				
				if(designerid == 'all') {
					$( ".entry_box1" ).show();
				}				
			});
   });
</script>
<script>

   $(document).ready(function() {
   			$(".designername").change(function() {
				var designerid = $("#designername").val();
				$( ".entry_box" ).hide();
				$(".design_"+designerid).show();
				
				if(designerid == 'all') {
					$( ".entry_box" ).show();
				}				
			});
   });
</script>

<script>
 $(document).ready(function() {

		$(".s_rane").change(function() {
					
			var rate = $("#rate").val();
		 window.location.href = "<?php echo base_url()?>contest/contest_entries/<?php echo $contestid; ?>/"+rate;
					
		});
		
 });
</script>


<script>
 $(document).ready(function() {

		$(".s_rane1").change(function() {
					
			var rate = $("#rate1").val();
		 window.location.href = "<?php echo base_url()?>contest/contest_entries/<?php echo $contestid; ?>/"+rate;
					
		});
		
 });
</script>