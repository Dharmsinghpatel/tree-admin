<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Documents extends REST_Controller
{
    // SetEnvIf Authorization "(.*)" HTTP_AUTHORIZATION=$1
    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('carousel_model', 'carousel');
        $this->load->model('Api_model', 'api');
    }

    function topic_post()
    {
        $id = $this->post('id');
        if (!empty($id)) {
            $data = $this->api->topic_detail($id);
            $this->response(array('data' => $data, 'status' => 'success', 'msg' => $this->lang->line('success')), REST_Controller::HTTP_OK);
        } else {
            $this->response(array('data' => array(), 'status' => 'error', 'msg' => $this->lang->line('error')), REST_Controller::HTTP_OK);
        }
    }

    function topics_post()
    {
        $type = convet_secure_input($this->post('type'));

        if (!empty($type)) {
            $data = $this->api->get_topics($type);
            $this->response(array('data' => $data, 'status' => 'success', 'msg' => $this->lang->line('success')), REST_Controller::HTTP_OK);
        } else {
            $this->response(array('data' => array(), 'status' => 'error', 'msg' => $this->lang->line('error')), REST_Controller::HTTP_OK);
        }
    }

    function search_post()
    {
        $data = $this->post();
        $this->form_validation->set_data($data);
        $validation_rules = $this->config->item('search_app_form');
        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('data' => array(), 'status' => 'error', 'msg' => $this->lang->line('invalid_search')), REST_Controller::HTTP_OK);
        } else {
            $data = $data['display_type'] == 'video' ? $this->api->search_videoes($data) : $this->api->search_product($data);
            $this->response(array('data' => $data, 'status' => 'success', 'msg' => $this->lang->line('success')), REST_Controller::HTTP_OK);
        }
    }
}
