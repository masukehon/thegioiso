<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$this->load->model("Role_model");

		$id = $this->session->userdata("id");
		$info = $this->admin_model->get_info($id);

		$roleName = $this->Role_model->get_info($info->id_role)->role;
		$info->roleName = $roleName;

		$data["message"] = $this->session->flashdata('update_profile') ? $this->session->flashdata('update_profile') : $this->session->flashdata('change_password');
		$data['info'] = $info;
		$data['page'] = 'admin/pages/profile';
		$this->load->view('admin/master_layout', $data);
	}

	public function update()
	{
		$this->load->library("form_validation");
		$this->load->helper("form");

		$id = $this->session->userdata("id");
		$info = $this->admin_model->get_info($id);

		if ($this->input->post()) {
			$this->form_validation->set_rules("name", "Họ tên", "required|min_length[2]");
			$this->form_validation->set_rules("phone", "Số điện thoại", "required|min_length[3]|max_length[13]|numeric");

			if ($this->form_validation->run()) {
				$fullName = $this->input->post("name",true);
				$phone = $this->input->post("phone",true);

				$profile = array(
					"fullname" => $fullName,
					"phone" => $phone
				);

				if ($this->admin_model->update($id,$profile)) {
					$this->session->set_flashdata("update_profile","<div class='alert alert-success'>Cập nhật thông tin thành công</div>");
					redirect(admin_url("thongtin"));
				}
				else
				{
					$this->session->set_flashdata("update_profile","<div class='alert alert-danger'>Thất bại vui lòng thử lại sau!</div>");
				}
			}
		}

		$data["info"] = $info;
		$data["message"] = $this->session->flashdata("update_profile");
		$data['page'] = 'admin/pages/profile_update';
		$this->load->view('admin/master_layout', $data);
	}

	public function change_password()
	{
		$this->load->library("form_validation");
		$this->load->helper("form");

		$id = $this->session->userdata("id");
		$info = $this->admin_model->get_info($id);

		if ($this->input->post()) {
			$this->form_validation->set_rules("oldpass", "Mật khẩu hiện tại", "trim|required|min_length[2]");
			$this->form_validation->set_rules("newpass", "Mật khẩu mới", "trim|required|min_length[2]|matches[renewpass]");
			$this->form_validation->set_rules("renewpass", "Nhập lại mật khẩu mới", "trim|required|min_length[2]");

			if ($this->form_validation->run()) {
				$oldPassword = $this->input->post("oldpass",true);
				$newPassword = $this->input->post("newpass",true);

				if (md5($oldPassword) != $info->password) {
					$this->session->set_flashdata("change_password","<div class='alert alert-danger'>Mật khẩu hiện tại không đúng</div>");
					redirect(admin_url("doimatkhau"));
				}

				$pass = array(
					"password" => md5($newPassword)
				);

				if ($this->admin_model->update($id,$pass)) {
					$this->session->set_flashdata("change_password","<div class='alert alert-success'>Cập nhật mật khẩu thành công</div>");
					redirect(admin_url("thongtin"));
				}
				else
				{
					$this->session->set_flashdata("change_password","<div class='alert alert-danger'>Thất bại vui lòng thử lại sau!</div>");
				}
			}
		}

		$data["message"] = $this->session->flashdata("change_password");
		$data['page'] = 'admin/pages/change_password';
		$this->load->view('admin/master_layout', $data);
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/admin/Profile.php */