<?php 
Class follow extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '我关注的人';
	}
	public function index(){
		$this->view('follow',$this->data);
	}
}
