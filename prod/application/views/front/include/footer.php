
  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-md-12 footer-info d-none d-sm-block">
            <h3>About</h3>
        <div class="row">
         <div class="col-lg-6 col-md-12">
            <p>Contesthours is a platform created to connect startup companies with talented and creative designers from all over the world.</p>

            <p>We want to make logo design affordable to everyone. We want people to create an identity for themselves and for their business to stand out.</p>
            <p>This site is friendly competition between designers who want to put their best effort to meet the client’s vision.</p>
           
          </div>

            <div class="col-lg-6 col-md-12">
            <p>We want to make logo design affordable to everyone. We want people to create an identity for themselves and for their business to stand out.</p>
            <p>This site is friendly competition between designers who want to put their best effort to meet the client’s vision.</p>
            <p>We’re working hard 24/7 to provide our customers <a href="<?php echo base_url();?>Admin/about_elaborate" style="color: #fbb03b;"> Read More...</a> </p>
            
            </div>
        </div>
          </div>
          <div class="col-lg-6 col-md-12 footer-links">
      <h4>Quick Links</h4>
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <ul>
             <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo base_url()?>Admin/codeofconduct">Designer Code of Conduct</a></li>
            <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo base_url()?>Admin/privacy_policy">Privacy & Terms</a></li>
            <li><i class="ion-ios-arrow-right"></i> <a href="#">Copyrights</a></li>
            <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo base_url();?>admin/mailContact">Contact Support</a></li>
          
          </ul>
        </div>

          <div class="col-lg-6 col-md-12">
          <ul>
            <?php $usertype=$this->session->userdata('user_type'); 
              if($usertype == 0){
             ?>
            <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo base_url()?>Admin/client_faq">Client FAQs</a></li>
          <?php } else { ?>
              <li><i class="ion-ios-arrow-right"></i> <a href="<?php echo base_url()?>Admin/designer_faq">Designer FAQs</a></li>
            <?php } ?>
              <li><i class="ion-ios-arrow-right"></i> <a href="http://blog.contesthours.com/">Blog</a></li>
          
          </ul>

          <div class="social-links">
           <!--  <a href="#" class="twitter"><i class="fa fa-twitter"></i></a> -->
            <a href="https://www.facebook.com/contesthourslogo/" class="facebook"><i class="fa fa-facebook"></i></a>
            <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
            <!-- <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
            <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a> -->
          </div>
          </div>
      </div>
        </div>
        </div>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

   
	<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/contest_formvalidations.js"></script>
  <!-- JavaScript Libraries -->
  <!-- <script src="<?php echo base_url();?>assets/lib/jquery/jquery.min.js"></script>-->
  <!-- <script src="<?php echo base_url();?>assets/lib/jquery/jquery-migrate.min.js"></script>-->
  
  <script src="<?php echo base_url();?>assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url();?>assets/lib/easing/easing.min.js"></script>
  <script src="<?php echo base_url();?>assets/lib/superfish/hoverIntent.js"></script>
  <script src="<?php echo base_url();?>assets/lib/superfish/superfish.min.js"></script>
  <script src="<?php echo base_url();?>assets/lib/wow/wow.min.js"></script>
  <script src="<?php echo base_url();?>assets/lib/waypoints/waypoints.min.js"></script>
  <script src="<?php echo base_url();?>assets/lib/counterup/counterup.min.js"></script>
  <script src="<?php echo base_url();?>assets/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url();?>assets/lib/isotope/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url();?>assets/lib/lightbox/js/lightbox.min.js"></script>
  <script src="<?php echo base_url();?>assets/lib/touchSwipe/jquery.touchSwipe.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <!-- <script src="<?php echo base_url();?>assets/contactform/contactform.js"></script> -->

  <!-- Template Main Javascript File 
  <script src="<?php echo base_url();?>assets/js/main.js"></script>-->
 <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.easing.1.3.js"></script>
    <!-- the jScrollPane script -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.cslider.js"></script>
    <script type="text/javascript">
      $(function() {
        $('#da-slider').cslider({
          autoplay  : true,
          bgincrement : 450
        });
      
      });
    </script>
 
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.contentcarousel.js"></script>
    <script type="text/javascript">
      $('#ca-container').contentcarousel();
    </script>  
        <!--<script src="<?php echo base_url();?>assets/js/jquery4.js" type="text/javascript"></script>-->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.sortelements.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.bdt.js" type="text/javascript"></script>
        <script>
            $(document).ready( function () {
                $('#bootstrap-table').bdt();
                $(".table-header form").removeClass("pull-left");
            });
        </script>
       
</body>
</html>

