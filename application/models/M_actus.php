<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_actus extends CI_Model {

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
        return $this->db->count_all("actus");
    }

    // PREPARATION DE LA REQUETE
    public function fetch_ecoActors( $limit, $start) {

        $query = $this->db->query("SELECT * FROM actus WHERE status = 1  ORDER BY date DESC LIMIT $start , $limit ");


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;

        }
        return false;
    }

    public function total_ecoactors() {
        $queryTotal = $this->db->query("SELECT * FROM actus WHERE status = 1");

        $count = $queryTotal->num_rows();
        return $count;
    }

}


?>