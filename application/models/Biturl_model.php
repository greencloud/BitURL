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

class Biturl_model extends CI_Model
{
	const BU_TABLE = 'biturl_data';	

	function __construct()
	{
		parent::__construct();

	}

	public function storeURL( $url, $urlCode )
	{
		if ( ! $this->urlCheck($urlCode) )
		{
			$b_url = $this->config->item('base_url') . $urlCode;

			$query = $this->db->query("
				INSERT INTO " . self::BU_TABLE . "
					(id, url_id, url_actual, url_short, url_hits, url_added)
				VALUES
					(NULL, '" . (string)$urlCode . "', '" . $url . "', '" . $b_url . "', 0, CURRENT_TIMESTAMP)
			");

			return $query;
		}
	}

	public function getURL( $urlCode )
	{
		$query = $this->db->query("
			SELECT * FROM " . self::BU_TABLE . " WHERE `url_id` = '" . $urlCode . "'
		");

		$result = $query->row();

		if ( isset($result) )
			return $result->url_actual;
		else
			return FALSE;
	}

	public function getHits( $urlCode )
	{
		$query = $this->db->query("
			SELECT * FROM " . self::BU_TABLE . " WHERE `url_id` = '" . $urlCode . "'
		");

		$result = $query->row();

		if ( isset($result) )
			return $result->url_hits;
		else
			return FALSE;
	}

	public function updateHits( $urlCode )
	{
		$hits = $this->getHits($urlCode);
		$hits = $hits + 1;

		$query = $this->db->query("
			UPDATE " . self::BU_TABLE . " SET `url_hits` = '" . (int)$hits . "' WHERE `url_id` = '" . $urlCode . "' LIMIT 1
		");

		return $query;
	}

	public function urlCheck( $urlCode )
	{
		$query = $this->db->query("
			SELECT * FROM " . self::BU_TABLE . " WHERE `url_id` = '" . $urlCode . "'
		");

		return $query->row();
	}

}
