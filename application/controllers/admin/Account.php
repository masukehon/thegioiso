<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('history_model');
	}

	public function login()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		if ($this->input->post()) {
			$this->form_validation->set_rules('login', 'login', 'callback_check_login');
			
			if ($this->form_validation->run()) {
				
				redirect('admin/home');	
			}
		}


		$data['page'] = 'admin/pages/login';
		$this->load->view('admin/pre_layout', $data);
	}

	public function check_login()
	{
		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);

		$where = array('email' => $email, 'password' => md5($password));

		if ($this->admin_model->check_exists($where)) {
			$info = $this->admin_model->get_info_rule($where);
			if ($info) {
				//random hash
				$hashLogin = randomHash();
				$admin = array(
					'hash_login' => $hashLogin
				);
				$this->admin_model->update($info->id, $admin);

				$array = array(
					'login' => 'true',
					'id' => $info->id,
					'name' => $info->fullname,
					'id_role' => $info->id_role,
					'hash_login' => $hashLogin
				);

				$this->session->set_userdata( $array );

				$history = array(
					'id_admin' => $info->id,
					'action' => 'Login',
					'destination' => 'Hệ thống'
				);

				$this->history_model->create($history);

				return true;
			}
		} else {
			$this->form_validation->set_message(__FUNCTION__, 'Email hoặc mật khẩu không chính xác!');
			return false;
		}
	}

	public function logout()
	{

		if ($this->session->userdata('login')) {
			$history = array(
				'id_admin' => intval($this->session->userdata('id')),
				'action' => 'Logout',
				'destination' => 'Hệ thống'
			);

			$this->history_model->create($history);

			$this->session->sess_destroy();
			redirect(admin_url('login'));
		}
	}

	
}

/* End of file Account.php */
/* Location: ./application/controllers/admin/Account.php */