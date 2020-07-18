<link href="<?php echo base_url();?>assets/js/mcColorPicker.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/js/mcColorPicker.js" type="text/javascript"></script>
 
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
   <div class="container" style="margin-top:15px;">
      <div class="row">
         <div class="col-md-12 col-lg-12" >
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
<?php $time=time2string(strtotime($single_contest[0]->close_date) - time()); ?>
<div class="judging-view">
   <div class="container">
     <!-- price-btn -->
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
			<!--
            <div class="hours-entries">
               <?php if($single_contest[0]->status == 'open' || $single_contest[0]->status == 'draft' ){ ?>
               <h2><?php  echo time2string(strtotime($single_contest[0]->close_date) - time())?></h2>
               <?php 	
                  $time=time2string(strtotime($single_contest[0]->close_date) - time()); 
               ?>
               <p>left to submit design concepts.</p>
               <?php } 
			   else if(($single_contest[0]->status == 'judging') && ($single_contest[0]->judging_close_date>= date("Y-m-d H:i:s")) && isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1)){ ?>
               <h2><?php echo time2string(strtotime($single_contest[0]->judging_close_date) - time())?></h2>
               <p>left to submit design concepts.</p>
               <?php } ?>
            </div>
         </div>
		 
         <div class="col-sm-4 col-xs-6">
            <div class="judging-entries">
               <ul>
                  <!-- <li><img width="18" src="<?php echo base_url(); ?>assets/images/private-contest.png"><i class="fa fa-shield"></i> Private Contest</li>
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
         </div>-->
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
				}
			    ?>
			   
            </div>
		</div>
		<div class="col-sm-4 col-xs-6">
            <div class="judging-entries">
               <ul>
                  <!--
                     <li><img width="18" src="<?php echo base_url(); ?>assets/images/private-contest.png"><i class="fa fa-shield"></i> Private Contest</li>-->
                  <?php  if(round($single_contest[0]->upgrade_private_contest) >0):?>
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
            <div class="">
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
         <!-- POP BOX  -->
         <div id="popup1" class="modal-box">
            <header>
               <a href="#" class="js-modal-close close">X</a>
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
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div class="tab">
			<div class="top_menu" >
			<ul>
			<li><a class="active" href="#">BRIEF</a> </li>
			<li>
				<a href="<?php echo base_url()."contest/contest_entries/".$contestid?>"> DESIGNS <span><?php echo $count_designs;?></span> </a>
			</li>
			<li>
				<a href="<?php echo base_url()."contest/contest_discussions/".$contestid?>"> CLIENT UPLOADS <?php echo client_contest_discussioncount($single_contest[0]->id, $single_contest[0]->client_id);?> </a>
			</li>
			<?php if(($single_contest[0]->status =='completed') &&(($user_id==$winningcontest->designer_id)||($user_id==$winningcontest->client_id))){?>
			<li>
                 <a class="design_packag" href="<?php echo base_url()."contest/contest_designpackage/".$contestid?>"> DESIGN PACKAGE </a> 
			</li>
			<?php } ?>
			<?php if(($user_id==$single_contest[0]->client_id)){?>
			<li><a  class="wnext" style="float:right;" href="<?php echo base_url()."contest/contest_procedure/".$contestid?>"> Help </a></li>
			<?php } ?>
			</ul>
			</div>
            <div class="row" style="background-color:#f4f2ed; padding:10px; margin:0px;">
                        <div class="col-md-6 col-lg-6">
                           <div >Contest Brief </div>
                        </div>
                     </div>
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
                                 if($single_contest[0]->contest_type=="logodesign" || $single_contest[0]->contest_type=="webdesign" || $single_contest[0]->contest_type=="movielogodesign"){
							  ?>								
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
                        <div class="col-md-8 col-sm-6 col-xs-12">
                           <div class="d-style_desc_detail" style="line-height:20px;">
                              <?php if($single_contest[0]->contest_type=="logodesign") { ?>
                              <p><span style="width:100px;">FEMININE</span>&nbsp;&nbsp;</span><span style="width:160px; margin-top: 5px;"><input type="range" class="range" readonly value="<?php echo $many['slider1']; ?>" /></span>&nbsp;&nbsp;<span>MASCULINE</span></p>
                              <p><span style="width:100px;">SIMPLE</span>&nbsp;&nbsp;</span><span style="width:160px; margin-top: 5px;"><input type="range" class="range" readonly  value="<?php echo $many['slider2']; ?>" /></span>&nbsp;&nbsp;<span>COMPLEX</span></p>
                              <p><span style="width:100px;">MODEST</span>&nbsp;&nbsp;</span><span style="width:160px; margin-top: 5px;"><input type="range" class="range" readonly  value="<?php echo $many['slider3']; ?>" /></span>&nbsp;&nbsp;<span>LUXURY</span></p>
                              <p><span style="width:100px;">PLAYFUL</span>&nbsp;&nbsp;</span><span style="width:160px; margin-top: 5px;"><input type="range" class="range" readonly  value="<?php echo $many['slider4']; ?>" /></span>&nbsp;&nbsp;<span>SERIOUS</span></p>
                              <p><span style="width:100px;">MODERN</span>&nbsp;&nbsp;</span><span style="width:160px; margin-top: 5px;"><input type="range" class="range" readonly  value="<?php echo $many['slider5']; ?>" /></span>&nbsp;&nbsp;<span>VINTAGE</span></p>
                              <p><span style="width:100px;">SPORTY</span>&nbsp;&nbsp;</span><span style="width:160px; margin-top: 5px;"><input type="range" class="range" readonly  value="<?php echo $many['slider6']; ?>" /></span>&nbsp;&nbsp;<span>ELEGANT</span></p>
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
                        	<span style="background-color:<?php echo $many['color1'];?>; border-color:<?php echo $many['color1'];?>" class="r-color"></span>
                            <span style="background-color:<?php echo $many['color2'];?>; border-color:<?php echo $many['color2'];?>" class="r-color"></span>
                            <span style="background-color:<?php echo $many['color3'];?>; border-color:<?php echo $many['color3'];?>" class="r-color"></span>
                            <span style="background-color:<?php echo $many['color4'];?>; border-color:<?php echo $many['color4'];?>" class="r-color"></span>
                        	
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

					 <?php if($single_contest[0]->contest_type=="logodesign"){?>
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
					 <?php }?>

                     <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                           <div class="d-attach_desc">
                              <p>FILE ATTACHED</p>
                           </div>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                           <?php if(!empty($single_contest[0]->filename)):?>
                           <div class="d-logo_desc_detail">
                              <a target="_blank" download class="js-open-modal btn"style="line-height: 0; font-size: 0; color: transparent; " href="<?php echo base_url(); ?>uploads/brief/<?php echo $single_contest[0]->filename; ?>" >
							  <img src="<?php echo base_url();?>assets/images/default_download.jpg" style="width:100%;">
							  </a>
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