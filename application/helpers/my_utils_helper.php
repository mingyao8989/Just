<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if( ! function_exists('my_show_message')) {
	function my_show_message($msg = "") {
		if ($msg != '') {
			echo '<h4 class="alert_info">'.$msg.'</h4>';
		}
	}
}

if( ! function_exists('my_show_error')) {
	function my_show_error($msg = "") {
		if ($msg != '') {
			echo '<h4 class="alert_error">'.$msg.'</h4>';
		}
	}
}

if( ! function_exists('my_img_url')) {
	function my_img_url($img) {
		return "static/images/".$img;
	}
}

if( ! function_exists('my_icon')) {
	function my_icon($name, $alt = 'icon', $size = 16) {
		$alt = htmlspecialchars($alt);
		return '<img src="' . my_img_url("icons/$size/$name.png") . "\" width=\"$size\" height=\"$size\" alt=\"$alt\" title=\"$alt\" />";
	}
}

if( ! function_exists('my_cut_str')) {
	function my_cut_str($str, $len=20, $suffix="…") {
		$s = substr($str, 0, $len);
		$cnt = 0;
		for ($i=0; $i<strlen($s); $i++)
			if (ord($s[$i]) > 127)
			$cnt++;

		$s = substr($s, 0, $len - ($cnt % 3));

		if (strlen($s) >= strlen($str))
			$suffix = "";
		return $s . $suffix;
	}
}

if( ! function_exists('my_segment_explode')) {
	function my_segment_explode($seg) {
		$len = strlen($seg);
		if(substr($seg, 0, 1) == '/') {
			$seg = substr($seg, 1, $len);
		}
		$len = strlen($seg);
		if(substr($seg, -1) == '/') {
			$seg = substr($seg, 0, $len-1);
		}
		$seg_exp = explode("/", $seg);
		return $seg_exp;
	}
}

if( ! function_exists('my_get_param')) {
	function my_get_param($seg, $key, $default = "") {
		if(in_array($key, $seg)) {
			$arr_key = array_keys($seg, $key);
			$arr_val = $arr_key[0] + 1;
			if(@$seg[$arr_val]){
				return $seg[$arr_val];
			} else {
				return $default;
			}
		} else {
			return $default;
		}
	}
}

if( ! function_exists('my_switch_param')) {
	function my_switch_param($seg, $key, $value="") {
		if(in_array($key, $seg)) {
			$arr_key = array_keys($seg, $key);
			$arr_val = $arr_key[0] + 1;
			if(@$seg[$arr_val]){
				if ($value == "") {
					unset($seg[$arr_val - 1]);
					unset($seg[$arr_val]);
				} else {
					$seg[$arr_val] = $value;
				}
			} else {
				if ($value == "") {
					unset($seg[$arr_val - 1]);
				} else {
					$seg[$arr_val] = $value;
				}
			}
		} elseif ($value != "") {
			$seg[] = $key;
			$seg[] = $value;
		}

		return site_url(implode('/', $seg));
	}
}

if( ! function_exists('my_ext_param')) {
	function my_ext_param($seg, $index) {
		$ext_params = "";
		for ($i = $index; $i < count($seg); $i ++) {
			$ext_params.=("/".$seg[$i]);
		}

		return $ext_params;
	}
}

if( ! function_exists('my_datenow')) {
	function my_datenow() {
		return date('Y-m-d H:i:s');
	}
}

if( ! function_exists('my_get_format_datetime')) {
	function my_get_format_datetime($time, $timezone='', $format = 'm/d/Y H:i:s') {
		if ($timezone != '') {
			if ( substr($timezone, 0, 1) == "+" ) {
				$timezone = "-".substr($timezone, 1);
			} elseif ( substr($timezone, 0, 1) == "-" ) {
				$timezone = "+".substr($timezone, 1);
			}
			
			return date($format, strtotime($timezone, $time));
		} else {
			return date($format, $time);
		}
	}
}

if( ! function_exists('my_get_after_time')) {
	function my_get_after_time($regtime, $timezone='', $format = 'm/d/Y H:i:s') {
		$diff = time() - $regtime + 1; //Find the number of seconds
		$day_difference = ceil($diff / (60*60*24)) ;  //Find how many days that is
		$hour_difference = ceil($diff / (60*60)) ;
		$minute_difference = ceil($diff / 60) ;

		$after_date = "";
		if($day_difference <= 1) {
			if ($hour_difference <= 1) {
				$after_date = $minute_difference." minutes ago";
			} else {
				$after_date = $hour_difference." hours ago";
			}
		} /*elseif($day_difference <= 7) {
		$after_date = $day_difference." ";
		}*/ else {
			$after_date = my_get_format_datetime($regtime, $timezone, $format);
		}

		return $after_date;
	}
}

