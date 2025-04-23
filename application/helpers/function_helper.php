<?php

/**
 * Global function
 * place for all global function
 */

/*
List Functions :
	- flash_message
	- create_alert
	- do_login
	- is_login
	- do_logout
	- get_logged_in_user
	- is_home
	- create_help_block
	- create_breadcrumb
	- word_limiter
	- redirect_no_cache
	- redirect_cache
	- upload_image
	- parse_time
	- dump
	- debug
	- create_captcha
	- validate_captcha
	- header_no_cache
	- theme_assets
*/

$GLOBALS['CI'] = &get_instance();
if (!function_exists('flash_message')) {
	function flash_message($can_hide = TRUE)
	{
		global $CI;
		$length = count($CI->session->get_flash_keys()) - 1;
		$status = isset($CI->session->get_flash_keys()[$length]) ? $CI->session->get_flash_keys()[$length] : '';

		// echo debug($CI->session->get_flash_keys()); exit();
		$message = $CI->session->flashdata($status);

		if (!empty($message)) {
			return create_alert($status, $message, $can_hide);
		}
	}
}
if (!function_exists('create_alert')) {
	function create_alert($status, $message, $can_hide = TRUE)
	{
		global $CI;
		$class = array(
			'error'   => 'alert-danger',
			'success' => 'alert-success',
			'warning' => 'alert-warning'
		);

		$icon = array(
			'error'   => 'fa-ban',
			'success' => 'fa-check',
			'warning' => 'fa-warning',
		);

		$title = array(
			'error'   => 'Kesalahan',
			'success' => 'Berhasil',
			'warning' => 'Peringatan',
		);

		$alert = "<div class=\"alert $class[$status] alert-dismissible\">";
		$alert .= $can_hide ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>' : '';
		$alert .= "<h4></h4>$message</div>";
		return $alert;
	}
}
if (!function_exists('do_login')) {
	function do_login($userid, $username, $additional_information = array(), $type = NULL)
	{
		global $CI;
		$arr = array(
			'id_user'                => $userid,
			'user_name'              => $username,
			'time_login'             => date('Y-m-d H:i:s'),
			'additional_information' => $additional_information
		);
		if (!is_null($type)) {
			if ($CI->session->set_userdata('logged_in_' . $type, $arr))
				return true;
		} else {
			if ($CI->session->set_userdata('logged_in', $arr))
				return true;
		}
		return false;
	}
}

if (!function_exists('is_login')) {
	function is_login($type = NULL)
	{
		global $CI;
		$CI->load->library('session');

		if (!is_null($type)) {
			if ($CI->session->userdata('logged_in_' . $type))
				return true;
		} else {
			if ($CI->session->userdata('logged_in'))
				return true;
		}
		return false;
	}
}
if (!function_exists('do_logout')) {
	function do_logout($type = NULL)
	{
		global $CI;
		if (!is_null($type)) {
			if ($CI->session->unset_userdata('logged_in_' . $type))
				return TRUE;
		} else {
			if ($CI->session->unset_userdata('logged_in'))
				return TRUE;
		}
		$CI->session->sess_destroy();
		return FALSE;
	}
}
if (!function_exists('get_logged_in_user')) {
	function get_logged_in_user($type = NULL)
	{
		global $CI;
		if (!is_null($type))
			return $CI->session->userdata('logged_in_' . $type);
		else
			return $CI->session->userdata('logged_in');
	}
}

if (!function_exists('is_home')) {
	function is_home()
	{
		global $CI;
		$segment = $CI->uri->segment(2, '');
		if (empty($segment)) {
			return true;
		}
		return false;
	}
}

if (!function_exists('create_help_block')) {
	function create_help_block($text)
	{
		$text = str_replace("<p>", "", $text);
		$text = str_replace("</p>", "", $text);
		return '<p class="help-block">' . $text . '</p>';
	}
}
if (!function_exists('create_front_help_block')) {
	function create_front_help_block($text)
	{
		// $text = str_replace("<small>", "", $text);
		// $text = str_replace("</small>", "", $text);
		return '<small class="form-control-feedback has-feedback">' . strip_tags($text) . '</small>';
	}
}
if (!function_exists('create_breadcrumb')) {
	function create_breadcrumb()
	{
		global $CI;
		if (is_home()) {
			return '<li class="active"><i class="fa fa-dashboard"></i> Home</li>';
		} else {
			$link = '<li><a href=' . base_url('admin') . '><i class="fa fa-dashboard"></i> Home</a></li>';
			$url  = $CI->uri->segment_array();
			// echo debug($url);
			$item = count($url);
			unset($url[0]);
			$num  = 1;
			foreach ($url as $segment) {
				if ($segment != 'admin') {
					++$num;
					$path  = ($num == $item) ? str_replace('-', ' ', $segment) : anchor(base_url('admin/' . $segment), str_replace('-', ' ', $segment));
					$class = ($num == $item) ? null : 'active';
					$link .= '<li class=' . $class . '>' . $path . '</li>';
				}
			}
			return $link;
		}
	}
}

