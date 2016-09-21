<?php

/**
 * Class ClubDeuce_Meta_Box_View_Base
 */
class ClubDeuce_Meta_Box_View_Base extends WPLib_View_Base {

    /**
     * This method should be overridden in child classes.
     *
     * @param WP_Post $post
     * @param array   $args
     */
    function the_meta_box( $post, $args = array() ) {

        printf( '<p>%1$s</p>', __( 'Please specify a callback to use for this metabox.', 'clubdeuce' ) );

    }

}
