<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'role';
	}

}

/* End of file Role_model.php */
/* Location: ./application/models/Role_model.php */