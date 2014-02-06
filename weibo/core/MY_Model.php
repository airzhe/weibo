<?php
class MY_Model extends CI_Model {
	
	protected $_table_name = '';
	protected $_primary_key = 'uid';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $rules = array();
	protected $_timestamps = FALSE;
	
	function __construct() {
		parent::__construct();
		// echo 'my_model';
	}
	
	/**
	 * 获得post数据，并进行安全验证
	 */
	public function array_from_post($fields){
		$data = array();
		foreach ($fields as $field) {
			$data[$field] = $this->input->post($field);
		}
		return $data;
	}
	/**
	 * 有id返回一条记录
	 * single为真，返回一条记录。
	 * 否则返回多条。
	 */
	public function get($id = NULL, $single = FALSE){
		
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row_array';
		}
		elseif($single == TRUE) {
			$method = 'row_array';
		}
		else {
			$method = 'result_array';
		}
		
		if ($this->_order_by) {
			$this->db->order_by($this->_order_by);
		}
		return $this->db->get($this->_table_name)->$method();
	}
	
	public function get_by($where, $single = FALSE){
		$this->db->where($where);
		return $this->get(NULL, $single);
	}
	

	/**
	 * insert
	 */

	public function add($data){
		
		// Set timestamps
		if ($this->_timestamps == TRUE) {
			$now = date('Y-m-d H:i:s');
			$data['created'] = $now;
		}
		
		// !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
		$this->db->set($data);
		$this->db->insert($this->_table_name);
		$id = $this->db->insert_id();
		return $id;
	}

	/**
	 * Update
	 */
	public function save($data, $id){
		
		// Set timestamps
		if ($this->_timestamps == TRUE) {
			$now = date('Y-m-d H:i:s');
			$data['modified'] = $now;
		}
		
		$filter = $this->_primary_filter;
		$id = $filter($id);
		$this->db->set($data);
		$this->db->where($this->_primary_key, $id);
		$this->db->update($this->_table_name);
		
		return $id;
	}

	/**
	 * delete
	 */
	public function delete($id){
		$filter = $this->_primary_filter;
		$id = $filter($id);
		
		if (!$id) {
			return FALSE;
		}
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
	}
	/**
	 * 值加1
	 */
	public function inc($field,$id,$num=1){
		$this->db->set("$field", "$field+$num", FALSE)->where($this->_primary_key, $id)->update($this->_table_name);
	}

	// /**
	//  * 值减1
	//  */
	// public function dec($field,$id,$num=1){
	// 	$this->db->set("$field", "$field-$num", FALSE)->where($this->_primary_key, $id)->update($this->_table_name);
	// }
	
}