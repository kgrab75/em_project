<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_admin extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function bCheckId( $aPost )
    {

        $query = $this->db->get_where('users', array('username' => $aPost["username"], 'password' => $aPost["password"], 'status' => '1' ));

        if( $query->num_rows() > 0 ){
            $aResult = $query->result();
            $session_data = array('username' => $aResult[0]->username,'logged_in' => true);
            $this->session->set_userdata($session_data);
            return true;
        }
        else
        {
            return false;
        }
    }

    function bIsLoggedIn(){
        if( $this->session->userdata('logged_in') ){
            return true;
        }
        else
        {
            return false;
        }
    }



}