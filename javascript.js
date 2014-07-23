
var number;
var check = function(){
	number = $("#user_num").val();
	if(number==""){
		alert("请输入你的学号！");
	}
	else{
		var xmlhttp;
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}
		else{
			xmlhttp = new ActiveXobject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				$("#show_result").html(unescape(xmlhttp.responseText));
			}
		}
		xmlhttp.open("GET","search.php?user_num="+number,true);
		xmlhttp.send();
	}
}


var selectAll = function(){
	$("input[type=checkbox]").prop("checked",true);
}

var selectNone = function(){
	$("input[type=checkbox]").prop("checked",false);
}

var zipFile = function(){
	if(confirm("确定要下载所选记录吗？")){
		records = $("input[type=checkbox]:checked");
		relocate = "zip.php?records=";
		rname = new Array();
		if(records.length==0){
			alert("你还未选择任何记录！");
			return;
		}
		for(i=0;i<records.length;i++){/
			rname.push($(records[i]).val());
		}
		relocate = relocate + rname + "&user_num=" + number;
		$("#download").prop("src",relocate);
	}
}