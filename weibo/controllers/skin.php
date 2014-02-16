<?php 
Class skin extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->uid=$this->session->userdata('uid');
	}
	public function index(){
		echo 'index';
	}
	public function save(){
		// 获取js传递过来的参数
		$suit=$this->input->post('suit');
		$template=$this->input->post('template');
		$cover=$this->input->post('cover');
		$style=$this->input->post('style');
		// 分割字符串成数组 [0]为点击顺序[1]为要保存的id
		$suit_arr=explode('#', $suit);
		$template_arr=explode('#', $template);
		$cover_arr=explode('#', $cover);
		$style_arr=explode('#', $style);

		$arr=array('suit'=>$suit_arr[0],'template'=>$template_arr[0],'cover'=>$cover_arr[0],'style'=>$style_arr[0]);
		asort($arr);
		$arr=array('suit'=>$suit_arr[1],'template'=>$template_arr[1],'cover'=>$cover_arr[1],'style'=>$style_arr[1]);
		foreach ($arr as $key => $value) {
			if($value=='undefined') unset($arr[$key]);
		}
		$style=serialize($arr);
		$this->load->model('User_info_model');
		if($this->User_info_model->save(array('style'=>$style),$this->uid)){
			die(json_encode(array('status'=>1)));
		}
	}
}
