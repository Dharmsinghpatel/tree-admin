<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Resources extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('carousel_model', 'carousel');
        $this->load->model('Api_model', 'api');
    }

    function videoes_post()
    {
        $id = $this->post('id');
        if (!empty($id)) {
            $data = $this->api->get_videoes($id);
            $this->response(array('data' => $data, 'status' => 'success', 'msg' => $this->lang->line('success')), REST_Controller::HTTP_OK);
        } else {
            $data = $this->api->get_videoes();
            $this->response(array('data' => $data, 'status' => 'success', 'msg' => $this->lang->line('success')), REST_Controller::HTTP_OK);
        }
    }


    function video_post()
    {
        $data = $this->api->get_dashboard();

        $data = $this->post();
        $this->form_validation->set_data($data);
        $validation_rules = $this->config->item('analytic');
        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'error'), REST_Controller::HTTP_OK);
        } else {
            $this->api->analytic($data);
            $this->response(array('status' => 'success'), REST_Controller::HTTP_OK);
        }
    }
}
