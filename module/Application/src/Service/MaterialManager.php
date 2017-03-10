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
Namespace Application\Service;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\ArraySerializable as ArraySerializableHydrator;
use Zend\Db\RowGateway\RowGateway;
use RuntimeException;
use Application\ValueObject\MaterialPerGradeRow;


class MaterialManager{
    private $db;
    
    public function __construct(\Zend\Db\Adapter\Adapter $db) {
        $this->db = $db;     
    }
    
    public function getAllForGrade() {
        $materielPerGradeRows = [];
        $statement = $this->db->createStatement('
            SELECT mg.id, mg.material_id, m.name as material_name, 
                   mg.grade_id, g.name as grade_name 
            FROM `materialPerGrade` AS mg 
            LEFT JOIN `material` as m ON m.id = mg.material_id 
            LEFT JOIN grades as g ON g.id = mg.grade_id 
            ORDER BY material_id,grade_id;');
        $statement->prepare();
        $resultSet = $statement->execute(NULL);
        if ($resultSet instanceof ResultInterface && $resultSet->isQueryResult()) {
            $currentMaterialId = NULL;
            $currentRow = NULL;
            $currentGrades = [];
            foreach ($resultSet as $materialRow) {
                if ($materialRow['material_id'] != $currentMaterialId) {
                    if ($currentRow) {
                        $currentRow->setGrades($currentGrades);
                        $materielPerGradeRows[] = $currentRow;
                        $currentGrades = [];
                    }
                    $currentMaterialId = $materialRow['material_id'];
                    $currentRow = new MaterialPerGradeRow();
                    $currentRow->setMaterialId($materialRow['material_id']);
                    $currentRow->setMaterialName($materialRow['material_name']);
                }
                $currentGrades[ $materialRow['grade_id'] ] = $materialRow['grade_name'];
           }
           $currentRow->setGrades($currentGrades);
           $materielPerGradeRows[] = $currentRow;
        }
        return $materielPerGradeRows;
    }
    
//    public function addNew(PersonEntity $person) {
//        $statement = $this->db->createStatement('INSERT INTO `personnel` 
//            (`lastname`,`firstname`,`grade_id`,`active`,`driver`,`CIPA`,`CISDIS`,`APR`,`prepose`)
//            VALUES (?,?,?,?,?,?,?,?,?);', 
//            [
//                $person->getLastname(),
//                $person->getFirstname(),
//                $person->getGrade(),
//                $person->getActive(),
//                $person->getDriver(),
//                $person->getCIPA(),
//                $person->getCISDIS(),
//                $person->getAPR(),
//                $person->getPrepose()
//            ] );
//        $statement->execute();
//    }
//    
//    public function edit(PersonEntity $person) {
//        $statement = $this->db->createStatement('SELECT * FROM `personnel` WHERE `id` = ?', [$person->getId()]);
//        $resultSet = $statement->execute();
//        $resultSet->buffer();
//        $result = $resultSet->current();
//        $rowGateway = new RowGateway('id', 'personnel', $this->db);
//        $rowGateway->populate($result, true);
//        $rowGateway->firstname = $person->getFirstname();
//        $rowGateway->lastname = $person->getLastname();
//        $rowGateway->grade_id = $person->getGrade_id();
//        $rowGateway->active = $person->getActive();
//        $rowGateway->driver = $person->getDriver();
//        $rowGateway->CIPA = $person->getCIPA();
//        $rowGateway->CISDIS = $person->getCISDIS();
//        $rowGateway->APR = $person->getAPR();
//        $rowGateway->prepose = $person->getPrepose();
//        $rowGateway->save();
//    }
//    
//    public function delete(PersonEntity $person) {
//        $rowGateway = new RowGateway('id', 'personnel', $this->db);
//        $rowGateway->populate($person->getArrayCopy(), true);
//        $rowGateway->delete();
//    }
//    
//    public function getAll() {
//        $personnels = [];
//        $statement = $this->db->createStatement('SELECT * FROM `personnel` ORDER BY `lastname`');
//        $statement->prepare();
//        $result = $statement->execute(NULL);
//        if ($result instanceof ResultInterface && $result->isQueryResult()) {
//            $resultSet = new HydratingResultSet(new ArraySerializableHydrator, new PersonEntity);
//            $resultSet->initialize($result);
//            foreach ($resultSet as $person) {
//                $personnels[] = $person;
//            }
//        }
//        return $personnels;
//    }
//
//    public function getPerson($id) {
//        $statement = $this->db->createStatement('SELECT * FROM `personnel` WHERE `id` = ?', [$id]);
//        $statement->prepare();
//        $result = $statement->execute(NULL);
//        if ($result instanceof ResultInterface && $result->isQueryResult()) {
//            $resultSet = new HydratingResultSet(new ArraySerializableHydrator, new PersonEntity);
//            $resultSet->initialize($result);
//            if ($resultSet->valid()) {
//                return $resultSet->current();
//            }
//        }    
//        throw new RuntimeException('the person id is not found in the database');
//    }
//
//    public function getGrades() {
//        $grades = [];
//        $statement = $this->db->createStatement('SELECT * FROM grades');
//        $statement->prepare();
//        $result = $statement->execute(NULL);
//        if ($result instanceof ResultInterface && $result->isQueryResult()) {
//            $resultSet = new ResultSet;
//            $resultSet->initialize($result);
//            foreach ($resultSet as $row) {
//                $grades[] = $row['name'];
//            }
//        }
//        return $grades;
//    }
}