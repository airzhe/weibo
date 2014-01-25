<?php 
/**
 * 用户注册页面
 */
Class signup extends Front_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		if($this->input->post()){
			$data=$this->input->post();
			p($data);
		}else{
			$this->partial('signup');
		}
	}
	public function code(){
		$this->load->library('code');
		$this->code->font_size=20;
		$this->code->font='./assets/data/Quickie.ttf';
		$this->code->show();
	}
}