if (!function_exists('world_limiter')) {
	function word_limiter($text, $count)
	{
		$print = "";
		$string_arr = explode(" ", $text);
		for ($i = 0; $i < $count; $i++) {
			if (count($string_arr) == $i) {
				break;
			}
			$print = $print . $string_arr[$i] . " ";
		};
		return $print;
	}
}

if (!function_exists('redirect_no_cache')) {
	function redirect_no_cache($url)
	{
		return redirect($url, 'refresh', 304);
	}
}

if (!function_exists('redirect_cache')) {
	function redirect_cache($url)
	{
		return redirect($url, 'location', 302);
	}
}


if (!function_exists('upload_image')) {
	function upload_image($field_name, $config_name = 'default', $name = null)
	{
		global $CI;

		$CI->load->config('upload');
		$config = $CI->config->item($config_name);
		if ($name == null) {
			$config['file_name'] = strtolower($_FILES[$field_name]['name']);
		} else {
			$config['file_name'] = $name;
		}
		if (is_array($config) || !empty($config)) {
			$CI->load->library('upload');
			$CI->upload->initialize($config);
			$result = array();
			if ($CI->upload->do_upload($field_name)) {
				$result['result'] = TRUE;
				$result['data']   = $CI->upload->data();
			} else {
				$result['result'] = FALSE;
				$result['data']   = $CI->upload->display_errors();
			}
		} else {
			$CI->load->language('upload');
			$result['result'] = FALSE;
			$result['data']   = $CI->lang->line('upload_no_config');
		}
		return $result;
	}
}

if (!function_exists('parse_time')) {
	function parse_time($timestamp, $format = "l, d F Y - H:i")
	{
		global $CI;
		$CI->lang->load(array('calendar'));
		$timestamp = date('Y-m-d H:i:s', strtotime($timestamp));

		$format = trim($format);
		$time   = strtotime($timestamp);
		$result = date($format, $time);

		$long_day_check = strrpos(' ' . $format, "l");
		if ($long_day_check == true) {
			$day     = date('l', $time);
			$replace = $CI->lang->line('cal_' . strtolower(date('l', $time)));
			$result  = str_replace($day, $replace, $result);
		}

		$short_day_check = strrpos(' ' . $format, "D");
		if ($short_day_check == true) {
			$day     = date('D', $time);
			$replace = $CI->lang->line('cal_' . strtolower(date('D', $time)));
			$result  = str_replace($day, $replace, $result);
		}

		$long_month_check = strrpos(' ' . $format, "F");
		if ($long_month_check == true) {
			$month   = date('F', $time);
			$replace = $CI->lang->line('cal_' . strtolower(date('F', $time)));
			$result  = str_replace($month, $replace, $result);
		}

		$short_month_check = strrpos(' ' . $format, "M");
		if ($short_month_check == true) {
			$month   = date('M', $time);
			$replace = $CI->lang->line('cal_' . strtolower(date('M', $time)));
			$result  = str_replace($month, $replace, $result);
		}

		return $result;
	}
}

if (!function_exists('dump')) {
	function dump($var, $echo = TRUE)
	{

		ob_start();
		var_dump($var);
		$output = ob_get_clean();

		$output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
		$output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;"> Dump => ' . $output . '</pre>';

		if ($echo == TRUE) {
			echo $output;
		} else {
			return $output;
		}
	}
}

if (!function_exists('debug')) {
	function debug($data)
	{
		echo '<pre>' . print_r($data, true) . '</pre>';
	}
}

if (!function_exists('generate_captcha')) {
	function generate_captcha($length = 4, $config_name = 'default')
	{
		global $CI;
		$CI->load->helper('captcha');
		$CI->load->helper('string');

		//captcha config
		$prefix = 'captcha_';
		$CI->load->config('captcha');
		$config  = $CI->config->item($prefix . $config_name);

		$captcha = create_captcha($config);
		$data    = array(
			'word'         => $captcha['word'],
			'ip_address'   => $CI->input->ip_address(),
			'captcha_time' => $captcha['time']
		);

		$CI->session->set_userdata('captcha', $data);
		return $captcha;
	}
}

if (!function_exists('validate_captcha')) {
	function validate_captcha($value)
	{
		global $CI;
		$expire       = time() - 360;
		$captcha      = $CI->session->userdata('captcha');
		$word         = $captcha['word'];

		$captcha_time = $captcha['captcha_time'];
		$ip_address   = $captcha['ip_address'];
		$CI->session->unset_userdata('captcha');
		if ($word == $value && $captcha_time > $expire && $ip_address == $CI->input->ip_address()) {
			return true;
		} else {
			$CI->lang->load('form_validation');
			$CI->form_validation->set_message('validate_captcha', $CI->lang->line('validate_captcha'));
			return false;
		}
	}
}

