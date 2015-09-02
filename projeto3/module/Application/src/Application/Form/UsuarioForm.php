<?php

namespace Application\Form;

use Zend\Form\Form;

class UsuarioForm extends Form {

    public function __construct($name = null) {
        parent::__construct('usuario');
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
            'name' => 'email',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Email'
            )
        ));
        
        $this->add(array(
            'name' => 'senha',
            'type' => 'password',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Senha'
            )
        ));
        
        $this->add(array(
            'name' => 'telefone',
            'type' => 'text',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Telefone'
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

}
