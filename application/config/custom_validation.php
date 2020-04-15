	
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
        ),
        array(
            'field' => 'url',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        )
    )
);
