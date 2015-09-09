<?php

namespace Materia\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Materia\Model\Materia;

class MateriaTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        //$resultSet = $this->tableGateway->select();
        //return $resultSet;
        
        //curso
        $select = new Select();
        $select->from('materia')
                ->columns(array('*'))
                ->join("curso", "materia.id_curso = curso.id", array("nome_curso" => "nome"), Select::JOIN_LEFT);
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }

    public function getMateria($id) {
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

    public function salvarMateria(Materia $materia) {
        $data = array(
            'nome' => $materia->nome,
            //curso
            'id_curso' => $materia->curso->id,
        );

        $id = (int) $materia->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getMateria($id)) {
                $this->tableGateway->update($data, array(
                    'id' => $id
                ));
            } else {
                throw new \Exception('Não exisExceptionte registro com esse ID' . $id);
            }
        }
    }

    public function deletarMateria($id) {
        $this->tableGateway->delete(array(
            'id' => $id
        ));
    }

}
