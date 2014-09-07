<?php

namespace RtTranslation\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface,
    \Zend\I18n\Translator\Translator;

class DatabaseTranslationService implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // options of the Module
        $options = $serviceLocator->get('rt_translation_module_options');
        
        // Database adapter
        $adapter = $serviceLocator->get($options->getDbAdapter());
        
        // Plugin manager to load I18n plugin
        $pluginManager = new \Zend\I18n\Translator\LoaderPluginManager();
        $pluginManager->setServiceLocator($serviceLocator);
        $pluginManager->setFactory('rt_translation_plugin_translator', function () use ($adapter)
        {
            return new \RtTranslation\I18n\Translator\Loader\Database($adapter);
        });
        
        // Translator
        $translator = Translator::factory(array());

        // fallback locale
        $translator->setFallbackLocale('en_US');
        
        //
        $translator->setPluginManager($pluginManager);

        // text domains
        if(is_array($options->getTextDomains()) && count($options->getTextDomains())>0){
            foreach ($options->getTextDomains() as $textDomain){
                $translator->addRemoteTranslations('rt_translation_plugin_translator', $textDomain);
            }
        }else{
            $textDomains = $serviceLocator->get("rt_translation_translation_service")->getTextDomains();
            foreach ($textDomains as $textDomain){
                $translator->addRemoteTranslations('rt_translation_plugin_translator', $textDomain);
            }
        }
        
        return $translator;
    }
}