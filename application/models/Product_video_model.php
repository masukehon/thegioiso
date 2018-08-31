<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_video_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'product_video';
	}

}

/* End of file Product_video_model.php */
/* Location: ./application/models/Product_video_model.php */