  
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resources extends CI_Controller
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
        $this->load->model("resources_model");
    }

    public function index()
    {
        header("Access-Control-Allow-Origin: *");
        $this->list_resources();
    }

    public function get_resources()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $contents_data = $this->resources_model->get_resources();
        $data = array();

        $i = 1;
        foreach ($contents_data['result'] as $r) {
            $data[] = array(
                "DT_RowId" => $i,
                $i,
                $r['title'],
                $r['type'],
                '<a class="mr-10" href="#">
                    <button class="btn btn-outline-primary ">Edit</button>
                </a> 
                <a class="mr-10" href="#">
                    <button class="btn btn-outline-secondary"><span class="fa fa-trash-o f-24"></span></button>
                </a>
                <input type="hidden" value="1" id="item" name="item">
                '

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

    public function list_resources()
    {
        $data = array('title' => "Resources List", "add_path" => "resources/add-resource", "datatable_id" => "resources-list", "data_url" => "resources/get-resources");
        $this->template->set('title', 'Resources');
        $this->template->load('default_layout', 'contents', 'resources', $data);
    }

    public function add_resource()
    {
        $data = array('title' => "Add Resource");
        $form = array();

        $form['title'] = $this->input->post('title');
        $form['type'] = $this->input->post('type');
        $form['description'] = $this->input->post('description');
        $form['submit'] = $this->input->post('submit');
        $form['add-more'] = $this->input->post('add-more');

        if (!empty($form['submit'])) {
            $validation_rules = $this->config->item('resources_form');
            $this->form_validation->set_rules($validation_rules);

            if ($this->form_validation->run() == true) {
            }
            print_r($this->input->post('submit'));
            echo "show";
        }

        $this->template->set('title', 'Resources');
        $this->template->load('default_layout', 'contents', 'resources/add_resources', $data);
    }
}
?>