<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_contact extends CI_Model {

    public function __construct() {

        // OBLIGATOIRE
        parent::__construct();

        // On créé la connexion à la base de données
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('text');
        $this->load->library("pagination");
    }

    public function insertMessage($nom, $prenom, $email, $objet, $message) {
        $data = array(
            'nom' => $nom ,
            'prenom' => $prenom ,
            'email' => $email,
            'objet' => $objet,
            'message' => $message,
            'status' => 0

        );

        $this->db->insert('messages', $data);
    }


}


?>