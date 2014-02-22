<?php
header("Content-type:text/html;charset=utf8");
/**
 * 格式化输出数组
 */
function p($arr){
	echo '<pre>'.print_r($arr,true).'</pre>';
}
/**
 * 操作成功提示并跳转函数
 * @param string $msg 提示信息
 * @param string $url 要跳转的地址，默认浏览器后退。
 */
function success($msg,$url=null){
	$url=$url?"location.href='".site_url($url)."'":"window.history.go(-1)";
	$html=<<<str
	{$msg}
<script>
setTimeout(function(){
	{$url}
},1000)
</script>
str;
	echo $html;
	die;
}
/**
 * 操作失败提示并跳转函数
 * @param string $msg 提示信息
 * @param string $url 要跳转的地址，默认浏览器后退。
 */
function error($msg,$url=null){
	$url=$url?"location.href='".site_url($url)."'":"window.history.go(-1)";
	$html=<<<str
	{$msg}
<script>
setTimeout(function(){
	{$url}
},1000)
</script>
str;
	echo $html;
	die;
}
/**
 * 检测微博长度
 * @param string $b 要检测的内容
 */
function getMessageLength ($b) { 
	$preg="@[^\x{00}-\x{80}]@u";
	if(preg_match_all($preg, $b,$a)){
		$len=strlen($b)-count($a[0]);
		return ceil($len/2);
	}else{
		return strlen($b);
	}
}