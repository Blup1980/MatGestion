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
    
    public function populate( $id, $firstName, $lastname, $grade) {
        $this->id       = !empty($id) ? $id : NULL;
        $this->lastname = !empty($lastname) ? $lastname : NULL;
        $this->firstname= !empty($firstName) ? $firstName : NULL;
        $this->grade    = !empty($grade) ? $grade : NULL;
    }
    
    public function exchangeArray(array $data){
        $this->id       = !empty($data['id']) ? $data['id'] : NULL;
        $this->lastname = !empty($data['lastname']) ? $data['lastname'] : NULL;
        $this->firstname= !empty($data['firstname']) ? $data['firstname'] : NULL;
        $this->grade    = !empty($data['grade']) ? $data['grade'] : NULL;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getLastname(){
        return $this->lastname;
    }
    
    public function setLastname($lastname){
        $this->lastname = $lastname;
    }
    
    public function getFirstname(){
        return $this->firstname;
    }
    
    public function setFirstName($firstname) {
        $this->firstname = $firstname;
    }
    
    public function getGrade(){
        return $this->grade;
    }
    
    public function setGrade($grade) {
        $this->grade = $grade;
    }
}

