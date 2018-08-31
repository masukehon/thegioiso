<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'product';
		// $this->db->join('category_product', ' product.id_category_product = category_product.id');
	}

	public function getCategoryName($id)
	{
		$CI =& get_instance();
		$CI->load->model('category_product_model');
		$field = 'name';
		return $CI->category_product_model->get_info($id, $field)->name;
	}

	public function like_multi($like)
	{
		if($like) {
			$this->db->order_by('id', 'DESC');
			$this->db->like('name', $like['name']);
			$this->db->or_like('alias_name', $like['alias_name']);

			$query = $this->db->get($this->table);
			return $query->result();
		}
		return false;
	}

}

/* End of file Product_model.php */
/* Location: ./application/models/Product_model.php */