<?php

namespace Application\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Application\Model\Perfil;

class PerfilTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        //$resultSet = $this->tableGateway->select(array('id' => 3));
        return $resultSet;
    }

    public function getPerfil($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array(
            'id' => $id
        ));
        $row = $rowset->current();
        if (!$row) {
            throw new Exception("Não existe linha no banco para este id $id");
        }
        return $row;
    }

    public function salvarPerfil(Perfil $perfil) {
        $data = array(
            'nome' => $perfil->nome,
        );

        $id = (int) $perfil->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getPerfil($id)) {
                $this->tableGateway->update($data, array(
                    'id' => $id
                ));
            } else {
                throw new Exception('Não existe Exception registro com esse ID' . $id);
            }
        }
    }

    public function deletarPerfil($id) {
        $this->tableGateway->delete(array(
            'id' => $id
        ));
    }

}
