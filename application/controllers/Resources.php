  
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
        $this->load->model("resources_model", "resource");
        $this->load->helper('url');
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

        $resources = $this->resource->get_resources();
        $data = array();

        $i = 1;
        foreach ($resources->result_array() as $r) {
            $edit_link = site_url('/resources/add-resource/' . $r['id']);
            $data[] = array(
                "DT_RowId" => $i,
                $i,
                $r['title'],
                $r['type'],
                '<a class="mr-10" href="' . $edit_link . '">
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
            "recordsTotal" => $resources->num_rows(),
            "recordsFiltered" => $resources->num_rows(),
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

    public function add_resource($id = null)
    {
        $data = array('title' => "Add Resource");
        $form = array();

        if (!empty($id)) {
            $data['title'] = 'Edit Resource';
            $data['detail'] = $this->resource->get_detail($id);
        }
        $form = $this->input->post();
        $form['file'] = $_FILES;

        if (!empty($form['submit'])) {
            $validation_rules = $this->config->item('resources_form');
            $this->form_validation->set_rules($validation_rules);
            if ($this->form_validation->run() == true) {
                $status = $this->resource->add_resources($form);

                if ($status) {
                    $this->session->set_flashdata('success', 'Resource Updated successfully');

                    die;
                    // redirect('/resources', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Resource Updated successfully');
                }
            }
        }

        $this->template->set('title', 'Resources');
        $this->template->load('default_layout', 'contents', 'resources/add_resources', $data);
    }
}
?>