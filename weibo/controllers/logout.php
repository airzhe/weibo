<?php 
/**
 * 用户退出控制器
 */
class logout extends Front_Controller{
	public function index(){
		$this->session->sess_destroy();
		redirect('login');
	}
}