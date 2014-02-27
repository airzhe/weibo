<?php 
/**
 * 赞 微博类
 */
Class praise extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '收到的赞';
	}
	public function index(){
		
		$this->view('praise',$this->data);
	}
}
