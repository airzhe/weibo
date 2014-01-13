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
		// $this->load->view('login');
		// $this->load->view('signup');
		// $this->load->view('home');
		$this->load->view('index');
		// $this->load->view('msg');
	}
	public function login()
	{
		$this->load->view('login');
	}
	public function signup()
	{
		$this->load->view('signup');
	}
	public function home()
	{
		$this->load->view('home');
	}
	public function msg()
	{
		$this->load->view('msg');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */