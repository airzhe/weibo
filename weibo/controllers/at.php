<?php 
// at 类
Class at extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '@我的微博';
		$this->uid=$this->session->userdata('uid');
		$this->load->library('weibo');
	}
	// 获取at列表
	public function index(){
		//取得at微博数据
		$this->select();

		$this->view('at',$this->data);
	}
	// 获取at列表
	public function select(){
		$sql="SELECT `username`,`avatar`,`sex`,`domain`,w.`id`,`content`,`picture`,`isturn`,`iscomment`,`time`,`praise`,`turn`,`collect`,`comment`,w.`uid`,a.`id` atid
		FROM {$this->db->dbprefix}at a
		JOIN {$this->db->dbprefix}weibo AS w ON a.wid = w.id
		JOIN {$this->db->dbprefix}user_info AS u ON w.uid = u.uid
		AND a.uid =$this->uid
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
		$this->data['weibo_list']=$weibo_list;
	}
	/**
	 * [删除at我的信息数据]
	 */
	public function delete(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$id=$this->input->post('id');

		//记录所属用户id
		$count=$this->db->where(array('id'=>$id,'uid'=>$this->uid))->from('at')->count_all_results();
		if($count){
			$this->db->where(array('id'=>$id))->delete('at');
			if($this->db->affected_rows()){
				die(json_encode(array('status'=>1)));
			}
		}
		die(json_encode(array('status'=>0)));
	}
}
