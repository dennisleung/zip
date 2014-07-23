<?php

header("Content-type:text/html;charset=utf-8");

$number = $_GET["user_num"];

$mysqli = new mysqli('localhost','root',"");

if($mysqli){
	$mysqli->query("set names 'utf8'");
	$result = $mysqli->query("SELECT * FROM zip.activity WHERE `number`='".$number."'");
	if(mysqli_num_rows($result)==0){
		echo "没有找到记录！";
	}
	else{
		for($i = 0;$i<mysqli_num_rows($result);$i++){
			$record = $result->fetch_array();
			echo "<input type=\"checkbox\" name=\"activity\" value=\"".$record["activity"]."\">&nbsp;&nbsp;".$record["activity"]."</br>";
		}
		echo "</br><center>"
		."<button class=\"btn btn-success btn-sm\" onclick=\"selectAll();\">全选</button>"
		."&nbsp;&nbsp;&nbsp;&nbsp;"
		."<button class=\"btn btn-danger btn-sm\" onclick=\"selectNone();\">全不选</button>"
		."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		."<button class=\"btn btn-default\" onclick=\"zipFile();\">打包下载</button>"
		."</center>";
	}

	$mysqli->close();

}


?>