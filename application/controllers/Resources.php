  
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resources extends CI_Controller
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
        $this->list_resources();
    }

    public function list_resources()
    {
        $data = array('title' => 'Resources List', 'add_path' => 'resources/add-resource', 'datatable_id' => 'resources_list', 'data_url' => 'resources/get-resources', 'data_url_sort' => 'resources/sort_resources');
        $this->template->set('title', 'List Resources');
        $this->template->load('default_layout', 'contents', 'resources/list_resources', $data);
    }

    public function get_resources()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));

        $resources = $this->resource->get_resources();
        $data = array();

        $i = 1;
        foreach ($resources->result_array() as $r) {
            $edit_link = site_url('/resources/add-resource/' . $r['id']);
            $delete_link = site_url('/resources/delete-resource/' . $r['id']);
            $data[] = array(
                "DT_RowId" => $r['id'],
                $i,
                $r['title'],
                $r['resource_type'],
                '<a class="mr-10" href="' . $edit_link . '">
                    <button class="btn btn-outline-primary ">Edit</button>
                </a> 
                <a class="mr-10" href="javascript:void(0)">
                    <button class="btn btn-outline-secondary delete" data-delete-url="' . $delete_link . '" ><span class="fa fa-trash-o f-24"></span></button>
                </a>
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

        if (!empty($form['submit']) || !empty($form['add_more'])) {
            $validation_rules = $this->config->item('resources_form');
            $this->form_validation->set_rules($validation_rules);
            if ($this->form_validation->run() == true) {
                $status = $this->resource->add_resources($form);
                $toast = !empty($id) ? 'Updated' : 'Added';

                if ($status) {
                    $this->session->set_flashdata('success', 'Resource ' . $toast . ' successfully');
                    $redirect = !empty($form['add_more']) ? '/resources/add-resource' : '/resources';
                    redirect(site_url($redirect), 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Resource ' . $toast . ' Failed');
                }
            }
        }

        $this->template->set('title', 'Resources');
        $this->template->load('default_layout', 'contents', 'resources/add_resources', $data);
    }

    public function sort_resources()
    {
        $sort_array = $this->input->post('sort_array');
        $status = 'error';
        if (!empty($sort_array)) {
            $status = $this->resource->sort_resources($sort_array);
        }
        echo json_encode(array('status' => $status));
    }

    public function delete_resource($id = null)
    {
        $status = 'error';
        if (!empty($id)) {
            $status = $this->resource->delete_resource($id);
        }
        echo json_encode(array('status' => $status));
    }

    public function get_resource_content()
    {
        $data = $this->input->post('data');
        $res = array('status' => 'error', 'resources' => array());
        if (isset($data['type']) && !empty($data['type'])) {
            $res = $this->resource->get_resource_content($data['type']);
        }
        echo json_encode($res);
    }

    public function get_resource()
    {
        $data = $this->input->post('data');
        $res = array('status' => 'error', 'resources' => array());
        if (isset($data['file_id']) && !empty($data['file_id'])) {
            $id = $data['file_id_2'] != "null" ? $data['file_id_2'] : $data['file_id'];
            $file = $this->database->get_file_detail($id);
            $res = array('status' => 'success', 'file' => $file);
        }
        echo json_encode($res);
    }
}
?>