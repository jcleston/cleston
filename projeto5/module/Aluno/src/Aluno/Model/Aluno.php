<?php

namespace Aluno\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

use Materia\Model\Materia;

class Aluno implements InputFilterAwareInterface {

    public $id;
    public $nome;
    public $idade;
    //materia
    public $materia;
    protected $inputFilter;

    public function exchangeArray($data) {
//        $this->id = (isset($data['id'])) ? $data['id'] : null;
//        $this->nome = (isset($data['nome'])) ? $data['nome'] : null;
//        $this->idade = (isset($data['idade'])) ? $data['idade'] : null;
        
        //materia
        $this->materia = new Materia();
        $this->materia->id = (isset($data['id_materia'])) ? $data['id_materia'] : null;
        $this->materia->nome = (isset($data['nome_materia'])) ? $data['nome_materia'] : null;
        
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nome = (isset($data['nome'])) ? $data['nome'] : null;
        $this->idade = (isset($data['idade'])) ? $data['idade'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Não validado");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $inputFilter->add(array(
                'name' => 'id',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'nome',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'idade',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

    public function getArrayCopy() {
        return array(
            'id' => $this->id,
            'nome' => $this->nome,
            'idade' => $this->idade,
            //curso
            'id_materia' => $this->materia->id
        );
    }

}
