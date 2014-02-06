<?php 
Class follow extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '我关注的人';
		$this->load->model('User_info_model');
		$this->load->library('member');
	}
	public function index(){
		$this->load->library('weibo');
		$_myfollow_list=$this->member->get_follow();
		// 用户关系表
		$this->load->model('Follow_model');
		foreach ($_myfollow_list as $k => $v) {
			// 关系
			$_myfollow_list[$k]['relation']=$this->Follow_model->relation($v['uid']);
		}
		$myfollow_list=$this->weibo->format($_myfollow_list);
		$this->data['myfollow_list']=$myfollow_list;
		$this->view('follow',$this->data);
	}
	public function cancle_follow(){
		
	}
}
