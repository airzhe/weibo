<?php 
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
},2000)
</script>
str;
	echo $html;
}
/**
 * 操作失败提示并跳转函数
 * @param string $msg 提示信息
 * @param string $url 要跳转的地址，默认浏览器后退。
 */
function error($msg,$url=null){
	$url=is_null($url)?"window.history.go(-1)":"location.href='".base_url($url)."'";
	$html=<<<str
<div style="background:#f2dede;color:#b94a48;border:1px solid #eed3d7;padding:20px;"><h2>:( $msg</h2></div>
<script>
	setTimeout(function(){
		{$url}
	},2000)
</script>
str;
	echo $html;
	die();
}