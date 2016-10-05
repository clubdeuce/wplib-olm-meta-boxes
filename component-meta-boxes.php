<?php

/**
 * Class ClubDeuce_Meta_Boxes_Base
 */
class ClubDeuce_Meta_Boxes_Base extends WPLib_Module_Base {

    const INSTANCE_CLASS = 'ClubDeuce_Meta_Box';

    protected static $_meta_boxes = array();

    static function on_load() {

        static::add_class_action( 'admin_init' );

    }

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

}
ClubDeuce_Meta_Boxes_Base::on_load();
