<?php 
Class login extends Front_Controller{
	public function __construct(){
		parent::__construct();

		// 如果已经登录过，跳转至home页面
		if ($this->User_model->loggedin() == TRUE) {
			redirect('home');
		}
	}
	public function index(){
		if($this->input->post()){
			echo '.....';
		}else{
			$this->partial('login');
		}
	}
}
