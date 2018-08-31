<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_history_detail_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'update_history_detail';
	}

}

/* End of file Update_history_detail.php */
/* Location: ./application/models/Update_history_detail.php */