    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
 <style>

.modal-content {
  height:400px;
  overflow:scroll;
  
}

.h3, h3 {
    font-size: 1.55rem!important;
}
.modal-body p{padding:10px; background-color:rgba(0,0,0,0.1); border-radius:10px;
  color:black !important;
  width:100% !important;}
  .choosewinner{
        color: black;
    font-size: 0.9em;
    font-weight: 600;
  }
.text
{
  text-align:left;
}

.withdraw-box {
    position: absolute;
    width: 320px;
    height: 250px;
    z-index: 9;
    background: #fff !important;
    opacity: 0.9;
}
.withdraw-msg {
    position: absolute;
    z-index: 9;
    top: 40%;
    padding: 3px !important;
    color: #7b7b7b !important;
     background: #fff !important;
    border: 1px solid #7b7b7b;
    font-weight: 500 !important;
    text-transform: uppercase;
    left: 62% !important;
}
.commend{
  padding-top: 10px !important;
}
.logo-status-grey1{
background: rgba(90, 90, 90, 0.8) !important;
}
.logo-status{

}
</style>
 <!--==========================
    Intro Section
  ============================-->
  <?php

    $usertype = $this->session->userdata('user_type');
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
  <section id="intro" class="contest-brief">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade">
      <img src="<?php echo base_url();?>assets/images/home_bg.jpg" alt="" title="" />
      </div>
     <div class="intro-msg contest-detail">
      <div class="container">
         <div class="row intro-top">
    <!--       gonna mano -->

            <div class="col-lg-12 text-left">
            <div class="col-lg-12 ">
            <div class="row">
            <div class="col-lg-3">
               <span class="price-tag">$<?php echo $single_contest[0]->contest_prize ?> </span></div>
               <div class="col-lg-9 text-left">
               <h3 class="contest-title"><?php
                 /* $string1 = mb_strimwidth($single_contest[0]->org_name, 0, 12, '...');*/
                  $string1 = $single_contest[0]->org_name;
                 /* $string2 = mb_strimwidth($single_contest[0]->contest_title, 0, 12, '...');*/
                  $string2 = $single_contest[0]->contest_title;
                 if($single_contest[0]->contest_type=="logodesign" || $single_contest[0]->contest_type=="webdesign" || $single_contest[0]->contest_type=="movielogodesign")
                  echo ucfirst($string1);
                 else
                   echo ucfirst($string2);
               ?></h3></div></div></div>
               <div class="col-lg-12">
                <div class="row">
                  <div style="margin-top: 10px!important; float: right!important;  " class="col-lg-3">
               <span class="category-label"><?php if(is_numeric($single_contest[0]->contest_type)){
                  foreach($category as $category_value){
                  echo $category_value;
                   } } else {
                     echo $contest_category[$single_contest[0]->contest_type];
                  } ?></span></div>
                 <!--  <div class="col-lg-6 feature-box" style="float: left!important; text-align: left!important;">
                            </div> -->
           
            <div class="col-lg-6 feature-box" style="float: left!important; text-align: left!important;">


                <?php if(round($single_contest[0]->upgrade_private_contest) >0):?>
               <span class="feature-tag">
                  <i class="fa fa-lock"></i> Private Contest
               </span>
                <?php 
                   endif; 
                   if(round($single_contest[0]->upgrade_featured_contest) >0):
                  ?>
               <span class="feature-tag">
                  <i class="fa fa-star"></i> Featured Contest
               </span>
                <?php endif;?>
            </div>
             </div></div>
         </div></div>
         <?php    $time=time2string(strtotime($single_contest[0]->close_date) - time()); ?>

       <!--   mano -->
  <div class="row intro-bottom">
        <div class="col-lg-3 " style="padding-bottom: 15px">
            <?php 
       $time=time2string(strtotime($single_contest[0]->close_date) - time());
            if(isset($winningcontest) && (($user_id==$winningcontest->designer_id)||($user_id==$winningcontest->client_id))){
            if(($single_contest[0]->package_status==3)||($single_contest[0]->package_status<3) &&(($user_id==$winningcontest->designer_id)||($user_id==$winningcontest->client_id))){  ?>
               <span class="status-tag">Winner Selected</span>
           <?php  }
            } else if($single_contest[0]->status =="completed"){
               ?>
                <span class="status-tag">Contest Completed</span>
              
             <?php }  ?>
              <?php 
                if($single_contest[0]->status =="judging"){
               ?>
             <span class="status-tag">Judging Contest</span>
              <?php }  ?> 
              <?php 
                if($single_contest[0]->status =="open"){
               ?>
             <span class="status-tag">Open Contest</span>
              <?php }  ?>
            </div>
            <div class="col-lg-5">
              <div class="row" style="padding: inherit;">
                <div clas="col-lg-4">
          <span class="time-block"><img src="<?php echo base_url();?>assets/images/time_icon.svg"></span></div><!--  2 Days, 20 Hours, 48 Minutes left -->
                  <span><div clas="col-lg-8"><?php if($single_contest[0]->status == 'open'){ ?>
      <h3 style="color: white; font-weight: bolder;margin-top: 18px!important;
    margin: 0 0 0 0!important;"><?php echo time2string(strtotime($single_contest[0]->close_date) - time())?></h3>
               <?php  
                  $time=time2string(strtotime($single_contest[0]->close_date) - time()); 
                  ?>
               <p >left to submit design concepts.</p>
               <?php 
          } 
                else if(($single_contest[0]->status == 'judging') && ($single_contest[0]->judging_close_date>= date("Y-m-d H:i:s")) && isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1)){  ?>
               <h3 style="color: white; font-weight: bolder;"><?php echo time2string(strtotime($single_contest[0]->judging_close_date) - time())?></h3>
               <p>left to submit design concepts.</p>
               <?php 
          }else if(($single_contest[0]->status == 'judging') && ($single_contest[0]->judging_close_date>= date("Y-m-d H:i:s")) && ($user_id==$single_contest[0]->client_id)){ 
        ?>
               <h3 style="color: white;font-weight: bolder;"><?php echo time2string(strtotime($single_contest[0]->judging_close_date) - time())?></h3>
               <p>left to submit design concepts.</p>
                <?php }  ?>
         
         <?php
         //Partial payment option not use this new contesthours project so remove 
         /*
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
        }*/
          ?>
              <?php if($single_contest[0]->status == 'completed'){
             if($single_contest[0]->close_date < date("Y-m-d H:i:s")){ ?>
               <h3 style="color: white; font-weight: bolder;" class="finish_mobile"> Finished Date </h3>
            <?php  } else {
                 $remain = remaining_time(date("Y-m-d "),$single_contest[0]->close_date);
                $rdate= date('d',strtotime($remain)); ?>
               <p><?php echo remaining_time(date("Y-m-d H:i:s"),$single_contest[0]->close_date)."left"."</p>";
               // echo remaining_time(date("Y-m-d H:i:s"),$single_contest[0]->close_date)."left";
                //echo $rdate." Remaining Date";
            }
             } ?></span></div></div>
        </div>
            <div class="col-lg-4 feature-box">
           
               <?php 
               $usertype = $this->session->userdata('user_type');
                    $userid = $this->session->userdata('user_id');
                    $refid = get_referral_not_show($userid);
                    if($refid==""){
                    
                    if(isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1) && ($single_contest[0]->judging_close_date>= date("Y-m-d H:i:s")) && (!isset($winningcontest) && empty($winningcontest)))
                      {
                     ?>
               <span class="status-tag" data-target="#myModal1" data-toggle="modal" style="background-color: #fbb03b">FINALIST SUBMIT YOUR DESIGN</span>
               <?php } else if(isset($usertype) && !empty($usertype) && ($usertype !='0') && (!isset($winningcontest) && empty($winningcontest)) && $time!="Time Out" && $single_contest[0]->status !="judging"){ ?>
               <span class="status-tag" data-target="#myModal1" data-toggle="modal" style="background-color: #fbb03b">SUBMIT YOUR DESIGN</span>
                <?php }
                        else if($usertype=='' && $single_contest[0]->status =="open")
                        { ?>
                     <a href="<?php echo base_url();?>Admin/loginForm "> 
                     <span class="status-tag js-open-modal btn btn-submit" style="background-color: #fbb03b">SUBMIT YOUR DESIGN</span></a>
                      <?php $this->session->set_flashdata('message_name', 'please Login after then submit your design');
                       }
                     }
                        ?> 
            </div>
            <!-- <div class="modal fade show" id="myModal1" style="padding-right: 16px; "> -->
   <!-- <div class="modal fade hide" id="myModal1" style="display: none;"> -->
      <div class="modal fade" id="myModal1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Please upload yours file here</h4>
        <button type="button" class="close1" data-dismiss="modal">×</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="<?php echo base_url();?>contest/design_upload" name="design_upload" id="design_upload"  method="post" enctype="multipart/form-data">
       <!--  <div class="col-lg-8 text-left">   
        <div class=" form-group">
         <label for="email">Comments:</label>
         <textarea class="form-control" name="comments"></textarea>
        </div>
        </div> -->
          <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-5 col-sm-6">
            <input type="file" name="for_upload" id="for_upload" />
            <div class="help-block" style="text-align: left;margin-left: 34px;"> Please Upload the Files Only in <br><strong style="font-weight:  1000; font-size: 16px; color: #000;">(640px * 500px)</strong> Dimension</div>
             <div id="preview1"></div>
                  <input type="hidden" name="contest_id" value="<?php echo $single_contest[0]->id; ?>" />
                  <input type="hidden" name="client_id" value="<?php echo $single_contest[0]->client_id; ?>" />
                  <?php 
                     if(isset($subcheck) && !empty($subcheck) && ($subcheck->final_status == 1))
                     {
                     ?>
                  <input type="hidden" id="final_status" name="final_status" value="<?php echo $subcheck->final_status; ?>" />
                  <?php } ?>
                  <br><h5 style="margin-left:32px;text-align:left;"><b>Condition</b></h5>
                   <ul>
              <li class="text">I Have read <a href="<?php echo base_url()?>admin/codeofconduct" >Designer code of Conduct</a></li>
              <li class="text">I Have read the design brief</li>
              <li class="text">I did not use stock or clip art</li>
              </ul>
          </div>
          <div class="col-7 col-sm-6">
            <p>No Email Address or any contact info in the design submission or messages</p>
            <p> No Flooding with small changes submissions</p>
            <p>No Requesting client's email or contact info</p>
              <p>No Discussions to be made to client regarding fellow designers</p>
             <p>No Stock images or free vectors or using existing logos with minor modifications</p>
             <p>No copying from fellow designers</p>
             <p>No Foul Language during messaging client or fellow desingers</p>
             <p>No Borders around the design submissions</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal footer -->
    <div class="modal-footer">
        <input type="submit" value="Upload" id="sbt_button" class="btn btn-primary orange_bttn">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
      </form>
      </div>

      
      

    </div>
  </div>
