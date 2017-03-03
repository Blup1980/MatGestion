<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
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
        
        $gradeList = [ ['Name' => 'first'], ['Name' => 'Second' ] ];

        $mockedResult = new MockedDbResult($gradeList);
        
        $mockedStatement->prepare()->shouldBeCalled();
        $mockedStatement->execute(NULL)->willReturn($mockedResult);
        $mockedDb->createStatement("SELECT * FROM grades")->willReturn($mockedStatement);
        
        $dutPersonnelManager = new PersonnelManager($mockedDb->reveal());
        $this->assertInstanceOf(PersonnelManager::class, $dutPersonnelManager);
        $dutGrades = $dutPersonnelManager->getGrades();
        $this->assertCount(count($gradeList), $dutGrades);
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
        if ($this->index < count($this->mockedResult) - 1) {
            $this->index++;
        }
    }

    public function rewind() {
        $this->index = 0;
    }

    public function valid(): bool {
        if ($this->index < count($this->mockedResult) - 1) {
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