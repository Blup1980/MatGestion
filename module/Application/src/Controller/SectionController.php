<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use Application\Form\PersonForm;

class SectionController extends AbstractActionController
{
    private $manager;
    
    public function __construct(\Application\Service\SectionManager $manager) {
        $this->manager = $manager;
    }
    
    public function indexAction()
    {
        $dummyPerson1 = new Person();
        $dummyPerson2 = new Person();
        $dummyPerson1->populate(1, 'hans', 'Shaudi', 'Cpl');
        $dummyPerson2->populate(2, 'Liselotte', 'Shaudi', 'Sap');
        $dummyPersons = [
            $dummyPerson1,
            $dummyPerson2
        ];
        return new ViewModel(['persons' => $dummyPersons]);
    }
    
}