<?php 
// 单条微博处理类
Class single_weibo extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = 'airzhe的微博';
		$this->data['body_class'] = 'home';
		$this->uid=$this->session->userdata('uid');
		$this->load->model('Comment_model');
	}
	public function index(){
		$this->view('single_weibo',$this->data);
	}
	//读取评论列表
	public function select_comment($source=NULL){
		$per_page=20;
		if($source=='item') $per_page=10;
		$wid=$this->input->post('id');
		$comment="select * from t_comment where wid= $wid";
		$comment[]=array('id'=>1000,'avatar'=>'ss','username'=>'地瓜哥','content'=>'恩，说实话我对这块专门看过一些资料。所以问的比较多。哈哈','time'=>'1月5日 22:07');
		// p($comment);
		$arr=array('status'=>1,'result'=>$comment);
		die(json_encode($arr));
	}
	//发表评论
	public function send_comment(){

		$wid=$this->input->post('wid');
		$content=$this->input->post('content');
		$isreplay=$this->input->post('isreplay');

		$data=array('uid'=>$this->uid,'content'=>$content,'isreplay'=>$isreplay,'wid'=>$wid,'time'=>time());
		
		if($this->Comment_model->add($data)){
			die(json_encode(array('status'=>1)));
		}
		die(json_encode(array('status'=>0)));
	}
	// 由
}
