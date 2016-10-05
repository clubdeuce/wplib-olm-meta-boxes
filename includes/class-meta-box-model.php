<?php

/**
 * Class ClubDeuce_Meta_Box_Model
 */
class ClubDeuce_Meta_Box_Model extends WPLib_Model_Base {

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
     * @var string
     */
    var $template;

    /**
     * @var string
     */
    var $instance_class;

    /**
     * @var array
     */
    var $fields;

    /**
     * ClubDeuce_Meta_Box_Model constructor.
     * @param array $args
     */
    function __construct( $id, $args = array() ) {

        $args = wp_parse_args( $args, array(
            'id'             => $id,
            'title'          => __( 'Please specify a title for this meta-box', 'clubdeuce_meta_box' ),
            'callback'       => null,
            'screen'         => array(),
            'context'        => 'normal',
            'priority'       => 'default',
            'callback_args'  => array(),
            'template'       => null,
            'instance_class' => 'WPLib_Post',
            'fields'         => array(),
        ) );

        if ( empty( $args['screen'] ) ) {
            WPLib::trigger_error( __( 'There are no screens set for this meta box.', 'clubdeuce_meta_box' ) );
        }

        parent::__construct($args);

    }

    function regiser_field( $id ) {

        $this->fields [ $id ] = $params;

    }

}