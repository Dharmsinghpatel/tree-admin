<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Dashboard extends REST_Controller
{

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

    /**
     * Get All home page content.
     *
     * @return Response
     */
    function index_get()
    {
        $data = $this->api->get_dashboard();

        if (!empty($data)) {
            $this->response(array('data' => $data, 'status' => 'success', 'msg' => $this->lang->line('success')), REST_Controller::HTTP_OK);
        } else {
            $this->response(array('data' => array(), 'status' => 'error', 'msg' => $this->lang->line('error')), REST_Controller::HTTP_OK);
        }
    }
}
