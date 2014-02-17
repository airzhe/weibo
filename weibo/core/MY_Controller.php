<?php

/**
 * The base controller which is used by the Front and the Admin controllers
 */
class Base_Controller extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->data=array();
	}
	
}//end Base_Controller

class Front_Controller extends Base_Controller
{
	
	function __construct(){
		parent::__construct();

		$this->load->model('User_model');
		$this->auth();
		$this->output->enable_profiler(TRUE);
		// $this->session->sess_destroy();
	}
	
	/*
	This works exactly like the regular $this->load->view()
	The difference is it automatically pulls in a header and footer.
	*/
	function view($view, $vars = array(), $string=false)
	{
		if($string)
		{
			$result	 = $this->load->view('components/header', $vars, true);
			$result	.= $this->load->view($view, $vars, true);
			$result	.= $this->load->view('components/footer', $vars, true);
			return $result;
		}
		else
		{
			$this->load->view('components/header', $vars);
			$this->load->view($view, $vars);
			$this->load->view('components/footer', $vars);
		}
	}
	
	/*
	This function simply calls $this->load->view()
	*/
	function partial($view, $vars = array(), $string=false)
	{
		if($string)
		{
			return $this->load->view($view, $vars, true);
		}
		else
		{
			$this->load->view($view, $vars);
		}
	}
	/**
	 * 用户是否登录验证
	 */
	public function auth(){
		$exception_uris = array(
			'login', 
			'signup'
			);
		if(in_array($this->uri->segment(1),$exception_uris)) return;
		if ($this->User_model->loggedin() == FALSE) {
			redirect('login');
		}
	}
	/**
	 * 皮肤设置
	 */
	public function set_skin(){
		$my_style='';
		$style=$this->session->userdata('style');
		$cover=base_url('assets/skin/cover/1.jpg');
		if(is_array($style)){
			foreach ($style as $key => $value) {
				switch ($key) {
					case 'suit':
					$my_style.="<link rel='stylesheet' type='text/css' href='".base_url()."assets/skin/$key/$value/skin.css'>";
					$cover=base_url("assets/skin/suit/{$value}/images/profile_cover.jpg");
					break;
					case 'template':
					$my_style.="<link rel='stylesheet' type='text/css' href='".base_url()."assets/skin/$key/$value/skin.css'>";
					break;
					case 'cover':
					$cover =base_url("assets/skin/cover/$value");
					break;
					case 'style':
					$my_style.="<link rel='stylesheet' type='text/css' href='".base_url()."assets/skin/$key/$value'>";
					break;
				}
			}
		}
		$this->data['style']=$my_style;
		$this->data['cover']=$cover;
	}
}
