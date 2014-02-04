<?php
/**
 * 微博用户关系表模型
 */
class Follow_model extends MY_Model {
	
	protected $_table_name = 'follow';
	// protected $_primary_key = 'id';
	// protected $_primary_filter = 'intval';
	// public $rules = array();
	
	function __construct() {
		parent::__construct();
	}
	//求 $uid和$id之间的关系，1:我关注他、2:我被他关注、3:相互关注
	public function relation($id){
		$uid = $this->session->userdata('uid');
		$where_1=array('follow'=>$id,'fans'=>$uid);
		$where_2=array('follow'=>$uid,'fans'=>$id);
		if($this->get_by($where_1,TRUE) && $this->get_by($where_2,TRUE)){
			return 3;
		}
		if($this->get_by($where_1,TRUE)) return 1;
		if($this->get_by($where_2,TRUE)) return 2;
		return 0;
	}
}