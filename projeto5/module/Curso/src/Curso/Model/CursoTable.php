<?php

namespace Curso\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Curso\Model\Curso;

class CursoTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getCurso($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array(
            'id' => $id
        ));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não existe linha no banco para este id $id");
        }
        return $row;
    }

    public function salvarCurso(Curso $curso) {
        $data = array(
            'nome' => $curso->nome,
        );

        $id = (int) $curso->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getCurso($id)) {
                $this->tableGateway->update($data, array(
                    'id' => $id
                ));
            } else {
                throw new \Exception('Não exisExceptionte registro com esse ID' . $id);
            }
        }
    }

    public function deletarCurso($id) {
        $this->tableGateway->delete(array(
            'id' => $id
        ));
    }

}
