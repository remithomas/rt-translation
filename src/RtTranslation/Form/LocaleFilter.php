<?php

namespace RtTranslation\Form;

use Zend\InputFilter\InputFilter;

class LocaleFilter extends InputFilter{
    
    public function __construct(){
        
        $this->add(array(
            'name'       => 'locale',
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
            'name'       => 'name',
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
