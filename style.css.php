<?php 
   if ( extension_loaded('zlib') and !ini_get('zlib.output_compression') and ini_get('output_handler') != 'ob_gzhandler' and ((version_compare(phpversion(), '5.0', '>=') and ob_get_length() == false) or ob_get_length() === false) ) {
  ob_start('ob_gzhandler');
  }
  header("Cache-Control: public");
  header("Pragma: cache");
  $offset = 86400;//css文件的距离现在的过期时间，这里设置为一天
  $ExpStr = "Expires: ".gmdate("D, d M Y H:i:s", time() + $offset)." GMT";
  $LmStr = "Last-Modified: ".gmdate("D, d M Y H:i:s", filemtime($_SERVER['SCRIPT_FILENAME']))." GMT";
  header($ExpStr);
  header($LmStr);
  header('Content-Type: text/css; charset: UTF-8');
  ob_start("compress");  
  function compress($buffer) {  
    /* remove comments */  
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);  
    /* remove tabs, spaces, newlines, etc. */  
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);  
    return $buffer;  }
?>
<?php
   //包含你的全部css文档
  include_once("style.css");
  include_once("css/animation.css");
  include_once("css/dashicons.css");
  include_once("css/highlight.css");
  include_once("css/mobile.css");
?>
<?php if(extension_loaded(‘zlib’)) {ob_end_flush();} ?>
