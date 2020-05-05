	
<?php

$config = array(
    "resources_form" => array(
        array(
            'field' => 'title',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        ),
        array(
            'field' => 'type',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        )
    ),
    "document_form" => array(
        array(
            'field' => 'title',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        ),
        array(
            'field' => 'type',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        ),
        array(
            'field' => 'content_type',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        )
    )
);