if (!function_exists('header_no_cache')) {
	function header_no_cache()
	{
		global $CI;
		$CI->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$CI->output->set_header("Pragma: no-cache");
	}
}

if (!function_exists('theme_assets')) {
	function theme_assets($file_path = '', $theme_name = '')
	{
		$asset_folder = 'assets/themes';
		$assets_location = empty($theme_name) ? "$asset_folder/$file_path" : "$asset_folder/$theme_name/$file_path";
		return base_url($assets_location);
	}
}

function extract_where_query($where = array())
{
	global $CI;
	$extract_where = '';
	if (!empty($where)) {
		foreach ($where as $field => $value) {
			$field = trim($field);
			if ($extract_where == '') {
				$extract_where = 'WHERE ';
			} else {
				if (substr(strtolower($field), 0, 3) == 'or ') {
					$extract_where .= ' OR ';
					$field = str_replace('or ', '', strtolower($field));
				} else {
					$extract_where .= ' AND ';
				}
			}

			if (!preg_match('/(\s|<|>|!|=|is null|is not null)/i', $field)) {
				$operator = ' = ';
			} else {
				$operator = '';
			}
			$pattern = '/(\)$)/';
			if (preg_match($pattern, $field)) {
				$enclosed = ')';
				$field = preg_replace($pattern, '', $field);
			} else {
				$enclosed = '';
			}
			$extract_where .= "$field $operator '" . $CI->db->escape_str($value) . "'" . $enclosed;
		}
	}
	return $extract_where;
}

/**
 * Crop an image
 * @param  String $src       original file path
 * @param  String $new_image new file path to be placed
 * @param  Integer $x    resize to spesifiec height
 * @param  Integer $y    resize to spesifiec height
 * @param  Integer $width     spesifiec width
 * @param  Integer $height    spesifiec height
 * @return Object            true when success, error message when fail
 */
function crop_image($src = '', $new_image = null, $x = 0, $y = 0, $width = 0, $height = 0)
{
	global $CI;
	$config = array(
		'image_library'		=> 'gd2',
		'source_image'		=> $src,
		'maintain_ratio'	=> false,
		'x_axis'			=> $x,
		'y_axis'			=> $y,
		'quality'			=> '100%',
		'width'				=> $width,
		'height'			=> $height
	);
	if ($new_image != null) {
		$config['new_image'] = $new_image;
	}
	$CI->load->library('image_lib');
	$CI->image_lib->initialize($config);
	if ($CI->image_lib->crop()) {
		return true;
	} else {
		return false;
	};
}

function resize_image($src = '', $new_image = null, $width = 0, $height = 0)
{
	global $CI;
	$config = array(
		'image_library'   => 'gd2',
		'source_image'    => $src,
		'maintain_ration' => true,
		'quality'         => '100%',
		'width'           => $width,
		'height'          => $height,
		'new_image'       => $new_image
	);
	if ($new_image != null) {
		$config['new_image'] = $new_image;
	}
	$CI->load->library('image_lib');
	$CI->image_lib->initialize($config);
	if (!$CI->image_lib->crop()) {
		return false;
	} else {
		return true;
	};
}

function get_set_values($table, $field)
{
	global $CI;
	$type = $CI->db->query("SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'")->row(0)->Type;
	preg_match("/^set\(\'(.*)\'\)$/", $type, $matches);
	$enum = explode("','", $matches[1]);
	return $enum;
}

function get_enum_values($table, $field)
{
	global $CI;
	$type = $CI->db->query("SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'")->row(0)->Type;
	preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
	$enum = explode("','", $matches[1]);
	return $enum;
}


if (!function_exists('export_pdf')) {
	function export_pdf($template, $filename, $paper_size = 'A4', $orientation = 'potrait')
	{
		global $CI;
		$CI->load->library('dompdf_lib');
		$CI->dompdf_lib->load_html($template);
		$CI->dompdf_lib->set_paper($paper_size, $orientation);
		$CI->dompdf_lib->render();
		$CI->dompdf_lib->stream($filename . '.pdf');
	}
}

if (!function_exists('save_pdf')) {
	function save_pdf($template, $filename, $path, $paper_size = 'A4', $orientation = 'potrait')
	{
		global $CI;
		$CI->load->library('dompdf_lib');
		$CI->dompdf_lib->load_html($template);
		$CI->dompdf_lib->set_paper($paper_size, $orientation);
		$CI->dompdf_lib->render();
		$output = $CI->dompdf_lib->output();
		file_put_contents($path . $filename, $output);
	}
}

