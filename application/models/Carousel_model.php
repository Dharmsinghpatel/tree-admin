<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Carousel_model extends CI_Model
{
    public $tables = array();
    function __construct()
    {
        $this->tables = array('resource' => 'resources', 'carousel' => 'carousel', 'files' => 'files');
        $this->load->model('database_model', 'database');
    }

    function get_carousel()
    {
        $resources = $this->db->select('ca.id,ca.title,ca.created,ca.updated')
            ->order_by('ca.position')
            ->get($this->tables['carousel'] . ' ca');
        return $resources;
    }

    function add_carousel($params)
    {
        extract($params);
        $file_id = null;
        $link = isset($link) && !empty($link) ? $link : (isset($document_id) ? $document_id : null);
        $file_id = isset($hidden_file) ? $hidden_file : null;

        if (!isset($title) || empty($title)) {
            return;
        }

        if (isset($file['image']) && !empty($file['image']['name'])) {
            $file_id = $this->database->do_upload(array('file' => $file['image'], 'file_name' => 'image'));
        }

        $data = array(
            'title' => $title,
            'link' => $link,
            'file_id' => $file_id,
            'description' => $description
        );

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

        if (isset($carousel_id) && !empty($carousel_id)) {
            $data['updated'] = date('Y-m-d h:i:sa');
            $this->db->where('id', $carousel_id)
                ->update($this->tables['carousel'], $data);
        } else {
            $data['created'] = date('Y-m-d h:i:sa');
            $pos = $this->db->select_max('position')
                ->get($this->tables['carousel'])->row();

            $data['position'] = $pos ? $pos->position + 1 : 1;;

            $this->db->insert($this->tables['carousel'], $data);
        }

        $this->db->trans_complete();
        // die;
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
        return TRUE;
    }

    function get_detail($id)
    {
        $resource = array();
        $where = !empty($id) ? array('id' => $id) : array('id !=' => null);
        $resource['content'] =  $this->db->select('ca.id, ca.title, ca.file_id, ca.link , ca.link as document_id, ca.description')
            ->where($where)->get($this->tables['carousel'] . ' ca')->row();

        if (!empty($resource['content'])) {
            $rs = $resource['content'];
            if (!empty($rs->link) && is_numeric($rs->link)) {
                $rs->link = '';
                $rs->document_id = $this->document->get_document_detail($id = $rs->document_id)[0]['title'];
            } else
                $rs->document_id = '';

            $tr = '';
            $file = $this->database->get_file($rs->file_id);
            $tr = render_image($file);
            $resource['content_view'] = $tr;
        }

        return  $resource;
    }



    function sort_carousel($sort_array)
    {
        $status = 'error';
        $order = 1;
        foreach ($sort_array as $val) {
            $this->db->where('id', $val)
                ->update($this->tables['carousel'], array('position' => $order));

            $order += 1;
            $status = 'success';
        }
        return $status;
    }

    function delete_carousel($id)
    {
        $res = $this->db->where('id', $id)
            ->delete($this->tables['carousel']);
        return $res ? 'success' : 'error';
    }
}
