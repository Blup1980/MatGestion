<?php

namespace Application\Controller;

//use Application\Service;
use Application\Entity\Person;
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
    
    public function addAction() {
        $form = new PersonForm($this->manager->getGrades());
        if($this->getRequest()->isPost()) 
        {
            $data = $this->params()->fromPost();            
            $form->setData($data);
            if($form->isValid()) {
                $data = $form->getData();
                $newPerson = new Person();
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