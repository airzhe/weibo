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
				// 头像
				if($user[$k]['avatar']==''){
					$user[$k]['avatar']=$user[$k]['sex']=='男'?'male_avatar':'female_avatar';
				}else{
					$user[$k]['avatar']='';
				}
				// 性别
				$user[$k]['sex_ico']=$user[$k]['sex']=='男'?'male':'female';
				// 所在地 
				$add=unserialize($user[$k]['location']);
				$user[$k]['location']=implode('&nbsp;&nbsp;', $add);
				// 自定义域名
				if($user[$k]['domain']==''){
					$uid=$user[$k]['uid'];
					$user[$k]['domain']=site_url("u/$uid");
				}else{
					$domain=$user[$k]['domain'];
					$user[$k]['domain']=site_url("$domain");
				}
				// 关系
				$user[$k]['relation']=$this->Follow_model->relation($user[$k]['uid']);

			}

			// p($user);
			$this->data['user']=$user;
		}
	
		$this->partial('components/header',$this->data);
		$this->partial('search');
	}
}
