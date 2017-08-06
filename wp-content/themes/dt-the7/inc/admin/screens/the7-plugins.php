<?php
// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @var The7_TGMPA $tgmpa
 */
global $tgmpa;

// If there is another $tgmpa registered.
if ( ! is_a( $tgmpa, 'The7_TGMPA' ) ) {
    $tgmpa_file = __( 'cannot find class file', 'the7mk2' );
    if ( class_exists( 'ReflectionClass', false ) ) {
	    $tgmpaReflection = new ReflectionClass( get_class( $tgmpa ) );
	    $tgmpa_file = str_replace( ABSPATH, '', $tgmpaReflection->getFileName() );
    }
?>
<div id="the7-dashboard" class="wrap">
    <h1><?php esc_html_e( 'Recommended Plugins', 'the7mk2' ); ?></h1>
    <div class="the7-postbox">
        <p><?php
	        /* translators: 1: file. */
            echo wp_kses_post( sprintf( __( 'There is a conflict with external TGM_Plugin_Activation class %s. Please turn off plugin that uses TGM_Plugin_Activation or contact our support.', 'the7mk2' ), "<code>{$tgmpa_file}</code>" ) );
            ?></p>
    </div>
</div>
   <?php

    return;
}

if ( isset( $_POST['just_install'] ) ) {
    $tgmpa->is_automatic = false;
}

// Store new instance of plugin table in object.
$plugin_table = new The7_Plugins_List_Table();

// Return early if processing a plugin installation action.
if ( ( ( 'tgmpa-bulk-install' === $plugin_table->current_action() || 'tgmpa-bulk-update' === $plugin_table->current_action() ) && $plugin_table->process_bulk_actions() ) || $tgmpa->public_do_plugin_install() ) {
	return;
}

// Force refresh of available plugin information so we'll know about manual updates/deletes.
wp_clean_plugins_cache( false );

?>
<div id="the7-dashboard" class="wrap">
    <h1><?php esc_html_e( 'Recommended Plugins', 'the7mk2' ); ?></h1>
        <?php $plugin_table->prepare_items(); ?>
        <?php $plugin_table->views(); ?>

        <form id="tgmpa-plugins" action="" method="post">
            <input type="hidden" name="tgmpa-page" value="<?php echo esc_attr( $tgmpa->menu ); ?>" />
            <input type="hidden" name="plugin_status" value="<?php echo esc_attr( $plugin_table->view_context ); ?>" />
            <?php $plugin_table->display(); ?>
        </form>
</div>