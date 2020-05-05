  
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
        $this->load->model('documents_model', 'document');
        $this->load->model('resources_model', 'resource');
    }

    public function index()
    {
        header("Access-Control-Allow-Origin: *");
        $this->list_documents();
    }

    public function list_documents($arm = 'info')
    {
        $arm = !empty($arm) ? $arm : 0;

        $data = array(
            'info' => array(
                'title' => 'Do you know',
                'add_path' => 'documents/add-documents',
                'add_title' => 'Add Document',
                'datatable_id' => 'documents_list',
                'data_url' => 'documents/get-documents',
                'data_url_sort' => 'documents/sort_documents'
            ),
            'document' => array(
                'title' => 'Reading Content',
                'add_path' => 'documents/add-documents',
                'add_title' => 'Add Reading Content',
                'datatable_id' => 'documents_list',
                'data_url' => 'documents/get-documents/document',
                'data_url_sort' => 'documents/sort_documents'
            ),
            'news' => array(
                'title' => 'News',
                'add_path' => 'documents/add-documents',
                'add_title' => 'Add News',
                'datatable_id' => 'documents_list',
                'data_url' => 'documents/get-documents/document',
                'data_url_sort' => 'documents/sort_documents'
            )
        );

        $this->template->set('title', 'Do you know');
        $this->template->load('default_layout', 'contents', 'documents/list_documents', $data[$arm]);
    }

    public function get_documents($content_type = 'info')
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $documents = $this->document->get_documents($content_type);
        $resources = $documents[0];
        $list = $documents[1];

        $data = array();
        $i = 0;
        $topic_start = 0;
        foreach ($list as $r) {
            $edit_link = site_url('/documents/add-documents/' . $r['id']);
            $delete_link = site_url('/documents/delete-document/' . $r['id'] . '/' . !!$r['is_topic']);
            $topic_start = !$r['is_topic'] ? $topic_start += 1 : $topic_start;

            $show_topic = '';
            if (!$r['is_topic']) {
                $show_topic = ' <a class="mr-10 show-topics" href="javascript:void(0)" data-topic-start="' . $topic_start . '"> <span class="fa fa-plus f-12"></a>';
            }

            $sno =  $i += 1;
            $data[] = array(
                "DT_RowId" => $r['is_topic'] ? '' : $r['id'],
                "DT_RowClass" => $r['is_topic'] ? 'd-none topic topic' . $topic_start . '' : 'show',
                $sno,
                '
                <div class="d-flex justify-content-between">
                    <div>
                        ' . $r['title'] . '
                    </div>
                    <div>
                        ' . $show_topic . '
                    </div>
                </div>',
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
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $resources->num_rows(),
            "recordsFiltered" => $resources->num_rows(),
            "data" => $data
        );

        echo json_encode($output);
    }

    public function add_documents($id = null)
    {
        $data = array('title' => "Add Documents");
        $form = array();

        if (!empty($id)) {
            $data['title'] = 'Edit Documents';
            $data['detail'] = $this->document->get_detail($id);
        }

        $form = $this->input->post();
        $form['file'] = $_FILES;

        if (!empty($form['submit']) || !empty($form['add_more'])) {
            $validation_rules = $this->config->item('document_form');
            $this->form_validation->set_rules($validation_rules);
            if ($this->form_validation->run() == true) {

                $status = $this->document->add_documents($form);
                $toast = !empty($id) ? 'Updated' : 'Added';

                if ($status) {
                    $this->session->set_flashdata('success', 'Resource ' . $toast . ' successfully');
                    $redirect = !empty($form['add_more']) ? '/documents/add-documents' : '/documents/list-documents/' . $form['content_type'] . '';
                    redirect(site_url($redirect), 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Resource ' . $toast . ' successfully');
                }
            }
        }

        $this->template->set('title', 'Documents');
        $this->template->load('default_layout', 'contents', 'documents/add_documents', $data);
    }


    public function sort_documents()
    {
        $sort_array = $this->input->post('sort_array');

        $status = 'error';
        if (!empty($sort_array)) {
            $status = $this->document->sort_documents($sort_array);
        }
        echo json_encode(array('status' => $status));
    }

    public function delete_document($id, $is_topic = 0)
    {
        $status = 'error';
        if (!empty($id)) {
            $status = $this->document->delete_documents($id, $is_topic);
        }
        echo json_encode(array('status' => $status));
    }
}
?>