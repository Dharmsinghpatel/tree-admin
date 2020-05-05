<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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

                <div class="form-group" id="url">
                    <label for="url">Link<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="url" name="url" value="' . $file->unique_name . '" placeholder="http://..">
                    <small class="text-danger"><?php echo form_error("url"); ?></small>
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
    function render_topic($resource)
    {
        return '
        <div class="form-row form-document">
            <div class="col-10">
                <div class="form-group">
                    <label>Topic<span class="text-danger">*</span></label>
                    <input type="hidden" name="exist_topics[]" value="' . $resource['topic_id'] . '" >
                    <input type="text" class="form-control" name="documents[][1][]" value="' . $resource['description'] . '" placeholder="">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group text-center">
                    <label>Edit</label><br/>
                    <a target="_blank" href="' . site_url("/documents/add-documents") . '/' . $resource["topic_id"] . '">
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
        return '
        <div class="form-row form-document">
            <input type="hidden" name="documents[][0][]" value="' . $resource['resource_id'] . '">
                <div class="col-4">
                    ' . get_resource($resource_detail->type == "video" ? $resource_detail->file_id_2 : $resource_detail->file_id) . '
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
