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
		$this->load->view('index.html');
	}

	public function indexs()
	{	
		$this->load->view('index');
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
	public function follow()
	{
		$this->load->view('follow');
	}
	public function fans()
	{
		$this->load->view('fans');
	}
	public function photo()
	{
		$this->load->view('set/avatar');
	}
	public function setinfo()
	{
		$this->load->view('set/index');
	}
	public function at()
	{
		$this->load->view('at');
	}
	public function commin()
	{
		$this->load->view('comment_inbox');
	}
	public function commout()
	{
		$this->load->view('comment_outbox');
	}
	public function letter2()
	{
		$this->load->view('letter_list');
	}
	public function letter()
	{
		$this->load->view('letter');
	}
	public function one()
	{
		$this->load->view('single_weibo');
	}
	public function ta()
	{
		$this->load->view('ta');
	}
	public function search()
	{
		$this->load->view('search');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */