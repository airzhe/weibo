<?php
class User_model extends MY_Model {
	
	protected $_table_name = 'user';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	// protected $_order_by = 'id';
	public $rules = array();
	protected $_timestamps = FALSE;
	
	function __construct() {
		parent::__construct();
	}

	/**
	 * 判断用户是否登录
	 * return bool
	 */
	public function loggedin(){
		return false;
	}
}