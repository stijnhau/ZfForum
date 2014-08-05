<?php

namespace Zf2Forum;

use Zend\ModuleManager\ModuleManager;

class Module
{
    protected static $options;

    public function init(ModuleManager $moduleManager)
    {
        $moduleManager->getEventManager()->attach('loadModules.post', array($this, 'modulesLoaded'));
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'Zf2Forum_post_form_hydrator'   => 'Zend\Stdlib\Hydrator\ClassMethods',
                'Zf2Forum_thread'               => 'Zf2Forum\Model\Thread\Thread',
                'Zf2Forum_message'              => 'Zf2Forum\Model\Message\Message',
                'Zf2Forum_form'                 => 'Zf2Forum\Form\PostForm',
            ),
            'factories' => array(
                'Zf2Forum\ModuleOptions'        => 'Zf2Forum\Factory\ModuleOptionsFactory',
                'Zf2Forum_user_mapper'          => 'Zf2Forum\Factory\UserMapperFactory',
                
                'Zf2Forum_discuss_service' => function($sm) {
                    $service = new \Zf2Forum\Service\Discuss;
                    $service->setThreadMapper($sm->get('Zf2Forum_thread_mapper'))
                            ->setMessageMapper($sm->get('Zf2Forum_message_mapper'))
                            ->setTagMapper($sm->get('Zf2Forum_tag_mapper'))
                            ->setVisitMapper($sm->get('Zf2Forum_visit_mapper'));
                    return $service;
                },
                'Zf2Forum_thread_mapper' => function($sm) {
                    $mapper = new \Zf2Forum\Model\Thread\ThreadMapper;
                    //$threadModelClass = static::getOption('thread_model_class');
                    $threadModelClass = Module::getOption('thread_model_class');
                    $mapper->setEntityPrototype(new $threadModelClass);
                    $mapper->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                    return $mapper;

                },
                'Zf2Forum_tag_mapper' => function($sm) {
                    $mapper = new \Zf2Forum\Model\Tag\TagMapper;
                    //$tagModelClass = static::getOption('tag_model_class');
                    $tagModelClass = Module::getOption('tag_model_class');
                    $mapper->setEntityPrototype(new $tagModelClass);
                    $mapper->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                    return $mapper;
                },
                'Zf2Forum_message_mapper' => function($sm) {
                    $mapper = new \Zf2Forum\Model\Message\MessageMapper;
                    //$messageModelClass = static::getOption('message_model_class');
                    $messageModelClass = Module::getOption('message_model_class');
                    $mapper->setEntityPrototype(new $messageModelClass);
                    $mapper->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                    return $mapper;
                },
                'Zf2Forum_visit_mapper' => function($sm) {
                    $mapper = new \Zf2Forum\Model\Visit\VisitMapper;
                    $visitModelClass = Module::getOption('visit_model_class');
                    $mapper->setEntityPrototype(new $visitModelClass);
                    $mapper->setHydrator(new \Zend\StdLib\Hydrator\ClassMethods);
                    return $mapper;
                },
                'Zf2Forum_visit' => function ($sm) {
                    $visit = new \Zf2Forum\Model\Visit\Visit;
                    $visit->setIpAddress($_SERVER['REMOTE_ADDR'])
                          ->setVisitTime(new \DateTime);
                    return $visit;
                }
            ),
            'initializers' => array(
                function($instance, $sm){
                    if ($instance instanceof Service\DbAdapterAwareInterface) {
                        $dbAdapter = $sm->get('Zf2Forum_zend_db_adapter');
                        return $instance->setDbAdapter($dbAdapter);
                    }
                },
            ),
        );

    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function modulesLoaded($e)
    {
        $config = $e->getConfigListener()->getMergedConfig();
        static::$options = $config['Zf2Forum'];
    }

    /**
     * @TODO: Come up with a better way of handling module settings/options
     */
    public static function getOption($option)
    {
        if (!isset(static::$options[$option])) {
            return null;
        }
        return static::$options[$option];
    }
    
    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'RenderForm'    => 'Zf2Forum\View\Helper\RenderForm',
                'menu_helper'   => 'PrivateMessaging\View\Helper\Menuhelper'
            )
        );
    
    }
}
