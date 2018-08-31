<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_news_model');
		$this->load->model('news_model');
		$this->load->library('pagination');
		$this->load->library('mypagination');

	}
	// modun index của tin tức	
	public function index()
	{
		// nhận tham số alias trên url
		$alias = $this->input->get('alias',true);
		// lấy ra các tin nổi bật
		$data['highlightNews'] = $this->category_news_model->getHightLightNews();
		// hiển thị các tin tức theo danh mục tin
		$data['news'] = $this->category_news_model->getNewsByCategory($alias);
		// đếm tổng số tin của danh mục tin or tất cả
		$total = $this->category_news_model->getToTalNews($alias);
		$url = base_url().'tintuc';
		$page = 3;
		// phân trang
		$data['pagination'] = $this->mypagination->getPagination($url,$total,$page);
		$data['category_news'] = $this->category_news_model->getListCategory();
		$data['page'] = 'site/pages/category_news';
		$this->load->view('site/master_layout', $data);
	}

	public function show()
	{
		// nhận tham số aliasD trên url
		$alias = $this->input->get('aliasD',true);
		// lấy chi tiết tin
		$data['detail'] = $this->news_model->getDetailNews($alias);
		// lấy những tin liên quan
		$data['involvedNews'] = $this->news_model->getInvolvedNews($alias);
		// lấy alias của news category
		$data['aliasCat'] = $this->news_model->getAliasCat($alias);
		$data['page'] = 'site/pages/news';
		$this->load->view('site/master_layout', $data);
	}

}

/* End of file News.php */
/* Location: ./application/controllers/News.php */