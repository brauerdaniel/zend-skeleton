<?php

namespace Blog;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'blog' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/blog',
                    'defaults' => [
                        'controller' => Controller\BlogController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'controller' => Controller\BlogController::class,
                                'action' => 'add'
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/artikel/:id/delete',
                            'defaults' => [
                                'controller' => Controller\BlogController::class,
                                'action' => 'delete'
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ],
                        ],
                    ],
                    'show' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/artikel/:id/show',
                            'defaults' => [
                                'controller' => Controller\BlogController::class,
                                'action' => 'show'
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/artikel/:id/edit',
                            'defaults' => [
                                'controller' => Controller\BlogController::class,
                                'action' => 'edit'
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ],
                        ],
                    ],
                    'aktivieren' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/artikel/:id/aktivieren',
                            'defaults' => [
                                'controller' => Controller\BlogController::class,
                                'action' => 'aktivieren'
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ],
                        ],
                    ],
                    'deaktivieren' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/artikel/:id/deaktivieren',
                            'defaults' => [
                                'controller' => Controller\BlogController::class,
                                'action' => 'deaktivieren'
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\BlogController::class => Controller\BlogControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Service\BlogService::class => Service\BlogServiceFactory::class,
        ],
    ],
    'form_elements' => [
        'factories' => [
            Form\ArtikelForm::class => Form\ArtikelFormFactory::class,
        ]
    ],

    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'blog' => __DIR__ . '/../view',
        ],
    ],
];