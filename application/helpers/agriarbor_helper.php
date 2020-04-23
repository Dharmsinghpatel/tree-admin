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
        print_r($path);
        return $ci->config->item('base_url') . $path;
    }
}

/**
 * use for get resource
 */
if (!function_exists('get_resource')) {
    function get_resource($id)
    {
        $ci = &get_instance();
        $ci->load->model('database_model', 'database');
        $file = $ci->database->get_file_detail($id);
        return $file;
    }
}
