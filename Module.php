<?php

namespace RtTranslation;

use Zend\Mvc\MvcEvent;

use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\ServiceManager\ServiceManager;

use Locale;

use Zend\Mvc\ModuleRouteListener;
use Zend\EventManager\Event;
use Zend\I18n\Translator\Translator;
use Zend\Session\Container;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;

use RtTranslation\Form;

class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ServiceProviderInterface
{
    
    const SESSION_LOCALE = 'RtTranslationLocale';
    
    public function onBootstrap(MvcEvent $e)
    {
        $application        = $e->getTarget();
        $serviceManager     = $application->getServiceManager();
        $eventManager       = $application->getEventManager();
        $events             = $eventManager->getSharedManager();
        
        
        // Session container
        $sessionContainer = new Container(self::SESSION_LOCALE);
        
        // teste si la langue en session existe
        if(!$sessionContainer->offsetExists('mylocale')){
            // n'existe pas donc on ajoute la langue du navigateur
            if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
                $sessionContainer->offsetSet('mylocale', Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']));
            }else{
                $sessionContainer->offsetSet('mylocale', 'en_US');
            }
            
        }
        
        //\Zend\Debug\Debug::dump($serviceManager->get('translator'));
        
        // mise en place du service de traduction
        $translator = $serviceManager->get('translator');
        $translator->enableEventManager();
        $translator ->setLocale($sessionContainer->mylocale);
        $mylocale = $sessionContainer->mylocale;
        
        $viewHelper = $serviceManager->get('viewHelperManager');
        
        // translator help to all view helpers
        $viewHelper->setInvokableClass('rt_translation_plugin_translator', '\RtTranslation\I18n\Translator\Loader\Database', true);
        //$viewHelper = $serviceManager->get('viewHelperManager');
        $viewHelper->get("translate")->setTranslator($translator);
        $viewHelper->get("translatePlural")->setTranslator($translator);
        $viewHelper->get("formInput")->setTranslator($translator);
        
        
        $events->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function(MvcEvent $e) use ($mylocale) {
            $controller      = $e->getTarget();
            $controller->layout()->mylocale = $mylocale;
        }, 100);
        
        // collector
        $collector = $serviceManager->get('RtTranslation\ConfigCollector');
        $events->attach('Zend\I18n\Translator\Translator', Translator::EVENT_MISSING_TRANSLATION, function ($e)  use ($collector){
            $params = $e->getParams();
            $collector->addTranslationCall($params['message'], $params['text_domain'], $params['locale'], true);
        });
        
        
    }
    
    protected function setTranslatorToHelpers(){
        $viewHelper = $serviceManager->get('viewHelperManager');
        $viewHelper->get("translate")->setTranslator($translator);
        $viewHelper->get("translatePlural")->setTranslator($translator);
        $viewHelper->get("formInput")->setTranslator($translator);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'currentLocale' => function($sm) {
                    $locator = $sm->getServiceLocator();
                    return new \RtTranslation\View\Helper\RtTranslationCurrentLocale();
                },
                'translate' => function($sm){
                    $locator = $sm->getServiceLocator();
                    $translateHelper = new \RtTranslation\View\Helper\Translate();
                    $translateHelper->setServiceLocator($locator);
                    return $translateHelper;
                }
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'allow_override' => true,
            'invokables' => array(
                'RtTranslation\Form\Locale'             => 'RtTranslation\Form\LocaleForm',
                'RtTranslation\Form\Key'                => 'RtTranslation\Form\KeyForm',
                'RtTranslation\Form\Translation'        => 'RtTranslation\Form\TranslationForm',
                'rt_translation_translation_service'    => 'RtTranslation\Service\TranslationService',
                //'rt_translation_plugin_translator'      => 'RtTranslation\Service\DatabaseLoaderFactory',
            ),
            'aliases' => array(
                'MvcTranslator' => "translator"
            ),
            'factories' => array(
                'rt_translation_locale_table' => function(ServiceManager $sm) {
                    $options = $sm->get('rt_translation_module_options');
                    $adapter = $sm->get($options->getDbAdapter());
                    $table = new Model\LocaleTable($adapter);
                    return $table;
                },
                'rt_translation_key_table' => function(ServiceManager $sm) {
                    $options = $sm->get('rt_translation_module_options');
                    $adapter = $sm->get($options->getDbAdapter());
                    $table = new Model\KeyTable($adapter);
                    return $table;
                },
                'rt_translation_translation_table' => function(ServiceManager $sm) {
                    $options = $sm->get('rt_translation_module_options');
                    $adapter = $sm->get($options->getDbAdapter());
                    $table = new Model\TranslationTable($adapter);
                    return $table;
                },
                'rt_translation_module_options' => function (ServiceManager $sm) {
                    $config = $sm->get('Config');
                    return new Options\ModuleOptions(isset($config['RtTranslation']) ? $config['RtTranslation'] : array());
                },
                'rt_translation_locale_form' => function(ServiceManager $sm) {
                    $form = new Form\LocaleForm();
                    $form   ->setInputFilter(new Form\LocaleFilter());
                    // assign hydrator
                    $hydrator = new DoctrineHydrator($sm->get('doctrine.entitymanager.orm_default'), get_class(new Entity\Locale()));
                    $form->setHydrator($hydrator);
                    return $form;
                },
                'rt_translation_key_form' => function(ServiceManager $sm) {
                    $form = new Form\KeyForm();
                    $form->setInputFilter(new Form\KeyFilter());
                    // assign hydrator
                    $hydrator = new DoctrineHydrator($sm->get('doctrine.entitymanager.orm_default'), get_class(new Entity\Key()));
                    $form->setHydrator($hydrator);
                    return $form;
                },
                'rt_translation_translation_form' => function(ServiceManager $sm) {
                    $form = new Form\TranslationForm($sm->get('doctrine.entitymanager.orm_default'));
                    $form->setInputFilter(new Form\TranslationFilter());
                    $hydrator = new DoctrineHydrator($sm->get('doctrine.entitymanager.orm_default'), get_class(new Entity\Translation()));
                    $form->setHydrator($hydrator);
                    return $form;
                },  
                        
                'rt_translation_plugin_translator' => function($sm){
                    //$databaseLoader = new \RtTranslation\Service\DatabaseLoaderFactory();
                    //return $databaseLoader->createService($sm);
                    $options = $sm->get('rt_translation_module_options');
                    $adapter = $sm->get($options->getDbAdapter());
                    return new \RtTranslation\I18n\Translator\Loader\Database($adapter);
                },
                        
                'translator' => function($sm){
                    $translator = new \RtTranslation\Service\DatabaseTranslationService();
                    return $translator->createService($sm);
                },
                
            ),
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
}
