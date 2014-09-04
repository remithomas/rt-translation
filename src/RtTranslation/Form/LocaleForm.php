<?php

namespace RtTranslation\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

use RtTranslation\Entity\Locale as RtLocale;
use RtTranslation\Form\LocaleFilter;

class LocaleForm extends Form{
    
    /**
     * Constructor
     * @param string $name
     * @param array $options
     */
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        $this   ->setName('LocaleForm')
                ->setAttribute('method', 'post')
                ->setAttribute("accept-charset", "UTF-8")
                ->setHydrator(new ClassMethodsHydrator(false))
                ->setInputFilter(new LocaleFilter())
                ->setObject(new RtLocale());
        
        $this->add(array(
            'name' => 'locale',
            'type'=>'Zend\Form\Element\Text',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => "Locale"
            ),
            'options'=>array(
                'label'=>"Locale",
            )
        ));
        
        $this->add(array(
            'name' => 'name',
            'type'=>'Zend\Form\Element\Text',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => "Name"
            ),
            'options'=>array(
                'label'=>"Name of the locale",
            )
        ));
        
        $this->add(array(
            'name' => 'default',
            'type'=>'Zend\Form\Element\Select',
            'attributes' => array(
                'required' => 'required',
            ),
            'options'=>array(
                'label'=>"Locale is default",
                'value_options' => array(
                    '0' => 'Not default',
                    '1' => 'Default'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'published',
            'type'=>'Zend\Form\Element\Select',
            'attributes' => array(
                'required' => 'required',
            ),
            'options'=>array(
                'label'=>"Publication of the locale",
                'value_options' => array(
                    '0' => 'Not published',
                    '1' => 'Published'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'pluralForms',
            'type'=>'Zend\Form\Element\Select',
            'attributes' => array(
                'required' => 'required',
            ),
            'options'=>array(
                'label'=>"Plural forms",
                'value_options' => array(
                    'nplurals=2; plural=(n==1 ? 0 : 1)' => 'nplurals=2; plural=(n==1 ? 0 : 1) as ENGLISH',
                    'nplurals=2; plural=(n==0 || n==1 ? 0 : 1)' => 'nplurals=2; plural=(n==0 || n==1 ? 0 : 1) as FRENCH',
                )
            )
        ));
        
    }
}