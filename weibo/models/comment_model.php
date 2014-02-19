<?php
/**
 * 微博用户关系表模型
 */
class Comment_model extends MY_Model {
	
	protected $_table_name = 'comment';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	// public $rules = array();
	
	function __construct() {
		parent::__construct();
	}
}