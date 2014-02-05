<?php 
class weibo extends Front_Controller{
	public function __construct(){
		parent::__construct();
		// if(!$this->input->is_ajax_request()){
		// 	show_404();
		// }
		$this->load->model('Weibo_model');
		$this->uid = $this->session->userdata('uid');

	}
	/**
	 * 查询微博
	 */
	public function select(){

		$follow_arr=$this->db->select('follow')->get_where('follow',array('fans'=>$this->uid))->result_array();
		foreach ($follow_arr as $v) {
			$follow_id[]=current($v);
		}
		if(count($follow_id)){
			$this->db->where_in('weibo.uid', $follow_id);
		}
		$this->db->or_where(array('weibo.uid'=>$this->uid));
		$this->db->order_by("weibo.time", "desc")->limit(10,($s_id-1)*20);
		$this->db->join('weibo', 'user_info.uid = weibo.uid');
		$arr=array('username','avatar','domain','content','isturn','iscomment','time','praise','turn','collect','comment','weibo.uid');
		$weibo_list=$this->db->select($arr)->get('user_info')->result_array();

	
		foreach ($weibo_list as $k => $v) {
			$weibo_list[$k]['content']=$this->f_content($v['content']);
		}
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
			$_content=$this->f_content($content);
			$_time=date('Y-m-d H:i:s',$time);
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
}