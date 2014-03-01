<?php 
/**
 * 私信类
 */
Class letter extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('weibo');
		$this->uid=$this->session->userdata('uid');
	}
	//私信预览
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
			) AS l ON  u.`uid` = l.`from` ";
			
			$letter_list=$this->db->query($sql)->result_array();
			$letter_list=$this->weibo->format($letter_list);
			if(count($letter_list)) $this->data['letter_list']=$letter_list;
			$this->view('letter',$this->data);
	}
	/**
	 * 私信详情列表
	 * @param  [type] $uid [description]
	 * @return [type]      [description]
	 */
	public function lists($uid=NULL){
		$this->data['title'] = '私信对话';
		$username=$this->db->select('username')->get_where('user_info',array('uid'=>$uid))->row_array();
		if(empty($username)) return;
		$username=current($username);
		$sql="SELECT u.`uid`, u.`username`, u.`avatar`, u.`sex`, u.`domain`, l.`content` , l.`time` 
		FROM t_user_info u JOIN (
			SELECT * 
			FROM  `t_letter` 
			WHERE uid =$this->uid
			AND  `from` =$uid
			OR uid =$uid
			AND  `from` =$this->uid
			) AS l ON u.`uid` = l.`from` 
		ORDER BY TIME DESC 
		LIMIT 0 , 30";
		$letter_list=$this->db->query($sql)->result_array();
		foreach ($letter_list as $k => $v) {
			if($v['uid']==$this->uid){
				$letter_list[$k]['class']='me';
			}else{
				$letter_list[$k]['class']='ta';
			}
		}
		$letter_list=$this->weibo->format($letter_list);
		if(count($letter_list)) $this->data['letter_list']=$letter_list;
		$this->data['user']=array('uid'=>$uid,'username'=>$username);
		//私信消息提醒总数清空
		set_msg($this->uid,2,TRUE);
		$this->view('letter_list',$this->data);
	}
}
