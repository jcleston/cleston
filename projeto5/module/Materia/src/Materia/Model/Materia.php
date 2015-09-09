<?php

namespace Materia\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

use Curso\Model\Curso;

class Materia implements InputFilterAwareInterface {

    public $id;
    public $nome;
    //curso
    public $curso;
    protected $inputFilter;

    public function exchangeArray($data) {
        //$this->id = (isset($data['id'])) ? $data['id'] : null;
        //$this->nome = (isset($data['nome'])) ? $data['nome'] : null;
        
        //curso
        //new Curso(); 
        //$this->curso = (isset($data['curso'])) ? $data['curso'] : null;
        $this->curso = new Curso();
        $this->curso->id = (isset($data['id_curso'])) ? $data['id_curso'] : null;
        $this->curso->nome = (isset($data['nome_curso'])) ? $data['nome_curso'] : null;
        
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nome = (isset($data['nome'])) ? $data['nome'] : null;
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
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

    public function getArrayCopy() {
        return array(
            'id' => $this->id,
            'nome' => $this->nome,
            //curso
            'id_curso' => $this->curso->id
        );
    }

}
