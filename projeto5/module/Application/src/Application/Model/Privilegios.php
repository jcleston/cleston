<?php

namespace Application\Model;
use Application\Model\Permissoes;

class  Privilegios{

    public $id;
    public $nome;
    
    public $permissoes;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nome = (isset($data['nome'])) ? $data['nome'] : null;
    
        $this->permissoes = new Permissoes();
        
        $this->permissoes->resources = (isset($data['resources'])) ? $data['resources'] : null;
        $this->permissoes->role = (isset($data['role'])) ? $data['role'] : null;
        $this->permissoes->id = (isset($data['id'])) ? $data['id'] : null;
        
    }

    public function getArrayCopy() {
        return array(
            'id' => $this->id,
            'nome' => $this->nome,
        );
    }

}
