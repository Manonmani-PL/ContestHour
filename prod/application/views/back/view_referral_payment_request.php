<!-- BEGIN CONTAINER -->
<div class="page-container">
  <?php require('include/side_bar.php'); ?>
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
      <h3 class="page-title"> Request Referral Payment Details 
        <small>
        </small> 
      </h3>
      <!-- END PAGE TITLE-->
      <?php echo $this->session->flashdata('update_msg');?>
      <div class="row">
        <div class="col-md-12">
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light bordered">
            <div class="portlet-title">
              <div class="caption font-dark"> 
                <i class="icon-settings font-dark">
                </i> 
                <span class="caption-subject bold uppercase">records
                </span> 
              </div>
              <div class="tools"> 
              </div>
            </div>
            <div class="portlet-body">
              <table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead>
                  <tr>
                    <th> S.No 
                    </th>
                    <th>Designer Name
                    </th>
                    <th>Paypal
                    </th>
                    <th>Request Date
                    </th> 
                    <th>Transaction Fees
                    </th>
                    <th>Final Transaction
                    </th>
                    <th>Option
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
					$i= 1; 
					foreach($request as $req) { 
					$ref_id=$req->ref_id;
					$req_date=$req->request_date;
					?>
                  <tr>
                    <td>
                      <?php echo $i++; ?> 
                    </td>
                    <td>
                      <?php echo username($ref_id);?> 
                    </td>
                    <td>
                      <?php echo paypal_referral_id($ref_id);?> 
                    </td>
                    <td>
                      <?php echo date("d/M/Y h:i a",strtotime($req_date));?> 
                    </td>
                    <td><?php echo " - ".$fee; ?></td>
                    <td><?php echo $req->request_amount; ?></td>
                    <td>
                      <a class="btn red btn-outline sbold s2" data-designer="<?php echo $req->ref_id ?>" data-req="<?php echo $req->id;?>" data-amt="<?php echo $req->request_amount;?>" data-toggle="modal" href="#basic">Release Payment
                      </a>
                         <a href="<?php echo base_url();?>admin_panel/view_referral_payment_delete/<?php echo $req->id; ?>" class="btn btn-success red">Delete</a> 
                    </td>
                  </tr>
                  <?php }?> 
                </tbody>
              </table>
            </div>
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
<script>
  $(document).ready(function() {
    $(document).on('click', '.s2', function() {
      var des_id = $(this).attr('data-designer');
      var req_id = $(this).attr('data-req');
      var trans_amount = $(this).attr('data-amt');
      $('.ref_id').val(des_id);
      $('.trans_req_id').val(req_id);
      $('.trans_amount').val(trans_amount);
    }
                  );
  }
                   );
</script>
<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url();?>Admin_panel/referral_transaction_update" method="post">
        <div class="modal-header"> 
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          </button>
          <h4 class="modal-title">Transaction Detatils
          </h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="form-body">
              <div class="form-group form-md-line-input"> 
                <label class="col-md-3 control-label text-right" for="form_control_1">Transaction Id
                  <span class="required" aria-required="true">*
                  </span>
                </label>
                <div class="col-md-8"> 
                  <input class="form-control" name="tid" required="" type="text"> 
                  <input type="hidden" name="ref_id" class="ref_id"> 
                  <input type="hidden" name="trans_req_id" class="trans_req_id"> 
                  <input type="hidden" name="trans_amount" class="trans_amount"> 
                  <span class="help-block">Payment Transaction Id
                  </span> 
                </div>
              </div>
            </div>
          </div> 
          <br> 
        </div>
        <div class="modal-footer"> 
          <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close
          </button> 
          <button type="submit" class="btn green">Save
          </button> 
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
