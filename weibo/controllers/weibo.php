<?php 
class weibo extends Front_Controller{
	public function __construct(){
		parent::__construct();
		if(!$this->input->is_ajax_request()){
			show_404();
		}
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
				p($at);
			}
			// 读取配置项获得表情数组
			$this->config->load('W_face', TRUE);
			$faces = $this->config->item('faces', 'W_face');
			foreach ($faces as $key=>$value) {
				$_faces[$key]='<img src="'.site_url("assets/images/hotFace/{$value}.gif").'">';
			}
			$_content=str_replace(array_keys($_faces),array_values($_faces),$content);
			$_time=date('Y-m-d H:i:s',$time);
			$data=array('status'=>1,'content'=>$_content,'time'=>$_time);
		};
		die(json_encode($data));
	}
}