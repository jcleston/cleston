<?php

namespace Aluno\Form;

use Zend\Form\Form;

class AlunoForm extends Form {
    
    //materia
    protected $materiaTable;

    public function __construct($name = null) {
        parent::__construct('aluno');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('role', 'form');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden'
        ));
        $this->add(array(
            'name' => 'nome',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Nome'
            )
        ));
        $this->add(array(
            'name' => 'idade',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Idade'
            )
        ));
        //materia
        $this->add(array(
            'name' => 'id_materia',
            'type' => 'Select',
            'options' => array(
                'value_options' => $this->getValues()
            )
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'id' => 'submitbutton',
                'class' => 'btn btn-default'
            )
        ));
    }
    
    //materia
    public function getMateriaTable() {
        if (!$this->materiaTable) {
            $sm = $GLOBALS['sm'];
            $this->materiaTable = $sm->get("Materia/Model/MateriaTable");
        }
        return $this->materiaTable;
    }

    //materia
    public function getValues() {
        $valuesArray = array("" => "Selecione");
        $materias = $this->getMateriaTable()->fetchAll();

        foreach ($materias as $materia) {
            $valuesArray[$materia->id] = $materia->nome;
        }
        return $valuesArray;
    }

}
