<?php 
class weibo{
	public function __construct(){
		$this->CI=& get_instance();
		$this->CI->load->model('Weibo_model');
		$this->CI->load->model('Comment_model');
		$this->CI->load->library('upload');
		$this->CI->load->library('image_lib');
		$this->CI->load->library('encry');
		$this->uid = $this->CI->session->userdata('uid');	
	}
	
	/**
	 * 发单条新微博
	 */
	public function send($turn=FALSE){

		$content=$this->CI->input->post('content');
		$img_arr=$this->CI->input->post('img');
		$len=getMessageLength($content);
		if($len==0 || $len>140){
			$data=array('status'=>0,'error'=>'微博长度应小于140');
		}else{
			//微博内容写入数据库
			$time=time();
			$weibo=array('content'=>$content,'time'=>$time,'uid'=>$this->uid);

			//记录微博配图数量
			if(is_array($img_arr) && count($img_arr)){
				$weibo+=array('picture'=>count($img_arr));
			}
			//如果是转发，记录转发id
			if($turn) {
				$isturn=$this->CI->input->post('isturn');
				$weibo+=array('isturn'=>$isturn);
			}

			//返回插入的id
			$id=$this->CI->Weibo_model->add($weibo);
			//微博配图写入数据库
			if(is_array($img_arr) && count($img_arr)){
				var_dump($img_arr);die;
				foreach ($img_arr as $v) {
					$img_data=array('wid'=>$id,'picture'=>$v);
					$this->CI->db->insert('picture', $img_data); 
				}
			}
			//微博总数+1
			$this->CI->load->model('User_info_model');
			$this->CI->User_info_model->inc('weibo',$this->uid);
			//如果是转发，被转发的微博转发数+1
			if($turn) $this->CI->Weibo_model->inc('turn',$isturn);
			//@某人 
			$preg='/(@.*?)\s/is';
			if(preg_match_all($preg, $content, $at)){
				//微博@
				// p($at);
			}
			$_content=$this->f_content($content);
			$_time=$this->f_time($time);
			$data=array('status'=>1,'id'=>$id,'content'=>$_content,'time'=>$_time);
			if($turn) $data+=array('_wid'=>$this->CI->encry->encrypt($isturn));
		};
		die(json_encode($data));
	}
	/**
	 * 微博图片处理
	 */
	public function image(){
		$avatar=$_FILES['Filedata'];
		if($avatar['error']==0 and is_uploaded_file($avatar['tmp_name'])){
			$info = pathinfo($avatar['name']);
			// 路径
			$upload_path='images/content/large/'.date("Ym").'/';
			is_dir($upload_path) || mkdir($upload_path,0777,TRUE);
			// 文件名
			$file_name=time().mt_rand(0,1000).'.'.$info['extension'];

			// 配置项
			$config['upload_path'] = $upload_path;
			$config['file_name'] = $file_name;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			// 默认0,系统配置文件中上传大小,单位k
			$config['max_size'] = '2000';
			$config['max_width']  = '2024';
			$config['max_height']  = '2024';
			$this->CI->upload->initialize($config);
			
			if ($this->CI->upload->do_upload('Filedata'))
			{
				$arr=$this->CI->upload->data();
				$img=$config['upload_path'].$arr['file_name'];
				//缩放图片为large、bmiddle、thumbnail、square
				$this->zoom($img);
				//裁切图片为80*80方形图
				$img=$this->crop($img);
				die($img);
			}else{
				echo $this->CI->upload->display_errors();
				die;
			}
		}
	}
	/**
	 * 缩放微博图片
	 */
	public function zoom($img){
		if(!is_file($img)) return;

		$file_name=basename($img);
		$arr=explode('/',$img);
		$new_path=$arr[0].'/'.$arr[1].'/';

		$info=getimagesize($img);
		// p($info);die;

		//原图1024,大图440,中图120,小图80
		$images=array(
			'thumbnail'=>array('w'=>120,'h'=>120),
			'bmiddle'	=>array('w'=>440,'h'=>440/$info[0]*$info[1]),
			'large'=>array('w'=>1024,'h'=>1024),
			'square'=>array('w'=>80,'h'=>80)
			);
		//配置缩放参数
		$config['source_image'] = $img;
		$config['maintain_ratio'] = TRUE;

		foreach ($images as $k => $v) {
			$path=$new_path.$k.'/'.$arr[3];
			is_dir($path) || mkdir($path,0777,TRUE);
			if($k=='large' || $k=='thumbnail' ){
				if($info[0]>$v['w'] || $info[1]>$v['h']) {
					// 原图、单张图宽高最大值固定
					$config['width'] = $v['w'];
					$config['height'] = $v['h'];
				}
			}elseif($k=='bmiddle'){
				if($info[0]>$v['w']) {
					// 大图宽度固定
					$config['width'] = $v['w'];
					$config['height'] = $v['h'];
				}
			}else{
				// 方形图，缩放图像到宽高80比例
				if($info[0]<$info[1]){
					//宽度小于高度
					$config['width'] = $v['w'];
					$config['height']=$v['w']/$info[0]*$info[1];
				}else{
					//高度小于大于宽度
					$config['width']=$v['h']/$info[1]*$info[0];
					$config['height'] = $v['h'];
				}
			}
			$config['new_image'] = $path.'/'.$file_name;
			$this->CI->image_lib->initialize($config);
			$this->CI->image_lib->resize();
			// 重置宽高参数
			$config['width']=$config['height']=0;
		}
	}
	/**
	 * 裁切图片为80*80方形图
	 */
	public function crop($img){
		$img=str_replace('large', 'square', $img);
		if(!is_file($img)) return;
		$info=getimagesize($img);

		$config['source_image'] = $img;
		$config['maintain_ratio'] = FALSE;
		$config['width']=80;
		$config['height']=80;

		if($info[0]>$info[1]){
			//图片宽度大于高度
			$config['x_axis']=($info[0]-80)/2;
			$config['y_axis']=0;
		}else{
			//图片高度大于等于宽度
			$config['x_axis']=0;
			$config['y_axis']=($info[1]-80)/2;
		}
		
		$this->CI->image_lib->initialize($config);
		$this->CI->image_lib->crop();
		return $img;
	}
	/**
	 * 评论微博
	 */
	public function comment(){
		$wid=$this->CI->input->post('wid');
		$content=$this->CI->input->post('content');
		$isreplay=$this->CI->input->post('isreplay');
		$len=getMessageLength($content);
		if($len==0 || $len>140){
			$data=array('status'=>0,'error'=>'评论长度应小于140');
		}else{
			$time=time();
			$comment=array('uid'=>$this->uid,'content'=>$content,'isreplay'=>$isreplay,'wid'=>$wid,'time'=>$time);
			if($id=$this->CI->Comment_model->add($comment)){
				// 微博评论总数+1
				$this->CI->Weibo_model->inc('comment',$wid);
				//@某人
				$preg='/(@.*?)\s/is';
				if(preg_match_all($preg, $content, $at)){
					//微博@
					// p($at);
				}
				$_content=$this->f_content($content);
				$_time=$this->f_time($time);
				$data=array('status'=>1,'id'=>$id,'content'=>$_content,'time'=>$_time);
			}
		}
		die(json_encode($data));
	}
	/**
	 * 格式化微博内容 (替换表情文字)
	 * @param  string $content 微博内容
	 */
	public function f_content($content){
		// 读取配置项获得表情数组
		$this->CI->config->load('W_face', TRUE);
		$faces = $this->CI->config->item('faces', 'W_face');
		foreach ($faces as $key=>$value) {
			$_faces[$key]='<img src="'.base_url("assets/images/hotFace/{$value}.gif").'">';
		}
		$c=str_replace(array_keys($_faces),array_values($_faces),$content);
		return $c;
	}
	/**
	 * 格式化微博发布时间
	 * @param int $time 时间戳
	 */
	function f_time($time)
	{
		$time = intval($time);
		switch (true) {
			case time()-$time < 60:
			return '刚刚';
			case time()-$time < 3600:
			return floor((time()-$time)/60).'分钟前';
			case $time > strtotime(date('Y-m-d',time())):
			return '今天'.date('H:i',$time);
			default:
			return date('Y-m-d H:i',$time);
		}
	}
	/**
	 * 格式化微博内容
	 */
	public function format($user){
		foreach ($user as $k => $v) {
			// 头像
			if($v['avatar']==''){
				$user[$k]['avatar']=$v['sex']=='男'?base_url('assets/images/male_avatar_50.gif'):base_url('assets/images/female_avatar_50.gif');
			}else{
				$avatar=$user[$k]['avatar'];
				$user[$k]['avatar']=array();
				// 有值的时候不能像上面那样赋值，会像字符一样当数组从0开始算第一个元素
				$user[$k]['s_avatar']=base_url("images/avatar/30/{$avatar}");
				$user[$k]['m_avatar']=base_url("images/avatar/50/{$avatar}");
				$user[$k]['b_avatar']=base_url("images/avatar/180/{$avatar}");
				$user[$k]['avatar']=$user[$k]['m_avatar'];
			}
			// 自定义域名
			if($v['domain']==''){
				$uid= $v['uid'];
				$user[$k]['domain']=site_url("u/$uid");
			}else{
				$domain= $v['domain'];
				$user[$k]['domain']=site_url("$domain");
			}
			// 性别
			if (isset($v['sex'])) {
				if ($v['sex']) {
					$user[$k]['sex_ico']=$v['sex']=='男'?'male':'female';
				}
			}
			// 所在地
			if (isset($v['location'])) {
				$add=unserialize($v['location']);
				$user[$k]['location']=implode('&nbsp;&nbsp;', $add);
			}
			// 微博内容，可能是评论内容，私信内容
			if (isset($v['content'])) {
				$user[$k]['content']=$this->f_content($v['content']);
			}
			// 微博内容
			if (isset($v['weibo'])) {
				$user[$k]['weibo']=$this->f_content($v['weibo']);
			}
			// 微博发表时间
			if (isset($v['time'])) {
				$user[$k]['time']=$this->f_time($v['time']);
			}
		}
		return $user;
	}
}