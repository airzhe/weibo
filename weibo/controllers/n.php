<?php 
// 获取用户昵称，重定向到用户主页
Class N extends Front_Controller{
	public function __construct(){
		parent::__construct();
	}
	/**
	 * 根据用户昵称重定向到用户主页
	 * @param  [type] $username [description]
	 */
	public function index($username){
		$username = urldecode($username);
		$preg='@^[a-zA-Z0-9_\-\x{4e00}-\x{9fa5}]+$@u';
		if(preg_match($preg, $username)){
			$user=$this->db->select('uid,domain')->get_where('user_info',array('username'=>$username))->row_array();
			if($user['domain']){
				redirect($site_url.$user['domain']);
			}else{
				redirect($site_url.'u/'.$user['uid']);
			}
		}else{
			die('用户名不存在');
		}
	}
	
}
