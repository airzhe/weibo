<?php 
// 收藏 类
Class Collect extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '我的收藏';
		$this->uid=$this->session->userdata('uid');
		$this->load->library('weibo');
	}
	// 获取收藏列表
	public function index(){
		//取得收藏微博数据
		$this->select();
		$this->view('collect',$this->data);
	}
	// 获取收藏列表
	public function select(){
		$sql="SELECT `username`,`avatar`,`sex`,`domain`,w.`id`,`content`,`picture`,`isturn`,`iscomment`,w.`time`,`praise`,`turn`,`collect`,`comment`,w.`uid`
		FROM {$this->db->dbprefix}collect c
		JOIN {$this->db->dbprefix}weibo AS w ON c.wid = w.id
		JOIN {$this->db->dbprefix}user_info AS u ON w.uid = u.uid
		AND c.uid =$this->uid
		ORDER BY c.`time` DESC
		LIMIT 0 , 30";
		$weibo_list=$this->db->query($sql)->result_array();

		//如果为空则返回
		if(!count($weibo_list)) return;
		//获得微博配图
		foreach ($weibo_list as $key => $value) {
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
		//转发的原微博
		$arr=array('username','avatar','sex','domain','weibo.id','content','picture','isturn','iscomment','time','praise','turn','collect','comment','weibo.uid');
		$forward_arr=array();
		foreach ($weibo_list as $k => $v) {
			if($v['isturn']){
				$forward_arr[]=$v['isturn'];
			}
		}
		if(!empty($forward_arr)){
			$this->db->join('user_info', 'user_info.uid = weibo.uid');
			$_forward_list=$this->db->where_in('weibo.id',$forward_arr)->select($arr)->get('weibo')->result_array();
			$forward_list=array();
			foreach ($_forward_list as $k => $v) {
				$forward_list[$v['id']]=$v;
			}
			foreach ($forward_list as $key => $value) {
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
			$this->data['forward_list']=$forward_list;
		}
		// p($weibo_list);
		$this->data['weibo_list']=$weibo_list;
	}
}
