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
		$result=array();
		$result[1]=$this->get_by(array('follow'=>$id,'fans'=>$uid),TRUE);
		$result[2]=$this->get_by(array('follow'=>$uid,'fans'=>$id),TRUE);
		if($result[1] && $result[2]){
			return 3;
		}
		if($result[1]) return 1;
		if($result[2]) return 2;
		return 0;
	}
}