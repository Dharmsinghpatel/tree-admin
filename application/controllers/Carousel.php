  
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carousel extends CI_Controller
{
    public function __construct()
    {
        Parent::__construct();
        $this->load->model("carousel_model", "carousel");
        $this->load->model("documents_model", "document");
        $this->load->model('database_model', 'database');
        // $this->load->helper('url');
    }

    public function index()
    {
        header("Access-Control-Allow-Origin: *");
        $this->list_carousel();
    }

    public function list_carousel($is_notification = 0)
    {
        $data = array(
            'title' => 'Carousel List',
            'add_path' => 'carousel/add-carousel/' . $is_notification . '',
            'datatable_id' => 'carousel_list',
            'data_url' => 'carousel/get-carousel/' . $is_notification . '',
            'data_url_sort' => 'carousel/sort_carousel'
        );
        $this->template->set('title', 'List Carousel');
        $this->template->load('default_layout', 'contents', 'carousel/list_carousel', $data);
    }

    public function add_carousel($is_notification = 0, $id = null)
    {
        $data = array('title' => "Add Carousel", 'is_notification' => $is_notification);
        $form = array();

        $selected = '';
        if (!empty($id)) {
            $data['title'] = 'Edit Carousel';
            $data['detail'] = $this->carousel->get_detail($id);
            $selected = $data['detail']['content']->document_id;
        }

        $form = $this->input->post();
        $form['file'] = $_FILES;
        $documents = $this->document->get_document_detail();

        $ops = '';
        foreach ($documents as $key => $document) {
            if ($document['id'] == $selected) {
                $ops .= '<option  selected value="' . $document['id'] . '">' . $document['title'] . '</option>';
            } else {
                $ops .= '<option  value="' . $document['id'] . '">' . $document['title'] . '</option>';
            }
        }

        $data['options'] = $ops;

        if (!empty($form['submit']) || !empty($form['add_more'])) {
            $validation_rules = $this->config->item('carousel_form');
            $this->form_validation->set_rules($validation_rules);

            if ($this->form_validation->run() == true) {
                $status = $this->carousel->add_carousel($form);
                $toast = !empty($id) ? 'Updated' : 'Added';

                if ($status) {
                    $this->session->set_flashdata('success', 'Carousel ' . $toast . ' successfully');
                    $redirect = !empty($form['add_more']) ? '/carousel/add-carousel/' . $is_notification  : '/carousel/list-carousel/' . $is_notification;
                    redirect(site_url($redirect), 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Carousel ' . $toast . ' fail!');
                }
            }
        }

        $this->template->set('title', 'Carousel');
        $this->template->load('default_layout', 'contents', 'carousel/add_carousel', $data);
    }

    public function get_carousel($is_notification = 0)
    {
        $draw = intval($this->input->get("draw"));

        $carousel = $this->carousel->get_carousel($is_notification);
        $data = array();

        $i = 1;
        foreach ($carousel->result_array() as $r) {
            $edit_link = site_url('/carousel/add-carousel/' . $is_notification . '/' . $r['id']);
            $delete_link = site_url('/carousel/delete-carousel/' . $r['id']);
            $data[] = array(
                "DT_RowId" => $r['id'],
                $i,
                $r['title'],
                $r['created'],
                $r['updated'],
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
            "recordsTotal" => $carousel->num_rows(),
            "recordsFiltered" => $carousel->num_rows(),
            "data" => $data
        );

        echo json_encode($output);
    }

    public function sort_carousel()
    {
        $sort_array = $this->input->post('sort_array');
        $status = 'error';
        if (!empty($sort_array)) {
            $status = $this->carousel->sort_carousel($sort_array);
        }
        echo json_encode(array('status' => $status));
    }

    public function delete_carousel($id = null)
    {
        $status = 'error';
        if (!empty($id)) {
            $status = $this->carousel->delete_carousel($id);
        }
        echo json_encode(array('status' => $status));
    }
}
?>