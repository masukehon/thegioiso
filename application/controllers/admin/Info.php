<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('about_model');
		$this->load->model('copyright_model');
		$this->load->model('service_model');
		$this->load->library('lib_upload');
		$this->load->model('logo_model');
		

	}

	public function about()
	{
		$this->load->library("form_validation");
		$this->load->helper("form");

		$info = $this->about_model->get_info(1);

		if ($this->input->post()) {
			$this->form_validation->set_rules("about","Nội dung giới thiệu","required|min_length[15]");

			if ($this->form_validation->run()) {
				$content = $this->input->post("about",true);

				$about = array(
					"content" => $content
				);

				if ($this->about_model->update(1,$about)) {
					$this->session->set_flashdata("about_message","<div class='alert alert-success'>Cập nhật thành công</div>");
					redirect(admin_url("gioithieu"));
				}
				else
				{
					$this->session->set_flashdata("about_message","<div class='alert alert-danger'>Thất bại vui lòng thử lại sau!</div>");
				}
			}
		} 

		$data['message'] = $this->session->flashdata("about_message");
		$data['info'] = $info;
		$data['page'] = 'admin/pages/about';
		$this->load->view('admin/master_layout', $data);
	}

	public function copyright()
	{
		$this->load->library("form_validation");
		$this->load->helper("form");

		$info = $this->copyright_model->get_info(1);

		if ($this->input->post()) {

			$this->form_validation->set_rules("address","Địa chỉ","required|min_length[2]");
			$this->form_validation->set_rules("phone","Số điện thoại","required|min_length[2]");
			$this->form_validation->set_rules("fax","Fax","required|min_length[2]");
			$this->form_validation->set_rules("email","Email","required|min_length[2]|valid_email");

			


			if ($this->form_validation->run()) {
				$address = $this->input->post("address",true);
				$phone = $this->input->post("phone",true);
				$hotline = $this->input->post("hotline",true) ? $this->input->post("hotline",true) : '';
				$fax = $this->input->post("fax",true);
				$email = $this->input->post("email",true);
				$youtube = $this->input->post("youtube",true) ? $this->input->post("youtube",true) : '';
				$facebook = $this->input->post("facebook",true) ? $this->input->post("facebook",true) : '';
				$instagram = $this->input->post("instagram",true) ? $this->input->post("instagram",true) : '';

				if (!empty($_FILES['logo']['name'])) {

				$folder = 'image';

				//dữ liệu của hình upload lên 'image' ten input tren form

				$image_upload = $this->lib_upload->upload($folder, 'logo');

				$image = '';
				if ($image_upload) {

					$image = $image_upload['file_name'];

				}
				
				$data = array('name' => $image);
				$id = 1;
				$this->logo_model->update($id, $data);
			}

				$copyright = array(
					"address" => $address,
					"phone" => $phone,
					"fax" => $fax,
					"hotline" => $hotline,
					"email" => $email,
					"youtube" => $youtube,
					"facebook" => $facebook,
					"instagram" => $instagram
				);

				if ($this->copyright_model->update(1,$copyright)) {
					$this->session->set_flashdata("copyright_message","<div class='alert alert-success'>Cập nhật thành công</div>");
					redirect(admin_url("copyright"));
				}
				else
				{
					$this->session->set_flashdata("copyright_message","<div class='alert alert-danger'>Thất bại vui lòng thử lại sau!</div>");
				}
			}
		} 
		$data['image'] = $this->logo_model->get_row();
		$data['message'] = $this->session->flashdata("copyright_message");
		$data['info'] = $info;
		$data['page'] = 'admin/pages/copyright';
		$this->load->view('admin/master_layout', $data);
	}

	public function service()
	{
		$this->load->library("form_validation");
		$this->load->helper("form");

		$info = $this->service_model->get_info(1);

		if ($this->input->post()) {
			$this->form_validation->set_rules("service","Nội dung dịch vụ","required|min_length[15]");

			if ($this->form_validation->run()) {
				$content = $this->input->post("service",true);

				$service = array(
					"content" => $content
				);

				if ($this->service_model->update(1,$service)) {
					$this->session->set_flashdata("service_message","<div class='alert alert-success'>Cập nhật thành công</div>");
					redirect(admin_url("dichvu"));
				}
				else
				{
					$this->session->set_flashdata("service_message","<div class='alert alert-danger'>Thất bại vui lòng thử lại sau!</div>");
				}
			}
		} 

		$data['message'] = $this->session->flashdata("service_message");
		$data['info'] = $info;
		$data['page'] = 'admin/pages/service';
		$this->load->view('admin/master_layout', $data);
	}

	

}

/* End of file Info.php */
/* Location: ./application/controllers/admin/Info.php */