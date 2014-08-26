<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_actu extends CI_Model {

    public function __construct() {

        // OBLIGATOIRE
        parent::__construct();

        // On créé la connexion à la base de données
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('text');
        $this->load->library("pagination");
    }

    // PREPARATION DE LA REQUETE
    public function actuDetails( $id) {

        $query = $this->db->query("SELECT * FROM actus WHERE status = 1 AND id = $id LIMIT 1");


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;

        }
        return false;
    }


}


?>