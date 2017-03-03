<?php

Namespace Application\Service;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Application\Entity\PersonEntity;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\ArraySerializable as ArraySerializableHydrator;
use Zend\Db\RowGateway\RowGateway;

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
        $resultSet = $this->db->query('SELECT * FROM `personnel` WHERE `id` = ?', [$person->getId()]);
        $rowData = $resultSet->current()->getArrayCopy();
        $rowGateway = new RowGateway('id', 'personnel', $this->db);
        $rowGateway->populate($rowData, true);
        $rowGateway->firstname = $person->getFirstname();
        $rowGateway->lastname = $person->getLastname();
        $rowGateway->grade = $person->getGrade();
        $rowGateway->active = $person->getActive();
        $rowGateway->driver = $person->getDriver();
        $rowGateway->CIPA = $person->getCIPA();
        $rowGateway->CISDIS = $person->getCISDIS();
        $rowGateway->APR = $person->getAPR();
        $rowGateway->prepose = $person->getPrepose();
        $rowGateway->save();
    }
    
    public function delete(PersonEntity $person) {
        $resultSet = $this->db->query('SELECT * FROM `personnel` WHERE `id` = ?', [$person->getId()]);
        $rowData = $resultSet->current()->getArrayCopy();
        $rowGateway = new RowGateway('id', 'personnel', $this->db);
        $rowGateway->populate($rowData, true);
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
            return $resultSet->current();
        }    
        throw new Exception('the person id is not found in the database');
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
                $grades[] = $row['Name'];
            }
        }
        return $grades;
    }
}