function currency($val = '', $currency = '')
{
	if ($val < 0) {
		return "($currency" . number_format(abs($val), 0, '', '.') . ")";
	} else {
		return "$currency" . number_format($val, 0, '', '.');
	}
}

function delete_file($source)
{
	if (is_array($source)) {
		foreach ($source as $path) {
			if (file_exists($path)) {
				unlink($path);
			}
		}
	} else {
		if (file_exists($source)) {
			unlink($source);
		}
	}
}

function post_data($module, $type, $data, $validate_name, $model, $id = null, $action = null, $picture_field = null, $upload_config = null, $save_original = true)
{
	global $CI;
	$CI->load->library('form_validation');
	$CI->load->config('validation');
	$CI->load->config('redirect');
	$CI->lang->load('greet', 'english');

	$message = null;

	if ($validate_name != null) {
		$config = $CI->config->item($validate_name);
		$CI->form_validation->set_rules($config);
		if ($CI->form_validation->run() == false) {
			$CI->_create_validation_error_result($config);
			$error = 1;
			$message = $CI->lang->line("$module")['fail'];
		} else {
			if ($action != null) {
				$res                  = post_crop_data($action, $model, $save_original, $picture_field, $upload_config, $id);
				$data[$picture_field] = $res['filename'];
				$error                = $res['error'];
				$message              = $res['message'];
			}

			if (!isset($error)) {
				$message = data_modify($module, $type, $data, $model, $id);
			}
		}
	} else {
		// if validation null and just upload image like slider
		if ($action != null) {
			$res                  = post_crop_data($action, $model, $save_original, $picture_field, $upload_config, $id);
			$data[$picture_field] = $res['filename'];
			$error                = $res['error'];
			$message              = $res['message'];
		}
		if (!isset($error)) {
			$message = data_modify($module, $type, $data, $model, $id);
		}
	}

	$CI->session->set_flashdata(isset($error) ? 'error' : 'success', $message);
	$redirect = $CI->config->item($module);
	$redirect = $redirect['redirect_' . $module . '_' . $type];

	if ($type == 'update') {
		$CI->load->model($model, 'model');
		$primary_key = $CI->model->primary_key;

		if (array_key_exists($primary_key, $data)) {
			$id = $data[$primary_key];
		} else {
			$id = $CI->uri->segment(4);
		}
		$new_id      = $id;

		if (isset($error)) {
			$url = $redirect . $id;
		} else {
			$url = $redirect . $new_id;
		}


		redirect($url, 'refresh');
	} else {
		redirect($redirect, 'refresh');
	}
}

function post_crop_data($action, $model, $save_original = true, $picture_field = null, $upload_config = null, $id = null)
{
	global $CI;
	$CI->load->config('upload');
	$config     = $CI->config->item($upload_config);

	$error      = null;
	$message    = '';
	$new_filename   = '';

	$x          = (int) $CI->input->post('x_val', TRUE);
	$y          = (int) $CI->input->post('y_val', TRUE);
	$w          = (int) $CI->input->post('w_val', TRUE);
	$h          = (int) $CI->input->post('h_val', TRUE);

	$orig_path  = $config['upload_path'];
	$cover_path = $orig_path . 'cover/';

	if ($action != 'insert_with_upload') {
		// old file data

		$model    = $CI->load->model($model, 'model');
		$filename = $CI->model->get_by(array($CI->model->primary_key => $id));
		$filename = $filename[$picture_field];
		$orig     = $orig_path . $filename;
		$cover    = $cover_path . $filename;
	}

	switch ($action) {
		case 'update_with_upload':
		case 'insert_with_upload':


			$upload = upload_image($picture_field, $upload_config);
			if ($upload['result'] == 1) {
				// new uploaded file data

				// get extension only
				$ext 					= pathinfo($upload['data']['file_name'], PATHINFO_EXTENSION);
				// get name only
				$name         = str_replace('_', '-', url_title(strtolower(pathinfo($upload['data']['file_name'], PATHINFO_FILENAME))));
				$name 				= $name . '.' . $ext;

				$new_orig     = $upload['data']['full_path'];
				$new_cover    = $cover_path . $name;
				$new_filename = $name;
				crop_image($new_orig, $new_cover, $x, $y, $w, $h);

				//delete if cover replaced		
				if ($action == 'update_with_upload') {
					if ($filename != $new_filename) {
						if (!empty($filename)) {
							if (file_exists($orig)) {
								unlink($orig);
							}
							if (file_exists($cover)) {
								unlink($cover);
							}
						}
					}
				}
				if ($save_original == false) {
					// echo $new_orig; exit();
					if (file_exists($new_orig)) {
						unlink($new_orig);
					}
				}
			} else {
				$error   = 1;
				$message = $upload['data'];
			}
			break;

		case 'update_with_remove_cover':
			$file = array($orig, $cover);
			delete_file($file);
			break;

		case 'update_with_crop':
			$new_filename = $filename;
			crop_image($orig, $cover, $x, $y, $w, $h);
			break;
	}

	$res = array('error' => $error, 'message' => $message, 'filename' => $new_filename);
	return $res;
}

