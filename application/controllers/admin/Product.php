<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Product extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->load->model('product_model');

		$this->load->model('category_product_model');

		$this->load->model('product_color_model');

		$this->load->model('image_model');

		$this->load->model('history_model');

		$this->load->model('update_history_detail_model');



		$this->load->library('form_validation');

		$this->load->helper('form');



		$this->load->library("pagination");

		$this->load->library("mypagination");

	}



	public function index()

	{



		$page = $this->uri->segment(3,-1);

		$per_page = 5;

		$pagination = '';



		$start = 0;

		$total = $this->product_model->get_total();



		if ($page > 0) {

			$start = ($page - 1) * $per_page;

		}



		$input['order'] = array("update_at", "DESC");

		$input['limit'] = array($per_page, $start);



		$list = $this->product_model->get_list($input);



		$inputCate['where'] = array('id_parent_category' => 0);

		$categoryList = $this->category_product_model->get_list($inputCate);

		$message = $this->session->flashdata('message');



		$pagination = $this->mypagination->getPagination(admin_url("sanpham"),$total, $per_page);



		$data = array(

			'list' => $list,

			'categoryList' => $categoryList,

			'message' => $message,

			'page' => 'admin/pages/product',

			'role1' => $this->checkRole(array(1)),

			'pagination' => $pagination

		);


		$this->load->view('admin/master_layout', $data);

	}



	public function search()

	{

		if ($this->input->get()) {

			$data = array();

			$inputKey = $this->input->get('key', true);

			$inputParentCategory = $this->input->get('parent_category', true);

			$inputCategory = $this->input->get('category', true);

			$input = array();

			//neu co tu khoa

			if ($inputKey) {

				$input['like'] = array('name', $inputKey);

				$searchKey = $inputKey;

			} else {

				$searchKey = '';

			}

			//neu chon danh muc lon

			if ($inputParentCategory != 0) {

				$input['where'] = array('id_parent_category' => $inputParentCategory);

				$searchParentCategory = $inputParentCategory;

				$where['where'] = array('id_parent_category' => $inputParentCategory);

				$categoryChildList = $this->category_product_model->get_list($where);

			} else {

				$categoryChildList = array();

				$searchParentCategory = 0;

			}



			if ($inputCategory != 0) {

				$searchCategory = $inputCategory;

				$input['where'] = array('id_category' => $inputCategory);

			} else {

				$searchCategory = $inputCategory;

			}



		} else {

			redirect(admin_url('sanpham'));

		}

		//danh sach san pham hien thi ra

		$list = $this->product_model->get_list($input);

		//danh sach parentCategory

		$inputC['where'] = array('id_parent_category' => 0);

		$categoryList = $this->category_product_model->get_list($inputC);



		$message = $this->session->flashdata('message');



		$data = array(

			'list' => $list,

			'categoryList' => $categoryList,

			'message' => $message,

			'page' => 'admin/pages/product',

			'role1' => $this->checkRole(array(1)),

			'searchKey' => $searchKey,

			'searchParentCategory' => $searchParentCategory,

			'searchCategory' => $searchCategory,

			'categoryChildList' => $categoryChildList

		);

		$this->load->view('admin/master_layout', $data);

		



	}



	public function create()

	{

		$this->load->library('lib_upload');

		//dieu kien get danh sach danh muc lon

		$input['order']= array('id', 'asc');

		$input['where'] = array('id_parent_category' => 0);

		//danh sach danh muc lon

		$categoryParentList = $this->category_product_model->get_list($input);



		if ($this->input->post()) {

			//validate du lieu

			$this->form_validation->set_rules('name', 'Tên sản phẩm', 'trim|required|min_length[2]');

			$this->form_validation->set_rules('price', 'Giá sản phẩm', 'trim|required|numeric');

			//kiem tra up avatar

			if (empty($_FILES['image']['name']))

			{

				$this->form_validation->set_rules('image', 'Hình đại diện', 'required');

			}

			

			//neu validate thanh cong

			if ($this->form_validation->run()) {

				//lấy tham số form truyền lên

				$name = $this->input->post('name', true);

				$price = $this->input->post('price', true);

				$discount = $this->input->post('discount', true);

				$id_parent_category = $this->input->post('id_parent_category', true);

				$id_parent_category_2 = $this->input->post('id_parent_category_2', true);

				$id_category = $this->input->post('id_category', true);

				$describe = $this->input->post('describe', true);

				$parameter_tecnical = $this->input->post('parameter_tecnical', true);

				$promotion = $this->input->post('promotion', true);

				$is_show = $this->input->post('is_show', true);

				$is_highlight = $this->input->post('is_highlight', true);

				$video = $this->input->post('video', true);

				$show_in_index = $this->input->post('show_in_index', true);

				$screen = $this->input->post('screen', true);

				$lens = $this->input->post('lens', true);



				//folder để chứa hình upload

				$folder = 'image';



				//dữ liệu của hình upload lên

				$image = '';

				$image_upload = $this->lib_upload->upload($folder, 'image');

				//nếu upload image không thành công

				if (!is_array($image_upload)) {

					$this->session->set_flashdata('message', '<div class="alert alert-danger">Upload hình ảnh đại diện thất bại.</div>' . $image_upload);

					redirect(admin_url('sanpham/them'));

				} else {

					$image = $image_upload['file_name'];

				}





				//dữ liệu của danh sach hình upload lên

				$image_list_upload = $this->lib_upload->uploads($folder, 'image_list');

				$image_list = array();

				//neu upload avatar thanh cong

				if ($image_list_upload) {

					$image_list = json_encode($image_list_upload);

				} else {

					$image_list = '';

				}



				//dữ liệu de insert

				$product = array(

					'name' => $name ? $name : '',

					'alias_name' => $name ? toAlias($name) : '',

					'price' => $price ? $price : 0,

					'discount' => $discount ? $discount : 0,

					'id_parent_category' => $id_parent_category,

					'id_parent_category_2' => $id_category == 0 ? 0 : $id_parent_category_2,

					'id_category' => $id_category != 0 ? $id_category : $id_parent_category_2,

					'describe' => $describe ? $describe : '',

					'parameter_tecnical' => $parameter_tecnical ? $parameter_tecnical : '',

					'promotion' => $promotion ? $promotion: '',

					'is_show' => $is_show ? $is_show : 1,

					'image' => $image ? $image : '',

					'image_thumb' => $image ? addThumb($image) : '',

					'image_list' => $image_list,

					'image_list_thumb' => $image_list ? addThumbList($image_list) : '',

					'video' => $video ? $video : '',

					'is_highlight' => $is_highlight ? $is_highlight : 0,

					'show_in_index' => $show_in_index ? $show_in_index : 0,

					'screen' => $screen ? $screen : 0,

					'lens' => $lens ? $lens : 0

				);

				//nếu insert thành công

				if ($id = $this->product_model->create($product)) {

					//chi tiết hoạt động thêm

					$detail = array(

						'id' => $id,

						'name' => $name,

						'price' => vnd($price),

						'image_thumb' => upload_image_url() . addThumb($image)

					);

					//lay ten danh muc lon

					foreach ($categoryParentList as $category) {

						if($category->id == $id_parent_category) {

							$detail['parent_category_name'] =  $category->name;

						}

					}

					//Lay ten hang (danh muc nho)

					$query['where'] = array('id_parent_category' => $id_parent_category);

					$categoryList = $this->category_product_model->get_list($query);

					foreach ($categoryList as $category) {

						if($category->id == $id_category) {

							$detail['category_name'] =  $category->name;

						}

					}

					//chi tiết dạng text

					$detailStr = '<div class="col-sm-7">

					<p>Tên: <b>'.$detail['name'].'</b></p>

					<p>Danh mục lớn:  <b>'.$detail['parent_category_name'].'</b></p>

					<p>Danh mục nhỏ (hãng):  <b>'.$detail['category_name'].'</b></p>

					<p>Giá:  <b>'.vnd($detail['price']).'</b></p>

					<a href="'.admin_url('sanpham/sua/').$detail['id'].'">Chi tiết</a>

					</div>

					<div class="col-sm-5">

					<img src="'.$detail['image_thumb'].'" alt="" class="img-responsive">

					</div>';



					$history = array(

						'id_admin' => intval($this->session->userdata('id')),

						'action' => 'Thêm',

						'destination' => 'Sản phẩm',

						'detail' => $detailStr,

					);



					$this->history_model->create($history);



					$this->session->set_flashdata('message', '<div class="alert alert-success alert-message">Thêm sản phẩm mới thành công</div>');

					redirect(admin_url('sanpham'));

				}

			}

		}



		$role1 = $this->checkRole(array(1));

		$data = array(

			'role1' => $role1,

			'page' => 'admin/pages/product_create',

			'categoryParentList' => $categoryParentList,

		);

		$this->load->view('admin/master_layout', $data);

	}



	public function update()

	{

		$this->load->library('lib_upload');

		//danh sach danh muc lon

		$input['order']= array('id', 'asc');

		//danh muc cap 1
		$input['where'] = array('id_parent_category' => 0);

		$categoryParentList = $this->category_product_model->get_list($input);

		//id, info product can up date

		$id = $this->uri->segment(4);

		$info = $this->product_model->get_info($id);


		//danh mục cấp 2
		$inputCategory['where'] = array('id_parent_category' => $info->id_parent_category);

		$categoryChild = $this->category_product_model->get_list($inputCategory);

		//danh mục cấp 3
		$inputCategory2['where'] = array('id_parent_category' => $info->id_parent_category_2);

		$categoryChild2 = $this->category_product_model->get_list($inputCategory2);

		//neu khong co san pham phu hop

		if (!$info) {

			redirect(admin_url('sanpham'));

		}

		//danh sach danh muc nho

		$input['order']= array('id', 'asc');

		$input['where'] = array('id_parent_category' => $info->id_parent_category);

		$categoryList = $this->category_product_model->get_list($input);



		if ($this->input->post()) {



			$this->form_validation->set_rules('name', 'Tên sản phẩm', 'trim|required|min_length[2]|max_length[100]');

			$this->form_validation->set_rules('price', 'Giá sản phẩm', 'trim|required|numeric');

			

			//validate thanh cong

			if ($this->form_validation->run()) {

				//lấy tham số form truyền lên

				$name = $this->input->post('name', true);

				$price = $this->input->post('price', true);

				$discount = $this->input->post('discount', true);

				$id_parent_category = $this->input->post('id_parent_category', true);

				$id_parent_category_2 = $this->input->post('id_parent_category_2', true);

				$id_category = $this->input->post('id_category', true);

				$describe = $this->input->post('describe', true);

				$parameter_tecnical = $this->input->post('parameter_tecnical', true);

				$promotion = $this->input->post('promotion', true);

				$is_show = $this->input->post('is_show', true);

				$is_highlight = $this->input->post('is_highlight', true);

				$video = $this->input->post('video', true);

				$show_in_index = $this->input->post('show_in_index', true);

				$screen = $this->input->post('screen', true);

				$lens = $this->input->post('lens', true);

				//folder để chứa hình upload

				$folder = 'image';

				//dữ liệu của hình upload lên 'image' ten input tren form

				$image_upload = $this->lib_upload->upload($folder, 'image');

				$image = '';

				//neu upload avatar thanh cong

				if (is_array($image_upload)) {

					$image = $image_upload['file_name'];

				}

				//dữ liệu của danh sach hình upload lên

				$image_list_upload = $this->lib_upload->uploads($folder, 'image_list');

				$image_list = array();

				//neu upload avatar thanh cong

				if ($image_list_upload) {

					$image_list = json_encode($image_list_upload);

				}



				$product = array(

					'name' => $name ? $name : '',

					'alias_name' => $name ? toAlias($name) : '',

					'price' => $price ? $price : 0,

					'discount' => $discount ? $discount : 0,

					'id_parent_category' => $id_parent_category,

					'id_parent_category_2' => $id_category == 0 ? 0 : $id_parent_category_2,

					'id_category' => $id_category != 0 ? $id_category : $id_parent_category_2,

					'describe' => $describe ? $describe : '',

					'parameter_tecnical' => $parameter_tecnical ? $parameter_tecnical : '',

					'promotion' => $promotion ? $promotion: '',

					'is_show' => $is_show ? $is_show : 1,

					'video' => $video ? $video : '',

					'is_highlight' => $is_highlight ? $is_highlight : 0,

					'show_in_index' => $show_in_index ? $show_in_index : 0,

					'screen' => $screen ? $screen : 0,

					'lens' => $lens ? $lens : 0

				);

				//neu co thay doi avatar

				if ($image) {

					$product['image'] = $image;

					$product['image_thumb'] = addThumb($image);

				}

				/**

				 * Neu co thay doi danh sach hinh

				 */

				if ($image_list) {

					$product['image_list'] = $image_list;

					$product['image_list_thumb'] = addThumbList($image_list);

				}

				/**

				 * Neu update success

				 */

				if ($this->product_model->update($id, $product)) {

					//mãng chứa 2 giá trị mới cũ

					$oldValue = array();

					$newValue = array();

					//nếu thay đổi name

					if ($info->name !== $product['name']) {

						$oldValue['name'] = $info->name;

						$newValue['name'] = $product['name'];

					}

					//nếu thay đổi price

					if ($info->price !== $product['price']) {

						$oldValue['price'] = $info->price;

						$newValue['price'] = $product['price'];

					}

					//nếu thay đổi discount

					if ($info->discount !== $product['discount']) {

						$oldValue['discount'] = $info->discount;

						$newValue['discount'] = $product['discount'];

					}

					//nếu thay đổi hang

					if (intval($info->id_category) != intval($product['id_category'])) {



						$oldValue['category'] = $this->category_product_model->get_info($info->id_category)->name;

						$newValue['category'] = $this->category_product_model->get_info($product['id_category'])->name;

					}

					// neu thay doi danh muc lon

					if (intval($info->id_parent_category) != intval($product['id_parent_category'])) {

						$oldValue['parent_category'] = $this->category_product_model->get_info($info->id_parent_category)->name;

						$newValue['parent_category'] = $this->category_product_model->get_info($product['id_parent_category'])->name;

					}

					//nếu thay đổi describe

					if ($info->describe != $product['describe']) {

						$oldValue['describe'] = $info->describe;

						$newValue['describe'] = $product['describe'];

					}

					//nếu thay đổi parameter_tecnical

					if ($info->parameter_tecnical !== $product['parameter_tecnical']) {

						$oldValue['parameter_tecnical'] = $info->parameter_tecnical;

						$newValue['parameter_tecnical'] = $product['parameter_tecnical'];

					}

					//nếu thay đổi promotion

					if ($info->promotion !== $product['promotion']) {

						$oldValue['promotion'] = $info->promotion;

						$newValue['promotion'] = $product['promotion'];

					}

					//chuỗi giá trị thay đổi

					$oldValueStr = '';

					$newValueStr = '';

					//chi tiết thay đổi lưu vào db

					$detail = '';

					//nếu name có thay đổi

					if (array_key_exists('name', $oldValue)) {

						$oldValueStr .= '<p>Tên: <b>'.$oldValue['name'].'</b></p>';

						$newValueStr .= '<p>Tên: <b>'.$newValue['name'].'</b></p>';

						$detail .= '<p>Tên: <b>' . $oldValue['name'] . '</b> => <b>' . $newValue['name'] . '</b></p>';

					} else {

						$oldValueStr .= '<p>Tên: <b>'.$info->name.'</b></p>';

						$newValueStr .= '<p>Tên: <b>'.$info->name.'</b></p>';

						$detail .= '<p>Tên: <b>'.$product['name'].'</b></p>';

					}

					//nếu price có thay đổi

					if (array_key_exists('price', $oldValue)) {

						$oldValueStr .= '<p>Giá: <b>'. vnd($oldValue['price']) .'</b></p>';

						$newValueStr .= '<p>Giá: <b>'. vnd($newValue['price']) .'</b></p>';

						$detail .= '<p>Giá: <b>' . vnd($oldValue['price']) . '</b> => <b>' . vnd($newValue['price']) . '</b></p>';

					}

					//nếu discount có thay đổi

					if (array_key_exists('discount', $oldValue)) {

						$oldValueStr .= '<p>Giảm giá: <b>'. vnd($oldValue['discount']).'</b></p>';

						$newValueStr .= '<p>Giảm giá: <b>'. vnd($newValue['discount']) .'</b></p>';

						$detail .= '<p>Giảm giá: <b>' . vnd($oldValue['discount']) . '</b> => <b>' . vnd($newValue['discount']) . '</b></p>';

					}

					//nếu category có thay đổi

					if (array_key_exists('category', $oldValue)) {

						$oldValueStr .= '<p>Danh mục nhỏ (hãng): <b>'.$oldValue['category'].'</b></p>';

						$newValueStr .= '<p>Danh mục nhỏ (hãng): <b>'.$newValue['category'].'</b></p>';

						$detail .= '<p>Danh mục nhỏ (hãng): <b>' . $oldValue['category'] . '</b> => <b>' . $newValue['category'] . '</b></p>';

					}

					//nếu category có thay đổi

					if (array_key_exists('parent_category', $oldValue)) {

						$oldValueStr .= '<p>Danh mục lớn: <b>'.$oldValue['category'].'</b></p>';

						$newValueStr .= '<p>Danh mục lớn: <b>'.$newValue['category'].'</b></p>';

						$detail .= '<p>Danh mục lớn: <b>' . $oldValue['category'] . '</b> => <b>' . $newValue['category'] . '</b></p>';

					}

					//nếu image có thay đổi

					if (array_key_exists('image', $product)) {

						$oldValueStr .= '<div>

						<h4>Hình đại diện: </h4>

						<div><img src="' . upload_image_url($info->image) . '" alt="" class="img-responsive" width="300px"></div>

						</div>';

						$newValueStr .= '<div>

						<h4>Hình đại diện: </h4>

						<div><img src="' . upload_image_url($product['image']) . '" alt="" class="img-responsive" width="300px"></div>

						</div>';

						$detail .= '<p><b>Thay đổi hình đại diện</b></p>';

					}

					//nếu image có thay đổi

					if (array_key_exists('image_list', $product)) {

						$oldValueStr .= '<div>

						<h4>Hình chi tiết: </h4>';

						$imgListOld = json_decode($info->image_list);

						foreach ($imgListOld as $imgOld) {

							$oldValueStr .= '<img src="'. upload_image_url($imgOld) .'" width="150px">';

						}

						$oldValueStr .= '</div>';



						$newValueStr .= '<div>

						<h4>Hình chi tiết: </h4>';

						$imgListNew = json_decode($image_list);

						foreach ($imgListNew as $imgNew) {

							$newValueStr .= '<img src="'. upload_image_url($imgNew) .'" width="150px">';

						}

						$newValueStr .= '</div>';

						$detail .= '<p><b>Thay đổi hình chi tiết</b></p>';

					}

					//nếu parameter_tecnical có thay đổi

					if (array_key_exists('parameter_tecnical', $oldValue)) {

						$oldValueStr .= '<div>

						<h4>Thông số kỹ thuật: </h4>

						<div>'.$oldValue['parameter_tecnical'].'</div>

						</div>';

						$newValueStr .= '<div>

						<h4>Thông số kỹ thuật: </h4>

						<div>'.$newValue['parameter_tecnical'].'</div>

						</div>';

						$detail .= '<p><b>Thay đổi thông số kỹ thuật</b></p>';

					}



					if (array_key_exists('describe', $oldValue)) {

						$oldValueStr .= '<div>

						<h4>Chính sách bảo hành: </h4>

						<div>'.$oldValue['describe'].'</div>

						</div>';

						$newValueStr .= '<div>

						<h4>Chính sách bảo hành: </h4>

						<div>'.$newValue['describe'].'</div>

						</div>';

						$detail .= '<p><b>Thay đổi chính sách bảo hành</b></p>';

					}



					if (array_key_exists('promotion', $oldValue)) {

						$oldValueStr .= '<div>

						<h4>Ưu đãi khi mua sản phẩm: </h4>

						<div>'.$oldValue['promotion'].'</div>

						</div>';

						$newValueStr .= '<div>

						<h4>Ưu đãi khi mua sản phẩm: </h4>

						<div>'.$newValue['promotion'].'</div>

						</div>';

						$detail .= '<p><b>Thay đổi ưu đãi khi mua sản phẩm</b></p>';

					}

					

					if (array_key_exists('parameter_tecnical', $oldValue) || array_key_exists('promotion', $oldValue) || array_key_exists('describe', $oldValue) || array_key_exists('image', $product) || array_key_exists('image_list', $product)) {

						$dataUpdate = array(

							'old' => $oldValueStr,

							'new' => $newValueStr

						);



						if ($idHistory = $this->update_history_detail_model->create($dataUpdate)) {

							$detail .= '<a href="' . admin_url('nhanvien/capnhat/') . $idHistory.'">Chi tiết</a>';

						}

					}



					$history = array(

						'id_admin' => intval($this->session->userdata('id')),

						'action' => 'Cập nhật',

						'destination' => 'Sản phẩm',

						'detail' => $detail

					);



					$this->history_model->create($history);



					$this->session->set_flashdata("update_mess","<div class='alert alert-success'>Cập nhật tin tức thành công</div>");

					

					$this->session->set_flashdata('message', '<div class="alert alert-success">Cập nhật sản phẩm thành công</div>');

					redirect(admin_url('sanpham'));

				} else {

					$this->session->set_flashdata('message', '<div class="alert alert-danger">Cập nhật sản phẩm thất bại.</div>');

				}

			}

		}



		$data = array(

			'page' => 'admin/pages/product_update',

			'info' => $info,

			'categoryParentList' => $categoryParentList,

			'categoryList' => $categoryList,

			'categoryChild' => $categoryChild,

			'categoryChild2' => $categoryChild2,

			'role1' => $this->checkRole(array(1))

		);



		$this->load->view('admin/master_layout', $data);

	}



	public function updateAPI()

	{

		$list = $this->input->post('list', true);

		if ($list) {

			// $list = json_decode($list);

			foreach ($list as $item) {

				/**

				 * Cat chuoi theo dau #

				 * data[0] san pham

				 * data[1] id san pham

				 * data[2] field

				 */

				$data = explode('#', $item['name']);

				//lay du lieu cu de luu vet

				$oldValue = $this->product_model->get_info($data[1]);



				//neu la du lieu true false, check box

				if($item['value'] === 'true' || $item['value'] === 'false') {

					$product = array(

						$data[2] => $item['value'] === 'true' ? 1 : 0

					);

					try {

						$this->product_model->update($data[1], $product);

					} catch (Exception $e) {

						$message = array(

							'error' => 'Thất bại'

						);

						echo json_encode($message);

						return;

					}

				} else {

					$product = array(

						$data[2] => $item['value']

					);

					try {

						$this->product_model->update($data[1], $product);

					} catch (Exception $e) {

						$message = array(

							'error' => 'Thất bại'

						);

						echo json_encode($message);

						return;

					}

				}



				//noi dung chi tiet

				$detail = '';

				//chon noi dung phu hop

				switch ($data[2]) {

					case 'price':

					$detail = '<p>Giá: <b>' . vnd($oldValue->price) . '</b> => <b>' . vnd($item['value']) . '</b></p>';

					break;

					case 'discount':

					$detail = '<p>Giảm giá: <b>' . vnd($oldValue->discount) . '</b> => <b>' . vnd($item['value']) . '</b></p>';

					break;

					case 'id_category':

					$oldCategory = $this->category_product_model->get_info($oldValue->id_category)->name;

					$newCategory = $this->category_product_model->get_info($item['value'])->name;

					$detail = '<p>Danh mục: <b>' . $oldCategory . '</b> => <b>' . $newCategory . '</b></p>';

					break;

					case 'name':

					$detail = '<p>Tên: <b>' . $oldValue->name . '</b> => <b>' . $item['value'] . '</b></p>';

					break;

					case 'is_show':

					$newCheck = $item['value'] === "true" ? 1 : 0;

					$detail = '<p>Hiển thị: <b>' . $oldValue->is_show . '</b> => <b>' . $newCheck . '</b></p>';

					break;

				}



				$history = array(

					'id_admin' => intval($this->session->userdata('id')),

					'action' => 'Cập nhật',

					'destination' => 'Sản phẩm',

					'detail' => $detail

				);



				$this->history_model->create($history);

			}

		}



		$message = array(

			'success' => 'Thành công'

		);

		echo json_encode($message);

		return;

	}



	public function delete()

	{

		$id = $this->uri->segment(4);

		if($this->product_model->delete($id)) {

			$this->session->set_flashdata('message', '<div class="alert alert-success">Xóa sản phẩm thành công.</div>');

		} else {

			$this->session->set_flashdata('message', '<div class="alert alert-danger">Thất bại! vui lòng thử lại sau.</div>');

		}

		$this->load->library('user_agent');

		if ($this->agent->is_referral())
		{
			redirect($this->agent->referrer());
		}

	}
	public function sort()
	{
		$searchSort = array();
		if ($this->input->get()) {

			$this->db->like('name', $this->input->get('searchforname', true));
			 $this->db->where('id_parent_category', $this->input->get('parent_category', true));
			 if ($this->input->get('searchforname', true) != "") {
			 	$searchSort['like'] = array('name' , $this->input->get('searchforname', true));
			 }
			 if ($this->input->get('parent_category', true) != "") {
			 	$searchSort['where'] = array('id_parent_category' => $this->input->get('parent_category', true));
			 }

		}

		$segment = $this->uri->segment(4);

		$end = 10;

		$segment = intval($segment);

		if ($segment == 0) {

			$start = 1;

		}

		else

		{

			$start = $segment;

		}

		$start = ($start - 1) * $end;

		$this->db->order_by('COALESCE(sort_by_index, "zz") ASC');
		$this->db->limit($end, $start);
		$query = $this->db->get('product');
		$row = $query->result();
		$box = array();
		foreach ($row as $rows) {
			$inputCate['where'] = array('id' => $rows->id_parent_category);
			$rows->namecate = $this->category_product_model->get_row($inputCate)->name;
			$box[] = $rows;
		}
		$input['where'] = array('id_parent_category' => 0);
		$data['listcate'] = $this->category_product_model->get_list($input);
		$data['list'] = $box;
		
		$total = $this->product_model->get_total($searchSort);
		$page = 10;// so trang tren uri
		$url = admin_url('product/sort');// duong dan cua trang
		$data['pagination'] = $this->mypagination->getPagination($url,$total,$page);
		$data['page'] = 'admin/pages/product_short';
		$this->load->view('admin/master_layout', $data);
	}
	public function sortPositionIndex()
	{
		if ($this->input->is_ajax_request()) {
			$idSortIndex = $this->input->post('idSortIndex', true);
			$valSortIndex = $this->input->post('valSortIndex', true);
			$data = array('sort_by_index' => $valSortIndex);
			if ($this->product_model->update($idSortIndex, $data)) {
				echo json_encode("ok");
				return;
			}
			
		}
	}
	public function sortPositionCate()
	{
		if ($this->input->is_ajax_request()) {
			$idSortCate = $this->input->post('idSortCate', true);
			$valSortCate = $this->input->post('valSortCate', true);
			$data = array('sort_by_cate' => $valSortCate);
			if ($this->product_model->update($idSortCate, $data)) {
				echo json_encode("ok");
				return;
			}
			
		}
	}



	

}



/* End of file Product.php */

/* Location: ./application/controllers/admin/Product.php */