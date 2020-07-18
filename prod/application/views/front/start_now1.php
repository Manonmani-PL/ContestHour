  <link href="<?php echo base_url();?>assets/lib/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/lib/colorpicker/css/bootstrap-colorpicker-plus.css" rel="stylesheet">
 <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="start-now-intro">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade">
		<img src="<?php echo base_url();?>assets/images/home_bg.jpg" alt="" title="" />
      </div>
	  <div class="row intro-msg">
		<div class="col-lg-12">
			<div class="intro-text">
				<h5 class="brand-title">contesthours</h5>
				<h1>3 simple steps</h1>
				<h3>Start your online logo design contest for only $29 and receive professional custom logo concepts for your business</h3>
			</div>
		</div>
	  </div>
    </div>
  </section><!-- #intro -->

  <main id="main">
    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">

        <header class="section-header text-center">
			<h4 class="block-title">What you you require</h4>
        </header>
		
        <div class="row about-cols">
          <div class="col-md-3 col-sm-6 col-6 wow fadeInUp">
            <div class="package-col cat-col">
              <div class="package-icon">
				<img src="<?php echo base_url();?>assets/images/package-01.png">
              </div>
              <h2 class="title">Only Logo</h2>
			  <p>Logo design with copyright document</p>
			  <div class="package-price-box">
				<strong>Get At</strong>
				<span class="package-price">$29</span>
			  </div>
			  <div class="select-cat">
				<input id="package1" value="pack1" type="radio" name="category_input" class="cat_package">
				<label for="package1">Choose</label>
			  </div>
            </div>
          </div>
	
          <div class="col-md-3 col-sm-6 col-6 wow fadeInUp" id="pack1">
            <div class="package-col cat-col">
              <div class="package-icon">
				<img src="<?php echo base_url();?>assets/images/package-02.png">
              </div>
              <h2 class="title">Branding</h2>
			  <p>Stationary designs, choose any 3</p>
			  <div class="package-price-box">
				<strong>Get At</strong>
				<span class="package-price">$79</span>
			  </div>
			  <div class="select-cat">
				<input id="package2" value="pack2" type="radio" name="category_input" class="cat_package">
				<label for="package2">Choose</label>
			  </div>
            </div>
			<div class="package-option custom-checkbox-list catoptions" id="pack2">
				<label>Business Card
				  <input type="checkbox" checked="checked">
				  <span class="checkmark"></span>
				</label>

				<label>Social media cover design
				  <input type="checkbox">
				  <span class="checkmark"></span>
				</label>
				<label>T-shirt
				  <input type="checkbox">
				  <span class="checkmark"></span>
				</label>
				<label>Others
				  <input type="checkbox">
				  <span class="checkmark"></span>
				</label>
			</div>
          </div>
	
          <div class="col-md-3 col-sm-6  col-6 wow fadeInUp">
            <div class="package-col cat-col">
              <div class="package-icon">
				<img src="<?php echo base_url();?>assets/images/package-03.png">
              </div>
              <h2 class="title">Logo + Branding</h2>
			  <p>Logo design & Stationary Design choose any 3</p>
			  <div class="package-price-box">
				<strong>Get At</strong>
				<span class="package-price">$109</span>
			  </div>
			  <div class="select-cat">
				<input id="package3" value="pack3" type="radio" name="category_input" class="cat_package">
				<label for="package3">Choose</label>
			  </div>
            </div>
			
			<div class="package-option custom-checkbox-list catoptions" id="pack3">
				<label>Business Card
				  <input type="checkbox" checked="checked">
				  <span class="checkmark"></span>
				</label>

				<label>Social media cover design
				  <input type="checkbox">
				  <span class="checkmark"></span>
				</label>
				<label>T-shirt
				  <input type="checkbox">
				  <span class="checkmark"></span>
				</label>
				<label>Others
				  <input type="checkbox">
				  <span class="checkmark"></span>
				</label>
			</div>
          </div>
	 
          <div class="col-md-3 col-sm-6 col-6 wow fadeInUp">
            <div class="package-col cat-col">
              <div class="package-icon">
				<img src="<?php echo base_url();?>assets/images/package-04.png">
              </div>
              <h2 class="title">Advertising</h2>
			  <p>choose any 1</p>
			  <div class="package-price-box">
				<strong>Get At</strong>
				<span class="package-price">$69</span>
			  </div>
			  <div class="select-cat">
				<input id="package4" value="pack4" type="radio" name="category_input" class="cat_package">
				<label for="package4">Choose</label>
			  </div>
            </div>
			
			<div class="package-option custom-checkbox-list catoptions" id="pack4">
				<label>Business Card
				  <input type="checkbox" checked="checked">
				  <span class="checkmark"></span>
				</label>

				<label>Social media cover design
				  <input type="checkbox">
				  <span class="checkmark"></span>
				</label>
				<label>T-shirt
				  <input type="checkbox">
				  <span class="checkmark"></span>
				</label>
				<label>Others
				  <input type="checkbox">
				  <span class="checkmark"></span>
				</label>
			</div>
          </div>
		  
        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      Brief Section
    ============================-->
    <section id="brief" class="section-bg wow fadeInUp">
      <div class="container">
		<header class="section-header text-center">
			<h4 class="block-title">1. Post your brief</h4>
        </header>
		
        <div class="row">
          <div class="col-md-8 offset-2">
			<form class="contest-form custom-form" action="#">
			  <div class="form-group">
				<label for="email">Company Title (Logo Name)</label>
				<input type="text" class="form-control" >
			  </div>
			  <div class="form-group">
				<label for="pwd">Tagline</label>
				<input type="text" class="form-control" >
			  </div>
			  <div class="form-group">
				<label for="pwd">Please describe what your business does infew sentences</label>
				<textarea class="form-control"></textarea>
			  </div>
			  <div class="form-group">
				<label for="pwd">Select Industry</label>
				<input type="text" class="form-control" >
			  </div>
			  <div class="form-group">
				<label for="pwd">Click on the boxes to choose your colors</label>
				<div class="color-input-box">
					<span class="colorpick">
						<input type="hidden" class="form-control color-input">
					</span>
					<span class="colorpick">
						<input type="hidden" class="form-control color-input">
					</span>
					<span class="colorpick">
						<input type="hidden" class="form-control color-input">
					</span>
					<span class="colorpick">
						<input type="hidden" class="form-control color-input">
					</span>
				</div>
			  </div>
			  <div class="form-group">
				<label for="pwd">Please provide any ideas or concepts that you have for your logo:</label>
				<textarea class="form-control"></textarea>
			  </div>
			  <div class="form-group">
				<label for="text">Do you have any documents or images that would be helpful for the contest?</label>
				
				<div class="attach-button">
				<i class="fa fa-paperclip"></i> <span>ATTACH IMAGE</span>
				<input type="file" class="form-control">
				</div>
			  </div>
			</form>
          </div>
        </div>
		
      </div>
    </section>
	
	<!---- Package Section---->
    <section id="about">
      <div class="container">

        <header class="section-header text-center">
			<h4 class="block-title">2. Choose Your Package</h4>
        </header>
		
        <div class="row package-cols">
		
          <div class="col-md-6 col-lg-3 col-6 wow fadeInUp">
            <div class="package-col pricing-package basic-box">
              <div class="package-title">
				Basic
              </div>
              <h2 class="title">Logo Design</h2>
			  <div class="package-price-box">
				<span class="package-price">$29</span>
			  </div>
			  <div class="package-option custom-checkbox-list">
				<label>Upto 2 Designers
				  <input type="checkbox" checked="checked" disabled>
				  <span class="checkmark"></span>
				</label>
				<label>Unlimited Revisions
				  <input type="checkbox" checked="checked" disabled>
				  <span class="checkmark"></span>
				</label>
				<label>Inclusive of all fees
				  <input type="checkbox" checked="checked" disabled>
				  <span class="checkmark"></span>
				</label>
              </div>
			  <span class="check-icon">
				<input type="radio" name="pricing" value="opt1" class="select-pricing" id="basic_package">
				<label for="basic_package">
					<i class="fa fa-check hidden-mob"></i>
					<b class="show-mob">Choose</b>
				</label>
			  </span>
            </div>
			<div class="pricing-option" id="opt1">
				<div class="form-group">
				  <select class="form-control" id="sel1">
					<option>Select Duration</option>
					<option>1 day</option> <option>3 days </option>
				  </select>
				</div>
			</div>
          </div>
		
          <div class="col-md-6 col-lg-3 col-6 wow fadeInUp">
            <div class="package-col pricing-package silver-box">
              <div class="package-title">
				Silver
              </div>
              <h2 class="title">Logo Design</h2>
			  <div class="package-price-box">
				<span class="package-price">$50</span>
			  </div>
			  <div class="package-option custom-checkbox-list">
				<label>Upto 4 Designers
				  <input type="checkbox" checked="checked" disabled>
				  <span class="checkmark"></span>
				</label>
				<label>Unlimited Revisions
				  <input type="checkbox" checked="checked" disabled>
				  <span class="checkmark"></span>
				</label>
				<label>Inclusive of all fees
				  <input type="checkbox" checked="checked" disabled>
				  <span class="checkmark"></span>
				</label>
			</div>
			<span class="check-icon">
				<input type="radio" name="pricing" value="opt2" class="select-pricing" id="silver_package">
				<label for="silver_package">
					<i class="fa fa-check hidden-mob"></i>
					<b class="show-mob">Choose</b>
				</label>
			</span>
            </div>			
			<div class="pricing-option" id="opt2">
				<div class="form-group">
				  <select class="form-control" id="sel1">
					<option>Select Duration</option>
					<option>1 day</option> <option>3 days </option>
				  </select>
				</div>
			</div>
          </div>
	
          <div class="col-md-6 col-lg-3 col-6  wow fadeInUp">
            <div class="package-col pricing-package gold-box">
              <div class="package-title">
				Gold
              </div>
              <h2 class="title">Logo Design</h2>
			  <div class="package-price-box">
				<span class="package-price">$90</span>
			  </div>
			  <div class="package-option custom-checkbox-list">
				<label>Upto 6 Designers
				  <input type="checkbox" checked="checked" disabled>
				  <span class="checkmark"></span>
				</label>
				<label>Unlimited Revisions
				  <input type="checkbox" checked="checked" disabled>
				  <span class="checkmark"></span>
				</label>
				<label>Business Card design
				  <input type="checkbox" checked="checked" disabled>
				  <span class="checkmark"></span>
				</label>
				<label>Inclusive of all fees
				  <input type="checkbox" checked="checked" disabled>
				  <span class="checkmark"></span>
				</label>
			</div>
			<span class="check-icon">
				<input type="radio" name="pricing" value="opt3" class="select-pricing" id="gold_package">
				<label for="gold_package">
					<i class="fa fa-check hidden-mob"></i>
					<b class="show-mob">Choose</b>
				</label>
			</span>
            </div>			
			<div class="pricing-option" id="opt3">
				<div class="form-group">
				  <select class="form-control" id="sel1">
					<option>Select Duration</option>
					<option>1 day</option> <option>3 days </option>
				  </select>
				</div>
			</div>
          </div>
	
          <div class="col-md-6 col-lg-3 col-6 wow fadeInUp">
            <div class="package-col pricing-package custom-box">
              <div class="package-title">
				Custom
              </div>
              <h2 class="title">Logo Design</h2>
			  <div class="package-price-input">
				  <div class="form-group">
					<input type="text" class="form-control" >
				  </div>
			  </div>
			  <p>Set Your own Contest Prize. Minimum Prize Amount is 50$</p>
			  <div class="package-option custom-checkbox-list">
				<label>Only Logo design
				  <input type="checkbox" checked="checked" disabled>
				  <span class="checkmark"></span>
				</label>
			   </div>
			   <span class="check-icon">
				<input type="radio" name="pricing" value="opt4" class="select-pricing" id="custom_package">
				<label for="custom_package">
					<i class="fa fa-check hidden-mob"></i>
					<b class="show-mob">Choose</b>
				</label>
			   </span>
            </div>
			<div class="pricing-option" id="opt4">
				<div class="form-group">
				  <select class="form-control" id="sel1">
					<option>Select Duration</option>
					<option>1 day</option> <option>3 days </option>
				  </select>
				</div>
			</div>
          </div>
        </div>

      </div>
    </section><!-- #about -->
	
	<section id="brief" class="section-bg wow fadeInUp">
      <div class="container">
		<header class="section-header text-center">
			<h4 class="block-title">Project Upgrades</h4>
        </header>
		
        <div class="row">
          <div class="col-md-6 offset-3 upgrade-block">
				<div class="upgrade-box">
					<div class="upgrade-top">
							<div class="upgrade-title">Private Contest </div>
							<div class="upgrade-price">$8 </div>
					</div>
					<div class="upgarde-icon">
						<i class="fa fa-lock"></i>
					</div>
					<div class="upgrade-bottom">
							<div class="upgrade-text">Hide your Contest from the public and search engines. Its only visible to our logo designers. </div>
							<div class="upgrade-select">  
								<label class="switch">
								  <input type="checkbox" class="upgrade-btn">
								  <span class="slider round"></span>
								</label>
							</div>
					</div>
				</div>
				<div class="upgrade-box">
					<div class="upgrade-top">
							<div class="upgrade-title">Featured Contest </div>
							<div class="upgrade-price">$8 </div>
					</div>
					<div class="upgarde-icon">
						<i class="fa fa-star"></i>
					</div>
					<div class="upgrade-bottom">
							<div class="upgrade-text">Featured contests are highlighted above our regular projects to attract more designers .</div>
							<div class="upgrade-select">  
								<label class="switch">
								  <input type="checkbox" class="upgrade-btn">
								  <span class="slider round"></span>
								</label>
							</div>
					</div>
				</div>
				
				<div class="brief-total">
					<div class="brief-block">
						Total $<span>99</span>
					</div>
				</div>
          </div>
        </div>
		
      </div>
    </section><!-- #contact -->
	
	
    <!--==========================
      Brief Section
    ============================-->
    <section id="brief" class="section-bg-white wow fadeInUp">
      <div class="container">
		<header class="section-header text-center">
			<h4 class="block-title">3. Create Your Account</h4>
        </header>
		
        <div class="row">
          <div class="col-md-4 offset-4 padding-zero">
			<form class="brief-user-form" action="#">
			  <div class="form-group">
				<input type="email" class="form-control" id="email" placeholder="Enter Your E - mail address">
			  </div>
			  <div class="form-group">
				<input type="password" class="form-control"  placeholder="Create a Password">
			  </div>
			</form>
          </div>
        </div>
		
      </div>
    </section>
	
  </main>
 <script src="<?php echo base_url();?>assets/lib/colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="<?php echo base_url();?>assets/lib/colorpicker/js/bootstrap-colorpicker-plus.js"></script>
<script>
$(function(){
  var demo1 = $('.colorpick');
  demo1.colorpickerplus();
  demo1.on('changeColor', function(e,color){
    if(color==null)
      $(this).css('background-color', '#fff').closest(".color-input").val(1);
    else
      $(this).css('background-color', color).closest(".color-input").val('transparent');
  });
});
$(document).ready(function(){
  $(document).on("change",".upgrade-btn",function(){
    if($(this).prop('checked') == true){
      $(this).closest(".upgrade-box").addClass("upgrade-checked");
    }
    else{
      $(this).closest(".upgrade-box").removeClass("upgrade-checked");
    }
  });
  
  $(document).on("click",".select-pricing",function(){
  
    $(".pricing-package").removeClass("package-select");
    if($(this).prop('checked') == true){
      $(this).closest(".pricing-package").addClass("package-select");
    }
    $(".pricing-option").slideUp();
    var val= $(this).val();
    $("#"+val).slideDown();
  });
  
  $(document).on("change",".cat_package",function(){
    $(".catoptions").slideUp();
    var val= $(this).val();
    $("#"+val).slideDown();
  });
});
</script>
	

