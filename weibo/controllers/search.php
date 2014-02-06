<?php 
Class search extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '微博搜索';
		$this->data['body_class'] = 'search';
		$this->data['keyword']='';
		$this->load->model('User_info_model');
	}
	public function index(){
		$keyword=trim($this->input->get('searchInput'));
		if($keyword){
			$this->data['keyword']=$keyword;
			$user=$this->User_info_model->search($keyword);
			
			// 用户关系表
			$this->load->model('Follow_model');
			foreach ($user as $k => $v) {
				// 关系
				$user[$k]['relation']=$this->Follow_model->relation($v['uid']);

			}
			$this->load->library('weibo');
			$user=$this->weibo->format($user);

			// p($user);
			$this->data['user']=$user;
		}
	
		$this->partial('components/header',$this->data);
		$this->partial('search');
	}
	// 搜索页面加关注事件
	public function follow(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->load->library('member');
		$this->member->follow();
	}
}
