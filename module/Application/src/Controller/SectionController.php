<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SectionController extends AbstractActionController
{
    private $manager;
    
    public function __construct(\Application\Service\SectionManager $manager) {
        $this->manager = $manager;
    }
    
    public function indexAction()
    {

    }
    
}