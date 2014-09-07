<?php

namespace RtTranslation\Model;
 
use Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet;

use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

use RtTranslation\Entity\Translation;

class TranslationTable extends AbstractTableGateway
{
    
    protected $table = 'translation_translation';
 
    /**
     * Constructor
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(new Translation);
        $this->initialize();
    }
    
    /**
     * 
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll($paginated = false){
        if($paginated) {
            $select = new Select($this->table);
            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Translation());
            $paginatorAdapter = new DbSelect(
                    // our configured select object
                    $select,
                    // the adapter to run it against
                    $this->adapter,
                    // the result set to hydrate
                    $resultSetPrototype
            );
            $paginator = new Paginator($paginatorAdapter);
            return $paginator;
        }
        $resultSet = $this->select();
        return $resultSet;
    }
}
