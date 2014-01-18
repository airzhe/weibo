<?php 
Class set extends Front_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function info(){
		$this->data['title'] = '个人信息';
		$this->view('set/index',$this->data);
	}
	public function avatar(){
		$this->data['title'] = '头像设置';
		$this->view('set/avatar',$this->data);
	}

}
