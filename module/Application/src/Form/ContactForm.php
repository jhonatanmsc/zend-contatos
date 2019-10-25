<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;
use Application\Entity\Contact;

class ContactForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('contacts');

        $hidrator = new ClassMethods(false);
        $this->setHydrator($hidrator);
        $this->setObject(new Contact());

        // $address = new AddressFieldset();
        // $this->add($addressFieldset, 'address');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'street',
            'type' => 'text',
            'options' => [
                'label' => 'Rua',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'address street'
            ]
        ]);
        $this->add([
            'name' => 'number',
            'type' => 'number',
            'options' => [
                'label' => 'Número',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'address number'
            ]
        ]);
        $this->add([
            'name' => 'district',
            'type' => 'text',
            'options' => [
                'label' => 'Bairro',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'address district'
            ]
        ]);
        $this->add([
            'name' => 'city',
            'type' => 'text',
            'options' => [
                'label' => 'Cidade',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'address city'
            ]
        ]);
        $this->add([
            'name' => 'name',
            'type' => 'text',
            'options' => [
                'label' => 'Nome',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'name'
            ]
        ]);
        $this->add([
            'name' => 'email',
            'type' => 'email',
            'options' => [
                'label' => 'Email',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'email'
            ]
        ]);
        $this->add([
            'name' => 'phone',
            'type' => 'text',
            'options' => [
                'label' => 'Celular',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'phone'
            ]
        ]);
        $this->add([
            'name' => 'descr',
            'type' => 'text',
            'options' => [
                'label' => 'Descrição',
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'descrition'
            ]
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Save',
                'id'    => 'submitbutton',
                'class' => 'btn btn-primary'
            ],
        ]);
    }
}