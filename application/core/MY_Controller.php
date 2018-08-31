<?php
class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
		$this->load->model('product_model');
		$this->load->model('category_product_model');

		$controller = $this->uri->segment(1);

		if ($controller == 'admin') {
			$this->checkLogin();
		}
		//so luong san pham trong gio hang
		$input['where'] = array('is_seen' => 0);
		$count = $this->order_model->get_total($input);
		//lay danh muc lon
		$url = $this->uri->segment(2, $this->uri->segment(1));
		if(is_numeric($url)) {
			if (is_null($product = $this->product_model->get_info($url))) {
				$idParentCategory = $product->id_parent_category;
				$parentCategory = $this->category_product_model->get_info($idParentCategory);
				$url = $parentCategory->alias_name;
			}	
		}
		$global_data = array(
			'url' => $url,
			'count' => $count
		);
		$this->load->vars($global_data);
	}

	private function checkLogin()
	{
		$controller = $this->uri->segment(2);

		$login = $this->session->userdata('login');

		if (!$login && $controller !== 'login') {
			redirect(admin_url('login'));
		}

		if ($login && $controller !== '404' && $controller !== 'logout' && $controller !== 'home') {
			switch ($controller) {
				case 'login':
				{
					redirect(admin_url('home'));
				}
				break;
				case 'thongtin': case 'capnhatthongtin' : case 'doimatkhau':
				{
					$role = array(1,2,3);
					if (!$this->checkRole($role)) {
						redirect(admin_url('home'));
					}
				}
				break;
				case 'sanpham': case 'danhmucsanpham' :
				{
					$role = array(1,2);
					if (!$this->checkRole($role)) {
						redirect(admin_url('home'));
					}
				}
				break;
				case 'tintuc': case 'danhmuctintuc' :
				{
					$role = array(1,3);
					if (!$this->checkRole($role)) {
						redirect(admin_url('home'));
					}
				}
				break;
				
				default:
				{
					$role = array(1);
					if (!$this->checkRole($role)) {
						redirect(admin_url('404'));
					}
				}
				break;
			}
		}
	}

	/**
	 * [checkRole description]
	 * @param  array role $id_role [description]
	 * @return [type]          [description]
	 */
	public function checkRole($id_role) 
	{
		foreach ($id_role as $id) {
			if ($this->session->userdata('id_role') == $id) {
				return true;
			}
		}
		return false;
	}

	


}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */