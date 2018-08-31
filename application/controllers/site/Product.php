<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Product extends MY_Controller {
    
    
    
    public function __construct()
    
    {
        
        parent::__construct();
        
        $this->load->model('product_model');
        
        $this->load->model('category_product_model');
        
        
        
        $this->load->library('pagination');
        
        $this->load->library('mypagination');
        
        $this->load->library('cart');
        
    }
    
    
    
    public function index()
    
    {
        
        //tổng sản phẩm
        
        $totalRows = 0;
        
        
        
        //chứa các option của radio
        
        $option = array();
        
        
        
        $input = array();
        
        
        
        //biến để phân trang
        
        $page = $this->uri->segment(3,1);
        
        
        
        //số lượng sản phẩm mỗi trang
        
        $per_page = 9;
        
        
        
        $pagination = '';
        
        
        
        //alias_name của danh mục
        
        $nameCategory = $this->uri->segment(2,"dien-thoai");
        
        
        //điều kiện lấy danh mục cha
        $where = array(
        
        'id_parent_category' => 0,
        
        'alias_name' => $nameCategory
        
        );
        
        //get danh mục parent
        
        $category = $this->category_product_model->get_info_rule($where);
        
        
        //kiểm tra có tồn tại hay ko
        if($category)
        
        {
            //lấy điều kiện load sản phẩm thuộc danh mục cha
            $input['where'] = array(
            
            'id_parent_category' => $category->id
            
            );
            
        }
        
        else
            
        redirect(base_url()."danhmucsanpham/dien-thoai");
        
        
        //get tất cả các hãng
        $listBrand = $this->category_product_model->get_list($input);
        
        //chứa loại sản phẩm con của trang phụ kiện
        $listSubProductAcc = array();

        if ($nameCategory == 'phu-kien') {

            //hiện tại $listBrand = { phụ kiện điên thoại, phụ kiện laptop }
            foreach ($listBrand as $row) {

                //điều kiện lấy các danh mục con theo $listBrand ở trên
                $where['where'] = array(
                    'id_parent_category' => $row->id
                );

                //lặp lần 1: $listTempt = {sạc điện thoại, ốp lưng ....}
                //lặp lần 2: $listTempt = {sạc laptop, pin ....}
                $listTempt = $this->category_product_model->get_list($where);

                //ghép các lần lặp lại để được tất cả danh mục con của danh muc cha PHỤ KIỆN
                foreach ($listTempt as $tempt) {
                    $check = 0;

                    //loại bỏ những loại sản phẩm bị trùng vd: phụ kiên laptop và phụ kiên  
                    //điện thoại đều có loại sản phẩm Tai Nghe
                    foreach($listSubProductAcc as $subProductAcc)
                    {
                        if($subProductAcc->alias_name === $tempt->alias_name)
                        $check++;
                    }
                    if($check == 0) {
                        $listSubProductAcc[] = $tempt;
                    }
                }                      

            }
        }

        //chứa các hãng con khi load trang máy ảnh
        $listSubBrand = array();

        if ($nameCategory == 'may-anh') {

            //hiện tại $listBrand = { Body, Lens }
            foreach ($listBrand as $row) {

                //điều kiện lấy các danh mục con theo $listBrand ở trên
                $where['where'] = array(
                    'id_parent_category' => $row->id
                );

                //lặp lần 1: $listTempt = {Toshiba, Sony ....}
                //lặp lần 2: $listTempt = {Sam Sung, Canon ....}
                $listTempt = $this->category_product_model->get_list($where);

                //ghép các lần lặp lại để được tất cả danh mục con của danh muc cha LOẠI
                foreach ($listTempt as $tempt) {
                    $check = 0;
                    //loại bỏ những tên hãng bị trùng
                    foreach($listSubBrand as $subBrand)
                    {
                        if($subBrand->alias_name === $tempt->alias_name)
                        $check++;
                    }
                    if($check == 0) {
                        $listSubBrand[] = $tempt;
                    }
                }                
            }

        }

        
        
        if ($this->input->get()) {
            
            //load theo điều kiện
            
            $nameBrand = $this->input->get("brand",true);
            
            $price = $this->input->get("price",true);
            
            $order = $this->input->get("order",true);
            
            $screen = $this->input->get("screen",true);
            
            $lens = $this->input->get("lens",true);
            
            $type = $this->input->get("type",true);
            
            $subPro = $this->input->get("subPro",true);
             
            
            $input = array();
            
            
            //chứa các option của radio
            
            $option = array(
            
            "nameBrand" => $nameBrand,
            
            "price" => $price,
            
            "order" => $order,
            
            "screen" => $screen,
            
            "lens" => $lens,
            
            "type" => $type,

            "subPro" => $subPro
            
            );
            
            
            
            //nếu tồn tại tham số hãng
            
            if ($nameBrand) {
               
                if ($nameCategory == 'may-anh') {
                    //người dùng chọn loại
                    if ($type != "all") { //Body hoặc lens

                        $where = array(
                                
                            "alias_name" => $type, //Body hoặc lens
                            
                            "id_parent_category" => $category->id 
                            
                        );
                            
                        //get danh mục phân loại nhỏ 2 (vd: body, lens)
                        $parentCategory = $this->category_product_model->get_info_rule($where);

                        //kiểm tra có tồn tại không
                        if(!$parentCategory)
                            redirect(base_url()."danhmucsanpham/".$nameCategory);

                        //người dùng chọn hãng con
                        if ($nameBrand != "all")
                        {
                            $where = array(
                                
                                "alias_name" => $nameBrand, //ốp lưng
                                
                                "id_parent_category" => $parentCategory->id 
                                
                            );
        
                            $childCategory = $this->category_product_model->get_info_rule($where);

                            //kiểm tra có tồn tại không
                            if(!$childCategory)
                                redirect(base_url()."danhmucsanpham/".$nameCategory."?type=".$type);

                            $input['where']["id_category"] = $childCategory->id;

                        }
                        //người dùng không chọn hãng con
                        else {
                            $input['where']["id_parent_category_2"] = $parentCategory->id;
                        }
                        
                    }
                    //người dùng không chọn loại => $type = all
                    else { 

                        //người dùng không chọn hãng con
                        if($nameBrand != "all")
                        {

                            //điều kiện lấy danh sách các phân loại thuộc danh mục lơn MÁY ẢNH
                            $whereType['where'] = array(
                                'id_parent_category' => $category->id
                            );

                            //danh sách các phân loại thuộc danh mục lơn MÁY ẢNH
                            $listType = $this->category_product_model->get_list($whereType);

                            //biến để kiểm tra
                            $count = 0;

                            //trường hợp tên hãng bị trùng. ví dụ: Body và Lens đều có hãng Toshiba
                            foreach ($listType as $row) {
                                $where = array(

                                    "alias_name" => $nameBrand,
                                    
                                    "id_parent_category" => $row->id
                                );
                                //get danh mục hãng con (vd: Toshiba)
                                $childBrand = $this->category_product_model->get_info_rule($where);

                                //kiểm tra có tồn tại không
                                if($childBrand) {

                                    //nếu không bị trùng tên hãng
                                    if($count < 1)
                                        //điều kiện lấy tất cả sản phẩm thuộc hãng con
                                        $input["where"]["id_category"] = $childBrand->id;
                                    //nếu bị trùng tên hãng
                                    else 
                                        $input["or_where"]["id_category"] = $childBrand->id;

                                    $count++;
                                }
                            }
                            if($count == 0)
                                    redirect(base_url()."danhmucsanpham/".$nameCategory);
                            
                        }
                        else
                        //điều kiện lấy tất cả sản phẩm thuộc danh mục lớn máy ảnh
                            $input["where"]["id_parent_category"] = $category->id;
                    }
                }   
                else {             
                    if ($nameBrand != "all") {
                        
                        
                        
                        $where = array(
                        
                        "alias_name" => $nameBrand,
                        
                        "id_parent_category" => $category->id
                        
                        );
                        
                        
                        
                        $brand = $this->category_product_model->get_info_rule($where);
                        
                        
                        
                        if (!$brand) {
                            
                            redirect(base_url()."danhmucsanpham/dien-thoai");
                            
                        }
                        
                        else
                            
                        {
                            
                            $idBrand = $brand->id;
                            
                            $input["where"] = array(
                            
                            "id_category" => $idBrand
                            
                            );
                            
                        }
                        
                    }
                    
                    else
                        
                    {
                        
                        $input["where"] = array(
                        
                        "id_parent_category" => $category->id
                        
                        );
                        
                    }
                }
            }
            
            
            
            //nếu tồn tại tham số giá
            
            if ($price) {
                if ($nameCategory == 'dien-thoai') {
                    if ($price == "1") {
                        
                        $input["where"]["price<"] = "5000000";
                        
                    }
                    
                    if ($price == "2") {
                        
                        $input["where"]["price>="] = "5000000";
                        
                        $input["where"]["price<="] = "8000000";
                        
                    }
                    
                    if ($price == "3") {
                        
                        $input["where"]["price>"] = "8000000";
                        
                    }
                }
                else if ($nameCategory == 'all-in-one') {
                    if ($price == "1") {
                        
                        $input["where"]["price<"] = "10000000";
                        
                    }
                    
                    if ($price == "2") {
                        
                        $input["where"]["price>="] = "10000000";
                        
                        $input["where"]["price<="] = "15000000";
                        
                    }
                    if ($price == "3") {
                        
                        $input["where"]["price>="] = "15000000";
                        
                        $input["where"]["price<="] = "20000000";
                        
                    }
                    if ($price == "4") {
                        
                        $input["where"]["price>"] = "20000000";
                        
                    }
                }
                else if ($nameCategory == 'beats') {
                    if ($price == "1") {
                        
                        $input["where"]["price<"] = "1000000";
                        
                    }
                    
                    if ($price == "2") {
                        
                        $input["where"]["price>="] = "1000000";
                        
                        $input["where"]["price<="] = "3000000";
                        
                    }
                    if ($price == "3") {
                        
                        $input["where"]["price>="] = "3000000";
                        
                        $input["where"]["price<="] = "5000000";
                        
                    }
                    if ($price == "4") {
                        
                        $input["where"]["price>"] = "5000000";
                        
                    }
                }
                else {
                    
                    
                    
                    if ($price == "1") {
                        
                        $input["where"]["price<"] = "1000000";
                        
                    }
                    
                    if ($price == "2") {
                        
                        $input["where"]["price>"] = "1000000";
                        
                        $input["where"]["price<"] = "5000000";
                        
                    }
                    
                    if ($price == "3") {
                        
                        $input["where"]["price>"] = "5000000";
                        
                        $input["where"]["price<"] = "10000000";
                        
                    }
                    
                    if ($price == "4") {
                        
                        $input["where"]["price>"] = "10000000";
                        
                        $input["where"]["price<"] = "20000000";
                        
                    }
                    
                    if ($price == "5") {
                        
                        $input["where"]["price>"] = "20000000";
                        
                    }
                }
                
                
            }
            
            
            
            //nếu tồn tại tham số sắp xếp
            
            if ($order) {
                
                
                
                if ($order == "1") {
                    
                    $input['order'] = array('price','ACS');
                    
                }
                
                else if ($order == "2") {
                    
                    $input['order'] = array('price','DESC');
                    
                }
                else
                //điều kiện thêm của Thuận
                //nếu người dùng chọn sắp xếp tăng dần hoặc giảm dần theo giá thì
                //sẽ không chạy điều kiện này
                $input['order']['order'] = 'COALESCE(sort_by_cate, "zz") ASC';
            }
            else
            {
                //điều kiện thêm của Thuận
                //nếu người dùng chọn sắp xếp tăng dần hoặc giảm dần theo giá thì
                //sẽ không chạy điều kiện này
                 $input['order']['order'] = 'COALESCE(sort_by_cate, "zz") ASC';
            }
            
            //nếu tồn tại tham số kích thước màn hình
            
            if ($screen) {
                
                if ($screen == "1") {
                    
                    $input["where"]["screen<"] = "14";
                    
                    $input["where"]["screen>"] = "0";
                    
                }
                
                if ($screen == "2") {
                    
                    $input["where"]["screen<="] = "16";
                    
                    $input["where"]["screen>="] = "14";
                    
                }
                
                if ($screen == "3") {
                    
                    $input["where"]["screen>"] = "16";
                    
                }
                
                // }
                
            }
            
            
            
            if ($lens) {
                
                if ($lens == "1") {
                    
                    $input["where"]["lens<"] = "20";
                    
                    $input["where"]["lens>"] = "0";
                    
                }
                
                if ($lens == "2") {
                    
                    $input["where"]["lens<="] = "30";
                    
                    $input["where"]["lens>="] = "20";
                    
                }
                
                if ($lens == "3") {
                    
                    $input["where"]["lens<="] = "40";
                    
                    $input["where"]["lens>="] = "30";
                    
                }
                
                if ($lens == "4") {
                    
                    $input["where"]["lens<="] = "50";
                    
                    $input["where"]["lens>="] = "40";
                    
                }
                
                if ($lens == "5") {
                    
                    $input["where"]["lens>"] = "50";
                    
                }
                
            }
            
            
            
            if ($type) {
                //nếu trang đó là trang phụ kiện. trường hợp đặc biệt
                if ($nameCategory == 'phu-kien') {
                    if ($type != "all") { //phu-kien-dien-thoai
                        
                        $where = array(
                            
                            "alias_name" => $type, //phu-kien-dien-thoai
                            
                            "id_parent_category" => $category->id 
                            
                        );
                            
                        //get danh mục cha nhỏ 2 (vd: phu-kien-dien-thoai)
                        $parentCategory = $this->category_product_model->get_info_rule($where);

                        //kiểm tra có tồn tại không
                        if(!$parentCategory)
                            redirect(base_url()."danhmucsanpham/".$nameCategory);
    
                        //điều kiện lấy các danh mục con của phụ kiện điện thoại hoặc laptop
                        $whereSubPro['where'] = array(
                            'id_parent_category' => $parentCategory->id
                        );

                        //lấy các danh mục con của phụ kiện điện thoại hoặc laptop
                        $listSubProductAcc = $this->category_product_model->get_list($whereSubPro);

                        //điều kiện lấy sản phẩm
                        $input['where']['id_parent_category_2'] = $parentCategory->id;
                        
                    }
                    
                    else
                    {
                        //lấy các danh mục con
                        $listSubProductAcc = array();
    
                        //hiện tại $listBrand = { Body, Lens }
                        foreach ($listBrand as $row) {

                            //điều kiện lấy các danh mục con theo $listBrand ở trên
                            $where['where'] = array(
                                'id_parent_category' => $row->id
                            );

                            //lặp lần 1: $listTempt = {Toshiba, Sony ....}
                            //lặp lần 2: $listTempt = {Sam Sung, Canon ....}
                            $listTempt = $this->category_product_model->get_list($where);

                            //ghép các lần lặp lại để được tất cả danh mục con của danh muc cha LOẠI
                            foreach ($listTempt as $tempt) {
                                $check = 0;
                                //loại bỏ những tên hãng bị trùng
                                foreach($listSubProductAcc as $subBrand)
                                {
                                    if($subBrand->alias_name === $tempt->alias_name)
                                    $check++;
                                }
                                if($check == 0) {
                                    $listSubProductAcc[] = $tempt;
                                }
                            }                
                        }
                        
                    }
                } 
                else if ($nameCategory == 'may-anh') {
                    //người dùng chọn loại 
                    if ($type != "all") { //Body hoặc lens
                        
                        $where = array(
                            
                            "alias_name" => $type, //Body hoặc lens
                            
                            "id_parent_category" => $category->id 
                            
                        );
                            
                        //get danh mục phân loại nhỏ 2 (vd: Body, Lens)
                        $parentCategory = $this->category_product_model->get_info_rule($where);

                        //kiểm tra có tồn tại không
                        if(!$parentCategory)
                            redirect(base_url()."danhmucsanpham/".$nameCategory);
    
                        //điều kiện lấy các hãng con của danh mục phân loại
                        $whereSubBrand['where'] = array(
                            'id_parent_category' => $parentCategory->id
                        );

                        //lấy các danh mục con của danh mục phân loại
                        $listSubBrand = $this->category_product_model->get_list($whereSubBrand);

                        //điều kiện lấy sản phẩm
                        $input['where']['id_parent_category_2'] = $parentCategory->id;
                        
                    }
                    //người dùng không chọn loại 
                    else
                    {
                        //lấy các hãng con
                        $listSubBrand = array();
    
                        //hiện tại $listBrand = { Body, Lens }
                        foreach ($listBrand as $row) {

                            //điều kiện lấy các danh mục con theo $listBrand ở trên
                            $where['where'] = array(
                                'id_parent_category' => $row->id
                            );

                            //lặp lần 1: $listTempt = {Toshiba, Sony ....}
                            //lặp lần 2: $listTempt = {Sam Sung, Canon ....}
                            $listTempt = $this->category_product_model->get_list($where);

                            //ghép các lần lặp lại để được tất cả danh mục con của danh muc cha LOẠI
                            foreach ($listTempt as $tempt) {
                                $check = 0;
                                //loại bỏ những tên hãng bị trùng
                                foreach($listSubBrand as $subBrand)
                                {
                                    if($subBrand->alias_name === $tempt->alias_name)
                                    $check++;
                                }
                                if($check == 0) {
                                    $listSubBrand[] = $tempt;
                                }
                            }                
                        }
                        
                    }
                }   
                else
                {
                    if ($type != "all") {
                        
                        
                        
                        $where = array(
                        
                        "alias_name" => $type,
                        
                        "id_parent_category" => $category->id
                        
                        );
                        
                        
                        
                        $brand = $this->category_product_model->get_info_rule($where);
                        
                        
                        
                        if (!$brand) {
                            
                            redirect(base_url()."danhmucsanpham/dien-thoai");
                            
                        }
                        
                        else
                            
                        {
                            
                            $idBrand = $brand->id;
                            
                            $input["where"]["id_category"] = $idBrand;
                            
                        }
                        
                    }
                    
                    else
                        
                    {
                        
                        $input["where"]["id_parent_category"] = $category->id;
                        
                    }
                }
            }
            
            if ($subPro)
            {
                
                //người dùng chọn loại phụ kiện
                if ($type != "all") { //phu-kien-dien-thoai

                    $where = array(
                            
                        "alias_name" => $type, //phu-kien-dien-thoai
                        
                        "id_parent_category" => $category->id 
                        
                    );
                        
                    //get danh mục cha nhỏ 2 (vd: phu-kien-dien-thoai)
                    $parentCategory = $this->category_product_model->get_info_rule($where);

                    //kiểm tra có tồn tại không
                    if(!$parentCategory)
                        redirect(base_url()."danhmucsanpham/".$nameCategory);

                    //người dùng chọn loại phụ kiện con
                    if ($subPro != "all")
                    {
                        $where = array(
                            
                            "alias_name" => $subPro, //ốp lưng
                            
                            "id_parent_category" => $parentCategory->id 
                            
                        );
    
                        $childCategory = $this->category_product_model->get_info_rule($where);

                        //kiểm tra có tồn tại không
                        if(!$childCategory)
                            redirect(base_url()."danhmucsanpham/".$nameCategory."?type=".$type);

                        $input['where']["id_category"] = $childCategory->id;

                    }
                    //người dùng không chọn loại phụ kiện con
                    else {
                        $input['where']["id_parent_category_2"] = $parentCategory->id;
                    }
                    
                }
                //người dùng không chọn loại phụ kiện => $type = all
                else { 

                    //người dùng chọn loại phụ kiện con
                    if($subPro != "all")
                    {
                        //điều kiện lấy danh sách các phân loại thuộc danh mục PHỤ KIỆN
                        $whereSubPro['where'] = array(
                            'id_parent_category' => $category->id
                        );

                        //danh sách các phân loại thuộc danh mục lơn PHỤ KIỆN
                        $listSubPro = $this->category_product_model->get_list($whereSubPro);

                        //biến để kiểm tra
                        $count = 0;

                        //trường hợp tên loại sản phẩm bị trùng. ví dụ: PK điện thoại và PK laptop đều có loại sản phẩm Tai Nghe
                        foreach ($listSubPro as $row) {
                            $where = array(

                                "alias_name" => $subPro,
                                
                                "id_parent_category" => $row->id
                            );
                            //get tên loại sản phẩm (vd: Tai Nghe)
                            $childSubPro = $this->category_product_model->get_info_rule($where);

                            //kiểm tra có tồn tại không
                            if($childSubPro) {

                                //nếu không bị trùng tên hãng
                                if($count < 1)
                                    //điều kiện lấy tất cả sản phẩm thuộc hãng con
                                    $input["where"]["id_category"] = $childSubPro->id;
                                //nếu bị trùng tên hãng
                                else 
                                    $input["or_where"]["id_category"] = $childSubPro->id;

                                $count++;
                            }
                        }
                        if($count == 0)
                                redirect(base_url()."danhmucsanpham/".$nameCategory);
                    }
                    else
                    //điều kiện lấy tất cả sản phẩm thuộc danh mục phụ kiện
                        $input["where"]["id_parent_category"] = $category->id;
                }
            }
            
            //điều kiện các sản phẩm cho phép hiển thị

            $input['where']['is_show'] = 1;


            //lấy tổng số sản phẩm theo điều kiện
            
            $listProduct = $this->product_model->get_list($input);
            
            $totalRows = get_total_rows($listProduct);
            
            
            
            //phân trang
            
            $start = 0;
            
            if($page > 0)
            
            $start = ($page-1) * $per_page;
            
            
            
            $input['limit'] = array($per_page,$start);
            
            $listProduct = $this->product_model->get_list($input);
            
            $url = base_url()."danhmucsanpham/".$nameCategory;
            
            $pagination = $this->mypagination->getPagination($url,$totalRows, $per_page);
            
        }
        
        else
            
        {
            
            //load bình thường
            
            //lấy tổng số sản phẩm thuộc danh mục điện thoại
            
            $input['where'] = array(
            
            "id_parent_category" => $category->id,

            "is_show" => 1
            
            );

            //điều kiện thêm của Thuận
                //nếu người dùng chọn sắp xếp tăng dần hoặc giảm dần theo giá thì
                //sẽ không chạy điều kiện này
            $input['order'] = array('order' => 'COALESCE(sort_by_cate, "zz") ASC');
            
            
            
            $listProduct = $this->product_model->get_list($input);
            
            $totalRows = get_total_rows($listProduct);
            
            
            
            //phân trang
            
            $start = 0;
            
            if($page > 0)
            
            $start = ($page-1) * $per_page;
            
            
            
            $input['limit'] = array($per_page,$start);
            
            $listProduct = $this->product_model->get_list($input);
            
            $url = base_url().'danhmucsanpham/'.$nameCategory;
            
            $pagination = $this->mypagination->getPagination($url,$totalRows, $per_page);
            
        }

        //lấy url video của product
        
        foreach($listProduct as $product)
        
        {
            
            //lấy giá VNĐ
            
            $product->priceVND = vnd($product->price);
            
            //lấy giá khuyến mãi
            
            if($product->discount > 0) {
                
                $priceDiscount = $product->price -  $product->discount;
                
                $product->priceDiscount = vnd($priceDiscount);
                
            }
            
        }
        
        
        
        //lấy video
        
        $video = array();
        
        foreach ($listProduct as $item) {
            
            $video[] = $item->video;
            
        }
        
        
        
        //list sản phẩm trong giỏ hàng
        
        $listProductInCart = $this->cart->contents();
        
        
        
        //lưu radio checked
        
        $data['option'] = $option;

        $data['listSubBrand'] = $listSubBrand;

        $data['listSubProductAcc'] = $listSubProductAcc;
        
        $data['listProductInCart'] = $listProductInCart;
        
        $data['nameCategory'] = $nameCategory;
        
        $data['nameCategoryNoAlias'] = $category->name;
        
        $data['listBrand'] = $listBrand;
        
        $data['listProduct'] = $listProduct;
        
        $data['pagination'] = $pagination;
        
        $data['video'] = $video;
        
        $data['page'] = 'site/pages/category_product';
        
        $this->load->view('site/master_layout', $data);
        
    }
    
    
    
    public function show()
    
    {
        
        $idProduct = $this->uri->segment(2);
        
        $product = $this->product_model->get_info($idProduct);
        
        
        
        //lay danh muc lon
        
        $idParentCategory = $product->id_parent_category;
        
        $parentCategory = $this->category_product_model->get_info($idParentCategory);
        
        $url = $parentCategory->alias_name;
        
        
        
        if (!$product) {
            
            redirect(base_url("danhmucsanpham"));
            
        }
        
        
        
        //list sản phẩm trong giỏ hàng
        
        $listProductInCart = $this->cart->contents();
        
        
        
        //lấy url video của product
        
        $video = array();
        
        $video[] = $product->video;
        
        
        
        
        
        //giá khuyến mãi
        
        if($product->discount > 0) {
            
            $priceDiscount = $product->price -  $product->discount;
            
            $product->priceDiscount = vnd($priceDiscount);
            
        }
        
        
        
        //giá VND
        
        $product->priceVND = vnd($product->price);
        
        //lấy list ảnh nhỏ
        
        $listImageThumb = json_decode($product->image_list_thumb);
        
        $product->listImageThumb = '';
        
        if ($listImageThumb) {
            
            $product->listImageThumb = $listImageThumb;
            
        }

        
        
        
        $data['listImageThumb'] = $listImageThumb;
        
        $data['listProductInCart'] = $listProductInCart;
        
        $data['info'] = $product;
        
        $data['video'] = $video;
        
        $data['page'] = 'site/pages/product';
        
        $data['parentCategory'] = $parentCategory;
        
        $this->load->view('site/master_layout', $data);
        
    }
    
    
    
}



/* End of file Product.php */

/* Location: ./application/controllers/Product.php */