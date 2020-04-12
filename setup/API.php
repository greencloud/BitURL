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
  
  @param string $url, The actual URL string to be shortened, should be         
  		starting with 'http://' or 'https://'
  @param string $title, The title of the shortened URL for future use
  @param boolean $trim, Wheather to trim down the 'https://' from the result
  @return string, The shortened URL in this format: https://c-url.me/yjBcsP
*/

// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// TO USE THIS CURLIT AS A METHOD IN A CLASS
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

class MyClassName
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function c_URL( $url, $title = '', $trim = false )
	{
		$cu = curl_init();

		// Always encode URLs queries, otherwise this function
		// will return an 'Invalid URL Input' message
		$api_url = 'https://c-url.me/curlit/api?url=' . urlencode($url);

		if ( $title ) $api_url .= '&title=' . urlencode($title);

		$timeout = 5;
		curl_setopt($cu, CURLOPT_URL, $api_url);
		curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($cu, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($cu);

		if ( $trim ) $data = substr($data, 8, strlen($data));
		if ( strpos($data, 'error') ) $data = 'cURLitError';

		curl_close($cu);

		return $data;
	}
}

// TO USE:

$myclass = new MyClassName();

$title = 'My C-URL Link';
$url = 'https://www.example.net/somelongurlquery?foo=bar';

echo $myclass->c_URL($url);             // Plain URL -> https://c-url.me/uWpj82
echo $myclass->c_URL($url, $title);     // With added title for future use
echo $myclass->c_URL($url, '', true);   // Returns -> c-url.me/uWpj82


// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
// TO USE THIS CURLIT AS A REGULAR FUNCTION
// -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

function c_URL( $url, $title = '', $trim = false )
{
	$cu = curl_init();

	// Always encode URLs queries, otherwise this function
	// will return an 'Invalid URL Input' message
	$api_url = 'https://c-url.me/curlit/api?url=' . urlencode($url);

	if ( $title ) $api_url .= '&title=' . urlencode($title);

	$timeout = 5;
	curl_setopt($cu, CURLOPT_URL, $api_url);
	curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($cu, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($cu);
	
	if ( $trim ) $data = substr($data, 8, strlen($data));
	if ( strpos($data, 'error') ) $data = 'cURLitError';

	curl_close($cu);

	return $data;
}

// TO USE:

$title = 'My C-URL Link';
$url = 'https://www.example.net/somelongurlquery?foo=bar';

echo c_URL($url);           // Plain URL -> https://c-url.me/uWpj82
echo c_URL($url, $title);   // With added title for future use
echo c_URL($url, '', true); // Returns -> c-url.me/uWpj82
