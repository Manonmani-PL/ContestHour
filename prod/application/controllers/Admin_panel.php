<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_panel extends CI_Controller {
	
	var $publicMethods  = array("index","restricted","view_page","view_page_designer","view_page","view_page_designer","view_page_referral","referral_single_view","new_contest","open_contest","judging_contest","completed_contest","incomplete_contest","designer_single_view","client_single_view","new_contest_view","open_contest_view","contest_view","judging_contest_view","incomplete_contest_view","change_password","logout","package_contest","add_package_cost","contest_price_setting","payment_request","view_payment_rquest","transaction_update","referral_transaction_update","payment_request_complete","referral_payment_request_complete","admin_change_password","test","report_warning", "view_payment_rquest", "contest_report", "bestbuy_report", "bestbuy_category_pricing_setting", "bestbuy_package_contest");
	
	public function __Construct()
	{
        parent::__construct();
		$this->load->model(array('Common_model','Contest_model','Admin_model'));
		$this->load->helper('url');
		$this->load->library(array('form_validation','session','upload','encrypt'));
	
	
		$logged_in = is_admin_logged_in();		
		$currentMethod = $this->router->fetch_method();
		if(in_array($currentMethod,$this->publicMethods) == false){
			if(!$logged_in){
				redirect("admin_panel/index");
			}
		}
		$admin_id=$this->session->userdata('admin_id');
    }
	
	public function index(){
		if($this->session->userdata('admin_id')&&$this->session->userdata('admin_name'))
		{
			 redirect('admin_panel/view_page');
		}
		if($_POST)
		{	
		  $this->form_validation->set_rules('username', 'Username', 'required');
		  $this->form_validation->set_rules('password', 'Password', 'required');
		  $admin_check = $this->Admin_model->check_login();
		  //echo $admin_details; exit;
		  if($this->form_validation->run())
			{
			 	//print_r($admin_check); exit;
				if(!empty($admin_check)){
					$admin_details = $this->Admin_model->get_admin_details();
					//print_r($admin_details); exit;
					$this->session->set_userdata('admin_id', $admin_details['admin_id']); // passing "admin_id" session
					$this->session->set_userdata('admin_name', $admin_details['email']);  // passing "admin_name" session
					redirect('admin_panel/view_page');
				}
				else
				{
					$this->session->set_flashdata('login_fail','<span style="color:#d16e6c; font-weight:bold;">* Invalid username or password.</span>'); // Login fail error msg
					redirect('admin_panel');
				}
			}
			
		}
		$this->load->view('back/admin_login');
	}
	
	public function logout()
	{
		//$session_variables = (array("admin_id"=>"","admin_name"=>""));
		//$this->session->unset_userdata($session_variables); 
		$this->session->sess_destroy();
		redirect("admin_panel");
	}
	
	public function notifications() 
	{
		$data['page_name'] ='Notifications';
		$this->Admin_model->check_user_login();
		$data['notifications']=$this->Common_model->get_records_order_by('notification',"*",'',"noti_entry_time","DESC");
		$data['content']='back/notifications';
		$this->load->view('back/template',$data);
	}
	
	public function noti_newajax() 
	{
		if($this->input->post('status')){
			$noti_update=$this->Common_model->update_record('notification',array('noti_new_status'=>1),array('noti_new_status'=>0));
			return true;
		}
	}	
	
	public function view_page() 
	{
		$data['page_name'] ='client';
		$this->Admin_model->check_user_login();
		$data['country'] = $this->Common_model->get_records('country_tb');
		$data['client_details']=$this->Common_model->get_records_order_by('client_table',"*",array("status"=>1),"id","DESC");
		$data['content']='back/view_page';
		$this->load->view('back/template',$data);
	}
	
	public function client_single_view($cid)
	{
		$data['page_name'] ='client';
		$noti_update=$this->Common_model->update_record('notification',array('noti_view_status'=>1),array('noti_type'=>2,'noti_ref_id'=>$cid));
		$this->Admin_model->check_user_login();
		$data['country'] = $this->Common_model->get_records('country_tb');
		$data['result']=$this->Common_model->get_record('client_table','*',array('users_id'=>$cid));
		
		$data['records']=$this->Common_model->get_records('contest','*',array('client_id'=>$cid));
		
		
		$data['content']='back/client_single_page';
		$this->load->view('back/template',$data);
	}
	
	public function change_password()
	{
		$data['page_name'] ='change_pass';
		$this->Admin_model->check_user_login();
		$data['content']='back/change_password';
		$this->load->view('back/template',$data);
	}
	
	public function admin_change_password()
	{
		$old_pass = $this->input->post('old_pass');
		$new_pass = $this->input->post('new_pass');
		$up_pass = $this->input->post('re_pass');
		$admin_id = $this->session->userdata('admin_id');
		
		
		$record = $this->Common_model->get_record("admin_table","*",array('admin_id'=>$admin_id,"password"=>$old_pass));
		if(isset($record) && !empty($record))
		{
			if($new_pass == $up_pass)
			{
					$this->Common_model->update_record('admin_table',array('password'=>$up_pass),array('admin_id'=>$admin_id));
		
		$this->session->set_flashdata('message','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Your Admin password has been updated successfully.</div>');
		
			} else
			{
				$this->session->set_flashdata('message','<div class="alert alert-block alert-warning"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Password is mismatch .</div>');
		
			}				
		} else
		{
			$this->session->set_flashdata('message','<div class="alert alert-block alert-warning"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Invalid Old Password .</div>');
		
		}
	
		redirect('admin_panel/change_password');
	}
	
	public function view_page_designer() 
	{
		$data['page_name'] ='designer';
		$this->Admin_model->check_user_login();
		$data['country'] = $this->Common_model->get_records('country_tb');
		$data['designer_details']=$this->Common_model->get_records_order_by('designer_table',"*",array("designer_status"=>1),"id","DESC");
		$data['content']='back/view_page_designer';
		$this->load->view('back/template',$data);
	}
	
	public function view_page_referral() 
	{
		$data['page_name'] ='referral';
		$this->Admin_model->check_user_login();
		$data['country'] = $this->Common_model->get_records('country_tb');
		$data['referral_details']=$this->Common_model->get_records_order_by('referral_table',"*",array("referral_status"=>1),"id","DESC");
		$data['content']='back/view_page_referral';
		$this->load->view('back/template',$data);
	}

	public function referral_single_view($rid)
	{
		$data['page_name'] ='referral';
		$noti_update=$this->Common_model->update_record('notification',array('noti_view_status'=>1),array('noti_type'=>1,'noti_ref_id'=>$rid));
		$this->Admin_model->check_user_login();
		$data['country'] = $this->Common_model->get_records('country_tb');
		$data['result']=$this->Common_model->get_record('referral_table','',array('users_id'=>$rid));
		/*$data['records']=$this->Admin_model->designer_contest($rid);*/

		$user_id=$this->session->userdata('user_id');
		/*$data['balance']=designer_balance($cid);*/
		
		$data['content']='back/referral_single_page';
		$this->load->view('back/template',$data);
	}

	public function designer_single_view($cid)
	{
		$data['page_name'] ='designer';
		$noti_update=$this->Common_model->update_record('notification',array('noti_view_status'=>1),array('noti_type'=>1,'noti_ref_id'=>$cid));
		$this->Admin_model->check_user_login();
		$data['country'] = $this->Common_model->get_records('country_tb');
		$data['result']=$this->Common_model->get_record('designer_table','',array('users_id'=>$cid));
		$data['records']=$this->Admin_model->designer_contest($cid);

		$user_id=$this->session->userdata('user_id');
		$data['balance']=designer_balance($cid);
		
		$data['content']='back/designer_single_page';
		$this->load->view('back/template',$data);
	}
	
	public function designer_transactions($id) 
	{
		$data['page_name'] ='Designer Transactions';
		$this->Admin_model->check_user_login();
		$data['request'] = $this->Contest_model->designer_transaction($id);
		$data['content']='back/designer_transactions';
		$this->load->view('back/template',$data);
	}
	
	public function completed_contest($id = '1')
	{
		$data['posted'] = $id;
		$data['page_name'] ='com_con';
		$this->Admin_model->check_user_login();
		$data['contest_details']=$this->Common_model->get_records_order_by('contest','*',array('status'=>'completed','posted_from'=>$id),"id","DESC");
		$data['content']='back/completed_contest';
		$this->load->view('back/template',$data);
	}
	
	public function complete_delete($id = ''){
		$this->Common_model->delete_record('contest',array('id'=>$id));
		redirect('admin_panel/completed_contest');
	}
	public function contest_view($cid='')
	{
		$data['page_name'] ='view_con';
		$noti_update=$this->Common_model->update_record('notification',array('noti_view_status'=>1),array('noti_type'=>0,'noti_type'=>3,'noti_type'=>4,'noti_ref_id'=>$cid));
		//$cid = $this->encrypt->decode($cid);
		$this->Admin_model->check_user_login();
		$data['cont_det']=$this->Common_model->get_records('contest','',array('id'=>$cid));
		$list_industries=$this->Common_model->get_records('industry');
		$data['industries'] = $list_industries;
		$data['content']='back/contest_view_page';
		$this->load->view('back/template',$data);
	}
	
	public function new_contest()
	{
		$data['page_name'] ='new_con';
		$this->Admin_model->check_user_login();
		$data['contest_details']=$this->Common_model->get_records_order_by('contest','*',array('admin_status'=>0,'status'=>'open'),"id","DESC");
		$data['content']='back/new_contest';
		$this->load->view('back/template',$data);
	}
	
	public function new_contest_view($cid='')
	{
		$data['page_name'] ='new_con';
		$this->Admin_model->check_user_login();
		$data['cont_det']=$this->Common_model->get_records('contest','*',array('id'=>$cid));
		
		$data['content']='back/new_contest_view_page';
		$this->load->view('back/template',$data);
	}
	
	public function contest_status($cid='')
	{
		$admin_id=$this->session->userdata('admin_id');
		$update_records = array(
			'admin_status' => 1,
			'admin_id'=> $admin_id,
			'date_of_approval' => date('Y-m-d H:i:s')
		);
		$this->Common_model->update_record('contest',$update_records, array('id'=>$cid));
		$this->session->set_flashdata('message','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  You have successfully approved a new contest.</div>');
		redirect('admin_panel/new_contest');
	}
	
	public function open_contest($id = '1')
	{
		$data['posted'] = $id;
		$data['page_name'] ='open_con';
		$this->Admin_model->check_user_login();
		$data['contest_details']=$this->Common_model->get_records_order_by('contest','*',array('admin_status'=>1,'status'=>'open','posted_from'=>$id),"id","DESC");
		$data['content']='back/open_contest';
		$this->load->view('back/template',$data);
	}
	
	public function open_contest_view($cid='')
	{
		$data['page_name'] ='open_con';
		$this->Admin_model->check_user_login();
		$data['cont_det']=$this->Common_model->get_records('contest','',array('id'=>$cid));
		$data['content']='back/open_contest_view_page';
		$this->load->view('back/template',$data);
	}

	public function contest_delete($cid=""){
		$this->Common_model->delete_record('contest',array('id'=>$cid));
		redirect ("admin_panel/open_contest");
	}
	
	public function judging_contest($id = '1')
	{
		$data['posted'] = $id;
		$data['page_name'] ='jud_con';
		$this->Admin_model->check_user_login();
		$data['contest_details']=$this->Common_model->get_records_order_by('contest','*',array('status'=>'judging','posted_from'=>$id),"id","DESC");
		$data['content']='back/judging_contest';
		$this->load->view('back/template',$data);
	}
	
	public function judging_delete($cid=""){
		$this->Common_model->delete_record('contest',array('id'=>$cid));
		redirect("admin_panel/judging_contest");
	}
	public function judging_contest_view($cid='')
	{
		$data['page_name'] ='jud_con';
		$this->Admin_model->check_user_login();
		$data['cont_det']=$this->Common_model->get_records('contest','',array('id'=>$cid));
		$data['content']='back/judging_contest_view_page';
		$this->load->view('back/template',$data);
	}
	
	public function draft_contest($id = '1')
	{
		$data['posted'] = $id;
		$data['page_name'] ='in_draft';
		$this->Admin_model->check_user_login();
		$data['contest_details']=$this->Common_model->get_records_order_by('contest','*',array('status'=>'draft','posted_from'=>$id),"id","DESC");
		$data['content']='back/draft_contest';
		$this->load->view('back/template',$data);
	}
	
	public function draft_contest_view($cid='')
	{
		$data['page_name'] ='in_draft';
		$this->Admin_model->check_user_login();
		$data['cont_det']=$this->Common_model->get_records('contest','',array('id'=>$cid));
		$data['content']='back/draft_contest_view_page';
		$this->load->view('back/template',$data);
	}

	public function draft_contest_delete($cid=""){
		$this->Common_model->delete_record('contest',array('id'=>$cid));
		redirect('admin_panel/draft_contest');
	}
	
	public function relaunch_contest()
	{
		$data['page_name'] ='jud_con';
		$this->Admin_model->check_user_login();
		$data['contest_details']= $this->Common_model->get_records_order_by('contest','*',array('status'=>'open'),"id","DESC");
		$data['content']='back/relaunch_contest';
		$this->load->view('back/template',$data);
	}
	
	public function contest_relaunch($id)
	{
		$where['id'] =$id;
		$this->Admin_model->check_user_login();
		$chk= $this->Common_model->get_records("designs","*",array("contest_id"=>$id,"design_status"=>1));
		
		if(empty($chk)){
			$update= $this->Admin_model->contest_relaunch($id);
			$fdesign= $this->Common_model->update_record("designs", array("final_status"=>0), array("contest_id"=>$id, "design_status"=>1));
			$this->session->set_flashdata('message','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>Contest Successfully Re-Launched.</div>');
		}
		else{
			$this->session->set_flashdata('message','<div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-remove red"></i>Can\'t Delete There is a winner already for this contest.</div>');
		}
		
		redirect($this->agent->referrer());
	}
	
	public function contest_report()
	{
		$data['page_name'] ='contest_report';
		$data['contest_list']=$this->Admin_model->all_contest_report(1);
		$data['content']='back/contest_report';
		$this->load->view('back/template',$data);
	}
	
	public function bestbuy_report()
	{
		$data['page_name'] ='contest_report';
		$data['contest_list']=$this->Admin_model->all_contest_report(2);
		$data['content']='back/bestbuy_report';
		$this->load->view('back/template',$data);
	}
	
	public function referral_report()
	{
		$data['page_name'] ='contest_report';
		$data['coupon_code']= $this->Common_model->get_records("referral_code","*",array("ref_status"=>0));
		$data['content']='back/referral_report';
		$this->load->view('back/template',$data);
	}
	
	public function referral_userpayment_report()
	{
		$data['page_name'] ='contest_report';
		$data['referral_user_payment']=$this->Admin_model->all_referral_user_report();
		$data['content']='back/referral_userpayment_report';
		$this->load->view('back/template',$data);
	}
	
	public function package_contest()
	{
	 	$data['page_name'] ='package_con';
		$this->Admin_model->check_user_login();
		$data['setval'] = $this->Common_model->get_record("update_package","*",array("pay_package_id"=>1));
		 
		$data['content']='back/package_contest';
		$this->load->view('back/template',$data);
	}
	
	public function add_package_cost(){
		if($_POST)
		{
		     $values['list_fee'] = number_format($this->input->post('list_fee'),2);
			 $values['hours24'] = number_format($this->input->post('24hours'),2);
			 $values['hours48'] = number_format($this->input->post('48hours'),2);
			 $values['days3'] = number_format($this->input->post('3days'),2);
			 $values['days4'] = number_format($this->input->post('4days'),2);
			 $values['days5'] = number_format($this->input->post('5days'),2);
			 $values['days6'] = number_format($this->input->post('6days'),2);
			 $values['days7'] = number_format($this->input->post('7days'),2);
			 $values['top_des'] = number_format($this->input->post('top_des'),2);
			 $values['design_fee'] = number_format($this->input->post('design_fee'),2);
 			 $values['celebrity_fee'] = number_format($this->input->post('celebrity_fee'),2);
 			 $values['priv_fee'] = number_format($this->input->post('priv_fee'),2);
			 $values['featured_fee'] = number_format($this->input->post('featured_fee'),2);
			$values['referral_amount'] = number_format($this->input->post('referral_amount'),2);
			$values['referral_allow_user'] = $this->input->post('referral_allow_user');
			$result = $this->Common_model->get_record("update_package","*");
			if(isset($result) && !empty($result))
				$this->Common_model->update_record("update_package",$values,array("pay_package_id"=>1)); 
			else
				$this->Common_model->insert_record("update_package",$values); 
		}
		 $this->session->set_flashdata('message','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  You have successfully Change the Payment package details for the contest.</div>');			
			redirect('Admin_panel/package_contest');	
	}
	
	public function bestbuy_package_contest()
	{
	 	$data['page_name'] ='Bestbuy Contest Package Settings';
		$this->Admin_model->check_user_login();
		$data['setval'] = $this->Common_model->get_record("update_package_bestbuy","*",array("pay_package_id"=>1));
		 
		$data['content']='back/bestbuy_package_contest';
		$this->load->view('back/template',$data);
	}
	
	public function add_bestbuy_package_cost()
	
	{
		if($_POST)
		{
		     $values['list_fee'] = number_format($this->input->post('list_fee'),2);
			 $values['hours24'] = number_format($this->input->post('24hours'),2);
			 $values['hours48'] = number_format($this->input->post('48hours'),2);
			 $values['days3'] = number_format($this->input->post('3days'),2);
			 $values['days4'] = number_format($this->input->post('4days'),2);
			 $values['days5'] = number_format($this->input->post('5days'),2);
			 $values['days6'] = number_format($this->input->post('6days'),2);
			 $values['days7'] = number_format($this->input->post('7days'),2);
			 $values['top_des'] = number_format($this->input->post('top_des'),2);
			 $values['design_fee'] = number_format($this->input->post('design_fee'),2);
 			 $values['celebrity_fee'] = number_format($this->input->post('celebrity_fee'),2);
 			 $values['priv_fee'] = number_format($this->input->post('priv_fee'),2);
			 $values['featured_fee'] = number_format($this->input->post('featured_fee'),2);
		
			$result = $this->Common_model->get_record("update_package_bestbuy","*");
			if(isset($result) && !empty($result))
				$this->Common_model->update_record("update_package_bestbuy",$values,array("pay_package_id"=>1)); 
			else
				$this->Common_model->insert_record("update_package_bestbuy",$values); 
		}
		 $this->session->set_flashdata('message','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  You have successfully Change the Payment package details for the contest.</div>');			
		 redirect('admin_panel/bestbuy_package_contest');	
	}
	
	public function contest_price_setting()
	{
	 	$data['page_name'] ='contest_price_setting';
		$this->Admin_model->check_user_login();
		$data['setval'] = $this->Common_model->get_record("pricing_percentage","*",array("status"=>1));
		
		$data['content']='back/contest_price_setting';
		$this->load->view('back/template',$data);
	}
	
	public function save_price_setting(){
		if($_POST)
		{
		 	 $values['contest_percentage'] = number_format($this->input->post('contest_percentage'),2);
		     $values['winner_percentage'] = number_format($this->input->post('winner_percentage'),2);
			 $values['runner_percentage'] = number_format($this->input->post('runner_percentage'),2);
			 $values['transaction_charge'] = number_format($this->input->post('transaction_charge'),2);
			 $values['payable_price'] = number_format($this->input->post('payable_price'),2);
		
			 $result = $this->Common_model->get_record("pricing_percentage","*",array("status"=>1));
			if(isset($result) && !empty($result))
				$this->Common_model->update_record("pricing_percentage",$values,array("status"=>1)); 
			else
				$this->Common_model->insert_record("pricing_percentage",$values); 
		}
		
		$this->session->set_flashdata('message','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>Pricing Structure Successfully Modified.</div>');	
		redirect('admin_panel/contest_price_setting');	
	}
	
	public function payment_request(){
		$data['page_name'] ='payment_request';
		$this->Admin_model->check_user_login();
		$data['contest_details']=$this->Common_model->get_records_order_by('designer_debit','*',array('status'=>1),"request_date","DESC");
		$data['content']='back/payment_request';
		$this->load->view('back/template',$data);
	}
	
	public function new_reports()
	{ 
		$report['page_name'] ='new_reports';
		$report['rep']=$this->Common_model->get_records("desiner_report",'',array('report_status'=>0));
		$report['content'] ='back/new_reports';
		$this->load->view('back/template',$report);
	}
	
	public function old_reports()
	{ 
		$report['page_name'] ='old_reports';
		$report['rep']=$this->Common_model->get_records("desiner_report",'',array('report_status'=>1));
		$report['content'] ='back/old_reports';
		$this->load->view('back/template',$report);
	}
	
	public function report_details()
	{
		$data['page_name'] ='open_con';
		$data['cont_det']=$this->Common_model->get_records('contest','',array('id'=>$cid));
		$data['content']='back/open_contest_view_page';
		$this->load->view('back/template',$data);
	}
	
	public function report_data_view($rid)
	{ 				
		$noti_update=$this->Common_model->update_record('notification',array('noti_view_status'=>1),array('noti_type'=>5,'noti_ref_id'=>$rid));
		
		$data['result']= $rdata =$this->Common_model->get_record("desiner_report",'*',array('id'=>$rid));
		$noti_update=$this->Common_model->update_record('notification',array('noti_view_status'=>1),array('noti_type'=>5,'noti_ref_id'=>$rid));
		
		$data['rep_design']=$this->Common_model->get_record('designs','',array('designer_id'=>$rdata->report_designer,'contest_id'=>$rdata->contest_id,'design_no'=>$rdata->reporter_design));
		
		$data['cp_design']=$this->Common_model->get_record('designs','',array('designer_id'=>$rdata->copy_designer,'contest_id'=>$rdata->contest_id,'design_no'=>$rdata->copy_design));	
		
		$data['page_name'] ='report_view';
		$data['content']='back/report_view';
		$this->load->view('back/template',$data);
		
	}
	
	public function report_warning()
	{
		$rvalue=$this->input->post('report_result');
		
		$data['judgement_reason'] =$judgement_reason= $this->input->post('tarea');
		$value['contest_id'] =$contest_id= $this->input->post('contestid');
		$value['designer_id']=$cp_designer_id = $this->input->post('cp_designer_id');		
		$value['design_id'] =$cp_design_id= $this->input->post('cp_design_id');
		$value['report_id'] =$report_id= $this->input->post('report_id');
		$value['created_by'] = $this->session->userdata('admin_id');
		$value['created_time']=$date =date("Y-m-d H:i:s");
		
		$reporter_id= $this->input->post('reporter_id');
		$reporter_design_id= $this->input->post('reporter_design_id');
		
	
		if($rvalue==0)
		{
			$this->Common_model->insert_record("contest_warning",$value);
			$report_result="This Report was concluded as copied design by Admin.";
		}
		else{			
			$report_result="This Report was rejected by Admin.";
		}
		
		$this->Common_model->update_record('desiner_report',array('report_status'=>1,'report_judgement'=>$rvalue,'judgement_time'=>$value['created_time'],'judgement_by'=>$value['created_by'],'judgement_reason'=>$data['judgement_reason']),array('id'=>$report_id));
		
		$this->session->set_flashdata('report_accept','<span style="color:#008000; font-weight:bold;">report has been submitted successfully </span>');
		
		/*******Reporter Mail*******/
		$email=$this->Common_model->get_record('designer_table','',array('users_id'=>$reporter_id));
		$designer_email=$email->designer_email;
		
		//mail  for select finalist 
			$to = $designer_email;   //report designer//
			$subject=contestname($contest_id)."- Your Report For This Contest Got A Result";
			$message = "<h4>".contestname($contest_id)."- Your Report For This Contest Got A Result"."</h4>";
			$message .= "Result of the report: ".$report_result;
			$message .= $judgement_reason;
			rp_send_email($to, $subject, $message);
		//mail	
		
		$values= array();	
		$values['design_id']= $reporter_design_id;
		$values['client_id']= "a-".$this->session->userdata('admin_id');
		$values['contest_id']= $contest_id;
		$values['comment']= $report_result."<br>Judgement Reason:".$judgement_reason;
		$values['createdby']= $this->session->userdata('admin_id');	
		$values['createdname']="Admin";
		$values['createdtype']=0;
		$values['createddate']= $date;
		$values['toview_id']= $reporter_id;
		$this->Common_model->insert_record('design_comments',$values);
			
		/*********Copy_designer Mail***********/		
		$email=$this->Common_model->get_record('designer_table','',array('users_id'=>$cp_designer_id));
		$designer_email=$email->designer_email;
		
		//mail  for select finalist 
			$to = $designer_email;   //report designer//
			$subject=contestname($contest_id)."- Your Report For This Contest Got A Result";
			$message = "<h4>".contestname($contest_id)."- Your Report For This Contest Got A Result"."</h4>";
			$message .= "Result of the report: ".$report_result;
			$message .= $judgement_reason;
			rp_send_email($to, $subject, $message);
		//mail	
		
		$values= array();	
		$values['design_id']= $cp_design_id;
		$values['client_id']= "a-".$this->session->userdata('admin_id');
		$values['contest_id']= $contest_id;
		$values['comment']= $report_result."<br>Judgement Reason:".$judgement_reason;
		$values['createdby']= $this->session->userdata('admin_id');	
		$values['createdname']="Admin";
		$values['createdtype']=0;
		$values['createddate']= $date;
		$values['toview_id']= $cp_designer_id;
		$this->Common_model->insert_record('design_comments',$values);
		
		redirect('admin_panel/report_data_view/'.$report_id);
	}
	
	public function view_payment_rquest(){
	$data['page_name'] ='view_payment_rquest';
	$noti_update=$this->Common_model->update_record('notification',array('noti_view_status'=>1),array('noti_type'=>6));
	$data['request']=$this->Common_model->get_records_order_by('payment_request','*',array('req_status'=>0),'request_date','ASC');
	$data['content']='back/view_payment_rquest';
	$this->load->view('back/template',$data);
    }

    public function view_referral_payment_request(){
	$data['page_name'] ='view_referral_payment_request';
	$noti_update=$this->Common_model->update_record('notification',array('noti_view_status'=>1),array('noti_type'=>6));
	$data['request']=$this->Common_model->get_records_order_by('referral_payment_request','*',array('req_status'=>0),'request_date','ASC');
		$trans_fee=$this->Common_model->get_record("pricing_percentage",'transaction_charge',array('status'=>1));				
				$data['fee']=$trans_fee->transaction_charge;
	$data['content']='back/view_referral_payment_request';
	$this->load->view('back/template',$data);
    }
	 
	 public function view_payment_delete($rid=""){
	 	$this->Common_model->delete_record("payment_request",array('id'=>$rid));
	 	redirect('admin_panel/view_payment_rquest');
	 }
	public function transaction_update(){
		
		$designer_id= $this->input->post('designer_id');	
		$transaction_id= $this->input->post('tid');
		$trans_req_id= $this->input->post('trans_req_id');
		$trans_amount= $this->input->post('trans_amount');
		
		$date=date("Y-m-d H:i:s");
		$value['req_status']=1;
		
		$reward['designer_id']=$designer_id;
		$reward['reward_msg']="Requested Payment $".$trans_amount." Credited";
		$reward['reward_type']=3;
		$reward['reward_value']=-$trans_amount;
		$rew_id=$this->Common_model->insert_record("rewards",$reward);
				
		$trans['reward_id']=$rew_id;		
		$trans['designer_id']=$designer_id;
		$trans['trans_date']=$date;
		$trans['trans_value']= -$trans_amount;
		$old_balance=designer_balance($designer_id);
		$new_balance= $old_balance-$trans_amount;
		$trans['trans_old_balance']=$old_balance;
		$trans['trans_new_balance']=$new_balance;
		$rew=$this->Common_model->insert_record("transaction",$trans);
								
		$new_req= $this->Common_model->update_record('payment_request',array("req_status"=>1,"transaction_id"=>$transaction_id,"release_time"=>$date),array("id"=>$trans_req_id));

		//mail  for payment request 
		$to      = designer_email($designer_id);   //request designer//
		$subject = 'Mail From Contest Hours: Payment Credited';
		$message = "Requested Payment $".$trans_amount." Credited";
		rp_send_email($to, $subject, $message);			
		//mail 
		
		$this->session->set_flashdata('update_msg','<center><span style="color:#008000; font-weight:bold;">Transaction successfully completed </span></center>');
		redirect('admin_panel/view_payment_rquest');
		
	}

	public function referral_transaction_update(){
		
		$ref_id= $this->input->post('ref_id');	
		$transaction_id= $this->input->post('tid');
		$trans_req_id= $this->input->post('trans_req_id');
		$trans_amount= $this->input->post('trans_amount');
		
		$date=date("Y-m-d H:i:s");
		$value['req_status']=1;
		
		/*$reward['designer_id']=$designer_id;
		$reward['reward_msg']="Requested Payment $".$trans_amount." Credited";
		$reward['reward_type']=3;
		$reward['reward_value']=-$trans_amount;
		$rew_id=$this->Common_model->insert_record("rewards",$reward);*/
		

		//$trans['reward_id']=$rew_id;		
		$trans['ref_id']=$ref_id;
		$trans['trans_date']=$date;
		$trans['trans_msg']="Credit referral Amount : $ ".$trans_amount;
		//$trans['trans_value']= -$trans_amount;
		//$old_balance=referral_balance($ref_id);
		//$new_balance= $old_balance-$trans_amount;
		//$trans['trans_old_balance']=$old_balance;
		$trans['trans_amount']=$trans_amount;
		$rew=$this->Common_model->insert_record("referral_transaction",$trans);
								
		$new_req= $this->Common_model->update_record('referral_payment_request',array("req_status"=>1,"transaction_id"=>$transaction_id,"release_time"=>$date),array("id"=>$trans_req_id));

		//mail  for payment request 
		$to      = designer_email($ref_id);   //request designer//
		$subject = 'Mail From Contest Hours: Payment Credited';
		$message = "Requested Payment $".$trans_amount." Credited";
		rp_send_email($to, $subject, $message);			
		//mail 
		
		$this->session->set_flashdata('update_msg','<center><span style="color:#008000; font-weight:bold;">Transaction successfully completed </span></center>');
		redirect('admin_panel/view_referral_payment_request');
		
	}
	
	public function payment_request_complete()
	{
		$data['page_name'] ='request_complete';
		$data['content']='back/request_complete';
		$data['request']=$this->Common_model->get_records_order_by('payment_request','*',array('req_status'=>1),'release_time','DESC');
		$this->load->view('back/template',$data);				
	}

	public function referral_payment_request_complete()
	{
		$data['page_name'] ='referral_request_complete';
		$data['content']='back/referral_request_complete';
		$data['request']=$this->Common_model->get_records_order_by('referral_payment_request','*',array('req_status'=>1),'release_time','DESC');
		$this->load->view('back/template',$data);				
	}

		
	public function change_Paymentstatus($cid)
	{
		$data=$this->Common_model->update_record('contest',array('pay_option'=>1),array('id'=>$cid));
		$this->session->set_flashdata('update_msg','<center><span style="color:#008000; font-weight:bold;">Payment Status Modified Successfully..! </span></center>');
		redirect('admin_panel/contest_view/'.$cid);	
	}
	
	public function designer_bonus($id="")
	{
		if(!empty($id)){
			$data['page_name'] ='Designer Bonus';
			$this->Admin_model->check_user_login();
			$data['user_data'] = $this->Common_model->get_record("user_table","*",array("user_id"=>$id, "user_status"=>1));
			$data['content']='back/designer_bonus';
			$this->load->view('back/template',$data);
		}
		else{
			redirect('admin_panel/view_page_designer');
		}
	}
	
	public function save_bonus_transaction(){
		
		$designer_id= $this->input->post('designer_id');	
		$bonus_message= $this->input->post('bonus_message');
		$bonus_price= $this->input->post('bonus_price');
		$date= date("Y-m-d H:i:s");
		
		$bonus_type= ($bonus_price<0)?"Penalty": "Bonus";
		$credit_type= ($bonus_price<0)?"Deducted": "Credited";
		
		$bonus['designer_id']= $designer_id;
		$bonus['bonus_message']= $bonus_message;
		$bonus['bonus_price']= $bonus_price;
		$bonus['createdtime']= $date;
		$bonus_id=$this->Common_model->insert_record("user_bonus",$bonus);
		
		$reward['bonus_id']= $bonus_id;
		$reward['designer_id']= $designer_id;
		$reward['reward_msg']= "$bonus_type Price $".abs($bonus_price)." $credit_type.<br> Message: $bonus_message";
		$reward['reward_type']= 4;
		$reward['reward_value']= $bonus_price;
		$rew_id=$this->Common_model->insert_record("rewards",$reward);
		
		$trans['reward_id']= $rew_id;			
		$trans['designer_id']= $designer_id;
		$trans['trans_date']= $date;
		$trans['trans_value']= $bonus_price;
		$old_balance=designer_balance($designer_id);
		$new_balance= $old_balance+$bonus_price;
		$trans['trans_old_balance']= $old_balance;
		$trans['trans_new_balance']= $new_balance;
		$rew=$this->Common_model->insert_record("transaction",$trans);
		
		//mail  for payment request 
		$to      = designer_email($designer_id);
		$subject = "Mail From Contest Hours: $bonus_type For You.";
		$mvalues['subject']=$subject;
		$mvalues['designer_id']= $designer_id;
		$mvalues['message']="You got $bonus_type Payment of $".abs($bonus_price)." From Contest Hours";
		$message = $this->load->view("back/newsletter/bonus_message",$mvalues,true);
		rp_send_email($to, $subject, $message);
		//mail
		
		$this->session->set_flashdata('update_msg','<center><span style="color:#008000; font-weight:bold;">Transaction successfully completed </span></center>');
		redirect('admin_panel/designer_bonus_list');	
	}
	
	public function designer_bonus_list()
	{
		$data['page_name'] ='Bonus List';
		$this->Admin_model->check_user_login();
		$data['list']=$this->Common_model->get_records_order_by('user_bonus','*',array('status'=>0),"createdtime","DESC");
		$data['content']='back/designer_bonus_list';
		$this->load->view('back/template',$data);
	}
	
	public function category_pricing_setting()
	{
	 	$data['page_name'] ='category_pricing_setting';
		$this->Admin_model->check_user_login();
		$data['setval'] = $this->Common_model->get_records("category","*");
		$data['content']='back/category_pricing_setting';
		$this->load->view('back/template',$data);
	}
	
	public function save_category_pricing_setting(){
		if($_POST)
		{
		 	 //$values['minimum_fee'] = number_format($this->input->post(),2);
		    
		
			 $result = $this->Common_model->get_records("category","code");
			 foreach($result as $res){
				 $values['minimum_fee'] = number_format($this->input->post($res->code),2);
				 $where['code'] = $res->code;
				 $this->Common_model->update_record("category",$values,$where); 
			 }

		}
		
		$this->session->set_flashdata('message','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>Pricing Structure Successfully Modified.</div>');	
		redirect('admin_panel/category_pricing_setting');	
	}
	
	
	public function bestbuy_category_pricing_setting()
	{
	 	$data['page_name'] ='category_pricing_setting';
		$this->Admin_model->check_user_login();
		$data['setval'] = $this->Common_model->get_records("category_bestbuy","*");
		$data['content']='back/bestbuy_category_pricing_setting';
		$this->load->view('back/template',$data);
	}
	
	public function save_bestbuy_category_pricing_setting(){
		if($_POST){
			 $result = $this->Common_model->get_records("category_bestbuy","code");
			 foreach($result as $res){
				 $values['minimum_fee'] = $this->input->post($res->code);
				 $where['code'] = $res->code;
				 $this->Common_model->update_record("category_bestbuy",$values,$where); 
			 }
		}
		$this->session->set_flashdata('message','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>Pricing Structure Successfully Modified.</div>');	
		redirect('admin_panel/bestbuy_category_pricing_setting');	
	}
	
	public function support_list()
	{
	    $data["support"]= $this->Common_model->get_records_order_by("support_message","*","","createdtime","desc");
		$data['page_name'] ='support_list';
		$this->Admin_model->check_user_login();
		$data['content']='back/support_list';
		$this->load->view('back/template',$data);
	}
	
	public function announcements($id="")
	{
		
		if($id) {
		 $data['announcement']=$this->Common_model->get_record('announcements','*',array('id'=>$id),array('status'=>0));
			
		}
		$data['page_name'] ='announcement';
		$this->Admin_model->check_user_login();
		$data['user_data'] = $this->session->userdata('admin_id');
		$data['content']='back/announcements';
		$this->load->view('back/template',$data);
		
	}
	
	public function save_announcements() {
		$id = $this->input->post('id');
		$admin_id =$this->session->userdata('admin_id');
		$date= date("Y-m-d H:i:s");
		$data = array(
				'user_id' => $admin_id,
				'title' => $_POST['tittle'],
				'message' => $_POST['message'],
				'createdtime' => $date
				
		);
		if(empty($id)){
			$this->Common_model->insert_record("announcements", $data);
		}
		else{
			$this->Common_model->update_record("announcements", $data,array("id"=>$id));
		}
		$dusers= $this->Common_model->get_records("designer_table", "users_id",array("designer_status"=>1));
		if(!empty($dusers)){
			$notifi["contest_id"]=0;
			$notifi["from_id"]=0;
			$notifi["subject"]="You got a new notification from <strong>CONTESTHOURS</strong>";
			$notifi["created_time"]=date("Y-m-d H:i:s");
			foreach($dusers as $user){
				$notifi["to_id"]=$user->users_id;
				$ins= $this->Common_model->insert_record("client_notification",$notifi);
			}
		}
		redirect('admin_panel/announcement_view');
	}
	
	public function delete_announcements($id) {
	
		$this->Common_model->update_record("announcements",array("status"=>1),array("id"=>$id));
		redirect('admin_panel/announcement_view');
	}
	
	public function announcement_view() {
		$data['page_name'] ='announcement_view';
		$data['content']='back/announcement_view';
		$user_data = $this->session->userdata('admin_id');
		$data['announcement']=$this->Common_model->get_records('announcements','*',array('status'=>0),array('user_id'=>$user_data));
		$this->load->view('back/template',$data);
	}


}
?>	