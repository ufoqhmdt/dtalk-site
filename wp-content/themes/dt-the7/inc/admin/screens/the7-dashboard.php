<?php
// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div id="the7-dashboard" class="wrap">

    <div class="the7-welcome">
        <div class="the7-logo">
            <div class="the7-version"><?php echo esc_html( sprintf( __( 'v.%s', 'the7mk2' ), THE7_VERSION ) ); ?></div>
        </div>
        <h1>
            <?php if ( !presscore_theme_is_activated() ): ?>
                <?php esc_html_e( 'Thank you for choosing The7!', 'the7mk2' ); ?>
            <?php endif; ?>
            <?php if ( presscore_theme_is_activated() ): ?>
                <?php esc_html_e( 'Welcome to The7!', 'the7mk2' ); ?>
            <?php endif; ?>
        </h1>
        <p class="the7-subtitle">
            <?php if ( !presscore_theme_is_activated() ): ?>
                <?php esc_html_e( 'Please register this copy of theme to get access to premium plugins, pre-made websites, 1-click updates and more.', 'the7mk2' ); ?>
                <?php printf( __( 'If you don’t have a license yet, you can purchase it %1$shere%2$s.', 'the7mk2' ), '<a href="https://themeforest.net/item/the7-responsive-multipurpose-wordpress-theme/5556590?ref=Dream-Theme&license=regular&open_purchase_for_item_id=5556590" target="_blank">', '</a>' );?>
            <?php endif; ?>
            <?php if ( presscore_theme_is_activated() ): ?>
                <?php esc_html_e( 'Your copy of theme is registered and ready to rock!', 'the7mk2' ); ?><br>
                <?php esc_html_e( 'We are super excited and honored to see a new member of ever growing The7 family. ', 'the7mk2' ); ?>
            <?php endif; ?>
        </p>
    </div>

    <?php settings_errors( 'the7_theme_registration' ); ?>

    <div class="the7-postbox">
        <h2 class="the7-with-subtitle"><?php esc_html_e( 'Let’s get some work done!', 'the7mk2' ); ?></h2>
        <p class="the7-subtitle"><?php esc_html_e( 'We have assembled useful links to get you started:', 'the7mk2' ); ?></p>

        <div class="the7-column-container">

            <?php if ( ! defined( 'ENVATO_HOSTED_SITE' ) && is_super_admin() ): ?>
            <div class="the7-column" style="width: 40%">
                <?php
                if ( presscore_theme_is_activated() ) {
                    include dirname( __FILE__ ) . '/partials/the7-dashboard/theme-de-registration-form.php';
                } else {
	                include dirname( __FILE__ ) . '/partials/the7-dashboard/theme-registration-form.php';
                }
                ?>
            </div>
            <?php endif; ?>

            <div class="the7-column" style="width: 30%">
                <h3><?php esc_html_e( 'Getting Started', 'the7mk2' ); ?></h3>
                <ul class="the7-links">
                    <li><a href="<?php echo admin_url( 'admin.php?page=the7-demo-content' );?>" class="the7-dashboard-icons-cloud-download"><?php esc_html_e( 'Import a pre-made site', 'the7mk2' ); ?></a></li>
                    <li><a href="<?php echo admin_url( 'admin.php?page=the7-plugins' );?>" class="the7-dashboard-icons-plug"><?php esc_html_e( 'Install or update plugins', 'the7mk2' ); ?></a></li>
                    <li><a href="<?php echo admin_url( 'admin.php?page=options-framework' );?>" class="the7-dashboard-icons-paint-brush"><?php esc_html_e( 'Customize your site', 'the7mk2' ); ?></a></li>
                </ul>
            </div>

            <div class="the7-column" style="width: 30%">
                <h3><?php esc_html_e( 'Guides & Support', 'the7mk2' ); ?></h3>
                <ul class="the7-links">
                    <li><a href="http://guide.the7.io/start/" target="_blank" class="the7-dashboard-icons-rocket"><?php esc_html_e( 'Quick start guide', 'the7mk2' ); ?></a></li>
                    <li><a href="http://guide.the7.io/" target="_blank" class="the7-dashboard-icons-graduation-cap"><?php esc_html_e( 'Advanced user guide', 'the7mk2' ); ?></a></li>
                    <li><a href="http://support.dream-theme.com" target="_blank" class="the7-dashboard-icons-life-bouy"><?php esc_html_e( 'Support portal', 'the7mk2' ); ?></a></li>
                </ul>
            </div>
        </div>
    </div>

    <?php if ( ! defined( 'ENVATO_HOSTED_SITE' ) ): ?>
    <div class="the7-postbox">
        <h2><?php esc_html_e( 'System Status', 'the7mk2' ); ?></h2>
        <table class="the7-system-status" cellspacing="0" cellpadding="0">
            <tr>
                <td><?php _e( 'Install Location:', 'the7mk2' ); ?></td>
                <td>
			        <?php
                    $template_name = 'dt-the7';
			        if ( get_template() === $template_name ) {
				        printf( '<code class="status-good">%s</code>', esc_html_x( 'Standard', 'backend', 'the7mk2' ) );
			        } else {
			            printf( '<code class="status-bad">%s</code> ', esc_html_x( 'Non-standard', 'backend', 'the7mk2' ) );
			            printf( esc_html_x( 'Using The7 from non-standard install location or having a different directory name could lead to issues in receiving and installing updates. Please make sure that theme folder name is %s, without spaces.', 'backend', 'the7mk2' ), "<strong>{$template_name}</strong>" );
			        }
			        ?>
                </td>
            </tr>
            <tr>
                <td><?php _e( 'File System Accessible:', 'the7mk2' ); ?></td>
                <td>
			        <?php
                    global $wp_filesystem;

			        if ( $wp_filesystem || WP_Filesystem() ) {
				        _e( '<code class="status-good">Yes</code>', 'the7mk2' );
			        } else {
				        _e( '<code class="status-bad">No</code> Theme has no direct access to the file system. Therefore plugins and pre-made websites installation is not possible.<br>Please try to insert the following code: <code>define( "FS_METHOD", "direct" );</code><br>before <code>/* That\'s all, stop editing! Happy blogging. */</code> in <code>wp-config.php</code>.', 'the7mk2' );
			        }
			        ?>
                </td>
            </tr>
            <tr>
                <td><?php _e( 'Uploads Folder Writable:', 'the7mk2' ); ?></td>
                <td>
                <?php
                    $wp_uploads = wp_get_upload_dir();
                    if ( wp_is_writable( $wp_uploads['basedir'] . '/' ) ) {
                        _e( '<code class="status-good">Yes</code>', 'the7mk2' ); 
                    } else {
                        echo sprintf( __( '<code class="status-bad">No</code> Uploads folder must be writable to allow WordPress function properly.<br><span class="the7-tip">See <a href="%1$s" target="_blank" rel="noopener noreferrer">changing file permissions</a> or contact your hosting provider.</span>', 'the7mk2' ), 'https://codex.wordpress.org/Changing_File_Permissions' );
                    }
                ?>
                </td>
            </tr>
            <tr>
                <td><?php _e( 'ZipArchive Support:', 'the7mk2' ); ?></td>
                <td>
                <?php
                    if ( class_exists( 'ZipArchive' ) ) {
                        _e( '<code class="status-good">Yes</code>', 'the7mk2' ); 
                    } else {
                        echo sprintf( __( '<code class="status-bad">No</code> ZipArchive is required for plugins installation and pre-made websites import.<br><span class="the7-tip">Please contact your hosting provider.</span>', 'the7mk2' ), 'https://codex.wordpress.org/Changing_File_Permissions' );
                    }
                ?>
                </td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'PHP Version:', 'the7mk2' ); ?></td>
                <td>
                <?php
                    $php_version = PHP_VERSION;
                    if ( version_compare( '7.0.0', $php_version, '>' ) ) {
                        echo sprintf( __( '<code class="status-okay">%1$s</code> Current version is sufficient. However <strong>v.7.0.0</strong> or greater is recommended to improve the performance.', 'the7mk2' ), $php_version );
                    } else {
                        echo sprintf( __( '<code class="status-good">%1$s</code> Current version is sufficient.', 'the7mk2' ), $php_version );
                    }
                ?>
                </td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'PHP Max Input Vars:', 'the7mk2' ); ?></td>
                <td>
                <?php
                    $max_input_vars = ini_get( 'max_input_vars' );
                    if ( $max_input_vars < 1000 ) {
	                    echo sprintf( __( '<code class="status-bad">%1$s</code> Minimum value is <strong>1000</strong>. <strong>2000</strong> is recommended. <strong>3000</strong> or more may be required if lots of plugins are in use and/or you have a large amount of menu items.', 'the7mk2' ), $max_input_vars );
                    } elseif ( $max_input_vars < 2000 ) {
	                    echo sprintf( __( '<code class="status-okay">%1$s</code> Current limit is sufficient for most tasks. <strong>2000</strong> is recommended. <strong>3000</strong> or more may be required if lots of plugins are in use and/or you have a large amount of menu items.', 'the7mk2' ), $max_input_vars );
                    } elseif ( $max_input_vars < 3000 ) {
	                    echo sprintf( __( '<code class="status-good">%1$s</code> Current limit is sufficient. However, up to <strong>3000</strong> or more may be required if lots of plugins are in use and/or you have a large amount of menu items.', 'the7mk2' ), $max_input_vars );
                    } else {
	                    echo sprintf( __( '<code class="status-good">%1$s</code> Current limit is sufficient.', 'the7mk2' ), $max_input_vars );
                    }
                ?>
                </td>
            </tr>
            <tr>
                <td><?php _e( 'WP Memory Limit:', 'the7mk2' ); ?></td>
                <td>
                <?php
                    $memory = presscore_get_wp_memory_limit();
                    $tip = sprintf( __( '<br><span class="the7-tip">See <a href="%1$s" target="_blank" rel="noopener noreferrer">increasing memory allocated to PHP</a> or contact your hosting provider.</span>', 'the7mk2' ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' );
                    if ( $memory < 67108864 ) {
                        echo sprintf( __( '<code class="status-bad">%1$s</code> Minimum value is <strong>64 MB</strong>. <strong>128 MB</strong> is recommended. <strong>256 MB</strong> or more may be required if lots of plugins are in use and/or you want to install the Main Demo.', 'the7mk2' ), size_format( $memory ) );
                        echo $tip;
                    } elseif ( $memory < 134217728 ) {
                        echo sprintf( __( '<code class="status-okay">%1$s</code> Current memory limit is sufficient for most tasks. However, recommended value is <strong>128 MB</strong>. <strong>256 MB</strong> or more may be required if lots of plugins are in use and/or you want to install the Main Demo.', 'the7mk2' ), size_format( $memory ) );
                        echo $tip;
                    } elseif ( $memory < 268435456 ) {
                        echo sprintf( __( '<code class="status-good">%1$s</code> Current memory limit is sufficient. However, <strong>256 MB</strong> or more may be required if lots of plugins are in use and/or you want to install the Main Demo.', 'the7mk2' ), size_format( $memory ) );
                        echo $tip;
                    } else {
                        echo sprintf( __( '<code class="status-good">%1$s</code> Current memory limit is sufficient.', 'the7mk2' ), size_format( $memory ) );
                    }
                ?>
                </td>
            </tr>
            <?php if ( function_exists( 'ini_get' ) ) : ?>
                <tr>
                    <td><?php _e( 'PHP Time Limit:', 'the7mk2' ); ?></td>
                    <td>
                        <?php
                        $time_limit = ini_get( 'max_execution_time' );
                        $tip = sprintf( __( '<br><span class="the7-tip">See <a href="%1$s" target="_blank" rel="noopener noreferrer">increasing max PHP execution time</a> or contact your hosting provider.</span>', 'the7mk2' ), 'http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded' );

                        if ( 30 > $time_limit && 0 != $time_limit ) {
                            echo sprintf( __( '<code class="status-bad">%1$s</code> Minimum value is <strong>30</strong>. <strong>60</strong> is recommended. Up to <strong>300</strong> seconds may be required to install the main demo.', 'the7mk2' ), $time_limit );
                            echo $tip;
                        }
                        else if ( 60 > $time_limit && 0 != $time_limit ) {
                            echo sprintf( __( '<code class="status-okay">%1$s</code> Current time limit is sufficient for most tasks. However, recommended value is <strong>60</strong>. Up to <strong>300</strong> seconds may be required to install the main demo.', 'the7mk2' ), $time_limit );
                            echo $tip;
                        }
                        else if ( 300 > $time_limit && 0 != $time_limit ) {
                            echo sprintf( __( '<code class="status-good">%1$s</code> Current time limit is sufficient. However, up to <strong>300</strong> seconds may be required to install the main demo.', 'the7mk2' ), $time_limit );
                            echo $tip;
                        }
                        else if ( 300 < $time_limit && 0 != $time_limit ) {
                            echo sprintf( __( '<code class="status-good">%1$s</code> Current time limit is sufficient.', 'the7mk2' ), $time_limit );
                        } else {
                            echo sprintf( __( '<code class="status-good">unlimited</code> Current time limit is sufficient.', 'the7mk2' ), $time_limit );
                        }
                        ?>
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
    <?php endif; ?>

    <?php include dirname( __FILE__ ) . '/partials/the7-dashboard/settings.php'; ?>
</div>