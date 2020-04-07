<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config['meta_title']           = 'C-URL | URL Shortener Utility';
$config['meta_description']     = '';

$config['page_title']           = 'C<span>-</span>URL';
$config['page_title_plain']     = 'C-URL';

// Don't forget the trailing forward slash at the end
// of the base URL
$config['base_url']             = 'https://c-url.me/';

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
