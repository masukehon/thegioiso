<?php
/**
*
*/
class Home extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('news_model');
        $this->load->model('slider_video_model');
        
        $this->load->library('cart');
    }
    
    public function index()
    {
        $this->load->model('image_model');

        //list sản phẩm trong giỏ hàng
        $listProductInCart = $this->cart->contents();

        //list slider
        $input['where'] = array('is_show' => 1);
        $listSlider = $this->slider_video_model->get_list($input);

        //list tin tức
        $input['limit'] = array('4','0');
        $input['where'] = array('is_show' => 1);
        $input['order'] = array('create_at','DESC');
        $listNews = $this->news_model->get_list($input);
        
        //lấy giờ đăng
        foreach($listNews as $news)
        {
            $timeCreate = getTimeCreated($news->create_at);
            $news->distanceTimeCreate = $timeCreate;
        }
        
        //list sản phẩm nổi bật
        $input = array();
        $input['limit'] = array('3','0');
        $input['where'] = array('is_show' => 1, 'is_highlight' => 1);
        $listHighLight = $this->product_model->get_list($input);
        
        //list sản phẩm điện thoại
        $input = array();
        $input['limit'] = array('5','0');
        $input['where'] = array('id_parent_category' => 1,'show_in_index' => 1,'is_show' => 1);
        $input['order'] = array('order' =>'COALESCE(sort_by_index, "zz") ASC');
        $listPhone = $this->product_model->get_list($input);
        
        foreach($listPhone as $phone)
        {
            //lấy giá VNĐ
            $phone->priceVND = vnd($phone->price);
            //lấy giá khuyến mãi
            if($phone->discount > 0) {
                $priceDiscount = $phone->price -  $phone->discount;
                $phone->priceDiscount = vnd($priceDiscount);
            }
        }

        //list sản phẩm Laptop
        $input = array();
        $input['limit'] = array('5','0');
        $input['where'] = array('id_parent_category' => 2,'show_in_index' => 1,'is_show' => 1);
        $input['order'] = array('order' =>'COALESCE(sort_by_index, "zz") ASC');
        $listLaptop = $this->product_model->get_list($input);
        
        foreach($listLaptop as $lap)
        {
            //lấy giá VNĐ
            $lap->priceVND = vnd($lap->price);
            //lấy giá khuyến mãi
            if($lap->discount > 0) {
                $priceDiscount = $lap->price -  $lap->discount;
                $lap->priceDiscount = vnd($priceDiscount);
            }
        }

        //list sản phẩm Camera
        $input = array();
        $input['limit'] = array('5','0');
        $input['where'] = array('id_parent_category' => 3,'show_in_index' => 1,'is_show' => 1);
        $input['order'] = array('order' =>'COALESCE(sort_by_index, "zz") ASC');
        $listCamera = $this->product_model->get_list($input);
        
        foreach($listCamera as $camera)
        {
            //lấy giá VNĐ
            $camera->priceVND = vnd($camera->price);
            //lấy giá khuyến mãi
            if($camera->discount > 0) {
                $priceDiscount = $camera->price -  $camera->discount;
                $camera->priceDiscount = vnd($priceDiscount);
            }
        }

        //list sản phẩm all in one
        $input = array();
        $input['limit'] = array('5','0');
        $input['where'] = array('id_parent_category' => 4,'show_in_index' => 1,'is_show' => 1);
        $input['order'] = array('order' =>'COALESCE(sort_by_index, "zz") ASC');
        $listAllInOne = $this->product_model->get_list($input);
        
        foreach($listAllInOne as $row)
        {
            //lấy giá VNĐ
            $row->priceVND = vnd($row->price);
            //lấy giá khuyến mãi
            if($row->discount > 0) {
                $priceDiscount = $row->price -  $row->discount;
                $row->priceDiscount = vnd($priceDiscount);
            }
        }
        
        //list sản phẩm phụ kiện
        $input = array();
        $input['limit'] = array('5','0');
        $input['where'] = array('id_parent_category' => 5,'show_in_index' => 1,'is_show' => 1);
        $input['order'] = array('order' =>'COALESCE(sort_by_index, "zz") ASC');
        $listAccessories = $this->product_model->get_list($input);
        
        foreach($listAccessories as $row)
        {
            //lấy giá VNĐ
            $row->priceVND = vnd($row->price);
            //lấy giá khuyến mãi
            if($row->discount > 0) {
                $priceDiscount = $row->price -  $row->discount;
                $row->priceDiscount = vnd($priceDiscount);
            }
        }
        
        //list sản phẩm máy ảnh
        $input = array();
        $input['limit'] = array('5','0');
        $input['where'] = array('id_parent_category' => 6,'show_in_index' => 1,'is_show' => 1);
        $input['order'] = array('order' =>'COALESCE(sort_by_index, "zz") ASC');
        $listPhotograph = $this->product_model->get_list($input);
        
        foreach($listPhotograph as $row)
        {
            //lấy giá VNĐ
            $row->priceVND = vnd($row->price);
            //lấy giá khuyến mãi
            if($row->discount > 0) {
                $priceDiscount = $row->price -  $row->discount;
                $row->priceDiscount = vnd($priceDiscount);
            }
        }

        $video = array();

        foreach ($listHighLight as $item) {
            $video[] = $item->video;
        }
        foreach ($listPhone as $item) {
            $video[] = $item->video;
        }
        foreach ($listLaptop as $item) {
            $video[] = $item->video;
        }
        foreach ($listCamera as $item) {
            $video[] = $item->video;
        }
        foreach ($listAllInOne as $item) {
            $video[] = $item->video;
        }
        foreach ($listAccessories as $item) {
            $video[] = $item->video;
        }
        foreach ($listPhotograph as $item) {
            $video[] = $item->video;
        }

        $data = array('page' => 'site/pages/index',
        'listProductInCart' => $listProductInCart,
        'listSlider' => $listSlider,
        'listHighLight' => $listHighLight,
        'listNews' => $listNews,
        'listPhone' => $listPhone,
        'listLaptop' => $listLaptop,
        'listCamera' => $listCamera,
        'listAllInOne' => $listAllInOne,
        'listAccessories' => $listAccessories,
        'listPhotograph' => $listPhotograph,
        'video' => $video);
        
        $this->load->view('site/master_layout', $data);
    }
    
    public function search()
    {
        $key = $this->input->get('key', true);
        
        $likeProduct = array(
            'name' => $key,
            'alias_name' => toAlias($key)
        );
        //ket qua
        $listProduct = $this->product_model->like_multi($likeProduct);
        //gan vao ket qua cuoi cung

        $likeNews = array(
            'name' => $key,
            'describes' => $key,
            'alias_name' => toAlias($key)
        );

        //danh sach ket qua
        $listNews = $this->news_model->like_multi($likeNews);

        $data = array(
            'listProduct' => $listProduct,
            'listNews' => $listNews,
            'key' => $key,
            'page' => 'site/pages/search'
        );

        $this->load->view('site/master_layout', $data);
    }
}
?>