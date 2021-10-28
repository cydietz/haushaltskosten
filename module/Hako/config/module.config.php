<?php

namespace Hako;

use Laminas\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'hako' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/hako[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\HakoController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'hako' => __DIR__ . '/../view',
        ],
    ],
];