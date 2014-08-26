<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_generic extends CI_Model {

    public function __construct() {

        // OBLIGATOIRE
        parent::__construct();

        // On créé la connexion à la base de données
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('text');
    }


    public function experienceCount() {

        $queryTotal = $this->db->query("SELECT * FROM ecoActors WHERE valide = 1  ORDER BY id DESC ");

        $count = $queryTotal->num_rows();
        return $count;
    }



    public function lastActu (){
        $query = $this->db->query("SELECT * FROM actus WHERE status = 1  ORDER BY date DESC LIMIT 1 ");

        $lastActu = $query->result();
        return $lastActu;
    }



}


?>