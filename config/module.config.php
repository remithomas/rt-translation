<?php
namespace RtTranslation;

return array(
    
    /* ZendDeveloperTools Configuration */
    'zenddevelopertools' => array(
        'profiler' => array(
            'collectors' => array(
                'rt_translation_translations' => 'RtTranslation\ConfigCollector',
            ),
        ),
        'toolbar' => array(
            'entries' => array(
                'rt_translation_translations' => 'zend-developer-tools/toolbar/rt-translation-translations',
            ),
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'changelocale' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/changelocale[/:locale]',
                    'defaults' => array(
                        'controller' => 'RtTranslation\Controller\Translation',
                        'action' => 'changelocale',
                        'locale' => '',
                    ),
                    'constraints' => array (
                        'locale' => '[a-zA-Z][a-zA-Z0-9_-]+',
                     )
                ),
            ),
            'developer' => array(
                'child_routes' => array(
                    'translation' => array(
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => array(
                            'route'    => '/translation',
                            'defaults' => array(
                                'controller' => 'RtTranslation\Controller\Translation',
                                'action'     => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'locale' => array(
                                'type' => 'Zend\Mvc\Router\Http\Literal',
                                'options' => array(
                                    'route'    => '/locale',
                                    'defaults' => array(
                                        'controller' => 'RtTranslation\Controller\Translation',
                                        'action'     => 'locale',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    'add' => array(
                                        'type' => 'Zend\Mvc\Router\Http\Literal',
                                        'options' => array(
                                            'route'    => '/add',
                                            'defaults' => array(
                                                'controller' => 'RtTranslation\Controller\Translation',
                                                'action'     => 'addlocale',
                                            ),
                                        ),
                                    ),
                                    'edit' => array(
                                        'type' => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/edit/:localeId',
                                            'defaults' => array(
                                                'controller' => 'RtTranslation\Controller\Translation',
                                                'action'     => 'editlocale',
                                            ),
                                            'constraints' => array(
                                                'localeId' => '[0-9]+',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                            'key' => array(
                                'type' => 'Zend\Mvc\Router\Http\Literal',
                                'options' => array(
                                    'route'    => '/key',
                                    'defaults' => array(
                                        'controller' => 'RtTranslation\Controller\Translation',
                                        'action'     => 'key',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    'add' => array(
                                        'type' => 'Zend\Mvc\Router\Http\Literal',
                                        'options' => array(
                                            'route'    => '/add',
                                            'defaults' => array(
                                                'controller' => 'RtTranslation\Controller\Translation',
                                                'action'     => 'addkey',
                                            ),
                                        ),
                                    ),
                                    'edit' => array(
                                        'type' => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/edit/:keyId',
                                            'defaults' => array(
                                                'controller' => 'RtTranslation\Controller\Translation',
                                                'action'     => 'editkey',
                                            ),
                                            'constraints' => array(
                                                'keyId' => '[0-9]+',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                            'translation' => array(
                                'type' => 'Zend\Mvc\Router\Http\Literal',
                                'options' => array(
                                    'route'    => '/translation',
                                    'defaults' => array(
                                        'controller' => 'RtTranslation\Controller\Translation',
                                        'action'     => 'translation',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    'add' => array(
                                        'type' => 'Zend\Mvc\Router\Http\Literal',
                                        'options' => array(
                                            'route'    => '/add',
                                            'defaults' => array(
                                                'controller' => 'RtTranslation\Controller\Translation',
                                                'action'     => 'addtranslation',
                                            ),
                                        ),
                                    ),
                                    'edit' => array(
                                        'type' => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/edit/:key',
                                            'defaults' => array(
                                                'controller' => 'RtTranslation\Controller\Translation',
                                                'action'     => 'edittranslation',
                                            ),
                                            'constraints' => array(
                                                'locale' => '[a-zA-Z][a-zA-Z0-9_-]+',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'classes' => array(
            'RtTranslation\Controller\Translation' => 'RtTranslation\Controller\TranslationController',
        ),
        'invokables' => array(
            'RtTranslation\Controller\Translation' => 'RtTranslation\Controller\TranslationController',
        ),
    ),
    'view_helpers' => array(  
        'invokables' => array(  
            
        )  
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => array(
            'rt-translation/translation/index' => __DIR__ . '/../view/rt-translation/translation/index.phtml',
            'zend-developer-tools/toolbar/rt-translation-translations' => __DIR__ . '/../view/zend-developer-tools/toolbar/rt-translation-translations.phtml'
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'RtTranslation\ConfigCollector'   => 'RtTranslation\Collector\ConfigCollector',
        ),
        'factories' => array(
            
        ),
        'aliases' => array(
            'rt_translation_db_translator' => 'Zend\Db\Adapter\Adapter',
        ),
    ),
    'factories' => array(
        //'rt_translation_plugin_translator' => 'RtTranslation\Service\DatabaseLoaderFactory',
        //'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory'
        //'translator' => 'RtTranslation\Service\DatabaseTranslationService',
    ),
    'translator' => array(
        'locale' => 'en_US',
        'event_manager_enabled' => true,
        'remote_translation' => array(
            array(
                //'type' => 'dbTranslatorLoader',
                'type' => 'rt_translation_plugin_translator',
                'text_domain' => 'default'
            )
        )
    ),
    
    // Doctrine config
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
);

/*  
./official/vendor/doctrine/doctrine-module/bin/doctrine-module orm:convert-mapping --namespace="RtTranslation\\Entity\\" --force  --from-database annotation ./vendor/remithomas/rt-translation/RtTranslation/src
./official/vendor/doctrine/doctrine-module/bin/doctrine-module orm:generate-entities ./vendor/remithomas/rt-translation/RtTranslation/src/ --generate-annotations=true
 * 
 ./official/vendor/doctrine/doctrine-module/bin/doctrine-module orm:convert-mapping --namespace="RtTranslation\\Entity\\" --force  --from-database annotation ./module/RtTranslation/src
 ./official/vendor/doctrine/doctrine-module/bin/doctrine-module orm:generate-entities ./module/RtTranslation/src/ --generate-annotations=true 
   */