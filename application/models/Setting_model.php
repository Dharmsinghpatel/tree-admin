<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model
{
    public $tables = array();
    function __construct()
    {
        $this->tables = array('resource' => 'resources', 'document' => 'documents', 'contents' => 'contents', 'classification' => 'classification', 'user' => 'user', 'files' => 'files', 'email' => 'email', 'setting' => 'setting','resource'=>'resources', 'carousel'=>'carousel','user'=>'user');
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

     function clean_waste_files()
    {
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        $files = $this->db->select('fs.id')
            ->get($this->tables['files'] . ' fs')->result_array();

        $rs_used_files = $this->db->select('rs.file_id, rs.file_id_2')
            ->get($this->tables['resource'] . ' rs')->result_array();  

        $cr_used_files = $this->db->select('cr.file_id')
            ->get($this->tables['carousel'] . ' cr')->result_array();

        $us_used_files = $this->db->select('us.file_id')
            ->get($this->tables['user'] . ' us')->result_array();

        $total_f = array_column($files, 'id');
        $uses_f= array_column($rs_used_files, 'file_id');
        $uses_f2= array_column($rs_used_files, 'file_id_2');
        $uses_f3= array_column($cr_used_files, 'file_id');
        $uses_f4= array_column($us_used_files, 'file_id');
    
        $waste_files=array_diff($total_f, $uses_f, $uses_f2, $uses_f3, $uses_f4);
 
       foreach ($waste_files as $key => $file) {
           $this->database->unlink_file($file);
       }

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 'error';
        }

        // if($waste_files>0)
        return array('status' => 'success','msg'=>'Total '.count($waste_files).' files cleaned!', 'data'=>[]);
        // }
    }
}
