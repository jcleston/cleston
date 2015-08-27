<?php

namespace Application\Model;

use Application\Model\Usuario;
use Exception;
use Zend\Db\TableGateway\TableGateway;

class UsuarioTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    //Consultar todas as linhas do banco
    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getUsuario($id) {
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

    public function salvarUsuario(Usuario $usuario) {
        $data = array(
            'nome' => $usuario->nome,
            'email' => $usuario->email,
            'senha' => $usuario->senha,
            'telefone' => $usuario->telefone,
        );

        $id = (int) $usuario->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getUsuario($id)) {
                $this->tableGateway->update($data, array(
                    'id' => $id
                ));
            } else {
                throw new Exception('Não existe registro com esse ID' . $id);
            }
        }
    }

    public function deletarUsuario($id) {
        $this->tableGateway->delete(array(
            'id' => $id
        ));
    }

}
