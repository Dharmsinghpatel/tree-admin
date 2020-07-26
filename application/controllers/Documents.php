  
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Documents extends CI_Controller
{

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
                'title' => 'Info',
                'add_path' => 'documents/add-documents',
                'add_title' => 'Add Info',
                'datatable_id' => 'documents_list',
                'data_url' => 'documents/get-documents',
                'data_url_sort' => 'documents/sort_documents'
            ),
            'blog' => array(
                'title' => 'Blog',
                'add_path' => 'documents/add-documents',
                'add_title' => 'Add Blog',
                'datatable_id' => 'documents_list',
                'data_url' => 'documents/get-documents/blog',
                'data_url_sort' => 'documents/sort_documents'
            ),
            'news' => array(
                'title' => 'News',
                'add_path' => 'documents/add-documents',
                'add_title' => 'Add News',
                'datatable_id' => 'documents_list',
                'data_url' => 'documents/get-documents/news',
                'data_url_sort' => 'documents/sort_documents'
            )
        );

        $this->template->set('title', $data[$arm]['title']);
        $this->template->load('default_layout', 'contents', 'documents/list_documents', $data[$arm]);
    }

    public function get_documents($content_type = 'info')
    {
        $draw = intval($this->input->get("draw"));
        $documents = $this->document->get_documents($content_type);
        $resources = $documents[0];
        $list = $documents[1];

        $data = array();
        $i = 0;
        $topic_start = 0;
        foreach ($list as $key => $r) {
            $edit_link = site_url('/documents/add-documents/' . $r['id']);
            $delete_link = site_url('/documents/delete-document/' . $r['id']);
            $active_toggle = site_url('/documents/active-document/' . $r['id']);
            $active_status = empty($r['is_active']) ? 'Idle' : 'Active';
            // $delete_link = !!$r['is_topic'] ?
            //     site_url('/documents/delete-document/' . $r['id'] . '/' . !!$r['is_topic']) :
            //     site_url('/documents/delete-document/' . $r['id']);
            // $topic_start = !$r['is_topic'] ? $topic_start += 1 : $topic_start;

            // $show_topic = '';
            // if (!$r['is_topic']) {
            //     $next_topic = isset($list[$key + 1]) ? $list[$key + 1]['is_topic'] : 0;
            //     $show_topic = $next_topic ? ' <a class="mr-10 show-topics" href="javascript:void(0)" data-topic-start="' . $topic_start . '"> <span class="fa fa-plus f-12"></a>' : '';
            // }
            // p($r);

            $sno =  $i += 1;
            $data[] = array(
                "DT_RowId" => $r['is_topic'] ? '' : $r['id'],
                // "DT_RowClass" => $r['is_topic'] ? 'd-none topic topic' . $topic_start . '' : 'show',
                $sno,
                '
                <div class="d-flex justify-content-between">
                    <div>
                        ' . $r['title'] . '
                    </div>
                </div>',
                $r['created'],
                $r['updated'],
                '<a class="mr-10" href="javascript:void(0)">
                    <button class="btn btn-outline-primary active" data-active-url="' . $active_toggle . '" >' . $active_status . '</button>
                </a>
                <a class="mr-10" href="' . $edit_link . '">
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
                    $redirect = !empty($form['add_more']) ? '/documents/add-documents' : '/documents/list-documents/' . $form['display_type'] . '';
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

    public function active_document($id)
    {
        $res = array('status' => 'error');
        if (!empty($id)) {
            $res = $this->document->active_documents($id);
        }
        echo json_encode($res);
    }
}
?>