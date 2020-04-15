<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Documents_model extends CI_Model
{

    function get_contents()
    {

        $response = array(
            "result" => array(
                array("title" => "Title 1", "type" => "video"),
                array("title" => "Title 2", "type" => "video"),
                array("title" => "Title 3", "type" => "video"),
                array("title" => "Title 4", "type" => "video"),
                array("title" => "Title 5", "type" => "video"),
                array("title" => "Title 6", "type" => "site"),
                array("title" => "Title 7", "type" => "video"),
                array("title" => "Title 8", "type" => "video"),
                array("title" => "Title 9", "type" => "image"),
                array("title" => "Title 10", "type" => "video"),
                array("title" => "Title 11", "type" => "video")
            ),
            "num_rows" => 11
        );

        return $response;
    }
}
