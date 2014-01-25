<?php
class User_info_model extends MY_Model {
	
	protected $_table_name = 'user_info';
	protected $_primary_key = 'uid';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'id';
	public $rules = array();
	
	function __construct() {
		parent::__construct();
	}
	
}