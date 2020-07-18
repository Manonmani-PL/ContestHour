<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
   <!-- BEGIN SIDEBAR -->
   <div class="page-sidebar navbar-collapse collapse">
      <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
         <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
         <li class="sidebar-toggler-wrapper hide">
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <div class="sidebar-toggler"> </div>
            <!-- END SIDEBAR TOGGLER BUTTON -->
         </li>
         <li class="nav-item <?php if(($page_name=='client')||($page_name=='designer')){echo 'active open';}?>  ">
            <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-user"></i>
            <span class="title">User</span>
            <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
               <li class="<?php if($page_name=='client'){echo 'nav-item active open';}?>  ">
                  <a href="<?php echo base_url(); ?>admin_panel/view_page" class="nav-link ">
                  <i class="icon-notebook"></i>
                  <span class="title">Client</span>
                  </a>
               </li>
               <li class="<?php if($page_name=='designer'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/view_page_designer" class="nav-link ">
                  <i class="icon-notebook"></i>
                  <span class="title">Designer</span>
                  </a>
               </li>
                <li class="<?php if($page_name=='referral'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/view_page_referral" class="nav-link ">
                  <i class="icon-notebook"></i>
                  <span class="title">Referral</span>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-item <?php if(($page_name=='new_con')||($page_name=='open_con')||($page_name=='jud_con')||($page_name=='com_con')||($page_name=='in_draft')||($page_name=='view_con')){echo 'active open';}?>">
            <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-diamond"></i>
            <span class="title">Contest</span>
            <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
               <!--
                <li class="<?php if($page_name=='new_con'){echo 'nav-item active open';}?>">
					<a href="<?php echo base_url(); ?>admin_panel/new_contest" class="nav-link ">
					<i class="fa fa-asterisk"></i>
					<span class="title">New Contest</span>
					</a>
				</li>
                  -->
               <li class="<?php if($page_name=='open_con'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/open_contest" class="nav-link ">
                  <i class="fa fa-angellist"></i>
                  <span class="title">Open Contest</span>
                  </a>
               </li>
               <li class="<?php if($page_name=='jud_con'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/judging_contest" class="nav-link ">
                  <i class="fa fa-shield"></i>
                  <span class="title">Judging Contest</span>
                  </a>
               </li>
               <li class="<?php if($page_name=='com_con'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/completed_contest" class="nav-link ">
                  <i class="fa fa-star"></i>
                  <span class="title">Completed Contest</span>
                  </a>
               </li>
               <li class="<?php if($page_name=='in_draft'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/draft_contest" class="nav-link ">
                  <i class="fa fa-star-half-o"></i>
                  <span class="title">In Draft</span>
                  </a>
               </li>
            </ul>
         </li>
         <?php /*
            <li class="nav-item <?php if(($page_name=='payment_request')){echo 'active open';}?>  ">
         <a href="javascript:;" class="nav-link nav-toggle">
         <i class="fa fa-money"></i>
         <span class="title">Payment Process</span>
         <span class="arrow"></span>
         </a>
         <ul class="sub-menu">
            <li class="<?php if($page_name=='payment_request'){echo 'nav-item active open';}?>">
               <a href="<?php echo base_url(); ?>admin_panel/payment_request" class="nav-link">
               <i class="icon-notebook"></i>
               <span class="title">Payment Requests</span>
               </a>
            </li>
            <li class="<?php if($page_name=='payment_request'){echo 'nav-item active open';}?>  ">
               <a href="<?php echo base_url(); ?>admin_panel/completed_payment_request" class="nav-link ">
               <i class="icon-notebook"></i>
               <span class="title">Completed Payments</span>
               </a>
            </li>
         </ul>
         </li> 
         <li class="nav-item <?php if(($page_name=='payment_request')){echo 'active open';}?>  ">
            <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-money"></i>
            <span class="title">Design Court</span>
            <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
               <li class="<?php if($page_name=='payment_request'){echo 'nav-item active open';}?>  ">
                  <a href="<?php echo base_url(); ?>admin_panel/package_contest" class="nav-link ">
                  <i class="icon-notebook"></i>
                  <span class="title">New Design Reports</span>
                  </a>
               </li>
            </ul>
         </li>
         */ ?>
         <li class="nav-item <?php if(($page_name=='package_con'||$page_name=='contest_price_setting'||$page_name=='category_pricing_setting')){echo 'active open';}?>  ">
            <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-cog"></i>
            <span class="title">Setting</span>
            <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
               <li class="<?php if($page_name=='category_pricing_setting'){echo 'nav-item active open';}?>  ">
                  <a href="<?php echo base_url(); ?>admin_panel/category_pricing_setting" class="nav-link ">
                  <i class="icon-notebook"></i>
                  <span class="title">Category Pricing </span>
                  </a>
               </li>
               <li class="<?php if($page_name=='bestbuy_category_pricing_setting'){echo 'nav-item active open';}?>  ">
                  <a href="<?php echo base_url(); ?>admin_panel/bestbuy_category_pricing_setting" class="nav-link ">
                  <i class="icon-notebook"></i>
                  <span class="title">Bestbuy Category Pricing </span>
                  </a>
               </li>
               <li class="<?php if($page_name=='package_con'){echo 'nav-item active open';}?>  ">
                  <a href="<?php echo base_url(); ?>admin_panel/package_contest" class="nav-link ">
                  <i class="icon-notebook"></i>
                  <span class="title">Payment Package </span>
                  </a>
               </li>
               <li class="<?php if($page_name=='bestbuy_package_contest'){echo 'nav-item active open';}?>  ">
                  <a href="<?php echo base_url(); ?>admin_panel/bestbuy_package_contest" class="nav-link ">
                  <i class="icon-notebook"></i>
                  <span class="title">Bestbuy Payment Package </span>
                  </a>
               </li>
               <li class="<?php if($page_name=='contest_price_setting'){echo 'nav-item active open';}?>  ">
                  <a href="<?php echo base_url(); ?>admin_panel/contest_price_setting" class="nav-link ">
                  <i class="icon-notebook"></i>
                  <span class="title">Contest Price Setting</span>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-item <?php if($page_name=='new_reports'||$page_name=='old_reports'){echo 'active open';}?>">
            <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-info"></i>
            <span class="title">Design Court</span>
            <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
               <li class="<?php if($page_name=='new_reports'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url();?>Admin_panel/new_reports" class="nav-link ">
                  <i class="icon-notebook"></i> <span class="title">New Rports </span>
                  </a>
               </li>
               <li class="<?php if($page_name=='old_reports'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url();?>Admin_panel/old_reports" class="nav-link ">
                  <i class="icon-notebook"></i> <span class="title">Old Reports </span>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-item <?php if(($page_name=='view_payment_rquest')||($page_name=='request_complete')){echo 'active open';}?>">
            <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-briefcase"></i>
            <span class="title">Payment Request</span>
            <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
               <li class="<?php if($page_name=='view_payment_rquest'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>Admin_panel/view_payment_rquest" class="nav-link">
                  <i class="icon-notebook"></i>
                  <span class="title">New Payment Request</span>
                  </a>
               </li>
               <li class="<?php if($page_name=='request_complete'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/payment_request_complete" class="nav-link">
                  <i class="icon-notebook"></i>
                  <span class="title">Complete Request</span>
                  </a>
               </li>
               <li class="<?php if($page_name=='view_referral_payment_request'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>Admin_panel/view_referral_payment_request" class="nav-link">
                  <i class="icon-notebook"></i>
                  <span class="title">New Referral Payment Request</span>
                  </a>
               </li>
                 <li class="<?php if($page_name=='referral_request_complete'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/referral_payment_request_complete" class="nav-link">
                  <i class="icon-notebook"></i>
                  <span class="title">Complete Referral Request</span>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-item <?php if(($page_name=='designer_bonus')||($page_name=='designer_bonus_list')){echo 'active open';}?>">
            <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-briefcase"></i>
            <span class="title">Designer Bonus</span>
            <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
               <li class="<?php if($page_name=='designer_bonus'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/designer_bonus" class="nav-link">
                  <i class="icon-notebook"></i>
                  <span class="title">Designer Bonus</span>
                  </a>
               </li>
               <li class="<?php if($page_name=='designer_bonus_list'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/designer_bonus_list" class="nav-link">
                  <i class="icon-notebook"></i>
                  <span class="title">Bonus List</span>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-item <?php if(($page_name=='contest_report'|| $page_name=='bestbuy_report')){echo 'active open';}?>">
            <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-briefcase"></i>
            <span class="title">Reports</span>
            <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
               <li class="<?php if($page_name=='contest_report'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/contest_report" class="nav-link">
                  <i class="icon-notebook"></i>
                  <span class="title">Contest Report</span>
                  </a>
               </li>
               <li class="<?php if($page_name=='bestbuy_report'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/bestbuy_report" class="nav-link">
                  <i class="icon-notebook"></i>
                  <span class="title">Bestbuy Report</span>
                  </a>
               </li>
                <li class="<?php if($page_name=='coupon_report'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/referral_report" class="nav-link">
                  <i class="icon-notebook"></i>
                  <span class="title">Referral Report</span>
                  </a>
               </li>
               <li class="<?php if($page_name=='referral_userpayment_report'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/referral_userpayment_report" class="nav-link">
                  <i class="icon-notebook"></i>
                  <span class="title">Referral User Payment Report</span>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-item <?php if(($page_name=='support_list')){echo 'active open';}?>">
            <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-briefcase"></i>
            <span class="title">Contact Support</span>
            <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
               <li class="<?php if($page_name=='support_list'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/support_list" class="nav-link">
                  <i class="icon-notebook"></i>
                  <span class="title">Support List</span>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-item <?php if(($page_name=='announcements')||($page_name=='announcement_view')){echo 'active open';}?>">
            <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-briefcase"></i>
            <span class="title">Announcement</span>
            <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
               <li class="<?php if($page_name=='announcements'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/announcements" class="nav-link">
                  <i class="icon-notebook"></i>
                  <span class="title">Announcement</span>
                  </a>
               </li>
               <li class="<?php if($page_name=='announcement_view'){echo 'nav-item active open';}?>">
                  <a href="<?php echo base_url(); ?>admin_panel/announcement_view" class="nav-link">
                  <i class="icon-notebook"></i>
                  <span class="title">Announcement View</span>
                  </a>
               </li>
            </ul>
         </li>
		 <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-folder"></i>
                <span class="title">Mailer </span>
                <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="<?php echo base_url()?>mailer/index" class="nav-link">
                        <i class="icon-bar-chart"></i> Send Mail </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-settings"></i> Groups
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">						
                        <li class="nav-item">
                            <a href="<?php echo base_url()?>mailer/newgroup" class="nav-link">
                                <i class="icon-camera"></i> Create New Group</a>
                        </li>
						<?php 
							$groups= mail_groups();
							if(!empty($groups)){
						?>
                        <li class="nav-item">
                            <a href="javascript:;" target="_blank" class="nav-link">
                                <i class="icon-user"></i> List Of Groups
                                <span class="arrow nav-toggle"></span>
                            </a>
                            <ul class="sub-menu">
							<?php foreach ($groups as $tmp){?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url()?>mailer/grouplist/<?php echo $tmp->group_id;?>" class="nav-link">
                                        <i class="icon-power"></i> <?php echo $tmp->group_title;?></a>
                                </li>
							<?php } ?>
                            </ul>
                        </li>
						<?php } ?>
                    </ul>
                </li>
				<!--
                <li class="nav-item">
                    <a href="javascript:;" target="_blank" class="nav-link">
                        <i class="icon-globe"></i> Templates
                        <span class="arrow nav-toggle"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-tag"></i> Create New</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-pencil"></i> Saved </a>
                        </li>
                    </ul>
                </li>-->
            </ul>
         </li>
         <!--<li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-folder"></i>
                <span class="title">Multi Level Menu</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-settings"></i> Item 1
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="javascript:;" target="_blank" class="nav-link">
                                <i class="icon-user"></i> Arrow Toggle
                                <span class="arrow nav-toggle"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-power"></i> Sample Link 1</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-paper-plane"></i> Sample Link 1</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="icon-star"></i> Sample Link 1</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-camera"></i> Sample Link 1</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-link"></i> Sample Link 2</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-pointer"></i> Sample Link 3</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" target="_blank" class="nav-link">
                        <i class="icon-globe"></i> Arrow Toggle
                        <span class="arrow nav-toggle"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-tag"></i> Sample Link 1</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-pencil"></i> Sample Link 1</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-graph"></i> Sample Link 1</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="icon-bar-chart"></i> Item 3 </a>
                </li>
            </ul>
            </li>-->
      </ul>
      <!-- END SIDEBAR MENU -->
      <!-- END SIDEBAR MENU -->
   </div>
   <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->