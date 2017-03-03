<?php

Namespace Application\Service;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Application\Entity\PersonEntity;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\ArraySerializable as ArraySerializableHydrator;
use Zend\Db\RowGateway\RowGateway;
use RuntimeException;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PersonnelManager{
    private $db;
    
    public function __construct(\Zend\Db\Adapter\Adapter $db) {
        $this->db = $db;     
    }
    
    public function addNew(PersonEntity $person) {
        $statement = $this->db->createStatement('INSERT INTO `personnel` 
            (`lastname`,`firstname`,`grade_id`,`active`,`driver`,`CIPA`,`CISDIS`,`APR`,`prepose`)
            VALUES (?,?,?,?,?,?,?,?,?);', 
            [
                $person->getLastname(),
                $person->getFirstname(),
                $person->getGrade(),
                $person->getActive(),
                $person->getDriver(),
                $person->getCIPA(),
                $person->getCISDIS(),
                $person->getAPR(),
                $person->getPrepose()
            ] );
        $statement->execute();
    }
    
    public function edit(PersonEntity $person) {
        $statement = $this->db->createStatement('SELECT * FROM `personnel` WHERE `id` = ?', [$person->getId()]);
        $resultSet = $statement->execute();
        $resultSet->buffer();
        $result = $resultSet->current();
        $rowGateway = new RowGateway('id', 'personnel', $this->db);
        $rowGateway->populate($result, true);
        $rowGateway->firstname = $person->getFirstname();
        $rowGateway->lastname = $person->getLastname();
        $rowGateway->grade_id = $person->getGrade_id();
        $rowGateway->active = $person->getActive();
        $rowGateway->driver = $person->getDriver();
        $rowGateway->CIPA = $person->getCIPA();
        $rowGateway->CISDIS = $person->getCISDIS();
        $rowGateway->APR = $person->getAPR();
        $rowGateway->prepose = $person->getPrepose();
        $rowGateway->save();
    }
    
    public function delete(PersonEntity $person) {
        $rowGateway = new RowGateway('id', 'personnel', $this->db);
        $rowGateway->populate($person->getArrayCopy(), true);
        $rowGateway->delete();
    }
    
    public function getAll() {
        $personnels = [];
        $statement = $this->db->createStatement('SELECT * FROM `personnel` ORDER BY `lastname`');
        $statement->prepare();
        $result = $statement->execute(NULL);
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new HydratingResultSet(new ArraySerializableHydrator, new PersonEntity);
            $resultSet->initialize($result);
            foreach ($resultSet as $person) {
                $personnels[] = $person;
            }
        }
        return $personnels;
    }

    public function getPerson($id) {
        $statement = $this->db->createStatement('SELECT * FROM `personnel` WHERE `id` = ?', [$id]);
        $statement->prepare();
        $result = $statement->execute(NULL);
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new HydratingResultSet(new ArraySerializableHydrator, new PersonEntity);
            $resultSet->initialize($result);
            if ($resultSet->valid()) {
                return $resultSet->current();
            }
        }    
        throw new RuntimeException('the person id is not found in the database');
    }

    public function getGrades() {
        $grades = [];
        $statement = $this->db->createStatement('SELECT * FROM grades');
        $statement->prepare();
        $result = $statement->execute(NULL);
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);
            foreach ($resultSet as $row) {
                $grades[] = $row['name'];
            }
        }
        return $grades;
    }
}