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

class Curlit extends CI_Controller
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
		$this->load->model('curl_model');

		if ( isset($_REQUEST['url']) && $this->urlValidity($_REQUEST['url']) )
			$longurl = urlencode(strip_tags(trim($_REQUEST['url'])));
		else
			$longurl = FALSE;

		if ( $longurl )
		{
			$urlHash = $this->urlHash($longurl);

			$this->curl_model->saveHashedURL($longurl, $urlHash);

			$data['output_url'] = $this->config->item('base_url') . $this->urlHash($longurl);
		} else
		{
			$data['output_url'] = self::INPUT_ERROR;
		}

		$this->load->view('curlit', $data);
	}

	public function native()
	{
		$this->lang->load('curl', 'english');

		$this->load->database();
		$this->load->model('curl_model');

		$input_url = $this->input->post('cu-input');

		if ( $this->urlValidity($input_url) )
			$longurl = urlencode(strip_tags(trim($input_url)));
		else
			$longurl = FALSE;

		if ( $longurl )
		{
			$urlHash = $this->urlHash($longurl);

			$this->curl_model->saveHashedURL($longurl, $urlHash);

			$output_url = $this->config->item('base_url') . $this->urlHash($longurl);

			$json = array('error' => '', 'error_msg' => '', 'output_url' => '' . $output_url . '');
		} else
		{
			$json = array('error' => '1', 'error_msg' => '' . $this->lang->line('ajax_invalid_url') .'',
				'output_url' => '');
		}

		header('Content-Type: application/json');
   		echo json_encode($json);
	}

	private function urlValidity( $url_long )
	{
		$path = parse_url($url_long, PHP_URL_PATH);
		$encoded_path = array_map('urlencode', explode('/', $path));
		$url_long = str_replace($path, implode('/', $encoded_path), $url_long);

		if ( substr($url_long, 0, 4) === 'http' || substr($url_long, 0, 5) === 'https' )
			return filter_var($url_long, FILTER_VALIDATE_URL) ? TRUE : FALSE;
		else
			return FALSE;
	}

	private function urlHash( $url_long )
	{
		if ( $url_long && strlen($url_long) > 0 )
		{
			$salt = '$1$vintarah$';
			$str_code = crypt(sha1($url_long), $salt);
			$str_code = strrev( $str_code );

			if ( preg_match('/[^\p{L}\p{N}\s]/u', $str_code) )
				$str_code = preg_replace('/[^\p{L}\p{N}\s]/u', '8', $str_code);
			else
				$str_code = $str_code;

			return substr($str_code, 16, 6);
		}
	}

}
