<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Database_model extends CI_Model
{
    public $tables = array();
    function __construct()
    {
        $this->tables = array('resource' => 'resources', 'files' => 'files');
    }

    public function do_upload($params)
    {
        extract($params);
        $file = isset($file) ? $file : array();
        $file_name = isset($file_name) ? $file_name : '';
        $file_type = isset($file_type) ? $file_type : 'image';
        $is_file = isset($is_file) ? $is_file : true;
        $file_id = isset($file_id) ? $file_id : null;


        $insert_id = null;
        if (!$is_file) {

            $file_detail = array('file_name' => $file_name, 'unique_name' => $file, 'file_type' => $file_type, 'size' => strlen($file));
            $this->db->insert($this->tables['files'], $file_detail);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }

        if ($is_file) {
            $config = $this->config->item($file_type);
            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload($file_name)) {
                $error = array('error' => $this->upload->display_errors());
                return $error;
            } else {
                $res = array('upload_data' => $this->upload->data());
                $file_arr = $res['upload_data'] ? $res['upload_data'] : array();
                if (!empty($file_arr)) {
                    $file_detail = array('file_name' => $file_arr['orig_name'], 'unique_name' => $file_arr['file_name'], 'file_type' => $file_type, 'size' => $file_arr['file_size']);
                    $this->db->insert($this->tables['files'], $file_detail);
                    $insert_id = $this->db->insert_id();
                    if(is_numeric($insert_id)) {
                        $this->unlink_file($file_id);
                    }

                }

                return $insert_id;
            }
        }
    }

    public function unlink_file($file_id)
    {

        if (isset($file_id) && !empty($file_id)) {
            $file = $this->db->select('unique_name, file_type')
                ->where('id', $file_id)
                ->get($this->tables['files'])->row();

            if (!empty($file) && $file->file_type == 'image') {
                $config = $this->config->item($file->file_type);
                !empty($file) ? unlink($config['upload_path'] . '' . $file->unique_name) : '';
            }

            $res = $this->db->where('id', $file_id)
                ->delete($this->tables['files']);
            return $res > 0;
            return true;
        }
    }

    public function get_file_detail($id, $desc = false)
    {
        $file = array();
        $content = '';

        if (!empty($id) && !$desc) {
            $file = $this->db->select('*')->where('id', $id)->get($this->tables['files'])->row();
            $config = $this->config->item('image');
            switch ($file->file_type) {
                case 'image':
                    $path = site_url($config['upload_path']) . "/" . $file->unique_name;
                    $content = '<div class="col-6">
                                        <label>' . $file->file_name . '</label>
                                        <img src="' . $path . '" class="w-100">
                                    </div>';
                    break;
                case 'site':
                    $content = '<div class="col-12">
                                        <label>Site Url</label>
                                        <input class="form-control" value="' . $file->unique_name . '" readonly>
                                    </div>';
                    break;
                case 'video':
                    $content = '<div class="col-6">
                                        <label>Video Url</label>
                                        <input class="form-control" value="' . $file->unique_name . '" readonly>
                                </div>';
                    break;
                default:
                    $content = 'This type data not availble.';
                    break;
            }
        } else {
            $rs = $this->db->select('rs.description')->where('file_id', $id)->get($this->tables['resource'] . ' rs')->row();
            $content = !empty($rs) ?
                '<div class="">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" readonly>' . $rs->description . '</textarea>
                </div>' : '';
        }

        return $content;
    }

    public function get_file($id)
    {
        $file = array();
        if (!empty($id)) {
            $file = $this->db->select('*')
                ->where('id', $id)
                ->get($this->tables['files'])
                ->row();
        }
        return $file;
    }
}
