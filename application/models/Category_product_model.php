<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_product_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'category_product';
	}

}

/* End of file Category_product_model.php */
/* Location: ./application/models/Category_product_model.php */