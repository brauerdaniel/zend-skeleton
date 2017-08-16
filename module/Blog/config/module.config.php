<?php

namespace Blog;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'blog' => [
                'type'      => Literal::class,
                'options'   => [
                    'route' => '/blog',
                    'defaults' => [
                        'controller'    => Controller\BlogController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'invokables' => [
            Controller\BlogController::class => Controller\BlogController::class,
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'blog' => __DIR__.'/../view',
        ],
    ],
];