<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Auth extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model', 'auth');
        $this->load->model('Api_model', 'api');
    }

    function sendMessage_post()
    {
        $data = $this->post();

        $this->form_validation->set_data($data);
        $validation_rules = $this->config->item('message');
        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'error', 'msg' => $this->form_validation->error_array()), REST_Controller::HTTP_OK);
        } else {
            $status = $this->api->message_save($data);
            $this->response(array('status' => $status, 'msg' => $this->lang->line($status ? 'success' : 'error')), REST_Controller::HTTP_OK);
        }
    }
}