function data_modify($module = '', $type = '', $data = null, $model = '', $id = null, $upload_config = null, $image_field_name = null)
{
	global $CI;
	$CI->load->config('upload');
	$CI->load->model($model, 'model');
	switch ($type) {
		case 'insert':
			$CI->model->insert($data);


			break;

		case 'update_with_remove_cover':
		case 'update_without_list':
		case 'update_with_crop':
		case 'update':
			$CI->model->update($id, $data);
			break;

		case 'delete':
			$data   = (array) $CI->model->get_by(array($CI->model->primary_key => $id));
			$config = $CI->config->item($upload_config);

			$CI->load->config('redirect');
			$CI->lang->load('greet', 'english');

			if ($image_field_name != null) {
				$orig  = $config['upload_path'] . $data[$image_field_name];
				$cover = $config['upload_path'] . 'cover/' . $data[$image_field_name];
				if (file_exists($orig) && $data[$image_field_name] != null) {
					unlink($orig);
				}
				if (file_exists($cover) && $data[$image_field_name] != null) {
					unlink($cover);
				}
			}

			$CI->model->delete($id);

			$message 	= $CI->lang->line($module)[$type];
			$redirect = $CI->config->item($module);
			$redirect = $redirect['redirect_' . $module . '_' . $type];

			$CI->session->set_flashdata('success', $message);
			redirect_no_cache($redirect);

			break;
	}
	return $CI->lang->line($module)[$type];
}

function get_array_duplicate($array)
{
	$arr = array_diff_assoc($array, array_unique($array));
	return $arr;
}

function generate_random_string($length = 5)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function insert_batch_data($model, $data)
{
	global $CI;
	$table = $CI->load->model($model, 'model');
	$table = $CI->model->_table;
	$CI->db->insert_batch($table, $data);
	return $CI->db->last_query();
}

function substract_multidimensional_array($source = array(), $filter = array())
{
	$result = array();
	foreach ($source as $key => $value) {
		$item = array();
		foreach ($filter as $field) {
			$item[$field] = $value[$field];
		}
		$result[] = $item;
	}
	return $result;
}

function compare_multidimensional_array($array1, $array2)
{
	$difference = array();
	foreach ($array1 as $key => $value) {
		if (isset($array2[$key])) {
			$difference[$key] = abs($array1[$key] - $array2[$key]);
		} else {
			$difference[$key] = $value;
		}
	}
	foreach ($array2 as $key => $value) {
		if (isset($array1[$key])) {
			$difference[$key] = abs($array1[$key] - $array2[$key]);
		} else {
			$difference[$key] = $value;
		}
	}
	return $difference;
}

