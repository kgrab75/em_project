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
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

    public function view($page = 'accueil'){

        $data['title'] = ucfirst($page);
        $data['sidebar_content']['info']='generic/info';
        $data['sidebar_content']['actu']='generic/actu';
        $data['sidebar_content']['community']='generic/community';

        $this->load->model($page);

        $this->load->view('generic/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('generic/sidebar', $data);
        $this->load->view('generic/footer', $data);

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */