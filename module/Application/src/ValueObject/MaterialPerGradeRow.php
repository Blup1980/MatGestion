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

/**
 * Description of MaterialPerGradeRow
 *
 * @author xraemy
 */

namespace Application\ValueObject;

class MaterialPerGradeRow {
    private $materialId;
    private $materialName;
    private $grades;
    
    public function getMaterialId() {
        return $this->materialId;
    }
    
    public function setMaterialId($materialId) {
        $this->materialId = $materialId;
    }
    
    public function getMaterialName(){
        return $this->materialName;
    }
    
    public function setMaterialName($materialName) {
        $this->materialName = $materialName;
    }
    
    public function getGrades(){
        return $this->grades;
    }
    
    public function setGrades($grades) {
        $this->grades = $grades;
    }
}
