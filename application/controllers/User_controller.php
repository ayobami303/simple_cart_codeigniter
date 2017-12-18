<?php
/**
* user controller
*/
class User_controller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		
		if ($this->session->userdata('id') == null) {
			redirect('login');
		}
		
	}

	public function index($resp = false)
	{
		$resp = (empty($resp)) ? '' : $resp ;
		$data['resp'] = $resp;
		$user_id = $this->session->userdata('id');

		$data['cart_item']	= count($this->user_model->cart_item_model($user_id));
		$data['user_details']	= $this->user_model->user_details($user_id);
		$data['product_list'] = $this->user_model->all_product_model();
		$data['title'] = 'Home page';

		$this->load->view('templates/header',$data);
		$this->load->view('shop/index', $data);
		$this->load->view('templates/footer');
	}

	public function add_to_cart($product_id = false){
		
		$product_id = $product_id;
		$user_id = $this->session->userdata('id');

		$product = $this->user_model->single_product_model($product_id);
		if (!empty($product)) {
			$result = $this->user_model->cart_model($user_id, $product_id);
			if ($result) {
				$this->index('product add to cart');
			} else {
				$this->index('product previously add to cart');
			}
			
		} else {
				$this->index('product out of stock');
		}
		
	}
}
?>