<?php
/*
  Admin page for getting Twitter data
*/

// Init admin page
add_action('admin_init', 'lsp_admin_init');

/**
 * Init admin page, registering settings
 */
function lsp_admin_init() {
  // One setting for each twitter oauth data
	register_setting( 'lsp_settings_group', 'lsp_wifi_ip_mask' );
}



// Create custom plugin settings menu
add_action('admin_menu', 'lsp_create_menu');

/**
 * Creates admin page
 */
function lsp_create_menu() {
  global $ic_fc_admin_page;
  $ic_fc_admin_page = add_management_page('WIFI Access', 'WIFI Access', 'administrator', 'wifi-access', 'lsp_settings_page');
  // When the admin page is shown loads a css  
  add_action('load-'.$ic_fc_admin_page, 'lsp_admin_page_init');  
}



/**
 * Loads css when admin page is loaded
 */
function lsp_admin_page_init() {
  global $ic_fc_admin_page;
  $screen = get_current_screen();
  // If is admin page enqueue styles
  if ($ic_fc_admin_page == $screen->id) {
    add_action( 'admin_enqueue_scripts', 'lsp_admin_css' );
  }
}



/**
 * Displays admin page
 */
function lsp_settings_page() {

?>
<div class="wrap lsp_wifi">
<h2><?php _e('Localhost WIFI ACCESS', 'displaynone'); ?></h2>
<?php if( isset($_GET['settings-updated']) ) { ?>
    <div id="message" class="updated">
        <p><strong><?php _e('Options updated.', 'displaynone'); ?></strong></p>
    </div>
<?php } ?>
<form method="post" action="options.php">
    <?php settings_fields( 'lsp_settings_group' ); ?>
    <?php do_settings_sections( 'lsp_settings_page' ); ?>
    <h3><?php _e('IP Mask', 'displaynone'); ?></h3>
    <p><?php _e('Sets your LAN IP mask, usually <strong>192.168.1.</strong>', 'displaynone'); ?></p>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php _e('Mask', 'displaynone'); ?></th>
        <td><input type="text" name="lsp_wifi_ip_mask" value="<?php echo get_option('lsp_wifi_ip_mask'); ?>" class="regular-text" placeholder="192.168.1." /></td>
        </tr>
        
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php }


/**
 * Loads admin CSS, really it's only a icon in the header
 */
function lsp_admin_css() {
  // The css only shows a Twitter icon using dashicons in the <h2> title
  wp_enqueue_style( 'lsp_admin', plugins_url( './css/admin.css', __FILE__ ) );
}