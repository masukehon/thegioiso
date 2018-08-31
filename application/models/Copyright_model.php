<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Copyright_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'copyright';
	}

}

/* End of file Copyright_model.php */
/* Location: ./application/models/Copyright_model.php */