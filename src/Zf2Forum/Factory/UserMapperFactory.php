<?php

namespace Zf2Forum\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Zf2Forum\Mapper\UserMapper;
use Zend\Crypt\Password\Bcrypt;

class UserMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $zfcuserOptions = $serviceLocator->get('zfcuser_module_options');
        $options = $serviceLocator->get('Zf2Forum\ModuleOptions');
        
        $mapper = new UserMapper();
        $mapper->setDbAdapter($serviceLocator->get('Zf2Forum_zend_db_adapter'));
        $entityClass = $zfcuserOptions->getUserEntityClass();
        $mapper->setEntityPrototype(new $entityClass);
        $mapper->setHydrator(new \ZfcUser\Mapper\UserHydrator(new Bcrypt()));
        $mapper->setTableName($zfcuserOptions->getTableName());
        $mapper->setCurrentUser($serviceLocator->get('zfcuser_auth_service')->getIdentity());
        $mapper->setUserColumn($options->getUserColumn());
        
        return $mapper;
    }
}
