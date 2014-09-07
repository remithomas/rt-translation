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
        
        // locale
        $this->add(array(
            'name' => 'locale',
            'type'=>'Zend\Form\Element\Select',
            'attributes' => array(
                'required' => 'required',
            ),
            'options'=>array(
                'label'=>"Your locale",
                'value_options' => array()
            )
        ));
        
        // key
        $this->add(array(
            'name' => 'key',
            'type'=>'Zend\Form\Element\Select',
            'attributes' => array(
                'required' => 'required',
            ),
            'options'=>array(
                'label'=>"Your key",
                'value_options' => array()
            )
        ));
        
        // 
        $this->add(array(
            'name' => 'translation',
            'type'=>'Zend\Form\Element\Text',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => "Translation"
            ),
            'options'=>array(
                'label'=>"Your translation",
            )
        ));
        
        $this->add(array(
            'name' => 'plural',
            'type'=>'Zend\Form\Element\Text',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => "Translation"
            ),
            'options'=>array(
                'label'=>"Your translation",
                'value_options' => array(
                    0 => '0',
                    1 => '1',
                    2 => ""
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