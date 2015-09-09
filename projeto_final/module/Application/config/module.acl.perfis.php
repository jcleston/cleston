<?php

return array(
    // Perfil de Master
    array(
        'role' => 1,
        'resource' => 'home',
        'privileges' => array()
    ),
    array(
        'role' => 1,
        'resource' => 'autenticar',
        'privileges' => array()
    ),
    array(
        'role' => 1,
        'resource' => 'application',
        'privileges' => array(
            'index',
            'add',
            'edit'
        )
    ),
    array(
        'role' => 1,
        'resource' => 'curso',
        'privileges' => array(
            'index',
            'add',
            'edit',
            'delete'
        )
    ),
    array(
        'role' => 1,
        'resource' => 'materia',
        'privileges' => array(
            'index',
            'add',
            'edit',
            'delete'
        )
    ),
     array(
        'role' => 1,
        'resource' => 'aluno',
        'privileges' => array(
            'index',
            'add',
            'edit',
            'delete'
        )
    ),
    array(
        'role' => 1,
        'resource' => 'sair',
        'privileges' => array()
    ),
    // Perfil de oreia
    array(
        'role' => 2,
        'resource' => 'home',
        'privileges' => array()
    ),
    array(
        'role' => 2,
        'resource' => 'autenticar',
        'privileges' => array()
    ),
    array(
        'role' => 2,
        'resource' => 'sair',
        'privileges' => array()
    ),
    array(
        'role' => 2,
        'resource' => 'aluno',
        'privileges' => array(
            'index'
        )
    ),
);
