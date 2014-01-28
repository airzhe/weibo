<?php
class User_info_model extends MY_Model {
	
	protected $_table_name = 'user_info';
	protected $_primary_key = 'id';
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
	}
	
}