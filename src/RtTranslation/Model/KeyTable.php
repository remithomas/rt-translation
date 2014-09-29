<?php

namespace RtTranslation\Model;
 
use Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet;

use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

use RtTranslation\Entity\Key;
 
class KeyTable extends AbstractTableGateway
{
    
    protected $table = 'translation_key';
 
    /**
     * Constructor
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(new Key);
        $this->initialize();
    }
    
    /**
     * 
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll($paginated = false){
        if($paginated) {
            // create a new Select object for the table album
            $select = new Select($this->table);
            // create a new result set based on the Album entity
            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Key());
            // create a new pagination adapter object
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
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
    public function fetchTextDomains(){
        
        $textDomains = array();
        $resultSet = $this->select(function (Select $select)
        {
            $select->columns(array('text_domain'));
            $select->group('text_domain');
        });
        foreach ($resultSet->toArray() as $textDomain){
            $textDomains[] = $textDomain['text_domain'];
        }
        return $textDomains;
    }
}
