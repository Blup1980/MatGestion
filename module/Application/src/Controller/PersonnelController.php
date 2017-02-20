<?php

namespace Application\Controller;

use Application\Service;
use Application\Entity;
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
        $dummyPerson1 = new Entity\Person();
        $dummyPerson2 = new Entity\Person();
        $dummyPerson1->populate(1, 'hans', 'Shaudi', 'Cpl');
        $dummyPerson2->populate(2, 'Liselotte', 'Shaudi', 'Sap');
        $dummyPersons = [
            $dummyPerson1,
            $dummyPerson2
        ];
        return new ViewModel(['persons' => $dummyPersons]);
    }
    
    public function addAction() {
        // Create Contact Us form
        $form = new PersonForm($this->manager->getGrades());

        // Check if user has submitted the form
        if($this->getRequest()->isPost()) 
        {
          // Fill in the form with POST data
          $data = $this->params()->fromPost();            
          $form->setData($data);

          // Validate form
          if($form->isValid()) {

            // Get filtered and validated data
            $data = $form->getData();

            // ... Do something with the validated data ...

            // Redirect to "Thank You" page
            return $this->redirect()->toRoute('personnel');
          }            
        } 

        // Pass form variable to view
        return new ViewModel([
              'form' => $form
           ]);
    }
}