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
use Application\Form\MaterialForGradeForm;
use Application\ValueObject\MaterialPerGradeRow;

class MaterialPersonnelController extends AbstractActionController
{
    private $materialManager;
    private $personnelManager;
    
    public function __construct(\Application\Service\MaterialManager $materialManager,
    \Application\Service\PersonnelManager $personnelManager) {
        $this->materialManager = $materialManager;
        $this->personnelManager = $personnelManager;
    }
    
    public function indexAction() {
        $personnels = $this->personnelManager->getAll();       
        return new ViewModel(['persons' => $personnels]);
    }
    
    public function listAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        try {
            $person = $this->personnelManager->getPerson($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('materialPersonnel', ['action' => 'index']);
        }
        $materials = $this->materialManager->getMaterialsForPerson($id);
        return new ViewModel(['person' => $person,
                              'materials' => $materials]);
    }
    
    
    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        try {
            $material = $this->materialManager->getGradeForSpecificMaterial($id)[0];
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('materialForGrade', ['action' => 'index']);
        }
        $form = new MaterialForGradeForm($this->personnelManager->getGrades(), $material);
        $formData = $material->getFormArray();
        $form->setData($formData);
        $form->setAttribute('action', $material->getMaterialId());
        if($this->getRequest()->isPost()) 
        {
            $data = $this->params()->fromPost();            
            $form->setData($data);
            if($form->isValid()) {
                $editedAssignement = new MaterialPerGradeRow;
                $editedAssignement->populateFromForm($form->getData());
                $this->materialManager->setGradeForSpecificMaterial($editedAssignement);
                return $this->redirect()->toRoute('materialForGrade', ['action' => 'index']);
            }
        }
        $view = new ViewModel([
                'form' => $form
            ]);
        return $view;
    }
}