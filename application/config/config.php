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

$config['meta_title']           = 'cURLit | URL Shortener Utility';
$config['meta_description']     = '';

$config['page_title']           = 'cURL<span>it</span>';
$config['page_title_plain']     = 'cURLit';

// Don't forget the trailing forward slash at the end
// of the base URL
$config['base_url']             = 'https://domain.xyz/';
$config['base_url_trimmed']     = '//domain.xyz/';
$config['curl_url']             = 'https://dmn.xyz/';
$config['curl_url_trimmed']     = '//dmn.xyz/';

$config['api_notice']           = FALSE;
$config['index_page']           = '';
$config['uri_protocol']         = 'REQUEST_URI';
$config['charset']              = 'UTF-8';
$config['subclass_prefix']      = 'MY_';
$config['permitted_uri_chars']  = 'a-z 0-9~%.:_\-';
$config['log_threshold']        = 1;
$config['log_path']             = '';
$config['log_file_permissions'] = 0644;
$config['log_date_format']      = 'Y-m-d H:i:s';
$config['error_views_path']     = '';
$config['cache_path']           = '';
$config['cache_query_string']   = FALSE;
$config['cookie_prefix']        = 'c_url';
$config['cookie_domain']        = '';
$config['cookie_path']          = '/';
$config['cookie_secure']        = FALSE;
$config['cookie_httponly']      = FALSE;
$config['compress_output']      = FALSE;
