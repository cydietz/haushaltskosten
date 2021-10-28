<?php

namespace Hako\Form;

use Laminas\Form\Form;

class SpendingForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('spending');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'store',
            'type' => 'text',
            'options' => [
                'label' => 'Store',
            ],
        ]);
        $this->add([
            'name' => 'price',
            'type' => 'number',
            'options' => [
                'label' => 'Price',
            ],
            'attributes' => [
                'step' => '0.01'
            ]
        ]);
        $this->add([
            'name' => 'date',
            'type' => 'date',
            'options' => [
                'label' => 'Date',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}