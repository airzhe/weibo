<?php 
class Common extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->uid=$this->session->userdata('uid');
	}
	/**
	 * 获取用户消息提醒队列
	 * @return [type] [description]
	 */
	public function get_msg(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->load->driver('cache', array('adapter' => 'file'));
		$arr=array('status'=>1);
		$msg=array();
		if($data=$this->cache->get('usermsg_'.$this->uid)){
			//最新动态
			if($data['news']){
				$news=$data['news'];
			}
			if($data['comment']){
				$msg+=array('1'=>$data['comment']);
			}
			if($data['letter']){
				$msg+=array('2'=>$data['letter']);
			}
			if($data['at']){
				$msg+=array('3'=>$data['at']);
			}
		}
		if(count($msg)) $arr['msg']=$msg;
		if(isset($news)) $arr['news']=$news;
		die(json_encode($arr));
	}
	/**
	 * 清空评论,@消息提醒队列
	 * @return [type] [description]
	 */
	public function flush_msg(){
		set_msg($this->uid,1,TRUE);
		set_msg($this->uid,3,TRUE);
	}
	/**
	 * 清空主页新微博提醒队列
	 * @return [type] [description]
	 */
	public function flush_news(){
		set_msg($this->uid,0,TRUE);
	}
}