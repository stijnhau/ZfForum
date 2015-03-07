<?php
return array(
    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),

    'Zf2Forum' => array(
        'topic_model_class'     => 'Zf2Forum\Model\Topic\Topic',
        'message_model_class' => 'Zf2Forum\Model\Message\Message',
        'category_model_class'  => 'Zf2Forum\Model\Category\Category',
        'visit_model_class'   => 'Zf2Forum\Model\Visit\Visit'
    ),
    'service_manager' => array(
        'aliases' => array(
            'Zf2Forum_zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
        ),
    ),
    'view_manager' => array('template_path_stack' => array(__DIR__ . '/../view')),
    'controllers' => array(
        'invokables' => array(
            'Zf2Forum\Controller\DiscussController' => 'Zf2Forum\Controller\DiscussController'
        ),
    ),
    'router' => array(
        'routes' => array(
            'forum' => array(
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/forum',
                    'defaults' => array(
                        'controller'    => 'Zf2Forum\Controller\DiscussController',
                        'action'        => 'forums',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'category' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/category/:categoryid',
                            'defaults' => array(
                                'action' => 'threads',
                            ),
                            'constraints' => array(
                                'categoryid' => '[0-9]*'
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'newthread' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/newthread',
                                    'defaults' => array(
                                        'action' => 'newthread',
                                    ),
                                ),
                                'may_terminate' => true,
                            ),
                        )
                    ),
                    'topic' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/topic/:topicid',
                            'defaults' => array(
                                'action' => 'messages',
                            ),
                            'constraints' => array(
                                'topicid' => '[0-9]*'
                            ),
                        ),
                    ),
                )
            ),
        ),
    ),
);
