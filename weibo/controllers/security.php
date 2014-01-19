<?php 
Class security extends Front_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->view('security',$this->data);
	}

}
