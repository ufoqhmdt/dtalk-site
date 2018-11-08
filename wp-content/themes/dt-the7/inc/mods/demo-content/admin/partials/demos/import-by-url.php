<div id="the7-dashboard" class="wrap the7-import-by-url-page">
    <h1><?php echo esc_html( get_admin_page_title() ) ?></h1>
    <div class="wp-header-end"></div>
    <div class="the7-import-page">
        <form class="the7-import-page-form">
            <label class="screen-reader-text" for="the7-import-page-url"><?php echo esc_html_x( 'Page url to import', 'admin', 'the7mk2' ); ?></label>
            <input type="search" id="the7-import-page-url" class="widefat" value="" placeholder="<?php
                global $typenow;

                $post_type_object = get_post_type_object( $typenow ? $typenow : 'post' );
                echo esc_attr( sprintf( _x( '%s URL (link)', 'admin', 'the7mk2' ), $post_type_object->labels->singular_name ) );
            ?>"/>
            <div class="dt-dummy-button-wrap">
                <button id="the7-import-page-submit" class="button button-primary"><?php echo esc_html_x( 'Import', 'admin', 'the7mk2' ) ?></button>
                <span class="spinner"></span>
            </div>
            <div id="the7-import-progressbar">
                <div class="progress-label"></div>
            </div>
        </form>
    </div>
</div>