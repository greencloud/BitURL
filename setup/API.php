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

/**
 * c_URL()
 *
 * Use this either as a regular function or as a method in a class file
 *
 * @param string $url, The actual URL string to be shortened, should be 
 *        starting with 'http://' or 'https://' 
 * @param boolean $trim, Wheather to trim down the 'https://' from the result
 *
 * @return string, The shortened URL in this format: https://c-url.me/yjBcsP
 */
function c_URL( $url, $trim = false )
{
	$cu = curl_init();

	$api_url = 'https://c-url.me/curlit/api?url=';
	$timeout = 5;
	curl_setopt($cu, CURLOPT_URL, $api_url . urlencode($url));
	curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($cu, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($cu);
	
	if ( $trim ) $data = substr($data, 8, strlen($data));

	curl_close($cu);

	return $data;
}

$url = 'https://www.example.net/somelongurlquery?foo=bar';
echo c_URL($url);


// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
$url = 'https://www.example.net/somelongurlquery?foo=bar';

echo c_URL($url); // Returns  https://c-url.me/uWpj82
echo c_URL($url, true); // Returns  c-url.me/uWpj82
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
