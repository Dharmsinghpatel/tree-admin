<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Resources_model extends CI_Model
{
    public $tables = array();
    function __construct()
    {
        $this->tables = array('resource' => 'resources');
        $this->load->model('database_model', 'database');
    }

    function get_resources()
    {
        $resources = $this->db->select('rs.id,rs.title,rs.type')->get($this->tables['resource'] . ' rs');
        return $resources;
    }

    function add_resources($params)
    {
        extract($params);
        $file_id = null;
        $url = isset($url) ? $url : null;
        $file_id = isset($hidden_file) ? $hidden_file : null;

        if (!isset($type) || empty($type)) {
            return;
        }

        if (isset($file['image']) && !empty($file['image']['name']) && $type == 'image') {
            $file_id = $this->database->do_upload($file['image'], 'image', 'image');
        } else if ($type != 'image') {
            $file_id = $this->database->do_upload($url, $title, $type, false);
        }

        $data = array(
            'title' => $title,
            'type' => $type,
            'file_id' => $file_id,
            'description' => $description
        );

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

        if (isset($resource_id) && !empty($resource_id)) {
            $this->db->where('id', $resource_id)
                ->update($this->tables['resource'], $data);
        } else {
            $pos = $this->db->select_max('position')
                ->get($this->tables['resource'])->row();
            $data['position'] = $pos;
            $pos = $pos ? $pos->position + 1 : 1;
            $this->db->insert($this->tables['resource'], $data);
        }
        $this->db->trans_complete(); # Completing transaction

        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return FALSE;
        }
        return TRUE;
    }

    function get_detail($id)
    {
        $resource = array();
        if (!empty($id)) {
            $resource = $this->db->select('*')->where('id', $id)->get($this->tables['resource'])->row();
        }
        return $resource;
    }
}
