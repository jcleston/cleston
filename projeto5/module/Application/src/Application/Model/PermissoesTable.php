<?php

namespace Application\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class PermissoesTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {

        $select = new Select();
        $select->from('permissoes')
                ->columns(array('resources', 'role'))
                ->join("privilegios", "permissoes.id = privilegios.id_permissoes", array("nome"), Select::JOIN_LEFT);
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }
}
