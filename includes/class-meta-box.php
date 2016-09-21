<?php

/**
 * Class ClubDeuce_Meta_Box_Base
 *
 * @property ClubDeuce_Meta_Box_Model_Base $model
 * @property ClubDeuce_Meta_Box_View_Base  $view
 * @mixin    ClubDeuce_Meta_Box_Model_Base
 * @mixin    ClubDeuce_Meta_Box_View_Base
 */
class ClubDeuce_Meta_Box_Base extends WPLib_Item_Base {

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
            array( $this->view(), 'the_meta_box' ),
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
