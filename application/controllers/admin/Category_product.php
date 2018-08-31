<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Category_product extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->load->model('category_product_model');

		$this->load->model('history_model');

	}



	public function index()

	{

		//thư viện form

		$this->load->library('form_validation');



		//lấy danh sach danh mục cha

		$input['where'] = array('id_parent_category' => '0');

		$input['order'] = array('id','ASC');

		$list = $this->category_product_model->get_list($input);



		//thong bao khi them danh muc

		$message = $this->session->flashdata('message');



		//du lieu truyen sang view

		$data = array(

			'list' => $list,

			'role1' => $this->checkRole(array(1)), // role1 admin quyen cao nhat

			'message' => $message,

			'page' => 'admin/pages/category_product'

		);



		$this->load->view('admin/master_layout', $data);

	}



	public function create()

	{

		$this->load->library('form_validation');

		$this->load->helper('form');

		//neu co post du lieu

		if ($this->input->post()) {

			//validate ten danh muc

			$this->form_validation->set_rules('name', 'Tên danh mục', 'required|min_length[2]');

			//neu hop le

			if ($this->form_validation->run()) {



				$name = $this->input->post('name', true);

				$id_parent_category = $this->input->post('id_parent_category', true);

				$id_parent_category_2 = $this->input->post('id_parent_category_2', true);

				if ($id_parent_category_2 != 0) {
					$newCategory = array(

						'name' => $name, 
	
						'alias_name' => toAlias($name), 
	
						'id_parent_category' => $id_parent_category_2
	
					);
				} else {
					$newCategory = array(

						'name' => $name, 
	
						'alias_name' => toAlias($name), 
	
						'id_parent_category' => $id_parent_category
	
					);
				}

				//neu insert thanh cong

				if ($this->category_product_model->create($newCategory)) {

					//lich su chi tiet

					$detail = '<p>Tên: <b>'. $name .'</b></p>';

					//chi tiet lich su them

					$history = array(

						'id_admin' => intval($this->session->userdata('id')),

						'action' => 'Thêm',

						'destination' => 'Danh mục sản phẩm',

						'detail' => $detail

					);



					//them vao db history

					$this->history_model->create($history);

					

					//thong bao khi them thanh cong

					$this->session->set_flashdata('message', '<div class="alert alert-success">Thêm danh mục mới thành công</div>');

					redirect(admin_url('danhmucsanpham'));

				} else {

					$this->session->set_flashdata('message', '<div class="alert alert-danger">Thất bại vui lòng thử lại sau.</div>');

					redirect(admin_url('danhmucsanpham'));

				}

			}

		}

		

		$input['where'] = array('id_parent_category' => '0');

		$input['order'] = array('id','ASC');

		$list = $this->category_product_model->get_list($input);



			//thong bao khi them danh muc

		$message = $this->session->flashdata('message');



			//du lieu truyen sang view

		$data = array(

			'list' => $list,

			'role1' => $this->checkRole(array(1)), // role1 admin quyen cao nhat

			'message' => $message,

			'page' => 'admin/pages/category_product'

		);



		$this->load->view('admin/master_layout', $data);

		

	}



	public function update()

	{

		$data['role1'] = $this->checkRole(array(1));

		$this->load->library('form_validation');

		$this->load->helper('form');



		$id = $this->uri->segment(4);

		$id = intval($id);



		$info = $this->category_product_model->get_info($id);



		if (!$info) {

			redirect(admin_url('danhmucsanpham'));

		}

		

		$data['category'] = $info;



		if ($this->input->post()) {



			$this->form_validation->set_rules('name', 'Tên danh mục', 'required|min_length[2]|max_length[30]');



			if ($this->form_validation->run()) {

				$name = $this->input->post('name', true);

				$newData['name'] = $name;

				$newData['alias_name'] = toAlias($name);

				if ($this->category_product_model->update($id, $newData)) {

					if($info->name !== $newData['name']) {

						$detail = 'Tên: <b>' . $info->name . '</b> => <b>' . $name . '</b>';	

					}

					if($info->id_parent_category !== $newData['id_parent_category']) {

						$oldParent = $this->category_product_model->get_info($info->id_parent_category );

						$newParent = $this->category_product_model->get_info($id_parent_category );

						$detail .= 'Danh mục lớn: <b>' . $oldParent->name . '</b> => <b>' . $newParent->name . '</b>';

					}

					if ($info->name !== $newData['name'] || $info->id_parent_category !== $newData['id_parent_category']) {

						$history = array(

							'id_admin' => intval($this->session->userdata('id')),

							'action' => 'Sửa',

							'destination' => 'Danh mục sản phẩm',

							'detail' => $detail

						);



						$this->history_model->create($history);

					}



					$this->session->set_flashdata('message', '<div class="alert alert-success">Cập nhật danh mục thành công</div>');

				} else {

					$this->session->set_flashdata('message', '<div class="alert alert-danger">Thất bại! vui lòng thử lại sau.</div>');

				}



				redirect(admin_url('danhmucsanpham'));

			}

		}





		$input['where'] = array('id_parent_category' => '0');

		$input['order'] = array('id','ASC');

		$list = $this->category_product_model->get_list($input);

		$data['list'] = $list;



		$data['page'] = 'admin/pages/category_product_update';

		$this->load->view('admin/master_layout', $data);

	}



	public function delete()

	{

		$id = $this->uri->segment(4);

		if($this->category_product_model->delete($id)) {

			$this->session->set_flashdata('message', '<div class="alert alert-success">Xóa danh muc thành công.</div>');

		} else {

			$this->session->set_flashdata('message', '<div class="alert alert-danger">Thất bại! vui lòng thử lại sau.</div>');

		}

		redirect(admin_url('danhmucsanpham'));

	}

}



/* End of file Category_product.php */

/* Location: ./application/controllers/admin/Category_product.php */