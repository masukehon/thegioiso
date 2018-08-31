<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'brand';
	}

}

/* End of file Brand_model.php */
/* Location: ./application/models/Brand_model.php */