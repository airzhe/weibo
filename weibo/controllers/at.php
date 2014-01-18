<?php 
Class at extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '@我的微博';
	}
	public function index(){
		$this->view('at',$this->data);
	}
}
