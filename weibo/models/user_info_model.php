<?php
class User_info_model extends MY_Model {
	
	protected $_table_name = 'user_info';
	protected $_primary_key = 'uid';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'id';
	public $rules = array(
		'username' => array(
			'field' => 'username', 
			'label' => '昵称', 
			'rules' => 'trim|required|min_length[4]|max_length[24]|callback_username_check|is_unique[user_info.username]|xss_clean'
			),
		'birthday' => array(
			'field' => 'birthday[]',
			'label' => '生日', 
			'rules' => 'is_natural_no_zero|xss_clean'
			),
		'sex' => array(
			'field' => 'sex', 
			'label' => '性别', 
			'rules' => 'required|xss_clean'
			),
		'location' => array(
			'field' => 'location[]',
			'label' => '所在地',
			'rules' => 'callback_location_check|xss_clean'
			)
		);
	
	function __construct() {
		parent::__construct();
		$this->uid=(int)$this->uri->rsegment(3);
		if(!$this->uid)$this->uid=$this->session->userdata('uid');
	}
	/**
	 * 添加新用户信息
	 */
	public function insert($uid){
		// 获得表单信息
		$user_info_data=$this->array_from_post(array('username','birthday','sex','location'));
		$user_info_data['birthday']=$user_info_data['birthday'][0].'-'.$user_info_data['birthday'][1].'-'.$user_info_data['birthday'][2];
		$user_info_data['location']=serialize($user_info_data['location']);
		$user_info_data['uid']=$uid;
		// add
		$this->User_info_model->add($user_info_data);
	}
	/**
	 * 获得用户基本信息
	 */
	public function get_basic_info(){
		$arr=array('username','sex','avatar','domain','style','follow','fans','weibo');
		$this->db->select($arr);
		$data=$this->get($this->uid);
		return $this->format($data);
	}
	/**
	 * 获得用户详细信息
	 */
	public function get_detail_info($uid){
		$arr=array('username','truename','location','intro','sex','avatar','domain','style','follow','fans','weibo');
		$this->db->select($arr);
		$data=$this->get($uid);
		return count($data)?$this->format($data):null;
	}
	/**
	 * 格式化用户信息
	 */
	public function format($user){
		// 头像
		if($user['avatar']==''){
			$avatar=$user['sex']=='男'?'male_avatar':'female_avatar';
			$user['s_avatar']='';
			$user['m_avatar']=base_url("assets/images/{$avatar}_50.gif");
			$user['b_avatar']=base_url("assets/images/{$avatar}_180.gif");
			$user['avatar']=$user['b_avatar'];
		}else{
			$avatar=$user['avatar'];
			$user['avatar']=array();
			// 有值的时候不能像上面那样赋值，会像字符一样当数组从0开始算第一个元素
			$user['s_avatar']=base_url("images/avatar/30/{$avatar}");
			$user['m_avatar']=base_url("images/avatar/50/{$avatar}");
			$user['b_avatar']=base_url("images/avatar/180/{$avatar}");
			$user['avatar']=$user['b_avatar'];
		}
		// 性别
		$user['sex_ico']=$user['sex']=='男'?'male':'female';
		// 所在地
		if (isset($user['location'])) {
			$add=unserialize($user['location']);
			$user['location']=$add;
		}
		// 自定义域名
		if($user['domain']==''){
			$user['domain']=site_url("u/$this->uid");
		}else{
			$domain= $user['domain'];
			$user['domain']=site_url("$domain");
		}
		return $user;
	}
	/**
	 * 按昵称搜索用户
	 */
	public function search($keyword){
		$arr=array('uid','username','sex','avatar','location','intro','domain','style','follow','fans','weibo');
		$this->db->select($arr);
		$this->db->like(array('username'=>$keyword)); 
		return $this->db->get($this->_table_name)->result_array();
	}
	/**
	 * 推荐用户
	 */
	public function recommend_user(){
		return $this->db->select('uid,username,domain,fans')->order_by("fans", "desc")->limit(10)->get('user_info')->result_array();
	}
}