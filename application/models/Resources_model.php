<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Resources_model extends CI_Model
{
    public $tables = array();
    function __construct()
    {
        $this->tables = array('resource' => 'resources', 'classification' => 'classification', 'analytic' => 'analytic','content'=>'contents', 'document'=>'documents');
        $this->load->model('database_model', 'database');
    }

    function get_resources()
    {
        $resources = $this->db->select('rs.id,rs.title,rs.resource_type, rs.created, rs.updated')
            ->order_by('position')
            ->get($this->tables['resource'] . ' rs');
        return $resources;
    }

    function add_resources($params)
    {
        extract($params);
        $file_id = null;
        $resource_id = isset($resource_id) ? $resource_id : null;
        $url = isset($url) ? $url : (isset($video_id) ? $video_id : null);
        $file_id = isset($hidden_file) ? $hidden_file : null;
        $file_id_2 = isset($hidden_file_2) ? $hidden_file_2 : null;


        if (!isset($resource_type) || empty($resource_type)) {
            return;
        }

        if (isset($file['image']) && !empty($file['image']['name']) && $resource_type == 'image') {
            $file_id = $this->database->do_upload(array('file' => $file['image'], 'file_name' => 'image'));
            !is_numeric($file_id)?d($file_id):'';

        } else if ($resource_type != 'image') {
            $file_id = $this->database->do_upload(array('file' => $url, 'file_name' => $title, 'file_type' => $resource_type, 'is_file' => false));
            !is_numeric($file_id)?d($file_id):'';
        }

        if (isset($file['video_thumbnail']) && !empty($file['video_thumbnail']['name']) && $resource_type == 'video') {
            $file_id_2 = $this->database->do_upload(array('file' => $file['video_thumbnail'], 'file_name' => 'video_thumbnail'));
            !is_numeric($file_id_2)?d($file_id_2):'';
        }

        $data = array(
            'title' => $title,
            'resource_type' => $resource_type,
            'file_id' => $file_id,
            'file_id_2' => !empty($file_id_2) ? $file_id_2 : NULL,
            'description' => $description
        );

        $data_class = array(
            'product_type' => $product_type,
            'product_name' => $product_name,
            'product_use' => $product_use,
            'resource_id' => $resource_id
        );

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

        if (isset($resource_id) && !empty($resource_id)) {
            $data['updated'] = date('Y-m-d h:i:sa');
            $this->db->where('id', $resource_id)
                ->update($this->tables['resource'], $data);

            $this->db->where('resource_id', $resource_id)
                ->update($this->tables['classification'], $data_class);
        } else {
            $data['created'] = date('Y-m-d h:i:sa');
            $pos = $this->db->select_max('position')
                ->get($this->tables['resource'])->row();

            $data['position'] = $pos ? $pos->position + 1 : 1;;
            $this->db->insert($this->tables['resource'], $data);

            $data_class['resource_id'] = $this->db->insert_id();

            $this->db->insert($this->tables['classification'], $data_class);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            // $this->db->trans_rollback();
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

            switch ($rs->resource_type) {
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
            $resource = $this->db->select('rs.id, rs.title, rs.resource_type, rs.file_id, rs.file_id_2, rs.description, rs.created,cl.product_type, cl.product_name, cl.product_use')
                ->join($this->tables['classification'] . ' cl', 'rs.id = cl.resource_id', 'left')
                ->where('rs.id', $id)->get($this->tables['resource'] . ' rs')->row();
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
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        $rs_d=$resource_detail  = $this->db->select('rs.file_id, rs.file_id_2')
            ->where(array('rs.id' => $id))
            ->get($this->tables['resource'] . ' rs')->row();

        $file_exist_in_docs = $this->db->select('dc.title, dc.display_type')
            ->join($this->tables['content'] . ' ct', 'ct.document_id = dc.id', 'left')
            ->or_where(array('dc.icon'=> $rs_d->file_id, 'ct.resource_id'=>$id))
            ->distinct()
            ->get($this->tables['document'] . ' dc')->result_array();

        if(!empty($file_exist_in_docs)){
            return array( 'status'=>'error','data'=>$file_exist_in_docs) ;
            die;
        }
      

        $this->db->where('resource_id', $id)
            ->delete($this->tables['classification']);

        $this->database->unlink_file($resource_detail->file_id);
        $this->database->unlink_file($resource_detail->file_id_2);

        $res = $this->db->where('id', $id)
            ->delete($this->tables['resource']);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 'error';
        }

        $status= $res ? 'success' : 'error';

        return array('status' => $status, 'data'=>[]);
    }

    function get_resource_content($type)
    {
        $resources = $this->db->select('rs.id,rs.file_id,rs.file_id_2,rs.title,rs.resource_type ')
            ->order_by('position')
            ->where('resource_type', $type)
            ->get($this->tables['resource'] . ' rs')
            ->result_array();
        return array('status' => 'success', 'resources' => $resources);
    }

    function chart()
    {
        $products = array('animal', 'crop', 'fertilizer', 'pesticides', 'plant', 'none');
        $displays = array('info', 'news', 'blog', 'video', 'dashboard');
        $chart_data = array();

        $pariod = 365;

        $analytic = $this->db->select('created')
            ->limit(1)
            ->get($this->tables['analytic'])
            ->row();

        foreach ($products as $product) {
            foreach ($displays as $display) {
                $cod1 = isset($display) && !empty($display) ?
                    array('product_type' => $product, 'display_type' => $display) : array('product_type' => $product);

                $chart = $this->db->select('*')
                    ->where($cod1)
                    ->get($this->tables['analytic'] . ' an')
                    ->result_array();

                $j = 0;
                for ($i = 0; $i <= $pariod; $i++) {
                    $date = new DateTime('2020-05-13');
                    $date->modify('+' . $i . ' day');
                    $is_date = $date->format('Y-m-d');

                    if ($is_date <= date('Y-m-d')) {
                        if (!empty($chart) && isset($chart[$j]) && $chart[$j]['created'] == $is_date) {
                            $chart_data[$display][$product][] = array('x' => $i, 'y' => $chart[$j]['views_count']);

                            $j += 1;
                        } else {
                            $chart_data[$display][$product][] = array('x' => $i, 'y' => 0);
                        }
                    }
                }
            }
        }

        $overall_analytic = array();
        foreach ($chart_data as $dkey => $data) {
            foreach ($data as $pkey => $product) {
                foreach ($product as $vkey => $value) {
                    $overall_analytic[$pkey][$vkey]['y'] = isset($overall_analytic[$pkey][$vkey]['y']) ? $overall_analytic[$pkey][$vkey]['y'] : 0;

                    $overall_analytic[$pkey][$vkey]['x'] = $vkey;
                    $overall_analytic[$pkey][$vkey]['y'] = $overall_analytic[$pkey][$vkey]['y'] + $value['y'];
                }
            }
        }



        $chart = $this->db->select('*')
            ->where(array('product_type' => 'none', 'display_type' => 'dashboard'))
            ->get($this->tables['analytic'] . ' an')
            ->result_array();

        $chart_data['overall'] = $overall_analytic;

        return $chart_data;
    }

    function show_resource($id)
    {
        $resource = $this->get_resource($id);
        $html = '';

        if (!empty($resource)) {
            $rs = $resource;
            $html = '';
            $file = $this->database->get_file($rs->file_id);

            switch ($rs->resource_type) {
                case 'image':
                    $html = render_image_popup($file);
                    break;
                case  'site':
                    $html = render_link($file);
                    break;
                case 'video':
                    $file_2 = $this->database->get_file($rs->file_id_2);
                    $html = render_video_popup($file, $file_2);
                    break;
                default:
                    $html = 'Error';
            }
        }

        return  $html;
    }
}
