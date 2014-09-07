<?php

namespace RtTranslation\Form;

use Zend\Form\Form;

class KeyForm extends Form{
    
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        
        $this->add(array(
            'name' => 'message',
            'type'=>'Zend\Form\Element\Text',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => "Message key"
            ),
            'options'=>array(
                'label'=>"Message key",
            )
        ));
        
        $this->add(array(
            'name' => 'textDomain',
            'type'=>'Zend\Form\Element\Text',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => "Text domain"
            ),
            'options'=>array(
                'label'=>"Text domain",
            )
        ));
        
    }
}