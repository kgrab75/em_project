<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
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
        echo $json_response = json_encode($arr, JSON_NUMERIC_CHECK);
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

    public function search()
    {
        $oJson = json_decode($_POST['mySearch']);

        if($oJson->type == 'touristique'){
            $aWhere = array(
                'distance >=' => $oJson->distance->min * 1000,
                'distance <=' => $oJson->distance->max * 1000,
                'duree >=' => $oJson->duree->min * 60,
                'duree <=' => $oJson->duree->max * 60,
                'transport' => $oJson->transportT,
                'difficulty' => $oJson->difficulteT,
                'type' => $oJson->type,
                'sous_type' => $oJson->parcoursTypeT,
                'payant' => $oJson->payant
            );
        }

        if($oJson->type == 'sportif'){
            $aWhere = array(
                'distance >=' => $oJson->distance->min * 1000,
                'distance <=' => $oJson->distance->max * 1000,
                'duree >=' => $oJson->duree->min * 60,
                'duree <=' => $oJson->duree->max * 60,
                'transport' => $oJson->transportT,
                'difficulty' => $oJson->difficulteT,
                'type' => $oJson->type
            );
        }

        $query = $this->db->get_where('parcours', $aWhere );
        //print_r($this->db->last_query());
        header('Content-Type: application/json');
        echo $json_response = json_encode($query->result_array(), JSON_NUMERIC_CHECK);

    }

    public function inscription()
    {
        $oJson = json_decode($_POST['myForm']);

        $aWhere = array(
            'email' => $oJson->email
        );

        $query = $this->db->get_where('user_mobile', $aWhere );

        header('Content-Type: application/json');

        if( $query->num_rows() == 0){
            $data = array(
                'email' => $oJson->email ,
                'travail' => $oJson->latlong ,
                'password' => md5($oJson->password)
            );

            $this->db->insert('user_mobile', $data);

            echo $json_response = json_encode(array('error' => 'inscrit'), JSON_NUMERIC_CHECK);

        }
        else{
            echo $json_response = json_encode(array('error' => 'email_duplication'), JSON_NUMERIC_CHECK);
        }

    }

    public function connection_mobile()
    {
        $oJson = json_decode($_POST['myForm']);

        $aWhere = array(
            'email' => $oJson->email,
            'password' => md5($oJson->password)

        );

        $query = $this->db->get_where('user_mobile', $aWhere );

        header('Content-Type: application/json');

        if( $query->num_rows() == 1){

            echo $json_response = json_encode($query->row(), JSON_NUMERIC_CHECK);

        }
        else{
            echo $json_response = json_encode(array('error' => 'no_user'), JSON_NUMERIC_CHECK);
        }



    }

}
