<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * use for create url
 */
if (!function_exists('site_url')) {
    function site_url($path)
    {
        //get main CodeIgniter object
        $ci = &get_instance();
        return $ci->config->item('base_url') . $path;
    }
}

/**
 * use for get resource
 */
if (!function_exists('get_resource')) {
    function get_resource($id, $desc = false)
    {
        $ci = &get_instance();
        $ci->load->model('database_model', 'database');
        $file = $ci->database->get_file_detail($id, $desc);
        return $file;
    }
}

/**
 * ckeditor
 */
if (!function_exists('ckeditor')) {
    function ckeditor($name)
    {
        echo '<script type="text/javascript">
                    CKEDITOR.replace(' . $name . ');
                    CKEDITOR.add
                </script>';
    }
}

/**
 * render image with name
 */
if (!function_exists('render_image')) {
    function render_image($file)
    {
        $ci = &get_instance();
        $config_image = $ci->config->item('image');
        $path = site_url($config_image['upload_path']) . "/" . $file->unique_name;
        return '<div class="form-row" id="image">
                    <div class="col-8">
                        <label for="image">image<span class="text-danger">*</span></label>
                        <input type="file" class="form-control p-0 border-0" id="image" name="image">
                    </div>
                    <div class="col-4">
                        <label>' . $file->file_name . '</label>
                            <img src="' . $path . '" class="w-100">
                    </div>
                </div>';
    }
}

/**
 * render link name
 */
if (!function_exists('render_link')) {
    function render_link($file)
    {
        return '<div class="form-group" id="url">
                    <label for="url">Link<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="url" name="url" value="' . $file->unique_name . '" placeholder="http://..">
                    <small class="text-danger"><?php echo form_error("url"); ?></small>
                </div>';
    }
}

/**
 * render video link and thumbnail 
 */
if (!function_exists('render_video')) {
    function render_video($file, $file_2)
    {

        $ci = &get_instance();
        $config_image = $ci->config->item('image');
        $path = site_url($config_image['upload_path']) . "/" . $file_2->unique_name;

        return '
                <div class="form-row" id="video_thumbnail">
                    <div class="col-8">
                        <label for="video_thumbnail">Video Thumbnail<span class="text-danger">*</span></label>
                        <input type="file" class="form-control p-0 border-0" id="video_thumbnail" name="video_thumbnail">
                    </div>
                    <div class="col-4">
                        <label>' . $file_2->file_name . '</label>
                            <img src="' . $path . '" class="w-100">
                    </div>
                </div>

                <div class="form-group" id="video_id">
                    <label for="video_id">Video Id<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="video_id" name="video_id" value="' . $file->unique_name . '" >
                    <small class="text-danger"><?php echo form_error("video_id"); ?></small>
                </div>';
    }
}

/**
 * render description of document
 */

if (!function_exists('render_description')) {
    function render_description($resource, $desc_num)
    {
        return '
        <div class="form-group form-document">
            <div class="d-flex justify-content-between mb-10 mr-10" >
                <label for="description' . $desc_num . '">Description</label>
                <a class="delete-document" href="javascript:void(0)">
                <button class="btn btn-outline-secondary"><span class="fa fa-times f-12"></span></button></a>
            </div>
            <textarea class="form-control description" id="description' . $desc_num . '" rows="3" name="documents[][2][]">' . $resource['description'] . '</textarea>  
        </div>';
    }
}

/**
 * render topic of document
 */

if (!function_exists('render_topic')) {
    function render_topic($resource, $topic = 1)
    {
        $label = ($topic == 1) ? 'Topic<span class="text-danger">*</span>' : 'Documents';
        $is_readable = ($topic != 1) ? 'readonly' : '';
        $hidden_name = ($topic == 1) ? 'exist_topics[]' : 'exist_documents[]';
        // 
        return '
        <div class="form-row form-document">
            <div class="col-10">
                <div class="form-group">
                    <label>' . $label . '</label>
                    <input type="hidden" name="' . $hidden_name . '" value="' . $resource['topic_id'] . '" >
                    <input type="text" class="form-control" name="documents[][' . $topic . '][]" value="' . $resource['description'] . '" placeholder="" ' . $is_readable . '>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group text-center">
                    <label>Edit</label><br/>
                    <a target="_blank" class="link" href="' . site_url("/documents/add-documents") . '/' . $resource["topic_id"] . '">
                        <button class="btn btn-outline-secondary"><span class="fa fa-pencil-square-o f-24"></span></button>
                    </a>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group text-center">
                    <label>Delete</label>
                    <a class="delete-document" href="javascript:void(0)">
                        <button class="btn btn-outline-secondary"><span class="fa fa-trash-o f-24"></span></button>
                    </a>
                </div>
            </div>
        </div>';
    }
}

/**
 * render files of document
 */

if (!function_exists('render_files')) {
    function render_files($resource, $resource_detail)
    {
        return '<div class="form-row form-document">
            <input type="hidden" name="documents[][0][]" value="' . $resource['resource_id'] . '">
                <div class="col-4">
                    ' . get_resource($resource_detail->resource_type == "video" ? $resource_detail->file_id_2 : $resource_detail->file_id) . '
                </div>
                <div class="col-7">
                        ' . get_resource($resource_detail->file_id, true) . '
                </div>
                <div class="col-1">
                    <div class="form-group text-center">
                        <label>Delete</label>
                        <div>
                            <a class="delete-document" href="javascript:void(0)">
                            <button class="btn btn-outline-secondary" ><span class="fa fa-trash-o f-24"></span></button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        ';
    }
}

if (!function_exists('render_email_modal')) {
    function render_email_modal($data)
    {
        return '<div class="col">
                    <div class="form-group">
                        <label>First Name<span class="text-danger">*</span></label>
                        <p class="font-weight-bold">' . $data->first_name . '</p>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <p class="font-weight-bold">'  . $data->last_name . '</p>
                    </div>
                    <div class="form-group">
                        <label>Email<span class="text-danger">*</span></label>
                        <p class="font-weight-bold">'  . $data->email . '</p>
                    </div>
                    <div class="form-group">
                        <label>Comment<span class="text-danger">*</span></label>
                        <p class="font-weight-bold">'  . $data->comment  . '</p>
                    </div>
                </div>';
    }
}

/**
 * encryption methods
 */

if (!function_exists('encrypt')) {
    function encrypt($value, $is_sha1 = false)
    {
        if (!empty($value)) {
            $ci = &get_instance();
            $value = $is_sha1 ? sha1($value) : $value;
            $value = $ci->encryption->encrypt($value);
        }
        return $value;
    }
}

/**
 * decrypt method
 */
if (!function_exists('decrypt')) {
    function decrypt($value)
    {

        if (!empty($value)) {
            $ci = &get_instance();
            $value = $ci->encryption->decrypt($value);
        }
        return $value;
    }
}

/**
 * check password
 */

if (!function_exists(('check_password'))) {
    function check_password($save_pass, $login_pass)
    {
        return decrypt($save_pass) === trim(sha1($login_pass));
    }
}

/**
 * check login
 */
if (!function_exists(('is_logged_in'))) {
    function is_logged_in()
    {
        // Get current CodeIgniter instance
        $CI = &get_instance();
        // We need to use $CI->session instead of $this->session
        $user = $CI->session->userdata('user_data');
        if (!isset($user)) {
            return false;
        } else {
            return true;
        }
    }
}

/**
 * cut string
 */
if (!function_exists(('cut_text'))) {
    function cut_text($text, $length = 50)
    {
        if (strlen($text) > $length) {
            // $limit = str_word_count(substr(strip_tags($text), 0, $length)) - 1;
            // p(substr(strip_tags($text), 0, $length));
            // d($limit);
            return trim(limit_words(strip_tags($text), $length));
        }
        return trim(strip_tags($text));
    }
}

/**
 * words limit
 */
if (!function_exists(('limit_words'))) {
    function limit_words($text, $limit)
    {
        $word_arr = explode(" ", $text);

        if (count($word_arr) > $limit) {
            $words = implode(" ", array_slice($word_arr, 0, $limit)) . ' ...';
            return $words;
        }

        return $text;
    }
}

/**
 * secure post api to misused
 */
if (!function_exists(('convet_secure_input'))) {
    function convet_secure_input($data, $is_array = false)
    {
        if (!$is_array) {
            return trim(htmlspecialchars($data, ENT_QUOTES));
        }

        $secure_data = array();
        foreach ($data as $key => $value) {
            $secure_data[$key] = trim(htmlspecialchars($value, ENT_QUOTES));
        }
        return $secure_data;
    }
}

/**
 * encrypt and dycrypt topic ids
 */
if (!function_exists(('custom_secure_data'))) {
    function custom_secure_data($data, $encrypt = true)
    {

        $string_to_encrypt = "Te@#/?sis@123";

        if ($encrypt) {
            return openssl_encrypt($data, "AES-128-ECB", $string_to_encrypt);
        }
        return openssl_decrypt($data, "AES-128-ECB", $string_to_encrypt);
    }
}

/**
 * testing function
 */
if (!function_exists('p')) {
    function p($value)
    {
        echo '<pre>', print_r($value), '</pre>';
    }
}

/**
 * testing function
 */
if (!function_exists('d')) {
    function d($value)
    {
        echo '<pre>', var_dump($value), '</pre>';
    }
}
