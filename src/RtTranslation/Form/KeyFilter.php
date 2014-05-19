<?php

namespace RtTranslation\Form;

use Zend\InputFilter\InputFilter;

class KeyFilter extends InputFilter{
    
    public function __construct(){
        
        $this->add(array(
            'name'       => 'message',
            'required'   => true,
            'filters'    => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'min' => 2,
                        'max' => 6,
                    ),
                ),
            ),
        ));
        
        $this->add(array(
            'name'       => 'textDomain',
            'required'   => true,
            'filters'    => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'min' => 3,
                        'max' => 255,
                        'encoding' => 'UTF-8',
                    ),
                ),
            ),
        ));
    }
    
    
}
