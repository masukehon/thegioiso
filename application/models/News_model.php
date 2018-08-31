<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'news';
	}
	 /*lấy detail tin tức theo tên không dấu
		$alias: tên không dấu của tin tức
	 */
	public function getDetailNews($alias)
	{
			// kiểm tra xem thằng nào cố tình sửa tham số trên url thì redirect về trang chủ
			$checkExists['where'] = array('alias_name' => $alias);
			if ($this->get_total($checkExists) <= 0) {
				redirect('');
			};
			$this->load->model('category_news_model');
			$inputNews['where'] = array('alias_name' => $alias);
			$detail = $this->get_row($inputNews);
			$getId = $detail->id_category;
			// dùng id_category để so sánh ở table category_news lấy được categoryName
			if($this->category_news_model->get_info($getId))
			{
				$cat = $this->category_news_model->get_info($getId);
				$detail->catName = $cat->name;
			}
			return $detail;

	}
	 /*Lấy các tin tức liên quan đến tin tức chi tiết
		$alias: tên không dấu của chi tiết tin
	 */
	public function getInvolvedNews($alias)
	{	

			$input['where'] = array('alias_name' => $alias);
			$detail = $this->get_row($input);
			$getId = $detail->id_category;// lấy id_category để duyệt các thằng tin tức có liên quan đến nó
			$inputNews['where'] = array('id_category'=>$getId);
			return $this->get_list($inputNews);
			
			
	}
	/*Lấy tên không dấu của danh mục để hiển thị các tin tức liên quan
		$alias: tên không dấu truyền vào
	*/
	public function getAliasCat($alias)
	{
			$input['where'] = array('alias_name' => $alias);
			$temp = $this->get_row($input);
			$getId = $temp->id_category; // lấy id_category
			$this->load->model('category_news_model');
			$inputCategory['where'] = array('id'=> $getId);
			return $this->category_news_model->get_row($inputCategory);// trả về tên không dấu của danh mục liên quan
	}

	public function like_multi($like)
	{
		if($like) {
			$this->db->order_by('id', 'DESC');
			$this->db->like('name', $like['name']);
			$this->db->or_like('describes', $like['describes']);
			$this->db->or_like('alias_name', $like['alias_name']);

			$query = $this->db->get($this->table);
			return $query->result();
		}
		return false;
	}

	public function like_multi_mix($like,$input)
	{
		if (isset($input['limit'][0]) && isset($input['limit'][1]))
		{
			$this->db->limit($input['limit'][0], $input['limit'][1]);
		}
		if ((isset($input['where'])) && $input['where'])
		{
			$this->db->where($input['where']);
		}
		if($like) {

			$this->db->order_by('id', 'DESC');
			$this->db->like('name', $like['name']);
			// $this->db->or_like('describes', $like['describes']);
			// $this->db->or_like('alias_name', $like['alias_name']);
		}

		$query = $this->db->get($this->table);
		return $query->result();
	}
}

/* End of file News_model.php */
/* Location: ./application/models/News_model.php */