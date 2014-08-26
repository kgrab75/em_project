<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
     *
     *
	 */

    public $data = array();

    public function __construct() {
        parent:: __construct();
        $this->load->helper("url");
        $this->load->library("pagination");
        $this->load->helper('email');
        $this->load->library('email');
        $this->load->library('form_validation');



    }

	public function index()
	{
		$this->load->view('welcome_message');
	}

    public function view($page = 'accueil', $pagen = 0){


        $data['title'] = ucfirst($page);
        $data['sidebar_content']['info']='generic/info';
        $data['sidebar_content']['actu']='generic/actu';
        $data['sidebar_content']['community']='generic/community';

        $this->load->model('M_generic');

        $data['experienceCount'] = $this->M_generic->experienceCount();
        $data["lastActu"] = $this->M_generic->lastActu();


        if($page == "accueil") {
            $this->load->model('M_'.$page);

            $data['lastActor'] = $this->M_accueil->getLastActor();

            $data['last10'] = $this->M_accueil->select10();
            $last10Json = json_encode($data['last10']);
            //var_dump($last10Json);

            // RECUPERATION DU JSON EN JAVACRIPT
            echo '<script type="text/javascript">';
            echo "var myJson = '" . $last10Json . "';";
            echo '</script>';



        }


        if($page == "participation") {

            $this->load->model('M_'.$page);

            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|strip_tags|xss_clean' );
            $this->form_validation->set_rules('titre', 'Titre', 'required' );
            $this->form_validation->set_rules('transportType', 'Type de transport', 'required' );
            $this->form_validation->set_rules('difficulty', 'Difficulté', 'required' );
            $this->form_validation->set_rules('depart', 'Adresse de départ', 'trim|required' );
            $this->form_validation->set_rules('arrivee', 'Adresse d\'arrivée', 'trim|required' );
            $this->form_validation->set_rules('description', 'Details', 'trim|required' );
            $this->form_validation->set_rules('okForm', 'conditions', 'trim|required' );
            $this->form_validation->set_rules('ip', 'IP', 'required' );


            $this->form_validation->set_message('required', 'has-error text-danger');


            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');



            if($this->form_validation->run() !== false){
                $email = $this->input->post('email');
                $titre = $this->input->post('titre');
                $difficulty = $this->input->post('difficulty');
                $transport = $this->input->post('transportType');
                $depart = $this->input->post('start');
                $arrivee = $this->input->post('end');
                $description = $this->input->post('description');
                $concours = $this->input->post('concours');
                $ip = $this->input->post('ip');

                if($concours !== "yes"){$concours = "no";}



                // RECUPERATION DU GES, etc...

                /*

                $this->email->from($email, $nomPrenom);
                $this->email->to('golden-13@hotmail.fr');
                $this->email->cc('lch-dzign@gmail.com');
                //$this->email->bcc('them@their-example.com');

                $this->email->subject($objet);
                $this->email->message($message);

                $this->email->send();

                // PRINT POUR DEBUGG ENVOI EMAIL
                echo $this->email->print_debugger();

                */

                $this->M_participation->insertXp($email, $depart, $arrivee, $titre, $description, $concours, $difficulty, $transport, $ip);

                redirect('/participationsuccess', 'refresh');



            }




        }


        if($page == "experiences") {
            $this->load->model('M_'.$page);

            $this->_paginationXp("experiences/","M_experiences", 2, 3, 5);

            $jsonData = json_encode($this->data["results"]);


            // RECUPERATION DU JSON EN JAVACRIPT
            echo '<script type="text/javascript">';
            echo "var xpJson = '" . $jsonData . "';";
            echo "var url = '" . base_url() . "';";
            echo '</script>';
        }




        if($page == "experience") {
            $this->load->model('M_'.$page);

            $idXp = $this->uri->segment(2);


            $nom = $this->input->post('nom');
            $prenom = $this->input->post('prenom');
            $email = $this->input->post('email');
            $message = $this->input->post('message');
            $ip = $this->input->post('ip');

            $this->form_validation->set_rules('nom', 'Nom', 'trim' );
            $this->form_validation->set_rules('prenom', 'Prenom', 'trim|required' );
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|strip_tags|xss_clean' );
            $this->form_validation->set_rules('okForm', 'conditions', 'trim|required' );
            $this->form_validation->set_rules('message', 'Message', 'trim|required' );
            $this->form_validation->set_rules('ip', 'IP', 'required' );

            $this->form_validation->set_message('required', 'has-error text-danger');


            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if($this->form_validation->run() !== false){


                $this->M_experience->_init_akismet();

                // set up your comment data to be passed to Akismet here, e.g:
                $akismet_comment_data = array(
                    'user_ip'     => $ip,
                    'comment_author'     => $prenom,
                    'comment_author_email'   => $email,
                    'comment_content'      => $message

                );

                if ($this->akismet->is_spam($akismet_comment_data)) // perform the check
                {
                    $spam = "yes"; // flag the comment as spam
                    $status = 0;
                    $getUrl = "spam";

                } else {
                    $spam = "no";
                    $status = 1;
                    $getUrl = "success";
                }



        $this->M_experience->insertComment($nom, $prenom, $email, $message, $idXp, $ip, $spam , $status);
                $url = base_url();
                $redirect = $url . "experience/". $idXp ."?p=".$getUrl;
                redirect($redirect, 'refresh');
            }


            $data["dataXp"] = $this->M_experience->getXp($idXp);


            $xpJson = json_encode($data['dataXp']);


            // RECUPERATION DU JSON EN JAVACRIPT
            echo '<script type="text/javascript">';
            echo "var xpJson = '" . $xpJson . "';";
            echo '</script>';


            $data["comments"]= $this->M_experience->getComments($idXp);


        }

        if($page == "contact") {
            $this->load->model('M_'.$page);


            $this->form_validation->set_rules('nom', 'Nom', 'trim' );
            $this->form_validation->set_rules('prenom', 'Prenom', 'trim|required' );
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|strip_tags|xss_clean' );
            $this->form_validation->set_rules('objet', 'Objet', 'required' );
            $this->form_validation->set_rules('okForm', 'conditions', 'trim|required' );
            $this->form_validation->set_rules('message', 'Message', 'trim|required' );

            $this->form_validation->set_message('required', 'has-error text-danger');


            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');



            if($this->form_validation->run() !== false){
                $nom = $this->input->post('nom');
                $prenom = $this->input->post('prenom');
                $email = $this->input->post('email');
                $objet = $this->input->post('objet');
                $message = $this->input->post('message');

                /*
                if(!isset($prenom)){
                    $nomPrenom = $nom;
                } else {
                    $nomPrenom = $nom ." ".$prenom;
                }

                $this->email->from($email, $nomPrenom);
                $this->email->to('golden-13@hotmail.fr');
                $this->email->cc('lch-dzign@gmail.com');
                //$this->email->bcc('them@their-example.com');

                $this->email->subject($objet);
                $this->email->message($message);

                $this->email->send();

                // PRINT POUR DEBUGG ENVOI EMAIL
                echo $this->email->print_debugger();

                */

                $this->M_contact->insertMessage($nom, $prenom, $email, $objet, $message);

                redirect('/contactsuccess', 'refresh');



            }
        }


        if($page == "ecoactors") {

            $this->load->model('M_'.$page);

            $data["ecoactors"]= $this->M_ecoactors->ecoactors();


            $jsonData = json_encode($data["ecoactors"]);


            // RECUPERATION DU JSON EN JAVACRIPT
            echo '<script type="text/javascript">';
            echo "var jsonData = '" . $jsonData . "';";
            echo "var url = '" . base_url() . "';";
            echo '</script>';

        }

        if($page == "actus") {
            $this->load->model('M_'.$page);

            $this->_paginationXp("","M_actus", 1, 2, 2);
            $this->data["results"];

        }


        if($page == "actu") {
            $this->load->model('M_'.$page);

            $idActu = $this->uri->segment(2);

            $data["actu"] = $this->M_actu->actuDetails($idActu);

        }

        $this->load->view('generic/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('generic/sidebar', $data);
        $this->load->view('generic/footer', $data);

    }



    private function _paginationXp($path, $model, $baseUrl, $segmentPage, $limit) {
        $config = array();

        $urlActive = $this->uri->segment($baseUrl);

        $config["base_url"] = base_url() .  $path .$urlActive."/";
        $config["total_rows"] = $this->$model->total_ecoActors();
        $config["per_page"] = $limit;
        $config["uri_segment"] = $segmentPage;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';


        $pageActive = ($this->uri->segment($segmentPage)) ? $this->uri->segment($segmentPage) : 0;


        $base = $this->uri->segment(1);

        $this->data["results"] = $this->$model->
            fetch_ecoActors($config["per_page"], $pageActive);

        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();



    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
