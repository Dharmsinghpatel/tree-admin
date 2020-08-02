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
        $this->tables = array('resource' => 'resources', 'carousel' => 'carousel', 'file' => 'files', 'document' => 'documents', 'content' => 'contents', 'classification' => 'classification', 'analytic' => 'analytic', 'chat' => 'chat', 'setting' => 'setting', 'metadata' => 'metadata');
        $this->load->model('database_model', 'database');
        $this->load->model('resources_model', 'resource');
        $this->load->model('documents_model', 'document');  

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

    function get_dashboard($height = 1950, $width = 1250)
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
                $carousel[$key]['link'] = !empty($this->carousel_event) ?
                    // custom_secure_data($value['link']) 
                trim($value['link'])
                : '';
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

        $documents = $this->db->select('dc.id,dc.slug, dc.title,dc.display_type, fs.unique_name as image_url,publish_time, fs.file_name')
        ->join($this->tables['file'] . ' fs', 'fs.id = dc.icon', 'left')
        ->order_by('position', $this->dashboard_random)
        ->where('dc.is_active>"0"')
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
            $document['image_url'] = $document['image_url']?site_url($config['upload_path']) . $document['image_url']:$document['image_url'];

            $document['title'] = cut_text($document['title'], 10);
            $document['publish_time'] = $document['publish_time'] && $document['publish_time']!= '0000-00-00'?$document['publish_time']:null;

            $document['id'] = trim($document['slug']);

            switch ($document['display_type']) {
                case 'info':
                $info_count += 1;
                $limit = $info_count <= 5 ? ($width > 557 ? 250 : 20) : ($width > 557 ? 20 : 20);
                $document['description'] = cut_text($document['description'], $limit);
                $info[] = $document;
                break;
                case 'news':
                $limit = $document['image_url']?20:50 ;
                $document['description'] = cut_text($document['description'], $limit);
                $news[] = $document;
                break;
                case 'blog':
                $limit = $width > 557 ? 20 : 20;
                $document['description'] = cut_text($document['description'], $limit);
                $blogs[] = $document;
                break;
            }
        }

        $meta_data = array( 
            array('name' => 'description', 'content' => 'Agri Arbor कृषि संबंधित विभिन्न जानकारियों के लिए समर्पित है। Agri Arbor में वीडियो, ब्लॉग, न्यूज़ की सीरीज़ हैं जो कृषि में एक बेहतरीन रास्ता निकालने का सुझाव देते हैं।'),   
            array('name' => 'keywords', 'content' => 'agriarbor, home, agri arbor home, agriarbor home')    
        );  


        $dashboard = array(
            'carousel' => $carousel,
            'info' => array_slice($info, 0, 5),
            'infos' => array_slice($info, 5, 4),
            'blogs' => array_slice($blogs, 0, 4),
            'news' => array_slice($news, 0, 4),
            'meta' => $meta_data,
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
        // $id = custom_secure_data($id, false);
        $id = trim($id);

        $document = $this->db->select('dc.title, dc.display_type as content_type,dc.publish_time, cl.product_type as cl_type, cl.product_name, cl.product_use')
        ->join('classification cl', 'cl.document_id = dc.id', 'left')
        ->where(array('dc.slug'=> $id,'dc.is_active>'=>0))
        ->get($this->tables['document'] . ' dc')->result_array();

        if (!empty($document)) {
            $document = $document[0];
            // $meta_keywords = implode(', ', array_values($document));

            if (!empty($document['cl_type'])) {
                $data_analytic = array(
                    'product_type' => $document['cl_type'],
                    'display_type' => $document['content_type'],
                    'created' => date('Y-m-d')
                );

                $this->analytic_manager($data_analytic);
            }

            // if(!empty($document['icon'])){
            //     $config = $this->config->item('image');
            //     $file = $this->database->get_file($document['icon']);
            //     $document['icon'] = site_url($config['upload_path']) . "/" . $file->unique_name;

            //     $document['icon']=null;
            // }


            $document['publish_time'] = $document['publish_time'] && $document['publish_time']!= '0000-00-00'?$document['publish_time']:null;
            $document['title'] = cut_text($document['title'], 30);

            $contents = $this->db->select('ct.description, ct.resource_id, ct.topic_id, ct.content_type,dc.slug')
            ->order_by('ct.position', 'asc')
            ->join($this->tables['document'] . ' dc', 'dc.id = ct.document_id', 'left')
            ->where('dc.slug', $id)
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
                            // case 'topic':
                            //     $temp['type'] = $content['content_type'];
                            //     $temp['sub_topics'] = $this->topic_detail($content['topic_id']);
                            //     break;
                        case 'document':
                        $temp['type'] = $content['content_type'];

                        $temp['document_id'] = $this->document->get_document_detail($content['topic_id'])[0]['slug'];

                        // $temp['document_id'] = $content['slug'];
                        $temp['title'] = $content['description'];
                        $temp['display_type'] = 'info';
                        break;
                    }
                    array_push($document['detail'], $temp);
                }
            }
        }

        /* To convert continue images in row*/
        $temp_images=[];
        $rows=[];
        
        foreach ($document['detail'] as $key => $row) {
            if($row['type']!='image'){
                 if(count($temp_images)){
                  array_push($rows, array('type'=>'image','images'=>$temp_images));
                }
                array_push($rows, $row);
                $temp_images=[];
            }else{
                array_push($temp_images, $row);
            }

        }

        if(count($temp_images)){
             array_push($rows, array('type'=>'image','images'=>$temp_images));
        }

        $document['detail'] = $rows;

        $metadata_row = $this->db->select('mt.description, mt.keywords')
        ->where(array('mt.slug' => $id))
        ->get($this->tables['metadata'] . ' mt')->row();


        $meta_data = array(
            array('name' => 'keywords', 'content' => isset($metadata_row->keywords) ? $metadata_row->keywords : ''),
            array('name' => 'description', 'content' => isset($metadata_row->description) ? $metadata_row->description : '')
        );

        $document['meta'] = $meta_data;
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
        $documents = $this->db->select('dc.id, dc.display_type, dc.title,
            publish_time, fs.unique_name as image_url, fs.file_name, dc.slug')
        ->join($this->tables['file'] . ' fs', 'fs.id = dc.icon', 'left')
        ->order_by('id', 'desc')
        ->where(array('dc.is_topic' => null, 'dc.display_type' => $topics_type,'dc.is_active>'=>0))
        ->get($this->tables['document'] . ' dc')->result_array();

        $topics = array();
        $config = $this->config->item('image');

        foreach ($documents as $key => $document) {

            $content = $this->db->select('ct.description')
            ->where(array('ct.content_type' => 'description', 'ct.document_id' => $document['id']))
            ->get($this->tables['content'] . ' ct')->result_array();

            $document['description'] = !empty($content) ? $content[0]['description'] : '';
            $document['image_url'] = !empty($document['image_url'])?site_url($config['upload_path']) . $document['image_url']:'';

            $document['publish_time'] = $document['publish_time'] && $document['publish_time']!= '0000-00-00'?$document['publish_time']:null;
            $document['title'] = cut_text($document['title'], 30);

            $document['description'] = cut_text($document['description'],!$document['image_url']?50:20);


            $document['id'] = trim($document['slug']);
            $topics[] = $document;
        }

        $metaDesc ='Agri Arbor\'s ' . $topics_type . ' फसल, पशु, पौधे, खाद, कीटनाशक आदि का बुनियादी ज्ञान प्रदान करती है।';

        switch ($topics_type) {
            case 'blog':
               $metaDesc ='Agri Arbor\'s blog कृषि उत्पादों जैसे फसल, पशु, पौधे, खाद, कीटनाशक आदि देखभाल की प्रक्रिया, उत्पादों को बनाने और ये कैसे काम करता है, इसके बारे में बताता है।';
                break;
               case 'news':
                $metaDesc = 'Agri Arbor\'s news शासन की योजनाओं, कृषि संबंधी समाचारों के साथ आता है, जो बुनियादी ज्ञान प्रदान करता है।';
        }

        $meta_data = array(
            array('name' => 'description', 'content' => $metaDesc ),
            array('name' => 'keywords', 'content' => 'agriarbor, ' . $topics_type . ', agri arbor ' . $topics_type . ', agriarbor ' . $topics_type . '')
        );

        return array('topics' => $topics, 'meta' => $meta_data);
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

        $route = 'videos';

        $meta_data = array(
            array('name' => 'description', 'content' => 'Agri Arbor\'s videos कृषि उत्पादों जैसे फसल, पशु, पौधे, खाद, कीटनाशक आदि देखभाल की प्रक्रिया, उत्पादों को बनाने और ये कैसे काम करता है, इसके बारे में बताता है।'),
            array('name' => 'keywords', 'content' => 'agriarbor, ' . $route . ', agri arbor ' . $route . ', agriarbor ' . $route . '')
        );

        return array('videos' => $resources, 'meta' => $meta_data);;
    }

    public function search_product($params = array())
    {
        extract($params);
        $where = $product_type == 'all' ?
        array('dc.is_topic' => null, 'dc.display_type' => $display_type, 'dc.is_active>'=>0) :
        array('dc.is_topic' => null, 'dc.display_type' => $display_type, 'cl.product_type' => $product_type, 'dc.is_active>'=>0);
        $documents = $this->db->select('dc.id, dc.display_type, dc.title, fs.unique_name as image_url, fs.file_name')
        ->join($this->tables['classification'] . ' cl', 'cl.document_id = dc.id', 'left')
        ->join($this->tables['file'] . ' fs', 'fs.id = dc.icon', 'left')
        ->order_by('dc.id', 'desc')
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
        $this->db->insert($this->tables['chat'], $data);
        return $this->db->insert_id() > 0 ? 'success' : 'error';
    }
}
