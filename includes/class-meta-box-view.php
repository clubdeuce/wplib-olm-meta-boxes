<?php

use \ClubDeuce\WPLib\Components\Fields;

/**
 * Class ClubDeuce_Meta_Box_View_Base
 */
class ClubDeuce_Meta_Box_View extends WPLib_View_Base {

    /**
     * @param WP_Post $post
     * @param array   $args
     */
    function the_meta_box( $post, $args = array() ) {

        $classname = $this->item->instance_class;
        $item = new $classname( $post );

        foreach ( $this->item->fields as $meta_key ) {
            $params = wp_parse_args( $item->meta_field( $meta_key ), array(
                'type'        => 'text',
                'label'       => ucfirst( str_replace( '_', ' ', $meta_key ) ),
                'name'        => $meta_key,
                'id'          => $meta_key,
                'placeholder' => '',
                'value'       => $item->$meta_key(),
                'class'       => 'widefat',
            ) );

            $method_name = "_render_{$params['type']}_field";

            if ( ! method_exists( $this, $method_name ) ) {
                $method_name = '_render_text_field';
            }

            call_user_func( array( $this, $method_name ), $meta_key, $params );
        }

    }

    private function _render_text_field($id, $params ) {

        print '<p>' . PHP_EOL;
        printf( '<label for="%1$s">%2$s</label>' . PHP_EOL, $params['name'], $params['label'] );
        printf(
            '<input type="text" id="%1$s" name="%2$s" placeholder="%3$s" value="%4$s" class="%5$s"> ' . PHP_EOL,
            $id,
            $params['name'],
            $params['placeholder'],
            $params['value'],
            $params['class']
        );
        print '</p>';

    }

    private function _render_checkbox_field( $id, $params ) {

        print '<p>' . PHP_EOL;
        printf( '<label for="%1$s">%2$s</label>' . PHP_EOL, $params['name'], $params['label'] );
        printf(
            '<input type="checkbox" id="%1$s" name="%2$s" placeholder="%3$s" value="%4$s" class="%5$s"> ' . PHP_EOL,
            $id,
            $params['name'],
            $params['placeholder'],
            $params['value'],
            $params['class']
        );
        print '</p>';

    }
}
