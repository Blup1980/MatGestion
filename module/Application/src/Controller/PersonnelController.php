<?php

namespace Application\Controller;

use Application\Model\Personnel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PersonnelController extends AbstractActionController
{
    private $table;
    
    public function __construct(Personnel $table) {
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