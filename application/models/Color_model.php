<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Color_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'color';
	}

}

/* End of file Color_model.php */
/* Location: ./application/models/Color_model.php */