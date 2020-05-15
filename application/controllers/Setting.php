  
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        Parent::__construct();

        $this->load->model("Setting_model", "setting");
        $this->load->model('database_model', 'database');
    }

    public function index()
    {
        header("Access-Control-Allow-Origin: *");
        $this->setting();
    }

    public function setting()
    {
        $data = array('title' => 'Setting', 'add_path' => 'setting/save-setting');

        $data['setting'] = $this->setting->get_setting();

        $form = $this->input->post();

        if (!empty($form['submit'])) {
            $validation_rules = $this->config->item('setting_form');
            $this->form_validation->set_rules($validation_rules);
            if ($this->form_validation->run() == true) {
                $status = $this->setting->save_setting($form);
                $toast = 'Updated';

                if ($status) {
                    $this->session->set_flashdata('success', 'Setting ' . $toast . ' successfully');
                    $redirect =  '/setting';
                    redirect(site_url($redirect), 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Setting ' . $toast . ' Failed');
                }
            }
        }
        $this->template->set('title', 'Setting');
        $this->template->load('default_layout', 'contents', 'setting', $data);
    }
}
?>