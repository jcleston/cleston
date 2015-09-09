<?php

namespace Aluno\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Aluno\Model\Aluno;

class AlunoTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        //$resultSet = $this->tableGateway->select();
        //return $resultSet;
        
        //materia
        $select = new Select();
        $select->from('aluno')
                ->columns(array('*'))
                ->join("materia", "aluno.id_materia = materia.id", array("nome_materia" => "nome"), Select::JOIN_LEFT);
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }

    public function getAluno($id) {
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

    public function salvarAluno(Aluno $aluno) {
        $data = array(
            'nome' => $aluno->nome,
            'idade' => $aluno->idade,
            //materia
            'id_materia' => $aluno->materia->id,
        );

        $id = (int) $aluno->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getAluno($id)) {
                $this->tableGateway->update($data, array(
                    'id' => $id
                ));
            } else {
                throw new \Exception('Não exisExceptionte registro com esse ID' . $id);
            }
        }
    }

    public function deletarAluno($id) {
        $this->tableGateway->delete(array(
            'id' => $id
        ));
    }

}
