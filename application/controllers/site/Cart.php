<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->library('cart');
	}
	// hiện thị danh sách giỏ hàng
	public function index()

	{	
		$cart = $this->cart->contents();// gọi ra các sản phẩm trong giỏ hàng
		$data['cart'] = $cart; 
		$data['page'] = 'site/pages/cart';
		$this->load->view('site/master_layout', $data);
	}
// thêm sản phẩm vào giỏ hàng
	public function add()
	{
		// nhận tên không dấu trên phân đoạn
		$id = $this->uri->segment(2);
		$inputExist = array('id' => $id);// điều kiện kiểm tra
		if($this->product_model->check_exists($inputExist))// kiểm tra alias có trong db hay không
		{	
			$inputProduct['where'] = array('id' => $id);
			$product =  $this->product_model->get_row($inputProduct);// lấy thông tin sản phẩm vừa nhận 

			if($this->input->get())
			$qty = $this->input->get("soluong",true);// số lượng
			else//đề phòng lỗi
			redirect('');

			$price = $product->price;// giá
			if($product->discount > 0)// kiểm tra có giảm hay không
			{
				$price = $product->price - $product->discount;
			}
			// thêm thông tin sản phẩm vào array
			$temp = array();
			$temp['name'] = 'fakename';//vì cart của ci ko cho lưu tên sản phẩm có kí tự đặc biệt
			$temp['real_name'] = $product->name;
			$temp['id'] = $product->id;
			$temp['qty'] = $qty;
			$temp['price'] = $price;
			$temp['image'] = $product->image_thumb;
			
			$this->cart->insert($temp);// thêm 1 sản phẩm vào giỏ hàng
			redirect('giohang');

		}
		else
		{
			redirect('');
		}
	}

	public function add_ajax()
	{
		// nhận id trên phân đoạn
		$idProduct = $this->uri->segment(2);
		$inputExist = array('id' => $idProduct);// điều kiện kiểm tra
		if($this->product_model->check_exists($inputExist))// kiểm tra alias có trong db hay không
		{	
			$exist = false;

			$inputProduct['where'] = array('id' => $idProduct);
			$product =  $this->product_model->get_row($inputProduct);// lấy thông tin sản phẩm vừa nhận 
			//kiểm tra trong giỏ đã có sản phẩm này chưa
			$temp =  $this->cart->contents();
			foreach ($temp as $temps)
			{
				if($temps['id'] == $product->id)
				{
					$exist = true;break;
				}
			}

			//nếu sản phẩm không đó có trong giỏ hàng
			if($exist == false) {
				//thêm 

				$qty = 1;// số lượng
				$price = $product->price;// giá
				if($product->discount > 0)// kiểm tra có giảm hay không
				{
					$price = $product->price - $product->discount;
				}
				// thêm thông tin sản phẩm vào array
				$temp = array();
				$temp['id'] = $product->id;
				$temp['qty'] = $qty;
				$temp['name'] = 'fakename';//vì cart của ci ko cho lưu tên sản phẩm có kí tự đặc biệt
				$temp['real_name'] = $product->name;
				$temp['price'] = $price;
				$temp['image'] = $product->image_thumb;
				
				if($this->cart->insert($temp))// thêm 1 sản phẩm vào giỏ hàng
				{
					echo "true";
					return;
				}
			}
			else {
				//xóa
				
				$temp =  $this->cart->contents();
				foreach ($temp as $key => $temps)
				{
					if ($temps['id'] == $product->id)
					{
						$data = array();
						$data['rowid'] = $temps['rowid'];
						$data['qty'] = 0;
						if($this->cart->update($data))
						{
							echo "true";
							return;
						}
					}
				}
			}
		}
		//nếu ra tới đây thì lỗi
		echo "false";
	}
	public function ajax_quantity()
	{
		echo count($this->cart->contents());
	}
	// thay update số lượng sản phẩm của 1 món hàng
	public function update()
	{

		/*
		nhận thông tin của sản phẩm 
		$rowid: mã id riêng của 1 sản phẩm, phân biệt sp đó với 1 sp khác cùng id.
		(vd: 1 cái áo cùng id nhưng có size M và L )
		*/
		$rowId = $_GET['rowId'];
		$qty = $_GET['qty'];// số lượng
		$data = array(
			'rowid' => $rowId,
			'qty' => $qty
		);
		$this->cart->update($data);// thêm số lượng của sp trong giỏ hàng
		/*
		chuyển array thành json rồi đưa qua view
		*/
		echo json_encode($this->cart->contents());// 


	}
	// Xóa sp
	public function delete()
	{
		// chuyển qty thành 0 default xóa sp
		$rowId = $_GET['rowid'];
		$temp =  $this->cart->contents();
		foreach ($temp as $key => $temps)
		{
			if ($temps['id'] == $rowId)
			{
				$data = array();
				$data['rowid'] = $temps['rowid'];
				$data['qty'] = 0;
				$this->cart->update($data);
			}
		}

		
		echo json_encode($this->cart->contents());
	}

	


}

/* End of file Cart.php */
/* Location: ./application/controllers/Cart.php */