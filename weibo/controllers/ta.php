<?php 
Class ta extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title']="Babyface_大乖乖M叫Zzihan的微博|";
		$this->data['body_class'] = 'index';
	}
	public function index(){
		$this->view('ta',$this->data);
	}
}
