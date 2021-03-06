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
namespace ApplicationTest\Controller;

use Application\Controller\PersonnelController;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class PersonnelControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        // The module configuration should still be applicable for tests.
        // You can override configuration here with test case specific values,
        // such as sample view templates, path stacks, module_listener_options,
        // etc.
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));

        parent::setUp();
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/personnel', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(PersonnelController::class);
        $this->assertControllerClass('PersonnelController');
        $this->assertMatchedRouteName('personnel');
    }
    
    public function testAddActionCanBeAccessed()
    {
        $this->dispatch('/personnel/add', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(PersonnelController::class);
        $this->assertControllerClass('PersonnelController');
        $this->assertMatchedRouteName('personnel');
        $this->assertActionName('add');
    }
    
    public function testEditActionCanBeAccessed()
    {
        $this->dispatch('/personnel/edit/1');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(PersonnelController::class);
        $this->assertControllerClass('PersonnelController');
        $this->assertActionName('edit');
    }
    
    public function testEditWithInvalidId()
    {
        $this->dispatch('/personnel/edit/-1');
        $this->assertRedirect();
        $this->assertModuleName('application');
        $this->assertControllerName(PersonnelController::class); // as specified in router's controller name alias
        $this->assertControllerClass('PersonnelController');
        $this->assertActionName('edit');
    }

}
