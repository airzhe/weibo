<?php 
Class comment extends Front_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function inbox(){
		$this->data['title'] = '收到的评论';
		$this->view('comment_inbox',$this->data);
	}
	public function outbox(){
		$this->data['title'] = '发出的评论';
		$this->view('comment_outbox',$this->data);
	}

}
