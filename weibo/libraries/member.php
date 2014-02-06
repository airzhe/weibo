<?php 
class member{
	public function __construct(){
		$this->CI=& get_instance();
		$this->uid = $this->CI->session->userdata('uid');
	}
	/**
	 * follow 添加关注
	 */
	public function follow(){
		$this->CI->load->model('Follow_model');
		$follow_id=$this->CI->input->post('follow_id');
		$this->CI->Follow_model->add(array('follow'=>$follow_id,'fans'=>$this->uid));
		//关注总数+1
		$this->CI->load->model('User_info_model');
		$this->CI->User_info_model->inc('follow',$this->uid);

		//被关注者粉丝数+1
		$this->CI->User_info_model->inc('fans',$follow_id);
		$data['status']=1;
		die(json_encode($data));
	}
	/**
	 * 获取关注的用户
	 */
	public function get_follow(){

		$follow_arr=$this->CI->db->select('follow')->get_where('follow',array('fans'=>$this->uid))->result_array();
		$follow_id=array();
		foreach ($follow_arr as $v) {
			$follow_id[]=current($v);
		}
		if(count($follow_id)){
			$this->CI->db->where_in('uid', $follow_id);
		}
		$arr=array('username','sex','intro','avatar','domain','uid');
		return $this->CI->db->select($arr)->get('user_info')->result_array();
	}
}