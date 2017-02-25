<?php

namespace Application\Controller;

use Application\Entity\PersonEntity;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\PersonForm;

class PersonnelController extends AbstractActionController
{
    private $manager;
    
    public function __construct(\Application\Service\PersonnelManager $manager) {
        $this->manager = $manager;
    }
    
    public function indexAction()
    {
        $personnels = $this->manager->getAll();
        return new ViewModel(['persons' => $personnels]);
    }
    
    public function addAction() {
        $form = new PersonForm($this->manager->getGrades());
        if($this->getRequest()->isPost()) 
        {
            $data = $this->params()->fromPost();            
            $form->setData($data);
            if($form->isValid()) {
                $data = $form->getData();
                $newPerson = new PersonEntity();
                $newPerson->exchangeArray($data);
                $this->manager->addNew($newPerson);
                return $this->redirect()->toRoute('personnel');
            }            
        } 
        return new ViewModel([
                'form' => $form
           ]);
    }
}