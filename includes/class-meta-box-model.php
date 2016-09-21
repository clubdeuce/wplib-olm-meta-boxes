<?php

/**
 * Class ClubDeuce_Meta_Box_Model_Base
 */
abstract class ClubDeuce_Meta_Box_Model_Base extends WPLib_Model_Base {

    /**
     * @var string
     */
    var $id;

    /**
     * @var string
     */
    var $title;

    /**
     * @var callable|closure
     */
    var $callback;

    /**
     * @var array
     */
    var $screen;

    /**
     * Acceptable values: normal, side, advance
     *
     * @var string
     */
    var $context;

    /**
     * Accetpable values: default, high, low
     *
     * @var string
     */
    var $priority;

    /**
     * @var array
     */
    var $callback_args;

    /**
     * ClubDeuce_Meta_Box_Model_Base constructor.
     * @param array $args
     */
    function __construct( $args = array() ) {

        $args = wp_parse_args( $args, array(
            'id'            => __CLASS__,
            'title'         => __( 'Please specify a title for this metabox', 'clubdeuce_meta_box' ),
            'callback'      => null,
            'screen'        => array(),
            'context'       => 'normal',
            'priority'      => 'default',
            'callback_args' => array(),
        ) );

        if ( empty( $args['screen'] ) ) {
            WPLib::trigger_error( __( 'There are no screens set for this meta box.', 'clubdeuce_meta_box' ) );
        }

        parent::__construct($args);

    }


}