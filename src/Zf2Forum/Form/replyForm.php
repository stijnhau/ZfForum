<?php
namespace Zf2Forum\Form;

use Zend\Form\Form;

class ReplyForm extends Form
{

    public function __construct()
    {
        parent::__construct();

        $this->add(array(
            'name' => 'id',
            'options' => array(
                'label' => ''
            ),
            'attributes' => array(
                'type' => 'hidden'
            )
        ));

        $this->add(array(
            'name' => 'text',
            'options' => array(
                'label' => 'Message'
            ),
            'attributes' => array(
                'type' => 'textarea',
                'class' => 'form-control',
                'rows' => '6'
            )
        ));

        // Submit button.
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Post',
                'id' => 'submitbutton',
                'class' => 'btn btn-primary'
            )
        ));
    }
}
