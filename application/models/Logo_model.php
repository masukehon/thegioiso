<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logo_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'logo';

	}	

}

/* End of file Logo_model.php */
/* Location: ./application/models/Logo_model.php */