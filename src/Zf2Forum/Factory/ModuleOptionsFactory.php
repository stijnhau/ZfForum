<?php

namespace Zf2Forum\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Zf2Forum\Options\ModuleOptions;

class ModuleOptionsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $moduleConfig = isset($config['zf2forum']) ? $config['zf2forum'] : array();
        return new ModuleOptions($moduleConfig);
    }
}
