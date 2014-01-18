<?php 
Class like extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '收到的赞';
	}
	public function index(){
		$this->view('like',$this->data);
	}
}
