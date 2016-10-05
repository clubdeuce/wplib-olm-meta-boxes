<?php

/**
 * Class ClubDeuce_Meta_Box_Base
 *
 * @property ClubDeuce_Meta_Box_Model $model
 * @property ClubDeuce_Meta_Box_View  $view
 * @mixin    ClubDeuce_Meta_Box_Model
 * @mixin    ClubDeuce_Meta_Box_View
 */
class ClubDeuce_Meta_Box extends WPLib_Item_Base {

    /**
     * Register the action hook callbacks
     */
    function register_actions() {

        foreach( $this->item()->screen as $screen ) {
            add_action( "add_meta_boxes_{$screen}", array( $this, '_add' ) );
        };

    }

    /**
     * Add the meta box
     */
    function _add() {

        add_meta_box(
            $this->item()->id,
            $this->item()->title,
            is_null( $this->item()->callback ) ? array( $this->view(), 'the_meta_box' ) : $this->item()->callback,
            $this->item()->screen,
            $this->item()->context,
            $this->item()->priority,
            $this->item()->callback_args
        );

    }

    /**
     * Remove the meta box
     */
    function remove() {

        remove_meta_box( $this->item()->id, $this->item()->screen, $this->item()->context );

    }

}
