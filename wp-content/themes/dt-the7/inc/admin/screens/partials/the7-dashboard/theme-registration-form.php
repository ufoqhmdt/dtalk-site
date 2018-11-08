<h3><?php esc_html_e( 'Theme Registration', 'the7mk2' ) ?></h3>
<form method="post">
	<?php settings_fields( 'the7_theme_registration' ) ?>

    <p>
		<?php esc_html_e( 'Purchase Code:', 'the7mk2' ) ?>
        <br>
        <input
                id="the7_purchase_code"
                class="of-input"
                name="the7_purchase_code"
                type="text"
                value=""
                size="36"
                title="<?php esc_attr_e( 'Purchase Code', 'the7mk2' ) ?>"
        >
    </p>
    <p>
        <label><input type="checkbox" id="the7-registration-terms">&nbsp;<?php
	    $link = '<a href="https://themeforest.net/licenses/standard" target="_blank">' . _x( 'License', 'registration terms', 'the7mk2' ) . '</a>';
        printf( _x( 'I give my consent to record my site address and purchase code in order to ensure %s and copyright compliance.
I understand that this information will be stored as long as the purchase code remains valid.', 'registration terms', 'the7mk2' ), $link );
            ?></label>
    </p>
    <p>
        <button
                type="submit"
                id="the7-register-theme-button"
                class="button button-primary"
                name="register_theme"
                value="register"
                title="<?php esc_attr_e( 'Register Theme', 'the7mk2' ) ?>"
        ><?php esc_html_e( 'Register Theme', 'the7mk2' ) ?></button>
    </p>
</form>
