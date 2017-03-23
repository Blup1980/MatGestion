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
use Application\ValueObject\MaterialPerGradeRow;


class MaterialManager{
    private $db;
    
    public function __construct(\Zend\Db\Adapter\Adapter $db) {
        $this->db = $db;     
    }
    
    public function setGradeForSpecificMaterial(MaterialPerGradeRow $material) {
        foreach ($material->getGrades() as $gradeId => $gradeAffected) {
            if ($gradeAffected) {
                $statement = $this->db->createStatement('
                INSERT IGNORE
                INTO `materialPerGrade`
                ( material_id,grade_id ) VALUES(?,?);',[$material->getMaterialId(), $gradeId]);
            } else {
                $statement = $this->db->createStatement('
                DELETE IGNORE 
                FROM `materialPerGrade`
                WHERE material_id = ? AND grade_id = ?;',[$material->getMaterialId(), $gradeId]);
            }
            
            $statement->prepare();
            $statement->execute(NULL);
        }
    }
    
    public function getMaterialName($materialId) {
        $name = "";
        $statement = $this->db->createStatement('
        SELECT name
        FROM `material` WHERE id = ?;',[$materialId]);
        $statement->prepare();
        $resultSet = $statement->execute(NULL);
        $resultSet->buffer();
        if ($resultSet instanceof ResultInterface && $resultSet->isQueryResult()) {
            foreach ($resultSet as $materialRow) {
                $name = $materialRow['name'];
            }
        }
        return $name;   
    }
    
    public function getGradeForSpecificMaterial($materialId = NULL) {
        $materielPerGradeRows = [];
        if ($materialId)
        {
            $statement = $this->db->createStatement('
            SELECT mg.id, mg.material_id, m.name as material_name, 
                   mg.grade_id, g.name as grade_name 
            FROM `materialPerGrade` AS mg 
            LEFT JOIN `material` as m ON m.id = mg.material_id 
            LEFT JOIN grades as g ON g.id = mg.grade_id 
            WHERE mg.material_id = ?
            ORDER BY material_id,grade_id;',[$materialId]);
        } else {
            $statement = $this->db->createStatement('
                SELECT mg.id, m.id as material_id, m.name as material_name, 
                       mg.grade_id, g.name as grade_name 
                FROM `material` as m  
                LEFT JOIN `materialPerGrade` AS mg ON m.id = mg.material_id 
                LEFT JOIN grades as g ON g.id = mg.grade_id 
                ORDER BY material_id,grade_id;');
        }
        $statement->prepare();
        $resultSet = $statement->execute(NULL);
        $resultSet->buffer();
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
            if (!$currentGrades) {
                $currentRow = new MaterialPerGradeRow();
                $currentRow->setMaterialId($materialId);
                $currentRow->setMaterialName($this->getMaterialName($materialId));
                $currentRow->setGrades([]);
            } else {
                $currentRow->setGrades($currentGrades);
            }
            $materielPerGradeRows[] = $currentRow;
        }
        return $materielPerGradeRows;
    }
    
    public function getMaterialsForPerson($personId) {
        
    } 
}