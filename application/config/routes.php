
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'site/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
 * API routes
 */
$route['api/danhmucsanpham/:any'] = 'api/category_product/index';
$route['api/search']['post'] = 'api/search/search';
$route['api/historyvideo']['post'] = 'api/historyVideo/index';
/**
 * Site routes
 */
$route['timkiem'] = 'api/product/search';
$route['search'] = 'site/home/search';

$route['danhmucsanpham/(:any)'] = 'site/product/index';
$route['danhmucsanpham/(:any)/:num'] = 'site/product/index';
$route['sanpham/:num'] = 'site/product/show';

$route['giohang/(:any)'] = 'site/cart/index/(:any)';
$route['giohang'] = 'site/cart/index';
$route['themgiohang/(:any)'] = 'site/cart/add_ajax';
$route['addtocart/(:num)'] = 'site/cart/add/$1';
$route['deletefromdetail'] = 'site/cart/delete';


$route['tintuc/(:num)'] = 'site/news/index/$1';
$route['tintuc'] = 'site/news/index';
$route['tintuc/chitiet'] = 'site/news/show';
$route['quenmatkhau'] = 'site/forgot/reset';
$route['resetpassword/(:any)'] = 'site/forgot/resetpassword/$1';
/*Verify Register*/
$route['verify'] = 'site/verifyRegister/index';
$route['verify/:any'] = 'site/verifyRegister/index/$1';



/**
 * ===================Admin routes===============
 */
/*Special*/
$route['admin/home'] = 'admin/home/index';
$route['admin/404'] = 'admin/home/error';
/*Profile*/
$route['admin/thongtin'] = 'admin/admin/index';
$route['admin/capnhatthongtin'] = 'admin/admin/update';
/*Product*/
$route['admin/sanpham'] = 'admin/product/index';
$route['admin/sanpham/:num'] = 'admin/product/index';
$route['admin/sanpham/them'] = 'admin/product/create';
$route['admin/sanpham/sapxep'] = 'admin/product/sort';
$route['admin/sanpham/timkiem'] = 'admin/product/search';
$route['admin/sanpham/sua/:num'] = 'admin/product/update';
$route['admin/sanpham/update'] = 'admin/product/updateAPI';
$route['admin/sanpham/xoa/:num'] = 'admin/product/delete';
/*Category-product*/
$route['admin/danhmucsanpham'] = 'admin/category_product/index';
$route['admin/danhmucsanpham/them'] = 'admin/category_product/create';
$route['admin/danhmucsanpham/sua/:num'] = 'admin/category_product/update';
$route['admin/danhmucsanpham/sua'] = 'admin/category_product/update';
$route['admin/danhmucsanpham/xoa/:num'] = 'admin/category_product/delete';
/*Account*/
$route['admin/login'] = 'admin/account/login';
$route['admin/logout'] = 'admin/account/logout';
$route['admin/isDisconnect'] = 'admin/account/isDisconnect';


/*News*/
$route['admin/tintuc'] = 'admin/news/index';
$route['admin/tintuc/(:num)'] = 'admin/news/index';
$route['admin/tintuc/them'] = 'admin/news/create';
$route['admin/tintuc/sua'] = 'admin/news/update';
$route['admin/tintuc/sua/:num'] = 'admin/news/update';
$route['admin/tintuc/xoa'] = 'admin/news/delete';
$route['admin/tintuc/xoa/:num'] = 'admin/news/delete';
/*Category_news*/
$route['admin/danhmuctintuc'] = 'admin/category_news/index';
$route['admin/danhmuctintuc/them'] = 'admin/category_news/create';
$route['admin/danhmuctintuc/sua'] = 'admin/category_news/update';
$route['admin/danhmuctintuc/sua/:num'] = 'admin/category_news/update';
$route['admin/danhmuctintuc/xoa'] = 'admin/category_news/delete';
$route['admin/danhmuctintuc/xoa/(:num)'] = 'admin/category_news/delete';
/*Order*/
$route['admin/donhang'] = 'admin/order/index';
$route['admin/chitietdonhang'] = 'admin/order/detail';
/*Employee*/
$route['admin/nhanvien'] = 'admin/employee/index';
$route['admin/nhanvien/capnhat/:num'] = 'admin/employee/history_update';
$route['admin/nhanvien/capnhat/:num'] = 'admin/employee/history_update';
$route['admin/capnhatnhanvien'] = 'admin/employee/update';
$route['admin/capnhatnhanvien/:num'] = 'admin/employee/update';
$route['admin/xoanhanvien/:num'] = 'admin/employee/delete';
$route['admin/quanlihoatdong'] = 'admin/employee/control_employee';

/*Info*/
$route['admin/menu'] = 'admin/info/menu';
$route['admin/gioithieu'] = 'admin/info/about';
$route['admin/copyright'] = 'admin/info/copyright';
$route['admin/dichvu'] = 'admin/info/service';
$route['admin/upload'] = 'admin/upload/index';

/*Profile*/
$route['admin/thongtin'] = 'admin/profile/index';
$route['admin/capnhatthongtin'] = 'admin/profile/update';
$route['admin/doimatkhau'] = 'admin/profile/change_password';
/*Manage vidieo*/
$route['admin/videonoibat'] = 'admin/videoHighLight/index';
$route['admin/videosanpham'] = 'admin/videoProduct/index';
$route['admin/videosanpham/:num'] = 'admin/videoProduct/index/$1';



/*Slider*/

$route['admin/slider'] = 'admin/slider/index';

$route['admin/slider/them'] = 'admin/slider/create';

$route['admin/slider/sua'] = 'admin/slider/update';

$route['admin/slider/sua/(:num)'] = 'admin/slider/update';

$route['admin/slider/xoa'] = 'admin/slider/delete';

$route['admin/slider/xoa/(:num)'] = 'admin/slider/delete';
