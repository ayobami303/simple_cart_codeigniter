<?php 
/**
* Authenticate users 
*manages user sign up sign in 
*login and logout
*/
class Authentication_model extends CI_Model										
{
	
	function __construct()
	{
		$this->load->database();
		
	}

	public function get_user_id($email)
	{
		$data = array('email' => $email);
		$query = $this->db->select('id')
		->where($data)
		->get('user');
		return $query->row();
	}

	function register_model(){
		$pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		
		$data = array('email' => $this->input->post('email'));
		$query = $this->db->select(array('id'))
                ->where($data)
                ->get('user');

        if (empty($query->result_array())) {
        	$data = array(
			'email' => $this->input->post('email'),
			'password' => $pass);
        	$result = $this->db->insert('user',$data);
			if($result){

				$user_id = $this->get_user_id($this->input->post('email'));
				$data = array('user_id' => $user_id->id, 'full_name' => $this->input->post('name'), 
								'phone' => $this->input->post('phone'));
				if($this->db->insert('user_details',$data)){
					return 'Account created successfully. pls check your mail for verification';
				}else{
					return 'Error occured while processing';
				}
			}
        }else{
        	return 'User already existed with specified email';
        }

	}

	public function activate_model($user_id)
	{
		$data = array('activated' => 1);
		$result = $this->db->update('user', $data, 'id = '.$user_id);
		if($result){
			return true;
		}else{
			return false;
		}

		
	}


	function login_model(){
		$pass = $this->input->post('password');

		$data = array('email' => $this->input->post('email'), 'activated' => 1);

		$query = $this->db->select(array('id','email', 'password' ))
                ->where($data)
                ->get('user');
        $result = $query->row();
         
         if (!empty($result)) {
         	if (password_verify($pass, $result->password)) {
	        	return $query->row();
	        }else{
	        	
	        	return false;
	        }
         } else {
         	return false;
         }
         
        
		
        
	}

	
}
 ?>