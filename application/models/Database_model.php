<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Database_model extends CI_Model
{
    public $tables = array();
    function __construct()
    {
        $this->tables = array('resource' => 'resources', 'files' => 'files');
    }

    public function do_upload($file, $file_name, $type, $is_file = true)
    {
        $insert_id = null;
        if (!$is_file) {
            $file_detail = array('file_name' => $file_name, 'unique_name' => $file, 'type' => $type, 'size' => strlen($file));
            $this->db->insert($this->tables['files'], $file_detail);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }

        if ($is_file) {
            $config = $this->config->item($type);
            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload($file_name)) {
                $error = array('error' => $this->upload->display_errors());
                return $error;
            } else {
                $res = array('upload_data' => $this->upload->data());
                $file_arr = $res['upload_data'] ? $res['upload_data'] : array();
                if (!empty($file_arr)) {
                    $file_detail = array('file_name' => $file_arr['orig_name'], 'unique_name' => $file_arr['file_name'], 'type' => $type, 'size' => $file_arr['file_size']);
                    $this->db->insert($this->tables['files'], $file_detail);
                    $insert_id = $this->db->insert_id();
                }
                return $insert_id;
            }
        }
    }

    public function get_file_detail($id)
    {
        $file = array();
        if (!empty($id)) {
            $file = $this->db->select('*')->where('id', $id)->get($this->tables['files'])->row();

            $config = $this->config->item($file->type);

            $content = '';
            switch ($file->type) {
                case 'image': {
                        $path = site_url($config['upload_path']) . "/" . $file->unique_name;
                        $content = '<img src="' . $path . '" class="w-100">';
                        break;
                    }
                case 'site': {
                        $content = $file->unique_name;
                        break;
                    }

                case 'video': {
                        $content = $file->unique_name;
                        break;
                    }
                default: {
                        $content = 'This type data not availble.';
                    }
            }
        }
        return $content;
    }
}
