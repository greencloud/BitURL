<?php
/*!
  BitURL - A simple FREE URL shortener program written in PHP.

  Copyright (C) 2020  Rasmus van Guido (greencloud@serbits.com)

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Biturl extends CI_Controller
{
	const INPUT_ERROR = 'Invalid URL input!';

	public function index()
	{
		parent::__construct();
		
		$this->load->helper('url');
	}

	public function api()
	{
		$this->load->database();
		$this->load->model('biturl_model');

		if ( isset($_REQUEST['url']) && $this->isValidUrl($_REQUEST['url']) )
			$longurl = urlencode(strip_tags(trim($_REQUEST['url'])));
		else
			$longurl = FALSE;

		if ( $longurl )
		{
			$urlCode = $this->urlCode($longurl);

			$this->biturl_model->storeURL($longurl, $urlCode);

			$data['output_url'] = $this->config->item('base_url') . $this->urlCode($longurl);
		} else
		{
			$data['output_url'] = self::INPUT_ERROR;
		}

		$this->load->view('biturl', $data);
	}
	
	public function input()
	{
		$this->lang->load('biturl', 'english');
		$this->load->database();
		$input_url = $this->input->post('btinput');
		
		if ( $this->isValidUrl($input_url) )
			$longurl = urlencode(strip_tags(trim($input_url)));
		else
			$longurl = FALSE;
		
		if ( $longurl )
		{
			$urlCode = $this->urlCode($longurl);
			
			$this->biturl_model->storeURL($longurl, $urlCode);
			
			$output_url = $this->config->item('base_url') . $this->urlCode($longurl);
			
			$json = array('error' => '', 'error_msg' => '', 'output_url' => '' . $output_url . '');
		} else
		{
			$json = array('error' => '1', 'error_msg' => '' . $this->lang->line('ajax_invalid_url') .'',
				'output_url' => '');
		}
		
		header('Content-Type: application/json');
		echo json_encode($json);
	}

	private function isValidUrl( $url_actual )
	{
    	$path = parse_url($url_actual, PHP_URL_PATH);
		$encoded_path = array_map('urlencode', explode('/', $path));
		$url_actual = str_replace($path, implode('/', $encoded_path), $url_actual);

		if ( substr($url_actual, 0, 4) === 'http' || substr($url_actual, 0, 5) === 'https' )
			return filter_var($url_actual, FILTER_VALIDATE_URL) ? TRUE : FALSE;
		else
			return FALSE;
	}

	private function urlCode( $url_actual )
	{
		if ( $url_actual && strlen($url_actual) > 0 )
		{
			$salt = '$1$vintarah$';
			$str_code = crypt(sha1($url_actual), $salt);
			$str_code = strrev( $str_code );

			if ( preg_match('/[^\p{L}\p{N}\s]/u', $str_code) )
				$str_code = preg_replace('/[^\p{L}\p{N}\s]/u', '8', $str_code);
			else
				$str_code = $str_code;

			return substr($str_code, 16, 6);
		}
	}

}
