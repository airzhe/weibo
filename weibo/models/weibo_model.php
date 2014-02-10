<?php
/**
 * 微博表模型类
 */
class Weibo_model extends MY_Model {
	
	protected $_table_name = 'weibo';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	public $rules = array();
	
	function __construct() {
		parent::__construct();
	}
	
	// public function get_list($uid){
	// 	p($t)
	// }
}