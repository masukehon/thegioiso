<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'history';
	}

}

/* End of file History_model.php */
/* Location: ./application/models/History_model.php */