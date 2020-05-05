<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Documents_model extends CI_Model
{
    public $tables = array();
    function __construct()
    {
        $this->tables = array('resource' => 'resources', 'document' => 'documents', 'contents' => 'contents', 'classification' => 'classification');
        $this->load->model('database_model', 'database');
    }

    function get_documents($content_type)
    {
        $resources = $this->db->select('dc.id,dc.title,dc.is_topic,dc.created,dc.updated')
            ->order_by('position', 'asc')
            ->where(array('is_topic' => null, 'type' => $content_type))
            ->get($this->tables['document'] . ' dc');

        $document_list = array();
        if (!empty($resources->result_array())) {
            foreach ($resources->result_array() as $key => $resource) {
                $topics_id = $this->db->select('ct.topic_id')
                    ->order_by('ct.position', 'asc')
                    ->where(array('ct.document_id' => $resource['id'], 'ct.topic_id !=' => null))
                    ->get($this->tables['contents'] . ' ct')
                    ->result_array();

                $document_list[] = $resource;

                foreach ($topics_id as $key => $topic) {
                    $topic = $this->db->select('dc.id,dc.title,dc.is_topic,dc.created,dc.updated')
                        ->where('dc.id', $topic['topic_id'])
                        ->get($this->tables['document'] . ' dc')
                        ->result_array();
                    if (!empty($topic)) {
                        $document_list[] = $topic[0];
                    }
                }
            }
        }
        // p($document_list);
        // die;
        return array($resources, $document_list);
    }

    function add_documents($params)
    {
        extract($params);
        $url = isset($url) ? $url : null;
        $icon_id = isset($icon_id) ? $icon_id : null;
        $document_id = isset($document_id) ? $document_id : null;
        $exist_topics = isset($exist_topics) ? $exist_topics : array();

        if (!isset($title) || empty($title)) {
            return;
        }

        if (isset($file['icon']) && !empty($file['icon']['name'])) {
            $icon_id = $this->database->do_upload($file['icon'], 'icon');
            $icon_id = is_numeric($icon_id) ? $icon_id : null;
        }

        $data = array(
            'title' => $title,
            'type' => $content_type,
            'icon' => $icon_id
        );

        $data_class = array(
            'type' => $type,
            'name' => $name,
            'use_in' => $use_in,
            'document_id' => $document_id
        );

        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        if (isset($document_id) && !empty($document_id)) {
            $data['updated'] = date('Y-m-d h:i:sa');
            $this->db->where('id', $document_id)
                ->update($this->tables['document'], $data);

            $this->db->where('document_id', $document_id)
                ->update($this->tables['classification'], $data_class);

            //delete description and files
            $this->db->where(array('document_id' => $document_id, 'type !=' => 'topic'))
                // $this->db->where('document_id = "' . $document_id . '" AND type != "topic" ')
                ->delete($this->tables['contents']);

            //delete document/topic
            $topics  = $this->db->select('ct.topic_id')
                ->where(array('document_id' => $document_id, 'type' => 'topic'))
                ->get($this->tables['contents'] . ' ct')->result_array();
            $topics_id = array_column($topics, 'topic_id');

            foreach ($topics_id as $key => $id) {
                if (!in_array($id, $exist_topics)) {
                    $this->delete_documents($id);
                }
            }
        } else {
            $pos = $this->db->select_max('position')
                ->get($this->tables['document'])->row();

            $data['position'] = $pos ? $pos->position + 1 : 1;
            $data['created'] = date('Y-m-d h:i:sa');

            $this->db->insert($this->tables['document'], $data);
            $document_id = $data_class['document_id'] = $this->db->insert_id();
            $this->db->insert($this->tables['classification'], $data_class);
        }
        $documents_row = array();
        $i = 0;
        $topic_index = 0;

        if (!empty($document_id) && !empty($documents)) {
            foreach ($documents as $key => $document) {
                $i += 1;
                if (!empty($document)) {
                    $temp = array(
                        'description' => NULL,
                        'resource_id' => NULL,
                        'document_id' => $document_id,
                        'topic_id' => NULL,
                        'position' => $i
                    );

                    if (array_key_exists('0', $document) && !empty($document[0][0])) {
                        $temp['resource_id'] = (int) $document[0][0];
                        $temp['type'] = 'file';
                        array_push($documents_row, $temp);
                    } else if (array_key_exists('1', $document) && !empty($document[1][0])) {
                        $topic_content = array(
                            'title' => $document[1][0], 'created' => date('Y-m-d h:i:sa'), 'is_topic' => 1
                        );

                        if (isset($exist_topics) && !empty($exist_topics[$topic_index])) {
                            $this->db->where('id', $exist_topics[$topic_index])
                                ->update($this->tables['document'], $topic_content);
                            $this->db->where('topic_id', $exist_topics[$topic_index])
                                ->update($this->tables['contents'], array('description' => $document[1][0], 'position' => $i));
                        } else {
                            $this->db->insert($this->tables['document'], $topic_content);
                            $temp['topic_id'] = $this->db->insert_id();
                            $temp['type'] = 'topic';
                            $temp['description'] = $document[1][0];
                            array_push($documents_row, $temp);
                        }

                        $topic_index += 1;
                    } else if ((array_key_exists('2', $document)) && !empty($document[2][0])) {
                        $temp['description'] = $document[2][0];
                        $temp['type'] = 'description';
                        array_push($documents_row, $temp);
                    }
                }
            }
            !empty($documents_row) ?
                $this->db->insert_batch($this->tables['contents'], $documents_row) :
                '';
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            die;
            return FALSE;
        }
        return TRUE;
    }

    function delete_documents($id = null, $is_topic = 1)
    {
        $flag = false;
        if (!empty($id)) {
            $topic_where = !empty($is_topic) ? array('topic_id' => $id) : array('document_id' => $id);

            $this->db->where($topic_where)
                ->delete($this->tables['contents']);

            $this->db->where('document_id', $id)
                ->delete($this->tables['classification']);

            $this->db->delete($this->tables['document'], array('id' => $id));
            $flag = true;
        }

        return $flag;
    }

    function get_detail($id)
    {
        $document = array();
        if (!empty($id)) {
            $document['general_detail'] = $this->db->select('dc.id, dc.title, dc.type as content_type, dc.icon, cl.type as cl_type, cl.name, cl.use_in')
                ->join('classification cl', 'cl.document_id = dc.id', 'left')
                ->where('dc.id', $id)
                ->get($this->tables['document'] . ' dc')->row();

            $resources = $this->db->select('ct.description, ct.resource_id, ct.topic_id, ct.type as resource_type')
                ->order_by('position', 'asc')
                ->where('document_id', $id)
                ->get($this->tables['contents'] . ' ct')->result_array();

            $document['resources'] = '';
            $desc_num = 1;
            if (isset($resources) && !empty($resources)) {
                foreach ($resources as $key => $resource) {
                    switch ($resource['resource_type']) {
                        case 'description':
                            $document['resources'] .= render_description($resource, $desc_num);
                            $desc_num += 1;
                            break;
                        case 'file':
                            $resource_detail = $this->resource->get_resource($resource['resource_id']);
                            $document['resources'] .= render_files($resource, $resource_detail);
                            break;
                        case 'topic':
                            $document['resources'] .= render_topic($resource);
                            break;
                        default:
                            $document['resources'] .= 'Error';
                    }
                }
            }
        }
        return $document;
    }


    function sort_documents($sort_array)
    {
        $status = 'error';
        $order = 1;
        foreach ($sort_array as $val) {
            if (!empty($val) && $val != "null") {
                $this->db->where('id', $val)
                    ->update($this->tables['document'], array('position' => $order));

                $order += 1;
                $status = 'success';
            }
        }
        return $status;
    }
}
