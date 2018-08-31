<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends MY_Controller {
    public function __construct(){
		parent::__construct();
		
		$this->load->model("slider_video_model");
		$this->load->model("history_model");
		$this->load->model("history_video_model");
		
		$this->load->library("form_validation");
		
		$checkRole = $this->checkRole(array(1));
		if(!$checkRole)
		redirect(admin_url("Home"));
    }

	public function index()
	{
		$listVideo = $this->slider_video_model->get_list();

		foreach($listVideo as $video)
		{
		   $video->totalView = $this->history_video_model->filterResult($video->video,0);
		}

		$message = $this->session->flashdata('create_mess') ? $this->session->flashdata('create_mess') : ($this->session->flashdata('update_mess') ? $this->session->flashdata('update_mess'):$this->session->flashdata('delete_mess'));

		$checkRole = $this->checkRole(array(1));

		$data['message'] = $message;
		$data['checkRole'] = $checkRole;
		$data['listVideo'] = $listVideo;
		$data['page'] = 'admin/pages/slider';
		$this->load->view('admin/master_layout', $data);
	}

	public function create()
	{
		if ($this->input->post())
		{
			$this->form_validation->set_rules("title","Tiêu đề","required|min_length[2]");
			$this->form_validation->set_rules("video","Đường dẫn video","required|min_length[2]|max_length[200]");

			if ($this->form_validation->run())
			{
				$name = $this->input->post("title",true);
				$video = $this->input->post("video",true);
				$show = $this->input->post("is_show",true) ? $this->input->post("is_show",true) : 0;
				
				$slider = array(
					'name' => $name,
					'video' => $video,
					'is_show' => $show
				);

				if ($id = $this->slider_video_model->create($slider)) {

					$detail = array(
						'id' => $id,
						'name' => $slider['name'],
						'video' => $slider['video'],
						'is_show' => $show
					);

					$showDetail = '';
					if($detail['is_show'])
					$showDetail = '<p> Hiển thị: <b>Cho phép</b></p>';
					else
					$showDetail = '<p> Hiển thị: <b>Không cho phép</b></p>';

					$detailStr = '<p>Tiêu đề: <b>'.$detail['name'].'</b></p>
					<p>Mã video: <b>'.$detail['video'].'</b></p>'.$showDetail;

					$history = array(
						'id_admin' => intval($this->session->userdata('id')),
						'action' => 'Thêm',
						'destination' => 'Video Slider',
						'detail' => $detailStr
					);
					$this->history_model->create($history);

					$this->session->set_flashdata("create_mess","<div class='alert alert-success'>Thêm slider mới thành công</div>");

					redirect(admin_url("slider"));
				}
				else {
					$this->session->set_flashdata("create_mess","<div class='alert alert-danger'>Thất bại vui lòng thử lại sau!</div>");
				}

			}
			

		}

		$data['message'] = $this->session->flashdata("create_mess");
		$data['page'] = 'admin/pages/slider_create';
		$this->load->view('admin/master_layout', $data);
	}

	public function update()
	{
		$id = intval($this->uri->segment(4));
		//Video slider cũ
		$oldSlider = $this->slider_video_model->get_info($id);

		//Nếu k tồn tại đối tượng này
		if (!$oldSlider) {
			redirect(admin_url("slider"));
		}

		if ($this->input->post())
		{
			$this->form_validation->set_rules("title","Tiêu đề","required|min_length[2]");
			$this->form_validation->set_rules("video","Đường dẫn video","required|min_length[2]|max_length[200]");

			if ($this->form_validation->run())
			{
				$name = $this->input->post("title",true);
				$video = $this->input->post("video",true);
				$show = $this->input->post("is_show",true) ? $this->input->post("is_show",true) : 0;
				//hiển thị $show = on (string)
				//không hiển thị $show = 0 (interger)

				$newSlider = array(
					'name' => $name,
					'video' => $video,
					'is_show' => $show
				);

				

				if ($this->slider_video_model->update($id,$newSlider)) {
					//giá trị thay đổi dạng array
					$oldValue = array();
					$newValue = array();

					if ($oldSlider->name !== $newSlider['name']) {
						$oldValue['name'] = $oldSlider->name;
						$newValue['name'] = $newSlider['name'];
					}

					if ($oldSlider->video !== $newSlider['video']) {
						$oldValue['video'] = $oldSlider->video;
						$newValue['video'] = $newSlider['video'];
					}

					//checkbox trả về 0 (int) hoặc on(string) rất là rối
					//chuyển thành số hết cho dễ làm
					if($newSlider['is_show'] === 'on')
						$newSlider['is_show'] = 1;
					else
						$newSlider['is_show'] = 0;

					if ($oldSlider->is_show != $newSlider['is_show']) {
						$oldValue['is_show'] = $oldSlider->is_show;
						$newValue['is_show'] = $newSlider['is_show'];
					}
					
					//nội dung thay đổi dang text
					$oldValueStr = '';
					$newValueStr = '';
					$detail = '';

					//nếu thay đổi name
					if (array_key_exists('name', $oldValue)) {
						$oldValueStr .= '<p>Tên: <b>'.$oldValue['name'].'</b></p>';
						$newValueStr .= '<p>Tên: <b>'.$newValue['name'].'</b></p>';
						$detail .= '<p>Tên: <b>' . $oldValue['name'] . '</b> => <b>' . $newValue['name'] . '</b></p>';
					} else {
						$detail .= '<p>Tên: <b>'.$oldSlider->name.'</b></p>';
					}

					//nếu thay đổi video
					if (array_key_exists('video', $oldValue)) {
						$oldValueStr .= '<p>Mã video: <b>'.$oldValue['video'].'</b></p>';
						$newValueStr .= '<p>Mã video: <b>'.$newValue['video'].'</b></p>';
						$detail .= '<p>Mã video: <b>' . $oldValue['video'] . '</b> => <b>' . $newValue['video'] . '</b></p>';
					} else {
						$detail .= '<p>Mã video: <b>'.$oldSlider->video.'</b></p>';
					}

					//nếu thay đổi hiển thị
					if (array_key_exists('is_show', $oldValue)) {
						if($oldValue['is_show'] == 0)
						$detail .= '<p>Hiển thị: <b> Không cho phép </b> => <b> Cho phép </b></p>';
						else
						$detail .= '<p>Hiển thị: <b> Cho phép </b> => <b> Không cho phép </b></p>';
					} else {
						if($oldSlider->is_show == 0)
						$detail .= '<p>Hiển thị: <b> Không cho phép </b></p>';
						else
						$detail .= '<p>Hiển thị: <b> Cho phép </b></p>';
					}

					$history = array(
						'id_admin' => intval($this->session->userdata('id')),
						'action' => 'Sửa',
						'destination' => 'Video Slider',
						'detail' => $detail
					);
					$this->history_model->create($history);

					$this->session->set_flashdata("update_mess","<div class='alert alert-success'>Sửa slider thành công</div>");

					redirect(admin_url("slider"));
				}
				else {
					$this->session->set_flashdata("update_mess","<div class='alert alert-danger'>Thất bại vui lòng thử lại sau!</div>");
				}

			}
			

		}

		$data['message'] = $this->session->flashdata("update_mess");
		$data['oldSlider'] = $oldSlider;
		$data['page'] = 'admin/pages/slider_update';
		$this->load->view('admin/master_layout', $data);
	}

	public function delete()
	{
		$id = intval($this->uri->segment(4));
		//Video slider cũ
		$oldSlider = $this->slider_video_model->get_info($id);

		//Nếu k tồn tại đối tượng này
		if (!$oldSlider) {
			redirect(admin_url("slider"));
		}

		$slider = $this->slider_video_model->get_info($id);
		$sliderName = $slider->name;

		if (!$slider) {
			$this->session->set_flashdata('delete_mess', '<div class="alert alert-danger">Thất bại vui lòng thử lại sau.</div>');
			redirect(admin_url("slider"));
		}
		else {
			if ($this->slider_video_model->delete($id)) {
				$detail = '<p>Tên video slider đã xóa: <b>'. cut($sliderName,100) .'</b></p>';
				
					$history = array(
						'id_admin' => intval($this->session->userdata('id')),
						'action' => 'Xóa',
						'destination' => 'Video Slider',
						'detail' => $detail
					);
				
				$this->history_model->create($history);
				$this->session->set_flashdata('delete_mess', '<div class="alert alert-success">Xóa slider thành công.</div>');
				redirect(admin_url("slider"));

			}
			else {

				$this->session->set_flashdata('delete_mess', '<div class="alert alert-danger">Thất bại vui lòng thử lại sau.</div>');
				redirect(admin_url("slider"));
			}
		}
	}

	public function filter()

	{

		$idVideo = $this->input->post('idVideo', true);
		$seconds = $this->input->post('seconds', true);

		echo $count = $this->history_video_model->filterResult($idVideo, $seconds);

	}
}

/* End of file Upload.php */
/* Location: ./application/views/admin/pages/Upload.php */