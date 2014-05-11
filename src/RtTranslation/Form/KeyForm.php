<?php

namespace RtTranslation\Form;

use Zend\Form\Form;

class KeyForm extends Form{
    
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        
        $this->add(array(
            'name' => 'key',
            'type'=>'Zend\Form\Element\Text',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => "Key"
            ),
            'options'=>array(
                'label'=>"Key",
            )
        ));
        
    }
}