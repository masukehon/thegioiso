<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('news_model');
	}

	public function search()
	{
		//tu khoa user nhap vao
        $key = $this->security->xss_clean($this->input->post('key', true));
        //chua ket qua cuoi dung
        $result = array();
        //so luong toi da tra ve cua moi danh muc
        $maxResult = 5;
        //dieu kien search san pham
        $likeProduct = array(
        	'name' => $key,
        	'alias_name' => toAlias($key)
        );
        //ket qua
        $resultProduct = array();
        $listProduct = $this->product_model->like_multi($likeProduct);
        //tao thanh mang key-value
        foreach ($listProduct as $product) {
            $item = array(
            'id' => $product->id,
            'url' => base_url('sanpham/' . $product->id),
            'name' => $product->name,
            'price' => vnd($product->price - $product->discount),
            'img_url' => upload_image_url($product->image_thumb)
            );
            $resultProduct[] = $item;
        }
        //tong so san pham tim dc
        $countProduct = count($resultProduct);
        //lay $maxResult tin neu co qua nhieu
        if ($countProduct <= $maxResult) {
	        $result['product'] = $resultProduct;
        } else {
        	$result['product'] = array_slice($resultProduct, 0, $maxResult);
        }
        //gan vao ket qua cuoi cung
        $result['productRemain'] = ($countProduct - $maxResult) > 0 ? ($countProduct - $maxResult) : 0;

        //ket qua tin tuc
        $resultNews = array();
        //dieu kien so sanh name like %key%,...
        $likeNews = array(
        	'name' => $key,
        	'describes' => $key,
        	'alias_name' => toAlias($key)
        );
        //danh sach ket qua
        $listNews = $this->news_model->like_multi($likeNews);
        //thay doi thanh mang cho phu hop
        foreach ($listNews as $new) {
            $item = array(
            'id' => $new->id,
            'url' => base_url('tintuc/chitiet/' . $new->id),
            'name' => $new->name,
            'time' => getTimeCreated($new->create_at),
            'img_url' => upload_image_url($new->image_thumb)
            );
            $resultNews[] = $item;
        }
        //tong so tin tuc tim dc
        $countNews = count($resultNews);
        //lay $maxResult tin neu co qua nhieu
        if ($countNews <= $maxResult) {
	        $result['news'] = $resultNews;
        } else {
        	$result['news'] = array_slice($resultNews, 0, $maxResult);
        }
        $result['newsRemain'] = ($countNews - $maxResult) > 0 ? ($countNews - $maxResult) : 0;

        echo json_encode($result);
        return;
	}
}

/* End of file Search.php */
/* Location: ./application/controllers/api/Search.php */