if( ! function_exists('my_get_duration_date')) {
	function my_get_duration_date($date) {
		$enddate = date("Y-m-d H:i:s",strtotime("+10 days"));
			
		if ($date > $enddate) {
			return "";
		}

		$diff = strtotime($date) - strtotime("now") + 1; //Find the number of seconds

		$day_difference = ceil($diff / (60*60*24)) ;  //Find how many days that is
		$hour_difference = ceil($diff / (60*60)) ;
		$minute_difference = ceil($diff / 60) ;

		$after_date = "";
		if($day_difference <= 1) {
			if ($hour_difference <= 1) {
				$after_date = $minute_difference." mins";
			} else {
				$after_date = $hour_difference." hours";
			}
		} else/*if($day_difference <= 7)*/ {
			$after_date = $day_difference." days";
		}

		return $after_date;
	}
}

if( ! function_exists('my_finish_upload_file')) {
	function my_finish_upload_file($file_path) {
		$year = date('Y');
		$month = date('m');
		$day = date('d');

		$upload_dir = $year."-".$month."-".$day."/";
		$upload_root = DIR_DOCUMENT_ROOT."upload/";

		if (!chmod($upload_root, 0755)) {
			@unlink($file_path);
			return FALSE;
		}

		if (!is_dir($upload_root.$upload_dir)) {
			if (mkdir($upload_root.$upload_dir, 0755)) {
			} else {
				@unlink($file_path);
				return FALSE;
			}
		}

		$post_file	= pathinfo($file_path);
		$file_name	= url_title($post_file['filename']);
		$file_type	= $post_file['extension']!=''?(".".$post_file['extension']):"";

		while (file_exists($upload_root.$upload_dir.$file_name.$file_type)) {
			$file_name .= rand(100, 999);
		}

		$file_name.= $file_type;

		if (@rename($file_path, $upload_root.$upload_dir.$file_name) === FALSE) {
			@unlink($file_path);
			return FALSE;
		} else {
			return $upload_dir.urlencode($file_name);
		}
	}
}

if( ! function_exists('my_download_file_from_url')) {
	function my_download_file_from_url($url) {
		$upload_dir = date("Y-m-d")."/";
		$upload_root = DIR_DOCUMENT_ROOT."upload/";

		if (!chmod($upload_root, 0755)) {
			return FALSE;
		}

		if (!is_dir($upload_root.$upload_dir)) {
			if (mkdir($upload_root.$upload_dir, 0755)) {
			} else {
				return FALSE;
			}
		}

		$_file		= pathinfo($url);
		$file_name	= $_file['filename'];
		$file_type	= "";
		if (isset($_file['extension'])) {
			$file_type	= ".".$_file['extension'];
		}

		while (file_exists($upload_root.$upload_dir.$file_name.$file_type)) {
			$file_name .= rand(10000, 99999);
		}

		$file_name.= $file_type;

		if (@file_put_contents($upload_root.$upload_dir.$file_name, @fopen($url, "r"))) {
			return $upload_dir.urlencode($file_name);
		} else {
			return FALSE;
		}
	}
}

if( ! function_exists('my_get_html_data_from_dbdata')) {
	function my_get_html_data_from_dbdata($str) {
		$result = str_replace("\"", '"', $str);
		$result = str_replace("\'", "'", $result);
		$result = str_replace("\n", "<br/>", $result);
		return $result;
	}
}

if( ! function_exists('my_get_search_url')) {
	function my_get_search_url($basic_url, $params) {
		for ($i = 0; $i < count($params); $i ++) {
			if (!isset($_POST[$params[$i]])) continue;

			$value = htmlspecialchars($_POST[$params[$i]]);
			if ($value == "") continue;

			$basic_url.=("/".$params[$i]."/".$value);
		}

		return $basic_url;
	}
}

if( ! function_exists('my_get_long_length')) {
	function my_get_long_length($latitude, $longitude, $lat_length=111000) {
		$lng_length = abs($lat_length * cos($latitude));

		return $lng_length;
	}
}

if( ! function_exists('my_get_length_by_itude')) {
	function my_get_length_by_itude($lat1, $lat2, $lat_len, $lng1, $lng2, $lng_len) {
		return round(sqrt(pow(($lat1-$lat2)*$lat_len, 2) + pow(($lng1-$lng2)*$lng_len, 2)));
	}
}

if( ! function_exists('my_get_username_from_email')) {
	function my_get_username_from_email($email) {
		$temp = explode("@", $email);
		return $temp[0];
	}
}

