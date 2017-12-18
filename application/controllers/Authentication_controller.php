<?php 
/**
* 
*/
class Authentication_controller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('authentication_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
	}

	public function register($resp = false)
	{
		$resp = (empty($resp)) ? '' : $resp ;
		$data['resp'] = $resp;
		$data['title'] = 'Registration page';

		$this->load->view('templates/header', $data);
		$this->load->view('shop/register', $data);
		$this->load->view('templates/footer');
		
	}

	public function register_process()
	{
		$full_name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$password = $this->input->post('password');
		$password_confirm = $this->input->post('password_confirm');

		if ($password != $password_confirm) {
			$this->register('Password does not match');
		}elseif ($full_name == '') {
			$this->register('Full name connot be empty');
		}elseif ($password == '') {
			$this->register('password connot be empty');
		}else {
			$result = $this->authentication_model->register_model();

			if (isset($result) || !empty($result)) {
				$user_id = $this->authentication_model->get_user_id($email);
				$this->email->clear();
				
				$config['charset'] = 'utf-8';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				
				$this->email->initialize($config);
			
				$this->email->from('no-reply@snapsnap.com', 'snap');
				
				$this->email->to($email);	
				$this->email->subject("account activation");
				$this->email->message('your account has been created. pls click this link to activate. '.site_url().'/activate/'.$user_id->id);
				$this->email->send();	

				$this->register($result);
			}
		}
		
	}

	public function activate($user_id)
	{
		$result = $this->authentication_model->activate_model($user_id);

		if ($result) {
			$data['resp'] = 'Account activatedd successfully';
			$this->load->view('shop/activation', $data);
		} else {
			$data['resp'] = 'Error occured while activating ';
			$this->load->view('shop/activation', $data);				
		}
		
	}

	function login($resp = false){


		if ($this->session->userdata('id') != null) {
			redirect(site_url());
		}

		$resp = (empty($resp)) ? '' : $resp ;
		$data['resp'] = $resp;
		$data['title'] = 'login page';

		$this->load->view('templates/header',$data);
		$this->load->view('shop/login', $data);
		$this->load->view('templates/footer');
					
	}

	function login_process(){

		if ($this->session->userdata('id') != null) {
			redirect(site_url());
		}

		$email = $this->input->post('email');
		$password = $this->input->post('password');

		if ($email == '') {
			$this->login('email must be specified');
		} elseif ($password == '') {
			$this->login('password must be specified');
		} else{
			$result = $this->authentication_model->login_model();

			if (!empty($result)) {

				$this->session->set_userdata('email',$this->input->post('email'));
				$this->session->set_userdata('id',$result->id);
				redirect(site_url());

			} else {
				$this->login('Username or password incorrect');
			}
			
		}
		
	}

	public function logout()
	{
		if ($this->session->has_userdata('id')) {	
			$id = $this->session->userdata('id');
					
			$_SESSION = array();
			session_destroy();

			redirect(site_url());
		}else{
			echo "test";
		}
	}
}
 ?>