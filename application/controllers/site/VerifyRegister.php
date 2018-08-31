<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VerifyRegister extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('verify_register');
	}

	public function index()
	{
		$this->load->library('form_validation');
		$hash = $this->uri->segment(2);
		$input['where'] = array('hash_register' => $hash);
		if($this->verify_register->get_total($input) <= 0)
		{
			show_error('The link not exist !!!!');
		}
		else
		{
			if ($this->input->post()) {
				$this->form_validation->set_rules('passwordR', 'password', 'required|min_length[5]');
				$this->form_validation->set_rules('prepassword', 'prepassword', 'required|matches[passwordR]');
				if ($this->form_validation->run()) {
					$password = $this->input->post('passwordR', true);
					$data = array(
						'password' => md5($password),
						'hash_register' => ""
					);

					$this->db->where('hash_register', $hash);
					if ($this->db->update('admin', $data)) {
						redirect('admin/login');
					}
					
				}
			}
		}
		$data['page'] = 'site/pages/verify_register';
		$this->load->view('site/pre_layout', $data);
	}

	

}

/* End of file VerifyRegister.php */
/* Location: ./application/controllers/admin/VerifyRegister.php */