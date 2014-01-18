<?php 
Class msg extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '消息';
	}
	public function index(){
		$this->view('msg',$this->data);
	}
}
