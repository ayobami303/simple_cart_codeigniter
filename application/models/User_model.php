<?php 
/**
*control users activities
*
*/
class User_model extends CI_Model										
{
	
	function __construct()
	{
		$this->load->database();
		
	}

	function all_product_model(){
		
		$query = $this->db->select('*')
                ->get('products');

        return $query->result();
	}

	public function user_details($user_id)
	{
		
		$query = $this->db->select('*')
				->where('user_id = '.$user_id)
                ->get('user_details');

        return $query->row();
	}

	function single_product_model($id = false){
		// $data = array('id' => $id, 'qty' => 0);
		
		$query = $this->db->select('*')
				->where('id = '.$id.' AND qty != 0')
                ->get('products');

        return $query->row();
	}

	function cart_model($user_id, $product_id){
		$data = array('user_id' => $user_id, 'product_id' => $product_id);
		
		$query = $this->db->select('id')
				->where($data)
                ->get('cart');

        if (empty($query->row())) {		
         	$data = array(
			'user_id' =>$user_id,
			'product_id' => $product_id);

         	if ($this->db->insert('cart',$data)) {
				return true;
         	} else {
         		return false;
         	}
         	
         } else {
         	return false;
         }
         
	}

	public function cart_item_model($user_id)
	{
		$data = array('user_id' => $user_id);

		$query = $this->db->select('id')
				->where($data)
                ->get('cart');
        return $query->result();
	}


	
}
 ?>