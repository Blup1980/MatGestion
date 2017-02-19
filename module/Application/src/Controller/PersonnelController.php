<?php

namespace Application\Controller;

use Application\Repository\PersonRepository;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\PersonForm;

class PersonnelController extends AbstractActionController
{
    private $table;
    private $grades = [
        'Rec',
        'Sap',
        'Cpl'
    ];

    
    public function __construct(PersonRepository $table) {
        $this->table = $table;
    }
    
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function addAction() {
        // Create Contact Us form
        $form = new PersonForm($this->grades);

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