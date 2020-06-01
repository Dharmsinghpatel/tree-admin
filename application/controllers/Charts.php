  
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Charts extends CI_Controller
{
    public function __construct()
    {
        Parent::__construct();
        $this->load->model("resources_model", "resource");
        $this->load->model('database_model', 'database');
        // $this->load->helper('url');
    }

    public function index()
    {
        header("Access-Control-Allow-Origin: *");
        $this->chart();
    }

    public function chart()
    {
        $data = array('title' => 'Charts');

        $data['charts'] = $this->resource->chart();

        $this->template->set('title', 'Charts');
        $this->template->load('default_layout', 'contents', 'charts', $data);
    }
}
?>