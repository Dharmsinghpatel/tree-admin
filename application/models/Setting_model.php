<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model
{
    public $tables = array();
    function __construct()
    {
        $this->tables = array('resource' => 'resources', 'document' => 'documents', 'contents' => 'contents', 'classification' => 'classification', 'user' => 'user', 'files' => 'files', 'email' => 'email', 'setting' => 'setting');
        $this->load->model('database_model', 'database');
    }

    function get_setting()
    {
        $setting = $this->db->select('*')
            ->get($this->tables['setting'])
            ->row();
        return $setting;
    }

    function save_setting($params)
    {
        extract($params);
        $api_on = isset($api_on) ? 1 : 0;
        $dashboard_random = isset($dashboard_random) ? 1 : 0;
        $comment_allow = isset($comment_allow) ? 1 : 0;
        $carousel_random = isset($carousel_random) ? 1 : 0;
        $carousel_event = isset($carousel_event) ? 1 : 0;
        $carousel_limit = isset($carousel_limit) ? $carousel_limit : 1;
        $id = isset($id) ? $id : 1;

        $data = array(
            'api_on' => $api_on,
            'dashboard_random' => $dashboard_random,
            'comment_allow' => $comment_allow,
            'carousel_random' => $carousel_random,
            'carousel_event' => $carousel_event,
            'carousel_limit' => $carousel_limit,
            'updated' => date('Y-m-d h:i:sa')
        );

        $res = $this->db->where('id', $id)
            ->update($this->tables['setting'], $data);

        return $res > 0;
    }
}
