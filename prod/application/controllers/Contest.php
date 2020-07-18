<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contest extends CI_Controller {
	
	var $publicMethods  = array("index", "brief", "insert_login","insert_brief1","insert_brief", "restricted", "particular_contest", "contest_entries", "contest_discussions", "contest_brief", "contest_procedure", "contest_designpackage","request_release_payment_cron", "choose_judgingContests", "mailtest", "zohotest","check_referral_code");
	
	public function __Construct(){
        parent::__construct();
		
		$this->load->model(array('Common_model','Contest_model'));
		$this->load->helper('url');
		$this->load->library(array('form_validation','session','upload','encrypt'));

		$logged_in = is_user_logged_in();		
		$currentMethod = $this->router->fetch_method();
		if(in_array($currentMethod,$this->publicMethods) == false){
			if(!$logged_in){
				redirect("Contest/restricted");
			}
		}
    }
	
	public function index(){
		//$this->Contest_model->check_user_login();
		//$this->Contest_model->check_client_login();
		$data['content']='front/start_now';
		$this->load->view('front/template',$data);
	}
	
	public function restricted(){
		$this->load->view('front/restricted');
	}
	
	public function brief(){
		//$this->Contest_model->check_user_login();
		//$this->Contest_model->check_client_login();
		
		$type = $_GET['type'];
		$data = array(
			'user_id' => $this->session->userdata('user_id'),
			'design_type' => $type
		);
		
		switch ($type) {
        	case 'logodesign':
        		$title = 'Logo Design Brief';
        		break;
        	case 'webdesign':
        		$title = 'Web Design';
        		break;
        	case 'tshirtdesign':
        		$title = 'T-Shirt Design';
        		break;	
        	case 'flyerdesign':
        		$title = 'Flyer Design';
        		break;
        	case 'businesscarddesign':
        		$title = 'Businesscard Design';
        		break;
        	case 'stationerydesign':
        		$title = 'Stationery Design';
        		break;
        	case 'packagingdesign':
        		$title = 'Packaging Design';
        		break;
        	case 'fbcoverdesign':
        		$title = 'Facebook Cover Page Design';
        		break;
        	case 'movielogodesign':
        		$title = 'Movie logo Design';
        		break;

        	default:
        		$title = $_GET['name'];
        		break;
        }
		$list_industries=$this->Common_model->get_records('industry');
		$data['industries'] = $list_industries;
		$data['title']= $title;
        $data['design_type']= $type;
		$data['content']="front/creative_brief";
		//echo "<pre>";
		//print_r($data);
		//echo "</pre>";
		//exit();
		$this->load->view('front/template',$data);
	}
	public function insert_login(){
		/*$email =  $this->input->post("client_email");
		$password =  $this->input->post("client_password");*/
			$logged_in = is_user_logged_in();

		if(!$logged_in){
			$email= $this->input->post("client_email");
			$chk= $this->Common_model->get_record("user_table", "*", array("user_email"=>$email, "user_type"=>0));
			
			if(empty($chk)){
				$user['user_name'] = $name = "Client ".rand(111,999);
				$user['user_email'] = $this->input->post("client_email");
				$user['user_pwd'] = $this->input->post("client_password");
				$country= user_current_access_country();
				$user['user_country'] = $user_country= (!empty($country))?$country:"";
				$user['created_date'] = date('Y-m-d H:i:s');				
				$user['user_status'] = "1";
				$user['user_type'] = "0";
				
				$user_id= $this->Common_model->insert_record("user_table",$user);
				
				
				
				$client = array("name" => $user['user_name'], "email" => $user['user_email'], "password" => $user['user_pwd'],"country"=>$user_country, "created_date"=> $user['created_date'], "status"=> "1", "users_id"=>$user_id);
				
				$this->Common_model->insert_record("client_table",$client);
				
				/**************Notification Email **************/	
				$to = $email;
				$msg['email'] = $to;
				$msg['message'] = $name.' has registered as client ';
				$message = $this->load->view('front/newsletter/welcome_letter',$msg,true);
				rp_send_email($to,'Welcome to Contesthours....!',$message);
						
				/**************Notification Email **************/	
			
				//notification
				$noti['noti_msg']= ucwords($name)." joined with Contesthours as a Client";
				$noti['noti_type']= 2; //new_client_joined
				$noti['noti_ref_id']= $user_id;
				$noti['noti_entry_time']= date("Y-m-d H:i:s");
				$this->Common_model->insert_record('notification',$noti);
				//notification

			}
			else{
				$user_id= $chk->user_id;
			}
			
			$result = $this->Common_model->get_record("user_table", "*", array("user_id"=>$user_id));
			if($result){
				$userdata = array(
					'user_name'  => $result->user_name,
					'user_type'  => $result->user_type,
					'user_email' => $result->user_email,
					'user_id'    => $result->user_id,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($userdata);
				$up['last_logged_in']= date("Y-m-d H:i:s");
				$where['user_id']= $user_id;
				$this->Common_model->update_record("user_table",$up,$where);
			}
			
			$data['client_id']= $user_id;
		}
		else{
			$data['client_id']= $this->session->userdata('user_id');
		}

		
	}
	public function insert_brief1(){
/*echo"<pre>";
print_r($_POST);exit;*/
		$formSubmit = $this->input->post('sub_btn');
		$insert_data=array();
		$post=$_POST;
		$data['status'] = 'draft';
		//print_r($post);
		/*  login page */
		$logged_in = is_user_logged_in();
		if(!$logged_in){
			$email= $this->input->post("client_email");
			$chk= $this->Common_model->get_record("user_table", "*", array("user_email"=>$email, "user_type"=>0));
			
			if(empty($chk)){
				$referralid = $this->Contest_model->run_key('alpha','10');
				$user['user_name'] = $name = "Client ".rand(111,999);
				$user['user_email'] = $this->input->post("client_email");
				$user['user_pwd'] = $this->input->post("client_password");
				$country= user_current_access_country();
				$user['user_country'] = $user_country= (!empty($country))?$country:"";
				$user['created_date'] = date('Y-m-d H:i:s');				
				$user['user_status'] = "1";
				$user['user_type'] = "0";
				$user['user_referral_code'] = $referralid;
				$user_id= $this->Common_model->insert_record("user_table",$user);
				 
				$client = array("name" => $user['user_name'], "email" => $user['user_email'], "password" => $user['user_pwd'],"country"=>$user_country, "created_date"=> $user['created_date'], "status"=> "1", "users_id"=>$user_id);
				
				
				$this->Common_model->insert_record("client_table",$client);

			
				/**************Mail Email **************/	
				$to = $email;
				$msg['email'] = $to;
				$msg['message'] = $name.' has registered as client ';

				$message = $this->load->view('front/newsletter/welcome_letter',$msg,true);
				rp_send_email($to,'Welcome to Contesthours....!',$message);
						
				/**************Notification Email **************/	
			
				//notification
				$noti['noti_msg']= ucwords($name)." joined with Contesthours as a Client";
				$noti['noti_type']= 2; //new_client_joined
				$noti['noti_ref_id']= $user_id;
				$noti['noti_entry_time']= date("Y-m-d H:i:s");
				$this->Common_model->insert_record('notification',$noti);
				//notification

			}
			else{
				$user_id= $chk->user_id;
				$data['referral_code']= $this->Contest_model->get_referral_id($user_id);
			}
			
			$result = $this->Common_model->get_record("user_table", "*", array("user_id"=>$user_id));
			if($result){
				$userdata = array(
					'user_name'  => $result->user_name,
					'user_type'  => $result->user_type,
					'user_email' => $result->user_email,
					'user_id'    => $result->user_id,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($userdata);
				$up['last_logged_in']= date("Y-m-d H:i:s");
				$where['user_id']= $user_id;
				$this->Common_model->update_record("user_table",$up,$where);
			}
			
			$data['client_id']= $user_id;
		}
		else{
			$data['client_id']= $this->session->userdata('user_id');
		}

		/* What you you require */
		$cpid =$this->input->post("category_input");
		if(isset($cpid)){
		$setcategory['cp_id'] = $cpid;
		} else { $setcategory['cp_id']=""; }
		$tech =$this->input->post("tech");
		$Logo =$this->input->post("Logo");
		$advertising =$this->input->post("advertising");
		$category_input=$this->input->post("category_input");
		if($category_input=="2"){	
			if(isset($tech[0])){
				if($tech[0] == "0"){
			$setcategory['ct_business'] = "businesscarddesign";
					} else if($tech[0] == "1"){
			$setcategory['ct_social'] = "socialmedia";	
					} else if($tech[0] == "2"){
			$setcategory['ct_tshirt'] = "tshirtdesign";	
					} else if($tech[0] == "3"){
			$setcategory['ct_packagedesign'] = "packagedesign";	
					}
				}
			if(isset($tech[1])){
				if($tech[1] == "1"){
			$setcategory['ct_social'] = "socialmedia";
					} else if($tech[1] == "2") {
			$setcategory['ct_tshirt'] = "tshirtdesign";	
					} else if($tech[1] == "3"){
			$setcategory['ct_packagedesign'] = "packagedesign";	
					} 
				}
			if(isset($tech[2])){
					if($tech[2] == "2"){
			$setcategory['ct_tshirt'] = "tshirtdesign";
					} else if($tech[2] == "3") {
			$setcategory['ct_packagedesign'] = "packagedesign";				
					}
				}
			if(isset($tech[3])){
					if($tech[3] == "3"){
			$setcategory['ct_packagedesign'] = "packagedesign";
				}
			}
		} 
		//$setcategory= array();
		if($category_input=="3"){	
			if(isset($Logo[0])){
				if($Logo[0] == "0"){
			$setcategory['ct_business'] = "businesscarddesign";
					} else if($Logo[0] == "1"){
			$setcategory['ct_social'] = "socialmedia";	
					} else if($Logo[0] == "2"){
			$setcategory['ct_tshirt'] = "tshirtdesign";	
					} else if($Logo[0] == "3"){
			$setcategory['ct_packagedesign'] = "packagedesign";	
					}
				}
			if(isset($Logo[1])){
				if($Logo[1] == "1"){
			$setcategory['ct_social'] = "socialmedia";
					} else if($Logo[1] == "2") {
			$setcategory['ct_tshirt'] = "tshirtdesign";	
					} else if($Logo[1] == "3"){
			$setcategory['ct_packagedesign'] = "packagedesign";	
					} 
				}
			if(isset($Logo[2])){
					if($Logo[2] == "2"){
			$setcategory['ct_tshirt'] = "tshirtdesign";
					} else if($Logo[2] == "3") {
			$setcategory['ct_packagedesign'] = "packagedesign";				
					}
				}
			if(isset($Logo[3])){
					if($Logo[3] == "3"){
			$setcategory['	ct_packagedesign'] = "packagedesign";
				}
			}
		}
		if($category_input=="4"){	

			if(isset($advertising[0])){
				if($advertising[0] == "1"){
			$setcategory['ct_others'] = "packagedesign";
					} else if($advertising[0] == "2"){
			$setcategory['ct_others'] = "bannerdesign";	
					} else if($advertising[0] == "3"){
			$setcategory['ct_others'] = "calenderdesign";	
					} else if($advertising[0] == "4"){
			$setcategory['ct_others'] = "invitationdesign";	
					} else if($advertising[0] == "5"){
			$setcategory['ct_others'] = "cateloguedesign";	
					} else if($advertising[0] == "6"){
			$setcategory['ct_others'] = "cdcoverdesign";	
					} else if($advertising[0] == "7"){
			$setcategory['ct_others'] = "icondesign";	
					} else if($advertising[0] == "8"){
			$setcategory['ct_others'] = "addesign";	
					} else if($advertising[0] == "9"){
			$setcategory['ct_others'] = "labeldesign";	
					} else if($advertising[0] == "10"){
			$setcategory['ct_others'] = "letterheaddesign";	
					} else if($advertising[0] == "11"){
			$setcategory['ct_others'] = "menudesign";	
					} else if($advertising[0] == "12"){
			$setcategory['ct_others'] = "brochuredesign";	
					} else if($advertising[0] == "13"){
			$setcategory['ct_others'] = "vehiclewrapdesign";	
					} else if($advertising[0] == "14"){
			$setcategory['ct_others'] = "envelopedesign";	
					} else if($advertising[0] == "15"){
			$setcategory['ct_others'] = "powerpointdesign";	
					} else if($advertising[0] == "16"){
			$setcategory['ct_others'] = "posterdesign";	
					} else if($advertising[0] == "17"){
			$setcategory['ct_others'] = "bookcoverdesign";	
					} else if($advertising[0] == "18"){
			$setcategory['ct_others'] = "emailtemplatedesign";	
					} else if($advertising[0] == "19"){
			$setcategory['ct_others'] = "mascotdesign";	
					}
				}
		} 
		$setcategory['ct_created_time']= date("Y-m-d H:i:s");		
        $category_type = $this->Common_model->insert_record('category_type' , $setcategory);

		//$check=implode(", ", $checkbox);
   		//json_encode($check);

			/* !. Post your brief*/

		$data['contest_type'] = $category_type;
		$data['contest_title'] = $this->input->post("cont_tit");
		$log_tag_line = $this->input->post("log_tag_line");
		$data['business_description']  = $this->input->post("creative_brief_msg_area");
		$data['industry'] = $this->input->post("indus");
		$color1 = $this->input->post("color1");
		$color2 = $this->input->post("color2");
		$color3 = $this->input->post("color3");
		$color4 = $this->input->post("color4");
		$logo_style_idea = $this->input->post("logo_style_idea");
		$userfile = $this->input->post("userfile");
		$logo_extras = array(
						'tagline' => $log_tag_line,
						'color1' => $color1,
						'color2' => $color2,
						'color3' => $color3,
						'color4' => $color4,
						'ideas' => $logo_style_idea
						);
		$data['extras'] = serialize($logo_extras);
		$files = $_FILES;
			
		$this->load->library('upload');
		$config = array('allowed_types' => 'jpg|jpeg|gif|png|bmp|pdf|zip|rar|txt|doc','upload_path' => './uploads/brief','max_size' => 5000,'max_width' => 5000,'max_height' => 5000);
			$_FILES['userfile']['name']= rand().$files['userfile']['name'];
		/*$_FILES['userfile']['name']= rand().$files['userfile']['name'];

        $_FILES['userfile']['type']= $files['userfile']['type'];
        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'];
        $_FILES['userfile']['error']= $files['userfile']['error'];
        $_FILES['userfile']['size']= $files['userfile']['size'];   */ 
       // $image = $_FILES['userfile']['name'];
        $image =$_FILES['userfile']['name'];
        $this->upload->initialize($config);
        $this->upload->do_upload(); 		
		$image_data = $this->upload->data();
	    
		$data['filename'] = $image_data['file_name'];
		$data['filepath'] = $image_data['file_path'];
		$data['posted_from'] = '1'; 
		$referral_code= $this->input->post("referral_code");
		$userid = $this->session->userdata('user_id');
		$referral_code_verify = $this->Contest_model->verify_referral_code($referral_code,$userid);

		$data['referral_code'] = $referral_code_verify;
		
		$contest_id = $this->Common_model->insert_record('contest' , $data );
		//if($formSubmit=="Save Progress"){
		//$this->session->set_flashdata('draft','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Your contest is not fully completed. Please check your draft</div>');
		//redirect('admin/myprofile_client');
		//} else {
			$category_inputprice = $this->input->post("category_input");
			$category_package_price = $this->Common_model->get_record("category_package", "*", array("cp_id"=>$category_inputprice));
			
			//redirect('contest/payment_option1?contest_id=' . $contest_id.'&type=' . $contest_type);
			
			/* 2. Choose Your Package */
			$due_date = 0;
			if($this->input->post("package_dur") == 1){
				$due_date = "+1 day";
				$datapayment['hours'] = "24";
			} 
			else if($this->input->post("package_dur") == 2){
				$due_date = "+2 days";
				$datapayment['hours'] = "48";
			} else if($this->input->post("package_dur") == 3){
				$due_date = "+3 days";
				$datapayment['hours'] = "72";
			} else if($this->input->post("package_dur") == 4){
				$due_date = "+4 days";
				$datapayment['hours'] = "96";
			} else if($this->input->post("package_dur") == 5){
				$due_date = "+5 days";
				$datapayment['hours'] = "120";
			} else if($this->input->post("package_dur") == 6){
				$due_date = "+6 days";
				$datapayment['hours'] = "144";
			} else if($this->input->post("package_dur") == 7){
				$due_date = "+7 days";
				$datapayment['hours'] = "168";
			} 
			else if($this->input->post("package_dur") && !empty($this->input->post("package_dur")))
			{
				$due_date = "+".$this->input->post("package_dur")." day";
			}

			$payment = array();
		$pricing1= $this->input->post('basic');
		
		if($pricing1!=""){
			$payment = $pricing1;
				$contest_package_name="Basic";
		} 
		$pricing2= $this->input->post('sliver');

		if($pricing2!=""){
			$payment = $pricing2;
			$contest_package_name="Silver";
		} 
		$pricing3= $this->input->post('gold');
		if($pricing3!=""){
			$payment = $pricing3;
			$contest_package_name="Gold";
		} 
		$pricing4= $this->input->post('pricing4');
		if($pricing4!=""){
			$payment = $pricing4;
			$contest_package_name="Custom";
		} 
			$datapayment['payment_option_amt'] = $payment;
			$datapayment['dur'] = $this->input->post("package_dur");
			$private_fee1 = $this->input->post("priv_fee");
			if(isset($private_fee1)){ $private_fee=$private_fee1 ; } else { $private_fee = "0"; }
			$featured_fee1 = $this->input->post("featured_fee");
			if(isset($featured_fee1)){ $featured_fee=$featured_fee1 ; } else { $featured_fee = "0"; }
			
			$contest_total = $this->input->post("contest_total");
			$datapayment['priv_fee'] =  $private_fee;
			$datapayment['featured_fee'] =  $featured_fee;
			$referral_value = $this->Contest_model->get_referral_contestid($contest_id);
			if($referral_value !="" and $referral_value !="0") {
				$getr_amount = $this->Contest_model->get_referral_amount();
				$percentage= "100";
				$refamnt= ($contest_total * $getr_amount) / $percentage;
				$getreferralamount = $contest_total - $refamnt;
			$datapayment['total_amount'] =  $getreferralamount;	
				$referral['ref_code'] = $referral_value;
				$referral['user_id'] = $this->session->userdata('user_id');
				$referral['contest_id'] = $contest_id;
				$referral['ref_amount'] = $refamnt;
				$referral['ref_created_date'] = date("Y-m-d h:i:sa");
				$this->Common_model->insert_record("referral_code",$referral);
			} else  {
			$datapayment['total_amount'] =  $contest_total;
					}
			$update_records = array(
			'bestbuy_prize' => currencyConvert("USD", "INR", $datapayment['payment_option_amt']),
			'contest_prize' => $datapayment['payment_option_amt'],
			'listing_fee' => $category_package_price->cp_pack_price,
			'duration_hours' => (isset($datapayment['hours'])&& !empty($datapayment['hours']))?$datapayment['hours']:'',
			'duration'=> (isset($datapayment['dur'])&& !empty($datapayment['dur']))?$datapayment['dur']:0,
			'total_amount' => $datapayment['total_amount'],
			'upgrade_private_contest' => $datapayment['priv_fee'],
			'upgrade_featured_contest' => $datapayment['featured_fee'],
			'user_timezone' => date('P'),
			'user_timezone_sec' => date('Z'),
			'published_date' => date('Y-m-d H:i:s'),
			'close_date' => date('Y-m-d H:i:s',strtotime($due_date)),
		);
		
		
		$this->Common_model->update_record('contest',$update_records, array('id'=>$contest_id));

		$repval["contest_fee"]= $datapayment["payment_option_amt"];
		$repval["listing_fee"]= $category_package_price->cp_pack_price;
		$repval["duration_fee"]= "0";
		$repval["featured_fee"]= $datapayment['featured_fee'];
		$repval["private_fee"]= $datapayment['priv_fee'];
		$repval["contest_package_name"]= $contest_package_name;
		//$repval["total_fee"]= $total_fee= $datapayment["payment_option_amt"]+ $category_package_price->cp_pack_price + 0 + $datapayment["featured_fee"]+ $datapayment["priv_fee"];
		 $total_fee = $datapayment["payment_option_amt"]+ $category_package_price->cp_pack_price + 0 + $datapayment["featured_fee"]+ $datapayment["priv_fee"];
		$repval["total_fee"] = sprintf("%.2f", $total_fee);
		$reward= $datapayment["payment_option_amt"] * (winner_percentage()/100);
		$repval["contest_reward"]= sprintf("%.2f", $reward);
		$balance = $total_fee - $reward;
		$repval["contest_balance"]= sprintf("%.2f", $balance);
		
		$contest_id = (string)$contest_id;
		$chk= $this->Common_model->get_record("contest_pricing_report","contest_id",array("contest_id"=>$contest_id));
		
		if(!empty($chk)){
			$whr["contest_id"]= $contest_id;
			$upd= $this->Common_model->update_record("contest_pricing_report",$repval,$whr);
		}
		else{
			$repval["contest_id"]= $contest_id;
			$ins= $this->Common_model->insert_record("contest_pricing_report",$repval);
		}
		/*if($formSubmit=="Save Progress"){
			$this->session->set_flashdata('draft','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Your contest is not fully completed. Please check your draft</div>');
			redirect('admin/myprofile_client');
		}
		else{*/
			redirect('contest/confirm_order1?contest_id=' . $contest_id);
		//}
		
		//$datapayment['total_amount'] =  $contest_total;
		//} //redirect payment page
	}
	public function confirm_order1(){
		$this->Contest_model->check_user_login();
		$this->Contest_model->check_client_login();
		$contest_id = ($_GET['contest_id']);
		$data['contest_id']=$contest_id;
		$data['contest_details'] = $this->Common_model->get_record('contest','*', array('id'=>$contest_id));
		//echo '<pre>'; print_r($data['contest_details']); exit;
		
		//Atom
		$this->load->library('TransactionRequest');			
		//Atom
		
		$data['content']='front/confirm_order1';
		$this->load->view('front/template1',$data);
	}
	public function insert_brief(){
		$formSubmit = $this->input->post('sub_btn');		
		$insert_data=array();
		$post=$_POST;
		$data['contest_type'] = (isset($post['dis_type']))?$post['dis_type']:""; 
		$data['status'] = 'draft';
		$logged_in = is_user_logged_in();
		if(!$logged_in){
			$email= $this->input->post("client_email");
			$chk= $this->Common_model->get_record("user_table", "*", array("user_email"=>$email, "user_type"=>0));
			
			if(empty($chk)){
				$user['user_name'] = $name = "Client ".rand(111,999);
				$user['user_email'] = $this->input->post("client_email");
				$user['user_pwd'] = $this->input->post("client_password");
				$country= user_current_access_country();
				$user['user_country'] = $user_country= (!empty($country))?$country:"";
				$user['created_date'] = date('Y-m-d H:i:s');				
				$user['user_status'] = "1";
				$user['user_type'] = "0";
				
				$user_id= $this->Common_model->insert_record("user_table",$user);
				//echo json_encode(array("user_id"=>$user_id"user"=>"user add successfully"));

				$client = array("name" => $user['user_name'], "email" => $user['user_email'], "password" => $user['user_pwd'],"country"=>$user_country, "created_date"=> $user['created_date'], "status"=> "1", "users_id"=>$user_id);
				
				$this->Common_model->insert_record("client_table",$client);
				
				/**************Notification Email **************/	
				$to = $email;
				$msg['email'] = $to;
				$msg['message'] = $name.' has registered as client ';
				$message = $this->load->view('front/newsletter/welcome_letter',$msg,true);
				rp_send_email($to,'Welcome to Contesthours....!',$message);
						
				/**************Notification Email **************/	
			
				//notification
				$noti['noti_msg']= ucwords($name)." joined with Contesthours as a Client";
				$noti['noti_type']= 2; //new_client_joined
				$noti['noti_ref_id']= $user_id;
				$noti['noti_entry_time']= date("Y-m-d H:i:s");
				$this->Common_model->insert_record('notification',$noti);
				//notification
			}
			else{
				$user_id= $chk->user_id;
			}
			
			
			$result = $this->Common_model->get_record("user_table", "*", array("user_id"=>$user_id));
			if($result){
				$userdata = array(
					'user_name'  => $result->user_name,
					'user_type'  => $result->user_type,
					'user_email' => $result->user_email,
					'user_id'    => $result->user_id,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($userdata);
				$up['last_logged_in']= date("Y-m-d H:i:s");
				$where['user_id']= $user_id;
				$this->Common_model->update_record("user_table",$up,$where);
			}
			
			$data['client_id']= $user_id;
		}
		else{
			$data['client_id']= $this->session->userdata('user_id');
		}
		
		$insert_data= $post;
		//print_r($insert_data);
		$contest_type = $data['contest_type'];
		$data_insert  = $insert_data;		
		
		switch ($contest_type) {
				case 'logodesign':
					$data['org_name'] = $data_insert['org_bus'];
					$data['business_description'] = $data_insert['creative_brief_msg_area'];
					$data['industry'] = $data_insert['indus'];
					$logo_extras = array(
						'tagline' => $data_insert['logo_tag_line'],
						'slider1' => $data_insert['fem_mas'],
						'slider2' => $data_insert['sim_com'],
						'slider3' => $data_insert['mod_lux'],
						'slider4' => $data_insert['ply_ser'],
						'slider5' => $data_insert['mod_vin'],
						'slider6' => $data_insert['spo_ele'],
						'color1' => $data_insert['color1'],
						'color2' => $data_insert['color2'],
						'color3' => $data_insert['color3'],
						'color4' => $data_insert['color4'],
						'ideas' => $data_insert['logo_style_idea']
					);
					$data['extras'] = serialize($logo_extras);
				break;
				case 'webdesign':
					$data['org_name'] = $data_insert['org_bus'];
					$data['business_description'] = $data_insert['creative_brief_msg_area'];
					$data['industry'] = $data_insert['indus'];
					if(isset($data_insert['b_f_l']))
					$data['language'] = $data_insert['b_f_l'];
					if(isset($data_insert['c_b_w_a']))
					$data['background_info'] = $data_insert['background_info'];
					$data['content_details'] =  $data_insert['condet'];

					$visual_style = array(
						'org_name' => $data_insert['org_bus'],
						'website_address' => $data_insert['r_w_a'],
						'ideas' => $data_insert['creative_b_msg_area'],
						'describesite' => $data_insert['ref_website'],
					);
					$data['visual_style'] =  serialize($visual_style);

					$other_details = array(
						'designersinfo' => $data_insert['comm_design'],
						'coding_type' => $data_insert['coding_type']
					);
					$data['other_details'] =  serialize($other_details);
				break;

				case 'tshirtdesign' :
				  	$data['contest_title'] = $data_insert['cont_tit'];
		   			$data['contest_description'] = $data_insert['cont_desc'];
		   			$data['org_name'] = $data_insert['org_bus'];
					$data['business_description'] = $data_insert['creative_brief_msg_area'];
					$data['industry'] = $data_insert['indus'];
					$data['language'] = $data_insert['b_f_l'];
					$data['size'] = $data_insert['ts_size'];
					
					$data['background_info'] = $data_insert['background_info'];
					$data['content_details'] = $data_insert['choose_tshirt'];
					$visual_style = array(
						'specific_color' => $data_insert['color_mind'],
						'ideas' => $data_insert['visual_style_idea']
					);
					$data['visual_style'] =  serialize($visual_style);
					$data['other_details'] =  $data_insert['comm_design'];
					break;

			case 'businesscarddesign' :
					$data['contest_title'] = $data_insert['cont_tit'];
		   			$data['contest_description'] = $data_insert['cont_desc'];
		   			$data['org_name'] = $data_insert['org_bus'];
					$data['business_description'] = $data_insert['creative_brief_msg_area'];
					$data['industry'] = $data_insert['indus'];
					$data['language'] = $data_insert['b_f_l'];
					$data['size'] = $data_insert['ts_size'];
					$data['background_info'] = $data_insert['background_info'];
					$data['content_details'] = $data_insert['flyer_con_detail'];
					$data['visual_style'] = $data_insert['visual_style'];
					$other_details = array(
						'designersinfo' => $data_insert['comm_design'],
						'radio_bus' => $data_insert['radio_bus']
					);
					$data['other_details'] =  serialize($other_details);
					break;
				
				default:
					$data['contest_title'] = $data_insert['cont_tit'];
		   			$data['contest_description'] = $data_insert['cont_desc'];
		   			$data['org_name'] = $data_insert['org_bus'];
					$data['business_description'] = $data_insert['creative_brief_msg_area'];
					$data['industry'] = $data_insert['indus'];
					$data['language'] = $data_insert['b_f_l'];
					$data['size'] = $data_insert['ts_size'];
					$data['background_info'] = $data_insert['background_info'];
					$data['content_details'] = $data_insert['flyer_con_detail'];
					$data['visual_style'] = $data_insert['visual_style'];
					$data['other_details'] =  $data_insert['comm_design'];
					break;
			} 
		
		$files = $_FILES;
			
		$this->load->library('upload');
		$config = array('allowed_types' => 'jpg|jpeg|gif|png|bmp|pdf|zip|rar|txt|doc','upload_path' => './uploads/brief','max_size' => 5000,'max_width' => 5000,'max_height' => 5000);
			
		$_FILES['userfile']['name']= rand().$files['userfile']['name'];
        $_FILES['userfile']['type']= $files['userfile']['type'];
        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'];
        $_FILES['userfile']['error']= $files['userfile']['error'];
        $_FILES['userfile']['size']= $files['userfile']['size'];    
        $image = $_FILES['userfile']['name'];
        $this->upload->initialize($config);
        $this->upload->do_upload(); 		
		$image_data = $this->upload->data();
	    
		$data['filename'] = $image_data['file_name'];
		$data['filepath'] = $image_data['file_path'];
		$data['posted_from'] = '1'; //Raj
	
		$contest_id = $this->Common_model->insert_record('contest' , $data );
		if($formSubmit=="Save Progress"){
			$this->session->set_flashdata('draft','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Your contest is not fully completed. Please check your draft</div>');
			redirect('admin/myprofile_client');
		}
		else{
			redirect('contest/payment_option?contest_id=' . $contest_id.'&type=' . $contest_type);
		}
				
	}
	
	public function payment_option(){
		$this->Contest_model->check_user_login();
		$this->Contest_model->check_client_login();
		if($_GET['contest_id']){
			$data['contest_id'] = $_GET['contest_id'];
		}
		$contest_id = $data['contest_id'];
		$type =$_GET['type'];
		$get_type= $this->Common_model->get_record("contest","contest_type",array("id"=>$contest_id));
		$ctype=$get_type->contest_type;
		$data["min_price"]= contest_minimum_price($ctype);
		$data['content']='front/payment_option';
		//$data['pack']=$this->Common_model->get_records('package');
		$data['setpack']=$this->Common_model->get_record('update_package');
		$this->load->view('front/template',$data);
		
	}
	
	public function insert_payment_option(){
		$formSubmit = $this->input->post('sub_btn');
		$hours = $this->input->post('hours');
		$dur = $this->input->post('dur');
	
		//echo "<pre>"; print_r($data); exit;
		
		if($hours == 24){
			$due_date = "+1 day";
		}
		else if($hours == 48){
			$due_date = "+2 day";
		}
		else if(isset($dur) && !empty($dur))
		{
			$due_date = "+".$dur." day";
		}
		
		$dur_hours=(isset($data['hours'])&& !empty($data['hours']))?$data['hours']:'';
		$dur_days=(isset($data['dur'])&& !empty($data['dur']))?$data['dur']:0;
		
		$update_records = array(
			'bestbuy_prize' => currencyConvert("USD", "INR", $data['payment_option_amt']),
			'contest_prize' => $data['payment_option_amt'],
			'listing_fee' => $data["listing_fee"],
			'duration_hours' => (isset($data['hours'])&& !empty($data['hours']))?$data['hours']:'',
			'duration'=> (isset($data['dur'])&& !empty($data['dur']))?$data['dur']:0,
			'total_amount' => $data['contest_total'],
			'upgrade_private_contest' => $data['private_contest'],
			'upgrade_featured_contest' => $data['featured_contest'],
			'user_timezone' => date('P'),
			'user_timezone_sec' => date('Z'),
			'published_date' => date('Y-m-d H:i:s'),
			'close_date' => date('Y-m-d H:i:s',strtotime($due_date)),
		);
		$contest_id = $data['contest_id'];
		$this->Common_model->update_record('contest',$update_records, array('id'=>$contest_id));

		$repval["contest_fee"]= $data["payment_option_amt"];
		$repval["listing_fee"]= $data["listing_fee"];
		$repval["duration_fee"]= $data["exp_pay"];
		$repval["featured_fee"]= $data["featured_contest"];
		$repval["private_fee"]= $data["private_contest"];
		$repval["total_fee"]= $total_fee= $data["payment_option_amt"]+ $data["listing_fee"]+ $data["exp_pay"]+ $data["featured_contest"]+ $data["private_contest"];
		$repval["contest_reward"]= $reward= $data["payment_option_amt"] * (winner_percentage()/100);
		$repval["contest_balance"]= $total_fee- $reward;
		
		$chk= $this->Common_model->get_record("contest_pricing_report","contest_id",array("contest_id"=>$contest_id));
		
		if(!empty($chk)){
			$whr["contest_id"]= $contest_id;
			$upd= $this->Common_model->update_record("contest_pricing_report",$repval,$whr);
		}
		else{
			$repval["contest_id"]= $contest_id;
			$ins= $this->Common_model->insert_record("contest_pricing_report",$repval);
		}
		
		if($formSubmit=="Save Progress"){
			$this->session->set_flashdata('draft','<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Your contest is not fully completed. Please check your draft</div>');
			redirect('admin/myprofile_client');
		}
		else{
			
			redirect('contest/confirm_order?contest_id=' . $contest_id);
		}
	}
	
	public function confirm_order(){
		$this->Contest_model->check_user_login();
		$this->Contest_model->check_client_login();
		$contest_id = ($_GET['contest_id']);
		$data['contest_id']=$contest_id;
		$data['contest_details'] = $this->Common_model->get_record('contest','*', array('id'=>$contest_id));
		//echo '<pre>'; print_r($data['contest_details']); exit;
		$data['content']='front/confirm_order';
		$this->load->view('front/template',$data);
	}
	
	public function insert_confirm(){
		$contest_id = $this->input->post('contest_id');	
		$pay_option = $this->input->post('pay_option');
		$pay_option=($pay_option=='fpay')?1:0;
		$pay_type= ($pay_option== 1)?"Full Payment":"Partial Payment";
		$gateway = $this->input->post('gateway_option');
		$res= $this->Common_model->get_record("contest","*",array("id"=>$contest_id));
		//mail
		$to = admin_mail();
		$subject = 'Mail From Contest Hours: There is new contest created - '.contestname($contest_id);
		$message = "New Contest(".contestname($contest_id).") Added By ".username(user_id())." at ".date("d M,Y h:i a");
		$message .= "Contest Price: $".$res->total_amount."<br>";
		$message .= "Payment Type: ".$pay_type."<br>";
		$message .= "<p><a href='".base_url()."contest/contest_brief/".$contest_id."'>Click here to view Contest</a></p>";
		rp_send_email($to, $subject, $message);
		//mail

		//notification
		$noti['noti_msg']=$message;
		$noti['noti_type']=0; //new_contest_created
		$noti['noti_ref_id']=$contest_id;
		$noti['noti_entry_time']=date("Y-m-d H:i:s");
		$this->Common_model->insert_record('notification',$noti);
		//notification
		
		$contest_price=$res->total_amount;
		$pay_seting= get_payable_price();
		if($pay_seting==0){
			$payable_price= ($pay_option==1)?round($contest_price,2):round(contest_listing_fee(),2);
			}
		else{
			$payable_price= $pay_seting;
			
		}
		$partial_balance = ($pay_option==1)?0:($contest_price - $payable_price);
	    $this->Common_model->update_record('contest',array('pay_option'=>$pay_option, 'status'=>'draft', 'partial_balance'=> $partial_balance), array('id'=>$contest_id));

		$client_name=get_name();
		$email=get_email($res->client_id);
		$values['contest_id'] = $contest_id;
		$values['payable_amt'] = $payable_price;
		$values['order_notes'] = $message;
		$txnid= $values['txnid'] = substr(generate_orderid(),0,15);
		$orderid = $this->Common_model->insert_record('contest_payment',$values);
		if($gateway=='paypal'){

			$this->load->library('paypal_lib');
			$paypalID  = "avatar_x89@yahoo.com"; //business email
			//$paypalID  = "sirs.rajasekar@gmail.com"; //business email
			
			//Set variables for paypal form
			$returnURL = base_url().'contest/payment_result'; //payment success url
			$cancelURL = base_url().'contest/payment_result'; //payment cancel url
			$notifyURL = base_url().'contest/payment_result'; //ipn url
			
			$logo = base_url().'assets/image/logo.png';
			$this->paypal_lib->add_field('business', $paypalID);
			$this->paypal_lib->add_field('cmd', "_xclick");
			$this->paypal_lib->add_field('return', $returnURL);
			$this->paypal_lib->add_field('cancel_return', $cancelURL);
			$this->paypal_lib->add_field('notify_url', $notifyURL);
			$this->paypal_lib->add_field('item_name', "New Contest Created By"." - ".$client_name);
			$this->paypal_lib->add_field('item_number', $txnid);
			$this->paypal_lib->add_field('custom',  $client_name);
			
			if(getCountry() == 'IN'){
				$this->paypal_lib->add_field('currency_code', "INR");
				$this->paypal_lib->add_field('amount', convertCurrency($payable_price));	
				
		    }else{
				$this->paypal_lib->add_field('amount', $payable_price);		
				$this->paypal_lib->add_field('currency_code', "USD");
			}
			  
			
			
			
			
			
			//$this->paypal_lib->add_field('currency_code', "INR");
			//$this->paypal_lib->add_field('amount', "1");		
			
			$this->paypal_lib->paypal_auto_form();
		}
	}
	
	public function contest_partial_payment($cid){
		$this->Contest_model->check_user_login();
		$this->Contest_model->check_client_login();
		$contest_id = $cid;
		$data['contest_id']=$contest_id;
		$data['contest_details'] = $this->Common_model->get_record('contest','*', array('id'=>$contest_id));
		$data['content']='front/contest_partial_payment';
		$this->load->view('front/template',$data);
	}
	
	public function save_partialPayment(){
		$this->Contest_model->check_user_login();
		$this->Contest_model->check_client_login();		
		
		$contest_id = $this->input->post('contest_id');
		$gateway = $this->input->post('gateway_option');
		
		$res= $this->Common_model->get_record("contest","*",array("id"=>$contest_id));
		
		$data=$this->Common_model->update_record('contest',array('pay_option'=>1),array('id'=>$contest_id)); 
		
		$balance_pay= $res->total_amount - contest_listing_fee();
		//mail
		$to = admin_mail();
		$subject = 'Mail From Contest Hours: Balance Payment paid for - '.contestname($contest_id);
		$message = "Partial Payment Paid(".contestname($contest_id).") at ".date("d M,Y h:i a");
		$message .= "Contest Price: $. ".$res->total_amount."<br>";
		$message .= "Paid: $. ".round(contest_listing_fee(),2)."<br>";		
		$message .= "Balance: ".round($balance_pay,2)."<br>";
		$message .= "<p><a href='".base_url()."contest/contest_entries/".$contest_id."'>Click here to view Contest</a></p>";
		rp_send_email($to, $subject, $message);
		//mail
		
		
		//notification
		$noti['noti_msg']=$message;
		$noti['noti_type']=0;//new_contest_created
		$noti['noti_ref_id']=$contest_id;
		$noti['noti_entry_time']=date("Y-m-d H:i:s");
		$this->Common_model->insert_record('notification',$noti);
		//notification
		
		$payable_price= round($balance_pay,2);
		$client_name=get_name();
		$email=get_email($res->client_id);
		$values['contest_id'] = $contest_id;
		$values['payable_amt'] =$payable_price;
		$values['order_notes'] = $message;
		$txnid= $values['txnid'] = substr(generate_orderid(),0,15);
		$orderid = $this->Common_model->insert_record('contest_payment',$values);	
		
		if($gateway=='paypal'){
			$this->load->library('paypal_lib');
			//$paypalID  = "avatar_x89@yahoo.com"; //business email
			$paypalID  = "sirs.rajasekar@gmail.com"; //business email
			
			//Set variables for paypal form
			$returnURL = base_url().'contest/payment_result'; //payment success url
			$cancelURL = base_url().'contest/payment_result'; //payment cancel url
			$notifyURL = base_url().'contest/payment_result'; //ipn url
			
			$logo = base_url().'assets/image/logo.png';
			$this->paypal_lib->add_field('business', $paypalID);
			$this->paypal_lib->add_field('cmd', "_xclick");
			$this->paypal_lib->add_field('return', $returnURL);
			$this->paypal_lib->add_field('cancel_return', $cancelURL);
			$this->paypal_lib->add_field('notify_url', $notifyURL);
			$this->paypal_lib->add_field('item_name', "New Contest Created By"." - ".$client_name);
			$this->paypal_lib->add_field('item_number', $txnid);
			$this->paypal_lib->add_field('custom',  $client_name);
			$this->paypal_lib->add_field('amount', $payable_price);		
			$this->paypal_lib->add_field('currency_code', "USD");
			$this->paypal_lib->paypal_auto_form();
		}
	}
	
	public function payment_result(){
		
		//Atom
		$this->load->library('TransactionResponse');		
		//Atom
		
		/*https://contesthours.com/contest/payment_result?amt=1.00&cc=INR&cm=Client%20641&item_name=New%20Contest%20Created%20By%20-%20Client%20641&item_number=339234161613692&st=Completed&tx=00N80857W0650045D
		*/
		
		$paypalInfo= $this->input->post();
		
		if(isset($_GET['tx'])){ //Paypal
			$payStatus = $_GET['st'];
			$payTransaction = $_GET['tx'];
			$payItemNumber = $_GET['item_number'];
			
			$array = array("item_number"=>$_GET['item_number'],"st"=>$_GET['st'],"tx"=>$_GET['tx']);
			$data['pay_response']= json_encode($array);
			$this->session->set_userdata('paystatus',$array);
		}else{
			$data['pay_response']= json_encode($paypalInfo);
			$this->session->set_userdata('paystatus',$paypalInfo);
		}
		
		
	
		
		$data['pay_time']= date("Y-m-d H:i:s");
		
		
		if(isset($paypalInfo['mmp_txn'])){
			$where['txnid'] = $paypalInfo["mer_txn"];
			if($paypalInfo['f_code'] == 'Ok'){
				$paystatus = 1;
				$value["status"] = "open";
			}else{
				$paystatus = 0;
				$value["status"] = "draft";
			}
			$data['gateway'] = "atom";
			$data['pay_status'] = $paypalInfo["f_code"];
			$data['atom_amt'] = $paypalInfo["amt"];
		}else{
			$data['pay_status'] = $payStatus;
			$where['txnid'] = $payItemNumber;
			$paystatus = ($payStatus)=="Completed"?1:0;
			$data['gateway'] = "paypal";
			$value["status"] = ($payStatus)=="Completed"?"open":"draft";
		}
		$data['status'] = $paystatus;
		$result= $this->Common_model->update_record("contest_payment",$data,$where);
		$contest_data= $this->Common_model->get_record("contest_payment","*",$where);
		$contest_id= $contest_data->contest_id;
		$result= $this->Common_model->update_record("contest",$value,array("id"=>$contest_id));
		if($paystatus==1){
			$m_value["client_id"]= $client_id= user_id();
			$m_value["contest_id"]= $contest_id;
			
			//mail
			$to = get_email($client_id);
			$subject = 'You have launched a contest - '.contestname($contest_id);
			$message = $this->load->view('front/newsletter/contest_client_welcome',$m_value,true);
			rp_send_email($to, $subject, $message);
			//mail
		}
		
		redirect("contest/paymentstatus");
		
	}
	 
	public function paymentstatus(){
		$data["paystatus"]= $paystatus= $this->session->userdata('paystatus');
		
		if(isset($paystatus["item_number"]))
			$where['txnid']= $paystatus["item_number"];
		if(isset($paystatus["mer_txn"]))
			$where['txnid']= $paystatus["mer_txn"];
		if(isset($where))
			$data["contest_data"]= $this->Common_model->get_record("contest_payment","*",$where);

		$data['content'] = 'front/payment_result';	
		$this->load->view('front/template',$data);
	}
	
	public function categoryWise_openContests(){
		$cat_type = $_POST['category'];
		$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1,'contest_type'=>$cat_type));
		$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,'contest_type'=>$cat_type));
		$this->load->view('front/ajax/ajax_open_contest',$data);
	}
	
	public function industryWise_openContests(){
		$indus_type = $_POST['industry'];
		$data['indus_id']=$this->Contest_model->get_indutry_id($indus_type);
		$indus = $data['indus_id'];
		$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1,'industry'=>$indus));
		$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,'industry'=>$indus));
		$this->load->view('front/ajax/ajax_open_contest',$data);
	}
	
	public function choose_openContests(){
		
		$cat_type = $_POST['category'];
		$indus_type = $_POST['industry'];
		$data['indus_id']=$this->Contest_model->get_industry_id($indus_type);
		$indus = $data['indus_id'];
		
		if((!empty($indus))&&(!empty($cat_type))){
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1, "status"=>"open",'industry'=>$indus,'contest_type'=>$cat_type));
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1, "status"=>"open", 'industry'=>$indus,'contest_type'=>$cat_type));
		}
		else if((!empty($indus))&&(empty($cat_type))){
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1, "status"=>"open", 'industry'=>$indus));
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1, "status"=>"open", 'industry'=>$indus));
		}
		else if((empty($indus))&&(!empty($cat_type))){
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1, "status"=>"open",'contest_type'=>$cat_type));
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1, "status"=>"open",'contest_type'=>$cat_type));
		}
		else {
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1, "status"=>"open"));
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1, "status"=>"open"));
		}
		$this->load->view('front/ajax/ajax_open_contest1',$data);
	}
	
	public function particular_contest(){
		$designer_id=$this->session->userdata('user_id');
		$par_id = $this->uri->segment(3);
		$data['parid'] = $par_id;
		$data['current_page']="contest/particular_contest/".$par_id;
		$data['industry']=$this->Common_model->get_records('industry');
		$data['category']=$this->Common_model->get_category($par_id);
		$data['designs']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,'final_read'=>0,'display_status'=>0,'final_status'=>0),"design_rating,rating_time","DESC");
		
		
		$data['designs_skip']=$this->Common_model->get_records('designs','*',array('contest_id'=>$par_id,'final_status'=>0));
	
		$data['finaldesigns']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,"final_status"=>1),"design_rating,rating_time","DESC");
		$data['ctfinaldes'] = count($data['finaldesigns']);
		
		$data['subfinaldesigns']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,'final_read'=>1),"design_rating,rating_time","DESC");
		
		$data['winningcontest']=$this->Common_model->get_record('designs','*',array('contest_id'=>$par_id,'design_status'=>1));
		$data['win_design'] = count($data['winningcontest']);
		
		$data['users_list']=$this->Common_model->get_records('user_table');
		$data['single_contest']=$this->Common_model->get_records('contest','*,DATEDIFF(date(now()),payment_reqtime)req_gap,DATEDIFF(date(now()),payment_release_reqtime)release_gap',array('id'=>$par_id));
		
		$data['count_designs']=$this->Common_model->get_records_count('designs',array('contest_id'=>$par_id,'display_status'=>0));
		
		$data['contestid'] = $par_id;
		$data['allcomments']=$this->Common_model->get_records('contest_comments','*',array('contest_id'=>$par_id,'status'=>0));
		$data['subcheck']=$this->Common_model->get_record('designs','*',array("contest_id"=>$par_id,"designer_id"=>$designer_id,"final_status"=>1));
		$data['content']='front/open_view_brief1';
		//$data['content']='front/open_view_mode';
		$this->load->view('front/template1',$data);
	}
	
	public function contest_brief()
	{
		$designer_id=$this->session->userdata('user_id');
		$par_id = $this->uri->segment(3);
		
		$data['current_page']="contest/particular_contest/".$par_id;
		$data['industry']=$this->Common_model->get_records('industry');
		$data['category']=$this->Common_model->get_category($par_id);
		$data['designs']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,'final_read'=>0,'display_status'=>0,'final_status'=>0),"design_rating,rating_time","DESC");
		
		
		$data['designs_skip']=$this->Common_model->get_records('designs','*',array('contest_id'=>$par_id,'final_status'=>0));
	
		$data['finaldesigns']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,"final_status"=>1),"design_rating,rating_time","DESC");
		$data['ctfinaldes'] = count($data['finaldesigns']);
		
		$data['subfinaldesigns']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,'final_read'=>1),"design_rating,rating_time","DESC");
		
		
		
		$data['winningcontest']=$this->Common_model->get_record('designs','*',array('contest_id'=>$par_id,'design_status'=>1));
		$data['win_design'] = count($data['winningcontest']);
		
		$data['users_list']=$this->Common_model->get_records('user_table');
		$data['single_contest']=$this->Common_model->get_records('contest','*,DATEDIFF(date(now()),payment_reqtime)req_gap,DATEDIFF(date(now()),payment_release_reqtime)release_gap',array('id'=>$par_id));
		
		$data['count_designs']=$this->Common_model->get_records_count('designs',array('contest_id'=>$par_id,'display_status'=>0));
		
		$data['contestid'] = $par_id;
		$data['allcomments']=$this->Common_model->get_records('contest_comments','*',array('contest_id'=>$par_id,'status'=>0));
		$data['subcheck']=$this->Common_model->get_record('designs','*',array("contest_id"=>$par_id,"designer_id"=>$designer_id,"final_status"=>1));
		$data['content']='front/open_view_brief1';
		$this->load->view('front/template1',$data);
	}
	
	
	/*public function contest_entries($id="", $rate=""){
		$designer_id=$this->session->userdata('user_id');
		$par_id = $this->uri->segment(3);
		
		$data['current_page']="contest/particular_contest/".$par_id;
		$data['industry']=$this->Common_model->get_records('industry');
		
		$time = $rate;
		$contestid = $id;
		
		
		 switch ($time) {
			case "oldest":
				$orderBy = "entry_time"; $short="asc";
				break;
			case "latest":
				$orderBy = "entry_time"; $short="DESC";
				break;
			case "lowrating":
				$orderBy = "design_rating"; $short="asc";
				break;
			case "highrating":
				$orderBy = "design_rating"; $short="DESC";
				break;
			default:
				$orderBy = "design_rating, rating_time, entry_time"; $short="DESC";
		} 
		
		$data['designs']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,'final_read'=>0,'final_status'=>0),"$orderBy","$short");
		//$data['designs']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,'final_read'=>0,'display_status'=>0,'final_status'=>0),"$orderBy","$short");
		
		$data['subfinaldesigns']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,'final_read'=>1),"$orderBy","$short");
		
		$data['designs_skip']=$this->Common_model->get_records('designs','*',array('contest_id'=>$par_id,'final_status'=>0));
	
		$data['finaldesigns']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,"final_status"=>1),"design_rating,rating_time","DESC");
		$data['ctfinaldes'] = count($data['finaldesigns']);
		
		
		$data['winningcontest']=$this->Common_model->get_record('designs','*',array('contest_id'=>$par_id,'design_status'=>1));
		$data['win_design'] = count($data['winningcontest']);
		
		$data['users_list']=$this->Common_model->get_records('user_table');
		$data['single_contest']=$this->Common_model->get_records('contest','*,DATEDIFF(date(now()),payment_reqtime)req_gap,DATEDIFF(date(now()),payment_release_reqtime)release_gap',array('id'=>$par_id));
		
		$data['count_designs']=$this->Common_model->get_records_count('designs',array('contest_id'=>$par_id,'display_status'=>0));
		
		$data['contestid'] = $par_id;
		$data['allcomments']=$this->Common_model->get_records('contest_comments','*',array('contest_id'=>$par_id,'status'=>0));
		$data['subcheck']=$this->Common_model->get_record('designs','*',array("contest_id"=>$par_id,"designer_id"=>$designer_id,"final_status"=>1));
		
		$data['designersname'] = $this->Contest_model->contest_designers($par_id);
		$data['finalist_designers'] = $this->Contest_model->contest_fianlist($par_id);
		
		$data['content']='front/open_view_entries';
		$this->load->view('front/template',$data);
	}*/
	public function contest_entries($id="", $rate=""){
		$designer_id=$this->session->userdata('user_id');
		$par_id = $this->uri->segment(3);
		$data['current_page']="contest/particular_contest/".$par_id;
		$data['industry']=$this->Common_model->get_records('industry');
		$data['category']=$this->Common_model->get_category($par_id);
		$time = $rate;
		$contestid = $id;
		
		
		 switch ($time) {
			case "oldest":
				$orderBy = "entry_time"; $short="asc";
				break;
			case "latest":
				$orderBy = "entry_time"; $short="DESC";
				break;
			case "lowrating":
				$orderBy = "design_rating"; $short="asc";
				break;
			case "highrating":
				$orderBy = "design_rating"; $short="DESC";
				break;
			default:
				$orderBy = "design_rating, rating_time, entry_time"; $short="DESC";
		} 
		
		$data['designs']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,'final_read'=>0,'final_status'=>0),"$orderBy","$short");
		//$data['designs']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,'final_read'=>0,'display_status'=>0,'final_status'=>0),"$orderBy","$short");
		$data['winningcontest']=$this->Common_model->get_record('designs','*',array('contest_id'=>$par_id,'design_status'=>1));
		$data['subfinaldesigns']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,'final_read'=>1),"$orderBy","$short");
		
		$data['designs_skip']=$this->Common_model->get_records('designs','*',array('contest_id'=>$par_id,'final_status'=>0));
	
		$data['finaldesigns']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,"final_status"=>1),"design_rating,rating_time","DESC");
		$data['ctfinaldes'] = count($data['finaldesigns']);
		
		
		$data['winningcontest']=$this->Common_model->get_record('designs','*',array('contest_id'=>$par_id,'design_status'=>1));
		$data['win_design'] = count($data['winningcontest']);
		
		$data['users_list']=$this->Common_model->get_records('user_table');
		$data['single_contest']=$this->Common_model->get_records('contest','*,DATEDIFF(date(now()),payment_reqtime)req_gap,DATEDIFF(date(now()),payment_release_reqtime)release_gap',array('id'=>$par_id));
		
		$data['count_designs']=$this->Common_model->get_records_count('designs',array('contest_id'=>$par_id,'display_status'=>0));
		
		$data['contestid'] = $par_id;
		$data['allcomments']=$this->Common_model->get_records('contest_comments','*',array('contest_id'=>$par_id,'status'=>0));
		$data['subcheck']=$this->Common_model->get_record('designs','*',array("contest_id"=>$par_id,"designer_id"=>$designer_id,"final_status"=>1));
		
		$data['designersname'] = $this->Contest_model->contest_designers($par_id);
		$data['finalist_designers'] = $this->Contest_model->contest_fianlist($par_id);
		
		$data['content']='front/open_view_entries1';
		$this->load->view('front/template1',$data);
	}
	
	
	public function contest_discussions()
	{
		$designer_id=$this->session->userdata('user_id');
		$par_id = $this->uri->segment(3);
		
		$data['current_page']="contest/particular_contest/".$par_id;
		$data['industry']=$this->Common_model->get_records('industry');
		$data['category']=$this->Common_model->get_category($par_id);
		$data['designs']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,'final_read'=>0,'display_status'=>0,'final_status'=>0),"design_rating,rating_time","DESC");
		
		
		$data['designs_skip']=$this->Common_model->get_records('designs','*',array('contest_id'=>$par_id,'final_status'=>0));
	
		$data['finaldesigns']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,"final_status"=>1),"design_rating,rating_time","DESC");
		$data['ctfinaldes'] = count($data['finaldesigns']);
		
		$data['subfinaldesigns']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,'final_read'=>1),"design_rating,rating_time","DESC");
		
		
		
		$data['winningcontest']=$this->Common_model->get_record('designs','*',array('contest_id'=>$par_id,'design_status'=>1));
		$data['win_design'] = count($data['winningcontest']);
		
		$data['users_list']=$this->Common_model->get_records('user_table');
		$data['single_contest']=$this->Common_model->get_records('contest','*,DATEDIFF(date(now()),payment_reqtime)req_gap,DATEDIFF(date(now()),payment_release_reqtime)release_gap',array('id'=>$par_id));
		
		$data['count_designs']=$this->Common_model->get_records_count('designs',array('contest_id'=>$par_id,'display_status'=>0));
		
		$data['contestid'] = $par_id;
		$data['allcomments']=$this->Common_model->get_records('contest_comments','*',array('contest_id'=>$par_id,'status'=>0));
		$data['subcheck']=$this->Common_model->get_record('designs','*',array("contest_id"=>$par_id,"designer_id"=>$designer_id,"final_status"=>1));
		$data['content']='front/open_view_discussions1';
		$this->load->view('front/template1',$data);
	}
	
	public function contest_procedure(){
	
		$designer_id=$this->session->userdata('user_id');
		$par_id = $this->uri->segment(3);
		
		$data['current_page']="contest/particular_contest/".$par_id;
		$data['category']=$this->Common_model->get_category($par_id);
		$data['industry']=$this->Common_model->get_records('industry');
		$data['designs']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,'final_read'=>0,'display_status'=>0,'final_status'=>0),"design_rating,rating_time","DESC");
		
		
		$data['designs_skip']=$this->Common_model->get_records('designs','*',array('contest_id'=>$par_id,'final_status'=>0));
	
		$data['finaldesigns']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,"final_status"=>1),"design_rating,rating_time","DESC");
		$data['ctfinaldes'] = count($data['finaldesigns']);
		
		$data['subfinaldesigns']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,'final_read'=>1),"design_rating,rating_time","DESC");

		$data['winningcontest']=$this->Common_model->get_record('designs','*',array('contest_id'=>$par_id,'design_status'=>1));

		$data['win_design'] = count($data['winningcontest']);
		
		$data['users_list']=$this->Common_model->get_records('user_table');
		$data['single_contest']=$this->Common_model->get_records('contest','*,DATEDIFF(date(now()),payment_reqtime)req_gap,DATEDIFF(date(now()),payment_release_reqtime)release_gap',array('id'=>$par_id));
		
		$data['count_designs']=$this->Common_model->get_records_count('designs',array('contest_id'=>$par_id,'display_status'=>0));
		
		$data['contestid'] = $par_id;
		$data['allcomments']=$this->Common_model->get_records('contest_comments','*',array('contest_id'=>$par_id,'status'=>0));
		$data['subcheck']=$this->Common_model->get_record('designs','*',array("contest_id"=>$par_id,"designer_id"=>$designer_id,"final_status"=>1));
		$data['content']='front/contest_procedure1';
		$this->load->view('front/template1',$data);
	}	
		
	
	public function contest_designpackage(){
		$designer_id=$this->session->userdata('user_id');
		$par_id = $this->uri->segment(3);
		
		$data['current_page']="contest/particular_contest/".$par_id;
		$data['category']=$this->Common_model->get_category($par_id);
		$data['industry']=$this->Common_model->get_records('industry');
		$data['designs']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,'final_read'=>0,'display_status'=>0,'final_status'=>0),"design_rating,rating_time","DESC");
		
		
		//$data['designs_skip']=$this->Common_model->get_records('designs','*',array('contest_id'=>$par_id,'final_status'=>0));
	
		//$data['finaldesigns']=$this->Common_model->get_records_order_by('designs','*',array('contest_id'=>$par_id,"final_status"=>1),"design_rating,rating_time","DESC");
		//$data['ctfinaldes'] = count($data['finaldesigns']);
		
		//$data['subfinaldesigns']=$this->Common_model->get_records_order_by('designs', '*', array('contest_id'=>$par_id, 'final_read'=>1), "design_rating,rating_time","DESC");
		
		
		
		$data['winningcontest']=$this->Common_model->get_record('designs','*',array('contest_id'=>$par_id,'design_status'=>1));
		$data['win_design'] = count($data['winningcontest']);
		
		$data['users_list']=$this->Common_model->get_records('user_table');
		$data['single_contest']=$this->Common_model->get_records('contest','*, IFNULL(DATEDIFF(date(now()),package_uploadtime),0)upload_gap, IFNULL(DATEDIFF(date(now()),package_downloadtime),0)down_gap, IFNULL(DATEDIFF(date(now()),payment_reqtime),0)req_gap, IFNULL(DATEDIFF(date(now()),payment_release_reqtime),0)release_gap',array('id'=>$par_id));
		
		$data['count_designs']=$this->Common_model->get_records_count('designs',array('contest_id'=>$par_id,'display_status'=>0));
		
		$data['contestid'] = $par_id;
		
		$data['allcomments']=$this->Common_model->get_records('contest_comments','*',array('contest_id'=>$par_id,'status'=>0));	
		
		$data['subcheck']=$this->Common_model->get_record('designs','*',array("contest_id"=>$par_id,"designer_id"=>$designer_id,"final_status"=>1));
		
		$data['content']='front/open_view_designpackage1';
		$this->load->view('front/template1',$data);
	}
	
	public function upload_package(){
		$designer_id=$this->session->userdata('user_id');
		$contest_id=$this->input->post('contest_id');	
		$client_id=$this->input->post('client_id');	
		$filename= "package_".strtolower(contestname($contest_id))."_$contest_id";
		$config['upload_path']= 'uploads/package_uploads';
		$config['allowed_types'] = 'zip';
		$config['file_name'] = $filename;

		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		if (!empty($_FILES['upload_package']['name'])){
			if($this->upload->do_upload('upload_package'))
			{
				$upload_data=array('upload_data'=>$this->upload->data());
				$file_name=$upload_data['upload_data']['file_name'];

			}
			else
			{	
				$error = array('error' => $this->upload->display_errors());
			}
		
		$this->Common_model->update_record('contest',array('package_status'=>1,'package_path'=>$file_name,'package_uploadtime'=>date("Y-m-d H:i:s"), 'package_downloadtime'=>"0000-00-00 00:00:00", 'payment_reqtime'=>"0000-00-00 00:00:00"),array('id'=>$contest_id,'package_status<'=>3));
		
		$values['from_id']=$designer_id;
		$values['to_id']=$client_id;
		$values['subject']="Design Package for ".contestname($contest_id)." uploaded by the designer";
		$values['contest_id']=$contest_id;
		$values['created_time']=date("Y-m-d H:i:s");
	    $this->Common_model->insert_record('client_notification',$values);
		
		//mail
		$m_values['contest_id']=$contest_id;
		$m_values['client_id']=$client_id;
		$to    = get_email($client_id); 
		$subject = "Mail From Contest Hours: Design Package for ".contestname($contest_id)." uploaded by the designer";
		$message = $this->load->view('front/newsletter/design_upload',$m_values,true);
		rp_send_email($to, $subject, $message);		
		//mail
		
		$this->session->set_flashdata('design_upload','<div class="alert alert-block alert-success" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i> Your design Package has been successfully uploaded.</div>');
		redirect('contest/contest_designpackage/'.$contest_id);
		}
		else
		{
			$error = array('error' => $this->upload->display_errors());
			redirect('contest/contest_discussions/'.$contest_id);
		}
	}
	
	public function design_upload()
	{
		$this->Contest_model->check_designer_login();
		$designer_id=$this->session->userdata('user_id');
		$contest_id=$this->input->post('contest_id');
		$client_id=$this->input->post('client_id');
		$final_status=$this->input->post('final_status');
		if(isset($final_status) && !empty($final_status))
		 $final_read = 1;
	    else
		 $final_read = 0; 	
		
		$config['upload_path']= 'uploads/designer_designs';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name'] = TRUE;
		//$new_name = time().$_FILES["for_upload"]['name'];
		//$config['file_name'] = $new_name;
		
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		
		
		if (!empty($_FILES['for_upload']['name'])) {
		if($this->upload->do_upload('for_upload')){ 
			$upload_data=array('upload_data'=>$this->upload->data());
			$file_name=$upload_data['upload_data']['file_name'];
			$design_count=$this->Common_model->get_records_count('designs',array('contest_id'=>$contest_id));
			$design_no=$design_count+1;
			
			if(payment_status($contest_id)==0){
				$design_data["design_watermark"]=$this->contest_wmark($file_name);
			}
			
			$design_data["design_name"]= $file_name;
			$design_data['design_no']=$design_no;
			$design_data['contest_id']=$contest_id;
			$design_data['designer_id']=$designer_id;
			$design_data['client_id']=$client_id;
			$design_data['final_read']=$final_read;
			$design_data['entry_time']=date("Y-m-d H:i:s");
			$this->Common_model->insert_record('designs',$design_data);
			$this->session->set_flashdata('design_upload','<div class="alert alert-block alert-success" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>  Your design has been successfully uploaded. </div>');
			
			//mail
			$to    = get_email($client_id); 
			$subject = "Mail From Contest Hours: New Design Submitted for ".contestname($contest_id);
			$message = username($designer_id)." has submitted his entry to your contest. Please check and give a rating and feedback.<br>";
			$message .= "Contest Name :- ".contestname($contest_id).",<br> Contet Link :- ".base_url()."contest/contest_entries/".$contest_id.",<br> Design #: ".$design_no;
			rp_send_email($to, $subject, $message);		
			//mail
			
			redirect('contest/contest_entries/'.$contest_id);
		}
		else
		{	
			$error = array('error' => $this->upload->display_errors());
			//print_r($error);
			redirect('contest/contest_entries/'.$contest_id);
		}
		
			
		}
		else
		{
			$error = array('error' => $this->upload->display_errors());
			redirect('contest/contest_entries/'.$contest_id);
		}
	}
	
	public function packagedownload(){
		$contest_id = $this->input->post('contest_id');
		
		$this->Common_model->update_record("contest",array("package_status"=>2,"package_downloadtime"=>date("Y-m-d H:i:s")),array("id"=>$contest_id));

		$file=$this->Common_model->get_record("contest","package_path",array("id"=>$contest_id));
		$download_file=$file->package_path;
		
		$res= $this->Common_model->get_record("designs","designer_id, client_id",array("design_status"=>1, "contest_id"=>$contest_id));
		
		$data['from_id']= $res->client_id;
		$data['to_id']= $res->designer_id;
		$data['subject']="Design Package for ".contestname($contest_id)." was downloaded.";
		$data['contest_id']=$contest_id;
		$data['created_time']=date("Y-m-d H:i:s");
		
	    $this->Common_model->insert_record('client_notification',$data);
		
		if(!empty($file)){
			$array=array("file_path"=>base_url()."uploads/package_uploads/".$download_file,"status"=>"success");
			echo json_encode($array);
		}
	} 

	public function confirmpackage(){
		
		$cid = $this->input->post('contest_id');
		$testimony['contest_id']= $where['contest_id']= $cid;
		$testimony['message'] = $this->input->post('testimony_msg');
		$testimony['client_id']=user_id();
		$testimony['createdTime']=date("Y-m-d H:i:s");
		$res = $this->Common_model->get_records('testimony','*',$where);
		if(empty($res)){
			$this->Common_model->insert_record('testimony',$testimony);
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('msgs', 'Thanks for your review.!');
		}
		else{
			$this->Common_model->update_record('testimony',$testimony,$where);
		}	
		
		$contest_id=$cid;
		$values['contest_id']=$cid;
		$date=date("Y-m-d H:i:s");
		
		/********Winner Payment********/
		$winner_res= $this->Common_model->get_record('designs','design_id, designer_id',array('design_status'=>1,'contest_id'=>$cid));
		$design_id=$winner_res->design_id;
		$designer_id=$winner_id=$winner_res->designer_id;
		
		$amount= $this->Common_model->get_record('contest','contest_prize',array('id'=>$cid));
		$contest_prize= $amount->contest_prize;
		
		$pg= $this->Common_model->get_record('pricing_percentage','',array('status'=>1));
		$winner_percentage= $pg->winner_percentage;
		$winner_price= round($contest_prize * ($winner_percentage/100));

		$reward['contest_id']=$cid;
		$reward['design_id']=$design_id;
		$reward['designer_id']=$designer_id;
		$reward['reward_msg']=contestname($contest_id)." - contest price: $ ".$winner_price;
		$reward['reward_type']=1;
		$reward['reward_value']=$winner_price;
		$rew_id=$this->Common_model->insert_record("rewards",$reward);
		
		$trans['reward_id']=$rew_id;		
		$trans['designer_id']=$designer_id;
		$trans['trans_date']=$date;
		$trans['trans_value']=$winner_price;
		$old_balance=designer_balance($designer_id);
		$new_balance= $winner_price+ $old_balance;
		$trans['trans_old_balance']=$old_balance;
		$trans['trans_new_balance']=$new_balance;
		$rew=$this->Common_model->insert_record("transaction",$trans);
		/**************/
		
		$winner_email=designer_email($winner_id);
		
		//mail
		$m_values['contest_id']=$cid;
		$m_values['designer_id']=$winner_id;
		$to    = $winner_email;   //designer mail//
		$subject = 'Mail From Contest Hours: Your Price Amount Creadited For '.contestname($cid);
		$message = $this->load->view('front/newsletter/package_confirmed',$m_values,true);
		rp_send_email($to, $subject, $message);		
		//mail	
		
		//mail for contest admin
		$contest_id=$cid;
		$to = admin_mail();
		$subject = 'Mail From Contest Hours: Winner Selected For- '.contestname($contest_id);
		$message = "<p>Client confirmed the pacakage of (".contestname($contest_id).")-By ".username(user_id())." at ".date("d M,Y h:i a")."</p>";
		$message .= "<p><a href='".base_url()."contest/contest_entries/".$contest_id."'>Click here to view Contest</a></p>";		
		rp_send_email($to, $subject, $message);
		//mail
		
		//notification
		$noti['noti_msg']= "Client confirmed the pacakage of (".contestname($contest_id).")-By ".username(user_id())." at ".date("d M,Y h:i a");
		$noti['noti_type']=4;//New designer payment request
		$noti['noti_ref_id']=$contest_id;
		$noti['noti_entry_time']=$date;
		$this->Common_model->insert_record('notification',$noti);
		//notification
				
		$this->Common_model->update_record("contest",array("package_status"=>3,"package_confirmtime"=>$date,"contest_paid_status"=>1),array("id"=>$cid));
				
		$data['from_id']= user_id();
		$data['to_id']= $designer_id;
		$data['subject']="Client confirmed the pacakage of (".contestname($contest_id).")-By ".username(user_id()).".";
		$data['contest_id']=$contest_id;
		$data['created_time']=date("Y-m-d H:i:s");
		
	    $this->Common_model->insert_record('client_notification',$data);
		
		redirect('contest/contest_designpackage/'.$contest_id);
	}
	
	public function requestpayment($cid){
		$contest_id = $cid;
		$this->Common_model->update_record("contest",array("payment_reqtime"=>date("Y-m-d H:i:s"),"payment_req_status"=>"1"),array("id"=>$contest_id));
		
		$this->session->set_flashdata('design_upload','<div class="alert alert-block alert-success" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i> Payment request applied successfully. </div>');
		redirect('contest/contest_designpackage/'.$contest_id);
	}
	
	public function releasepayment($cid){
		$contest_id = $cid;	
		$this->Common_model->update_record("contest",array("package_status"=>3,"payment_release_reqtime"=>date("Y-m-d H:i:s")),array("id"=>$contest_id));

		$designer_id=$this->session->userdata('user_id');
		
		$this->session->set_flashdata('design_upload','<div class="alert alert-block alert-success" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i> Payment request applied successfully. </div>');
		
		redirect('contest/contest_designpackage/'.$contest_id);
	}

	public function release_payment_option()
	{
		$designer_id=user_id();
		$user_pass=$this->input->post('user_pass');
		$date=date("Y-m-d H:i:s");
		
		$email=$this->Common_model->get_record('designer_table','',array('users_id'=>$designer_id,'designer_password'=>$user_pass));
		
		if(!empty($email)){
			$designer_email=$email->designer_email;
			$current_bal=designer_balance($designer_id);

			if($current_bal !=""){				
				$trans_fee=$this->Common_model->get_record("pricing_percentage",'transaction_charge',array('status'=>1));				
				$fee=$trans_fee->transaction_charge;
				
				$reward['designer_id']=$designer_id;
				$reward['reward_msg']="Withdraw request submited: $ ".$current_bal."-".$fee."(transaction fee)";
				$reward['reward_type']=2;
				$reward['reward_value']=-$fee;
				$rew_id=$this->Common_model->insert_record("rewards",$reward);
				
				$trans['reward_id']=$rew_id;		
				$trans['designer_id']=$designer_id;
				$trans['trans_date']=$date;
				$trans['trans_value']= -$fee;
				$old_balance=designer_balance($designer_id);
				$new_balance= $old_balance-$fee;
				$trans['trans_old_balance']=$old_balance;
				$trans['trans_new_balance']=$new_balance;
				$rew=$this->Common_model->insert_record("transaction",$trans);
								
				$req['designer_id']=$designer_id;
				$req['request_date']=$date;
				$req['request_amount']=$new_balance;
				$req['request_fee']=-$fee;
				$new_req= $this->Common_model->insert_record('payment_request',$req);
				
				$this->session->set_flashdata('designer_request','<div class="alert alert-block alert-success" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i> your request successfully added. </div>');

				//mail  for payment request 
				$m_value['designer_id']=$designer_id;
				$m_value['request_date']=date("Y-m-d H:i:s");
		
				$to      = $designer_email;   //request designer//
				$subject = 'Mail From Contest Hours';
				$message = $this->load->view('front/newsletter/payment_withdraw_message',$m_value,true);
				rp_send_email($to, $subject, $message);			
				//mail 
				
				//mail for contest admin
				$to = admin_mail();
				$subject = 'New Payment Request By '.username($designer_id);
				$message = "<p>New withdraw request submited at ".date("d F,Y H:i:s A")." $".$old_balance."(request) - $".$fee."(fee)= $".$new_balance.". Request submited by ".username($designer_id)."</p>";
				$message .= "<p><a href='".base_url()."admin_panel/view_payment_rquest/".$new_req."'>Click here to view request</a></p>";		
				rp_send_email($to, $subject, $message);
				//mail
				
				//notification
				$noti['noti_msg']= 'New Payment Request By '.username($designer_id);
				$noti['noti_type']=6;//New designer payment request
				$noti['noti_ref_id']=$new_req;
				$noti['noti_entry_time']=$date;
				$this->Common_model->insert_record('notification',$noti);
				//notification
		
			}
			else{
				$this->session->set_flashdata('designer_request','<div class="alert alert-block alert-success" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>Request Successfully Submitted.!</div>');
			}
		}
		else{
			$this->session->set_flashdata('designer_request','<div class="alert alert-block alert-danger" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>Password which you provide is wrong.</div>');
		}
		
		redirect('admin/payment_designer');
	}

	public function release_payment_referral_option()
	{
		$referral_id=user_id();
		$user_pass=$this->input->post('user_pass');
		$date=date("Y-m-d H:i:s");
		
		$email=$this->Common_model->get_record('referral_table','',array('users_id'=>$referral_id,'referral_password'=>$user_pass));
		
		if(!empty($email)){
			$referral_email=$email->referral_email;
			$current_bal=referral_balance($referral_id);
			if($current_bal !=""){				
				/*$trans_fee=$this->Common_model->get_record("pricing_percentage",'transaction_charge',array('status'=>1));				
				$fee=$trans_fee->transaction_charge;
				
				$reward['referral_id']=$referral_id;
				$reward['reward_msg']="Withdraw request submited: $ ".$current_bal."-".$fee."(transaction fee)";
				$reward['reward_type']=2;
				$reward['reward_value']=-$fee;
				$rew_id=$this->Common_model->insert_record("rewards",$reward);
				$trans['reward_id']=$rew_id;*/	
				$trans_fee=$this->Common_model->get_record("pricing_percentage",'transaction_charge',array('status'=>1));				
				$fee=$trans_fee->transaction_charge;
				$trans['ref_id']=$referral_id;
				$trans['trans_date']=$date;
				$old_balance=referral_balance($referral_id);
				$trans['trans_msg']= "New request Amount : $ ".$old_balance." and Transcation Charges -". $fee;
				$trans['trans_value']="+".$old_balance;

				//$new_balance= $old_balance-$fee;
				//$trans['trans_old_balance']=$old_balance;
				$trans['trans_amount']=$old_balance - $fee;

				$rew=$this->Common_model->insert_record("referral_transaction",$trans);

				//$request_balance=referral_request_balance($referral_id);	
				$new_balance = $old_balance;
				$req['ref_id']=$referral_id;
				$req['request_date']=$date;
				$req['request_old_amount']=$old_balance;
				$req['request_amount']=$new_balance - $fee;
				//$req['request_fee']=-$fee;
				$new_req= $this->Common_model->insert_record('referral_payment_request',$req);
				
				$this->session->set_flashdata('referral_request','<div class="alert alert-block alert-success" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i> your request successfully added. </div>');

				//mail  for payment request 
				$m_value['ref_id']=$referral_id;
				$m_value['request_date']=date("Y-m-d H:i:s");
		
				$to      = $referral_email;   //request referral//
				$subject = 'Mail From Contest Hours';
				$message = $this->load->view('front/newsletter/payment_withdraw_message',$m_value,true);
				rp_send_email($to, $subject, $message);			
				//mail 
				
				//mail for contest admin
				$to = admin_mail();
				$subject = 'New Payment Request By '.username($referral_id);
				$message = "<p>New withdraw request submited at ".date("d F,Y H:i:s A")." $".$old_balance."(request) - $".$fee."(fee)= $".$new_balance.". Request submited by ".username($referral_id)."</p>";
				$message .= "<p><a href='".base_url()."admin_panel/view_payment_rquest/".$new_req."'>Click here to view request</a></p>";		
				rp_send_email($to, $subject, $message);
				//mail
				
				//notification
				$noti['noti_msg']= 'New Payment Request By '.username($referral_id);
				$noti['noti_type']=6;//New referral payment request
				$noti['noti_ref_id']=$new_req;
				$noti['noti_entry_time']=$date;
				$this->Common_model->insert_record('notification',$noti);
				//notification
		
			}
			else{
				$this->session->set_flashdata('referral_request','<div class="alert alert-block alert-success" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>Request Successfully Submitted.!</div>');
			}
		}
		else{
			$this->session->set_flashdata('referral_request','<div class="alert alert-block alert-danger" style="width:40%; margin:2% auto 0;"><button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button><i class="icon-ok green"></i>Password which you provide is wrong.</div>');
		}
		
		redirect('admin/payment_referral');
	}
	
	public function message(){

		$contest_id=$this->input->post('contest_id');
		$from=$this->input->post('from2');
		$to_id=$this->input->post('to1');
		$user_message=$this->input->post('subject');
		$values['from_id']=$from;
		$values['to_id']=$to_id;
		$values['subject']=$user_message;
		$values['contest_id']=$contest_id;
		$values['created_time']=date("Y-m-d H:i:s");
		
		$data['from_id']=$from;
		$data['to_id']=$to_id;
		$data['subject']="You got a message from designer  for ".contestname($contest_id)." regarding the design pacakage.";
		$data['contest_id']=$contest_id;
		$data['created_time']=date("Y-m-d H:i:s");
	    $this->Common_model->insert_record('client_notification',$data);
		
	    $this->Common_model->insert_record('message_table',$values);
		
		$user_type=$this->session->userdata('user_type');
	
		if($user_type==1)
		{ 
		$email2=$this->Common_model->get_record('client_table','',array('users_id'=>$to_id));
		$to_email= $email2->email;
		}
		else{
			$email3=$this->Common_model->get_record('designer_table','',array('users_id'=>$to_id));
			 $to_email= $email3->designer_email;
		}
		
		$values['user_type']=$user_type;
		//mail  
			$to	= $to_email;   
			$subject = 'Mail From Contest Hours';
			$message = $this->load->view('front/newsletter/package_message',$values,true);
			rp_send_email($to, $subject, $message);			
		//mail	 
	
	}
	
	public function choose_completedContests(){
		$cat_type = $_POST['category'];
		$indus_type = $_POST['industry'];
		$data['indus_id']=$this->Contest_model->get_industry_id($indus_type);
		$indus = $data['indus_id'];
		if((!empty($indus))&&(!empty($cat_type))){
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1,'status'=>'completed','industry'=>$indus,'contest_type'=>$cat_type));
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,'status'=>'completed','industry'=>$indus,'contest_type'=>$cat_type));
		}
		else if((!empty($indus))&&(empty($cat_type))){	
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1,'status'=>'completed','industry'=>$indus));
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,'status'=>'completed','industry'=>$indus));
		}
		else if((empty($indus))&&(!empty($cat_type))){
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1,'status'=>'completed','contest_type'=>$cat_type));
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,'status'=>'completed','contest_type'=>$cat_type));
		}
		else {
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1,'status'=>'completed'));
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,'status'=>'completed'));
		}
		$this->load->view('front/ajax/ajax_completed_contest1',$data);
	}
	
	public function choose_judgingContests(){
		$cat_type = $_POST['category'];
		$indus_type = $_POST['industry'];
		$data['indus_id']=$this->Contest_model->get_industry_id($indus_type);
		$indus = $data['indus_id'];
		if((!empty($indus))&&(!empty($cat_type))){
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1,'status'=>'judging','industry'=>$indus,'contest_type'=>$cat_type));
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,'status'=>'judging','industry'=>$indus,'contest_type'=>$cat_type));
		}
		else if((!empty($indus))&&(empty($cat_type))){
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1,'status'=>'judging','industry'=>$indus));
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,'status'=>'judging','industry'=>$indus));
		}
		else if((empty($indus))&&(!empty($cat_type))){
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1,'status'=>'judging','contest_type'=>$cat_type));
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,'status'=>'judging','contest_type'=>$cat_type));
		}
		else {
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1,'status'=>'judging'));
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,'status'=>'judging'));
		}
		$this->load->view('front/ajax/ajax_judging_contest1',$data);
	}
	
	
	public function choose_expressContests(){
		$cat_type = $_POST['category'];
		$indus_type = $_POST['industry'];
		$data['indus_id']=$this->Contest_model->get_industry_id($indus_type);
		$indus = $data['indus_id'];
		
		if((!empty($indus))&&(!empty($cat_type))){
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1,"status!="=>"completed","status!="=>"judging", "status!="=>"draft",'industry'=>$indus,'contest_type'=>$cat_type, "TIMESTAMPDIFF(hour, now(),`close_date`)>="=>0,  "TIMESTAMPDIFF(hour, now(),`close_date`)<"=>48));
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,"status!="=>"completed","status!="=>"judging", "status!="=>"draft",'industry'=>$indus,'contest_type'=>$cat_type, "TIMESTAMPDIFF(hour, now(),`close_date`)>="=>0,  "TIMESTAMPDIFF(hour, now(),`close_date`)<"=>48));
		}
		else if((!empty($indus))&&(empty($cat_type))){
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1,"status!="=>"completed","status!="=>"judging", "status!="=>"draft",'industry'=>$indus, "TIMESTAMPDIFF(hour, now(),`close_date`)>="=>0,  "TIMESTAMPDIFF(hour, now(),`close_date`)<"=>48));
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,"status!="=>"completed","status!="=>"judging", "status!="=>"draft",'industry'=>$indus, "TIMESTAMPDIFF(hour, now(),`close_date`)>="=>0,  "TIMESTAMPDIFF(hour, now(),`close_date`)<"=>48));
		}
		else if((empty($indus))&&(!empty($cat_type))){
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1,"status!="=>"completed","status!="=>"judging", "status!="=>"draft",'contest_type'=>$cat_type, "TIMESTAMPDIFF(hour, now(),`close_date`)>="=>0,  "TIMESTAMPDIFF(hour, now(),`close_date`)<"=>48));
			
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,"status!="=>"completed","status!="=>"judging", "status!="=>"draft",'contest_type'=>$cat_type, "TIMESTAMPDIFF(hour, now(),`close_date`)>="=>0,  "TIMESTAMPDIFF(hour, now(),`close_date`)<"=>48));
		}
		else {
			$data['contest_list']=$this->Common_model->get_records('contest','',array('admin_status'=>1,"status!="=>"completed","status!="=>"judging", "status!="=>"draft", "TIMEDIFF(close_date,now())>"=>0,  "TIMEDIFF(close_date,now())<="=>48));
			$data['count_contests']=$this->Common_model->get_records_count('contest',array('admin_status'=>1,"status!="=>"completed","status!="=>"judging", "status!="=>"draft", "TIMEDIFF(close_date,now())>"=>0,  "TIMEDIFF(close_date,now())<="=>48));
		}
		
		$this->load->view('front/ajax/ajax_express_contest1',$data);
	}
	
	
	public function contest_comment(){
			$values['contest_id']=$contest_id = $this->input->post('contestid');	
			$values['comment']=$message = $this->input->post('msg_box');				
			$values['createdby']=$user_id = $this->session->userdata('user_id');	
			$values['createdname']=$this->session->userdata('user_name');
			$values['createdtype']=$this->session->userdata('user_type');
			$values['createddate']= $date = date("Y-m-d H:i:s");	
			
			/***** Comment File Upload *****/
			$config['upload_path']= 'uploads/brief';
			$config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|txt|doc';
		   
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			if (!empty($_FILES['comment_file']['name'])) {
				if($this->upload->do_upload('comment_file'))
				{
					$upload_data=array('upload_data'=>$this->upload->data());
					$file_name=$upload_data['upload_data']['file_name'];
				}
				else
				{	
					$error = array('error' => $this->upload->display_errors());
				}
			}
			/***** End Comment File Upload *****/
			
			$values['attachment']=(isset($file_name))?$file_name:'';
			$this->Common_model->insert_record('contest_comments',$values);					
			redirect('contest/contest_entries/'.$contest_id);	
	}
			
			
	public function contest_privcomment(){
		//print_r($_POST);
		$values['contest_id']=$contest_id = $this->input->post('contestid');	
		$values['client_id']=$client_id = $this->input->post('clientid');	
		$values['design_id']=$design_id = $this->input->post('designid');			
		$designerid = $this->input->post('designerid');
			
			
		$values['comment']=$message = $this->input->post('prvmsg_box');				
		$values['createdby']=$user_id = $this->session->userdata('user_id');	
		$values['createdname']= $this->session->userdata('user_name');
		$values['createdtype']= $usertype= $this->session->userdata('user_type');
		$values['createddate']=  $date = date("Y-m-d H:i:s");			
		if(isset($designerid) && !empty($designerid) && ($designerid == $user_id))
			$values['toview_id']= design_clientid($design_id);
		else
			$values['toview_id']= $designerid;
		$this->Common_model->insert_record('design_comments',$values);					
		$shiftpress = $this->input->post('shiftpress');	
		
		//mail
		if($usertype==0){
			$to    = get_email($designerid); 
			$subject = "Mail From Contest Hours:".username($client_id)." has commented on your design.";
			$message = username($client_id)." has commented on your design.<br>";
			$message .= "Contest Name :- ".contestname($contest_id).",<br> Contet Link :- ".base_url()."contest/contest_entries/".$contest_id.",<br> Design #:".contest_design_no($design_id);
			echo rp_send_email($to, $subject, $message);
		}
		else{
			$to    = get_email($client_id); 
			$subject = "Mail From Contest Hours:".username($designerid)." has commented on your design.";
			$message = username($designerid)." has replied for your comment.<br>";
			$message .= "Contest Name :- ".contestname($contest_id).",<br> Contet Link :- ".base_url()."contest/contest_entries/".$contest_id.",<br> Design #:".contest_design_no($design_id);
			rp_send_email($to, $subject, $message);
		}
		//mail
			
		if(isset($shiftpress) && !empty($shiftpress) && ($shiftpress == 1))
			redirect('admin/message_client');
		else if(isset($shiftpress) && !empty($shiftpress) && ($shiftpress == 2))
			redirect('admin/message_designer');			
		else
			redirect('contest/contest_entries/'.$contest_id);
	}

	public function design_rate(){	
		$designid = $this->input->post('designid');		
		$rateval = $this->input->post('rateval');
		$this->Common_model->update_record("designs",array("design_rating"=>$rateval,"rating_time"=>date("Y-m-d H:i:s")),array("design_id"=>$designid));	
	}
	
	
	public function design_rank(){
		$designid = $this->input->post('designid');		
		$rankval = $this->input->post('rankval');
		
		$this->Common_model->update_record("designs",array("design_rank"=>$rankval),array("design_id"=>$designid));	
	}
	
	public function design_like(){
		$value['design_id'] = $this->input->post('designid');		
		$value['user_id'] = $this->input->post('user_id');
		echo $likestatus=$this->Common_model->insert_record("design_likes",$value);	
	}

	public function final_contest(){
		$contest_id = $this->input->post('contestid');	
		$designer_id = $this->input->post('designer_id');	
		$designid = $this->input->post('designid');
		$this->Common_model->update_record("designs",array("final_status"=>1),array("design_id"=>$designid));
		$date=date("Y-m-d H:i:s");
		$close_date=date('Y-m-d H:i:s',strtotime("+3 day"));
		$check=$this->Common_model->get_records_count("designs",array("final_status"=>1,"contest_id"=>$contest_id));
		if($check>=2){
			$this->Common_model->update_record("contest",array("judging_start_date"=>$date,"judging_close_date"=>$close_date),array("id"=>$contest_id));
		}
		/*****Finalist Payment********/
		$runer_Prize = $this->Common_model->get_record('pricing_percentage','*');
		$finalist_price = $runer_Prize->runner_percentage;

		$reward['contest_id']=$contest_id;
		$reward['design_id']=$designid;
		$reward['designer_id']=$designer_id;
		$reward['reward_msg']= "Finalist in ".contestname($contest_id).": $ ".$finalist_price;
		$reward['reward_type']=0;
		$reward['reward_value']=$finalist_price;
		$rew_id=$this->Common_model->insert_record("rewards",$reward);
		
		$trans['reward_id']=$rew_id;
		$trans['designer_id']=$designer_id;
		$trans['trans_date']=$date;
		$trans['trans_value']=$finalist_price;
		$old_balance=designer_balance($designer_id);
		$new_balance= $finalist_price+ $old_balance;
		$trans['trans_old_balance']=$old_balance;
		$trans['trans_new_balance']=$new_balance;
		$res=$this->Common_model->insert_record("transaction",$trans);
		/**************/
		
		$email=$this->Common_model->get_record('designer_table','',array('users_id'=>$designer_id));
		$designer_email=$email->designer_email;
		
			//mail  for select finalist 
			$mvalues['contest_id']=$contest_id;
			$mvalues['designer_id']=$designer_id;
			$mvalues['design_id']=$designid;
			$to = $designer_email;   //finalist designer//
			$subject=contestname($contest_id)."- You Are Chosen As A Finalist";
			$message = $this->load->view("front/newsletter/finalist_message",$mvalues,true);
			rp_send_email($to, $subject, $message);
			//mail	
			
			$values['design_id']= $designid;
			$values['client_id']= $this->session->userdata('user_id');
			$values['contest_id']= $contest_id;
			$values['comment']="You Are Chosen As A Finalist.!";
			$values['createdby']=$user_id = $this->session->userdata('user_id');	
			$values['createdname']=$this->session->userdata('user_name');
			$values['createdtype']=$this->session->userdata('user_type');
			$values['createddate']= $date = date("Y-m-d H:i:s");
			$values['toview_id']= $designer_id;
			$this->Common_model->insert_record('design_comments',$values);

			redirect('contest/contest_entries/'.$contest_id);
	}
	
	public function winn_contest(){
		$contest_id = $this->input->post('contestid');	
		$designer_id = $this->input->post('designer_id');
		$designid = $this->input->post('designid');
		
		$email=$this->Common_model->get_record('designer_table','',array('users_id'=>$designer_id));
		$designer_email=$email->designer_email;
		$date= date("Y-m-d H:i:s");
		
		$this->Common_model->update_record("designs",array("design_status"=>1,"chosen_time"=> $date),array("design_id"=>$designid));
		$this->Common_model->update_record("contest",array("winner_select_time"=> $date,"status"=>'completed'),array("id"=>$contest_id));
		
		//mail  for winner 
		$mvalues['contest_id']=$contest_id;
		$mvalues['designer_id']=$designer_id;					
		$to   = $designer_email;   //winning  designer//
		$subject=contestname($contest_id)."- Your Are Chosen As The Winner";
		$message = $this->load->view("front/newsletter/winner_message",$mvalues,true);
		rp_send_email($to, $subject, $message);
		//mail	
		
		//mail for contest admin
		$to = admin_mail();
		$subject = 'Mail From Contest Hours: Winner Selected For- '.contestname($contest_id);
		$message = "<p>Winner was chosen for (".contestname($contest_id).")-By ".username(user_id())." at ".date("d M,Y h:i a")."</p>";
		$message .= "<p><a href='".base_url()."contest/contest_entries/".$contest_id."'>Click here to view Contest</a></p>";		
		rp_send_email($to, $subject, $message);
		//mail
		
		//notification
		$noti['noti_msg']= "Winner was chosen for (".contestname($contest_id).")-By ".username(user_id());
		$noti['noti_type']=3;//winner Chosen
		$noti['noti_ref_id']=$contest_id;
		$noti['noti_entry_time']=date("Y-m-d H:i:s");
		$this->Common_model->insert_record('notification',$noti);
		//notification
		
		
		$values['design_id']= $designid;
		$values['client_id']= $this->session->userdata('user_id');
		$values['contest_id']= $contest_id;
		$values['comment']="You Are Chosen As The Winner";			
		$values['createdby']=$user_id = $this->session->userdata('user_id');	
		$values['createdname']=$this->session->userdata('user_name');
		$values['createdtype']=$this->session->userdata('user_type');
		$values['createddate']= $date = date("Y-m-d H:i:s");
		$values['toview_id']= $designer_id;
		$this->Common_model->insert_record('design_comments',$values);
		
		redirect('contest/contest_entries/'.$contest_id);
	}

	public function withdraw_design(){
		$contest_id = $this->input->post('contestid');	
		$designid = $this->input->post('designid');	
		$this->Common_model->update_record("designs",array("display_status"=>1,"withdraw_time"=>date("Y-m-d H:i:s")),array("design_id"=>$designid));
		redirect('contest/particular_contest/'.$contest_id);
	}
	
	public function deletecontest($contestid ){		
		if(isset($contestid) && !empty ($contestid))
		{
			$this->Common_model->update_record("contest",array("delete_status"=>1),array("id"=>$contestid));
	
			redirect('admin/draft_client');
		}
	}
	
	public function contest_wincomment(){
		if($_POST)
		{
			$where['id']= $contest_id = $this->input->post('wincontestid');				
			$where2['design_id']= $windesignid = $this->input->post('windesignid');				
			$values['win_comments']=$message = $this->input->post('win_comments');						
			$this->Common_model->update_record('contest',$values,$where);					
			$this->Common_model->update_record('designs',$values,$where2);					
		}	
		redirect('contest/contest_entries/'.$contest_id);			
	}
	
	public function report_contest()
	{
			$contest['contest_id'] = $contest_id = $this->input->post('contestid');
			$client_id = $this->input->post('clientid');
			$contest['report_type'] = $this->input->post('report_type');				
			$contest['report_designer'] = $this->input->post('designerid');
			$contest['reporter_design'] = $this->input->post('userdesign');
			$contest['copy_design'] = $this->input->post('copydesign');
			$design_id = $this->input->post('designid');
			$contest['report_messsage'] = $this->input->post('msg');

			$cyid=$this->Common_model->get_record('designs','designer_id',array('design_no'=>$contest['copy_design'],'contest_id'=>$contest['contest_id']));	
			$contest['copy_designer']=$cyid->designer_id;
			
			
			$email=$this->Common_model->get_record('designer_table','',array('users_id'=>$contest['copy_designer']));
			$designer_email=$email->designer_email;
			
			$rcount=$this->Common_model->get_records_count('desiner_report',array('contest_id'=>$contest['contest_id'],'report_designer'=>$contest['report_designer'],'reporter_design'=>$contest['reporter_design'],'copy_design'=>$contest['copy_design'],'copy_designer'=>$contest['copy_designer'], 'createdtime'=>date("Y-m-d H:i:s")));
 
			if($rcount==0)
			{
				$rep=$this->Common_model->insert_record('desiner_report',$contest);
				if($rep){
					$rep_message="Your Design(#".$contest['copy_design'].") For ".contestname($contest_id)." reported  By ".username($contest['report_designer']);

					$values['contest_id']=$contest_id;	
					$values['client_id']=$client_id;	
					$values['design_id']=$design_id;
					$values['comment']=$rep_message;				
					$values['toview_id']=$contest['copy_designer'];				
					$values['createdby']=0;	
					$values['createdname']="Admin";
					$values['createdtype']=1;
					$values['createddate']= date("Y-m-d H:i:s");
					
					$rep_id= $this->Common_model->insert_record('design_comments',$values);
				
					$this->session->set_flashdata('type', 'success');
					$this->session->set_flashdata('msgs', 'Your report has been successfully submitted');
					
					//notification
					$noti['noti_msg']=username($contest['copy_designer'])."'s Design(#".$contest['copy_design'].") For ".contestname($contest_id)." reported  By ".username($contest['report_designer']);
					$noti['noti_type']=5;//Report Court
					$noti['noti_ref_id']=$rep;
					$noti['noti_entry_time']=date("Y-m-d H:i:s");
					$this->Common_model->insert_record('notification',$noti);
					//notification
				}
			}
			else
			{
				$this->session->set_flashdata('type', 'warning');
				$this->session->set_flashdata('msgs', 'Already we have a report for same design from your side.');
			}
			
			//mail
			$mvalues['contest_id']=$contest['contest_id'];			
			$mvalues['report_designer']=$contest['report_designer'];
			$mvalues['copy_design']=$contest['copy_design'];
			$mvalues['designer_id']=$contest['copy_designer'];
			
			$to      = $designer_email;   //designer mail//
			$subject = 'Mail From Contest Hours';
			$message = $this->load->view("front/newsletter/violation_message",$mvalues,true);
			rp_send_email($to, $subject, $message);		
			//mail	
			
			$referrer=  $this->agent->referrer();
			redirect($referrer);
	}
	
	public function design_verification()
	{
		$design_id = $this->input->post('design_id');		
		$designer_id = $this->input->post('designer_id');
		$contest_id = $this->input->post('contest_id');
		
		$vcount=$this->Common_model->get_records_count("designs",array('contest_id'=>$contest_id,'designer_id'=>$designer_id,'design_no'=>$design_id));
		echo $vcount;					 
	}


	public function designer_page_payment_details(){
		$designer_id = $this->input->post('desner_id');		
		$request_date = $this->input->post('request_date');
		$data = $this->Common_model->get_records('designer_debit','*',array('designer_id'=>$designer_id,'request_date'=>$request_date));
		if($data[0]->transaction_id !="")
		{
			echo "<p>Payment Release Time :".$data[0]->release_time."</p><p>Transaction ID  :".$data[0]->transaction_id."</p>"; 
		}
		else{
			echo "<p>Release Time : processing....</p><p>Transaction ID:  processing....</p>";
		}
		
	}
	public function referral_page_payment_details(){
		$ref_id = $this->input->post('ref_id');		
		$request_date = $this->input->post('request_date');
		$data = $this->Common_model->get_records('referral_debit','*',array('ref_id'=>$designer_id,'request_date'=>$request_date));
		if($data[0]->transaction_id !="")
		{
			echo "<p>Payment Release Time :".$data[0]->release_time."</p><p>Transaction ID  :".$data[0]->transaction_id."</p>"; 
		}
		else{
			echo "<p>Release Time : processing....</p><p>Transaction ID:  processing....</p>";
		}
		
	}
	public function saveTestimony(){
		$data['contest_id']=$where['contest_id']= $this->input->post('contest_id');		
		$data['message'] = $this->input->post('testimony_msg');
		$data['client_id']=user_id();
		$data['createdTime']=date("Y-m-d H:i:s");
		
		$res = $this->Common_model->get_records('testimony','*',$where);
		if(empty($res)){
			$this->Common_model->insert_record('testimony',$data);
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('msgs', 'Thanks for your review.!');
		}
		else{
			$this->Common_model->update_record('testimony',$data,$where);
		}
		
		$referrer=  $this->agent->referrer();
		redirect($referrer);			
	}
	
	public function request_release_payment_cron(){
		//$in=$this->Common_model->insert_record("cron_test",array("cron_date"=>date("Y-m-d H:i:s")));
		
		$check=$this->Common_model->get_records('contest','*',array('package_status' =>3, 'IFNULL( DATEDIFF(date(now()), payment_release_reqtime), 0)>='=>1,'contest_paid_status'=> 0));
		
		if(!empty($check)){
			// echo "<pre>";
			// print_r($check);
			// echo "</pre>";
			foreach($check as $tmp){
				$contest_id=$tmp->id;
				$date=date("Y-m-d H:i:s");
				
				/******** Winner Payment ********/
				$winner_res= $this->Common_model->get_record('designs','design_id, designer_id',array('design_status'=>1,'contest_id'=>$contest_id));
				$design_id=$winner_res->design_id;
				$designer_id=$winner_id=$winner_res->designer_id;
				
				$amount= $this->Common_model->get_record('contest','contest_prize',array('id'=>$contest_id));
				$contest_prize= $amount->contest_prize;
				
				$pg= $this->Common_model->get_record('pricing_percentage','',array('status'=>1));
				$winner_percentage= $pg->winner_percentage;
				$winner_price= round($contest_prize * ($winner_percentage/100));

				$reward['contest_id']=$contest_id;
				$reward['design_id']=$design_id;
				$reward['designer_id']=$designer_id;
				$reward['reward_msg']=contestname($contest_id)." - contest price: $ ".$winner_price;
				$reward['reward_type']=1;
				$reward['reward_value']=$winner_price;
				$rew_id=$this->Common_model->insert_record("rewards",$reward);
				
				$trans['reward_id']=$rew_id;		
				$trans['designer_id']=$designer_id;
				$trans['trans_date']=$date;
				$trans['trans_value']=$winner_price;
				$old_balance=designer_balance($designer_id);
				$new_balance= $winner_price+ $old_balance;
				$trans['trans_old_balance']=$old_balance;
				$trans['trans_new_balance']=$new_balance;
				$rew=$this->Common_model->insert_record("transaction",$trans);
				/**************/
				
				$winner_email=designer_email($winner_id);
				
				//mail
				$m_values['contest_id']=$contest_id;
				$m_values['designer_id']=$winner_id;
				$to    = $winner_email;   //designer mail//
				$subject = 'Mail From Contest Hours: Your Price Amount Creadited For '.contestname($contest_id);
				$message = $this->load->view('front/newsletter/package_confirmed',$m_values,true);
				rp_send_email($to, $subject, $message);		
				//mail	
				
				//mail for contest admin
				$contest_id=$contest_id;
				$to = admin_mail();
				$subject = 'Mail From Contest Hours: Winner Selected For- '.contestname($contest_id);
				$message = "<p>Client confirmed the pacakage of (".contestname($contest_id).")-By ".username(user_id())." at ".date("d M,Y h:i a")."</p>";
				$message .= "<p><a href='".base_url()."contest/contest_entries/".$contest_id."'>Click here to view Contest</a></p>";		
				rp_send_email($to, $subject, $message);
				//mail
				
				//notification
				$noti['noti_msg']= "Client confirmed the pacakage of (".contestname($contest_id).")-By ".username(user_id())." at ".date("d M,Y h:i a");
				$noti['noti_type']=4;//New designer payment request
				$noti['noti_ref_id']=$contest_id;
				$noti['noti_entry_time']=$date;
				$this->Common_model->insert_record('notification',$noti);
				//notification

				$query = $this->Common_model->update_record("contest",array("contest_paid_status"=>1),array("id"=>$contest_id,"contest_paid_status"=>0));
			}
		}
	}
	
    public function contest_wmark($org_img)
    {
        $wimage= explode(".",$org_img);
		$new_image_name=randomName().".".$wimage[1];
		
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['wm_type'] = 'overlay';
		$config['source_image'] = 'uploads/designer_designs/'.$org_img;
		$config['wm_overlay_path'] = 'mail_images/wmark.png';		
		$config['new_image'] = 'uploads/designer_designs/'.$new_image_name;
        //the overlay image
        $config['wm_opacity'] = 100;
        $config['wm_vrt_alignment'] = 'top';
        $config['wm_hor_alignment'] = 'left';
        $this->image_lib->initialize($config);
        if (!$this->image_lib->watermark()) {
            echo $this->image_lib->display_errors();
        } else {
            return $new_image_name;
        }
    }
	
	 public function text()
    {
        $this->load->library('image_lib');
		$config['source_image'] = 'mail_images/test.jpg';
		$config['new_image'] = 'mail_images/finaltxt.jpg';
        //The image path,which you would like to watermarking
        $config['wm_text'] = 'contesthours';
        $config['wm_type'] = 'text';
        $config['wm_font_path'] = './assets/css/twncemd1.ttf';
        $config['wm_font_size'] = 12;
        $config['wm_font_color'] = '333333';
        $config['wm_vrt_alignment'] = 'top';
        $config['wm_hor_alignment'] = 'left';
        $config['wm_padding'] = '10';
        $this->image_lib->initialize($config);
        if (!$this->image_lib->watermark()) {
            echo $this->image_lib->display_errors();
        } else {
            echo 'Successfully updated image with water
	mark';
        }
    }
	
    public function overlay()
    {
        $this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['wm_type'] = 'overlay';
		$config['source_image'] = 'mail_images/test.jpg';
		$config['wm_overlay_path'] = 'mail_images/wmark.png';		
		$config['new_image'] = 'mail_images/finalimg.jpg';
        //the overlay image
        $config['wm_opacity'] = 100;
        $config['wm_vrt_alignment'] = 'top';
        $config['wm_hor_alignment'] = 'left';
        $this->image_lib->initialize($config);
        if (!$this->image_lib->watermark()) {
            echo $this->image_lib->display_errors();
        } else {
            echo 'Successfully updated image with watermark';
        }
    }
      public function check_referral_code(){
    	$userid = $this->session->userdata('user_id');
    	$referral_code = $this->input->post('referral_code');
    	$no_user = $this->Contest_model->verify_referral_code($referral_code,$userid);
    	//$alredy_user = $this->Contest_model->already_used_code($referral_code,$userid);
    	$user_referral = $this->Contest_model->user_referral_code($referral_code,$userid);
    	//$allow_referral = $this->Contest_model->allow_referral_code($referral_code,$userid);
    	//$allow_user = $this->Contest_model->allow_user_code();
    	if($no_user==""){
    			echo "No referral code then leave it blank";
    		/*} elseif($alredy_user!=""){
    			echo "Alredy Use This Referral Code";*/
    		} elseif($user_referral!=""){
    			echo "Could Not Use Your Referral Code";
    		} 
    		/*elseif($allow_referral >= $allow_user || $allow_referral == $allow_user){
    			echo "Only Allow The 5 Time Use This Referral Code";
    		}*/
    }
