<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'about';
	}

}

/* End of file About_model.php */
/* Location: ./application/models/About_model.php */