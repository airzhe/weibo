<?php 
Class index extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '我的首页';
		$this->data['body_class'] = 'index';
	}
	public function index(){

		$this->view('index',$this->data);
	}
}