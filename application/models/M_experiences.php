<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_experiences extends CI_Model {

    public function __construct() {

        // OBLIGATOIRE
        parent::__construct();

        // On créé la connexion à la base de données
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('text');
    }



    public function getXp(){
        $query = $this->db->query("SELECT * FROM ecoActors WHERE valide = 1 ORDER BY id DESC");

        //$last_actor = $query->result();
        $data_xp = $query->result();
        return $data_xp;
    }


}


?>