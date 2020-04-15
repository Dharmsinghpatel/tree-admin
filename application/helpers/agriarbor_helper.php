<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('site_url')) {
    function site_url($path)
    {
        //get main CodeIgniter object
        $ci = &get_instance();
        print_r($path);
        return $ci->config->item('base_url') . $path;
    }
}
