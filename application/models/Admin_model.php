<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'admin';
	}

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */