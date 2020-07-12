<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Documents_model extends CI_Model
{
    public $tables = array();
    function __construct()
    {
        $this->tables = array('resource' => 'resources', 'document' => 'documents', 'contents' => 'contents', 'classification' => 'classification', 'metadata' => 'metadata');
        $this->load->model('database_model', 'database');
        $this->load->helper('text');
    }

    function get_documents($content_type)
    {
        $documents = $this->db->select('dc.id,dc.title,dc.is_topic,dc.created,dc.updated')
            ->order_by('position', 'asc')
            ->where(array('is_topic' => null, 'display_type' => $content_type))
            ->get($this->tables['document'] . ' dc');

        $document_list = array();
        if (!empty($documents->result_array())) {
            foreach ($documents->result_array() as $key => $resource) {
                $topics_id = $this->db->select('ct.topic_id')
                    ->order_by('ct.position', 'asc')
                    ->where(array('ct.document_id' => $resource['id'], 'ct.topic_id !=' => null, 'ct.content_type' => 'topic'))
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
        return array($documents, $document_list);
    }

    function add_documents($params)
    {
        extract($params);

        $url = isset($url) ? $url : null;
        $icon_id = isset($icon_id) ? $icon_id : null;
        $document_id = isset($document_id) ? $document_id : null;
        $exist_topics = isset($exist_topics) ? $exist_topics : array();
        $exist_documents = isset($exist_documents) ? $exist_documents : array();

        $meta_active = isset($meta_active) ? 1 : 0;

        if (!isset($title) || empty($title)) {
            return;
        }

        if (isset($file['icon']) && !empty($file['icon']['name'])) {
            $icon_id = $this->database->do_upload(array('file' => $file['icon'], 'file_name' => 'icon'));
            $icon_id = is_numeric($icon_id) ? $icon_id : null;
        }

        $slug = $this->clean_slug($title, $this->tables['document'], $document_id);
        $data = array(
            'title' => $title,
            'slug' => $slug,
            'display_type' => $display_type,
            'icon' => $icon_id
        );

        $data_class = array(
            'product_type' => $product_type,
            'product_name' => $product_name,
            'product_use' => $product_use,
            'document_id' => $document_id
        );

        $metadata = array(
            'slug' => $slug,
            'document_id' => $document_id,
            'keywords' => $keywords,
            'description' => $meta_description,
            'active' => $meta_active
        );

        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        if (isset($document_id) && !empty($document_id)) {
            $data['updated'] = date('Y-m-d h:i:sa');
            $this->db->where('id', $document_id)
                ->update($this->tables['document'], $data);

            $is_classification = $this->db->where('document_id', $document_id)->from($this->tables['classification'])->count_all_results();

            $is_classification == 1 ?
                $this->db->where('document_id', $document_id)
                ->update($this->tables['classification'], $data_class)
                :
                $this->db->insert($this->tables['classification'], $data_class);

            $is_metadata = $this->db->where('document_id', $document_id)->from($this->tables['metadata'])->count_all_results();

            $is_metadata == 1 ?
                $this->db->where('document_id', $document_id)
                ->update($this->tables['metadata'], $metadata)
                :
                $this->db->insert($this->tables['metadata'], $metadata);


            //delete description and files
            $this->db->where(array('document_id' => $document_id))
                ->where('content_type != "topic" AND content_type != "document"')
                ->delete($this->tables['contents']);

            //delete document/topic
            $topics  = $this->db->select('ct.topic_id ,ct.content_type')
                ->where(array('document_id' => $document_id))
                ->where('content_type = "topic" OR content_type = "document"')
                ->get($this->tables['contents'] . ' ct')->result_array();
            $topics_id = array_column($topics, 'topic_id');

            foreach ($topics_id as $key => $id) {
                if ($topics[$key]['content_type'] == 'topic' && !in_array($id, $exist_topics)) {
                    $this->delete_documents($id, 1);
                } else if ($topics[$key]['content_type'] == 'document' && !in_array($id, $exist_documents)) {
                    $this->db->where(array('topic_id' => $id))
                        ->delete($this->tables['contents']);
                }
            }
        } else {
            $pos = $this->db->select_max('position')
                ->get($this->tables['document'])->row();

            $data['position'] = $pos ? $pos->position + 1 : 1;
            $data['created'] = date('Y-m-d h:i:sa');

            $this->db->insert($this->tables['document'], $data);
            $document_id = $data_class['document_id'] = $metadata['document_id'] = $this->db->insert_id();
            $this->db->insert($this->tables['classification'], $data_class);
            $this->db->insert($this->tables['metadata'], $metadata);
        }

        $documents_row = array();
        $i = 0;
        $topic_index = 0;
        $document_index = 0;

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
                        $temp['content_type'] = 'file';
                        array_push($documents_row, $temp);
                    } else if (array_key_exists('1', $document) && !empty($document[1][0])) {
                        $topic_content = array(
                            'title' => $document[1][0], 'is_topic' => 1
                        );

                        if (isset($exist_topics) && !empty($exist_topics[$topic_index])) {
                            $topic_content['updated'] = date('Y-m-d h:i:sa');
                            $this->db->where('id', $exist_topics[$topic_index])
                                ->update($this->tables['document'], $topic_content);
                            $this->db->where('topic_id', $exist_topics[$topic_index])
                                ->update($this->tables['contents'], array('description' => $document[1][0], 'position' => $i));
                        } else {
                            $topic_content['created'] = date('Y-m-d h:i:sa');
                            $this->db->insert($this->tables['document'], $topic_content);
                            $temp['topic_id'] = $this->db->insert_id();
                            $temp['content_type'] = 'topic';
                            $temp['description'] = $document[1][0];
                            array_push($documents_row, $temp);
                        }

                        $topic_index += 1;
                    } else if ((array_key_exists('2', $document)) && !empty($document[2][0])) {
                        $temp['description'] = $document[2][0];
                        $temp['content_type'] = 'description';
                        array_push($documents_row, $temp);
                    } else if (array_key_exists('3', $document) && !empty($document[3][0])) {
                        if (isset($exist_documents) && !empty($exist_documents[$document_index])) {
                            $temp_doc = $this->db->select('title')
                                ->where('id', $exist_documents[$document_index])
                                ->get($this->tables['document'])->row();
                            $this->db->where('topic_id', $exist_documents[$document_index])
                                ->update($this->tables['contents'], array('description' =>  $temp_doc->title, 'position' => $i));
                        } else {
                            $temp_doc = $this->db->select('title')
                                ->where('id', $document[3][0])
                                ->get($this->tables['document'])->row();

                            $temp['topic_id'] = $document[3][0];
                            $temp['content_type'] = 'document';
                            $temp['description'] =  $temp_doc->title;
                            array_push($documents_row, $temp);
                        }
                        $document_index += 1;
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
            return FALSE;
        }
        return TRUE;
    }

    function clean_slug($title = NULL, $table = NULL, $id = NULL)
    {
        if (!$title && !$table) return FALSE;

        $simpleText = preg_replace('/[!@#$%^&*()_+-=?><,.{}]/', '', $title);
        // $slug = url_title(convert_accented_characters($title), 'dash', true);
        $slug = trim(preg_replace('/[[:space:]]+/', '-', $simpleText));

        $num = $this->db->from($table)->where(array('slug' => $slug))
            ->where('id !=', $id)->get()->num_rows();

        if ($num == 0) {
            return $slug;
        }

        return $this->clean_slug($slug . '-1', $table, $id);
    }

    function delete_documents($id = null, $is_topic)
    {
        $flag = 'error';
        if (!empty($id)) {
            $document_detail  = $this->db->select('dc.icon as file_id')
                ->where(array('dc.id' => $id))
                ->get($this->tables['document'] . ' dc')->row();

            $topics  = $this->db->select('ct.topic_id ,ct.content_type')
                ->where(array('document_id' => $id, 'content_type' => 'topic'))
                ->get($this->tables['contents'] . ' ct')->result_array();

            $topics_id = array_column($topics, 'topic_id');

            //delete topics
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            foreach ($topics_id as $tid) {
                $this->delete_documents($tid, 1);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 'error';
            }

            $topic_where = $is_topic && !empty($is_topic) ?
                array('topic_id' => $id)
                : array('document_id' => $id);


            //delete classification
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            $this->db->where('document_id', $id)
                ->delete($this->tables['classification']);
            $this->db->where($topic_where)
                ->delete($this->tables['contents']);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 'error';
            }

            //delete document
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            $is_delete = $this->db->delete($this->tables['document'], array('id' => $id));
            $this->database->unlink_file($document_detail->file_id);

            $flag = $is_delete > 0 ? 'success' : 'error';
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $flag = 'error';
            }
        }

        return $flag;
    }

    function get_detail($id)
    {
        $document = array();
        if (!empty($id)) {
            $document['general_detail'] = $this->db->select('dc.id, dc.title, dc.display_type, dc.is_topic, dc.icon, cl.product_type as cl_type, cl.product_name, cl.product_use, mt.keywords, mt.active as meta_active, mt.description as meta_description')
                ->join($this->tables['classification'] . ' cl', 'cl.document_id = dc.id', 'left')
                ->join($this->tables['metadata'] . ' mt', 'mt.document_id = dc.id', 'left')
                ->where('dc.id', $id)
                ->get($this->tables['document'] . ' dc')->row();

            $resources = $this->db->select('ct.description, ct.resource_id, ct.topic_id, ct.content_type as resource_type')
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
                        case 'document':
                            $document['resources'] .= render_topic($resource, 3);
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

    function get_document_detail($id = null)
    {
        $where = !empty($id) ? array('dc.id' => $id) : array('dc.is_topic' => NULL);
        return $this->db->select('dc.id,dc.title')
            ->order_by('dc.position', 'asc')
            ->where($where)
            ->get($this->tables['document'] . ' dc')
            ->result_array();
    }
}
