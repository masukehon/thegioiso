<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Category_news extends MY_Controller 

{

	public function __construct()

	{

		parent::__construct();

		$this->load->model('category_news_model');

		$this->load->model('history_model');

	}



	public function index()

	{

		$this->load->library("form_validation");

		

		$list = $this->category_news_model->get_list();

		$data['list'] = $list;



		$role = array(1);

		$checkRole = $this->checkRole($role);



		$messageCategoryNew = $this->session->flashdata('messageCategoryNew');

		$data['messageCategoryNew'] = $messageCategoryNew;



		$data['checkRole'] = $checkRole;

		$data['page'] = 'admin/pages/category_news';

		$this->load->view('admin/master_layout', $data);

	}



	public function create()

	{

		

		$this->load->library("form_validation");

		$this->load->helper("form");

		$checkRole = $this->checkRole(array(1));



		if ($this->input->post()) {

			$this->form_validation->set_rules("name", "Tên danh mục", "required|min_length[2]|max_length[30]");



			if ($this->form_validation->run()) {

				$categoryName = $this->input->post("name", true);

				$alias_name = toAlias($categoryName);



				$category = array(

					"name" => $categoryName,

					"alias_name" => $alias_name

				);



				$id = $this->category_news_model->create($category);



				if ($id) {

					$detail = '<p>Tên: <b>'. $category['name'] .'</b></p>';



					$history = array(

						'id_admin' => intval($this->session->userdata('id')),

						'action' => 'Thêm',

						'destination' => 'Danh mục tin tức',

						'detail' => $detail

					);



					$this->history_model->create($history);



					$this->session->set_flashdata('messageCategoryNew', '<div class="alert alert-success">Thêm danh mục mới thành công</div>');

				} else {

					$this->session->set_flashdata('messageCategoryNew', '<div class="alert alert-danger">Thất bại vui lòng thử lại sau.</div>');

				}



				redirect(admin_url('danhmuctintuc'));

			}

		}



		$list = $this->category_news_model->get_list();

		$data['list'] = $list;



		



		$data['checkRole'] = $checkRole;

		$data['page'] = 'admin/pages/category_news';

		$this->load->view('admin/master_layout', $data);

	}



	public function update()

	{

		$this->load->library("form_validation");

		$this->load->helper("form");



		$id = $this->uri->segment(4);

		$id = intval($id);



		$info = $this->category_news_model->get_info($id);

		

		if (!$info) { 

			redirect(admin_url("danhmuctintuc"));

		}



		if ($this->input->post()) {



			$this->form_validation->set_rules("name", "Tên danh mục", "required|min_length[2]|max_length[30]");



			if ($this->form_validation->run()) {

				$categoryNewsName = $this->input->post("name",true);



				$categoryNewsObj = array("name"=>$categoryNewsName);



				if ($this->category_news_model->update($info->id,$categoryNewsObj)){



					if($info->name !== $categoryNewsName) {

						$detail = 'Tên: <b>' . $info->name . '</b> => <b>' . $categoryNewsName . '</b>';



						$history = array(

							'id_admin' => intval($this->session->userdata('id')),

							'action' => 'Cập nhật',

							'destination' => 'Danh mục tin tức',

							'detail' => $detail

						);



						$this->history_model->create($history);

					}



					$this->session->set_flashdata('messageCategoryNew', '<div class="alert alert-success">Cập nhật danh mục thành công</div>');

				} else {

					$this->session->set_flashdata('messageCategoryNew', '<div class="alert alert-danger">Thất bại! vui lòng thử lại sau.</div>');

				}



				redirect(admin_url('danhmuctintuc'));

			}



		}



		$data['info'] = $info;

		$list = $this->category_news_model->get_list();

		$data['flash_mess'] = $this->session->flashdata("Update_suc");

		$this->session->set_flashdata("Update_suc","");

		$data['list'] = $list;

		$data['page'] = 'admin/pages/category_news_update';

		$this->load->view('admin/master_layout', $data);

	}



	public function delete()

	{

		//lấy id

		$idCategoryNews = $this->uri->segment(4,-1);



		//lấy role id của admin

		$idRole = intval($this->session->userdata('id_role'));



		$role = array(1);

		//nếu ko phải admin toàn quyền thì cho out

		if (!$this->checkRole($role)) {

			redirect(admin_url("Home"));

		}	



		//nếu uri segment null

		if ($idCategoryNews == -1) {

			$this->session->set_flashdata('messageCategoryNew', '<div class="alert alert-danger">Thất bại vui lòng thử lại sau.</div>');

			redirect(admin_url("danhmuctintuc"));

		}

		else {



			$categoryNews = $this->category_news_model->get_info($idCategoryNews);

			$categoryNewsName = $categoryNews->name;



			//nếu nhân viên điền số tầm bậy vào url

			if (!$categoryNews) {

				$this->session->set_flashdata('messageCategoryNew', '<div class="alert alert-danger">Thất bại vui lòng thử lại sau.</div>');

				redirect(admin_url("danhmuctintuc"));

			}

			else {

				//nếu nhân viên ko điền số tầm bậy vào url

				if ($this->category_news_model->delete($idCategoryNews)) {

					$detail = '<p>Tên danh mục đã xóa: <b>'. cut($categoryNewsName,100) .'</b></p>';

					

						$history = array(

							'id_admin' => intval($this->session->userdata('id')),

							'action' => 'Xóa',

							'destination' => 'Danh mục tin tức',

							'detail' => $detail

						);

					

					$this->history_model->create($history);

					$this->session->set_flashdata('messageCategoryNew', '<div class="alert alert-success">Xóa danh mục thành công.</div>');

					redirect(admin_url("danhmuctintuc"));



				}

				else {



					$this->session->set_flashdata('messageCategoryNew', '<div class="alert alert-danger">Thất bại vui lòng thử lại sau.</div>');

					redirect(admin_url("danhmuctintuc"));

				}

			}



		}

		

	}

}