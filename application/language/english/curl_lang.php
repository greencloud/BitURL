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

$lang['meta_title']           = config_item('meta_title');
$lang['meta_description']     = config_item('meta_description');

$lang['page_title']           = config_item('page_title');
$lang['page_title_plain']     = config_item('page_title_plain');
$lang['page_slogan']          = 'A forever FREE URL link shortener utility';

$lang['form_label']           = 'Your long URL link';
$lang['form_placeholder']     = 'http://www.example.xyz/somevery/long/sample/query?foo=bar';
$lang['form_submit_btn']      = 'Shorten URL';
$lang['form_reset_btn']       = 'Reset';

$lang['ajax_header']          = 'Your %s Result'; 
$lang['ajax_result_default']  = 'Enter target URL above';
$lang['ajax_copy_title']      = 'Copy URL';
$lang['ajax_copied']          = 'Copied!';
$lang['ajax_invalid_url']     = 'The URL you entered is not valid.';
$lang['ajax_unsaved_url']     = 'URL not saved, try again later.';
$lang['ajax_untitled']        = 'Untitled';

$lang['api_header']           = config_item('page_title') . ' API';
$lang['api_notice']           = 'You can host ' . config_item('page_title') . ' on your own server or integrate it on your website for FREE. For more information, check out <a target="_blank" href="https://github.com/greencloud/' . config_item('page_title_plain') . '">' . config_item('page_title') . ' on Github</a>.';

$lang['copyright']            = '&copy; %s %s. Some rights reserved. | Provided by <a target="_blank" href="https://www.serbits.com/">Serbit Digital</a>';