function import_csv($module = '', $config_upload = '', $field_name = '', $model = '', $table_field = array(), $err_field = array(), $order_field_name = '')
{
	global $CI;
	$CI->load->library('upload');
	$CI->load->library('csvimport');
	$CI->load->config('upload');
	$CI->lang->load('greet', 'id');
	$CI->load->config('redirect');

	$config = $CI->config->item($config_upload);
	$CI->upload->initialize($config);

	if (!$CI->upload->do_upload($field_name)) {
		$CI->session->set_flashdata('error', $CI->upload->display_errors());
	} else {
		$file_data = $CI->upload->data();

		$file_path = $config['upload_path'] . $file_data['file_name'];

		// read csv file
		if ($CI->csvimport->get_array($file_path)) {

			// can read
			$data_csv 	 = $CI->csvimport->get_array($file_path, $table_field);
			$CI->load->model($model, 'model');
			$table 			 = $CI->model->_table;
			$pk          = $CI->model->primary_key;

			// generate sql field name
			$field_name  = '';
			$i 				   = 0;
			$x 					 = count($table_field);
			foreach ($table_field as $key => $value) {
				if ($i++ < $x - 1) {
					$value .= ', ';
				}
				$field_name .= $value;
			}

			// generate value
			$data_content = '';
			$x1 = 0;
			$t1 = count($data_csv);
			foreach ($data_csv as $key => $value) {
				$content = '';
				$x2      = 0;
				$t2 		 = count($value);
				foreach ($value as $k2 => $v2) {
					$v2 = str_replace("'", "\'", $v2);
					$a  = "'$v2'";
					if ($x2++ < $t2 - 1) {
						$a .= ', ';
					}
					$content .= strtoupper($a);
					// dump($a);
					// exit;
				}
				$c = '(' . $content . ')';
				if ($x1++ < $t1 - 1) {
					$c .= ', ';
				}
				$data_content .= $c;
			}
			$query = 'INSERT IGNORE INTO ' . $table . ' (' . $field_name . ') VALUES ' . $data_content;

			//insert into table
			$CI->db->query($query);
			$insert_total  = $CI->db->affected_rows();


			// get successed inserted record
			$inserted_data = $CI->model->limit($insert_total, 0)->order_by($order_field_name, 'desc')->get_all();

			// unset additional column order field if field exist in table but not exist in csv
			$data_db = array();
			foreach ($inserted_data as $key => $subArr) {
				unset($subArr[$order_field_name]);
				$data_db[$key] = $subArr;
			}

			// check total affected rows
			if ($insert_total != 0) {
				if ($insert_total != sizeof($data_csv)) {

					// compare successed imported data with csv 
					$failed_inserted_record			= array();
					$successed_inserted_record	= array();
					foreach ($data_csv as $v) {
						if (in_array($v, $data_db)) {
							$successed_inserted_record[] = $v;
						} else {
							$failed_inserted_record[]    = $v;
						}
					}

					// return duplicated record
					$res = $failed_inserted_record;

					$type    = 'error1';
					$message = $CI->lang->line($module)['duplicated'];
					$CI->session->set_flashdata('error_import', $res);
					$CI->session->set_flashdata('table_field', $table_field);
					$CI->session->set_flashdata('err_field', $err_field);
				} else {

					//return if duplicate data not happen
					$type = 'success';
					$message = $CI->lang->line($module)['success'];
				}
			} else {

				//if all import data already exist in database
				$type = 'error';
				$message = $CI->lang->line($module)['fail'];
			}
			// echo $type; exit();

			$CI->session->set_flashdata($type, $message);

			$redirect = $CI->config->item($module);
			$redirect = $redirect['redirect_' . $module . '_insert'];
			redirect_no_cache($redirect);
		} else {
			$CI->session->set_flashdata('error', "Can't read uploaded file");
		}
		unlink(APPPATH . '../' . $file_path);
	}
}

function flash_error_import_csv($view_path, $box_title)
{
	global $CI;

	if ($CI->session->flashdata('error_import')) {
		$data['title'] = $box_title;
		$CI->load->view($view_path, $data);
	}
}

if (!function_exists('set_session')) {
	function set_session($session_name, $data)
	{
		global $CI;
		$CI->load->library('session');
		$CI->session->set_userdata($session_name, $data);
	}
}

if (!function_exists('get_session')) {
	function get_session($session_name)
	{
		global $CI;
		$CI->load->library('session');
		return $CI->session->userdata($session_name);
	}
}

if (!function_exists('unformat_currency')) {
	function unformat_currency($val)
	{
		return (int) filter_var($val, FILTER_SANITIZE_NUMBER_INT);
	}
}

if (!function_exists('fetch_arr')) {

	/**
	 * [Get value decrease one level]
	 * @param  [array] $value [description]
	 * @return [array]        [Level Penilaian (bahasa)]
	 */
	function fetch_arr($array)
	{

		if (empty($array)) {
			return [];
		}

		$arrayTemp = [];
		foreach ($array as $key => $value) {
			$arrayTemp[] = $value[key($value)];
			# code...
		}

		return $arrayTemp;
	}
}

function split_array($list, $p)
{
	$listlen = count($list);
	$partlen = floor($listlen / $p);
	$partrem = $listlen % $p;
	$partition = array();
	$mark = 0;
	for ($px = 0; $px < $p; $px++) {
		$incr = ($px < $partrem) ? $partlen + 1 : $partlen;
		$partition[$px] = array_slice($list, $mark, $incr);
		$mark += $incr;
	}
	return $partition;
}

function insert_at_position($string, $insert, $position)
{
	return substr_replace($string, $insert, $position, 0);
}

function encrypt_id($id_user, $registered_time, $salt = '(^_^)')
{
	$id_hash    = base64_encode($id_user);
	$time_hash = substr(md5($registered_time . $salt), 0, 10);

	// get first number on time hash
	$filtered_number = array_filter(preg_split("/\D+/", $time_hash));
	$first_occurence = reset($filtered_number);
	$first_number    = substr($first_occurence, 0, 1);
	return insert_at_position($id_hash, $time_hash, $first_number);
}

function decrypt_id($hash, $registered_time, $salt = '(^_^)')
{
	$time_hash  = substr(md5($registered_time . $salt), 0, 10);
	$id_hash    = str_replace($time_hash, '', $hash);
	$decoded_id = base64_decode($id_hash);
	// $result     = preg_replace('~[^\\pL\d]+~u', ' ', $decoded_id);
	return $decoded_id;
}

