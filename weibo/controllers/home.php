<?php 
Class home extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['body_class'] = 'home';
		$this->load->model("User_info_model");
		$this->uid=$this->session->userdata('uid');
	}
	// 我的主页
	public function index(){
		$this->user($this->uid);
	}
	// 用户信息
	public function user($uid){
		$user=$this->User_info_model->get_detail_info($uid);
		if(empty($user)){
			show_404();
		}
		$this->data['title'] = $user['username'].'的微博|';
		if($uid==$this->uid){
			$user['me']=TRUE;
			$user['call']='我';
		}else{
			$user['call']=$user['sex']=='男'?'他':'她';
		}
		$user['avatar']=$user['avatar']['big'];
		//载入分页配置文件
		$this->config->load('W_weibo', TRUE);
		// $this->page();
		// $this->select();
		$this->data['user']=$user;
		$this->view('home',$this->data);
	}
}