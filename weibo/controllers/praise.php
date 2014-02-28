<?php 
Class praise extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '收到的赞';
		$this->load->library('weibo');
	}
	public function index(){
		//收到的赞
		$sql="SELECT p.time, u.username, u.avatar, u.domain, weibo.id ,weibo.content weibo
		FROM {$this->db->dbprefix}praise AS p
		JOIN (
			SELECT id, content
			FROM {$this->db->dbprefix}weibo
			WHERE uid =10000
		) AS weibo ON p.wid = weibo.id
		JOIN {$this->db->dbprefix}user_info AS u ON p.uid = u.uid
		ORDER BY p.time DESC 
		LIMIT 0 , 30";
		$praise=$this->db->query($sql)->result_array();
		$praise=$this->weibo->format($praise);

		foreach ($praise as $key => $value) {
			$value['uid']=$this->session->userdata('uid');
			$praise[$key]=$this->weibo->f_url($value);
		}
		$this->data['praise']=$praise;
		$this->view('praise',$this->data);
	}
}
