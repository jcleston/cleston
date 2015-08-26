<?php
namespace Aluno\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Aluno\Model\AlunoTable;
use Aluno\Model\Aluno;
class AlunoTable
{

    protected $tableGateway;
   
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    //Consultar todas as linhas do banco
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getAluno($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array(
            'id' => $id
        ));
        $row = $rowset->current();
        if (! $row) {
            throw new \Exception("Não existe linha no banco para este id $id");
        }
        return $row;
    }

    public function salvarAluno(Aluno $aluno)
    {
        $data = array(
            'nome' => $aluno->nome,
            'idade' => $aluno->idade,
        );
        
        $id = (int) $aluno->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getCelular($id)) {
                $this->tableGateway->update($data, array(
                    'id' => $id
                ));
            } else {
                throw new \Exception('Não existe registro com esse ID' . $id);
            }
        }
    }

    public function deletarAluno($id)
    {
        $this->tableGateway->delete(array(
            'id' => $id
        ));
    }
}