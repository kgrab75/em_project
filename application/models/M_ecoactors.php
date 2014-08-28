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

        $query = $this->db->query("SELECT id, email, titre, difficulty, transport, description, start, arrival, ROUND(11*10000*SQRT(POW(LEFT(start, 9)-LEFT(arrival, 9),2)+POW(RIGHT(start, 8)-RIGHT(arrival, 8),2)),0) as distance FROM ecoActors WHERE valide = 1 AND game = 'yes' ORDER BY distance DESC
 LIMIT 10;");

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