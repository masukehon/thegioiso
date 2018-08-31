<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
		$this->load->model('order_detail_model');
		$this->load->model('product_model');
		$this->load->model('product_color_model');
		$this->load->model('image_model');
		$this->load->library('mypagination');// gọi library đã được costumize lại
	}

	public function index()
	{

		$searchOrder = array();// khoi tao array chua input get tim kiem
		$status = $this->input->get('statusOrder', true);// nhan value 
		$seen = $this->input->get('seenOrder', true);
		// kiem tra value vua nhan
		if($status != "" ){
			$searchOrder['status']  = $status;
		}
		if ($seen != "") {
			$searchOrder['is_seen'] =  $seen;
		}
		
		$data['page'] = 'admin/pages/order';
		$data['list'] = $this->order_model->getListOrders($searchOrder);// lay danh sach don hang
		
		$total = $this->order_model->getTotalOrders($searchOrder);// tong so trang
		$page = 4;// so trang tren uri
		$url = admin_url('order/index');// duong dan cua trang
		$data['pagination'] = $this->mypagination->getPagination($url,$total,$page);// gọi l phan trang
		
		
		$this->load->view('admin/master_layout', $data);


	}

	// chi tiet don hang
	public function detail()
	{
		/* Cập nhật trạng thái đơn hàng*/
		$updateOrderWhere = "";//  chứa mã đơn hàng
		$updateOrderData = array();// chứa dữ liệu cần update 
		if($this->input->post('id_Order_Seen'))// thêm dữ liệu duyệt đơn hàng
		{
			$updateOrderWhere = $this->input->post('id_Order_Seen');
			$updateOrderData['is_seen'] = $this->input->post('detail_Seen');
			// có dữ liệu sẽ update vào datase
			if($this->order_model->updateOrder($updateOrderWhere,$updateOrderData))
			{
				$data['notification'] = "Thay đổi trạng thái duyệt đơn hàng thành công !!!";
			}
		}
		if ($this->input->post('id_Order_Paid')) // thêm dữ liệu thanh toán đơn hàng
		{
			$updateOrderWhere = $this->input->post('id_Order_Paid');
			$updateOrderData['is_paid'] = $this->input->post('detail_Paid');
			// có dữ liệu sẽ update vào datase
			if($this->order_model->updateOrder($updateOrderWhere,$updateOrderData))
			{
				$data['notification'] = "Thay đổi trạng thái thanh toán thành công !!!";
			}
		}
		if ($this->input->post('id_Order_Status'))// thêm dữ liệu trạng thái đơn hàng
		{
			$updateOrderWhere = $this->input->post('id_Order_Status');
			$updateOrderData['status'] = $this->input->post('detail_Status');
			// có dữ liệu sẽ update vào datase
			if($this->order_model->updateOrder($updateOrderWhere,$updateOrderData))
			{
				$data['notification'] = "Thay đổi trạng thái thành công !!!";
			}
		}
		/* Lấy chi tiết đơn hàng theo id*/
		$idOrder = $this->input->get('id');	
		
		$data['info'] = $this->order_detail_model->getInfoDetail($idOrder);// trả về thông tin của khách hàng trong chi tiết đơn hàng
		$data['detail'] = $this->order_detail_model->getListDetail($idOrder);//trả về chi tiết đơn hàng
		$data['page'] = 'admin/pages/order_detail';
		$this->load->view('admin/master_layout', $data);
	}


	
}

/* End of file Order.php */
/* Location: ./application/controllers/admin/Order.php */	