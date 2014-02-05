<?php 
class weibo extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Weibo_model');
		$this->uid = $this->session->userdata('uid');

	}
	
	/**
	 * 发单条新微博
	 */
	public function send(){
		$content=$this->input->post('content');
		$len=getMessageLength($content);
		if($len==0 || $len>140){
			$data=array('status'=>0,'error'=>'微博长度应小与140');
		}else{
			//写入数据库
			$time=time();
			$weibo=array('content'=>$content,'time'=>$time,'uid'=>$this->uid);
			$this->Weibo_model->add($weibo);
			//微博总数+1
			$this->load->model('User_info_model');
			$this->User_info_model->inc('weibo',$this->uid);

			$preg='/(@.*?)\s/is';
			if(preg_match_all($preg, $content, $at)){
				//微博@
				// p($at);
			}
			$_content=$this->f_content($content);
			$_time=$this->f_time($time);
			$data=array('status'=>1,'content'=>$_content,'time'=>$_time);
		};
		die(json_encode($data));
	}
	/**
	 * 格式化微博内容 (替换表情文字)
	 * @param  string $content 微博内容
	 */
	public function f_content($content){
		// 读取配置项获得表情数组
		$this->config->load('W_face', TRUE);
		$faces = $this->config->item('faces', 'W_face');
		foreach ($faces as $key=>$value) {
			$_faces[$key]='<img src="'.site_url("assets/images/hotFace/{$value}.gif").'">';
		}
		$c=str_replace(array_keys($_faces),array_values($_faces),$content);
		return $c;
	}
	/**
	 * 格式化微博发布时间
	 * @param int $time 时间戳
	 */
	function f_time($time)
	{
		$time = intval($time);
		switch (true) {
			case time()-$time == 0:
				return '刚刚';
			case time()-$time < 60:
				return time()-$time.'秒前';
			case time()-$time < 3600:
				return floor((time()-$time)/60).'分钟前';
			case $time > strtotime(date('Y-m-d',time())):
				return '今天'.date('H:i',$time);
			default:
				return date('Y-m-d H:i',$time);
		}
	}
	/**
	 * 格式化微博内容
	 */
	public function format($user){
		foreach ($user as $k => $v) {
			// 头像
			if($v['avatar']==''){
				$user[$k]['avatar']=$v['sex']=='男'?'assets/images/male_avatar.gif':'assets/images/female_avatar.gif';
			}else{
				$user[$k]['avatar']='';
			}
			// 自定义域名
			if($v['domain']==''){
				$uid= $v['uid'];
				$user[$k]['domain']=site_url("u/$uid");
			}else{
				$domain= $v['domain'];
				$user[$k]['domain']=site_url("$domain");
			}
			// 性别
			if ($v['sex']) {
				$user[$k]['sex_ico']=$v['sex']=='男'?'male':'female';
			}
			// 所在地
			if (isset($v['location'])) {
				$add=unserialize($v['location']);
				$user[$k]['location']=implode('&nbsp;&nbsp;', $add);
			}
			// 微博内容
			if (isset($v['content'])) {
				$user[$k]['content']=$this->f_content($v['content']);
			}
			// 微博发表时间
			if (isset($v['time'])) {
				$user[$k]['time']=$this->f_time($v['time']);
			}
		}
		return $user;
	}
}