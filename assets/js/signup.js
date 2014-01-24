$(document).ready(function(){
	//生日
	var myDate = new Date();
	$("#dateSelector").DateSelector({
		ctlYearId: 'idYear',
		ctlMonthId: 'idMonth',
		ctlDayId: 'idDay',
		defYear: myDate.getFullYear(),
		defMonth: (myDate.getMonth()+1),
		defDay: myDate.getDate(),
		minYear: 1900,
		maxYear: (myDate.getFullYear()+1)
	});

	//地区
	$.cxSelect.defaults.url="assets/js/city.min.js";
	$("#city").cxSelect({
		selects:["province","city","area"],
		nodata:"none"
	});
	// 获取焦点时清空输框默认value
	$('[name=account]').focus(function(){
		if($(this).val()=='请输入您的常用邮箱')	$(this).val('');
	})
	
})