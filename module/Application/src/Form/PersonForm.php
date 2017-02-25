<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;


class PersonForm extends Form {
    
    private $grades;
    
    public function __construct($grades)
    {
        parent::__construct('Personnel');
        $this->grades = $grades;
        $this->setAttribute('method', 'post');
        $this->addElements();
        $this->addInputFilter();
    }
    
    
    private function addElements() 
    {
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
        
        $this->add([
                'type'  => 'checkbox',
                'name' => 'active',
                'attributes' => [
                    'id' => 'active'  
                ],
                'options' => [
                    'label' => 'Actif',
                ],
            ]);
        
        $this->add([
                'type'  => 'checkbox',
                'name' => 'driver',
                'attributes' => [
                    'id' => 'driver'  
                ],
                'options' => [
                    'label' => 'Chauffeur',
                ],
            ]);
        
        $this->add([
                'type'  => 'checkbox',
                'name' => 'APR',
                'attributes' => [
                    'id' => 'APR'  
                ],
                'options' => [
                    'label' => 'APR',
                ],
            ]);
        
        $this->add([
                'type'  => 'checkbox',
                'name' => 'prepose',
                'attributes' => [
                    'id' => 'prepose'  
                ],
                'options' => [
                    'label' => 'Préposé',
                ],
            ]);
        
        $this->add([
                'type'  => 'checkbox',
                'name' => 'CIPA',
                'attributes' => [
                    'id' => 'CIPA'  
                ],
                'options' => [
                    'label' => 'CIPA',
                ],
            ]);
        
        $this->add([
                'type'  => 'checkbox',
                'name' => 'CISDIS',
                'attributes' => [
                    'id' => 'CISDIS'  
                ],
                'options' => [
                    'label' => 'CISDIS',
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
        $inputFilter->add([
            'name'     => 'active',
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
        ]     
        );
        $inputFilter->add([
            'name'     => 'driver',
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
        ]     
        );
        $inputFilter->add([
            'name'     => 'APR',
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
        ]     
        );
        $inputFilter->add([
            'name'     => 'prepose',
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
        ]     
        );
        $inputFilter->add([
            'name'     => 'CIPA',
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
        ]     
        );
        $inputFilter->add([
            'name'     => 'CISDIS',
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
        ]     
        );
    }
}