<?php 
// 用户验证类
Class verify extends Front_Controller{
	public function __construct(){
		parent::__construct();
	}
	/**
	 * 邮箱验证
	 * @return [type] [description]
	 */
	public function email(){
		$this->load->library('email');

		$this->email->from('your@example.com', 'Your Name');
		$this->email->to('someone@example.com'); 
		$this->email->cc('another@another-example.com'); 
		$this->email->bcc('them@their-example.com'); 

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.'); 

		$this->email->send();

		echo $this->email->print_debugger();
	}
}
