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
        
    }
}