<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
	}
	
	public function index()
	{
		
	}

	

}

/* End of file product.php */
/* Location: ./application/controllers/api/product.php */