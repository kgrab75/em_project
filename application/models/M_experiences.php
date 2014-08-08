<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_experiences extends CI_Model {

    public function __construct() {

        // OBLIGATOIRE
        parent::__construct();

        // On créé la connexion à la base de données
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('text');
        $this->load->library("pagination");
    }

    // RECUPERATION DU NOMBRE DE LIGNE DANS LA TABLE
    public function record_count() {
        return $this->db->count_all("ecoActors");
    }

    // PREPARATION DE LA REQUETE
    public function fetch_ecoActors($limit, $start) {


        $filter =strtoupper($this->uri->segment(2));

        if(!isset($filter) || $filter == "" || $filter == "ALL") {
            $query = $this->db->query("SELECT * FROM ecoActors WHERE valide = 1  ORDER BY id DESC LIMIT $start , $limit ");
        } else {
            $query = $this->db->query("SELECT * FROM ecoActors WHERE valide = 1 AND transport = '" . $filter . "' ORDER BY id DESC LIMIT $start , $limit ");
        }


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;

        }
        return false;
    }

    public function total_ecoactors() {
        $filter =strtoupper($this->uri->segment(2));
        if(!isset($filter) || $filter == ""|| $filter == "ALL") {

            $queryTotal = $this->db->query("SELECT * FROM ecoActors WHERE valide = 1  ORDER BY id DESC ");
        } else {
            $queryTotal = $this->db->query("SELECT * FROM ecoActors WHERE valide = 1 AND transport = '" . $filter . "' ORDER BY id DESC");
        }

        $count = $queryTotal->num_rows();
        return $count;
    }

}


?>