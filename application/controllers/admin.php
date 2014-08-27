<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->library('session');
    }

    public function index()
    {

        if($this->m_admin->bIsLoggedIn()){
            redirect('admin/dashboard','refresh');
        } else {
            redirect('admin/connection','refresh');
        }
    }

    function connection(){

        $data['title'] = ucfirst('connection');

        if($this->m_admin->bIsLoggedIn()){
            redirect('admin','refresh');
        } else {
            //on charge la validation de formulaires
            $this->load->library('form_validation');

            //on définit les règles de succès
            $this->form_validation->set_message('required', 'Le champ %s est obligatoire.');

            $this->form_validation->set_rules('username', 'Login', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|md5');

            //si la validation a échouée on redirige vers le formulaire de login
            if(!$this->form_validation->run()){
                $this->load->view('admin/v_connection');
            } else {
                $bCheckId = $this->m_admin->bCheckId( $_POST );

                if($bCheckId){
                    redirect('admin/dashboard','refresh');
                } else {
                    $data['error_check_id'] = '<p>Utilisateur non reconnu</p>';
                    $this->load->view('admin/v_connection',$data);
                }
            }
        }
    }

    function deconnection(){
        $this->session->sess_destroy();
        redirect('admin/connection','refresh');
    }

    function dashboard($page = 'dashboard'){

        if($this->m_admin->bIsLoggedIn()){

            $data['page'] = $page;
            $data['title'] = ucfirst($page);

            $this->load->view('admin/v_header', $data);
            $this->load->view('admin/v_sidebar', $data);

            if( $page == 'eco_acteur' )
            {
                $data['table'] = 'ecoActors';
                $this->load->view('admin/pages/v_crud', $data);
            }
            else if( $page == 'comments' )
            {
                $data['table'] = 'comments';
                $this->load->view('admin/pages/v_crud', $data);
            }
            else if( $page == 'messages' )
            {
                $data['table'] = 'messages';
                $this->load->view('admin/pages/v_message', $data);
            }
            else
            {
                $this->load->model('M_generic');
                $data['experienceCount'] = $this->M_generic->experienceCount();
                $data['messageCount'] = $this->M_generic->messageCount();
                $this->load->view('admin/pages/v_'.$page, $data);
            }





            $this->load->view('admin/v_footer', $data);

        }
    }
}