<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Entity;
use Zend\Stdlib;

class PersonEntity implements Stdlib\ArraySerializableInterface
{
    private $id;
    private $lastname;
    private $firstname;
    private $grade_id;
    private $active;
    private $driver;
    private $CIPA;
    private $CISDIS;
    private $APR;
    private $prepose;
    
    public function exchangeArray(array $data){
        $this->id       = !empty($data['id']) ? $data['id'] : NULL;
        $this->lastname = !empty($data['lastname']) ? $data['lastname'] : NULL;
        $this->firstname= !empty($data['firstname']) ? $data['firstname'] : NULL;
        $this->grade_id = !empty($data['grade_id']) ? $data['grade_id'] : 0;
        $this->active   = !empty($data['active']) ? $data['active'] : 0;
        $this->driver   = !empty($data['driver']) ? $data['driver'] : 0;
        $this->CIPA     = !empty($data['CIPA']) ? $data['CIPA'] : 0;
        $this->CISDIS   = !empty($data['CISDIS']) ? $data['CISDIS'] : 0;
        $this->APR      = !empty($data['APR']) ? $data['APR'] : 0;
        $this->prepose  = !empty($data['prepose']) ? $data['prepose'] : 0;
    }
    
    public function getArrayCopy() {
        return [
            'id' => (int)$this->id,
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'grade_id' => (int)$this->grade_id,
            'active' => (int)$this->active,
            'driver'=> (int)$this->driver,
            'CIPA' => (int)$this->CIPA,
            'CISDIS' => (int)$this->CISDIS,
            'APR' => (int)$this->APR,
            'prepose' => (int)$this->prepose
        ];
    }


    public function getId(){
        return (int)$this->id;
    }
    
    public function setId($id){
        $this->id = (int)$id;
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
    
    public function getGrade_id(){
        return (int)$this->grade_id;
    }
    
    public function setGrade_id($grade) {
        $this->grade_id = (int)$grade;
    }
    
    public function getActive(){
        return (int)$this->active;
    }
    
    public function setActive($active) {
        $this->active = (int)$active;
    }
    
    public function getDriver(){
        return (int)$this->driver;
    }
    
    public function setDriver($driver) {
        $this->driver = (int)$driver;
    }
    
    public function getCIPA(){
        return (int)$this->CIPA;
    }
    
    public function setCIPA($CIPA) {
        $this->CIPA = (int)$CIPA;
    }
    
    public function getCISDIS(){
        return (int)$this->CISDIS;
    }
    
    public function setCISDIS($CISDIS) {
        $this->CISDIS = (int)$CISDIS;
    }
    
    public function getAPR(){
        return (int)$this->APR;
    }
    
    public function setAPR($APR) {
        $this->APR = (int)$APR;
    }
    
    public function getPrepose(){
        return (int)$this->prepose;
    }
    
    public function setPrepose($prepose) {
        $this->prepose = (int)$prepose;
    }
}
