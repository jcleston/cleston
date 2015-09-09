<?php

namespace Application\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class PrivilegiosTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
}
