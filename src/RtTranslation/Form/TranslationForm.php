<?php

namespace RtTranslation\Form;

use Zend\Form\Form;

use Doctrine\ORM\EntityManager;

class TranslationForm extends Form{
    
    /**
     * @var EntityManager
     */
    protected $em;
    
    public function __construct(EntityManager $em, $name = null, $options = array()) {
        $this->em = $em;
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
            'type'=>'DoctrineModule\Form\Element\ObjectSelect',
            'attributes' => array(
                'required' => 'required',
            ),
            'options'=>array(
                'label'=>"Your locale",
                'object_manager' => $this->em,
                'target_class' => 'RtTranslation\Entity\Locale',
                'property' => 'name',                   
            )
        ));
        
        // key
        $this->add(array(
            'name' => 'key',
            'type'=>'DoctrineModule\Form\Element\ObjectSelect',
            'attributes' => array(
                'required' => 'required',
            ),
            'options'=>array(
                'label'=>"Your key",
                'object_manager' => $this->em,
                'target_class' => 'RtTranslation\Entity\Key',
                'property' => 'message',                   
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
            'type'=>'Zend\Form\Element\Select',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => "Translation"
            ),
            'options'=>array(
                'label'=>"Your plural index",
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