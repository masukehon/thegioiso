<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VideoHighLight extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('video_model');
		$this->load->model('history_video_model');
	}
	/* Hiển thị danh sách video nổi bật*/
	public function index()
	{
		$data['videoHighLight']  = $this->history_video_model->getListHighLight();
		$data['page'] = 'admin/pages/videohighlight';
		$this->load->view('admin/master_layout', $data);
		
	}
	/*Lọc dữ liệu, thống kê số giây đưa ra kết quả*/
	public function filter()
	{
		 $idVideo = $this->input->post('idVideo', true);
		$seconds = $this->input->post('seconds', true);
		echo $count = $this->history_video_model->filterResult($idVideo, $seconds);
	}
	/*Xóa thống kê của product*/
	public function delete()
	{
		$idVideo = $this->input->post('idVideo', true);
		$this->history_video_model->deleteHistory($idVideo);
	}

}

/* End of file Video.php */
/* Location: ./application/controllers/admin/VideoHightLight.php */