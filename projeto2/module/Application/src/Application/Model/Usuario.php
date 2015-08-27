<?php

namespace Application\Model;

class Usuario {

    public $id;
    public $nome;
    public $email;
    public $senha;
    public $telefone;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nome = (isset($data['nome'])) ? $data['nome'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->senha = (isset($data['senha'])) ? $data['senha'] : null;
        $this->telefone = (isset($data['telefone'])) ? $data['telefone'] : null;
    }

    public function getInputFilter() {
        
    }

    public function getArrayCopy() {
        return array(
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha,
            'telefone' => $this->telefone,
        );
    }

}
