<?php
class Template
{
    //ci instance
    private $CI;
    //template Data
    var $template_data = array();
    public $tables = array();
    public function __construct()
    {
        $this->tables = array('chat' => 'chat', 'carousel' => 'carousel');
        $this->CI = &get_instance();
    }

    function set($content_area, $value)
    {
        $this->template_data[$content_area] = $value;
    }

    function load($template = '', $name = '', $view = '', $view_data = array(), $return = FALSE)
    {
        // We need to use $CI->session instead of $this->session
        $user = $this->CI->session->userdata('user_data');

        if (!isset($user)) {
            redirect(site_url('login'));
        }

        $this->CI->load->database();

        $unread_msg = $this->CI->db->where(['is_read' => null])
            ->from($this->tables['chat'])
            ->count_all_results();
        $today = date('Y-m-d');
        $notification = $this->CI->db->where('start_date > "' . $today . '" OR end_date < "' . $today . '"')
            ->from($this->tables['carousel'])
            ->count_all_results();

        $this->template_data['user'] = $this->CI->session->userdata('user_data');
        $this->template_data['unread_msg'] = $unread_msg;
        $this->template_data['notification'] =  $notification;

        $this->set($name, $this->CI->load->view($view, $view_data, TRUE));

        $this->CI->load->view('layouts/' . $template, $this->template_data);
    }
}
