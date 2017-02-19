<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Entity;

class Person
{
    private $id;
    private $lastname;
    private $firstname;
    private $grade;
    
    public function exchangeArray(array $data){
        $this->id       = !empty($data['id']) ? $data['id'] : NULL;
        $this->lastname = !empty($data['lastname']) ? $data['lastname'] : NULL;
        $this->firstname= !empty($data['firstname']) ? $data['firstname'] : NULL;
        $this->grade    = !empty($data['grade']) ? $data['grade'] : NULL;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getLastname(){
        return $this->lastname;
    }
    
    public function getFirstname(){
        return $this->firstname;
    }
    
    public function getGrade(){
        return $this->grade;
    }
}

