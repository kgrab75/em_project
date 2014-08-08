<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        echo("here");
    }

    function gettableinfos($sTable){
        $sql = "SHOW COLUMNS FROM $sTable";

        $query = $this->db->query($sql);

        $arr = array();

        foreach ($query->result() as $row){
            $arr[] = $row;
        }

        # JSON-encode the response
        echo $json_response = json_encode($arr);
    }

    function getdata($sTable){
        $sql = "SELECT * FROM $sTable";

        $query = $this->db->query($sql);

        $arr = array();

        foreach ($query->result() as $row){
            $arr[] = $row;
        }

        # JSON-encode the response
        echo $json_response = json_encode($arr);
    }


}
