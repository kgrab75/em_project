<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_ecoactors extends CI_Model {

    public function __construct() {

        // OBLIGATOIRE
        parent::__construct();

        // On créé la connexion à la base de données
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('text');
        $this->load->library("pagination");
    }


    public function ecoactors() {

        $query = $this->db->query("SELECT * FROM ecoActors WHERE valide = 1  ORDER BY ges DESC LIMIT 15");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;

        }
        return $data;
    }

}


?>