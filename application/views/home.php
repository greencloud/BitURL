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

?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title><?= $this->lang->line('meta_title');?></title>
    <meta name="description" content="<?= $this->lang->line('meta_description');?>" />
    <meta name="robots" content="index,follow" />
    <meta name="author" content="Rasmus van Guido (genx.social/u/greencloud)" />

    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet" />
    <link href="//cdn-sttc1.srbts.me/img/favicon.ico?i=eb6ba0d5" rel="shortcut icon" type="image/x-icon" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <link href="//fa.srbts.me/fontawesome/css/all.min.css" rel="stylesheet" />
    <link href="<?= base_url();?>assets/biturl.css" rel="stylesheet" />

    <script src="//code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="//fa.srbts.me/fontawesome/js/all.min.js"></script>

</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1><?= $this->lang->line('page_title');?></h1>
        <p><?= $this->lang->line('page_slogan');?></p>
    </div>
    <div class="content">
        <form name="biturl" id="biturl" action="<?= base_url();?>biturl/input/" method="post">
        <div class="form-group">
            <label for="btinput"><?= $this->lang->line('form_label');?>:</label>
            <input type="text" name="btinput" class="form-control btinput" id="btinput" value="" placeholder="<?= $this->lang->line('form_placeholder');?>" required />
            <input type="submit" value="<?= $this->lang->line('form_submit_btn');?>" class="btn btn-primary" />
            <input type="reset" value="<?= $this->lang->line('form_reset_btn');?>" class="btn btn-dark" />
            <span id="loader"></span>
        </div>
        </form>
        <div>
            <hr />
            <p><strong><?= sprintf($this->lang->line('ajax_header'), $this->lang->line('page_title_plain'));?>: &nbsp;</strong>
                <input id="result" class="result" value="" placeholder="<?= $this->lang->line('ajax_result_default');?>" />&nbsp;
                <span class="far fa-copy" id="copyurl" title="<?= $this->lang->line('ajax_copy_title');?>"></span></p>
        </div>
    </div>
    <div class="footer">
        <hr />
        <h4><?= $this->lang->line('api_header');?></h4>
        <p><?= $this->lang->line('api_notice');?></p>
        <hr />
        <footer>
            <div>
                <span><?= sprintf($this->lang->line('copyright'), date('Y'), $this->lang->line('page_title_plain'));?></span>
            </div>
        </footer>
    </div>
<script>
  $(document).ready(function(){

    $('#biturl').on('submit', function(e){
      e.preventDefault();

      var inputurl = $('#btinput').val();

      $('#loader').empty();

      if ( inputurl.length > 5 ) {
        $.ajax({
          type: 'post',
          url: '<?= base_url();?>biturl/input/',
          data: $(this).serialize(),
          dataType: 'json',
          cache: false,
          beforeSend: function() {
            $('#loader').html('<img src="assets/loader.gif" />');
          },
          success: function(json) {
            $('#loader').html('');

            if (json['error']) {
              $('#result').attr('value', json['error_msg']).css('color', '#db504a');
            } else {
              $('#result').attr('value', json['output_url']).css('color', '#254441');
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
        });
      }
    });
    
    $('#reset').on('click', function(){
      $('#result').attr('value', '');
    });

    $('#copyurl').on('click', function(){
      //...
    });
  });
</script>
</div>
</body>
</html>
