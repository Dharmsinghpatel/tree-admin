  
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        Parent::__construct();
        $this->load->model('auth_model', 'auth');
    }

    public function index()
    {
        header("Access-Control-Allow-Origin: *");
        $this->login();
    }

    public function login($token = '')
    {
        $data = array('title' => "Profile");


        $form = $this->input->post();
        if (!empty($form['submit'])) {
            $validation_rules = $this->config->item('login_form');
            $this->form_validation->set_rules($validation_rules);


            if ($this->form_validation->run() == true) {
                $user_data = $this->auth->login($form['user_id'], $form['password']);


                if (!empty($user_data) && $token == 'ksw') {
                    $this->session->set_userdata('user_data', $user_data);

                    $this->session->set_flashdata('success', 'You login successfully');
                    $redirect = 'charts';
                    redirect(site_url($redirect), 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'User Id or Password invalid!');
                    $redirect = 'login';
                    redirect(site_url($redirect), 'refresh');
                }
            }
        }
        $this->load->view('auth/login', $data);
    }

    public function logout()
    {
        $this->session->unset_userdata('user_data');
        redirect(site_url('auth/login'));
    }

    public function add_profile()
    {
        $data = array('title' => "Profile");
        $form = array();
        $user = $this->session->userdata('user_data');

        $data['detail'] = $this->auth->get_user($user['id']);

        $form = $this->input->post();
        $form['id'] = $user['id'];
        $form['file'] = $_FILES;

        if (!empty($form['submit']) || !empty($form['add'])) {
            $validation_rules = isset($form['crpassword']) && !empty($form['crpassword']) ?
                $this->config->item('adv_profile_form') : $this->config->item('profile_form');

            $form['is_change_pass'] = isset($form['crpassword']) && !empty($form['crpassword']);

            $this->form_validation->set_rules($validation_rules);
            if ($this->form_validation->run() == true) {
                $status = $this->auth->add_profile($form);
                $toast = !empty($id) ? 'Updated' : 'Added';

                if ($status) {
                    $user_data = $this->auth->login($user['user_id'], '', false);
                    $this->session->set_userdata('user_data', $user_data);

                    $this->session->set_flashdata('success', 'Profile ' . $toast . ' successfully');
                    $redirect = 'profile';

                    redirect(site_url($redirect), 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Profile ' . $toast . ' Fail');
                }
            }
        }

        $this->template->set('title', 'Profile');
        $this->template->load('default_layout', 'contents', 'auth/profile', $data);
    }

    public function list_email()
    {
        $data = array('title' => 'Email List', 'datatable_id' => 'email_list', 'data_url' => 'auth/get-email');
        $this->template->set('title', 'List Email');
        $this->template->load('default_layout', 'contents', 'auth/list_email', $data);
    }

    public function get_email()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));

        $resources = $this->auth->get_email();
        $data = array();

        $i = 1;
        foreach ($resources->result_array() as $r) {
            $show_link = site_url('/show-email/' . $r['id']);
            $delete_link = site_url('/delete-email/' . $r['id']);
            $data[] = array(
                "DT_RowClass" => !$r['is_read'] ? 'unread-chat' : '',
                "DT_RowId" => $r['id'],
                $i,
                $r['first_name'],
                $r['last_name'],
                $r['contact'],
                $r['created'],
                '<a class="mr-10" href="javascript:void(0)">
                    <button class="btn btn-outline-primary show" data-show-url="' . $show_link . '"><span class="fa fa-eye"></span></button>
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

    public function show_email($id = null)
    {
        $data = array('status' => 'error', 'html' => '');
        if (!empty($id)) {
            $html = $this->auth->show_email($id);
            $data = array('status' => 'success', 'html' => $html);
        }
        echo json_encode($data);
    }

    public function delete_email($id = null)
    {
        $data = array('status' => 'error');
        if (!empty($id)) {
            $status = $this->auth->delete_email($id);
            $data = array('status' => $status);
        }
        echo json_encode($data);
    }
}
?>