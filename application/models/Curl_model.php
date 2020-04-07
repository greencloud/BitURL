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

class Curl_model extends CI_Model
{
	const CU_TABLE = 'curltab_data';

	function __construct()
	{
		parent::__construct();

	}

	public function saveHashedURL( $url, $urlHash )
	{
		if ( ! $this->urlCheck($urlHash) )
		{
			$b_url = $this->config->item('base_url') . $urlHash;

			$query = $this->db->query("
				INSERT INTO " . self::CU_TABLE . "
					(id, url_id, url_title, url_long, url_short, url_hits, url_date)
				VALUES
					(NULL, '" . (string)$urlHash . "', '', '" . $url . "', '" . $b_url .
					"', 0, CURRENT_TIMESTAMP)
			");

			return $query;
		}
	}

	public function getLongURL( $urlHash )
	{
		$query = $this->db->query("
			SELECT * FROM " . self::CU_TABLE . " WHERE `url_id` = '" . $urlHash . "'
		");

		$result = $query->row();

		if ( isset($result) )
			return $result->url_long;
		else
			return FALSE;
	}

	public function getUrlHits( $urlHash )
	{
		$query = $this->db->query("
			SELECT * FROM " . self::CU_TABLE . " WHERE `url_id` = '" . $urlHash . "'
		");

		$result = $query->row();

		if ( isset($result) )
			return $result->url_hits;
		else
			return 0;
	}

	public function setUrlHits( $urlHash )
	{
		$hits = $this->getUrlHits($urlHash);
		$hits = $hits + 1;

		$query = $this->db->query("
			UPDATE " . self::CU_TABLE . " SET `url_hits` = '" . (int)$hits . "'
			WHERE `url_id` = '" . $urlHash . "' LIMIT 1
		");

		return $query;
	}

	public function urlCheck( $urlHash )
	{
		$query = $this->db->query("
			SELECT * FROM " . self::CU_TABLE . " WHERE `url_id` = '" . $urlHash . "'
		");

		return $query->row();
	}

}
