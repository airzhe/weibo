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
		$this->uid=$this->session->userdata('uid');
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
		return $this->get($this->uid);
	}
	/**
	 * 按昵称搜索用户
	 */
	public function search($keyword){
		$arr=array('uid','username','sex','avatar','location','intro','domain','style','follow','fans','weibo');
		$this->db->select($arr);
		$this->db->like(array('username'=>$keyword)); 
		return $this->db->get_where($this->_table_name,array('uid !='=>$this->uid))->result_array();
	}
}