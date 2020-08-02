<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public $tables = array();
    function __construct()
    {
        $this->tables = array('resource' => 'resources', 'document' => 'documents', 'contents' => 'contents', 'classification' => 'classification', 'user' => 'user', 'files' => 'files', 'chat' => 'chat');
        $this->load->model('database_model', 'database');
    }

    function add_profile($params)
    {
        extract($params);
        $logo_id = isset($logo_id) ? $logo_id : null;;

        if (!isset($user_id) || empty($user_id)) {
            return;
        }

        if (isset($file['logo']) && !empty($file['logo']['name'])) {
            $logo_id = $this->database->do_upload(array('file' => $file['logo'], 'file_name' => 'logo', 'file_id' => $logo_id));
            $logo_id = is_numeric($logo_id) ? $logo_id : null;
        }

        $data = array(
            'name' => encrypt($name),
            'user_id' =>  encrypt($user_id),
            'file_id' => $logo_id,
        );

        
        if($is_change_pass) {

            $profile = $this->db->select('us.password')->where('us.id', $id)->get($this->tables['user'] . ' us')->row();

            $data['password']=encrypt($password,true);

            if(!check_password($profile->password, $crpassword)){
                return FALSE;
            }
        }


        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        if (isset($id) && !empty($id)) {
            $data['updated'] = date('Y-m-d h:i:sa');
            $this->db->where('id', $id)
            ->update($this->tables['user'], $data);
        } else {
            $data['created'] = date('Y-m-d h:i:sa');
            $this->db->insert($this->tables['user'], $data);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            die;
            return FALSE;
        }
        return TRUE;
    }

    function get_user($id)
    {
        $profle = $this->db->select('us.name,us.user_id,us.file_id as logo_id')
        ->where('id', $id)
        ->get($this->tables['user'] . ' us')
        ->row();
        // var_dump(check_password($profle->password, '121'));
        $profle->name = decrypt($profle->name);
        $profle->user_id = decrypt($profle->user_id);
        return $profle;
    }

    function login($user_id, $pass, $is_not_login = true)
    {
        $profile = $this->db->select('us.id,us.user_id,us.name,us.password,fs.unique_name')
        ->join($this->tables['files'] . ' fs', 'us.file_id = fs.id', 'left')
        ->get($this->tables['user'] . ' us')->result_array();

        $user_data = array();

        if (!empty($profile)) {
            foreach ($profile as $key => $pr) {
                if (trim($user_id) == decrypt(trim($pr['user_id'])) &&  (check_password($pr['password'], $pass) || !$is_not_login) ) {
                    $user_data = array(
                        'name'  => decrypt(trim($pr['name'])),
                        'id' => $pr['id'],
                        'user_id' => decrypt(trim($pr['user_id'])),
                        'unique_name' => $pr['unique_name'],
                        'logged_in' => TRUE
                    );
                }
            }
        }
        return $user_data;
    }

    function get_email()
    {
        $email = $this->db->select('cht.id, cht.first_name, cht.last_name,cht.is_read, cht.contact, cht.created')
        ->order_by('cht.id', 'desc')
        ->get($this->tables['chat'] . ' cht');
        return $email;
    }

    function show_email($id)
    {
        $email = $this->db->select('cht.id, cht.first_name, cht.last_name, cht.contact, cht.comment')
        ->where('id', $id)
        ->get($this->tables['chat'] . ' cht')
        ->row();
        $html = '';

        if (!empty($email)) {
            $this->db->where('id', $id)
            ->update($this->tables['chat'], array('is_read' => 1));

            $html = render_email_modal($email);
        }
        return $html;
    }

    function delete_email($id)
    {
        $rs = $this->db->where('id', $id)
        ->delete($this->tables['chat']);

        return $rs > 0 ? 'success' : 'error';
    }

}
