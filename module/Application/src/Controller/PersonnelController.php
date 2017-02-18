<?php

namespace Application\Controller;

use Application\Repository\PersonRepository;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PersonnelController extends AbstractActionController
{
    private $table;
    
    public function __construct(PersonRepository $table) {
        $this->table = $table;
    }
    
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function addAction() {
        return new ViewModel();
    }
}