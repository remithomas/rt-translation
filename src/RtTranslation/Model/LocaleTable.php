<?php

namespace RtTranslation\Model;
 
use Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet;

use RtTranslation\Entity\Locale as RtLocale;

class LocaleTable extends AbstractTableGateway
{
    
    protected $table = 'translation_locale';
 
    /**
     * Constructor
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter){
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(new RtLocale);
        $this->initialize();
    }
    
    /**
     * 
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll(){
        $resultSet = $this->select();
        return $resultSet;
    }
}
