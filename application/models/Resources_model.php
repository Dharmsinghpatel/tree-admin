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
        $resources = $this->db->select('rs.id,rs.title,rs.type')
            ->order_by('position')
            ->get($this->tables['resource'] . ' rs');
        return $resources;
    }

    function add_resources($params)
    {
        extract($params);
        $file_id = null;
        $url = isset($url) ? $url : null;
        $file_id = isset($hidden_file) ? $hidden_file : null;
        $file_id_2 = isset($hidden_file_2) ? $hidden_file_2 : null;

        if (!isset($type) || empty($type)) {
            return;
        }

        if (isset($file['image']) && !empty($file['image']['name']) && $type == 'image') {
            $file_id = $this->database->do_upload($file['image'], 'image', 'image');
        } else if ($type != 'image') {
            $file_id = $this->database->do_upload($url, $title, $type, false);
        }

        if (isset($file['video_thumbnail']) && !empty($file['video_thumbnail']['name']) && $type == 'video') {
            $file_id_2 = $this->database->do_upload($file['video_thumbnail'], 'video_thumbnail', 'image');
        }

        $data = array(
            'title' => $title,
            'type' => $type,
            'file_id' => $file_id,
            'file_id_2' => $file_id_2,
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

            $data['position'] = $pos ? $pos->position + 1 : 1;;

            $this->db->insert($this->tables['resource'], $data);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
        return TRUE;
    }

    function get_detail($id)
    {
        $resource = array();
        $resource['content'] = $this->get_resource($id);

        if (!empty($resource['content'])) {
            $rs = $resource['content'];
            $tr = '';
            $file = $this->database->get_file($rs->file_id);

            switch ($rs->type) {
                case 'image':
                    $tr = render_image($file);
                    break;
                case  'site':
                    $tr = render_link($file);
                    break;
                case 'video':
                    $file_2 = $this->database->get_file($rs->file_id_2);
                    $tr = render_video($file, $file_2);
                    break;
                default:
                    $tr = 'Error';
            }
            $resource['content_view'] = $tr;
        }

        return  $resource;
    }

    function get_resource($id)
    {
        $resource = array();
        if (!empty($id)) {
            $resource = $this->db->select('rs.id, rs.title, rs.type, rs.file_id, rs.file_id_2, rs.description, rs.created')
                ->where('id', $id)->get($this->tables['resource'] . ' rs')->row();
        }
        return $resource;
    }

    function sort_resources($sort_array)
    {
        $status = 'error';
        $order = 1;
        foreach ($sort_array as $val) {
            $this->db->where('id', $val)
                ->update($this->tables['resource'], array('position' => $order));

            $order += 1;
            $status = 'success';
        }
        return $status;
    }

    function delete_resource($id)
    {
        $res = $this->db->where('id', $id)
            ->delete($this->tables['resource']);
        return $res ? 'success' : 'error';
    }


    function get_resource_content($type)
    {
        $resources = $this->db->select('rs.id,rs.file_id,rs.file_id_2,rs.title,rs.type ')
            ->order_by('position')
            ->where('type', $type)
            ->get($this->tables['resource'] . ' rs')
            ->result_array();
        return array('status' => 'success', 'resources' => $resources);
    }
}
