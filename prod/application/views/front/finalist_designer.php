<?php $this->load->view('front/include/left_side_menu_designer'); ?>
  <div class="col-sm-9">
    <div class="right-border">
    	<div class="row">
            <div class="col-sm-12">
            	
                <div class="jointable">
                <h3>Finalist</h3>
                 <table class="table table-hover" id="bootstrap-table">
                <thead>
                <tr>
                    <th>Contest Title</th>
                    <th>Contest Type</th>
                    <th>Status</th>
                   
                </tr>
                </thead>
                <tbody>
                <?php if(isset($records) && !empty($records) ){
					foreach( $records as $tmp)
					{
						
						?>
						
					 <tr>
                    <td><a href="<?php echo base_url();?>contest/particular_contest/<?php echo $tmp->id?>"><?php echo  ($tmp->contest_title!="")?ucwords($tmp->contest_title):ucwords($tmp->org_name); ?></a></td>
                    <td><?php 
                     $contest_category1 = get_category_type($tmp->id);
                    if(is_numeric($tmp->contest_type)){
                     foreach ($contest_category1 as $con_category){
                                echo  $con_category; } } else {
                                echo $tmp->contest_type;
                            } 
                           ?></td>
                    <td><?php echo $tmp->status;?> </td>
                   
                </tr>	
						
						
			<?php }
					
				} ?>
                
               </tbody>
            </table>
       </div>
            		
                    


            
              
       </div>
        </div>
    </div>
  </div>
</div>
</div>






</div>
<div class="container">
	<div class="col-md-3"></div>
    
    <div class="col-md-3"></div>
    <div class="col-md-3"></div>
</div>
<div class="gap"></div>