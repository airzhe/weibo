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
	 * 添加用户
	 */
	public function insert ()
	{
		// 获取注册账户密码
		$data=$this->array_from_post(array('account','passwd'));
		$data['passwd']=$this->hash($data['passwd']);
		$data['regis_time']=time();
		// add
		if($uid=$this->User_model->add($data)){
			$data=array(
				'uid'=>$uid,
				'account'=>$data['account'],
				'username'=>$this->input->post('username'),
				'loggedin' => TRUE
				);
			$this->session->set_userdata($data);
			return $uid;
		}
	}
	/**
	 * 用户登录验证
	 * 产生session
	 */
	public function login(){
		$data=$this->array_from_post(array('account','passwd'));
		$data['passwd']=$this->User_model->hash($data['passwd']);
		$user=$this->get_by($data,TRUE);
		if(count($user)){
			// Log in user
			$username=$this->db->select('username')->get_where('user_info',array('uid'=>$user['id']))->row_array();
			$data=array(
				'uid'=>$user['id'],
				'account'=>$user['account'],
				'username'=>current($username),
				'loggedin' => TRUE
				);
			$this->session->set_userdata($data);
			return TRUE;
		}
	}
	/**
	 * 判断用户是否登录
	 * return bool
	 */
	public function loggedin(){
		return (bool) $this->session->userdata('loggedin');
	}
	/**
	 * 安全退出
	 */
	public function logout ()
	{
		$this->session->sess_destroy();
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