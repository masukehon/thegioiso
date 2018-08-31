<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_detail_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'order_detail';
	}
	//Lấy thông tin khách hàng cho chi tiết đơn hàng
	public function getInfoDetail($id)
	{
		$this->load->model('order_model');// gọi tới model order
		$condition['where'] = array('id' => $id);// nhận điều kiện
		return $this->order_model->get_row($condition);
	}
	// Lấy chi tiết đơn hàng(sản phẩm, giá , số lượng)
	public function getListDetail($id)
	{	
		// $obj = new stdClass();
		$input['where'] = array('id_order'=>$id);// nhận điều kiện theo id đơn hàng
		$temp = $this->get_list($input);// danh sách các chi tiết đơn hàng theo id đơn hàng
		$this->load->model('product_model');
		$listDetail = array();// Khởi tạo array chứa chi tiết đơn hàng
		foreach ($temp as $temps){//Lặp để lấy các sản phẩm có trong chi tiết đơn hàng
			// Lấy ra 1 row của mỗi id_product có trong chi tiết đơn hàng
			$obj = $this->product_model->get_info($temps->id_product);
			// gán 1 prop cho $obj
			$obj->amount = $temps->amount;
			$obj->priceorder = $temps->price;
			// Quăng $obj vào array
			$listDetail[] = $obj;
		}
		return $listDetail;
	}
}

/* End of file Order_detail_model.php */
/* Location: ./application/models/Order_detail_model.php */