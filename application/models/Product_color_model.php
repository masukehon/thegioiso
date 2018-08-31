<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_color_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'product_color';
	}

}

/* End of file Product_color_model.php */
/* Location: ./application/models/Product_color_model.php */