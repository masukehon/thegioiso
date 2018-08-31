<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Employee extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->load->model('admin_model');

		$this->load->model('role_model');

		$this->load->model('history_model');

		$this->load->model('update_history_detail_model');

		$this->load->library('form_validation');

		$this->load->helper('form');

	}



	public function index()

	{

		if ($this->input->post()) {

			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_unique_email');



			if ($this->form_validation->run()) {

				$hashRegister = randomHash();

				$email = $this->input->post('email', true);

				$employee = array(

					'email' => $email,

					'status' => 'Chưa xác nhận',

					'id_role' => 4,

					'hash_register' => $hashRegister

				);



				if ($this->admin_model->create($employee)) {

					

					$link = 'http://thegioiso.net.vn/verify/'.$hashRegister;

					$content = "Click vào đường dẫn để kích hoạt tài khoản!!!! ";

					$content .= "</br>".$link;

					$this->load->library('email');

					$config['protocol']    = 'smtp';

					$config['smtp_host']    = 'mail.thegioiso.net.vn';

					$config['smtp_port']    = '465';

					$config['smtp_timeout'] = '7';

					$config['smtp_user']    = 'admin@thegioiso.net.vn';

					$config['smtp_pass']    = 'thegioiso2017';

					$config['charset']    = 'utf-8';

					$config['newline']    = '\r\n';

					$config['crlf']    = '\r\n';

					$config['mailtype'] = 'html'; 

					$config['smtp_crypto'] = 'ssl'; 



					$this->email->initialize($config);





					$this->email->from('admin@thegioiso.net.vn', 'Admin');

					$this->email->to($email); 



					$this->email->subject('Kích hoạt tài khoản');

					$this->email->message($content);  

					if ($this->email->send()) {

						$this->session->set_flashdata('messageEmp', '<div class="alert alert-success">Thêm nhân viên mới thành công</div>');

					}

				}



			} else {

				$this->session->set_flashdata('messageEmp', '<div class="alert alert-danger">Thất bại vui lòng thử lại sau.</div>');

			}

		}





		$roles = $this->role_model->get_list();

		$list = $this->admin_model->get_list();

		$messageEmp = $this->session->flashdata('messageEmp');



		$data = array(

			'message' => $messageEmp,

			'list' => $list,

			'roles' => $roles,

			'page' => 'admin/pages/employee'

		);



		$this->load->view('admin/master_layout', $data);

	}



	public function check_unique_email($email)

	{

		$where = array('email' => $email);

		if ($this->admin_model->check_exists($where)) {

			$this->form_validation->set_message(__FUNCTION__, 'Email đã tồn tại! Vui lòng chọn email khác!');

			return false;

		}

		return true;

	}



	public function update()

	{

		$id = $this->uri->segment(3);

		$id = intval($id);

		$info = $this->admin_model->get_info($id);



		$roles = $this->role_model->get_list();



		if ($this->input->post()) {



			$this->form_validation->set_rules('id_role', 'Quyền hạn', 'required');

			if ($this->form_validation->run()) {

				$employee['id_role'] = $this->input->post('id_role');

				if ($this->admin_model->update($id, $employee)) {

					$this->session->set_flashdata('message', '<div class="alert alert-success">Cập nhật thành công</div>');

					redirect(admin_url('nhanvien'));

				} else {

					$this->session->set_flashdata('message', '<div class="alert alert-danger">Thất bại vui lòng thử lại sau.</div>');

				}

			}

		}



		$data = array(

			'roles' => $roles,

			'page' => 'admin/pages/employee_update',

			'info' => $info

		);

		$this->load->view('admin/master_layout', $data);

	}



	public function delete()

	{

		$id = $this->uri->segment(3);

		$id = intval($id);



		echo $id;

		

		if ($this->admin_model->delete($id)) {

			$this->session->set_flashdata('messageEmp', '<div class="alert alert-success">Xóa nhân viên mới thành công</div>');

		} else {

			$this->session->set_flashdata('message', '<div class="alert alert-danger">Thất bại vui lòng thử lại sau.</div>');

		}



		redirect(admin_url('nhanvien'));

	}



	public function control_employee()

	{

		$input['where'] = array('id_role >' => 0);

		$admin = $this->admin_model->get_list($input);

		$histroy = $this->history_model->get_list();



		$data = array(

			'admin' => $admin,

			'history' => $histroy,

			'page' => 'admin/pages/control_employee'

		);



		$this->load->view('admin/master_layout', $data);

	}



	public function history_update()

	{

		$id = $this->uri->segment(4);

		$id = intval($id);



		$info = $this->update_history_detail_model->get_info($id);



		$data = array(

			'info' => $info,

			'page' => 'admin/pages/update_history_detail'

		);



		$this->load->view('admin/master_layout', $data);

	}

}



/* End of file Employee.php */

/* Location: ./application/controllers/admin/Employee.php */