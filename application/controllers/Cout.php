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
	public function index()
	{
		parent::__construct();
	}

	public function url( $urlHash )
	{
		$this->load->database();

		$this->load->model('curl_model');

		if ( $urlHash && strlen($urlHash) == 6 )
		{
			if ( $this->curl_model->urlCheck($urlHash) )
			{
				$data['output'] = TRUE; 
				$data['output_url'] = $this->curl_model->getLongURL($urlHash);

				$this->curl_model->setUrlHits($urlHash);
			} else
			{
				$data['output'] = FALSE;
			}
		} else
		{
			$data['output'] = FALSE;
		}

		$this->load->view('cout', $data);	
	}

}