function clear_hash($hash)
{
	$result = preg_replace('~[^\\pL\d]+~u', ' ', $hash);
	return $result;
}

function name_abbr($fullname)
{
	$fullname = ucwords(strtolower($fullname));
	$a        = explode(' ', $fullname);
	$c1       = substr($fullname, 0, 18);
	$c2       = substr($fullname, 0, strrpos($c1, " "));
	$car      = count(explode(' ', $c2));
	if (count($a) <= 2) {
		$result = $fullname;
	} else {
		$nickname = $c2;
		$abbr = '';
		for ($x = $car; $x < count($a); $x++) {
			$abbr .= substr($a[$x], 0, 1) . '. ';
		}
		$result = $nickname . ' ' . $abbr;
	}
	return $result;
}

function post_to_url($url, $data)
{
	$fields = '';
	foreach ($data as $key => $value) {
		$fields .= $key . '=' . $value . '&';
	}
	rtrim($fields, '&');

	$post = curl_init();

	curl_setopt($post, CURLOPT_URL, $url);
	curl_setopt($post, CURLOPT_POST, count($data));
	curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec($post);

	curl_close($post);
	return $result;
}

if (!function_exists('error_message')) {
	/**
	 * Shorthen Error Response
	 *
	 * @param array $e
	 * @return void
	 */
	function error_message($e = array(), $isDie = false)
	{
		if (empty($isDie)) {
			return ["status" => "error", "response" => $e];
		} else {
			echo json_encode(["status" => "error", "response" => $e]);
			die;
		}
	}
}
if (!function_exists('success_message')) {
	/**
	 * Shorthen Success Response
	 *
	 * @param array $e
	 * @return void
	 */
	function success_message($s = array(), $isDie = false)
	{
		if (empty($isDie)) {
			return ["status" => "success", "response" => $s];
		} else {
			echo json_encode(["status" => "success", "response" => $s]);
			die;
		}
	}
}

// if (!function_exists('timeDiff')) {
// 	/**
// 	 * To Substract Time to be minutes
// 	 *
// 	 * @param Datetime $a 
// 	 * @param Datetime $b 
// 	 * @return void
// 	 */
// 	function timeDiff($a, $b)
// 	{
// 		$a = new DateTime($a);
// 		$interval = $a->diff($b);
// 		$hours = $interval->h;
// 		$minutes = $interval->i;
// 		$minutes =  $minutes + ($hours * 60) + ($interval->days * 24);
// 		if ($interval->invert == 0) {
// 			$minutes = $minutes * -1;
// 		}
// 		return $minutes;
// 	}
// }

function node_module($module)
{
	$path = base_url('node_modules/' . $module);
	return $path;
}

function validate_time($time, $format = 'Y-m-d')
{
	$date = DateTime::createFromFormat($format, $time);
	return $date && $date->format($format) == $time;
}

/**
 * Datetime 
 * 
 * @param [Y-m-d H:i:s] $differ
 * @return minute different
 */
function nowDiffTime($differ)
{
	$now =  time();
	$differTimeStamp = strtotime($differ);
	$minute = ($now - $differTimeStamp) / 60;
	return  $minute;
}

function add_datetime_interval($date_time, $interval)
{
	$time = new DateTime($date_time);
	$time->add(new DateInterval('PT' . $interval . 'M'));
	$stamp = $time->format('Y-m-d H:i:s');
	return $stamp;
}

function humanTiming($time)
{
	$time = time() - $time; // to get the time since that moment
	$time = ($time < 1) ? 1 : $time;
	$tokens = array(
		31536000 => 'year',
		2592000 => 'month',
		604800 => 'week',
		86400 => 'day',
		3600 => 'hour',
		60 => 'minute',
		1 => 'second'
	);

	foreach ($tokens as $unit => $text) {
		if ($time < $unit) continue;
		$numberOfUnits = floor($time / $unit);
		return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
	}
}

function terbilang($x)
{
	$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	if ($x < 12)
		return " " . $abil[$x];
	elseif ($x < 20)
		return Terbilang($x - 10) . " belas";
	elseif ($x < 100)
		return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
	elseif ($x < 200)
		return " seratus" . Terbilang($x - 100);
	elseif ($x < 1000)
		return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
	elseif ($x < 2000)
		return " seribu" . Terbilang($x - 1000);
	elseif ($x < 1000000)
		return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
	elseif ($x < 1000000000)
		return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}

function validate_date($date, $format = 'Y-m-d')
{
	$d = DateTime::createFromFormat($format, $date);
	// The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
	return $d && $d->format($format) === $date;
}

