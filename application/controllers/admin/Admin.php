<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['page'] = 'admin/pages/profile';
		$this->load->view('admin/master_layout', $data);
	}

	public function update()
	{
		$data['page'] = 'admin/pages/profile_update';
		$this->load->view('admin/master_layout', $data);
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/admin/Admin.php */