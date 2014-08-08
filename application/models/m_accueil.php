<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_accueil extends CI_Model {

    public function __construct() {

        // OBLIGATOIRE
        parent::__construct();

        // On créé la connexion à la base de données
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('text');
    }



    public function getLastActor(){
        $query = $this->db->query("SELECT id, titre, description FROM ecoActors WHERE valide = 1 ORDER BY id DESC LIMIT 1");

        //$last_actor = $query->result();
        $last_actor = $query->row(0);
        return $last_actor;

    }

    function select10()
    {
        $sql = 'SELECT * FROM ecoActors WHERE valide = 1 ORDER BY id DESC LIMIT 10';
        $query = $this->db->query($sql);
        // Fetch the result array from the result object and return it
        return $query->result();
    }


}


?>