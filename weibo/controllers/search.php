<?php 
Class search extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '微博搜索';
		$this->data['body_class'] = 'search';
	}
	public function index(){
		$this->partial('components/header',$this->data);
		$this->partial('search');
	}
}
