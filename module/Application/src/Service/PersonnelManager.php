<?php

Namespace Application\Service;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PersonnelManager{
    private $personRepository;
    
    public function __construct(Application\Repository\PersonRepository $personRepository) {
        $this->personRepository = $personRepository;
    }
    
    public function addNew(Application\Entity\Person $person) {
        
    }
    
    public function edit(Application\Entity\Person $person) {
        
    }
        
}