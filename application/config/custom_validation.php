	
<?php

$config = array(
    "resources_form" => array(
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        ),
        array(
            'field' => 'resource_type',
            'label' => 'Resource Type',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        )
    ),
    "document_form" => array(
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        ),
        array(
            'field' => 'display_type',
            'label' => 'Dispaly Type',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        )
    ),
    "carousel_form" => array(
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        )
    ),
    "profile_form" => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        ),
        array(
            'field' => 'user_id',
            'Label' => 'User Id',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        )
    ),
    "adv_profile_form" => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        ),
        array(
            'field' => 'user_id',
            'Label' => 'User Id',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        ),
        array(
            'field' => 'crpassword',
            'label' => 'Current Password',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        ),
        array(
            'field' => 'cpassword',
            'label' => 'Confirm Password',
            'rules' => array('trim', 'matches[password]'),
            'errors' =>  'You must provide a %s.',
        ),
    ),
    "login_form" => array(
        array(
            'field' => 'user_id',
            'label' => 'User Id',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => array('trim', 'required'),
            'errors' =>  'You must provide a %s.',
        )
    ),
    "setting_form" => array(
        array(
            'field' => 'carousel_limit',
            'label' => 'Carousel Limit',
            'rules' => array('trim', 'required', 'regex_match[/^[0-9,]+$/]'),
            'errors' =>  'You must provide a %s.',
        )
    ),

    /**
     * app search form validation
     */
    "search_app_form" => array(
        array(
            'field' => 'product_name',
            'rules' => array('trim')
        ),
        array(
            'field' => 'product_type',
            'rules' => array('trim', 'required')
        ),
        array(
            'field' => 'display_type',
            'rules' => array('trim', 'required')
        )
    ),
    "analytic" => array(
        array(
            'field' => 'video_id',
            'rules' => array('trim', 'required')
        )
    ),
    "message" => array(
        array(
            'field' => 'first_name',
            'label' => 'First Name',
            'rules' => array('trim', 'required', 'max_length[99]'),
            'errors' =>  'You must check %s.',
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last Name',
            'rules' => array('trim', 'max_length[99]'),
            'errors' =>  'You must check %s.',
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => array('trim', 'max_length[99]', 'valid_email[email]'),
            'errors' =>  'You must check %s.',
        ),
        array(
            'field' => 'comment',
            'label' => 'Comment',
            'rules' => array('trim', 'max_length[249]'),
            'errors' =>  'You must check %s.',
        ),
    ),
);
