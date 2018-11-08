<?php
// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div id="the7-dashboard" class="wrap">
    <div class="the7-postbox">
        <h2><?php esc_html_e( 'Re-Install theme', 'the7mk2' ) ?></h2>
        <p class="the7-subtitle"><?php echo sprintf( esc_html( 'If you need to re-install version %s, you can do so here:' ), THE7_VERSION ) ?></p>
        <form action="update.php?action=upgrade-theme&the7-force-update=true" method="post" name="upgrade-themes">
		    <?php wp_nonce_field( 'upgrade-theme_dt-the7' ) ?>
            <input type="hidden" name="theme" value="dt-the7">
            <button class="button button-primary" name="upgrade">Re-install The7</button>
        </form>
    </div>
    <div class="the7-postbox">
        <h2><?php esc_html_e( 'Enable Beta tester mode', 'the7mk2' ) ?></h2>
        <p><?php esc_html_e( 'This mode allow you to use beta version of theme and plugins.', 'the7mk2' ) ?></p>
        <form action="admin.php?page=the7-dev" method="post" name="beta-tester">
			<?php wp_nonce_field( 'the7-dev-beta-tester' ) ?>
            <label for="the7-dev-beta-tester"><?php esc_html_e( 'Beta-tester', 'the7mk2' ) ?></label>
            &nbsp;<input type="checkbox" id="the7-dev-beta-tester" name="beta-tester" <?php checked( The7_Dev_Beta_Tester::get_status(), 1 ) ?>>
            <p>
                <button class="button button-primary" name="save"><?php esc_html_e( 'Save', 'the7mk2' ) ?></button>
            </p>
        </form>
    </div>
</div>
