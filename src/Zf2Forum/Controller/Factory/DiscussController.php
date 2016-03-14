<?php
namespace Zf2Forum\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zf2Forum\Controller\DiscussController as controller;

class DiscussController implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $parentLocator = $sm->getServiceLocator();

        $controller = new controller();
        $controller->setUserMapper($parentLocator->get('zfcuser_user_mapper'));
        $controller->setModuleOptions($parentLocator->get('Zf2Forum\ModuleOptions'));
        $controller->setDiscussService($parentLocator->get('Zf2Forum_discuss_service'));

        return $controller;
    }
}
