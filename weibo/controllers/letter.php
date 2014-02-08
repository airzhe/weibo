<?php 
Class letter extends Front_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->data['title'] = '我的私信';
		$this->data['body_class'] = 'letter';
		$this->view('letter',$this->data);
	}
	public function lists(){
		$this->data['title'] = '私信对话';
		$this->view('letter_list',$this->data);
	}
}
