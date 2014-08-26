<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_experience extends CI_Model {

    public function __construct() {

        // OBLIGATOIRE
        parent::__construct();

        // On créé la connexion à la base de données
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('text');
        $this->load->library('form_validation');
        $this->load->library('akismet');
    }



    public function getXp ($id){
        $query = $this->db->query("SELECT * FROM ecoActors WHERE valide = 1 AND id = ".$id." LIMIT 1");

        if ($query->num_rows() > 0){
            $dataXp = $query->row(0);
            return $dataXp;
        } else {
            $dataXp = "";
            return $dataXp;
        }


    }

    public function insertComment($nom, $prenom, $email, $message, $id, $ip, $spam, $status) {
        $data = array(
            'nom' => $nom ,
            'prenom' => $prenom ,
            'email' => $email,
            'message' => $message,
            'ecoactor_id' => $id,
            'status' => $status,
            'spam' => $spam,
            'ip' => $ip

        );

        $this->db->insert('comments', $data);
    }

    public function getComments ($id){
        $query = $this->db->query("SELECT * FROM comments WHERE status = 1 AND ecoactor_id = ".$id);

        $comments = $query->result();
        return $comments;
    }

    public function _init_akismet()
    {
        // Config
        $akismet_config = array(
            'blog_url' => 'your_url_here', // e.g. http://www.example.com/ (note trailing '/')
            'api_key' => '3ff74964ff7d'
        );

        $this->akismet->initialize($akismet_config);
    }


}


?>