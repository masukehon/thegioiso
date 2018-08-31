<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'image';
	}

}

/* End of file Image_model.php */
/* Location: ./application/models/Image_model.php */