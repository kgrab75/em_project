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
        header('Content-Type: application/json');
        echo $json_response = json_encode($arr);
    }

    function getdata($sTable){
        $sql = "SELECT * FROM $sTable";

        $query = $this->db->query($sql);

        $arr = array();

        foreach ($query->result() as $key => $row){
            $row->dataDelete = 0;
            $row->dataAdd = 0;
            $arr[] = $row;
        }

        # JSON-encode the response
        header('Content-Type: application/json');
        echo $json_response = json_encode($arr);
    }

    function savedata($sTable){
        $myDatas = json_decode($_POST['myDatas']);

        foreach( $myDatas as $data){

            if($data->dataDelete == 1){
                $this->db->delete($sTable, array('id' => $data->id));
            }

            if($data->dataAdd == 1){
                unset($data->id);
                unset($data->dataAdd);
                unset($data->dataDelete);
                unset($data->dataUpdate);
                unset($data->{'$$hashKey'});
                $this->db->insert($sTable, $data);
            }

            if(!empty($data->dataUpdated)){

                $dataToUpdate = array();

                foreach( $data->dataUpdated as $key => $value ){
                    if($value == 1){

                        $dataToUpdate[$key] = $data->$key;

                    }
                }
                echo($data->id . '\n');

                print_r($dataToUpdate);
                if(!empty($dataToUpdate)){
                    $this->db->where('id', $data->id);
                    $this->db->update($sTable, $dataToUpdate);
                }

            }

        }

    }

    function updatestatus($id){

        $dataToUpdate = array('status' => '1');

        $this->db->start_cache();

        $this->db->update('messages', $dataToUpdate, array('id' => $id));

        $this->db->stop_cache();
        echo 'test';


    }

}
