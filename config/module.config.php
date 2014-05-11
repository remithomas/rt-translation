<?php
namespace RtTranslation;

return array(
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
                        //'locale' => '[a-zA-Z]*',
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
                                            'route'    => '/edit/:locale',
                                            'defaults' => array(
                                                'controller' => 'RtTranslation\Controller\Translation',
                                                'action'     => 'editlocale',
                                            ),
                                            'constraints' => array(
                                                'locale' => '[a-zA-Z][a-zA-Z0-9_-]+',
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
                                            'route'    => '/edit/:key',
                                            'defaults' => array(
                                                'controller' => 'RtTranslation\Controller\Translation',
                                                'action'     => 'editkey',
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
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'service_manager' => array(
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
        'remote_translation' => array(
            array(
                //'type' => 'dbTranslatorLoader',
                'type' => 'rt_translation_plugin_translator',
                'text_domain' => 'default'
            )
        )
    ),
    
);
