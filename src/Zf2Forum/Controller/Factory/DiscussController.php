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

        return $controller;
    }
}
