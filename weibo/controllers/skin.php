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
		$_suit=$this->input->post('suit');
		$_template=$this->input->post('template');
		$_cover=$this->input->post('cover');
		$_style=$this->input->post('style');
		// 分割字符串成数组 [0]为点击顺序[1]为要保存的id
		$suit=explode('#', $_suit);
		$template=explode('#', $_template);
		$cover=explode('#', $_cover);
		$style=explode('#', $_style);
		// 去除undefined,排序，赋值
		$arr=array('suit'=>$suit[0],'template'=>$template[0],'cover'=>$cover[0],'style'=>$style[0]);
		asort($arr);
		foreach ($arr as $key => $value) {
			if($value=='undefined') unset($arr[$key]);
		}
		foreach ($arr as $key => $value) {
			$_arr=$$key;
			$arr[$key]=$_arr[1];
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

		$style=serialize($arr);
		if($this->User_info_model->save(array('style'=>$style),$this->uid)){
			die(json_encode(array('status'=>1)));
		}
	}
}