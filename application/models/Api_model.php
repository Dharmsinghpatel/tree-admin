<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model
{
    public $tables = array();

    private $dashboard_random;
    private $comment_allow;
    private $carousel_random;
    private $carousel_limit;
    private $carousel_event;

    function __construct()
    {
        $this->tables = array('resource' => 'resources', 'carousel' => 'carousel', 'file' => 'files', 'document' => 'documents', 'content' => 'contents', 'classification' => 'classification', 'analytic' => 'analytic', 'email' => 'email', 'setting' => 'setting');
        $this->load->model('database_model', 'database');
        $this->load->model('resources_model', 'resource');

        $setting = $this->db->select('*')->get($this->tables['setting'])->row();

        $this->dashboard_random = $setting->dashboard_random ? 'RANDOM' : 'asc';
        $this->comment_allow = $setting->comment_allow;
        $this->carousel_random = $setting->carousel_random ? 'RANDOM' : 'asc';
        $this->carousel_limit = $setting->carousel_limit;
        $this->carousel_event = $setting->carousel_event;

        if (empty($setting->api_on)) {
            die;
        }
    }

    function get_dashboard()
    {
        $dashboard = array();
        $today = date('Y-m-d');
        $config = $this->config->item('image');
        $carousel = $this->db->select('ca.title, ca.link , ca.description, fs.unique_name as image_url, fs.file_name')
            ->join($this->tables['file'] . ' fs', 'fs.id = ca.file_id', 'left')
            ->where(array('start_date <=' => $today, 'end_date >=' => $today))
            ->limit($this->carousel_limit)
            ->order_by('ca.position', $this->carousel_random)
            ->get($this->tables['carousel'] . ' ca')->result_array();

        if (!empty($carousel)) {
            foreach ($carousel as $key => $value) {
                $carousel[$key]['image_url'] = site_url($config['upload_path']) . $value['image_url'];
                $carousel[$key]['link'] = !empty($this->carousel_event) ? custom_secure_data($value['link']) : '';
            }
        }

        $resources = $this->db->select('rs.id, rs.title, rs.file_id as link, rs.file_id_2 as image_url, rs.description')
            ->order_by('position', $this->dashboard_random)
            ->where('resource_type', 'video')
            ->limit(4)
            ->get($this->tables['resource'] . ' rs')->result_array();

        if (!empty($resources)) {
            foreach ($resources as $key => $resource) {
                $file = $this->database->get_file($resource['link']);
                $file_2 = $this->database->get_file($resource['image_url']);

                $resources[$key]['image_url'] = site_url($config['upload_path']) . $file_2->unique_name;
                $resources[$key]['link'] = $file->unique_name;
                $resources[$key]['id'] = custom_secure_data($resources[$key]['id']);
            }
        }

        $documents = $this->db->select('dc.id, dc.title,dc.display_type, fs.unique_name as image_url, fs.file_name')
            ->join($this->tables['file'] . ' fs', 'fs.id = dc.icon', 'left')
            ->order_by('position', $this->dashboard_random)
            ->where('dc.is_topic', null)
            ->get($this->tables['document'] . ' dc')->result_array();

        $news = array();
        $blogs = array();
        $info = array();
        $info_count = 0;
        foreach ($documents as $key => $document) {

            $content = $this->db->select('ct.description')
                ->where(array('ct.content_type' => 'description', 'ct.document_id' => $document['id']))
                ->get($this->tables['content'] . ' ct')->result_array();

            $document['description'] = !empty($content) ? $content[0]['description'] : '';
            $document['image_url'] = site_url($config['upload_path']) . $document['image_url'];

            $document['title'] = cut_text($document['title'], 30);
            $document['id'] = custom_secure_data($document['id']);

            switch ($document['display_type']) {
                case 'info':
                    $info_count += 1;
                    $limit = $info_count <= 5 ? 250 : 50;
                    $document['description'] = cut_text($document['description'], $limit);
                    $info[] = $document;
                    break;
                case 'news':
                    $document['description'] = cut_text($document['description']);
                    $news[] = $document;
                    break;
                case 'blog':
                    $document['description'] = cut_text($document['description']);
                    $blogs[] = $document;
                    break;
            }
        }

        $dashboard = array(
            'carousel' => $carousel,
            'info' => array_slice($info, 0, 5),
            'infos' => array_slice($info, 5, 4),
            'blogs' => array_slice($blogs, 0, 4),
            'news' => array_slice($news, 0, 4),
            'resources' => $resources,
        );

        //analytic
        $data = array(
            'product_type' => 'none',
            'display_type' => 'dashboard',
            'created' => date('Y-m-d')
        );
        $this->analytic_manager($data);

        return $dashboard;
    }

    function topic_detail($id)
    {
        $document = array();
        $id = custom_secure_data($id, false);


        $document = $this->db->select('dc.title, dc.display_type as content_type, dc.icon, cl.product_type as cl_type, cl.product_name, cl.product_use')
            ->join('classification cl', 'cl.document_id = dc.id', 'left')
            ->where('dc.id', $id)
            ->get($this->tables['document'] . ' dc')->result_array();

        if (!empty($document)) {
            $document = $document[0];

            if (!empty($document['cl_type'])) {
                $data_analytic = array(
                    'product_type' => $document['cl_type'],
                    'display_type' => $document['content_type'],
                    'created' => date('Y-m-d')
                );

                $this->analytic_manager($data_analytic);
            }

            $config = $this->config->item('image');
            $file = $this->database->get_file($document['icon']);
            $document['icon'] = site_url($config['upload_path']) . "/" . $file->unique_name;

            $contents = $this->db->select('ct.description, ct.resource_id, ct.topic_id, ct.content_type')
                ->order_by('position', 'asc')
                ->where('document_id', $id)
                ->get($this->tables['content'] . ' ct')->result_array();

            $document['detail'] = array();
            if (isset($contents) && !empty($contents)) {
                foreach ($contents as $key => $content) {
                    $temp = array();
                    switch ($content['content_type']) {
                        case 'description':
                            $temp['type'] = $content['content_type'];
                            $temp['description'] = $content['description'];
                            break;
                        case 'file':
                            $resource_detail = $this->resource->get_resource($content['resource_id']);
                            $temp = $this->resource_manager($resource_detail);
                            break;
                        case 'topic':
                            $temp['type'] = $content['content_type'];
                            $temp['sub_topics'] = $this->topic_detail($content['topic_id']);
                            break;
                        case 'document':
                            $temp['type'] = $content['content_type'];
                            $temp['document_id'] = custom_secure_data($content['topic_id']);
                            $temp['title'] = $content['description'];
                            $temp['display_type'] = 'info';
                            break;
                    }
                    array_push($document['detail'], $temp);
                }
            }
        }

        return $document;
    }

    public function resource_manager($resource)
    {
        $file_detail = array();
        $config = $this->config->item('image');
        $file_detail['type'] = $resource->resource_type;
        $file_detail['title'] = $resource->title;

        $file = $this->database->get_file($resource->file_id);
        switch ($resource->resource_type) {
            case 'image':
                $file_detail['image_url'] = site_url($config['upload_path']) . "/" . $file->unique_name;
                break;
            case 'video':
                $file_detail['video_url'] =  $file->unique_name;
                $file_2 = $this->database->get_file($resource->file_id_2);
                $file_detail['image_url'] = site_url($config['upload_path']) . "/" . $file_2->unique_name;
                break;
            case 'site':
                $file_detail['image_url'] = $file->unique_name;
                break;
        }
        return $file_detail;
    }

    public function get_topics($topics_type = "info")
    {
        $documents = $this->db->select('dc.id, dc.display_type, dc.title, fs.unique_name as image_url, fs.file_name')
            ->join($this->tables['file'] . ' fs', 'fs.id = dc.icon', 'left')
            ->order_by('position', 'asc')
            ->where(array('dc.is_topic' => null, 'dc.display_type' => $topics_type))
            ->get($this->tables['document'] . ' dc')->result_array();

        $topics = array();
        $config = $this->config->item('image');

        foreach ($documents as $key => $document) {

            $content = $this->db->select('ct.description')
                ->where(array('ct.content_type' => 'description', 'ct.document_id' => $document['id']))
                ->get($this->tables['content'] . ' ct')->result_array();

            $document['description'] = !empty($content) ? $content[0]['description'] : '';
            $document['image_url'] = site_url($config['upload_path']) . $document['image_url'];

            $document['title'] = cut_text($document['title'], 30);

            $document['description'] = cut_text($document['description']);
            $document['id'] = custom_secure_data($document['id']);
            $topics[] = $document;
        }
        return $topics;
    }

    public function get_videoes($id = null)
    {

        $where = !empty($id) ? array('rs.resource_type' => 'video', 'rs.id' => $id) : array('rs.resource_type' => 'video');

        $resources = $this->db->select('rs.id, rs.title, rs.file_id as link, rs.file_id_2 as image_url, rs.description')
            ->order_by('position', 'asc')
            ->where($where)
            ->get($this->tables['resource'] . ' rs')->result_array();
        $config = $this->config->item('image');

        if (!empty($resources)) {
            foreach ($resources as $key => $resource) {
                $file = $this->database->get_file($resource['link']);
                $file_2 = $this->database->get_file($resource['image_url']);

                $resources[$key]['image_url'] = site_url($config['upload_path']) . $file_2->unique_name;
                $resources[$key]['link'] = $file->unique_name;
                $resources[$key]['id'] = custom_secure_data($resources[$key]['id']);
            }
        }
        return $resources;
    }

    public function search_product($params = array())
    {
        extract($params);
        $where = $product_type == 'all' ?
            array('dc.is_topic' => null, 'dc.display_type' => $display_type) :
            array('dc.is_topic' => null, 'dc.display_type' => $display_type, 'cl.product_type' => $product_type);
        $documents = $this->db->select('dc.id, dc.display_type, dc.title, fs.unique_name as image_url, fs.file_name')
            ->join($this->tables['classification'] . ' cl', 'cl.document_id = dc.id', 'left')
            ->join($this->tables['file'] . ' fs', 'fs.id = dc.icon', 'left')
            ->order_by('dc.position', 'asc')
            ->where($where)
            ->group_start()
            ->or_like(array('dc.title' => $product_name, 'cl.product_name' => $product_name, 'cl.product_use' => $product_name))
            ->group_end()
            ->get($this->tables['document'] . ' dc')->result_array();


        $topics = array();
        $config = $this->config->item('image');

        foreach ($documents as $key => $document) {

            $content = $this->db->select('ct.description')
                ->where(array('ct.content_type' => 'description', 'ct.document_id' => $document['id']))
                ->get($this->tables['content'] . ' ct')->result_array();

            $document['description'] = !empty($content) ? $content[0]['description'] : '';
            $document['image_url'] = site_url($config['upload_path']) . $document['image_url'];

            $document['title'] = cut_text($document['title'], 30);

            $document['description'] = cut_text($document['description']);
            $topics[] = $document;
        }
        return $topics;
    }

    public function search_videoes($params = array())
    {
        extract($params);
        //work remain add classification
        $where = $product_type == 'all' ?
            array('rs.resource_type' => 'video') :
            array('rs.resource_type' => 'video', 'cl.product_type' => $product_type);

        $resources = $this->db->select('rs.id, rs.title, rs.file_id as link, rs.file_id_2 as image_url, rs.description')
            ->join($this->tables['classification'] . ' cl', 'cl.resource_id = rs.id', 'left')
            ->order_by('rs.position', 'asc')
            ->where($where)
            ->group_start()
            ->or_like(array('rs.title' => $product_name, 'cl.product_name' => $product_name))
            ->group_end()
            ->get($this->tables['resource'] . ' rs')->result_array();
        $config = $this->config->item('image');

        if (!empty($resources)) {
            foreach ($resources as $key => $resource) {
                $file = $this->database->get_file($resource['link']);
                $file_2 = $this->database->get_file($resource['image_url']);

                $resources[$key]['image_url'] = site_url($config['upload_path']) . $file_2->unique_name;
                $resources[$key]['link'] = $file->unique_name;
            }
        }
        return $resources;
    }

    public function analytic($params)
    {
        extract($params);
        $where = isset($video_id) ? array('fs.unique_name' => $video_id) : null;

        if (!empty($where)) {
            $resource = $this->db->select('fs.file_type as display_type ,cl.product_type')
                ->join($this->tables['resource'] . ' rs', 'fs.id = rs.file_id')
                ->join($this->tables['classification'] . ' cl', 'cl.resource_id = rs.id')
                ->where($where)
                ->get($this->tables['file'] . ' fs')->row();

            $data = array(
                'product_type' => $resource->product_type,
                'display_type' => $resource->display_type,
                'created' => date('Y-m-d')
            );
            return $this->analytic_manager($data);
        }
        return false;
    }

    public function analytic_manager($data)
    {

        $row = $this->db->select('id,views_count')
            ->where($data)->get($this->tables['analytic'])->row();

        if (!empty($row) && $row->id) {
            $data['views_count'] = $row->views_count + 1;
            $this->db->where('id', $row->id)->update($this->tables['analytic'], $data);
        } else {
            $data['views_count'] = 1;
            $this->db->insert($this->tables['analytic'], $data);
        }
        return true;
    }

    function message_save($params)
    {
        extract($params);
        if (empty($this->comment_allow)) {
            return 'error';
        }
        $data = convet_secure_input($params, true);
        $data['created'] = date('y-m-d h:i:sa');
        $this->db->insert($this->tables['email'], $data);
        return $this->db->insert_id() > 0 ? 'success' : 'error';
    }
}
