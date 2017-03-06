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

use Iterator;
use Zend\Db\Adapter;
use Application\Service\PersonnelManager;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Prophecy\Argument;

class PersonnelManagerTest extends AbstractHttpControllerTestCase
{
    
    protected $dbAdapter;
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
    
    protected function mockDbAdapter() {
        $this->dbAdapter = $this->prophesize(Adapter\Adapter::class);
        return $this->dbAdapter;
    }
    
    public function testGetGradeReturnsList() {
        $mockedDb = $this->mockDbAdapter();
        $mockedStatement = $this->prophesize(Adapter\Driver\Mysqli\Statement::class);
        $mockedStatement->prepare()->shouldBeCalled();
        
        $gradeList = [ ['name' => 'first'], ['name' => 'Second' ] ];

        $mockedResult = new MockedDbResult($gradeList);
        
        $mockedStatement->prepare()->shouldBeCalled();
        $mockedStatement->execute(NULL)->willReturn($mockedResult);
        $mockedDb->createStatement("SELECT * FROM grades")->willReturn($mockedStatement);
        
        $dutPersonnelManager = new PersonnelManager($mockedDb->reveal());
        $this->assertInstanceOf(PersonnelManager::class, $dutPersonnelManager);
        $dutGrades = $dutPersonnelManager->getGrades();
        $this->assertCount(count($gradeList), $dutGrades);
        for ($i = 0; $i<count($gradeList);$i++) {
            $gradeIn = $gradeList[$i];
            $this->assertEquals($dutGrades[$i], $gradeIn['name']);
        }
    }

}

class MockedDbResult implements \Zend\Db\Adapter\Driver\ResultInterface {
    private $mockedResult;
    private $index;
    public function __construct($dataIn) {
        $this->mockedResult = $dataIn;
        $this->index = 0;
    }

    public function count(): int {
        return count($this->mockedResult);
    }

    public function current() {
        return $this->mockedResult[$this->index];
    }

    public function key(): \scalar {
        
    }

    public function next() {
        $this->index++;
    }

    public function rewind() {
        $this->index = 0;
    }

    public function valid(): bool {
        if ($this->index < count($this->mockedResult) ) {
            return true;
        }  
        else {
            return false;
        }
    }

    public function buffer(): void {
        
    }

    public function getAffectedRows(): int {
        
    }

    public function getFieldCount(): int {
        return 1;
    }

    public function getGeneratedValue() {
        
    }

    public function getResource() {
        
    }

    public function isBuffered() {
        return false;
    }

    public function isQueryResult(): bool {
        return true;
    }

}