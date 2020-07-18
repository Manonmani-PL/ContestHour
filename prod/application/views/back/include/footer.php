<!-- BEGIN FOOTER -->
        <div class="page-footer text-center">
            <div class="page-footer-inner"> 2016 &copy; Contest Hours.
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>admin_assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>admin_assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        
        <script src="<?php echo base_url(); ?>admin_assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>admin_assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>admin_assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>admin_assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>admin_assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>admin_assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>admin_assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        
        <script src="<?php echo base_url(); ?>admin_assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>admin_assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>admin_assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>admin_assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>admin_assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>admin_assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>admin_assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>admin_assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
		
        <script src="<?php echo base_url(); ?>admin_assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
		
		
		
		<script src="<?php echo base_url(); ?>admin_assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        
		
		<script src="<?php echo base_url(); ?>admin_assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>admin_assets/pages/scripts/form-validation-md.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url(); ?>admin_assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>admin_assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>admin_assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>
<script type="text/javascript">        
$(document).ready(function() {
    $('.schange').on('click',function(){
		var sdata=$(this).val();
		var sid=$(this).attr("data-id");
		
		$.ajax({
				type:'POST',
				dataType:'json',
				data:{status:sdata,id:sid},
				url:'<?php echo base_url();?>admin_panel/change_status/',
				success:function(data)
				{
					
					//var data=$.parseJSON(data);
					alert($.parseJSON(data));
					//window.location.reload(true);
					//$(this).attr('class',data.btn);
					$(this).attr('data-id',data.id);
					//$(this).attr('class',data);
				}
			});
	});
}); 
</script>    