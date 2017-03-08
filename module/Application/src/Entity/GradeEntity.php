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

namespace Application\Entity;
use Zend\Stdlib;

class GradeEntity implements Stdlib\ArraySerializableInterface
{
    private $id;
    private $name;
    private $rank;
    
    public function exchangeArray(array $data){
        $this->id       = !empty($data['id']) ? $data['id'] : NULL;
        $this->name = !empty($data['name']) ? $data['name'] : NULL;
        $this->rank= !empty($data['rank']) ? $data['rank'] : NULL;

    }
    
    public function getArrayCopy() {
        return [
            'id' => (int)$this->id,
            'name' => $this->name,
            'rank' => $this->rank
        ];
    }


    public function getId(){
        return (int)$this->id;
    }
    
    public function setId($id){
        $this->id = (int)$id;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function setName($name){
        $this->name = $name;
    }
    
    public function getRank(){
        return $this->rank;
    }
    
    public function setRank($rank) {
        $this->rank = $rank;
    }
}
