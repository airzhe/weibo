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
		if(in_array(uri_string(),$exception_uris)) return;
		if ($this->User_model->loggedin() == FALSE) {
			redirect('login');
		}
	}
	/**
	 * 获得post数据，并进行安全验证
	 */
	public function array_from_post($fields){
		$data = array();
		foreach ($fields as $field) {
			$data[$field] = $this->input->post($field);
		}
		return $data;
	}
}
