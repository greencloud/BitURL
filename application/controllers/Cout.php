<?php
/*!
  C-URL - A simple FREE URL shortener utility written in PHP.

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

class Cout extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->model('curl_model');
	}

	/**
	 * url()
	 * 
	 * Retrieve the original long URL from the database to be used to
	 * redirect the shortened URL
	 * 
	 * @param string $urlHash, The 6-digit hash code of the actual URL
	 * @return string, The actual long URL
	 */
	public function url( $urlHash )
	{
		if ( $urlHash && strlen($urlHash) == 6 )
		{
			if ( $this->curl_model->urlIdCheck($urlHash) )
			{
				$this->curl_model->setUrlHits($urlHash);
				$data['orig_url'] = $this->curl_model->getLongURL($urlHash);
	
			} else
			{
				$data['orig_url'] = FALSE;
			}
		} else
		{
			$data['orig_url'] = FALSE;
		}

		$this->load->view('cout', $data);	
	}

}
