<?php

return array(
    'router' => array(
        'routes' => array(
            'aluno' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/aluno',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Aluno\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]][/:id]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Aluno\Controller\Index' => 'Aluno\Controller\IndexController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Aluno' => __DIR__ . '/../view',
        ),
    ),
);
