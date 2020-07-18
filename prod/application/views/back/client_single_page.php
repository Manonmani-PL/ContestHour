<!-- BEGIN CONTAINER -->
<div class="page-container">
   <?php require('include/side_bar.php'); ?>        
   <!-- BEGIN CONTENT -->
   <div class="page-content-wrapper">
      <!-- BEGIN CONTENT BODY -->
      <div class="page-content">
         <?php 
            $client_con = array();
            foreach ($country as $con){
            	$client_con[$con->country_code]=$con->country_name;
            }
            ?>
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN EXAMPLE TABLE PORTLET-->
               <div class="portlet-body form">
                  <!-- BEGIN FORM-->
                  <form class="form-horizontal" role="form" method="post">
                     <div class="form-body">
                        <h2 class="margin-bottom-20"> Client Info </h2>
                        <h3 class="form-section"><?php echo ucwords($result->name); ?></h3>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Name:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static"> <?php echo $result->name;; ?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Email:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static"> <?php echo $result->email; ?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Country:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static"> <?php echo $client_con[$result->country]; ?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Join Date:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static"> <?php echo date("d-M-Y",strtotime($result->created_date)); ?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <!--/row-->
                        <!-- <div class="row">
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label class="control-label col-md-3">Published Date:</label>
                                   <div class="col-md-9">
                                       <p class="form-control-static"> <?php #echo $result[0]->country; ?><strong></strong> </p>
                                   </div>
                               </div>
                           </div>-->
                        <!--/span-->
                        <!--<div class="col-md-6">
                           <div class="form-group">
                               <label class="control-label col-md-3">Close Date:</label>
                               <div class="col-md-9">
                                   <p class="form-control-static"> <?php #echo $result[0]->country; ?> </p>
                               </div>
                           </div>
                           </div>-->
                        <!--/span-->
                     </div>
                     <!--/row-->
                     <h3 class="form-section">Contest Details</h3>
                     <div class="row">
                        <div class="col-md-12">
                           <!-- BEGIN EXAMPLE TABLE PORTLET-->
                           <div class="portlet light bordered">
                              <div class="portlet-title">
                                 <div class="caption font-dark">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject bold uppercase">client records</span>
                                 </div>
                                 <div class="tools"> </div>
                              </div>
                              <div class="portlet-body">
                                 <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead>
                                       <tr>
                                          <th> Contest Name </th>
                                          <th> Type </th>
                                          <th> Contest Prize </th>
                                          <th> Start Date </th>
                                          <th> End Date </th>
                                          <th> Status </th>
                                          <th> Payment Type </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php if(isset($records) && !empty($records)) { foreach($records as $res) { 
                                          if($res->pay_option==0)
                                          {
                                          	$s="Partial Payment";
                                          }
                                          else if($res->pay_option==1)
                                          {
                                          	$s="Full payment";
                                          }
										  else{
											$s="NO Payment";
										  }
                                          	
                                          
                                          ?>
                                       <tr>
                                          <td><?php echo (!empty($res->contest_title))?$res->contest_title:$res->org_name; ?> </td>
                                          <td><?php 
                                    $contest_category1 = get_category_type($res->id);
                                       if(is_numeric($res->contest_type)){
                                       foreach ($contest_category1 as $con_category){
                                       echo  $con_category; }
                                    } else { 
                                       echo $res->contest_type;
                                        }
                                          //echo $res->contest_type; ?> </td>
                                          <td><?php echo $res->contest_prize; ?> </td>
                                          <td><?php echo (!empty($res->published_date))?date('d-M-Y',strtotime($res->published_date)):""; ?> </td>
                                          <td><?php echo (!empty($res->close_date))?date('d-M-Y',strtotime($res->close_date)):""; ?> </td>
                                          <td> <?php echo $res->status; ?></td>
                                          <td> <?php echo $s; ?> </td>
                                       </tr>
                                       <?php } } ?>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
               </div>
               <div class="form-actions">
               <div class="row">
               <div class="col-md-6">
               <div class="row">
               <div class="col-md-offset-3 col-md-9">
               <!-- <button type="submit" class="btn green">
                  <i class="fa fa-pencil"></i> Edit</button>-->
               </div>
               </div>
               </div>
               <div class="col-md-6"> </div>
               </div>
               </div>
               </form>
               <!-- END FORM-->
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
         </div>
      </div>
   </div>
   <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->