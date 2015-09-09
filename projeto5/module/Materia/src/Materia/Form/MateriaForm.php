<?php

namespace Materia\Form;

use Zend\Form\Form;

class MateriaForm extends Form {

    //curso
    protected $cursoTable;

    public function __construct($name = null) {
        parent::__construct('materia');
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

        //curso
        $this->add(array(
            'name' => 'id_curso',
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

    //curso
    public function getCursoTable() {
        if (!$this->cursoTable) {
            $sm = $GLOBALS['sm'];
            $this->cursoTable = $sm->get("Curso/Model/CursoTable");
        }
        return $this->cursoTable;
    }

    //curso
    public function getValues() {
        $valuesArray = array("" => "Selecione");
        $cursos = $this->getCursoTable()->fetchAll();

        foreach ($cursos as $curso) {
            $valuesArray[$curso->id] = $curso->nome;
        }
        return $valuesArray;
    }

}
