<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller{
	
	var $publicMethods  = array("index","check_login","restricted","portfolios","designer","designer_search", "expresshours","openContests","contestCompleted","judgingContests","loginForm","clientSignup", "designerSignup","referralSignup", "forgetpwd","choose_judgingContests", "choose_completedContests", "choose_openContests","choose_expressContests", "about", "contactus", "mailContact","startnow","startnow2","about_elaborate","package_convertion", "portfolios_testimonial");
	
	var $clientmethods= array("myprofile_client", "message_client", "message_client","mylivecontest_client", "in_judgging", "draft_client", "mycompleted_client", "contact_support", "client_notification");
	
	var $designermethods= array("myprofile_designer", "message_designer", "payment_designer","payment_referral","new_referral_details","joined_designer", "finalist_designer", "winning_designer", "myprofile_designerportfolio", "designer_notification","designer_referral_code","myprofile_referral");
	
	public function __Construct()
	{
        parent::__construct();
		$this->load->model(array('Common_model','Contest_model'));
		$this->load->helper('url');
		$this->load->library(array('form_validation','session','upload','encrypt'));
		
		$logged_in = is_user_logged_in();		
		$currentMethod = $this->router->fetch_method();
		if(in_array($currentMethod,$this->publicMethods) == false){
			if(!$logged_in){
				redirect("admin/loginForm");
			}
			$user_type= $this->session->userdata("user_type");
			if($user_type==1 && in_array($currentMethod,$this->clientmethods) == true){
				redirect("admin/myprofile_designer");
			}
			
			if($user_type==0 && in_array($currentMethod,$this->designermethods) == true){
				redirect("admin/myprofile_client");
			}
		}
    }
	
	public function index(){
		$data['contest_list']=$this->Contest_model->portfoliolistlimit();	
		$min=$this->Common_model->get_record('category',"minimum_fee",array("code"=>"logodesign"));
		$data['logominimum']= $min->minimum_fee;
		$data['designs']=$this->Common_model->get_records('designs','*',array("design_status"=>1));
		$data['content']='front/index';
		$this->load->view('front/template1',$data);
	}
	
	public function loginForm(){
		$data = array(
			'username' => $this->session->userdata('username'),
			'logged_in' => $this->session->userdata('logged_in')
		);
		$data['content']='front/login-form1';
		$this->load->view('front/template1',$data);
	}
	
	public function check_login()
	{
		$email = $this->input->post('u_email');
		$pass = $this->input->post('u_password');
		$result = $this->Common_model->checklogin($email, $pass);
		//echo '<pre>';print_r($result); exit;
		if($result){
			$userdata = array(
				'user_name'  => $result[0]->user_name,
			    'user_type'  => $result[0]->user_type,
			    'user_email' => $result[0]->user_email,
			    'user_id'    => $result[0]->user_id,
			    'logged_in' => TRUE
			);
			
			$this->session->set_userdata($userdata);
	        $data = array(
				'username' => $this->session->userdata('user_name'),
				'userid' => $this->session->userdata('user_id')
			);
			
			$up['last_logged_in']= date("Y-m-d H:i:s");
			$where['user_id']=$result[0]->user_id;
			$this->Common_model->update_record("user_table",$up,$where);
				$ref_id = $this->Common_model->get_referral_id($this->session->userdata('user_id'));
			if($ref_id =="") {
			if($userdata['user_type']=='0')
			{
				//redirect('admin/startnow2');
				redirect('admin/contestCompleted');
			}
			else{ 
				//redirect('admin/myprofile_designer');
				redirect('admin/openContests');
			}
		} else {
			redirect('admin/myprofile_referral');
		}
		}
		else{
			$this->session->set_flashdata('msg', 'Wrong Password');
			redirect('admin/loginForm');
		}
	}
	
	public function logout()
    {
	    $username=$this->session->userdata('user_name');       
        $this->session->sess_destroy();
        redirect();
    }
	
	public function designer($start=0){
		$data['result']= $this->Contest_model->designers_rank_list($start);

		$data['total_designers']=$this->Common_model->get_records_count('designer_table');
		$data['designer_report']=$this->Common_model->get_records('designs');

		$data['content']='front/designer1';
		$this->load->view('front/template1',$data);
	}
	public function designer_search(){
		$text= $this->input->post('search_text');
		
		$data['result']= $this->Contest_model->designers_search_list($text);
		
		$search_data=$this->load->view("front/include/designer_search_view1",$data,true);
		
		echo $search_data;
	}
	
	public function designer_portfolio($uid){
		$data['user_details'] = $this->Common_model->get_designer_details($uid);
		$data['wincount']=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'design_status'=>1));
        $data['finalcount']=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'final_status'=>1));
        $data['participation']=$this->Common_model->counts('designs','distinct(contest_id)',array('designer_id'=>$uid));
		$data['designer_rank']=$this->Contest_model->designers_user_rank($uid);
		$data['designs']=$this->Common_model->get_records('designs','*',array("design_status"=>1,"designer_id"=>$uid));
		$data['contest_type']=$this->Contest_model->designer_contest_type($uid);		
		$data['desiner_total_designs']=designer_designcount($uid);
		$totalearn=$this->Common_model->totalearn($uid);
		$data['totalearn']=$totalearn[0]->toatal_earn;
		$data['balance']=designer_balance($uid);
		$data['content']='front/designer_portfolio1';
		$this->load->view('front/template1',$data);
	}
	
	public function designerSignup(){
		//print_r($_POST);
		$country=($this->input->post("designer_country"));
		$this->form_validation->set_rules('designer_name', 'Designer Name', 'required');
		$this->form_validation->set_rules('designer_email', 'Designer Email', 'required|valid_email|is_unique[designer_table.designer_email]');
		$this->form_validation->set_rules('designer_password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[designer_password]');
		$this->form_validation->set_rules('designer_country','Designer Country', 'required');
		$this->form_validation->set_rules('designer_moblie', 'Contact Number', 'trim|required');
		
		$this->form_validation->set_rules('paypal_email', 'Paypal Email', 'required|valid_email');

		if($this->form_validation->run() == TRUE)
		{
			
			$email = $this->input->post("designer_email");
			$name = $this->input->post("designer_name");
			$mobile = $this->input->post("designer_moblie");
			
			$user_id=$this->Common_model->add_designer_data();
			$this->session->set_flashdata('message','<div class="alert alert-block alert-success" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  You have successfully register with us. Please login here</div>');
			
			/**************Notification Email **************/		
			$to = $email;
			$data['email'] = $to;
			$data['message'] = $name.' has registered as Designer ';
			$message = $this->load->view('front/newsletter/welcome_letter',$data,true);	
			rp_send_email($to,'Welcome to Contesthours....!',$message);					
		    /**************Notification Email **************/
			
			//notification
			$noti['noti_msg']=ucwords($name)." joined with Contesthours as a Designer";
			$noti['noti_type']=1;//new_disigner_joined
			$noti['noti_ref_id']=$user_id;
			$noti['noti_entry_time']=date("Y-m-d H:i:s");
			$this->Common_model->insert_record('notification',$noti);
			//notification
		
			redirect(base_url("admin/loginForm"));
		}
		else
		{
			$data['country'] = $this->Common_model->get_records('country_tb');
			$data['content']='front/designer-signup1';
			$this->load->view('front/template1',$data);
		}
	}
	
	public function referralSignup(){
		//print_r($_POST);exit;
		$country=($this->input->post("referral_country"));
		$this->form_validation->set_rules('referral_name', 'Referral Name', 'required');
		$this->form_validation->set_rules('referral_email', 'Referral Email', 'required|valid_email|is_unique[referral_table.referral_email]');
		$this->form_validation->set_rules('referral_password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[referral_password]');
		$this->form_validation->set_rules('referral_country','Referral Country', 'required');
		$this->form_validation->set_rules('referral_moblie', 'Contact Number', 'trim|required');
		
		$this->form_validation->set_rules('paypal_email', 'Paypal Email', 'required|valid_email');

		if($this->form_validation->run() == TRUE)
		{
			
			$email = $this->input->post("referral_email");
			$name = $this->input->post("referral_name");
			$mobile = $this->input->post("referral_moblie");
			
			$user_id=$this->Common_model->add_referral_data();
			$this->session->set_flashdata('message','<div class="alert alert-block alert-success" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  You have successfully register with us. Please login here</div>');
			
			/**************Notification Email **************/		
			$to = $email;
			$data['email'] = $to;
			$data['message'] = $name.' has registered as Referral ';
			$message = $this->load->view('front/newsletter/welcome_letter',$data,true);	
			rp_send_email($to,'Welcome to Contesthours....!',$message);					
		    /**************Notification Email **************/
			
			//notification
			$noti['noti_msg']=ucwords($name)." joined with Contesthours as a Referral";
			$noti['noti_type']=7;//new_referral_joined
			$noti['noti_ref_id']=$user_id;
			$noti['noti_entry_time']=date("Y-m-d H:i:s");
			$this->Common_model->insert_record('notification',$noti);
			//notification
		
			redirect(base_url("admin/loginForm"));
		}
		else
		{
			$data['country'] = $this->Common_model->get_records('country_tb');
			$data['content']='front/referral_signup';
			$this->load->view('front/template1',$data);
		}
	}
	/*  Account Mandatory for Indian designers (function)
	public function designerSignup(){
		//print_r($_POST);
		$country=($this->input->post("designer_country"));
		$this->form_validation->set_rules('designer_name', 'Designer Name', 'required');
		$this->form_validation->set_rules('designer_email', 'Designer Email', 'required|valid_email|is_unique[designer_table.designer_email]');
		$this->form_validation->set_rules('designer_password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[designer_password]');
		$this->form_validation->set_rules('designer_country','Designer Country', 'required');
		$this->form_validation->set_rules('designer_moblie', 'Contact Number', 'trim|required');

        if($country == "IN"){
            $this->form_validation->set_rules('account_number', 'Account Number', 'required');		
            $this->form_validation->set_rules('bank_name', 'Bank Name', 'required');		
            $this->form_validation->set_rules('bank_branch', 'Bank Branch', 'required');		
            $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'required');	
            $this->form_validation->set_rules('account_holder', 'Account Holder', 'required');	
        }
        else{
            $this->form_validation->set_rules('paypal_email', 'Paypal Email', 'required|valid_email');
        }

		if($this->form_validation->run() == TRUE)
		{
			
			$email = $this->input->post("designer_email");
			$name = $this->input->post("designer_name");
			$mobile = $this->input->post("designer_moblie");
			
			$user_id=$this->Common_model->add_designer_data();
			$this->session->set_flashdata('message','<div class="alert alert-block alert-success" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  You have successfully register with us. Please login here</div>');
			
			/**************Notification Email ************		
				$to = $email;
				$data['email'] = $to;
				$data['message'] = $name.' has registered as Designer ';
				$message = $this->load->view('front/newsletter/welcome_letter',$data,true);	
				rp_send_email($to,'Welcome to Contesthours....!',$message);					
		    /**************Notification Email **************
			
			//notification
			$noti['noti_msg']=ucwords($name)." joined with Contesthours as a Designer";
			$noti['noti_type']=1;//new_disigner_joined
			$noti['noti_ref_id']=$user_id;
			$noti['noti_entry_time']=date("Y-m-d H:i:s");
			$this->Common_model->insert_record('notification',$noti);
			//notification
		
			redirect(base_url("admin/loginForm"));
		}
		else
		{
			$data['country'] = $this->Common_model->get_records('country_tb');
			$data['content']='front/designer-signup';
			$this->load->view('front/template',$data);
		}
	}
	 */
	 
	public function clientSignup(){
		$this->form_validation->set_rules('client_name', 'Client Name', 'required');
		$this->form_validation->set_rules('client_email', 'Client Email', 'required|valid_email|is_unique[client_table.email]');
		$this->form_validation->set_rules('client_password', 'Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[client_password]');
		$this->form_validation->set_rules('client_country', 'Client Country', 'required');
		$this->form_validation->set_rules('client_mobile', 'Client Contact Number', 'trim|required|numeric');
		if($this->form_validation->run() == TRUE)
		{
			$email = $this->input->post("client_email");
			$name = $this->input->post("client_name");
			$mobile=$this->input->post("client_mobile");
			$user_id=$this->Common_model->add_client_data();
			$this->session->set_flashdata('message','<div class="alert alert-block alert-success" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  You have successfully register with us. Please login here.</div>');
			
			/**************Notification Email **************/	
			$to = $email;
			$data['email'] = $to;
			$data['message'] = $name.' has registered as client ';
			$message = $this->load->view('front/newsletter/welcome_letter',$data,true);
			rp_send_email($to,'Welcome to Contesthours....!',$message);
					
			/**************Notification Email **************/	
		
			//notification
			$noti['noti_msg']=ucwords($name)." joined with Contesthours as a Client";
			$noti['noti_type']=2;//new_client_joined
			$noti['noti_ref_id']=$user_id;
			$noti['noti_entry_time']=date("Y-m-d H:i:s");
			$this->Common_model->insert_record('notification',$noti);
			//notification
			
			redirect(base_url("admin/loginForm"));
		}
		else
		{
			$data['country'] = $this->Common_model->get_records('country_tb');
			$data['content']='front/client-signup1';
			$this->load->view('front/template1',$data); 
		}
	}
	
	public function contestCompleted($start=0){
		$data['category']=$this->Common_model->get_records('category');
		$data['industry']=$this->Common_model->get_records('industry');
		$data['contest_list']=$this->Common_model->get_records_orderby_limit('contest','',array('admin_status'=>1,'status'=>'completed','delete_status'=>0),"id","DESC",20,$start);
		$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,'status'=>'completed','delete_status'=>0));
		$data['content']='front/contest-completed1';
		$this->load->view('front/template1',$data);
	}
	
	public function expresshours($start=0){
		$data['category']=$this->Common_model->get_records('category');
		$data['industry']=$this->Common_model->get_records('industry');	
		
		$data['contest_list']=$this->Common_model->get_records_orderby_limit('contest','*',array("admin_status"=>1, "delete_status"=>0, "status"=>"open", "time_format(timediff( `close_date`, CONVERT_TZ(now(),'+00:00',`user_timezone`)),'%H')<="=>24),'published_date','asc',10,$start);
		
		$data['count_contests']=$this->Common_model->get_records_count('contest','id',array("admin_status"=>1, "delete_status"=>0, "status"=>"open", "time_format(timediff( `close_date`, CONVERT_TZ(now(),'+00:00',`user_timezone`)),'%H')<="=>24)); 
		
		//"DATEDIFF(`close_date`, CONVERT_TZ(now(),'+00:00',`user_timezone`))<="=>1 
		// in days count
		
		// $data['contest_list']=$this->Contest_model->ex_opencontestlist();
		// $data['count_contests']=$this->Contest_model->ex_opencontestcount();	
		$data['content']='front/expresshours1';
		$this->load->view('front/template1',$data);
	}
	
	public function judgingContests($start=0){
		$data['category']=$this->Common_model->get_records('category','','');
		$data['industry']=$this->Common_model->get_records('industry','','');
		$data['contest_list']=$this->Common_model->get_records_orderby_limit('contest','*',array('admin_status'=>1,'status'=>'judging','delete_status'=>0),'id','DESC',20,$start);
		$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,'status'=>'judging','delete_status'=>0));
		$data['content']='front/judging_contests1';
		$this->load->view('front/template1',$data);
	}
	
	public function openContests($start=0){
	 
		$data['category']=$this->Common_model->get_records('category','','');
		$data['industry']=$this->Common_model->get_records('industry','','');
		
		$data['contest_list']=$this->Common_model->get_records_notin_orderby_limit('contest','*',array('admin_status'=>1,'delete_status'=>0),'status',array('judging','draft','completed'),array('upgrade_featured_contest DESC','published_date DESC'),20,$start);
		
		$data['count_contests']=$this->Contest_model->opencontestcount();	
		$data['content']='front/open-contests1';
		$this->load->view('front/template1',$data);
	}
	
	public function portfolios(){
		$data['category']=$this->Common_model->get_records('category','','');
		$data['industry']=$this->Common_model->get_records('industry','','');
		$data['contest_list']=$this->Contest_model->portfoliolist();	

		$data['content']='front/portfolios1';
		$this->load->view('front/template1',$data);
	}
	
	public function portfolios_testimonial(){
		/*$data['category']=$this->Common_model->get_records('category','','');
		$data['industry']=$this->Common_model->get_records('industry','','');*/
		$data['contest_list']=$this->Contest_model->portfoliolist();	

		$data['content']='front/portfolios_testimonial';
		$this->load->view('front/template1',$data);
	}
	
	public function portfolio_filter(){
		$cat_type = $_POST['category'];
		$indus_type = $_POST['industry'];
		$data['indus_id']=$this->Contest_model->get_industry_id($indus_type);
		$indus = $data['indus_id'];
		$data['portfolio_list']=$this->Contest_model->portfoliolist($cat_type, $indus);	
		$this->load->view('front/ajax/ajax_portfolio1',$data);
	}
	
	public function myprofile_designer(){
		$user_id = $this->session->userdata('user_id');
		$data['balance']=designer_balance($user_id);
		$data['desiner_total_designs']=designer_designcount($user_id);
		$data['designer_rank']=$this->Contest_model->designers_user_rank($user_id);
		$totalearn=$this->Common_model->totalearn($user_id);
        $data['contest_type']=$this->Contest_model->designer_contest_type($user_id);
		$data['totalearn']=$totalearn[0]->toatal_earn;
		$data['country'] = $this->Common_model->get_records('country_tb');
		$data['user_details'] = $this->Common_model->get_designer_details($user_id);
		//print_r($data['user_details']);
		$data['content']='front/myprofile_designer';
        
		if(!empty($user_id)){
			$this->load->view('front/template',$data);
		}
		else{
			redirect(base_url("admin/loginForm"));
		}
	}

	public function myprofile_referral(){
		$user_id = $this->session->userdata('user_id');
		$referral_id = $this->Contest_model->get_referral_id($user_id);
		$data['balance']=designer_balance($user_id);
		$data['referral_total_use']=referral_designcount($user_id);
		$data['designer_rank']=$this->Contest_model->designers_user_rank($user_id);
		$data['totalearn_referral']=$this->Common_model->totalearn_referral($referral_id);
        $data['contest_type']=$this->Contest_model->designer_contest_type($user_id);
	
		$data['country'] = $this->Common_model->get_records('country_tb');
		$data['user_details'] = $this->Common_model->get_referral_details($user_id);
		//print_r($data['user_details']);
		$data['content']='front/myprofile_referral';
        
		if(!empty($user_id)){
			$this->load->view('front/template',$data);
		}
		else{
			redirect(base_url("admin/loginForm"));
		}
	}

	public function designer_signature(){
		$user_id = $this->session->userdata('user_id');
		$data['user_details'] = $this->Common_model->get_designer_details($user_id);
		$data['content']='front/designer_signature';
		if(!empty($user_id)){
			$this->load->view('front/template',$data);
		}
		else{
			redirect(base_url("admin/loginForm"));
		}
	}

	public function save_designer_signature(){
		$user_id = $this->session->userdata('user_id');
		$designer_email = get_email($user_id);

		 if($_FILES['signature']['name'] != ''){
		 	$target_path = "uploads/documents";
			$test = $_FILES["signature"]["name"];
			$uploads=$_FILES["signature"]["tmp_name"];
		 $fileinfo = getimagesize($_FILES["signature"]["tmp_name"]);
    	$width = $fileinfo[0];
   		$height = $fileinfo[1];
			if($width > "350" || $height > "60"){
    	$this->session->set_flashdata('valid_error','<div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i> Image dimension should be within 350X60.</div>');
    		redirect('admin/designer_signature');
    	} else {
    		$test = $_FILES["signature"]["name"];
			$sign['signature'] = $test;
			$this->Common_model->update_record('designer_table',$sign, array('designer_email'=>$designer_email));
	move_uploaded_file($uploads, "uploads/documents/".$test);
    $this->session->set_flashdata('message','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Your profile has been updated successfully.</div>');
			redirect('admin/designer_signature');
		
	}
	}
	}
	public function update_designer(){
		$user_id = $this->session->userdata('user_id');
		$data['balance']=designer_balance($user_id);
		
		$totalearn=$this->Common_model->totalearn($user_id);
		$data['totalearn']=$totalearn[0]->toatal_earn;
		$data['country'] = $this->Common_model->get_records('country_tb');
		$data['user_details'] = $this->Common_model->get_designer_details($user_id);
		//print_r($data['user_details']);
		$data['content']='front/update_designer';
        
		if(!empty($user_id)){
			$this->load->view('front/template',$data);
		}
		else{
			redirect(base_url("admin/loginForm"));
		}
	}
	
	public function edit_designer_info($did='') {
		$img=$this->input->post('profile_photo');
		if(!empty($_FILES['profile_photo']['name'])){
			$config['upload_path']= 'uploads/designer_profile';
			$config['allowed_types'] = 'gif|jpg|png';
		   
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('profile_photo'))
			{
				if(!empty($_REQUEST['old_file_name'])){
					unlink("uploads/designer_profile/".$_REQUEST['old_file_name']);
				}
				$upload_data=array('upload_data'=>$this->upload->data());
				$file_name=$upload_data['upload_data']['file_name'];
			}
			else
			{	
				$error = array('error' => $this->upload->display_errors());
				redirect('admin/edit_designer_info');
			}
		}
		else{
			$file_name=$_REQUEST['old_file_name'];
		}
		
		/* 
		$this->form_validation->set_rules('myprofile_name', 'Designer Name', 'required|alpha');
		$this->form_validation->set_rules('profile_email', 'Designer Email', 'required|valid_email');
		$this->form_validation->set_rules('paypal_email', 'Paypal Email', 'required|valid_email');
		$this->form_validation->set_rules('countries_id', 'Designer Country', 'required');	*/
		
		$this->form_validation->set_rules('myself', 'Intro');
		if(!empty($_POST))
		{
			/* $up = array ( 
				'designer_name'=>$this->input->post('myprofile_name'),
				'designer_email'=>$this->input->post('profile_email'),
				'paypal_email'=>$this->input->post('paypal_email'),
				'designer_country'=>$this->input->post('countries_id'),
				'designer_intro'=>$this->input->post('myself'),
				'designer_profile'=>$file_name
			); */
			$up = array (
				'designer_intro'=>$this->input->post('myself'),
				'designer_profile'=>$file_name
			);
			
			$this->Common_model->update_record('designer_table',$up, array('id'=>$did));
			$this->session->set_flashdata('message','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Your profile has been updated successfully.</div>');
			redirect('admin/myprofile_designer');
		}
		else{
			$this->session->set_flashdata('valid_error','<div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Please check your given detials.</div>');
			redirect('admin/myprofile_designer');	
		}
	}
	
	public function myprofile_designerportfolio(){
		$user_id = $this->session->userdata('user_id');
		$data['designs']=$this->Common_model->get_records('designs','*',array("design_status"=>1,"designer_id"=>$user_id));

		$data['content']='front/myprofile_designerportfolio';
		
		if(!empty($user_id)){
			$this->load->view('front/template',$data);
		}
		else{
			redirect(base_url("admin/loginForm"));
		}
	}
	
	
	public function message_designer(){
		$user_id=$this->session->userdata('user_id');
		$data['messagelist'] = $this->Common_model->get_records_order_by("design_comments","*",array("toview_id"=>$user_id,"status"=>0),'dcmd_id','DESC');
		$data['content']='front/message_designer';
		$this->load->view('front/template',$data);
	}
	
	public function payment_designer(){
		$designer_id=$this->session->userdata('user_id');
		$data['request']=$this->Contest_model->designer_transaction($designer_id);
		$data['content']='front/payment_designer';
		$this->load->view('front/template',$data);
	}
	
	public function payment_referral(){
		$ref_id=$this->session->userdata('user_id');
		$data['request']=$this->Contest_model->referral_transaction($ref_id);
		$data['content']='front/payment_referral';
		$this->load->view('front/template',$data);
	}

	public function new_referral_details(){
		$ref_id=$this->session->userdata('user_id');
		$data['request']=$this->Contest_model->referral_transaction($ref_id);
		$data['content']='front/new_referral_details';
		$this->load->view('front/template',$data);

	}

	public function portfolio_designer(){
		$data['content']='front/portfolio_designer';
		$this->load->view('front/template',$data);
	}
	
	public function joined_designer(){
		$data['content']='front/joined_designer';
		$user_id = $this->session->userdata('user_id');
		$data['join_record']=$this->Admin_model->join_design($user_id);
		$this->load->view('front/template',$data);
	}
	
	public function finalist_designer(){
		$user_id = $this->session->userdata('user_id');
		$data['content']='front/finalist_designer';
		$data['records']=$this->Admin_model->finalistdesigner($user_id);
		$this->load->view('front/template',$data);
	}
	
	public function invited_designer(){
		$user_id = $this->session->userdata('user_id');
		$data['records']=$this->Admin_model->finalistdesigner($user_id);
		$data['content']='front/invited_designer';
		$this->load->view('front/template',$data);
	}
	
	public function winning_designer(){
		$user_id = $this->session->userdata('user_id');
		$data['designer_id']=$user_id;
		$data['records']=$this->Admin_model->wining_design($user_id);	
		$data['content']='front/winning_designer';
		$this->load->view('front/template',$data);
	}
	
	public function taggled_designer(){
		
		$data['content']='front/taggled_designer';
		$this->load->view('front/template',$data);
	}
	
	public function change_password_designer(){	
		$data['userid']=$this->session->userdata('user_id');		
		$data['content']='front/change_password_designer';
		$this->load->view('front/template',$data);
	}
	
	
	public function save_password_designer(){
		$userid = user_id();
		$oldpwd = $this->input->post('oldpassword');
		$newpwd = $this->input->post('newpassword');
		$conpwd = $this->input->post('confirmpassword');		
		$checkdb = $this->Common_model->get_record('designer_table','*',array('users_id'=>$userid));
		if(isset($checkdb) && !empty($checkdb) && ($oldpwd == $checkdb->designer_password))
		{
			if($newpwd == $conpwd)
			{
				$where['users_id'] = $userid;
				$values['designer_password']= $newpwd;
				$where1['user_id'] = $userid;
				$values1['user_pwd']= $newpwd;	
				$this->Common_model->update_record("designer_table",$values,$where);
				$this->Common_model->update_record("user_table",$values1,$where1);
				$msgresult = 'Password Changed Successfully !!!.' ;
				$this->session->set_flashdata('message_name', '<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Password Changed Successfully !!!.</div>');		
				
				/**************Notification Email **************/		
					
					$to = $checkdb->designer_email;
					$data['email'] = $to;
					$data['message'] = 'Your password has been changed.';
					$message = $this->load->view('front/newsletter/change_password',$data,true);					
					rp_send_email($to,'Contest Hours Change Password ',$message);
							
				/**************Notification Email **************/	
				
				redirect('admin/logout');
				
			} else {
				$msgresult='Password Not Matched!!!.';
				$this->session->set_flashdata('message_name', '<div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Password Not Matched!!!.</div>');		
			}
		}
		else{
			$this->session->set_flashdata('message_name', '<div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Invalid Password Not Matched!!!.</div>');
		
		}	
		redirect('admin/change_password_designer');
	}
	
	public function change_password_referral(){	
		$data['userid']=$this->session->userdata('user_id');		
		$data['content']='front/change_password_referral';
		$this->load->view('front/template',$data);
	}
	
	
	public function save_password_referral(){
		$userid = user_id();
		$oldpwd = $this->input->post('oldpassword');
		$newpwd = $this->input->post('newpassword');
		$conpwd = $this->input->post('confirmpassword');		
		$checkdb = $this->Common_model->get_record('referral_table','*',array('users_id'=>$userid));
		if(isset($checkdb) && !empty($checkdb) && ($oldpwd == $checkdb->referral_password))
		{
			if($newpwd == $conpwd)
			{
				$where['users_id'] = $userid;
				$values['referral_password']= $newpwd;
				$where1['user_id'] = $userid;
				$values1['user_pwd']= $newpwd;	
				$this->Common_model->update_record("referral_table",$values,$where);
				$this->Common_model->update_record("user_table",$values1,$where1);
				$msgresult = 'Password Changed Successfully !!!.' ;
				$this->session->set_flashdata('message_name', '<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Password Changed Successfully !!!.</div>');		
				
				/**************Notification Email **************/		
					
					$to = $checkdb->designer_email;
					$data['email'] = $to;
					$data['message'] = 'Your password has been changed.';
					$message = $this->load->view('front/newsletter/change_password',$data,true);					
					rp_send_email($to,'Contest Hours Change Password ',$message);
							
				/**************Notification Email **************/	
				
				redirect('admin/logout');
				
			} else {
				$msgresult='Password Not Matched!!!.';
				$this->session->set_flashdata('message_name', '<div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Password Not Matched!!!.</div>');		
			}
		}
		else{
			$this->session->set_flashdata('message_name', '<div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Invalid Password Not Matched!!!.</div>');
		
		}	
		redirect('admin/change_password_referral');
	}
	
	public function myprofile_client(){
		$user_id = $this->session->userdata('user_id');
		$data['country'] = $this->Common_model->get_records('country_tb');
		$data['user_details'] = $this->Common_model->get_client_details($user_id);
		$data['content']='front/myprofile_client';
		if(!empty($data['user_details'])){
			$this->load->view('front/template',$data);
		}
		else{
			redirect(base_url("admin/loginForm"));
		}
	}
	
	public function update_clientinfo(){
		$user_id = $this->session->userdata('user_id');
		$data['user_details'] = $this->Common_model->get_client_details($user_id);
		$data['content']='front/update_clientinfo';
		if(!empty($user_id)){
			$this->load->view('front/template',$data);
		}
		else{
			redirect(base_url("admin/loginForm"));
		}
	}
	
	public function edit_client_info($cid='') {
		
		if(!empty($_FILES['profile_photo']['name'])){
			$config['upload_path']= './uploads/client_profile';
			$config['allowed_types'] = 'gif|jpg|png';
			
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('profile_photo'))
			{
				if(!empty($_REQUEST['old_file_name'])){
					unlink("uploads/client_profile/".$_REQUEST['old_file_name']);
				}
			
				$upload_data=array('upload_data'=>$this->upload->data());
				print_r($upload_data);
				$file_name=$upload_data['upload_data']['file_name'];
				
			}
			else
			{	
				$error = array('error' => $this->upload->display_errors());
				redirect('admin/edit_client_info');
			}
		}
		else{
			$file_name=$_REQUEST['old_file_name'];
		}
		//echo $file_name; exit;
		$this->form_validation->set_rules('myself', 'About Your Self', 'required');
		if($this->form_validation->run() == TRUE)
		{
			$up = array ( 
				'intro'=>$this->input->post('myself'),
				'profile'=>$file_name
			);
		
			$this->Common_model->update_record('client_table',$up, array('id'=>$cid));
			
			$this->session->set_flashdata('message','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Your profile has been updated successfully.</div>');
			redirect('admin/myprofile_client');
		}
		else{
			$this->session->set_flashdata('valid_error','<div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Please check your given detials.</div>');
			redirect('admin/myprofile_client');
		}
	}
	
	public function message_client(){
		$this->Contest_model->check_client_login();
		$client_id=$this->session->userdata('user_id');

		$data['messagelist'] = $this->Common_model->get_records_order_by("design_comments","*",array("toview_id"=>$client_id,"status"=>0),'dcmd_id','DESC');

		$data['content']='front/message_client';
		$this->load->view('front/template',$data);
	}
	
	public function designer_notification(){
		$user_id=user_id();
		
		
		$data['messagelist'] = $this->Common_model->get_records_order_by("client_notification","*",array("to_id"=>$user_id,"status"=>0),'id','DESC');
		
		$update= $this->Common_model->update_record("client_notification",array("read_status"=>1),array("to_id"=>$user_id,"status"=>0));

		$data['content']='front/designer_notification';
		$this->load->view('front/template',$data);
	}
	
	public function client_notification(){
		$this->Contest_model->check_client_login();
		$client_id=$this->session->userdata('user_id');
		
		
		$data['messagelist'] = $this->Common_model->get_records_order_by("client_notification","*",array("to_id"=>$client_id,"status"=>0),'id','DESC');
		
		$update= $this->Common_model->update_record("client_notification",array("read_status"=>1),array("to_id"=>$client_id,"status"=>0));

		$data['content']='front/client_notification';
		$this->load->view('front/template',$data);
	}
	
	public function mycontest_client(){
		$this->Contest_model->check_client_login();
		$client_id=$this->session->userdata('user_id');
		$data['my_con']=$this->Common_model->get_records_order_by('contest','*',array('client_id'=>$client_id,"status!="=>"draft"),'id','DESC');
		$data['content']='front/mycontest_client';
		$this->load->view('front/template',$data);
	}
	
	public function mylivecontest_client(){
		$this->Contest_model->check_client_login();
		$client_id=$this->session->userdata('user_id');
		$data['my_live_con']=$this->Common_model->get_records_order_by('contest','*',array('client_id'=>$client_id,'status'=>'open','delete_status'=>0),'id','DESC');
		$data['content']='front/mylivecontest_client';
		$this->load->view('front/template',$data);
	}
	
	public function in_judgging(){
		$this->Contest_model->check_client_login();
		$client_id=$this->session->userdata('user_id');
		$data['judge_con']=$this->Common_model->get_records_order_by('contest','*',array('client_id'=>$client_id,'status'=>'judging','delete_status'=>0),'id','DESC');
		$data['content']='front/in_judgging';
		$this->load->view('front/template',$data);
	}
	
	public function draft_client(){
		$this->Contest_model->check_client_login();
		$client_id=$this->session->userdata('user_id');
		$data['draft_con']=$this->Common_model->get_records_order_by('contest','*',array('client_id'=>$client_id,'status'=>'draft','delete_status'=>0),'id','DESC');
		$data['content']='front/draft_client';
		$this->load->view('front/template',$data);
	}
	
	public function mycompleted_client(){
		$this->Contest_model->check_client_login();
		$client_id=$this->session->userdata('user_id');
		$data['comp_con']=$this->Common_model->get_records_order_by('contest','*',array('client_id'=>$client_id,'status'=>'completed','delete_status'=>0),'id','DESC');
		$data['content']='front/mycompleted_client';
		$this->load->view('front/template',$data);
	}
	
	public function contact_support(){
		$this->Contest_model->check_client_login();
		$data["support"]= $this->Common_model->get_records("support_type");
		$data['content']='front/contact_support';
		$this->load->view('front/template',$data);
	}	
	public function client_referral_code(){
		$this->Contest_model->check_client_login();
		$client_id=$this->session->userdata('user_id');
		$data['referral_code'] = $this->Contest_model->get_referral_id($this->session->userdata('user_id')); 
		$data['content']='front/client_referral_code';
		$this->load->view('front/template',$data);
	}
	public function designer_referral_code(){
		$client_id=$this->session->userdata('user_id');
		$data['referral_code'] = $this->Contest_model->get_referral_id($this->session->userdata('user_id')); 
		$data['content']='front/designer_referral_code';
		$this->load->view('front/template',$data);
	}
	public function save_support()
    {
		$date= date("Y-m-d H:i:s");
		$config['upload_path']= './uploads/supportfiles';
		$config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|txt|doc';
		$client_id=$this->session->userdata('user_id');
		print_r($_FILES);
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		if (!empty($_FILES['support_file']['name'])){
				if($this->upload->do_upload('support_file'))
				{	
					$upload_data=array('upload_data'=>$this->upload->data());
					$file_name=$upload_data['upload_data']['file_name'];
				}
				else
				{	
					$error = array('error' => $this->upload->display_errors());
					//print_r($error);
				}
		}
			
		$this->form_validation->set_rules('support_payment','Title', 'required');
		$this->form_validation->set_rules('message', 'This is required.', 'required');
		$file_name = (!empty($file_name))?$file_name:"";
		
		if($this->form_validation->run() == TRUE)
		{	
			$data = array(
				'support_type' => $_POST['support_payment'],
				'subject' => $_POST['intro'],
				'message' => $_POST['message'],
				'support_file' =>$file_name,
				'user_id'  =>$client_id,
				'createdtime' => $date
				
			);
			$bill_id = $this->Common_model->insert_record("support_message", $data);
			$this->session->set_flashdata('message','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Your Contact Support  successfully.</div>');
		}
		else{
			$this->session->set_flashdata('valid_error','<div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Please fill Support type and Subject Elements.</div>');
		}
		
		redirect("admin/contact_support");
    }
	
	public function change_password_client(){
		$this->Contest_model->check_client_login();
		$data['userid']=$this->session->userdata('user_id');
	
		$data['content']='front/change_password_client';
		$this->load->view('front/template',$data);
	}
	
	public function save_password_client(){
		$userid = $this->input->post('userid');
		$oldpwd = $this->input->post('oldpassword');
		$newpwd = $this->input->post('newpassword');
		$conpwd = $this->input->post('confirmpassword');		
		$checkdb = $this->Common_model->get_record('client_table','*',array('users_id'=>$userid));
	
		if(isset($checkdb) && !empty($checkdb) && ($oldpwd == $checkdb->password))
		{
			if($newpwd == $conpwd)
			{
				$where['users_id'] = $userid;
				$values['password']= $newpwd;

				$where1['user_id'] = $userid;
				$values1['user_pwd']= $newpwd;				
				$this->Common_model->update_record("client_table",$values,$where);
				$this->Common_model->update_record("user_table",$values1,$where1);
				$msgresult = 'Password Changed Successfully !!!.' ;
				$this->session->set_flashdata('message_name', '<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Password Changed Successfully !!!.</div>');		
					
		
				/**************Notification Email **************/		
					
					$to = $checkdb->email;
					$data['email'] = $to;
					$data['message'] = 'Your password has been changed.';
					$message = $this->load->view('front/newsletter/change_password',$data,true);					
					rp_send_email($to,'Contest Hours Change Password ',$message);
							
				/**************Notification Email **************/	
				
				redirect('admin/logout');
			
			
			} else {
				$msgresult='Password Not Matched!!!.';
				$this->session->set_flashdata('message_name', '<div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Password Not Matched!!!.</div>');		
			}
		}
		else{
			$this->session->set_flashdata('message_name', '<div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Invalid Password Not Matched!!!.</div>');
		
		}	

		 redirect('admin/change_password_client');
	}
	
	public function readmessage(){
	
	$dcmdid = $this->input->post('dcmdid');
	$this->Common_model->update_record("design_comments",array("read"=>1),array("dcmd_id"=>$dcmdid));
		
	}
	
	
	public function deletemessage(){
	
	$dcmdid = $this->input->post('dcmdid');
	$this->Common_model->update_record("design_comments",array("status"=>1),array("dcmd_id"=>$dcmdid));
		
	}
	
	public function forgetpwd(){
		
		if($_POST)
		{
			$email = $this->input->post("email");
			$result = $this->Common_model->get_record("user_table","*",array("user_email"=>$email));
			
			if(isset($result) && !empty($result))
			{
				
				
			/**************Notification Email **************/		
			$name = $result->user_name;		
			$to = $result->user_email;
			$pwd = $result->user_pwd;
			
			
			$data['email'] = $to;
			$data['message'] = $name.' your Current Password is '.$pwd;
		
			$message = $this->load->view('email/change_password',$data,true);
					
			rp_send_email($to,'Forget Password ',$message);
					
			/**************Notification Email **************/
			
				$this->session->set_flashdata('message','<div class="alert alert-block alert-success" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  You Password Sent Successfully to your E-Mail Id. Please Check it.</div>');
		
			} else 
			{
				$this->session->set_flashdata('message','<div class="alert alert-block alert-success" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i> Invalid User Mail Id.</div>');
			}
		
		}	
			$data['content']='front/forgetpwd1';
			$this->load->view('front/template1',$data); 
		
	}
	
	private function common_pagination($url,$total_rows,$per_page =10,
	$uri_segment = FALSE){
        $this->load->library('pagination');
        $config['base_url'] = $url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        if($uri_segment){
            $config['uri_segment'] = $uri_segment;
        }
        $this->pagination->initialize($config);
        return $config;
   }
	
    public function about(){
        $data['content']='front/about';
		$this->load->view('front/template',$data);
	}
	
    public function faq(){
        $data['content']='front/faq';
		$this->load->view('front/template',$data);
	}
	public function client_faq(){
		$data['content']='front/client_faq';
		$this->load->view('front/template1',$data);
	}
	public function designer_faq(){
		$data['content']='front/designer_faq';
		$this->load->view('front/template1',$data);
	}
	
    public function codeofconduct(){
        $data['content']='front/codeofconduct';
		$this->load->view('front/template',$data);
	}

	public function privacy_policy(){
        $data['content']='front/privacy_policy';
		$this->load->view('front/template',$data);
	}
	
    public function designerCourt($start=0){
        $data['content']='front/designercourt';
		
		$data['designer_report']=$this->Common_model->get_records_orderby_limit('desiner_report','*','','createdtime','DESC',10,$start);
		
		$data['count_contests']=$this->Common_model->get_records_count('desiner_report');
		$this->load->view('front/template',$data);
	}
	
	public function report_data_view($rid){
		$data['result']= $rdata =$this->Common_model->get_record("desiner_report",'*',array('id'=>$rid));
		
		$data['rep_design']=$this->Common_model->get_record('designs','',array('designer_id'=>$rdata->report_designer,'contest_id'=>$rdata->contest_id,'design_no'=>$rdata->reporter_design));
		
		$data['cp_design']=$this->Common_model->get_record('designs','',array('designer_id'=>$rdata->copy_designer,'contest_id'=>$rdata->contest_id,'design_no'=>$rdata->copy_design));
		
		$data['content']='front/report_data_view';
		$this->load->view('front/template',$data);
	}
	
	public function notifications($start=0){
		$data['content']='front/notifications';
		$data['announcement']=$this->Common_model->get_records_orderby_limit('announcements','*',array('status'=>0),'createdtime','DESC',10,$start);
		$data['count_contests']=$this->Common_model->get_records_count('announcements',array('status'=>0));
		$this->load->view('front/template',$data);
	}
	
	public function contactus(){
		$data["support"]= $this->Common_model->get_records("support_type");
		$data['content']='front/contactus';
		$this->load->view('front/template',$data);
	}
	
	public function mailContact(){
		$name= $_POST['name'];
		$email= $_POST['email'];
		$subject = $_POST['subject'];
		$text = $_POST['intro'];
		$to = admin_mail();
		
		$message="From: $name ($email), <br>Subject: $subject,<br>Message: $text.";
		if($email!=""){
		rp_send_email($to, $subject, $message);	
		
		$this->session->set_flashdata('message','<div class="alert alert-block alert-success" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Your message sent successfully.</div>');
		}
		redirect("admin/contactus");
	}
	
	public function mailCron(){
		
		/****** Qualifying Stage Completion Mail ******/
		$get=$this->Common_model->get_records('contest','',array('admin_status'=>1,"status"=>"judging", "TIMESTAMPDIFF(MINUTE,`close_date`, now())>="=>0, "TIMESTAMPDIFF(MINUTE,`close_date`, now())<"=>5000));
		if(!empty($get)){
			foreach($get as $tmp){
				$url= base_url()."contest/contest_entries/".$tmp->id;
				$to = "sahayajeswin@gmail.com"; //get_email($tmp->client_id);
				$subject="Please Choose the finalists for your contest.";
				$message= "Your Contest Qualifying Time Was Over, Please Choose the Finalist For the next process.";
				$message .= "Link: <a href='$url'>".contestname($tmp->id)."</a>";
				
				rp_send_email($to, $subject, $message);
			}
		}
		
		/***** Choose Winner Mail ****/
		$win= $this->Common_model->get_records('contest','',array('admin_status'=>1,"status"=>"judging", "TIMESTAMPDIFF(MINUTE,`judging_close_date`, now())>="=>0, "TIMESTAMPDIFF(MINUTE,`judging_close_date`, now())<"=>5000));
		print_r($win);
		if(!empty($win)){
			foreach($win as $tmp){
				$url= base_url()."contest/contest_entries/".$tmp->id;
				$to = "sahayajeswin@gmail.com"; //get_email($tmp->client_id);
				$subject="Please Choose the finalists for your contest.";
				$message= "Your Contest Qualifying Time Was Over, Please Choose the Finalist For the next process.";
				$message .= "Link: <a href='$url'>".contestname($tmp->id)."</a>";
				rp_send_email($to, $subject, $message);
			}
		}
		
		/***** Confirm Package Mail ****/
		$pack=$this->Common_model->get_records('contest','',array('admin_status'=>1,"status"=>"completed", "TIMESTAMPDIFF(hour,`package_downloadtime`, now())>="=>2, "TIMESTAMPDIFF(hour,`package_downloadtime`, now())<"=>3));
		print_r($pack);
		
		if(!empty($pack)){
			foreach($pack as $tmp){
				$url= base_url()."contest/contest_entries/".$tmp->id;
				$to = "sahayajeswin@gmail.com"; //get_email($tmp->client_id);
				$subject="Please Confirm the download package of your contest.";
				$message= "Please Confirm Designer's Upload Package.";
				$message .= "Link: <a href='$url'>".contestname($tmp->id)."</a>";
				rp_send_email($to, $subject, $message);
			}
		}
	}

	public function about_elaborate(){
		$data['content']='front/about_elaborate1';
		$this->load->view('front/template1',$data);
	}

	public function startnow(){
		$data['content']='front/start_now1';
		$this->load->view('front/template1',$data);
	}
		public function startnow2(){
		$list_industries=$this->Common_model->get_records('industry');
		$data['industries'] = $list_industries;
		$data['setpack']=$this->Common_model->get_record('update_package');
		$this->load->view('front/start_now2',$data);
	}

	  public function package_convertion(){
    	$grand = $this->input->post('grand');
    	if(getCountry() == 'IN'){
				echo  number_format(convertCurrency($grand),2);
			  }
    }
}
?>
