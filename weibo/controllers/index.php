<?php 
Class index extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '我的首页';
		$this->data['body_class'] = 'index';
		$this->load->model('User_info_model');
	}
	public function index(){
		$user=$this->User_info_model->get_basic_info();

		if($user['avatar']==''){
			$user['avatar']=$user['sex']=='男'?'male_avatar':'female_avatar';
		}
		$this->data['user']=$user;
		$this->view('index',$this->data);
	}
}