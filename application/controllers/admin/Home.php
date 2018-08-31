<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('product_model');
		$this->load->model('category_product_model');
		$this->load->model('news_model');
		$this->load->model('category_news_model');
		$this->load->model('order_model');
	}
	
	public function index()
	{
		$totalNews = $this->news_model->get_total();
		$totalCategoryNews = $this->category_news_model->get_total();
		$totalProduct = $this->product_model->get_total();
		$totalCategoryProduct = $this->category_product_model->get_total();
		$totalOrder = $this->order_model->get_total();
		//tổng số admin ngoai tru admin master
		$inputAdmin = array(
			'where' => array('id_role >', 1)
		);
		$totalAdmin = $this->admin_model->get_total($inputAdmin);
		$hashLogin = $this->session->userdata('hash_login');

		$data = array(
			'page' => 'admin/pages/index',
			'totalNews' => $totalNews,
			'totalCategoryNews' => $totalCategoryNews,
			'totalProduct' => $totalProduct,
			'totalCategoryProduct' => $totalCategoryProduct,
			'totalOrder' => $totalOrder,
			'totalAdmin' => $totalAdmin,
			'hashLogin' => $hashLogin,
			'role13' => $this->checkRole(array(1,3)),
			'role12' => $this->checkRole(array(1,2)),
			'role1' => $this->checkRole(array(1))
		);

		$this->load->view('admin/master_layout', $data);
	}

	public function error()
	{
		$data['page'] = 'admin/pages/error';
		$this->load->view('admin/master_layout', $data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/admin/Home.php */