<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VideoProduct extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('video_model');
		$this->load->model('history_video_model');

		$this->load->library('pagination');
		$this->load->library('mypagination');

	}
	/*
		Hiện thị danh sách các product được hiện thị ở index
		Nhận 2 value keyWord and listCat từ form
	*/
		public function index()
		{
			
			$keyWord = $this->input->get('keyWord', true);
			$listCat = $this->input->get('listCat', true);
		// Lấy ra tên , id của danh mục product hiển thị ở select box
			$cat = $this->history_video_model->getCategoryProduct();
			$data['cat'] = $cat;
		// Hiển thị danh sách product theo điều kiện
			$data['list'] = $this->history_video_model->getListVideoProduct($keyWord, $listCat);
		// Hiển thị tổng số product theo điều kiện
		$total = $this->history_video_model->getTotalVideoProduct($keyWord,$listCat);// tong so trang
		$page = 4;
		$url = admin_url('videosanpham');
		 // Phân trang
		$data['pagination'] = $this->mypagination->getPagination($url,$total,$page);
		$data['page'] = 'admin/pages/videoproduct';
		$data['total']  = $total;
		$this->load->view('admin/master_layout', $data);

	}
	/* Lọc số lượt xem của 1 video theo số giây truyền vào*/
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
/* Location: ./application/controllers/admin/VideoProduct.php */