<?php
/**
 *  MatGestion
 *  Copyright (C) 2017 Blup1980
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.

 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MaterialForGradeController extends AbstractActionController
{
    private $materialManager;
    private $personnalManager;
    
    public function __construct(\Application\Service\MaterialManager $materialManager,
    \Application\Service\PersonnelManager $personnalManager) {
        $this->materialManager = $materialManager;
        $this->personnalManager = $personnalManager;
    }
    
    public function indexAction() {
        $materialForGrades = $this->materialManager->getAllForGrade();
        return new ViewModel(['materialForGrades' => $materialForGrades,
                              'personnalManager' => $this->personnalManager ]);
    }
    
    public function editAction() {
//        $id = (int) $this->params()->fromRoute('id', 0);
//        try {
//            $person = $this->personnelManager->getPerson($id);
//        } catch (\Exception $e) {
//            return $this->redirect()->toRoute('personnel', ['action' => 'index']);
//        }
//        $form = new PersonForm($this->personnelManager->getGrades());
//        $form->bind($person);
//        $form->get('submit')->setAttribute('value', 'Ok');
//        $form->setAttribute('method', 'post');
//        $form->setAttribute('action', '/personnel/edit/'. $id);
//        if($this->getRequest()->isPost()) 
//        {
//            $data = $this->params()->fromPost();            
//            $form->setData($data);
//            if($form->isValid()) {
//                $newPerson = $form->getData();
//                $this->personnelManager->edit($newPerson);
//                return $this->redirect()->toRoute('personnel');
//            }           
//        }
//        $view = new ViewModel([
//                'form' => $form
//            ]);
//        $view->setTemplate('application/personnel/add_edit');
//        return $view;
    }
}