<?php

namespace Aluno\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Aluno\Model\Aluno;
use Aluno\Model\AlunoTable;

class Aluno {

    public $id;
    public $nome;
    public $idade;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nome = (isset($data['nome'])) ? $data['nome'] : null;
        $this->idade = (isset($data['idade'])) ? $data['idade'] : null;
    }

    public function getInputFilter() {
        
    }

    public function getArrayCopy() {
        return array(
            'id' => $this->id,
            'nome' => $this->nome,
            'idade' => $this->idade,
        );
    }

}
