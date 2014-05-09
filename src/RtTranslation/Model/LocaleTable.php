<?php

namespace RtTranslation\Model;
 
use Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Adapter\Adapter;
 
class LocaleTable extends AbstractTableGateway
{
    
    protected $table = 'translation_locale';
 
    /**
     * Constructor
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }
}
