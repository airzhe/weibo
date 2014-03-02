<?php
/**
 * index页面控制器
 */
Class index extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '我的首页';
		$this->data['body_class'] = 'index';
		$this->uid=$this->session->userdata('uid');
		$this->load->model('User_info_model');
		$this->load->model('Follow_model');
		$this->load->library('weibo');
		$this->config->load('W_weibo', TRUE);
		// 分配自定义模板
		$this->set_skin();
	}
	public function index(){
		//清空新微博客消息提醒
		set_msg($this->uid,0,TRUE);
		//取得用户基本信息
		$user=$this->User_info_model->get_basic_info();
		//取得微博数据
		$this->select();
		//载入分页配置文件
		$this->_page();
		//推荐用户
		$recommend_user=$this->_recommend_user();
		
		$this->data['user']=$user;
		$this->data['recommend_user']=$recommend_user;
		$this->view('index',$this->data);
	}
	/**
	 * 查询所有关注人的微博列表
	 */
	public function select(){
		$weibo_list=$this->_select_weibo_list();
		$forward_list=$this->_select_forward_list($weibo_list);
		
		// 如果是ajax请求输出json数据，否则赋值给$this->data
		if(!$this->input->is_ajax_request()){
			if(count($weibo_list))   $this->data['weibo_list']=$weibo_list;
			if(count($forward_list)) $this->data['forward_list']=$forward_list;
			
		}else{
			//加载更多
			$arr=array('status'=>1);
			if(count($weibo_list)) 	 $arr['weibo_list']=$weibo_list;
			if(count($forward_list)) $arr['forward_list']=$forward_list;
			if($time=$this->input->post('time')) $arr['_time']=$this->weibo->f_time($time);
			die(json_encode($arr));
		}
	}
	private function _select_weibo_list(){
		// 如果是ajax请求,每次读取5条记录，否则读取10条
		if(!$this->input->is_ajax_request()){		
			$start=0;
			$offset=10;
		}else{
			//加载好友新微博
			if($offset=$this->input->post('offset')){
				$start=0;
			}else{
				//加载更多
				//=============================测试代码===============================
				sleep(1);
				$start=$this->input->post('start');
				$offset=5;
			}
		}
		//配置每次读取数量
		$this->per_page=$this->config->item('index_per_page', 'W_weibo');
		$current_page=$this->input->get('p')?$this->input->get('p'):1;
		//分配当前面页面开始id
		$this->data['weibo_start']=($current_page-1)*$this->per_page+$offset;
		//第一页时跳转到根url
		// if($this->uri->segment(1)=='page' and $current_page==1) redirect(site_url());
		//配置关联查询条件
		$start=($current_page-1)*$this->per_page+$start;
		$sql="SELECT `username`,`avatar`,`sex`,`domain`,`content`,`picture`,`isturn`,`iscomment`,`time`,`praise`,`turn`,`collect`,`comment`,w.`id`,w.`uid`
		FROM `{$this->db->dbprefix}weibo` w
		JOIN (
			SELECT `follow` uid
			FROM `{$this->db->dbprefix}follow`
			WHERE `fans` =$this->uid
			) AS f ON w.uid = f.uid 
OR w.uid =$this->uid
JOIN `{$this->db->dbprefix}user_info` u
ON w.uid=u.uid
ORDER BY w.time DESC
LIMIT $start,$offset";
$weibo_list=$this->db->query($sql)->result_array();
		//如果为空则返回
if(!count($weibo_list)) return;
		//获得微博配图
foreach ($weibo_list as $key => $value) {
	//标记微博客是否是我的微博
	if($value['uid']==$this->session->userdata('uid')){
		$weibo_list[$key]['me']=TRUE;
	}
	$pic_count=$value['picture'];
	if($pic_count){
		$_pic=$this->db->get_where('picture',array('wid'=>$value['id']))->result_array();
		$weibo_list[$key]['pic']=$_pic;
				//分配图片路径
		if($pic_count==1){
			$weibo_list[$key]['pic_path']='images/content/thumbnail/';
		}else{
			$weibo_list[$key]['pic_path']='images/content/square/';
			if($pic_count==2 || $pic_count==4){
				$weibo_list[$key]['pic_class']='lotspic_list inner_width';
			}else{
				$weibo_list[$key]['pic_class']='lotspic_list';
			}
		}
	}
}
$weibo_list=$this->weibo->format($weibo_list);
// p($weibo_list);
return $weibo_list;
}
private function _select_forward_list($weibo_list){
		//转发的原微博
	$forward_arr=array();
	foreach ($weibo_list as $k => $v) {
		if($v['isturn']){
			$forward_arr[]=$v['isturn'];
		}
	}
	$forward_list=array();
	if(empty($forward_arr)) return;
	$arr=array('username','avatar','sex','domain','content','picture','isturn','iscomment','time','praise','turn','collect','comment','weibo.id','weibo.uid');
	$this->db->join('user_info', 'user_info.uid = weibo.uid');
	$_forward_list=$this->db->where_in('weibo.id',$forward_arr)->select($arr)->get('weibo')->result_array();
	if(empty($_forward_list)) return;
	foreach ($_forward_list as $k => $v) {
		$forward_list[$v['id']]=$v;
	}
	foreach ($forward_list as $key => $value) {
		$forward_list[$key]=$this->weibo->f_url($value);
		$pic_count=$value['picture'];
		if($pic_count){
			$_pic=$this->db->get_where('picture',array('wid'=>$value['id']))->result_array();
			$forward_list[$key]['pic']=$_pic;
				//分配图片路径
			if($pic_count==1){
				$forward_list[$key]['pic_path']='images/content/thumbnail/';
			}else{
				$forward_list[$key]['pic_path']='images/content/square/';
				if($pic_count==2 || $pic_count==4){
					$forward_list[$key]['pic_class']='lotspic_list inner_width';
				}else{
					$forward_list[$key]['pic_class']='lotspic_list';
				}
			}
		}
	}
	$forward_list=$this->weibo->format($forward_list);
	return $forward_list;
}
	/**
	 * 发单条新微博
	 */
	public function send(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->weibo->send();
	}
	/**
	 * 新微博图片处理 包括上传、裁切、缩放
	 */
	public function image(){
		$this->weibo->image();	
	}
	/**
	 * 分页
	 */
	private function _page(){
		// 查询条件
		$sql="SELECT COUNT( * ) 
		FROM `{$this->db->dbprefix}weibo` w
		JOIN (
			SELECT `follow` uid
			FROM `{$this->db->dbprefix}follow`
			WHERE `fans` =$this->uid
			) AS f ON w.uid = f.uid
OR w.uid =$this->uid";
		//分页
$_count=$this->db->query($sql)->row_array();
$count=current($_count);
$this->load->library('pagination');
$config['total_rows'] = $count;
$config['per_page'] = $this->config->item('index_per_page', 'W_weibo');
$config['use_page_numbers'] = TRUE;
$config['full_tag_open'] = '<p id="page" class="page hide">';
$this->pagination->initialize($config);
$this->data['page']= $this->pagination->create_links();		
}
	/**
	 * 删除一条微博
	 */
	public function delete(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$id=$this->input->post('id');
		$this->load->model('Weibo_model');
		$this->db->where(array('id'=>$id,'uid'=>$this->uid))->delete('weibo');

		if($this->db->affected_rows()){
			//删除微博配图文件
			$picture=$this->db->select('picture')->get_where('picture',array('wid'=>$id))->result_array();
			foreach ($picture as $v) {
				$path='images/content/';
				foreach (array('large','bmiddle','thumbnail','square') as $_v) {
					@unlink($path.$_v.'/'.$v['picture']);
				}
			}
			//删除微博配图数据库记录
			$this->db->where(array('wid'=>$id))->delete('picture');
			//用户微博数量 -1
			$this->User_info_model->inc('weibo',$this->uid,'-1');
			die(json_encode(array('status'=>1)));
		}
		die(json_encode(array('status'=>0)));
	}
	/**
	 * 推荐用户
	 */
	private function _recommend_user(){
		$user=$this->User_info_model->recommend_user();
		foreach ($user as $k => $v) {
			if($v['domain']){
				$domain= $v['domain'];
				$user[$k]['domain']=site_url($domain);
			}else{
				$uid= $v['uid'];
				$user[$k]['domain']=site_url("u/$uid");
			}
		}
		return $user;
	}
}