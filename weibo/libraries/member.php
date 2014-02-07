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
		$from=$this->CI->input->post('from');//关注的来源
		$this->CI->Follow_model->add(array('follow'=>$follow_id,'fans'=>$this->uid,'time'=>time(),'from'=>$from));
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
		$follow_arr=$this->CI->db->order_by("time", "desc")->select('follow')->get_where('follow',array('fans'=>$this->uid))->result_array();
		if(count($follow_arr)){
			$follow_id=array();
			foreach ($follow_arr as $v) {
				$follow_id[]=current($v);
			}
			$this->CI->db->where_in('uid', $follow_id);
			$arr=array('username','sex','intro','avatar','domain','uid');
			return $this->CI->db->select($arr)->get('user_info')->result_array();
		}
	}
	/**
	 * 获取粉丝信息
	 */
	public function get_fans(){
		$fans_arr=$this->CI->db->select('fans')->get_where('follow',array('follow'=>$this->uid))->result_array();
		if(count($fans_arr)){
			$fans_id=array();
			foreach ($fans_arr as $v) {
				$fans_id[]=current($v);
			}
			$this->CI->db->where_in('uid', $fans_id);
			$arr=array('username','sex','intro','location','avatar','domain','follow','fans','weibo','uid');
			return $this->CI->db->select($arr)->get('user_info')->result_array();
		}
	}
	/**
	 * 取消关注
	 */
	public function cancle_follow(){
		$follow_id=$this->CI->input->post('follow_id');
		//删除关注记录
		$this->CI->db->where(array('follow'=>$follow_id,'fans'=>$this->uid));
		$this->CI->db->limit(1);
		$this->CI->db->delete('follow');
		//关注数量减1
		$this->CI->load->model('User_info_model');
		$this->CI->User_info_model->inc('follow',$this->uid,'-1');
		//对方粉丝数减1
		$this->CI->User_info_model->inc('fans',$follow_id,'-1');
		
		$data['status']=1;
		die(json_encode($data));
	}
	/**
	 * 移除关注
	 */
	public function remove_fans(){
		$fans_id=$this->CI->input->post('fans_id');
		//删除被关注记录
		$this->CI->db->where(array('follow'=>$this->uid,'fans'=>$fans_id));
		$this->CI->db->limit(1);
		$this->CI->db->delete('follow');
		//粉丝数量减1
		$this->CI->load->model('User_info_model');
		$this->CI->User_info_model->inc('fans',$this->uid,'-1');
		//对方关注数减1
		$this->CI->User_info_model->inc('follow',$fans_id,'-1');

		$data['status']=1;
		die(json_encode($data));
	}
	
}