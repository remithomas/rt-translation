<?php

namespace RtTranslation\Form;

use Zend\Form\Form;

class LocaleForm extends Form{
    
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        
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
        
    }
}