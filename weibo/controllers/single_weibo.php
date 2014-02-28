<?php 
/**
 * 单条微博处理类
 */
Class single_weibo extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = 'airzhe的微博';
		$this->data['body_class'] = 'home';
		$this->uid=$this->session->userdata('uid');
		$this->load->model('Comment_model');
		$this->load->model('Weibo_model');
		$this->load->library('weibo');
		// 加密类
		$this->load->library('encry');
	}
	public function index(){
		die('此功能尚未开放...');
		$this->view('single_weibo',$this->data);
	}
	/**
	* 读取评论列表
	*/
	public function select_comment($source=NULL){
		
		$wid=$this->input->post('id');

		//获得评论总数
		$count=$this->db->where(array('wid'=>$wid))->from('comment')->count_all_results();
		//没有评论就返回
		if(!($count))
			die(json_encode(array('status'=>1)));
		//取得分页数据
		$per_page=20;
		if($source=='item') $per_page=10;
		$_comment=$this->db->query("select c.id,`username`,`avatar`,`domain`,`content`,`time`,c.uid from `{$this->db->dbprefix}user_info` as info join (select * from `{$this->db->dbprefix}comment` where `wid`= $wid) as c on info.uid=c.uid order by time desc limit {$per_page}")->result_array();
		//格式化评论内容
		$comment=$this->weibo->format($_comment);
		//删除评论
		if($this->db->where(array('id'=>$wid,'uid'=>$this->uid))->from('weibo')->count_all_results()){
			#自己的微博客评论都可以删
			foreach ($comment as $k => $v) {
				$comment[$k]['me']=TRUE;
			}
		}else{
			#别人的微博只能删自己的评论
			foreach ($comment as $k => $v) {
				if($v['uid']==$this->uid){
					$comment[$k]['me']=TRUE;
				}
			}
		}

		$arr=array('status'=>1,'result'=>$comment,'count'=>$count);
		//评论条数超过10条就返回加密后的wid
		if($count>10){
			//获得用户id
			$_uid=$this->db->select('uid')->get_where('weibo',array('id'=>$wid))->row_array();
			$_wid=$this->encry->encrypt($wid);
			$arr+=array('url'=>current($_uid).'/Ay'.$_wid);
		}
		die(json_encode($arr));
	}
	/**
	* 发表评论
	*/
	public function send_comment(){
		$this->weibo->comment();
	}
	/**
	* 删除评论
	*/
	public function del_comment(){
		$id=$this->input->post('cid');
		$_wid=$this->db->select('wid')->get_where('comment',array('id'=>$id))->row_array();
		$wid=current($_wid);

		$me=FALSE;
		if($this->db->where(array('id'=>$wid,'uid'=>$this->uid))->from('weibo')->count_all_results()){
			#自己的微博
			if($this->Comment_model->delete($id)){
				$me=TRUE;
			}
		}else{
			#别人的微博
			$_uid=$this->db->select('uid')->get_where('weibo',array('id'=>$wid))->row_array();
			$uid=current($_uid);
			//如果这条评论是我发出的评论
			if($uid=$this->uid){
				if($this->Comment_model->delete($id)){
					$me=TRUE;
				}
			}

		}
		// 微博表微博评论总数-1
		if($me){
			$this->Weibo_model->inc('comment',$wid,'-1');
			die(json_encode(array('status'=>1)));
		}
	}

	/**
	* 转发微博
	*/
	public function turn(){
		$this->weibo->send($turn=TRUE);
	}
	/**
	 * 收藏微博
	 */
	public function collect(){
		$wid=$this->input->post('id');
		$this->load->model('Collect_model');
		$data=array('uid'=>$this->uid,'wid'=>$wid);
		if(!$this->db->where($data)->from('collect')->count_all_results()){
			$data+=array('time'=>time());
			if($this->Collect_model->add($data)){
				die(json_encode(array('status'=>1)));
			}
		}else{
			die(json_encode(array('status'=>1)));
		}
	}
	/**
	 * 取消收藏
	 */
	public function del_collect(){
		$wid=$this->input->post('id');
		$arr=array('uid'=>$this->uid,'wid'=>$wid);
		$this->db->where($arr)->delete('collect');
		if($this->db->affected_rows()){
			die(json_encode(array('status'=>1)));
		}
	}

	/**
	 * 赞
	 */
	public function praise(){
		$wid=$this->input->post('id');
		$this->load->model('Praise_model');
		$data=array('uid'=>$this->uid,'wid'=>$wid);
		if(!$this->db->where($data)->from('praise')->count_all_results()){
			$data+=array('time'=>time());
			if($this->Praise_model->add($data)){
				die(json_encode(array('status'=>1)));
			}
		}else{
			die(json_encode(array('status'=>1)));
		}
	}
	/**
	 * 取消赞
	 */
	public function del_praise(){
		$wid=$this->input->post('id');
		$arr=array('uid'=>$this->uid,'wid'=>$wid);
		$this->db->where($arr)->delete('praise');
		if($this->db->affected_rows()){
			die(json_encode(array('status'=>1)));
		}
	}


}