<?php

/**
 * Class ClubDeuce_Meta_Boxes_Base
 */
class ClubDeuce_Meta_Boxes_Base extends WPLib_Module_Base {

    const INSTANCE_CLASS = 'ClubDeuce_Meta_Box_Base';

    protected static $meta_boxes = array();

    static function on_load() {

        static::add_class_action( 'init' );

    }

    /**
     * @param string $class
     */
    static function register_meta_box( $class = 'ClubDeuce_Meta_Box_Base' ) {

        static::$meta_boxes[] = $class;

    }

    static function _init() {

        $meta_boxes = array_filter( static::$meta_boxes, function( $class ) {
            return class_exists( $class );
        } );

        array_walk( $meta_boxes, array( __CLASS__, '_add_meta_box') );

    }

    /**
     * @param string $class
     */
    private static function _add_meta_box( $class ) {

        /**
         * @var ClubDeuce_Meta_Box_Base $meta_box
         */
        $meta_box = new $class();

        if ( is_a( $meta_box, 'ClubDeuce_Meta_Box_Base' ) ) {
            $meta_box->register_actions();
        }

    }

}
ClubDeuce_Meta_Boxes_Base::on_load();
