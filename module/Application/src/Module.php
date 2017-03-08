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

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    const VERSION = '3.0.2dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    // Add this method:
    public function getServiceConfig()
    {
        return [
            'factories' => [
                Service\PersonnelManager::class => function($container) {
                    $db = $container->get('db');
                    return new Service\PersonnelManager($db);
                },
                Service\MaterialManager::class => function($container) {
                    $db = $container->get('db');
                    return new Service\MaterialManager($db);
                }
            ],
        ];
    }
    
    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\PersonnelController::class => function($container) {
                    $personnelManager = $container->get(Service\PersonnelManager::class);
                    return new Controller\PersonnelController($personnelManager);   
                },
                        
                Controller\MaterialForGradeController::class => function($container) {
                    $materialManager = $container->get(Service\MaterialManager::class);
                    $personnelManager = $container->get(Service\PersonnelManager::class); 
                    return new Controller\MaterialForGradeController($materialManager,$personnelManager);
                }
            ],
        ];
    }
}
