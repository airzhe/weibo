<?php 
Class set extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("User_info_model");
		$this->uid=$this->session->userdata('uid');
	}
	/**
	 * 修改个人信息
	 */
	public function info(){
		$this->data['title'] = '个人信息';

		$this->view('set/index',$this->data);
	}
	/**
	 * 修改用户头像
	 */
	public function avatar(){
		$this->data['title'] = '头像设置';
		$this->data['body_class'] = 'avatar';
		$user=$this->User_info_model->get_detail_info($this->uid);
		$this->data['avatar']=$user['avatar'];
		$this->view('set/avatar',$this->data);
	}
	/**
	 * 修改用户密码
	 */
	public function security(){
		$this->data['title'] = '帐号安全';
		$this->view('set/security',$this->data);
	}

}
