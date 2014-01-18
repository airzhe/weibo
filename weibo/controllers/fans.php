<?php 
Class fans extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '关注我的人';
	}
	public function index(){
		$this->view('fans',$this->data);
	}
}
