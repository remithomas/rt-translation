<?php

namespace RtTranslation\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

use RtTranslation\Entity\Key as RtKey;
use RtTranslation\Form\KeyFilter;

class KeyForm extends Form{
    
    /**
     * 
     * @param string $name
     * @param array $options
     */
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        $this   ->setName('KeyForm')
                ->setAttribute('method', 'post')
                ->setAttribute("accept-charset", "UTF-8")
                ->setHydrator(new ClassMethodsHydrator(false))
                ->setInputFilter(new KeyFilter())
                ->setObject(new RtKey());
        
        $this->add(array(
            'name' => 'id',
            'type'=>'Zend\Form\Element\Hidden',
        ));
        
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