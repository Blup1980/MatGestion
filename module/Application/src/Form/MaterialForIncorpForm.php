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
namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Application\ValueObject\MaterialPerIncorpRow;


class MaterialForIncorpForm extends Form {
    
    private $incorps;
    private $material;
    
    public function __construct($incorps, MaterialPerIncorpRow $material)
    {
        parent::__construct('materialForGrade');
        $this->incorps = $incorps;
        $this->material = $material;
        $this->setAttribute('method', 'post');
        $this->addElements();
        $this->addInputFilter();
    }
    
    public function getMaterial() {
        return $this->material;
    }
    
    private function addElements() 
    {
        $this->add([
                'type'  => 'hidden',
                'name' => 'material_id',
                'attributes' => [                
                    'id' => 'material_id',
                    'value' => $this->material->getMaterialId(),
                ],
                'options' => [
                    'label' => ''
                ],
            ]);
        
        foreach ($this->incorps as $grade) {
            $this->add([
                'type'  => 'checkbox',
                'name' => 'grade_'.$grade->getId(),
                'attributes' => [
                    'id' => 'grade_'.$grade->getId() 
                ],
                'options' => [
                    'label' => $grade->getName(),
                ],
            ]);
        }

        $this->add([
                'type'  => 'submit',
                'name' => 'submit',
                'attributes' => [
                    'value' => 'Enregister',
                    ],
                'options' => [  
                ]
            ]);
    }  
    
    
    private function addInputFilter() {
        $inputFilter = new InputFilter();        
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'     => 'material_id',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],                  
            ],                
            'validators' => [
                [
                'name' => 'GreaterThan',
                   'options' => [
                       'min' => 0,
                       'inclusive' => true
                   ]           
                ]
            ]
        ]);
        
        
        foreach ($this->incorps as $grade) {
            $inputFilter->add([
                'name'     => 'grade_'.$grade->getId(),
                'required' => false,
                'filters'  => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                    ['name' => 'StripNewlines'],                  
                ],                
                'validators' => [
                    [
                    'name' => 'InArray',
                       'options' => [
                           'haystack' => [ 0, 1],
                           'inclusive' => true
                       ]
                    ]
                ]
            ]);
        }
    }
}