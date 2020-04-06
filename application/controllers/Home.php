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

class Home extends CI_Controller
{
	public function index()
	{
		parent::__construct();

		$this->load->helper('url');
		
		$this->lang->load('biturl', 'english');

		$this->load->view('home');	
	}
	
}
