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
		$source=$this->CI->input->post('source');//关注的来源
		$this->CI->Follow_model->add(array('follow'=>$follow_id,'fans'=>$this->uid,'time'=>time(),'source'=>$source));
		//关注总数+1
		$this->CI->load->model('User_info_model');
		$this->CI->User_info_model->inc('follow',$this->uid);
		//被关注者粉丝数+1
		$this->CI->User_info_model->inc('fans',$follow_id);
		$data['status']=1;
		die(json_encode($data));
	}
	/**
	 * 通过原生sql获取关注的用户
	 */
	public function get_follow($uid=NULL){
		if(is_null($uid)) $uid=$this->uid;
		return $this->CI->db->query("select `username`, `sex`, `intro`, `avatar`, `domain`, `uid`,follow.time,follow.source from (select follow,time,source from {$this->CI->db->dbprefix}follow where  fans={$uid} ) as follow join {$this->CI->db->dbprefix}user_info as user_info on user_info.uid=follow.follow order by `time` desc")->result_array();
	}
	/**
	 * 获取粉丝信息
	 */
	public function get_fans($uid=NULL){
		if(is_null($uid)) $uid=$this->uid;
		return $this->CI->db->query("select `username`, `sex`, `intro`, `location`, `avatar`,`domain`, user_info.follow,user_info.fans,`weibo`,`uid`,follow.time,follow.source from (select fans,time,source from {$this->CI->db->dbprefix}follow where  follow={$uid} ) as follow join {$this->CI->db->dbprefix}user_info as user_info on user_info.uid=follow.fans order by `time` desc")->result_array();
	}
	/**
	 * 取消关注
	 */
	public function cancle_follow(){
		$follow_id=$this->CI->input->post('follow_id');
		$follow_id=explode(',',$follow_id);
		// p($follow_id);die;
		//删除关注记录
		$this->CI->db->where(array('fans'=>$this->uid))->where_in('follow',$follow_id);
		$this->CI->db->delete('follow');
		//关注数量减1
		$this->CI->load->model('User_info_model');
		$this->CI->User_info_model->inc('follow',$this->uid,'-'.count($follow_id));
		//对方粉丝数减1
		$this->CI->db->where_in('uid',$follow_id);
		$this->CI->db->set('fans', "fans-1",FALSE);
		$this->CI->db->update('user_info'); 		
		
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
	/**
	 * 发私信
	 */
	public function letter(){
		
		$this->CI->load->library('form_validation');
		$this->CI->form_validation->set_rules('username', 'username', 'trim|required|max_length[300]|xss_clean');
		$this->CI->form_validation->set_rules('content', 'content', 'trim|required|max_length[300]|xss_clean');

		if ($this->CI->form_validation->run() == TRUE) {
			
			$content=$this->CI->input->post('content');
			$uid=$this->CI->input->post('uid');

			$data=array('from'=>$this->uid,'content'=>$content,'time'=>time(),'uid'=>$uid);
			if($this->CI->db->insert('letter',$data)){
				//将私信提醒写入缓存
				set_msg($uid,2);
				die(json_encode(array('status'=>1)));
			}
		}
		die(json_encode(array('status'=>0)));
	}
}