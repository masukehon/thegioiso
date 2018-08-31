<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class News extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->load->model('news_model');

		$this->load->model('history_model');

		$this->load->model('update_history_detail_model');

		$this->load->model("category_news_model");



		$this->load->library('lib_upload');

		$this->load->library("form_validation");

		$this->load->library("pagination");

		$this->load->library("mypagination");

		$this->load->helper('form');

	}

	

	public function index()

	{

		$listNews = '';

		//phân trang

		$page = $this->uri->segment(3,-1);

		$per_page = 5;

		$pagination = '';

		$idCategory = '';

		//kiểm tra user hiện tại có phải là boss

		$role = array(1);

		$checkRole = $this->checkRole($role);



		$listCategoryNews = $this->category_news_model->get_list();



		$message = $this->session->flashdata('create_mess') ? $this->session->flashdata('create_mess') : ($this->session->flashdata('update_mess') ? $this->session->flashdata('update_mess'):$this->session->flashdata('delete_mess'));



		if ($this->input->get()) {



			$input = array();

			$likeNews = array();

			$key = $this->input->get("keyword",true);

			$idCategory = $this->input->get("category",true);

			if ($key) {

				//điều kiện cho từ khóa

				$likeNews = array(

					'name' => $key

					// ,

					// 'describes' => $key,

					// 'alias_name' => toAlias($key)

				);

			}

			if($idCategory)

			{

				$category = $this->category_news_model->get_info($idCategory);

				//nếu nhân viên điền số tầm bậy lên url

				if (!$category && $idCategory != 0)

				redirect(admin_url("tintuc"));

				else if ($idCategory != 0){

					$input['where'] = array(

						'id_category' => $category->id

					);

				}

			}

			

			//lấy tổng số tin tức theo danh mục

			$listNews = $this->news_model->like_multi_mix($likeNews,$input);

			$totalRows = get_total_rows($listNews);



			//phân trang

            $start = 0;

            if($page > 0)

			$start = ($page-1) * $per_page;

			

			$input['order'] = array("update_at","DESC");

			$input['limit'] = array($per_page,$start);

			$listNews = $this->news_model->like_multi_mix($likeNews,$input);

			// print_r($listNews);

            $pagination = $this->mypagination->getPagination(admin_url("tintuc"),$totalRows, $per_page);

		}

		else {

			 //load bình thường

            //lấy tổng số tin tức

            $listNews = $this->news_model->get_list();

            $totalRows = get_total_rows($listNews);

            

            //phân trang

            $start = 0;

            if($page > 0)

				$start = ($page - 1) * $per_page;

			

			$input['order'] = array("update_at","DESC");

            $input['limit'] = array($per_page,$start);

            $listNews = $this->news_model->get_list($input);

            $pagination = $this->mypagination->getPagination(admin_url("tintuc"),$totalRows, $per_page);

		}

		// print_r($likeNews);

		// print_r($input);

		

		

		

		$data = array(

			'checkRole' => $checkRole,

			'idCategory'=> $idCategory,

			'pagination' => $pagination,

			'listCategoryNews' => $listCategoryNews,

			'listNews' => $listNews,

			'message' => $message,

			'page' => 'admin/pages/news'

		);



		$this->load->view('admin/master_layout', $data);

	}



	public function create()

	{

		$this->load->library('lib_upload');

		//danh mục tin tức

		$categoryNews = $this->category_news_model->get_list();



		if ($this->input->post()) {



			$this->form_validation->set_rules("title","Tiêu đề","required|min_length[2]");

			$this->form_validation->set_rules("describes","Nội dung tóm tắt","required|min_length[2]|max_length[200]");

			$this->form_validation->set_rules("content","Nội dung","required");



			if (empty($_FILES['image']['name']))

			{

				$this->form_validation->set_rules('image', 'Hình đại diện', 'required');

			}

			//nếu validate thành công

			if ($this->form_validation->run()) {

				//dữ liệu tin tức mới



				$image = '';

				$folder = 'image';

				$image_upload = $this->lib_upload->upload($folder, 'image');

				if (!is_array($image_upload)) {

					$this->session->set_flashdata('message', '<div class="alert alert-danger">Upload hình ảnh đại diện thất bại.</div>');

					redirect(admin_url('tintuc/them'));

				} else {

					$image = $image_upload['file_name'];

				}

				$is_show = $this->input->post("is_show",true) ? $this->input->post("is_show",true) : 0;



				//du lieu moi

				$news = array(

					"name" => $this->input->post("title",true),

					"alias_name" => toAlias($this->input->post("title",true)),

					"id_category" => intval($this->input->post("OptionCategoryNews",true)),

					"describes" => $this->input->post("describes",true),

					"content" => $this->input->post("content",true),

					"image" => $image,

					'image_thumb' => addThumb($image),

					'is_show' => $is_show

				);



				//Nếu thêm tin tức mới thành công

				if ($id = $this->news_model->create($news)) {

					//chi tiet hoat dong them

					$detail = array(

						'id' => $id,

						'name' => $news['name'],

						'is_show' => $news['is_show'],

						'describes' => $news['describes']

					);



					foreach ($categoryNews as $category) {

						if($category->id == $news['id_category']) {

							$detail['category_name'] =  $category->name;

						}

					}

					

					if ($detail['is_show'] == 1)

						$detail['is_show'] = "Cho phép";

					else 

						$detail['is_show'] = "Không cho phép";



					$detailStr = '<p>Tiêu đề: <b>'.$detail['name'].'</b></p>

					<p>Danh mục:  <b>'.$detail['category_name'].'</b></p>

					<p>Tóm tắt:  <b>'. cut($detail['describes'], 100).'</b></p>

					<p>Hiển thị:  <b>'. $detail['is_show'].'</b></p>

					<a href="'.admin_url('tintuc/sua/' . $id).'">Chi tiết</a>

					';

					//du lieu moi cua history

					$history = array(

						'id_admin' => intval($this->session->userdata('id')),

						'action' => 'Thêm',

						'destination' => 'Tin tức',

						'detail' => $detailStr

					);



					$this->history_model->create($history);



					$this->session->set_flashdata("create_mess","<div class='alert alert-success'>Thêm tin tức mới thành công</div>");



					redirect(admin_url("tintuc"));

				}

				else {

					$this->session->set_flashdata("create_mess","<div class='alert alert-danger'>Thất bại vui lòng thử lại sau!</div>");

				}



			}



		}



		$data = array(

			'message' => $this->session->flashdata("create_mess"),

			'categoryNews' => $categoryNews,

			'page' => 'admin/pages/create_news'

		);



		$this->load->view('admin/master_layout', $data);

	}



	public function update()

	{

		$id = intval($this->uri->segment(4));

		$oldNews = $this->news_model->get_info($id);



		//danh mục tin tức

		$categoryNews = $this->category_news_model->get_list();

		//Nếu k tồn tại đối tượng này

		if (!$oldNews) {

			redirect(admin_url("tintuc"));

		}

		//nếu có submit update

		if ($this->input->post()) {

			$this->form_validation->set_rules("title","Tiêu đề","required|min_length[2]");

			$this->form_validation->set_rules("describes","Nội dung tóm tắt","required|min_length[2]");

			$this->form_validation->set_rules("content","Nội dung","required|min_length[2]");

			

			//Nếu dữ liệu hợp lệ

			if ($this->form_validation->run()) {

				$news = '';

				//lấy checkbox hiển thị

				$is_show = $this->input->post("is_show",true) ? $this->input->post("is_show",true) : 0;



				if(!empty($_FILES['image']['name']))

				{

					$image = '';

					$folder = 'image';

					$image_upload = $this->lib_upload->upload($folder, 'image');

					//nếu upload image không thành công

					if (!is_array($image_upload)) {

						$this->session->set_flashdata('update_mess', '<div class="alert alert-danger">Upload hình ảnh đại diện thất bại.</div>');

						redirect(admin_url('tintuc/sua/').$id);

					} else {

						$image = $image_upload['file_name'];

					}

					//Giá trị mói

					$news = array(

						"name" => $this->input->post("title",true),

						"alias_name" => toAlias($this->input->post("title",true)),

						"id_category" => intval($this->input->post("OptionCategoryNews",true)),

						"describes" => $this->input->post("describes",true),

						"content" => $this->input->post("content",true),

						"image" => $image,

						'image_thumb' => addThumb($image),

						'is_show' => $is_show

					);

				}

				else {

					$news = array(

						"name" => $this->input->post("title",true),

						"alias_name" => toAlias($this->input->post("title",true)),

						"id_category" => intval($this->input->post("OptionCategoryNews",true)),

						"describes" => $this->input->post("describes",true),

						"content" => $this->input->post("content",true),

						'is_show' => $is_show

					);

				}

				

				//Nếu cập nhật thành công

				if ($this->news_model->update($oldNews->id,$news)) {

					//giá trị thay đổi dạng array

					$oldValue = array();

					$newValue = array();

					//nếu thay đổi name

					if ($oldNews->name !== $news['name']) {

						$oldValue['name'] = $oldNews->name;

						$newValue['name'] = $news['name'];

					}

					//nếu thay đổi category

					if (intval($oldNews->id_category) != intval($news['id_category'])) {

						foreach ($categoryNews as $category) {

							if ($category->id == $oldNews->id_category) {

								$oldValue['category'] = $category->name;

							}

							if ($category->id == $news['id_category']) {

								$newValue['category'] = $category->name;

							}



						}

					}

					//nếu thay đổi describes

					if ($oldNews->describes != $news['describes']) {

						$oldValue['describes'] = $oldNews->describes;

						$newValue['describes'] = $news['describes'];

					}

					//nếu thay đổi content

					if ($oldNews->content !== $news['content']) {

						$oldValue['content'] = $oldNews->content;

						$newValue['content'] = $news['content'];

					}

					//nếu thay đổi hình

					if(isset($news['image']) && $news['image'] && $news['image'] != '')

					{

						if ($oldNews->image !== $news['image']) {

							$oldValue['image'] = $oldNews->image;

							$newValue['image'] = $news['image'];

						}

					}

					//nếu thay đổi hiển thị

					if ($oldNews->is_show != $news['is_show']) {

						$oldValue['is_show'] = $oldNews->is_show;

						$newValue['is_show'] = $news['is_show'];

					}



					//nội dung thay đổi dang text

					$oldValueStr = '';

					$newValueStr = '';

					$detail = '';

					//nếu thay đổi name

					if (array_key_exists('name', $oldValue)) {

						$oldValueStr .= '<p>Tên: <b>'.$oldValue['name'].'</b></p>';

						$newValueStr .= '<p>Tên: <b>'.$newValue['name'].'</b></p>';

						$detail .= '<p>Tên: <b>' . $oldValue['name'] . '</b> => <b>' . $newValue['name'] . '</b></p>';

					} else {

						$detail .= '<p>Tên: <b>'.$news['name'].'</b></p>';

					}

					//nếu thay đổi category

					if (array_key_exists('category', $oldValue)) {

						$oldValueStr .= '<p>Danh mục: <b>'.$oldValue['category'].'</b></p>';

						$newValueStr .= '<p>Danh mục: <b>'.$newValue['category'].'</b></p>';

						$detail .= '<p>Danh mục: <b>' . $oldValue['category'] . '</b> => <b>' . $newValue['category'] . '</b></p>';

					}

					//nếu thay đổi describes

					if (array_key_exists('describes', $oldValue)) {

						$oldValueStr .= '<div>

						<h4>Tóm tắt: </h4>

						<div>'.$oldValue['describes'].'</div>

						</div>';

						$newValueStr .= '<div>

						<h4>Tóm tắt: </h4>

						<div>'.$newValue['describes'].'</div>

						</div>';

						$detail .= '<p><b>Thay đổi tóm tắt</b></p>';

					}

					//nếu thay đổi content

					if (array_key_exists('content', $oldValue)) {

						$oldValueStr .= '<div>

						<h4>Nội dung: </h4>

						<div>'.$oldValue['content'].'</div>

						</div>';

						$newValueStr .= '<div>

						<h4>Nội dung: </h4>

						<div>'.$newValue['content'].'</div>

						</div>';

						$detail .= '<p><b>Thay đổi nội dung</b></p>';

					}



					//nếu thay đổi hình

					if (array_key_exists('image', $oldValue)) {

						$oldValueStr .= '<div>

						<h4>Hình đại diện: </h4>

						<div><img src="' . upload_image_url($oldValue['image']) . '" alt="" class="img-responsive" width="300px"></div>

						</div>';

						$newValueStr .= '<div>

						<h4>Hình đại diện: </h4>

						<div><img src="' . upload_image_url($newValue['image']) . '" alt="" class="img-responsive" width="300px"></div>

						</div>';

						$detail .= '<p><b>Thay đổi hình đại diện</b></p>';

					}



					//nếu thay đổi hiển thị

					if (array_key_exists('is_show', $oldValue)) {

						if($oldValue['is_show'] == 0)

						$detail .= '<p>Hiển thị: <b> Không cho phép </b> => <b> Cho phép </b></p>';

						else

						$detail .= '<p>Hiển thị: <b> Cho phép </b> => <b> Không cho phép </b></p>';

					}



					if (array_key_exists('content', $oldValue) || array_key_exists('describes', $oldValue) || array_key_exists('image', $oldValue)) {

						$dataUpdate = array(

							'old' => $oldValueStr,

							'new' => $newValueStr

						);



						if ($idHistory = $this->update_history_detail_model->create($dataUpdate)) {

							$detail .= '<a href="'.admin_url('tintuc/sua/' . $id).'">Chi tiết</a>';

						}

					}



					$history = array(

						'id_admin' => intval($this->session->userdata('id')),

						'action' => 'Cập nhật',

						'destination' => 'Tin tức',

						'detail' => $detail

					);



					$this->history_model->create($history);



					$this->session->set_flashdata("update_mess","<div class='alert alert-success'>Cập nhật tin tức thành công</div>");



					redirect(admin_url("tintuc"));

				}

				else {

					$this->session->set_flashdata("update_mess","<div class='alert alert-danger'>Thất bại vui lòng thử lại sau!</div>");

				}

			}

		}



		$data = array(

			'data' => $oldNews,

			'message' => $this->session->flashdata("update_mess"),

			'categoryNews' => $categoryNews,

			'page' => "admin/pages/news_update"

		);



		$this->load->view("admin/master_layout",$data);

	}

	

	public function delete()

	{

		//lấy id

		$idNews = $this->uri->segment(4,-1);

		

		$role = array(1);

		//nếu ko phải admin toàn quyền thì cho out

		if (!$this->checkRole($role)) {

			redirect(admin_url("home"));

		}

		//nếu uri segment null

		if ($idNews == -1) {

			$this->session->set_flashdata('delete_mess', '<div class="alert alert-danger">Thất bại vui lòng thử lại sau.</div>');

			redirect(admin_url("home"));

		}

		else {



			$news = $this->news_model->get_info($idNews);

			$newsName = $news->name;



			//nếu nhân viên điền số tầm bậy vào url

			if (!$news) {

				$this->session->set_flashdata('delete_mess', '<div class="alert alert-danger">Thất bại vui lòng thử lại sau.</div>');

				redirect(admin_url("tintuc"));

			}

			else {

				//nếu nhân viên ko điền số tầm bậy vào url

				if ($this->news_model->delete($idNews)) {

					$detail = '<p>Tên tin tức đã xóa: <b>'. cut($newsName,100) .'</b></p>';

					

						$history = array(

							'id_admin' => intval($this->session->userdata('id')),

							'action' => 'Xóa',

							'destination' => 'Tin tức',

							'detail' => $detail

						);

					

					$this->history_model->create($history);

					$this->session->set_flashdata('delete_mess', '<div class="alert alert-success">Xóa tin tức thành công.</div>');

					redirect(admin_url("tintuc"));



				}

				else {



					$this->session->set_flashdata('delete_mess', '<div class="alert alert-danger">Thất bại vui lòng thử lại sau.</div>');

					redirect(admin_url("tintuc"));

				}

			}



		}

	}

	

}



/* End of file News.php */

/* Location: ./application/controllers/admin/News.php */