public function download_agreement($id){
			
			$this->load->library('TCPDF');

			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);


			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			/*$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);*/

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('helvetica', 'B', 20);

			// add a page
			$pdf->AddPage();

			//$pdf->Write(0, "Contest Hours", '', 0, 'L', true, 0, false, false, 0);

			$pdf->SetFont('helvetica', '', 8);

			// -----------------------------------------------------------------------------
			
			
			$result = $this->db->query("SELECT UPPER(ct.name) as client_name, IF(c.contest_title is null, c.org_name, c.contest_title) as contest_name, c.id as contest_id, dt.designer_name, d.design_name, d.designer_id, d.design_id, dt.signature, dt.original_document FROM contest c, client_table ct, designs d, designer_table dt WHERE c.id = $id and c.client_id = ct.users_id and d.contest_id = c.id and d.design_status = 1 and d.designer_id = dt.users_id");
			
			$values = $result->row();
			
			
			$tbl = '<br><br><br>';
			$tbl .= '<span style="text-align:center;"><img src="'.base_url().'assets/images/contest-hours.jpg" height="50px"></span>';
			$tbl .= '<span style="text-align:center;"><h1>Logo Design Transfer of Copyright Form</h1></span>';
			
			$tbl .= '<table border="0" width="100%">';
			$tbl .= '<tr>';
				$tbl .= '<td width="50%">';
					$tbl .= '<table width="100%" cellpadding="5" cellspacing="5">';
						$tbl .= '<tr>';
							$tbl .= '<td style="font-size:13px;">Client Name: </td>';
							$tbl .= '<td style="font-size:11px;">'.$values->client_name.'</td>';
						$tbl .= '</tr>';
						$tbl .= '<tr>';
							$tbl .= '<td style="font-size:13px;">Contest Name: </td>';
							$tbl .= '<td style="font-size:11px;">'.$values->contest_name.'</td>';
						$tbl .= '</tr>';
						$tbl .= '<tr>';
							$tbl .= '<td style="font-size:13px;">Contest ID: </td>';
							$tbl .= '<td style="font-size:11px;">'.$values->contest_id.'</td>';
						$tbl .= '</tr>';
						$tbl .= '<tr>';
							$tbl .= '<td style="font-size:13px;">Designer Name: </td>';
							$tbl .= '<td style="font-size:11px;">'.$values->designer_name.'</td>';
						$tbl .= '</tr>';
						$tbl .= '<tr>';
							$tbl .= '<td style="font-size:13px;">Designer NickName: </td>';
							$tbl .= '<td></td>';
						$tbl .= '</tr>';
						$tbl .= '<tr>';
							$tbl .= '<td style="font-size:13px;">Designer ID: </td>';
							$tbl .= '<td style="font-size:11px;">'.$values->designer_id.'</td>';
						$tbl .= '</tr>';
						$tbl .= '<tr>';
							$tbl .= '<td style="font-size:13px;">Winning Design: </td>';
							$tbl .= '<td style="font-size:11px;">'.$values->design_id.'</td>';
						$tbl .= '</tr>';
					$tbl .= '</table>';
				$tbl .= '</td>';
				$tbl .= '<td align="center">';
					$tbl .= '<img src="'.base_url().'uploads/designer_designs/'.$values->design_name.'" width="200px">';
				$tbl .= '</td>';
			$tbl .= '</tr>';
			$tbl .= '</table>';
			
			
			
			$tbl .= '<p style="font-size:13px;">This FORM is a written agreement between the designer and the client in regard to the copyright transfer of the winning logo design selected by the client.</p>';
			
			$tbl .= '<p style="font-size:13px;">By signing :<br>
