<?php
/**
 * 收到的评论，发出的评论类
 */
Class comment extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->uid=$this->session->userdata('uid');
		$this->load->library('weibo');
	}
	public function inbox(){
		$this->data['title'] = '收到的评论';
		$sql="SELECT c.content, c.isreplay,c.time, u.uid,u.username,u.sex, u.avatar, u.domain, weibo.content weibo 
		FROM {$this->db->dbprefix}comment AS c
		JOIN (
			SELECT id, content
			FROM {$this->db->dbprefix}weibo
			WHERE uid =$this->uid
		) AS weibo ON c.wid = weibo.id
		JOIN {$this->db->dbprefix}user_info AS u ON c.uid = u.uid
		ORDER BY c.time desc";
		$comment=$this->db->query($sql)->result_array();
		// p($comment);
		$comment=$this->weibo->format($comment);
		$this->data['comment']=$comment;
		$this->view('comment_inbox',$this->data);
	}
	public function outbox(){
		$this->data['title'] = '发出的评论';
		$sql="SELECT avatar, username, domain, w.content weibo, c.id,c.content, c.time
		FROM {$this->db->dbprefix}comment AS c
		JOIN {$this->db->dbprefix}weibo AS w ON c.wid = w.id
		JOIN {$this->db->dbprefix}user_info AS u ON w.uid = u.uid
		AND c.uid =$this->uid
		ORDER BY c.time desc";
		$comment=$this->db->query($sql)->result_array();
		$comment=$this->weibo->format($comment);
		$this->data['comment']=$comment;
		$this->view('comment_outbox',$this->data);
	}

}