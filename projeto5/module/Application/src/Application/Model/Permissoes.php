<?php

namespace Application\Model;
use Application\Model\Perfil;
class Permissoes {

    public $id;
    public $resources;
    public $role;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->resources = (isset($data['resources'])) ? $data['resources'] : null;
    
        $this->role   = new Perfil();
        
        $this->role->id = (isset($data['id_perfil'])) ? $data['id_perfil'] : null;
        $this->role->nome = (isset($data['nome'])) ? $data['nome'] : null;
        
    }

    public function getArrayCopy() {
        return array(
            'id' => $this->id,
            'resources' => $this->resources,
            'role' => $this->role->id,
        );
    }

}
