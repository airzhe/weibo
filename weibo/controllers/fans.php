<?php 
Class fans extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '关注我的人';
		$this->load->library('member');
	}
	public function index(){
		if($_myfans_list=$this->member->get_fans()){
			// 用户关系表
			$this->load->model('Follow_model');
			foreach ($_myfans_list as $k => $v) {
			// 关系
				$_myfans_list[$k]['relation']=$this->Follow_model->relation($v['uid']);
			}
			$this->load->library('weibo');
			$myfans_list=$this->weibo->format($_myfans_list);
			$this->data['myfans_list']=$myfans_list;
			$this->data['fans_total']=count($myfans_list);

		}else{
			$this->data['fans_total']=0;
		}
		//关注总数
		if($follow_list=$this->member->get_follow()){
			$this->data['follow_total']=count($follow_list);
		}else{
			$this->data['follow_total']=0;
		}
		$this->view('fans',$this->data);
	}
	// 粉丝页面加关注事件
	public function follow(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->load->library('member');
		$this->member->follow();
	}
	/**
	 * 移除关注
	 */
	public function remove(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->member->remove_fans();
	}
}
