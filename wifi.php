<?php
/*
Plugin Name: Localhost WIFI access
Description: Allows access to your localhost WordPress web trough your LAN
Version: 1.0
*/

include "admin.php";

$mask = get_option('lsp_wifi_ip_mask');
if (!$mask) $mask = '192.168.1.';
$mask = str_replace('.', '\.', $mask);
if(preg_match('#^'.$mask.'\d+#', $_SERVER['REMOTE_ADDR'])) {
  function replace_domain($buffer) {
    // modify buffer here, and then return the updated code
    $newsiteurl = get_option('siteurl');
    $newsiteurl = preg_replace('#https?://([^/]+)/(.*)#', "http".(!empty($_SERVER['HTTPS'])?'s':'')."://{$_SERVER['HTTP_HOST']}/$2", $newsiteurl);
    return str_replace(get_option('siteurl'), $newsiteurl, $buffer);
  }
  
  function buffer_start() { ob_start("replace_domain"); }

  function buffer_end() { ob_end_flush(); }
  
  add_action('wp', 'buffer_start');
  add_action('wp_footer', 'buffer_end');
}