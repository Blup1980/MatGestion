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
    
    public function indexAction() {
        $personnels = $this->manager->getAll();
        return new ViewModel(['persons' => $personnels]);
    }
    
    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        try {
            $person = $this->manager->getPerson($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('personnel', ['action' => 'index']);
        }
        $form = new PersonForm($this->manager->getGrades());
        $form->bind($person);
        $form->get('submit')->setAttribute('value', 'Ok');
        $form->setAttribute('method', 'post');
        $form->setAttribute('action', '/personnel/edit/'. $id);
        if($this->getRequest()->isPost()) 
        {
            $data = $this->params()->fromPost();            
            $form->setData($data);
            if($form->isValid()) {
                $newPerson = $form->getData();
                $this->manager->edit($newPerson);
            }
            return $this->redirect()->toRoute('personnel');
        }
        $view = new ViewModel([
                'form' => $form
            ]);
        $view->setTemplate('application/personnel/add_edit');
        return $view;
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        try {
            $person = $this->manager->getPerson($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('personnel', ['action' => 'index']);
        }
        $this->manager->delete($person);
        return $this->redirect()->toRoute('personnel', ['action' => 'index']);
    }
    
    public function addAction() {
        $form = new PersonForm($this->manager->getGrades());
        $form->get('submit')->setAttribute('value', 'Ajouter');
        $form->setAttribute('method', 'post');
        $form->setAttribute('action', 'add');
        
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
        $view = new ViewModel([
                'form' => $form
            ]);
        $view->setTemplate('application/personnel/add_edit');
        return $view;
    }
}