function send_http_post($url = '', $data = [])
{
	if (empty($url) || empty($data)) {
		return false;
	}
	$ch = curl_init(); // Initiate cURL
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);  // Tell cURL you want to post something
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Define what you want to post

	$output = curl_exec($ch); // Execute
	curl_close($ch); // Close cURL handle
}

function time_elapsed($datetime, $full = false, $lang = 'id')
{
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	if ($lang == 'id') {
		$string = array(
			'y' => 'tahun',
			'm' => 'bulan',
			'w' => 'minggu',
			'd' => 'hari',
			'h' => 'jam',
			'i' => 'menit',
			's' => 'detik',
		);
		$condition = 'yang lalu';
		$status    = 'baru saja';
		$plural    = '';
	} else {
		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		$condition = 'ago';
		$status    = 'just now';
		$plural    = 's';
	}
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? $plural : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' ' . $condition : $status;
}

function format_file_size($bytes)
{
	if ($bytes >= 1073741824) {
		$bytes = number_format($bytes / 1073741824, 2) . ' GB';
	} elseif ($bytes >= 1048576) {
		$bytes = number_format($bytes / 1048576, 2) . ' MB';
	} elseif ($bytes >= 1024) {
		$bytes = number_format($bytes / 1024, 2) . ' KB';
	} elseif ($bytes > 1) {
		$bytes = $bytes . ' bytes';
	} elseif ($bytes == 1) {
		$bytes = $bytes . ' byte';
	} else {
		$bytes = '0 bytes';
	}
	return $bytes;
}

// use Hashids\Hashids;

// function hashcrypt($type, $data)
// {
// 	$hashids = new Hashids('', 10);
// 	if ($type == 'enc') {
// 		return $hashids->encode($data);
// 	} elseif ($type == 'dec') {
// 		return $hashids->decode($data)[0];
// 	}
// }

function replaceee($string, $type = 'r')
{

	if ($type == 'r') {
		$text = trim($string);
		$text = preg_replace("/[^a-zA-Z0-9\-\s]+/", "", $text);
		$text = strtolower(trim($text));
		$text = str_replace(' ', '-', $text);
		$text = preg_replace('/\-{2,}/', '-', $text);
		return $text;
	} elseif ($type == 'u') {
		return str_replace('_', ' ', ucwords($string));
	}
}

// function opencrypt($string,)
// {
// 	$ciphering = "BF-CBC";

// 	$iv_length = openssl_cipher_iv_length($ciphering);
// 	$options = 0;

// 	$encryption_iv = random_bytes($iv_length);


// 	$encryption_key = openssl_digest(php_uname(), 'MD5', TRUE);

// 	$encryption = openssl_encrypt(
// 		$string,
// 		$ciphering,
// 		$encryption_key,
// 		$options,
// 		$encryption_iv
// 	);

// 	// Display the encrypted string
// 	echo "Encrypted String: " . $encryption . "\n";

// 	// Decryption of string process starts
// 	// Used random_bytes() which gives randomly
// 	// 16 digit values
// 	$decryption_iv = random_bytes($iv_length);

// 	// Store the decryption key
// 	$decryption_key = openssl_digest(php_uname(), 'MD5', TRUE);

// 	// Descrypt the string
// 	$decryption = openssl_decrypt(
// 		$encryption,
// 		$ciphering,
// 		$decryption_key,
// 		$options,
// 		$encryption_iv
// 	);

// 	// Display the decrypted string
// 	echo "Decrypted String: " . $decryption;
// 	# code...
// }

function encrypt_url($enc = true, $url = '')
{
	$ci = get_instance();
	$ci->load->library('encryption');
	if ($enc) {
		$enc_url = $ci->encryption->encrypt($url);
		$url_new = str_replace(array('=', '+', '/'), array('-', '_', '~'), $enc_url);
		return $url_new;
	} else {
		$enc_url = str_replace(array('-', '_', '~'), array('=', '+', '/'), (string)($url ?? ''));
		$dec_url = $ci->encryption->decrypt($enc_url);
		return $dec_url;
	}
}

function createSlug($create = true, $id = null,  $text = null)
{
	if ($create) {
		$text = trim($text);
		$text = preg_replace("/[^a-zA-Z0-9\-\s]+/", "", $text);
		$text = strtolower(trim($text));
		$text = str_replace(' ', '-', $text);
		$text = preg_replace('/\-{2,}/', '-', $text);
		$result = $id . '-' . $text;
		return $result;
	} else {
		$text = explode('-', $text);
		$id = $text[0];
		return $id;
	}
}

function convert_number($number)
{
	if (is_numeric($number)) {
		$tmp = $number;
		$int_val = (int) $tmp;
		if (strval($tmp) == $int_val) {
			$new_number = number_format($number, 0, ',', '.');
		} else {
			$new_number = number_format($number, 2, ',', '.');
		}
	} else {
		$new_number = $number;
	}
	return $new_number;
}
