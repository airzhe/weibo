<?php
 class Code{
	//图像资源
	private $img;
	//验证码宽度
	public $width=100;
	//验证码高度
	public $height=30;
	//文字颜色
	private $font_color_res;
	//验证码种子
	public $code_str = "123456789abcdefghijklmnpq";
	//字体文件
	public $font='';
	//字体大小
	public $font_size=16;
	//字体颜色 
	public $font_color = "#387398";
	//验证码数量
	public $num=4;
	//构造函数  $w:宽度  $h:验证码高度
	public function __construct($w=null,$h=null,$font_size=16){
		$this->width=$w?$w:$this->width;
		$this->height=$h?$h:$this->height;
		$this->font_size=$font_size;
	}
	public function show(){
		//创建画布
		$img = imagecreatetruecolor($this->width, $this->height);
		imagefill($img, 0,0, imagecolorallocate($img, 255,255,255));
		$this->img = $img;
		//向验证码中写入文字
		$this->write_font();
		//绘制干扰线 
		// $this->create_pix();
		// header("Content-type:image/png");
		imagepng($this->img);
	}
	//向图片绘制杂线
	private function create_pix(){
		for($i=0;$i<3;$i++){
			imageline($this->img, mt_rand(0,$this->width), 
				mt_rand(0,$this->height), mt_rand(0,$this->width), 
				mt_rand(0,$this->height), $this->font_color_res);
		}
		for($i=0;$i<2;$i++){
			imageEllipse($this->img,mt_rand(0,$this->width), 
				mt_rand(0,$this->height),100,100,$this->font_color_res);
		}
		for($i=0;$i<100;$i++){
			imagesetpixel($this->img,mt_rand(0,$this->width), 
				mt_rand(0,$this->height), $this->font_color_res);
		}
		imageRectangle($this->img,0,0,
			$this->width-1,$this->height-1,$this->font_color_res);
	}
	private function write_font(){
		//获得文字颜色 
		$color = $this->get_color($this->font_color);
		$this->font_color_res =$color;
		$len = strlen($this->code_str);
		//每一字占空间宽度
		$w = $this->width/$this->num;
		$this->code_str = strtoupper($this->code_str);
		$s = "";
		for($i=0;$i<$this->num;$i++){
			//随机取一验证码字符串的位置
			$index = mt_rand(0,$len-1);
			$c =$this->code_str[$index];
			$s.=$c;
			imagettftext($this->img, $this->font_size,
			mt_rand(-20,20), $i*$w+5, $this->height*0.8, $color, 
				$this->font, $c);
		}
		$_SESSION['code']=$s;
	}
	//16进制转RGB
	private function get_color($color){
		$red =  hexdec(substr($color,1,2));
		$green =hexdec(substr($color,3,2));
		$blue = hexdec(substr($color,5,2));
		return imagecolorallocate($this->img, $red, $green, $blue);
	}

}












