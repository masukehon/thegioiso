<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'service';
	}

}

/* End of file Service_model.php */
/* Location: ./application/models/Service_model.php */