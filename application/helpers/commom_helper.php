<?php

function public_url($url = '')

{

	return base_url('public/' . $url);

}



function randomHash()

{

	$num = rand(10, 1000);

	$hash = md5(md5($num));

	return $hash;

}



function admin_url($url = '')

{

	return base_url('admin/' . $url);

}



function upload_image_url($url = '')

{

	return base_url('upload/image/' . $url);

}



function randomNumber() {

	return rand(100, 999);

}



function get_date($time, $full = true) {

	$date = date("d-m-Y H:i:s", strtotime($time));

	return $date;

}



function toAlias ($str){

	$unicode = array(

		'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

		'd'=>'đ',

		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

		'i'=>'í|ì|ỉ|ĩ|ị',

		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

		'y'=>'ý|ỳ|ỷ|ỹ|ỵ',

		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

		'D'=>'Đ',

		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

		'I'=>'Í|Ì|Ỉ|Ĩ|Ị',

		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

	);

	

	foreach($unicode as $nonUnicode=>$uni){

		$str = preg_replace("/($uni)/i", $nonUnicode, $str);

	}



	$str = preg_replace('/ /i', '-', $str);



	return $str;

}



function vnd($money) {

	$symbol = 'đ';

	$symbol_thousand = '.';

	$decimal_place = 0;

	$price = number_format($money, $decimal_place, '', $symbol_thousand);

	return $price.$symbol;

}



function addThumb($str) {

	$array = explode('.', $str);

	$thumb = $array[0] . '_thumb.' . $array[1];

	return $thumb;

}



function addThumbList($json) {

	$list = json_decode($json);



	$listThumb = array();



	foreach ($list as $item) {

		$listThumb[] = addThumb($item);

	}



	return json_encode($listThumb);

}





function cut($str, $length = 10) {

	return substr($str, 0, $length);

}



function get_total_rows($list) {

	$count = 0;

	foreach($list as $row)

	{

		$count++;

	}

	return $count;

}



function getDatetimeNow() {

	$tz_object = new DateTimeZone('Asia/Saigon');

    //date_default_timezone_set('Asia/Saigon');



	$datetime = new DateTime();

	$datetime->setTimezone($tz_object);

	return $datetime;

}





function getTimeCreated($dateCreate) {

	//lấy ngày giờ hôm nay

	$toDay = getDatetimeNow();



	$tz_object = new DateTimeZone('Asia/Saigon');

	

	$date = new DateTime($dateCreate);

	//set khu vực cho biến

	$date->setTimezone($tz_object);

	$year = $toDay->diff($date)->y;

	$month = $toDay->diff($date)->m;

	$day = $toDay->diff($date)->d;

	$hour = $toDay->diff($date)->h;

	$minute = $toDay->diff($date)->i;

	$second = $toDay->diff($date)->s;



	$result = '';

	

	if ($year <= 0) {

		if ($month <= 0) {

			if ($day <= 0) {

				if ($hour <=0) {

					if ($minute <=0) {

						if ($second >0)

							$result = "Vừa xong";

					}

					else {

						$result = $minute." phút trước";

					}

				}

				else {

					$result = $hour." giờ trước";

				}

				

			}

			else {

				$result = $day." ngày trước";

			}

		}

		else {

			$result = $month." tháng trước";

		}

	}

	else {

		$result = $year." năm trước";

	}

	return $result;

}