if( ! function_exists('my_urban_push_notification_for_ios')) {
	function my_urban_push_notification_for_ios($devicetokens, $alert, $badge="", $type="", $roomid="", $sound="default") {
		//$pushurl = define('PUSHURL', 'https://go.urbanairship.com/api/push/');

		$contents = array();
		$contents['alert'] = $alert;
		$contents['sound'] = $sound;
		if ($badge != "") {
			$contents['badge'] = $badge;
		}
		if ($type != "") {
			$contents['type'] = $type;
		}
		if ($roomid != "") {
			$contents['roomid'] = $roomid;
		}

		if (is_string($devicetokens)) {
			$devicetokens = array($devicetokens);
		}

		$push = array("aps" => $contents, "device_tokens"=>$devicetokens);

		$json = json_encode($push);

		$iphone_push_url = PUSH_NOTIFICATION_URL;
		$iphone_appkey = PUSH_DEV_IPHONE_APPKEY;
		$iphone_pushsecret = PUSH_DEV_IPHONE_PUSHSECRET;

		if (strtolower(PUSH_DEV_OR_PRODUCT) == 'product') {
			$iphone_appkey = PUSH_PRODUCT_IPHONE_APPKEY;
			$iphone_pushsecret = PUSH_PRODUCT_IPHONE_PUSHSECRET;
		}

		$session = curl_init($iphone_push_url);
		curl_setopt($session, CURLOPT_USERPWD, $iphone_appkey.':'.$iphone_pushsecret);
		curl_setopt($session, CURLOPT_POST, TRUE);
		curl_setopt($session, CURLOPT_POSTFIELDS, $json);
		curl_setopt($session, CURLOPT_HEADER, FALSE);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		$content = curl_exec($session);

		// Check if any error occured
		$response = curl_getinfo($session);
		if($response['http_code'] != 200) {
			return FALSE;
		} else {
			return TRUE;
		}

		curl_close($session);
	}
}

if( ! function_exists('my_check_following')) {
	function my_check_following($follower_id, $following_id) {
		$following = new Following();
		$following->where("follower_id", $follower_id);
		$following->where("following_id", $following_id);

		return $following->count() == 0 ? FALSE : TRUE;
	}
}

if( ! function_exists('my_get_followers')) {
	function my_get_followers($userid, $string=FALSE) {
		$following = new Following();
		$following->where("following_id", $userid);
		$following->get();

		$followers = array();
		foreach ($following as $f) {
			$followers[] = $f->follower_id;
		}

		if ( $string ) {
			if ( count($followers) == 0 ) {
				return "";
			}
			return implode(",", $followers);
		} else {
			return $followers;
		}
	}
}

if( ! function_exists('my_get_followings')) {
	function my_get_followings($userid, $string=FALSE) {
		$following = new Following();
		$following->where("follower_id", $userid);
		$following->get();

		$followings = array();
		foreach ($following as $f) {
			$followings[] = $f->following_id;
		}

		if ( $string ) {
			if ( count($followings) == 0 ) {
				return "";
			}
			return implode(",", $followings);
		} else {
			return $followings;
		}
	}
}

if( ! function_exists('my_get_newsfeed')) {
	function my_get_newsfeed($userid, $keyword, $limit=10, $latest_id=0) {
		$followers = my_get_followers($userid);

		if ( count($followers) == 0 ) return FALSE;

		$resay_posts = array();

		$resays = new Media_resay();
		$resays->where_in("user_id", $followers);
		$resays->get();

		foreach ($resay_posts as $r) {
			$resay_posts[] = $r->media_id;
		}

		$sql = "select `id` from medias where ";
		$sql.= "(user_id in (".implode(",", $followers).")";
		if ( count($resay_posts) > 0 ) {
			$sql.= " or `id` in (".implode(",", $resays).")";
		}
		$sql.= ")";
		if ( $keyword != '') {
			$sql.= " and contents like ('".$keyword."')";
		}
		if ( $latest_id > 0 ) {
			$sql.= " and `id` < ".$latest_id;
		}
		$sql.= " order by `id` desc limit ".$limit;

		return $sql;
	}
}

if( ! function_exists('my_new_notification')) {
	function my_new_notification($userid, $type, $register_id, $media_id=0, $registed="") {
		$notification = new Notification();
		
		if ( $registed == '' ) $registed = my_datenow();
		
		$notification->user_id	= $userid;
		$notification->type		= $type;
		$notification->register_id = $register_id;
		$notification->media_id	= $media_id;
		$notification->registed	= $registed;

		if ( $notification->save() ) {
			return $notification;
		} else {
			return FALSE;
		}
	}
}