<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
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
            ],
        ];
    }
    
    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\PersonnelController::class => function($container) {
                    $PersonnelManager = $container->get(Service\PersonnelManager::class);
                    return new Controller\PersonnelController($PersonnelManager);   
                },
            ],
        ];
    }
}
