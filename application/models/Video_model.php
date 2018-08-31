<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'video';
	}

}

/* End of file Video_model.php */
/* Location: ./application/models/Video_model.php */