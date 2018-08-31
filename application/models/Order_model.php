<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'orders';
		// Goi libary pagination
		$this->load->library('pagination');
	}

	 public function getListOrders($input = array())
	 {

		// lay chi so bat dau cua row tren duong dan url, default = 0
		$segment = $this->uri->segment(4);
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
		// dieu kien cho cau truy van sap xep theo id, limit $end,$start
		$condition['limit'] = array($end,$start);
		$condition['order'] = array('id','DESC');
		$condition['where'] = $input;// dieu kien tim kiem
		return $this->get_list($condition);
	}
	 //dem tat ca cac dong cua table orders
	public function getTotalOrders($input = array())
	{
		$condition['where'] = $input;
		return $this->get_total($condition);

	}
	// update don hang với điều kiện id đơn hàng, dữ liệu truyền vào
	public function updateOrder($where, $data = array())
	{
		return $this->update($where,$data);
		
	}

}

/* End of file Order_model.php */
/* Location: ./application/models/Order_model.php */