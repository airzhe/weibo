<?php 
Class skin extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('User_info_model');
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

		// 查找数据库，比较原来数据和新数据，找出新数据不存在与老数据的数据。和新数据合并，存入数据库。
		$_befor_arr=$this->db->select('style')->get_where('user_info',array('uid'=>$this->uid))->row_array();
		$befor_arr=unserialize(current($_befor_arr));
		if($befor_arr){
			// 查找第二个数组不在第一个数组中的键
			$diff_arr=array_diff_key($befor_arr,$arr);
			// 反转数组，把最新的操作放最后遍历
			$arr=array_merge($diff_arr,$arr);
		}
		$newdata = array('style'  => $arr);
		$this->session->set_userdata($newdata);
		$style=serialize($arr);
		
		if($this->User_info_model->save(array('style'=>$style),$this->uid)){
			die(json_encode(array('status'=>1)));
		}
	}
}
