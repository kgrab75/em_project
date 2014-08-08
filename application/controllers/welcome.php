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


        if($page == "accueil") {
            $this->load->model('M_'.$page);

            $data['lastActor'] = $this->M_accueil->getLastActor();
        }


        if($page == "participation") {

            $this->load->model('M_'.$page);

        }


        if($page == "experiences") {
            $this->load->model('M_'.$page);

            $this->_paginationXp();

        }

        if($page == "contact") {

        }

        $this->load->view('generic/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('generic/sidebar', $data);
        $this->load->view('generic/footer', $data);

    }



    private function _paginationXp() {
        $config = array();

        $urlActive = $this->uri->segment(2);


        $config["base_url"] = base_url() . "/experiences/".$urlActive."/";
        $config["total_rows"] = $this->M_experiences->total_ecoActors();
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
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

        $config['cur_tag_open'] = '<li><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';


        $pageActive = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->data["results"] = $this->M_experiences->
            fetch_ecoActors($config["per_page"], $pageActive);

        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();

    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */