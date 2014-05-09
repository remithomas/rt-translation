<?php

namespace RtTranslation\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use RtTranslation\I18n\Translator\Loader\Database as DatabaseLoader;

class DatabaseLoaderFactory implements FactoryInterface 
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get($serviceLocator->get('rt_translation_module_options')->getDbAdapter());
        $database = new DatabaseLoader($adapter);
        return $database;
    }
}