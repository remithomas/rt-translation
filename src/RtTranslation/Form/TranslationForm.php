<?php

namespace RtTranslation\Form;

use Zend\Form\Form;

class TranslationForm extends Form{
    
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        
        // id
        $this->add(array(
            'name' => 'id',
            'type'=>'Zend\Form\Element\Hidden',
            'attributes' => array(
                'required' => 'required',
            ),
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