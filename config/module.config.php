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
        'thread_model_class'  => 'Zf2Forum\Model\Thread\Thread',
        'message_model_class' => 'Zf2Forum\Model\Message\Message',
        'tag_model_class'     => 'Zf2Forum\Model\Tag\Tag',
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
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/forum',
                    'defaults' => array(
                        'controller' => 'Zf2Forum\Controller\DiscussController',
                        'action' => 'forums',
                    ),
                ),
            ),
            'Zf2Forum' => array(
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/:tagslug{-}-:tagid[/]',
                    'constraints' => array(
                        'tagslug' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'tagid'   => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Zf2Forum\Controller\DiscussController',
                        'action'     => 'threads',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'thread' => array(
                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                        'options' => array(
                            'route'    => ':threadslug{-}-:threadid[/]',
                            'constraints' => array(
                                'threadslug' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'threadid'   => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Zf2Forum\Controller\DiscussController',
                                'action'     => 'messages',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'newmessage' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => 'newmessage',
                                    'defaults' => array(
                                        'action' => 'newmessage'
                                    )
                                )
                            )
                        ),
                    ),
                    'newthread' => array(
                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                        'options' => array(
                            'route'    => 'newthread',
                            'defaults' => array(
                                'controller' => 'Zf2Forum\Controller\DiscussController',
                                'action'     => 'newthread',
                            ),
                        ),
                        'may_terminate' => true,
                    ),
                ),
            ),
        ),
    ),
);
