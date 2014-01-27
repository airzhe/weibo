<?php
class User_model extends MY_Model {
	
	protected $_table_name = 'user';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	public $rules = array(
		'code' => array(
			'field' => 'code', 
			'label' => '验证码', 
			'rules' => 'trim|required|exact_length[4]'
			),
		'account' => array(
			'field' => 'account', 
			'label' => '用户名', 
			'rules' => 'trim|required|valid_email|is_unique[user.account]|xss_clean'
			),
		'passwd' => array(
			'field' => 'passwd', 
			'label' => '密码', 
			'rules' => 'trim|required|min_length[6]|max_length[16]|xss_clean'
			)
		);
	
	function __construct() {
		parent::__construct();
	}

	/**
	 * 判断用户是否登录
	 * return bool
	 */
	public function loggedin(){
		return true;
	}
	/**
	 * 密码加密函数
	 * 返回128位长度字符
	 */
	public function hash ($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}
}