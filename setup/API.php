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

// NOTE: Refer to the README file to learn how to use this program.

function c_URL( $url )
{
    $ci = curl_init();

	$api_url = 'https://c-url.me/curlit/api?url=';
	$timeout = 5;

	curl_setopt($ci, CURLOPT_URL, $api_url . urlencode($url));
	curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $timeout);

	$data = curl_exec($ci);

	curl_close($ci);

	return $data;
}

$url = 'https://www.example.net/somelongurlquery?foo=bar';
echo c_URL($url);

// Result will be something like: https://c-url.me/uWpj82
