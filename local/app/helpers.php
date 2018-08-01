<?php
	function cut_string($text, $length)
	{
	    if(strlen($text) > $length) {
	    	$text = $text.' ';
	        $text = substr($text, 0, strpos($text, ' ', $length)).'...';
	    }
	    return $text;
	}
	function cut_string_name($text, $length)
	{
	    $check = strlen($text) > $length;
	    if(strlen($text) > $length) {
	    	$text = $text.' ';
	        $text = substr($text, 0, $length).'...';
	    }

	    $tmp = explode(' ',$text);
	    if($check) unset($tmp[count($tmp) - 1]);
	    if($check){
            $text = implode(' ',$tmp).'...';
        }else {
            $text = implode(' ',$tmp);
        }

	    return $text;
	}

	function get_status($status){
	    $str = '';
        switch ($status){
            case 0 : $str = "Tắt";break;
            case 1 : $str = "Đang đăng";break;
            case 2 : $str = "Chờ duyệt lần 2";break;
            case 3 : $str = "Chờ duyệt lần 1";break;
            case 4 : $str = "Trả lại";break;
        }
        return $str;
    }


	/**
     * Save all images in request and resized copies of them.
     *
     * @return implode(',' , 'all images with new names');
     */

	function textTest($length){
		$text = "Đây chỉ là một đoạn text vô nghĩa , không mang chức năng gì nhiều . Cảm ơn bạn đã chú ý và đọc đoạn text này của chúng tôi. Quyến đẹp troai hân hạnh tài trợ chương trình này";
		if(strlen($text) > $length) {
	    	$text = $text.' ';
	        $text = substr($text, 0, strpos($text, ' ', $length)).'...';
	    }
	    return $text;
	}
	function saveImage($input,$resized_size,$path){
	    $imgArr = [];
	    $max_size = $resized_size;
	    foreach ($input as $image) {

	        $filename = 'img_'.date("Y-m-d").'_'.round(microtime(true)).'.'.$image->extension();
	        $image->storeAs($path,$filename);
	        $imgArr[] = $filename;

	        $image_info = getimagesize($image);
	        $width_orig  = $image_info[0];
	        $height_orig = $image_info[1];

	        $ratio = $width_orig/$height_orig;
	        if($ratio>=1){
	            $width=$max_size;
	            $height=$width/$ratio;
	        }else{
	            $height=$max_size;
	            $width=$height*$ratio;
	        }
	        $destination_image = imagecreatetruecolor($width, $height);

	        $type_org = $image->extension();
	        switch ($type_org) {
	            case 'jpeg':
	            $orig_image = imagecreatefromjpeg($image);
	            imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	            imagejpeg($destination_image, 'local/storage/app/'.$path.'/resized-'.$filename);
	            break;

	            case 'jpg':
	            $orig_image = imagecreatefromjpeg($image);
	            imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	            imagejpeg($destination_image, 'local/storage/app/'.$path.'/resized-'.$filename);
	            break;

	            case 'png':
	            $orig_image = imagecreatefrompng($image);
	            imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	            imagepng($destination_image, 'local/storage/app/'.$path.'/resized-'.$filename);
	            break;

	            case 'gif':
	            $orig_image = imagecreatefromgif($image);
	            imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	            imagegif($destination_image, 'local/storage/app/'.$path.'/resized-'.$filename);
	            break;
	        }
	    }
	    return implode(',',$imgArr);
	}

	function time_format($time){
		if ($time == null) {
			return 'lỗi';
		}
		else{
			$date = new DateTime();
			$date = strtotime(date_format($date,"Y-m-d h:m:s"));
			$time = strtotime(date_format($time,"Y-m-d h:m:s"));
			// echo $date . "----" . $time;
			// return $date.' - '.$time;
			$year = 31526000;
			$month = 2592000;
			$day = 86400;
			$hour = 3600;
			$min = 60;
			// strtotime(date_format($time,"Y-m-d")) == strtotime(date_format($date,"Y-m-d"))
			if ($time < $date-$year) {
				return round(($date-$time)/$year).' năm';
			}
			else if($time < $date-$month){
				return round(($date-$time)/$month).' tháng';
			}
			else if ($time < $date-$day) {
				return round(($date-$time)/$day).' ngày';
			}
			else if ($time < $date-$hour) {
				return round(($date-$time)/$hour).' giờ';
			}
			else if ($time < $date-$min) {
				return round(($date-$time)/$min).' phút';
			}
			else{
				return 'bây giờ';
			}
		}
			

	}



	function getUrl() {
	    $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
	    $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
	    $url .= $_SERVER["REQUEST_URI"];
	    return $url;
    }

    function aff_profit($amount){
    	if ($amount > 150000000) {
    		return $amount*0.3;
    	}
    	if ($amount > 61000000) {
    		return $amount*0.22;
    	}
    	if ($amount > 31000000) {
    		return $amount*0.18;
    	}
    	if ($amount > 11000000) {
    		return $amount*0.14;
    	}
    	if ($amount > 1000000) {
    		return $amount*0.11;
    	}
    	else{
    		return $amount*0.1;
    	}
    }
    function level_format($level){
    	switch ($level) {
    		case 1:
    			return 'SuperAdmin';
    			break;
    		case 2:
    			return 'Phó tổng biên tập';
    			break;
    		case 3:
    			return 'Biên tập viên';
    			break;
    		case 4:
    			return 'Phóng viên';
    			break;
    		default:
    			return 'Lỗi';
    			break;
    	}
    }
