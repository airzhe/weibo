<?php 
Class letter extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('weibo');
		$this->uid=$this->session->userdata('uid');
	}
	public function index(){
		$this->data['title'] = '我的私信';
		$this->data['body_class'] = 'letter';
		$sql="SELECT u.`uid`, u.`username`, u.`avatar`, u.`sex`, u.`domain`,l.`content`,l.`time`
		FROM t_user_info u JOIN(
			SELECT * 
			FROM (SELECT * FROM t_letter ORDER BY `time` desc ) `temp`
			WHERE uid = $this->uid
			GROUP BY  `from`
			ORDER BY TIME DESC 
			) AS l ON  u.uid = l.from ";
		$letter_list=$this->db->query($sql)->result_array();
		$letter_list=$this->weibo->format($letter_list);
		if(count($letter_list)) $this->data['letter_list']=$letter_list;
		$this->view('letter',$this->data);
	}

	public function lists(){
		$this->data['title'] = '私信对话';
		$this->view('letter_list',$this->data);
	}
}