The Designer renounces all personal and professional rights of the selected wining design of the '.$values->contest_name.' (#'.$values->contest_id.') as listed . This includes the transfer of rights to any variations of the logo supplied in the Logo Package, such as one color, black & white, color variations,
dimensional varieties, etc. The logo package does not include the license for the fonts used.</p>';

			$tbl .= '<p style="font-size:13px;">The other non-wining designs entered in the contest remain copyrighted to the respective designers and shall not be used by the Client in any means unless purchased. The non-wining designer is free to use his designs in other contests.</p>';
			
			$tbl .= '<p style="font-size:13px;">The non-wining designs entered in the contest may be repurposed and reconditioned with sufficient variations so they do not reflect/resemble the logo design of this agreement.</p>';
			
			$tbl .= '<p style="font-size:13px;">The Wining designer and the designers who participated in the contest also retains the right to showcase the logo described above in online and offline personal portfolios as a demonstration of their work, skill and experience.</p>';

			$tbl .= '<p style="font-size:13px;">The Client: Has confirmed the Logo Package on Contesthours.com and accepts the design and all files as it is.</p>';
			
			$tbl .= '<p style="font-size:13px;">The Ownership of the selected winning design belongs to the client henceforth. They are free to reproduce, alter, and distribute the design at their own risk.</p>';

			$tbl .= '<p style="font-size:13px;">The trademark and the copyright registration of the logo is the sole responsibility of the client.</p>';
			
			$tbl .= '<p style=""></p>';
			
			$tbl .= '<table width="100%">';
				$tbl .= '<tr>';
					$tbl .= '<td width="45%" style="border:1px solid #000;height:60px;"><img src="'.base_url().'uploads/documents/'.$values->signature.'" height="60px" width="350px"></td>';
					$tbl .= '<td width="10%"></td>';
					$tbl .= '<td width="45%"  style="border:1px solid #000;"></td>';
				$tbl .= '</tr>';
				$tbl .= '<tr>';
					$tbl .= '<td width="45%"><h3>Designer Signature</h3></td>';
					$tbl .= '<td width="10%"></td>';
					$tbl .= '<td width="45%"><h3>Client Signature</h3></td>';
				$tbl .= '</tr>';
				$tbl .= '<tr>';
					$tbl .= '<td width="45%"></td>';
					$tbl .= '<td width="10%"></td>';
					$tbl .= '<td width="45%"><br><h3>Date: </h3></td>';
				$tbl .= '</tr>';
			$tbl .= '</table>';
			$tbl .= '';
			$tbl .= '';
			
			
			$pdf->writeHTML($tbl, true, false, false, false, '');

			// -----------------------------------------------------------------------------







			//Close and output PDF document
			$pdf->Output('t.pdf', 'I');
		
	}
}
?>