<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ApplicationTest\Entity;

use Application\Entity\PersonEntity;
use Zend\Stdlib\ArrayUtils;
use PHPUnit\Framework\TestCase;

class PersonEntityTest extends TestCase
{
    public function setUp(){
        parent::setUp();
    }
    
    public function testPersonEntityCanBeCreated() {
        $person = new PersonEntity();
        $this->assertInstanceOf(\Application\Entity\PersonEntity::class, $person);
    }
    
    public function testArrayInjection() {
        $person = new PersonEntity();
        $testData = [
            'id' => 1234,
            'firstname' => 'firstnameStr',
            'lastname' => 'lastnameStr',
            'grade_id' => 666,
            'active' => 1,
            'driver' => 1,
            'CIPA' => 1,
            'CISDIS' => 0,
            'APR' => 0,
            'prepose' => 0
        ];
        
        $person->exchangeArray($testData);
           
        $this->assertEquals($testData['id'], $person->getId());
        $this->assertEquals($testData['firstname'], $person->getFirstname());
        $this->assertEquals($testData['lastname'], $person->getLastname());
        $this->assertEquals($testData['grade_id'], $person->getGrade_id());
        $this->assertEquals($testData['active'], $person->getActive());
        $this->assertEquals($testData['driver'], $person->getDriver());
        $this->assertEquals($testData['CIPA'], $person->getCIPA());
        $this->assertEquals($testData['CISDIS'], $person->getCISDIS());
        $this->assertEquals($testData['APR'], $person->getAPR());
        $this->assertEquals($testData['prepose'], $person->getPrepose());
    }
    
    public function testGetSetID(){
        $person = new PersonEntity();
        $testData = 314;
        $person->setId($testData);
        $this->assertEquals($testData, $person->getId());
    }
    
    public function testGetSetFirstname(){
        $person = new PersonEntity();
        $testData = 'firstnameStr';
        $person->setFirstName($testData);
        $this->assertEquals($testData, $person->getFirstname());
    }
    
    public function testGetSetLastname(){
        $person = new PersonEntity();
        $testData = 'lastnameStr';
        $person->setLastname($testData);
        $this->assertEquals($testData, $person->getLastname());
    }
    
    public function testGetSetGrade_id(){
        $person = new PersonEntity();
        $testData = 666;
        $person->setGrade_id($testData);
        $this->assertEquals($testData, $person->getGrade_id());
    }
    
    public function testGetSetActive(){
        $person = new PersonEntity();
        $testData = 1;
        $person->setActive($testData);
        $this->assertEquals($testData, $person->getActive());
    }
    
    public function testGetSetDriver(){
        $person = new PersonEntity();
        $testData = 1;
        $person->setDriver($testData);
        $this->assertEquals($testData, $person->getDriver());
    }
    
    public function testGetSetCIPA(){
        $person = new PersonEntity();
        $testData = 1;
        $person->setCIPA($testData);
        $this->assertEquals($testData, $person->getCIPA());
    }
    
    public function testGetSetCISDIS(){
        $person = new PersonEntity();
        $testData = 1;
        $person->setCISDIS($testData);
        $this->assertEquals($testData, $person->getCISDIS());
    }
    
    public function testGetSetAPR(){
        $person = new PersonEntity();
        $testData = 1;
        $person->setAPR($testData);
        $this->assertEquals($testData, $person->getAPR());
    }
    
    public function testGetSetPrepose(){
        $person = new PersonEntity();
        $testData = 1;
        $person->setPrepose($testData);
        $this->assertEquals($testData, $person->getPrepose());
    }
}
