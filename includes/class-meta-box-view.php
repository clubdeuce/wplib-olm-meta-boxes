<?php

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
                'callback'    => [ __CLASS__, '_render_field' ],
                'options'     => array(),
            ) );

            if ( is_callable( $params['callback'] ) ) {
                call_user_func( $params['callback'], $meta_key, $params );
            } else {
                WPLib::trigger_error( sprintf( __( 'The specified callback for the field %1$s is not a callable function.' ), $meta_key ) );
            }
        }

    }

    /**
     * @param string $id
     * @param array  $params
     */
    public function _render_field( $id, $params ) {

        $method_name = "_render_{$params['type']}_field";

        if ( ! method_exists( $this, $method_name ) ) {
            $method_name = '_render_text_field';
        }

        call_user_func( array( $this, $method_name ), $id, $params );

    }

	/**
	 * @param string $id
	 * @param array  $params
	 */
    private function _render_text_field( $id, $params ) {

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

	/**
	 * @param string $id
	 * @param array  $params
	 */
    private function _render_checkbox_field( $id, $params ) {

        print '<p>' . PHP_EOL;
        printf( '<label for="%1$s">%2$s</label>' . PHP_EOL, $params['name'], $params['label'] );
        printf(
            '<input type="checkbox" id="%1$s" name="%2$s" value="1" class="%3$s"%4$s> ' . PHP_EOL,
            $id,
            $params['name'],
            $params['class'],
            checked( 1, $params['value'], false )
        );
        print '</p>';

    }

	/**
	 * @param string $id
	 * @param array  $params
	 */
    private function _render_media_uploader_field( $id, $params ) {

        print '<p>' . PHP_EOL;
        printf( '<button type="button" class="media-uploader">%2$s</button>' . PHP_EOL, $id, $params['label'] );
        printf( '<input type="hidden" id="%1$s" name="%2$s" value="%3$s">' . PHP_EOL, $id, $params['name'], $params['value'] );
        print '</p>';

    }

    /**
     * @param string $id
     * @param array  $params
     */
    private function _render_multiselect_field( $id, $params ) {

        print '<p>' . PHP_EOL;
        printf( '<label for="%1$s">%2$s</label>' . PHP_EOL, $params['name'], $params['label'] );
        printf( '<select id="%1$s" name="%2$s[]" class="%3$s" multiple>', $id, $params['name'], $params['class'] );
        array_walk($params['options'], array( __CLASS__, '_render_option' ) );
        print '</select>' . PHP_EOL;
        print '</p>' . PHP_EOL;

    }

	/**
	 * @param string $label
	 * @param string $value
	 * @param bool   $selected
	 */
    private function _render_option( $label, $value, $selected = false ) {

        printf( '<option value="%1$s" %3$s>%2$s</option>', $value, $label, $selected ? 'selected' : '' );

    }

	/**
	 * @param string $id
	 * @param array  $params
	 */
	private function _render_textarea_field( $id, $params ) {

		$params = wp_parse_args( $params, array(
			'class' => 'widefat',
			'cols'  => 50,
			'rows'  => 6
		) );

		print '<p>' . PHP_EOL;
		printf( '<label for="%1$s">%2$s</label>' . PHP_EOL, $params['name'], $params['label'] );
		printf(
			'<textarea id="%1$s" name="%2$s" placeholder="%3$s" class="%4$s" cols="%5$s" rows="%6$s">%7$s</textarea>' . PHP_EOL,
			$id,
			$params['name'],
			$params['placeholder'],
			$params['class'],
			$params['cols'],
			$params['rows'],
			$params['value']
		);
		print '</p>';

	}

}
