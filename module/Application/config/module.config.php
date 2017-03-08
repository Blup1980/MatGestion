<?php
/**
 *  MatGestion
 *  Copyright (C) 2017 Blup1980
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.

 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Db\Adapter\AdapterAbstractServiceFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'personnel' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/personnel[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\PersonnelController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'materialForGrade' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/materialforgrade[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\MaterialForGradeController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            ],
        ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'                 => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index'       => __DIR__ . '/../view/application/index/index.phtml',
            'application/personnel/index'   => __DIR__ . '/../view/application/personnel/index.phtml',
            'error/404'                     => __DIR__ . '/../view/error/404.phtml',
            'error/index'                   => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'db' => \Zend\Db\Adapter\Adapter::class,
        ],
        'factories' => [
            \Zend\Db\Adapter\Adapter::class => AdapterAbstractServiceFactory::class,
            ],
    ],
];
