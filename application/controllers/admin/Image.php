<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('image');
	}

	public function index()
	{
		
	}

}

/* End of file Image.php */
/* Location: ./application/controllers/admin/Image.php */