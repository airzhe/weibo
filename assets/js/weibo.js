$(function(){
	/**	
	* 点击表情按钮，调出表情对话框
	*/
	$("[action-type='face']").on('click',function(){
		$(this).callface();
		//ajax请求表情gif地址
		$.ajax(
		{
			url:face_url,
			success:function(data){
				$('.faces_list').html(data);
			}
		})
	})

})