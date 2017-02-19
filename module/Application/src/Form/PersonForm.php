<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;


class PersonForm extends Form {
    
    private $grades;
    
    public function __construct($grades)
    {
        // Define form name
        parent::__construct('Personnel');

        $this->grades = $grades;
        
        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // Add form elements
        $this->addElements();
        
        // Add filtering/validation rules
        $this->addInputFilter();
    }
    
    
    private function addElements() 
    {
        // Add "prenom" field
        $this->add([
                'type'  => 'text',
                'name' => 'firstname',
                'attributes' => [                
                    'id' => 'firstname'
                ],
                'options' => [
                    'label' => 'Prénom',
                ],
            ]);

        // Add "nom" field
        $this->add([
                'type'  => 'text',
                'name' => 'lastname',
                'attributes' => [
                    'id' => 'lastname'  
                ],
                'options' => [
                    'label' => 'Nom',
                ],
            ]);

        // Add "grade" field
        $this->add([
                'type'  => 'Zend\Form\Element\Select',
                'name' => 'grade',
                'attributes' => [
                    'id' => 'grade'  
                ],
                'options' => [
                    'label' => 'Which is your mother tongue?',
                     'empty_option' => 'Choisir le grade',
                     'value_options' => $this->grades
                ],
            ]);

        // Add the submit button
        $this->add([
                'type'  => 'submit',
                'name' => 'submit',
                'attributes' => [                
                    'value' => 'Ok',
                ],
            ]);
    }  
    
    
    private function addInputFilter() {
        $inputFilter = new InputFilter();        
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'     => 'firstname',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],                  
            ],                
            'validators' => [
                [
                'name' => 'StringLength',
                   'options' => [
                     'min' => 1,
                     'max' => 25                           
                    ],
                ],
            ],
        ]  
        );
        
        $inputFilter->add([
            'name'     => 'lastname',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],                  
            ],                
            'validators' => [
                [
                'name' => 'StringLength',
                   'options' => [
                     'min' => 1,
                     'max' => 25
                    ],
                ],
            ],
        ]  
        );

        $inputFilter->add([
            'name'     => 'grade',
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
                   ],
                'name' => 'LessThan',
                   'options' => [
                       'max' => count($this->grades),
                       'inclusive' => false
                   ]
               
                ]
            ]
        ]     
        );
        
    }  
}