<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_video_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'history_video';
	}
	/*Lấy danh sách các sản phẩm nổi bật*/
	public function getListHighLight()
	{
		$temp = array();
		$this->load->model('product_model');
		$this->load->model('category_product_model');

		// Điều kiện lấy ra sản phẩm nổi bật 
		$condition['where'] = array('is_highlight' => 1, 'is_show' => 1);
		$condition['limit'] = array(3,0);


		// Array các sản phẩm nổi bật
		$list = $this->product_model->get_list($condition);
		foreach ($list as $lists) {
			// Điều kiện đếm số lượt xem của 1 video
			$input['where'] = array('id_video' => $lists->video);
			$count = $this->get_total($input);
			// Điều kiên lấy ra tên của danh mục sản phẩm
			$inputCat['where'] = array('id' => $lists->id_parent_category);
			$cat = $this->category_product_model->get_row($inputCat);
			/*Gán 2 value vào object lists*/
			$lists->count = $count;
			$lists->catName = $cat->name;
			$temp[] = $lists;

		}
		// Trả về array object
		return $temp;
		
	}
	/*Nhận 2 para idVideo, seconds để lọc dữ liệu từ db*/
	public function filterResult($idVideo, $seconds)
	{
		$condition['where'] = array(

			'id_video' => $idVideo,
			'time_seen>=' => $seconds
		);
		return $count = $this->get_total($condition);
	}
	/*Nhân para idVideo rồi xóa history của video đó*/
	public function deleteHistory($idVideo)
	{
		$this->db->delete('history_video', array('id_video' => $idVideo));
	}

	public function getCategoryProduct()	
	{
		$this->load->model('category_product_model');
		$input['where'] = array('id_parent_category' => 0);
		return $this->category_product_model->get_list($input);
	}
	/*Lấy danh sách các sản phẩm theo điều kiện 
		$keyWord: tên product
		$listCat: id danh mục sản phẩm
	*/
	public function getListVideoProduct($keyWord = "", $listCat = "")
	{ 

		// Điều kiện lọc theo $listCat
		if ($listCat != "") {
			$input['where'] = array('show_in_index' => 1, 'is_show' => 1, 'id_parent_category' => $listCat);
		}
		else
		{
		$input['where'] = array('show_in_index' => 1, 'is_show' => 1);	
		}
		// Điều kiện lọc theo $keyWord
		if ($keyWord != "") {
			$input['like'][0] = 'name' ;
			$input['like'][1] = $keyWord ;
		}
		/* Điều kiên limit, phần tử bắt đầu khi phân trang*/
		$segment = $this->uri->segment(3);
		$end = 4;
		$segment = intval($segment);
		if ($segment == 0) {
			$start = 1;
		}
		else
		{
			$start = $segment;
		}
		$start = ($start - 1) * $end;
		
		$input['limit'] = array($end,$start);
		$temp = array();
		$this->load->model('product_model');
		// Array các sản phẩm hiển thị trên index
		$list = $this->product_model->get_list($input);
		foreach ($list as $lists) {
			// Điều kiện đếm số lượt xem của 1 video
			$input2['where'] = array('id_video' => $lists->video);
			$count = $this->get_total($input2);
			// Điều kiên lấy ra tên của danh mục sản phẩm
			$inputCat['where'] = array('id' => $lists->id_parent_category);
			$cat = $this->category_product_model->get_row($inputCat);
			/*Gán 2 value vào object lists*/
			$lists->count = $count;
			$lists->catName = $cat->name;
			$temp[] = $lists;

		}
		// Trả về array object
		return $temp;

	}
	/*Count tổng số các sản phẩm theo điều kiện 
		$keyWord: tên product
		$listCat: id danh mục sản phẩm
	*/
	public function getTotalVideoProduct($keyWord = "", $listCat = "")
	{
		// Điều kiện $listCat
		if ($listCat != "") {
			$input['where'] = array('show_in_index' => 1, 'is_show' => 1, 'id_parent_category' => $listCat);
		}
		else
		{
		$input['where'] = array('show_in_index' => 1, 'is_show' => 1);
		}
		// Điều kiện $keyWord
		if ($keyWord != "") {
			$input['like'][0] = 'name' ;
			$input['like'][1] = $keyWord ;
		}
		$this->load->model('product_model');
		/* trả về tổng số sản phẩm theo điều kiện
		Nếu không có $keyWord or $listCat lấy theo điều kiện
		$input['where'] = array('show_in_index' => 1, 'is_show' => 1);
		*/
		return $this->product_model->get_total($input);
	}
}

/* End of file History_video_model.php */
/* Location: ./application/models/History_video_model.php */