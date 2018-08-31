<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller

{

	public function __construct()

	{

		parent::__construct();

		$this->load->library('cart');

		$this->load->model('order_model');

		$this->load->model('order_detail_model');

		$this->load->library('session');



	}

 	// nhận thông tin vừa submit từ form của đơn hàng

	public function checkOut()

	{ 		

		$nameCustomer = $this->input->get('namecustomer', true);

		$phoneCustomer = $this->input->get('phonecustomer', true);

		$emailCustomer = $this->input->get('emailcustomer', true);

		$order = $this->input->get('order', true);

		$adrCustomer = $this->input->get('adrcustomer', true);

		$note = $this->input->get('note', true);

		$data = array(

			'customer_name' => $nameCustomer,

			'address' => $adrCustomer,

			'phone_number' => $phoneCustomer,

			'email' => $emailCustomer,

			'note' => $note,

			'delivery_method' => $order,
			
			'create_at' => date('Y-m-d H:i:s')

		);

 		 	$idOrder = $this->order_model->create($data);// insert thông tin vào table orders

 		 	$detailCart = $this->cart->contents();

 			foreach ($detailCart as $detailCarts)// Lặp mảng giỏ hàng lấy từng phần tử

 			{

 				$data = array(

 					'id_order' => $idOrder,

 					'id_product' => $detailCarts['id'],

 					'amount' => $detailCarts['qty'],

 					'price' => $detailCarts['subtotal']

 				);

 		 		$this->order_detail_model->create($data);// insert thông tin sản phẩm vào table order_detail

 		 	}

 			$this->cart->destroy();// insert xong xóa giỏ hàng		

 			$this->session->set_flashdata("message","<div class='alert alert-success'>Đặt hàng thành công, tổng đài viên sẽ liên hệ trực tiếp với bạn. Cảm ơn đã sử dụng dịch vụ của chúng tôi !!!</div>");

 			redirect('giohang');

 			

 		}



 	}