</div>
         </div>
      </div>
     </div>
    </div>
      </div>
  </section><!-- #intro -->
     
   <section id="contest-tabs">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <ul class="tab-btns">
                  <li ><a href="<?php echo base_url()."contest/contest_brief/".$contestid?>">Brief</a></li>
                  <li class="active">Designs <span><?php echo $count_designs;?></span></li>
                  <li ><a href="<?php echo base_url()."contest/contest_discussions/".$contestid?>"> Client Uploads
               <?php echo client_contest_discussioncount($single_contest[0]->id, $single_contest[0]->client_id);?> </a></li>
                     <?php if(isset($winningcontest)){
                     if(($single_contest[0]->status =='completed') &&(($user_id==$winningcontest->designer_id)||($user_id==$winningcontest->client_id))){?>
                     <li>
                        <a href="<?php echo base_url()."contest/contest_designpackage/".$contestid?>" class="design_packag"> DESIGN PACKAGE </a> 
                     </li>
                     <?php } } ?>
          <?php if(($user_id==$single_contest[0]->client_id)){?>
          <li><a href="<?php echo base_url()."contest/contest_procedure/".$contestid?>"> Help </a></li>
          <?php } ?>
               </ul>

            </div>
         </div>
      </div>
   </section>

  <main id="main" class="min-height">
   
    <!--==========================
      Winning Stage
    ============================-->


    <?php   

                  if(isset($winningcontest) && !empty($winningcontest)){ 
                  ?>
    <section id="contests-designs" class="winner-block">
      <div class="container">
                   <?php 
                     if(isset($winningcontest) && !empty($winningcontest))
                      {
                           $prvcomments = design_comment($winningcontest->design_id);
                     
                     $pic= $this->Common_model->get_record('designer_table','*',array('users_id'=>$winningcontest->designer_id));
                     $profile_pic=$pic->designer_profile;
                     ?>
      <div class="row design-list">
         <div class="col-md-4 design-item">  
            <span class="design-index">#<?php echo $winningcontest->design_no;?> by <a href="#" style="color: #9b7093 !important;"><?php echo $sign[$winningcontest->designer_id];?></a></span>
            <div class="design-img">

             <?php  if(!empty($profile_pic))
                              {  ?>  
               <!--  <img src="<?php echo base_url();?>assets/images/testimonial-2.jpg" >  -->
                <img src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $winningcontest->design_name?>"> 
               <span>WON</span>
               <div class="desginer-pic">
                  <!--  <img src="<?php echo base_url();?>assets/images/profile-pic.jpg"> -->
                   <img src="<?php echo base_url();?>uploads/designer_profile/<?php echo $profile_pic; ?>">
               </div>
               <?php } else { ?>
                        <img  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $winningcontest->design_name;?>" width="100%" />
                  <span>WON</span>
                <div class="desginer-pic">
                         <img src="<?php echo base_url(); ?>assets/images/designer-signup.png" style="margin-top: -8px;">
                          </div>
                    <?php } ?>
               
            </div>
          
         </div>
         <div class="col-md-7" style="margin:auto;">
            <div class="winning-msg">
               <!-- <span><b>Puretea</b> has selected</span>
               <span><b>Avatar X</b> as the winner from<span>
               <span><b>93</b> designers</span> -->
               <span><p><b><?php echo ucwords(username($winningcontest->client_id));?></b> has selected <b><?php echo ($user_id==$winningcontest->designer_id)?"Yourself":ucwords(username($winningcontest->designer_id));?></b> as the winner. </p></span>
            </div>
         </div>
         <?php }  ?>
      </div>
        <?php } ?>
      </div>
    </section>
   <?php //} ?>
    <!--==========================
      Finalist Stage
    ============================-->
    <section id="contests-designs">
      <div class="container">
          <?php 

                  if(isset($subfinaldesigns) && !empty($subfinaldesigns)) {
                  ?>
                  
      <div class="row">
         
         <div class="col-lg-12 section-header">
            ENTERIES BY FINALIST DESIGNERS
         </div>
         <div class="col-md-4">
         <select size="1"  id="designername1" class="designername1">
                        <option value="all">All Designer Name</option>
                         <?php foreach($finalist_designers as $tmp) { ?>
                           <option value="<?php echo $tmp->designer_id; ?>">
                              <?php echo ucwords($sign[$tmp->designer_id]);?>
                           </option>
                         <?php } ?>
                     </select>
         </div>
         <div class="col-md-4 offset-md-4 text-right">
            <select name="short_by" class="s_rane1" id="rate1">
                        <option>Choose Rating</option>
                        <option value="oldest">Oldest  Rated</option>
                        <option value="latest">Newest Rated</option>
                        <option value="lowrating">Lowest Rated</option>
                        <option value="highrating">Highest  Rated</option>
                     </select>
            
         </div>
      </div>


            <ul class="row design-list ">
                <?php 
                     $sdno=0;
                     if(isset($subfinaldesigns) && !empty($subfinaldesigns)){
                  $rcount=$this->Common_model->get_records_count('designs',array('design_status'=>1,'contest_id'=>$subfinaldesigns[0]->contest_id));
                        foreach($subfinaldesigns as $subfdes) { 
                           $prvcomments = design_comment($subfdes->design_id);
                           $sdno++;
                     ?>
         <li class="col-md-4 design-item entry_box1 design1_<?php echo $subfdes->designer_id; ?>"> 
            <span class="design-index "># 
               <?php echo $subfdes->design_no;?> by <a href="#" style="color: #9b7093 !important;"><?php echo $sign[$subfdes->designer_id];?></a></span>
            <div class="design-img">
             
               <?php   if(($single_contest[0]->status == "open") && ($user_id != $subfdes->client_id) && ($user_id != $subfdes->designer_id)){ ?>  
               <img src="<?php echo base_url(); ?>assets/image/hidden.jpg">
               <?php } elseif($single_contest[0]->pay_option==0 && $usertype =='1'){ ?>
               <img class="imagesize" style="width: 314px!important;" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_watermark;?>">
               <?php } else{ ?>
               <img class="imagesize" style="width: 314px!important;" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_name;?>">
                <?php } ?>
               <!-- <span><input <?php if($user_id != $subfdes->client_id){ } ?>value="<?php echo $subfdes->design_rating; ?>" width="1" type="number" readonly min=0 max=5 step=1 data-size="md"></span> -->
              

                <?php
                              if($subfdes->design_rating>0){?>
                           <?php
                       if(!empty($winningcontest->design_id)){
                          $lstatus=( $winningcontest->design_id== $subfdes->design_id)?"logo-status":"logo-status-grey1";
                       }
                       else {
                          $lstatus="logo-status-grey1";
                       }
                     ?>
                           <span class="<?php echo $lstatus;?>"><?php  echo $sdno."". suffix($sdno); ?></span>
                           <?php }else {?>
                           <!--  <span class="<?php echo $lstatus;?>">
                           <i class="logo-rank"><?php echo $sdno."<span>".suffix($sdno)."</span>";?></i> -->
                           </span> 
                           <?php } ?>
            </div>
            <div class="item-bottom-box">
               <div class="star-rating">
                <div class="row">
                 <!-- <div class="col-md-6"> -->
                                    <!--<input for="<?php echo $subfdes->design_id; ?>" id="input-21b"  <?php 
                                       if($user_id != $subfdes->client_id){ echo 'readonly'; } ?> value="<?php echo $subfdes->design_rating; ?>" type="number" class="rating checkrate" min=0 max=5 step=1 data-size="md">-->
                     
                     
                   <!----Star-->
                      <div id="rateYoc_<?php echo $subfdes->design_id; ?>" style="padding-left: 12px;"></div>
                     <script>
                      $(function () {
                     
                      $("#rateYoc_<?php echo $subfdes->design_id; ?>").rateYo({
                      fullStar: true,
                      rating : <?php echo $subfdes->design_rating; ?>,
                       spacing: "5px",
                       starWidth: "25px",
                      <?php if($user_id != $subfdes->client_id){ ?>
                      readOnly: true
                      <?php } ?>
                      }).on("rateyo.set", function (e, data) { 
                       updateStar(<?php echo $subfdes->design_id; ?>,data.rating);
                      });
                     
                    });
                    </script>
                     <!----Star-->    
                     
                     
                                <!--  </div>
                        <div class="col-md-6"> -->   
                <?php 
                                       if(($user_id == $subfdes->client_id) || (($user_id == $subfdes->designer_id) && (count($prvcomments) > 0))){
                                       ?>
                                  
                                   <a data-target="#finpopup<?php echo $subfdes->design_id; ?>" class="design-btns float-right"   data-toggle="modal" <?php echo $subfdes->design_id; ?> >Comments(<?php echo count($prvcomments); ?>)</a>
                                    <?php } else { ?>     &nbsp;<span class="design-btns">Comments(<?php echo count($prvcomments); ?>)</span>
                                    <?php } ?>
                                 <!--  </div> -->
                                </div>
                              </div>
               <!-- <span class="design-btns float-right" data-toggle="modal" data-target="#myModal"> Comments(3) </span> -->
                <div class="row">
                              <?php
                                 if($rcount==0)
                                 { 
                                 ?>
                              <div class="col-md-12" > 
                                 
                                 <?php if($user_id == $subfdes->client_id){ ?>
                                 <a for='<?php echo $subfdes->design_id;  ?>' data-toggle="modal" data-target="#subfinpopup<?php echo $subfdes->design_id;  ?>" class="choose_winner comment_btn" style="color: #fbb03b; font-size: 1.2em; font-weight: 600;">Choose Winner</a>
                                 <?php } ?>
                              </div>
                              <?php } ?>
                           </div>
            </div>

            <div class="modal fade" id="subfinpopup<?php echo $subfdes->design_id;  ?>">
            <div class="modal-dialog modal-lg">
             <div class="modal-content">

               <!-- Modal Header -->
             <div class="modal-header">
                  <h3>Choose Winner</h3>
                 <button type="button" class="close1" data-dismiss="modal">×</button>
             </div>

               <!-- Modal body -->
             <div class="modal-body">
             <form action="<?php echo base_url();?>contest/winn_contest" name="design_upload" method="post" enctype="multipart/form-data">
            <div class="form-group">
             <label>Do you want to choose  <?php echo strtoupper(username($subfdes->designer_id)); ?> as a winner ?</label>    
                           <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                           <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                           <input type="hidden" name="designid" value="<?php echo $subfdes->design_id; ?>" />
                           <input type="hidden" name="designer_id" value="<?php echo $subfdes->designer_id; ?>" />
                           </br>
                            <div class="row" style="margin-top:20px;">
                              <div class="col-md-6"><img class="imagesize" style="width:320px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_name;?>"  /></div>
                           </div>
                 </div>  
                     <!-- Modal footer -->
               <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Winner</button>
               </div>
               </form>
               </div>
              

             </div>
           </div>
         </div>

                    <div class="modal fade" id="finpopup<?php echo $subfdes->design_id; ?>">
                     <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <!-- Modal Header -->
                       <div class="modal-header">
                          <h4 class="modal-title">Comments</h4>
                          <button type="button" class="close1" data-dismiss="modal">×</button>
                        </div>

                     <!-- Modal body -->
                       <div class="modal-body">
                         <div class="design-img" style="margin-bottom:50px; width: 40%"><img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_name;?>"  /></div>
                           <?php
                           $finalprvcomments = design_comment($subfdes->design_id);
                           
                            if(isset($finalprvcomments) && !empty($finalprvcomments)) { 
                              foreach($finalprvcomments as $tmp3)
                              {
                                
                           ?>
                        <div class="col-sm-12">   
                        <div class="row">
                           <div class="col-8 col-sm-6">
                              <div class="messanger-name"><b><?php echo $tmp3->createdname; ?></b> <?php  if($tmp3->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                           </div>
                           <div class="col-4 col-sm-6">
                           <div class="message-timming"><?php echo date("d-m-Y h:i a",strtotime($tmp3->createddate)); ?></div>
                       </div>
                        </div>
                        </div>
                        <div class="row">
                           <div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp3->comment;?></div>
                        </div>
                        <div class="ro" style="background-color:#f4f2ed; padding:10px; margin-top:10px;">
                        </div>
                        <?php } }  ?>
        <form action="<?php echo base_url();?>contest/contest_privcomment" name="commentform" method="post" enctype="multipart/form-data">
        <div class="col-lg-10 text-left"> 
        <div class=" form-group">
         <label for="email">Comments:</label>
          <textarea rows="5" cols="20" class="form-control" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                           <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                           <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                           <input type="hidden" name="designid" value="<?php echo $subfdes->design_id; ?>" />
                           <input type="hidden" name="designerid" value="<?php echo $subfdes->designer_id; ?>" />
                           </br>
                          <!--  <input type="submit" class="precomm" value="Add Comment"/> -->
        </div>
        </div> 
      
         <footer> 
                   <div class="modal-footer">
        <input type="submit" value="Add Comment" id="sbt_button" class="btn btn-primary orange_bttn">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
                </footer>
                </form>
   </div>
</div>
</div>
</div>
         </li>
         
      
      
      <?php } } ?>
      </div>
      </ul>
      <?php } ?>
    </section>
   
    <!--==========================
      Qualifying Stage
    ============================-->
    <section id="contests-designs">
      <div class="container">
      <div class="row">
         <div class="col-lg-12 section-header">
            ENTERIES FROM QUALIFYING STAGE
         </div>
         <div class="col-md-4">
            <select name="short_by" id="designername" class="designername">
               <option value="all">All Designer Name</option>
               <?php 
               foreach($designersname as $fdes) {
                ?>
               <option value="<?php echo $fdes->designer_id; ?>">
               <?php echo $sign[$fdes->designer_id];?>
               </option>
               <?php } ?>
            </select>
         </div>
         <div class="col-md-4 offset-md-4 text-right">
            <select name="short_by" class="s_rane" id="rate">
               <option>Choose Rating</option>
                        <option value="oldest">Oldest  Rated</option>
                        <option value="latest">Newest Rated</option>
                        <option value="lowrating">Lowest Rated</option>
                        <option value="highrating">Highest  Rated</option>
            </select>
         </div>
      </div>
      <!--  <div class="row"> -->
            <ul class=" row design-list">
       <?php 

                       $dno=0;
                     if(isset($finaldesigns) && !empty($finaldesigns)){
                     
                     ?>          
                  <?php 
                     foreach($finaldesigns as $fdes) {
                        $dno++;
                        $prvcomments = design_comment($fdes->design_id);
                     ?>
                  
         

         <li class="col-md-4 design-item entry_box design_<?php echo $fdes->designer_id; ?>">   
            <span class="design-index"># <?php echo $fdes->design_no;?> by <?php echo ucwords($sign[$fdes->designer_id]);?></a></span>
            <div class="design-img">
               <!-- <img src="<?php echo base_url(); ?>assets/images/testimonial-2.jpg"> -->
               <?php     if( ($single_contest[0]->status == "open") && ($user_id != $fdes->client_id) && ($user_id != $fdes->designer_id) ) {  ?>  
               <img src="<?php echo base_url(); ?>assets/image/hidden.jpg">
               <?php } elseif($single_contest[0]->pay_option==0 && $usertype =='1'){ ?>
               <img class="imagesize" style="width: 314px!important;" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $subfdes->design_watermark;?>">
               <?php } else { ?>
               <img class="imagesize" style="width: 314px!important;" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $fdes->design_name;?>">
                <?php }  if($ctfinaldes >=1){  ?> 
                  <span><?php echo $dno."". suffix($dno); ?></span>
                <!-- <span><input <?php if($user_id != $fdes->client_id){ } ?>value="<?php echo $fdes->design_rating; ?>" width="1" type="number" readonly min=0 max=5 step=1 data-size="md"></span>  -->
               <?php } ?>
                  
            </div>
            <div class="user_review">
           
            <div class="item-bottom-box">
      
                 <div class="star-rating">
         <div class="row">
        <!--  <div class="col-md-6"> -->
                                    <!--<input for="<?php echo $fdes->design_id; ?>" id="input-21b"  <?php 
                                       if($user_id != $fdes->client_id){ echo 'readonly'; } ?> value="<?php echo $fdes->design_rating; ?>" type="number" class="rating checkrate" min=0 max=5 step=1 data-size="md">-->
                     
                     <!----Star-->
                      <div id="rateYo_<?php echo $fdes->design_id; ?>" style="padding-left: 12px;"></div>
                     <script>
                      $(function () {
                     
                      $("#rateYo_<?php echo $fdes->design_id; ?>").rateYo({
                      fullStar: true,
                      rating : <?php echo $fdes->design_rating; ?>,
                       spacing: "5px",
                       starWidth: "25px",
                      <?php if($user_id != $fdes->client_id){ ?>
                      readOnly: true
                      <?php } ?>

                      }).on("rateyo.set", function (e, data) { 
                        updateStar(<?php echo $fdes->design_id; ?>,data.rating);
                      });
                     
                    });
                    </script>
                     <!----Star-->
                     
                     
                    <!--  </div>
           <div class="col-md-6"> -->                            
           
               
                <?php 
                                       if(($user_id == $fdes->client_id) || (($user_id == $fdes->designer_id) && (count($prvcomments) > 0))){
                                       ?>
                                   <a data-target="#myModal2<?php echo $fdes->design_id; ?>"  class="design-btns "   data-toggle="modal" <?php echo $fdes->design_id; ?> >Comments(<?php echo count($prvcomments); ?>)</a>
                                    <?php } else { ?>     &nbsp;<span class="design-btns" >Comments(<?php echo count($prvcomments); ?>)</span>
                                    <?php } ?>
       <!--  </div>  --> 
      
        </div>  
        </div>  
               <!-- <span class="design-btns float-right" data-toggle="modal" data-target="#myModal"> Comments(3) </span> -->
                <?php 
                              if($ctfinaldes >=1   && $usertype == 0 && $user_id == $fdes->client_id && $win_design !=  1 && $single_contest[0]->status == "judging")
                                 { ?>
                    <div class="row" style="margin-top:10px;">
                           <div class="col-md-6 col-xs-12">
                     <a  for='<?php echo $fdes->design_id;  ?>'  data-toggle="modal" data-target="#apopup<?php echo $fdes->design_id;  ?>"  class="choose_winner comment_btn" style="color: #fbb03b; font-size: 1.2em; font-weight: 600;" >Choose Winner</a>
                           </div>
                          </div>
                           <?php }
                              ?>
            </div>
               <?php   
                  
                    if($user_id != $fdes->client_id){ 
                           $bv=$fdes->design_id;
                           $us=$this->Common_model->get_records_count('design_likes',array('user_id'=>$user_id,'design_id'=>$bv));
                           
                           ?>
                            <div id="demo" class="entry_options">
                          <div class="wrapper">
                              <?php 
                               
                              if(($fdes->designer_id != $user_id) && ($single_contest[0]->status != "open")){ 
                                 ?>
                            <div class="content"> 
                                 <ul>
                                    <?php 
                                    if($usertype!=0)
                                       { ?>
                                    <!-- <a data-modal-id="spopup<?php echo $fdes->design_id; ?>" class="rep"> -->
                                        <a data-toggle="modal" data-target="#spopup<?php echo $fdes->design_id; ?>">
                                       <li><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report</li>
                                    </a>
                                    <?php } ?>
                                    <li class="sa"><a  class="like_design" data-id="<?php echo $fdes->design_id;?>"  <?php  if($us!=0){ ?> disabled <?php }?>
                                       ><i class="fa fa-heart" aria-hidden="true"></i> Like(<span class="lcount" > <?php echo $us ?> </span>)</a>
                                    </li>
                                 </ul>
                               </div>
                              <div  class="parent"><img  src="<?php 
                echo base_url(); ?>assets/images/like-im.png"></div>
                              <?php 
                                 } ?>
                          </div> 
                        </div>
                        <?php } ?> 
                 
</div>
                           <!-- report & command & choose winner missiong -->
                                         <div class="modal fade" id="spopup<?php echo $fdes->design_id; ?>">
            <div class="modal-dialog modal-lg">
             <div class="modal-content">

               <!-- Modal Header -->
               <div class="modal-header">
               <h3>Report Logo Design Violation</h3>
                 <button type="button" class="close1" data-dismiss="modal">×</button>
               </div>

               <!-- Modal body -->
               <div class="modal-body">
 <form action="<?php echo base_url();?>contest/report_contest" name="design_upload" method="post"enctype="multipart/form-data" >                <label>I want to report:</label>    
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
                      <div class="report_form">          
                         <p>Note: Please file a report only when your designs being copied.</p>                      
                 <div class="form-group">
                   <label class="control-label col-sm-2 url_text" for="email">Your Design (#):</label>
                                 <div class="col-sm-12">
                                    <input type="text" class="form-control userdesign_id"  name="userdesign" required>
                                    <div class="help-block check22"></div>
                                 </div>
                 </div>
                 <div class="form-group">
                   <label class="control-label col-sm-2" for="pwd">Design(#) that copying yours:</label>
                                 <div class="col-sm-12"> 
                                    <input type="text" class="form-control" id="pwd" name="copydesign" value="<?php echo $fdes->design_no; ?>" readonly>
                                 </div>
                 </div>
                  <div class="form-group">
                                 <label class="control-label col-sm-2" for="pwd">Your Message To Moderator:</label>
                                 <div class="col-sm-12"> 
                                    <textarea class="form-control" name="msg" required></textarea>
                                 </div>
                              </div>
                               <input type="hidden" value="<?php echo base64_encode($current_page);?>" name="rpage">
                              <input type="hidden" value="<?php echo $single_contest[0]->id;?>" name="contest_id">   
                           </div>
                            <!-- Modal footer -->
               <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
                 <button type="submit" class="btn btn-primary" >Report</button>
               </div>
               </form>
               </div>
             </div>
           </div>
         </div>         
                           <div class="modal fade" id="myModal2<?php echo $fdes->design_id; ?>">
                     <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <!-- Modal Header -->
                       <div class="modal-header">
                          <h4 class="modal-title">Comments</h4>
                          <button type="button" class="close1" data-dismiss="modal">×</button>
                        </div>

                     <!-- Modal body -->
                       <div class="modal-body">
                         <div class="design-img" style="margin-bottom:50px; width: 40%"><img class="imagesize" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $fdes->design_name;?>"  /></div>
                               <?php
                           foreach($prvcomments as $tmp2)
                           {
                           ?>
                        <div class="col-sm-12">   
                        <div class="row">
                           <div class="col-8 col-sm-6">
                              <div class="messanger-name"><b><?php echo $tmp2->createdname; ?></b> <?php  if($tmp2->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                           </div>
                           <div class="col-4 col-sm-6">
                           <div class="message-timming"><?php echo date("d-m-Y h:i a",strtotime($tmp2->createddate)); ?></div>
                       </div>
                        </div>
                        </div>
                        <div class="row">
                           <div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp2->comment;?></div>
                        </div>
                        <div class="ro" style="background-color:#f4f2ed; padding:10px; margin-top:10px;">
                        </div>
                        <?php }  ?>
        <form action="<?php echo base_url();?>contest/contest_privcomment" name="commentform" method="post" enctype="multipart/form-data">
        <div class="col-lg-10 text-left"> 
        <div class=" form-group">
         <label for="email">Comments:</label>
          <textarea rows="5" cols="20" class="form-control" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                           <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                           <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                           <input type="hidden" name="designid" value="<?php echo $fdes->design_id; ?>" />
                           <input type="hidden" name="designerid" value="<?php echo $fdes->designer_id; ?>" />
                           </br>
                          <!--  <input type="submit" class="precomm" value="Add Comment"/> -->
        </div>
        </div> 
      
         <footer> 
                   <div class="modal-footer">
        <input type="submit" value="Add Comment" id="sbt_button" class="btn btn-primary orange_bttn">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
                </footer>
                </form>
   </div>
</div>
</div>
</div>
         <div class="modal fade" id="apopup<?php echo $fdes->design_id;  ?>">
            <div class="modal-dialog modal-lg">
             <div class="modal-content">

               <!-- Modal Header -->
             <div class="modal-header">
                  <h3>Choose Winner</h3>
                 <button type="button" class="close1" data-dismiss="modal">×</button>
             </div>

               <!-- Modal body -->
             <div class="modal-body">
             <form action="<?php echo base_url();?>contest/winn_contest" name="design_upload" method="post" enctype="multipart/form-data">
            <div class="form-group">
             <label>Do you want to choose  <?php echo strtoupper(username($fdes->designer_id)); ?> as a winner ?</label>    
                           <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                           <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                           <input type="hidden" name="designid" value="<?php echo $fdes->design_id; ?>" />
                           <input type="hidden" name="designer_id" value="<?php echo $fdes->designer_id; ?>" />
                           </br>
                            <div class="row" style="margin-top:20px;">
                              <div class="col-md-6"><img class="imagesize" style="width:320px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $fdes->design_name;?>"  /></div>
                           </div>
                 </div>  
                   <!-- Modal footer -->
               <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary" >Winner</button>
               </div>
               </form>
               </div>
                

             </div>
           </div>
         </div>
                                
         </li>

      
      
      <?php } } ?>
     
     <!--  </ul> -->
      <?php //} ?>
           <!-- <ul class="row design-list"> -->
                  <?php    
               
             if(!empty($designs))
                     {
                      /*  echo'two';
                        print_r($designs);exit;*/
                        //echo'777';exit;
                  foreach($designs as $des) {
                   
                     $dno++;
           
                     $prvcomments = design_comment($des->design_id);
          
                        ?>
                        <!--   <div class="container"> -->
                       
                          
                        <li class="col-md-4 design-item entry_box design_<?php echo $des->designer_id; ?>">
                      <div class="design-index">
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
                           # <?php echo $des->design_no;?> by <a href="#" style="color: #9b7093 !important;"> <?php echo ucwords($sign[$des->designer_id]);?></a>
                        </div>
                        <div class="design-img">
                     <?php if($des->display_status==1){
                     ?>
                        <span class="withdraw-box"></span>
                        <span class="withdraw-msg">Widthdrawn</span>
                     <?php
                     }
                     ?>
                           <?php  if(($single_contest[0]->status == "open"||$single_contest[0]->status == "judging")&&($ctfinaldes<2) && ($user_id != $des->client_id) && ($user_id != $des->designer_id) ) {  ?>
                           <img class="imagesize" style="width:320px!important;"  src="<?php echo base_url(); ?>assets/image/hidden.jpg"  />
                           <?php } elseif($single_contest[0]->pay_option==0 && $usertype =='1'){ ?>
                     <img class="imagesize" style="width:320px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_watermark;?>">
                           <?php } else {  ?>
                           <img class="imagesize <?php //echo ($des->display_status==1)?"blur-img":"";?>" style="width:320px!important;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  />
                           <?php } 
                              if($des->design_rating >0)
                              { 
                    ?>
                    <span style="background: rgba(90, 90, 90, 0.8);"><?php echo $dno."". suffix($dno); ?></span>
                           <?php } else{?>
                     
                           <?php } ?>
                        </div>
                      <div class="user_review">
                    <div class="row">
                          <!--  <div class="col-sm-6"> -->
                               <div class="star-rating">
                                 <!--<input for="<?php echo $des->design_id; ?>" id="input-21b"  <?php 
                                    if($user_id != $des->client_id){ echo 'readonly'; } ?> value="<?php echo $des->design_rating; ?>" type="number" class="rating checkrate" min=0 max=5 step=1 data-size="md">-->
                  
                  
                    <!----Star-->
                      <div id="rateYoa_<?php echo $des->design_id; ?>" style="padding-left: 12px;"></div>
                     <script>
                      $(function () {
                     
                      $("#rateYoa_<?php echo $des->design_id; ?>").rateYo({
                      fullStar: true,
                      rating : <?php echo $des->design_rating; ?>,
                       spacing: "5px",
                       starWidth: "25px",
                      <?php if($user_id != $des->client_id){ ?>
                      readOnly: true
                      <?php } ?>
                      }).on("rateyo.set", function (e, data) { 
                        updateStar(<?php echo $des->design_id; ?>,data.rating);
                      });
                     
                    });
                    </script>
                     <!----Star-->  
                  
                  
                              </div>
                  
                             
                           <!-- </div>
                           <div class="col-sm-6"> -->
                                  <div class="item-bottom-box">
                              <div class="commend">                              
                                 <?php 
                                    if(($user_id == $des->client_id) || (($user_id == $des->designer_id) && (count($prvcomments) > 0))){
                                    ?>
                                    
                                  <a  data-target="#popup_<?php echo $des->design_id;?>" class="design-btns " data-toggle="modal">
                          Comments  <?php echo "(".count($prvcomments).")"; ?></a>
                                 <?php } else { ?> <span class="design-btns ">Comments <?php echo "(".count($prvcomments).")"; ?></span>
                                 <?php } ?>
                              </div>
                              </div>
                         <!--   </div> -->
                          </div>
                           <?php if($user_id == $des->client_id && $single_contest[0]->status == "judging"){?>
                    <div class="row" style="margin-top:10px;">
                              <!--
                                 <div class="col-md-6" > <a  for='<?php echo $des->design_id;  ?>'  data-modal-id="apopup<?php echo $des->design_id; ?>" class="comment_btn" >Choose Winner</a>
                                 </div>   
                                 -->
                              <div class="col-md-12">
                                 <?php                          
                                    $lcount=$this->Common_model->get_records_count('designs',array('final_status'=>1,'contest_id'=>$des->contest_id,'designer_id'=>$des->designer_id));
                                    
                                    if(isset($ctfinaldes) && ($ctfinaldes < 2) && ($lcount==0) && (payment_status($single_contest[0]->id)==1)){ 
                                 ?>
                                  <a data-toggle="modal" data-target="#bpopup<?php echo $des->design_id;  ?>" class="comment_btn" style="color: #fbb03b; font-size: 1.2em; font-weight: 600;">Choose Finalist</a>
                                 <?php }
                                    else if($ctfinaldes==2)
                                    { 
                                    ?>
                                    <a for='<?php echo $des->design_id;  ?>' data-toggle="modal" data-target="#apopup<?php echo $des->design_id;  ?>" class="choose_winner comment_btn" style="color: #fbb03b; font-size: 1.2em; font-weight: 600;">Choose Winner</a>
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
                                    <?php if($usertype!=0)
                                       {    ?>
                                    <a data-toggle="modal" data-target="#rpopup<?php echo $des->design_id; ?>">
                                       <li><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report</li>
                                    </a>
                                    <?php }  ?>

                                    <li><a class="like_design" data-id="<?php echo $des->design_id;?>" <?php if($ls!=0){ ?> disabled <?php }?>
                                       ><i class="fa fa-heart" aria-hidden="true"></i> Likes(<span class="lcount"><?php echo $ls ?> </span>) </a>
                                   </li>
                               </ul>
                              </div>
                              <div class="parent"><img src="<?php echo base_url(); ?>assets/images/like-im.png"></div>
                              <?php 
                                 } 
                                 elseif(($des->designer_id == $user_id) && ($single_contest[0]->status != "Completed")){ ?>
                              <div class="content">
                                 <ul>
                                     <a for='<?php echo $des->design_id;  ?>'data-toggle="modal"  data-target="#withdraw_pop<?php echo $des->design_id; ?>" >
                                       <li><i class="fa fa-download" aria-hidden="true" ></i> Withdraw</li>
                                    </a>
                                 </ul>
                              </div>
                              <div class="parent"><img src="<?php echo base_url(); ?>assets/images/like-im.png"></div>
                              <?php } ?>
                           </div>
                        </div>
                        <?php } ?>  
                 
          
                   <!---------------POP BOX--------------->
                   <div class="modal fade" id="rpopup<?php echo $des->design_id; ?>">
            <div class="modal-dialog modal-lg">
             <div class="modal-content">

               <!-- Modal Header -->
               <div class="modal-header">
               <h3>Report Logo Design Violation</h3>
                 <button type="button" class="close1" data-dismiss="modal">×</button>
               </div>

               <!-- Modal body -->
               <div class="modal-body">
 <form action="<?php echo base_url();?>contest/report_contest" name="design_upload" method="post" enctype="multipart/form-data">                <label>I want to report:</label>    
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
                      <div class="report_form">          
                         <p>Note: Please file a report only when your designs being copied.</p>                      
                 <div class="form-group">
                   <label class="control-label col-sm-2 url_text" for="email">Your Design (#):</label>
                                 <div class="col-sm-12">
                                    <input type="text" class="form-control userdesign_id"  name="userdesign" required>
                                    <div class="help-block check22"></div>
                                 </div>
                 </div>
                 <div class="form-group">
                   <label class="control-label col-sm-2" for="pwd">Design(#) that copying yours:</label>
                                 <div class="col-sm-12"> 
                                    <input type="text" class="form-control" id="pwd" name="copydesign" value="<?php echo $des->design_no; ?>" readonly>
                                 </div>
                 </div>
                  <div class="form-group">
                                 <label class="control-label col-sm-2" for="pwd">Your Message To Moderator:</label>
                                 <div class="col-sm-12"> 
                                    <textarea class="form-control" name="msg" required></textarea>
                                 </div>
                              </div>
                               <input type="hidden" value="<?php echo base64_encode($current_page);?>" name="rpage">
                              <input type="hidden" value="<?php echo $single_contest[0]->id;?>" name="contest_id">   
                           </div>
                              <!-- Modal footer -->
               <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
                 <button type="submit" class="btn btn-primary">Report</button>
               </div>
               </form>
               </div>

            

             </div>
           </div>
         </div>

         <div class="modal fade" id="bpopup<?php echo $des->design_id;  ?>">
            <div class="modal-dialog modal-lg">
             <div class="modal-content">

               <!-- Modal Header -->
             <div class="modal-header">
                  <h3>Choose A Finalist</h3>
                 <button type="button" class="close1" data-dismiss="modal">×</button>
             </div>

               <!-- Modal body -->
             <div class="modal-body">
             <form action="<?php echo base_url();?>contest/final_contest" name="design_upload" method="post" enctype="multipart/form-data">
            <div class="form-group">
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
                   <!-- Modal footer -->
               <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Finalist</button>
               </div> 
               </form>
               </div>
                

             </div>
           </div>
         </div>
                
                <div class="modal fade" id="apopup<?php echo $des->design_id;  ?>">
            <div class="modal-dialog modal-lg">
             <div class="modal-content">

               <!-- Modal Header -->
             <div class="modal-header">
                  <h3>Choose Winner</h3>
                 <button type="button" class="close1" data-dismiss="modal">×</button>
             </div>

               <!-- Modal body -->
             <div class="modal-body">
             <form action="<?php echo base_url();?>contest/winn_contest" name="design_upload" method="post" enctype="multipart/form-data">
            <div class="form-group">
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
                    <!-- Modal footer -->
               <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary" >Winner</button>
               </div>
               </form>
               </div>
               

             </div>
           </div>
         </div>
            <div class="modal fade" id="withdraw_pop<?php echo $des->design_id; ?>">
            <div class="modal-dialog modal-lg">
             <div class="modal-content">

               <!-- Modal Header -->
             <div class="modal-header">
                 <h3>Withdraw A Design</h3>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>

               <!-- Modal body -->
             <div class="modal-body">
            <form action="<?php echo base_url();?>contest/withdraw_design" name="design_upload" method="post">
            <div class="form-group">
            <label>Do you want to withdraw the design?</label>    
                <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id;?>" />
                <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                       </br> 
                 </div> 
                  <!-- Modal footer -->
               <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                 <button type="submit" class="btn btn-primary" >Yes, Do It</button>
               </div> 
               </form>
               </div>

              

             </div>
           </div>
         </div>
         <div class="modal fade" id="popup_<?php echo $des->design_id;?>">
                     <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <!-- Modal Header -->
                       <div class="modal-header">
                          <h4 class="modal-title">Comments</h4>
                          <button type="button" class="close1" data-dismiss="modal">×</button>
                        </div>

                     <!-- Modal body -->
                       <div class="modal-body">

                         <div class="design-img" ><img class="imagesize" style="margin-bottom: 50px;width: 40%;"  src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $des->design_name;?>"  /></div>
                               <?php
                           if(isset($prvcomments) && !empty($prvcomments)) { 
                              foreach($prvcomments as $tmp2)
                              {
                           ?>
                        <div class="col-sm-12">   
                        <div class="row">
                           <div class="col-8 col-sm-6">
                               <div class="messanger-name"><b><?php echo $tmp2->createdname; ?></b> <?php  if($tmp2->createdtype == 0){ echo "Client"; } else { echo "Designer"; } ?> </div>
                           </div>
                           <div class="col-4 col-sm-6">
                           <div class="message-timming"><?php echo date("d-m-Y h:i a",strtotime($tmp2->createddate)); ?></div>
                       </div>
                        </div>
                        </div>
                        <div class="row">
                           <div style="margin-top:10px; margin-left:20px;" class="col-md-12 col-lg-12"><?php echo $tmp2->comment;?></div>
                        </div>
                        <div class="ro" style="background-color:#f4f2ed; padding:10px; margin-top:10px;">
                        </div>
                        <?php } } ?>
        <form action="<?php echo base_url();?>contest/contest_privcomment" name="commentform" method="post" enctype="multipart/form-data">
        <div class="col-lg-10 text-left"> 
        <div class=" form-group">
         <label for="email">Comments:</label>
          <textarea rows="5" cols="20" class="form-control" id="prvmsg_box" name="prvmsg_box" required ></textarea>
                           <input type="hidden" name="contestid" value="<?php echo $single_contest[0]->id; ?>" />
                           <input type="hidden" name="clientid" value="<?php echo $single_contest[0]->client_id; ?>" />
                           <input type="hidden" name="designid" value="<?php echo $des->design_id; ?>" />
                           <input type="hidden" name="designerid" value="<?php echo $des->designer_id; ?>" />
                           </br>
                          <!--  <input type="submit" class="precomm" value="Add Comment"/> -->
        </div>
        </div> 
      
         <footer> 
                   <div class="modal-footer">
        <input type="submit" value="Add Comment" id="sbt_button" class="btn btn-primary orange_bttn">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
                </footer>
                </form>
   </div>
</div>
</div>
</div>

                  <!------------------------------------->
   <?php /*<div class="modal fade" id="myModal2">
   <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
     <div class="modal-header">
        <h4 class="modal-title">Comments</h4>
        <button type="button" class="close1" data-dismiss="modal">×</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="<?php echo base_url();?>contest/design_upload" name="design_upload" id="design_upload"  method="post" enctype="multipart/form-data">
        <div class="col-lg-8 text-left">  
        <div class=" form-group">
         <label for="email">Comments:</label>
         <textarea class="form-control" name="comments"></textarea>
        </div>
        </div> 
      </form>
   </div>
</div>
</div>
</div>*/ ?>

 </li>
                
             
            <?php }
                     }
                else if(empty($designs) && $ctfinaldes==0){ 
                        echo "<center><h4 style='color:red'>No design<h4>";
                    }
                ?>
 </ul>
        <?php //echo pagination("admin/contest_entries",$count_contests,20);?>
      </div>
    </section>
   
  </main>

 
    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <script>
      /*mano*/
 $(document).ready(function(){

    var count = $("#contest-title").text().length;
/*alert(count);*/
if(parseInt(count) > 23) 
{
   $('#contest-title').css('font-size','33px');

}
if(parseInt(count) > 34) 
{
   $('#contest-title').css('font-size','30px');
}
 

  });
 /*mano*/

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

<!----Star Ajax----->
function updateStar(desid,rateval){
  
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
    
}
<!----Star Ajax----->





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
<!--<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>-->
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
//}
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
<!-- <script>
$(document).ready(function(){
   $("#myModal1").hide();
   $("#sbt_btn").click(function(){
      $("#myModal1").show();
   });
});
</script>
<script>
   $(".close1").click(function(){
      $("#myModal1").hide();
   });
</script> -->  


