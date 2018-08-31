<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_news_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'category_news';
	}
	// lấy tên các danh mục tin tức
	public function getListCategory()
	{

		return $this->get_list();
	}
	// lấy các tin tức nổi bật
	public function getHightLightNews()
	{
		$this->load->model('news_model');
		$input['where'] = array('is_highlight' => 1, 'is_show' => 1);
		$input['limit'] = array('4','0');
		return $this->news_model->get_list($input);
	}
	// lấy list tin tức theo danh mục
	public function getNewsByCategory($alias)
	{

		
		
		$inputCategory = array();
		$inputNews = array();
		$list = array();
		$obj = new stdClass();
		
		/* Kiểm tra tin tức hiển thị theo loại
			alias là tên không dấu của danh mục tin, nếu có $alias thì hiện thì theo loại, default hiển thị tất cả
		*/
		if($alias != '')// nhận tên không dấu và kiểm tra
		{
			// kiểm tra xem thằng nào cố tình sửa tham số trên url thì redirect về trang chủ
			$checkExists['where'] = array('alias_name' => $alias);
			if ($this->get_total($checkExists) <= 0) {
				redirect('');
			};
			/* Giới hạn số dòng hiện thị ở một trang*/
			$segment = $this->uri->segment(2);
			$segment = intval($segment);
			$end = 3;
			$this->load->model('news_model');
			$inputCategory['where'] = array('alias_name' => $alias);//tạo điều kiện truy vấn
			$getId = $this->get_row($inputCategory);// lấy id_category rồi kiểm tra
			$id = $getId->id;
			$inputNews['where'] = array('id_category' => $id, 'is_show' => 1);
			$inputNews['limit'] = array($end,$segment);
			$obj = $this->news_model->get_list($inputNews);// lấy ra các tin liên có id_category đã truyền
			/* Lặp để truyền prop tên danh mục */
			foreach ($obj as $objs) {
				$objs->catName = $getId->name;
				$list[] = $objs;// Quăng kết quả vào list
			}
		}
		else// lấy tất cả kết quả
		{
			$this->load->model('news_model');
			/* Giới hạn số dòng hiện thị ở một trang*/
			$segment = $this->uri->segment(2);
			$segment = intval($segment);
			$end = 3;
			
			$input['limit'] = array($end,$segment);// điều kiện phân trang
			$input['where'] = array('is_show' => 1);	// điều kiện hiển thị
			$obj = $this->news_model->get_list($input);// lấy ra danh sách tin
			/* Lặp kết quả vừa lấy được
				mỗi tin chứa id_category, lấy id_category của mỗi tin đem so sánh với id của table category_news để lấy được categoryName
			*/ 
				foreach ($obj as $objs) {
					if($this->get_info($objs->id_category))
					{
						$cat = $this->get_info($objs->id_category);
						$objs->catName = $cat->name;
						$list[] = $objs;
					}

				}		

			}
			return $list;
		}
	 /*Lấy tổng số row trong table theo điều kiện
		$input: tên không dấu truyền vào
	 */
		public function getToTalNews($input)
		{	
		// lấy tổng số row của một danh mục nào đó theo tên không dấu truyền vào
			if($input != '')
			{
			$condition['where'] = array('alias_name' => $input);//truyền alias vào để lấy id_category
			$obj =  $this->get_row($condition);
			$this->load->model('news_model');
			$condition2['where'] = array('id_category' => $obj->id);// dùng id_category đem đếm số tin thuộc id_category đó
			$count = $this->news_model->get_total($condition2);
		}
		// lấy tổng row của 1 table
		else
		{
			$count = $this->news_model->get_total();	
		}
		
		return $count;
	}
}

/* End of file Category_news_model.php */
/* Location: ./application/models/Category_news_model.php */