<?php
namespace Zf2Forum\Form;

use Zend\Form\Form;

class PostForm extends Form
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
            'name' => 'title',
            'options' => array(
                'label' => 'Subject'
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control'
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
