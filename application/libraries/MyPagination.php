<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class MyPagination extends CI_Pagination
	{
	/**
	 *Link
	 *
	 * @var	string
	 */
	private $link = '';
	/**
	 * TotalRows
	 *
	 * @var	int
	 */
	private $totalRows = 0;

	/**
	 * PerPage
	 *
	 * @var	int
	 */
	private $perPage = 0;

	/**
	 * Construct : hàm tạo
	 *
	 * 
	 */
	public function __construct()
	{

		parent::__construct();
	}

	/**
	 * GetPagination
	 *@param $baseUrl : tham so duong dan url
	 *@param $total_Rows : tong so row trong database
	 *@param $per_Page : so trang duoc hien thi tren url
	 * Luu y : $per_Page truyen vao phai = voi so row duoc quy dinh trong dieu kien limit
	 * Example: SELECT * FROM table limit $soRowHienThi,$rowBatDau
	 * $soRowHienThi = $per_Page
	 * $rowBatDau = $this->uri->segment(phanDoanCanLay)
	 */
	public function getPagination($baseUrl,$total_Rows,$per_Page)
	{
		
		if(is_string($baseUrl))
		{
			$this->link = $baseUrl;
		}
		if (is_int($total_Rows) && $total_Rows > 0 ) {
			$this->totalRows = $total_Rows;
		}
		if(is_int($per_Page) && $per_Page > 0)
		{
			$this->perPage = $per_Page;
		}
		$config['base_url'] = $this->link;// cau hinh duong dan
		$config['total_rows'] = $this->totalRows;// cau hinh tong so row trong table
		$config['per_page'] = $this->perPage;// cau hinh so row hien thi cua 1 page, = $end	
		$config['reuse_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		/* cau hinh cac tag bootstrap*/
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['last_tag_open'] = '<li>';
		$config['next_tag_open'] = '<li>';
		$config['prev_tag_open'] = '<li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_close'] = '<li>';
		$config['prev_tag_close'] = '<li>';
		$config['cur_tag_open'] = "<li class=\"active\"><span><b>";
		$config['cur_tag_close'] = "</b></span></li>";
		/* end cau hinh*/
		// khoi tao cac gia tri vua moi cau hinh o $config
		$this->initialize($config);
		return  $this->create_links();// create phan trang
	}
}
/* End of file MyPagination.php */
/* Location: ./application/libraries/MyPagination.php */
?>
