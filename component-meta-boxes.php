<?php

/**
 * Class ClubDeuce_Meta_Boxes_Base
 */
class ClubDeuce_Meta_Boxes_Base extends WPLib_Module_Base {

    const INSTANCE_CLASS = 'ClubDeuce_Meta_Box';

    protected static $_meta_boxes = array();

    static function on_load() {

        static::add_class_action( 'admin_init' );
	    static::add_class_action( 'admin_enqueue_scripts' );

    }

	/**
	 *
	 */
    static function _admin_init() {

        array_walk( static::$_meta_boxes, function( $params, $id ) {

            $params = wp_parse_args( $params, array(
                'id' => $id,
            ) );

            (new ClubDeuce_Meta_Box( $params ) )->register_actions();
        } );

    }

    /**
     * @param string $id
     * @param array  $args
     */
    static function register_meta_box( $id, $args = array() ) {

        static::$_meta_boxes[ $id ] = $args;

    }

	/**
	 *
	 */
    static function _admin_enqueue_scripts() {

    	wp_enqueue_script( 'mb-control', self::source_url() . '/assets/scripts.js', array ( 'jquery-ui-datepicker' ), null, true );
	    wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css', array(), null, 'all' );

    }

	/**
	 * @return mixed
	 */
    static function source_url() {

    	$path = __DIR__;

	    $url = str_replace( WP_CONTENT_DIR, WP_CONTENT_URL, $path );

	    return $url;

    }

}
ClubDeuce_Meta_Boxes_Base::on_load();
