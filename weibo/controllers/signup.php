<?php 
Class signup extends Front_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		if($this->input->post()){
			$data=$this->input->post();
			p($data);
		}else{
			$this->partial('signup');
		}
	}
}
