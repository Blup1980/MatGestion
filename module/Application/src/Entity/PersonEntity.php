<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Entity;

class PersonEntity
{
    private $id;
    private $lastname;
    private $firstname;
    private $grade;
    private $active;
    private $driver;
    private $CIPA;
    private $CISDIS;
    private $APR;
    private $prepose;
    
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
        $this->grade    = !empty($data['grade']) ? $data['grade'] : 0;
        $this->active   = !empty($data['active']) ? $data['active'] : 0;
        $this->driver   = !empty($data['driver']) ? $data['driver'] : 0;
        $this->CIPA     = !empty($data['CIPA']) ? $data['CIPA'] : 0;
        $this->CISDIS   = !empty($data['CISDIS']) ? $data['CISDIS'] : 0;
        $this->APR      = !empty($data['APR']) ? $data['APR'] : 0;
        $this->prepose  = !empty($data['prepose']) ? $data['prepose'] : 0;
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
    
    public function getActive(){
        return $this->active;
    }
    
    public function setActive($active) {
        $this->active = $active;
    }
    
    public function getDriver(){
        return $this->driver;
    }
    
    public function setDriver($driver) {
        $this->driver = $driver;
    }
    
    public function getCIPA(){
        return $this->CIPA;
    }
    
    public function setCIPA($CIPA) {
        $this->CIPA = $CIPA;
    }
    
    public function getCISDIS(){
        return $this->CISDIS;
    }
    
    public function setCISDIS($CISDIS) {
        $this->CISDIS = $CISDIS;
    }
    
    public function getAPR(){
        return $this->APR;
    }
    
    public function setAPR($APR) {
        $this->APR = $APR;
    }
    
    public function getPrepose(){
        return $this->prepose;
    }
    
    public function setPrepose($prepose) {
        $this->prepose = $prepose;
    }
}
