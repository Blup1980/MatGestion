<?php

Namespace Application\Service;

use Application\Repository;
use Zend\ServiceManager\ServiceManager;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;

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
    
    public function addNew(\Application\Entity\Person $person) {
        $statement = $this->db->createStatement('INSERT INTO `personnel` (`lastname`,`firstname`,`grade_id`)
        VALUES ( ? , ? , ? );', 
                [
                    $person->getLastname(),
                    $person->getFirstname(),
                    $person->getGrade()
                ] );

        $statement->execute();
    }
    
    public function edit(\Application\Entity\Person $person) {
        
    }
    
    public function getGrades(){
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