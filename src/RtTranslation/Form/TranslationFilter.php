<?php

namespace RtTranslation\Form;

use Zend\InputFilter\InputFilter;

class TranslationFilter extends InputFilter{
    
    public function __construct(){
        $this->add(array(
            'name'       => 'translation',
            'required'   => true,
            'filters'    => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'min' => 1,
                        'max' => 512,
                        'encoding' => 'UTF-8',
                    ),
                ),
            ),
        ));
    }
    
    
}
