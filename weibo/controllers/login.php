<?php 
Class login extends Front_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->partial('login');
	}
}
