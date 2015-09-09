<?php

return array(
    'router' => array(
        'routes' => array(
            'materia' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/materia',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Materia\Controller',
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
            'Materia\Controller\Index' => 'Materia\Controller\IndexController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Materia' => __DIR__ . '/../view',
        ),
    ),
);
