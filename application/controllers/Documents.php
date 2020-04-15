  
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Documents extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        Parent::__construct();
        $this->load->model("documents_model");
    }

    public function index()
    {
        header("Access-Control-Allow-Origin: *");
        $data = array();
        $this->template->set('title', 'contents');
        $this->template->load('default_layout', 'contents', 'documents', $data);
    }

    public function get_documents()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $contents_data = $this->documents_model->get_contents();
        $data = array();

        $i = 1;
        foreach ($contents_data['result'] as $r) {
            $data[] = array(
                $i,
                $r['title'],
                $r['type'],
            );
            $i += 1;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $contents_data['num_rows'],
            "recordsFiltered" => $contents_data['num_rows'],
            "data" => $data
        );

        echo json_encode($output);
    }

    public function basic($param)
    {
        $data = array("basic" => $param);
        $this->template->set('title', 'about');
        $this->template->load('default_layout', 'contents', 'documents', $data);
    }
}
?>