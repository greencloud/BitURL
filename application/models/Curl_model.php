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

class Curl_model extends CI_Model
{
	const CU_TABLE = 'curltab_data';

	function __construct()
	{
		parent::__construct();

	}

	/**
	 * saveHashedURL()
	 * 
	 * Save the hash coded shortened URL in the database along with other info
	 * 
	 * @param string $url, The actual long URL
	 * @param string $title, The new title for the existing shortened URL
	 * @param string $urlHash, The 6-digit hash code of the actual URL
	 * @return boolean
	 */
	public function saveHashedURL( $url, $title, $urlHash )
	{
		if ( $this->urlLongCheck($url) )
		{
			if ( $this->updateTitle($url, $title) )
				return TRUE;
			else
				return FALSE;
		} else
		{
			if ( ! $this->urlIdCheck($urlHash) )
			{
				$data = array(
					'id'		=> NULL,
					'url_id'	=> (string)$urlHash,
					'url_title'	=> $title,
					'url_long'	=> $url,
					'url_short'	=> $this->config->item('base_url') . $urlHash,
					'url_hits'	=> 0,
					'url_date'	=> date("Y-m-d H:i:s")
				);

				if ( $this->db->insert(self::CU_TABLE, $data) )
					return TRUE;
				else
					return FALSE;
			}
		}
	}

	/**
	 * updateTitle()
	 * 
	 * Update the title of the already existing shortened URL
	 * 
	 * @param string $url, The actual long URL
	 * @param string $title, The new title for the existing shortened URL
	 * @return boolean
	 */
	public function updateTitle( $url, $title )
	{
		$data = array('url_title' => $title);

		$where = "`url_long` = '" . $url . "'";

		return $this->db->update(self::CU_TABLE, $data, $where);
	}

	/**
	 * getLongURL()
	 * 
	 * Retrieve the original URL from the database to be used to redirect
	 * the hash coded URL to the actual long URL
	 * 
	 * @param string $urlHash, The 6-digit hash code of the actual URL
	 * @return string, The shortened URL string with its hash value
	 */
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

	/**
	 * getUrlHits()
	 * 
	 * Get the number of hits accumulated for a shortened URL
	 * 
	 * @param string $urlHash, The 6-digit hash code of the actual URL
	 * @return int, The number of hits acquired by a shortened URL
	 */
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

	/**
	 * setUrlHits()
	 * 
	 * Update the acquired number of hits by a shortened URL
	 * 
	 * @param string $urlHash, The 6-digit hash code of the actual URL
	 * @return boolean
	 */
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

	/**
	 * setUrlHits()
	 * 
	 * Update the acquired number of hits by a shortened URL
	 * 
	 * @param string $urlHash, The 6-digit hash code of the actual URL
	 * @return boolean
	 */
	public function urlIdCheck( $urlHash )
	{
		$query = $this->db->query("
			SELECT * FROM " . self::CU_TABLE . " WHERE `url_id` = '" . $urlHash . "'
		");

		return $query->row();
	}

	/**
	 * urlLongCheck()
	 * 
	 * Check to see if the long URL exists in the database
	 * 
	 * @param string $url, The actual long URL
	 * @return boolean
	 */
	public function urlLongCheck( $url )
	{
		$query = $this->db->query("
			SELECT * FROM " . self::CU_TABLE . " WHERE `url_long` = '" . $url . "'
		");

		return $query->row();
	}

}
