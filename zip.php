<?php

$records = explode(",",$_GET["records"]);
$number = $_GET["user_num"];


$zip = new ZipArchive();
$zipname = "temp/".$number.".zip";
if(!file_exists($zipname)){
	$zip->open($zipname,ZipArchive::OVERWRITE);
	for($i=0;$i<count($records);$i++){
		$filepath = "records/".$records[$i].".jpg";
		$filepath = iconv("UTF-8","GBK",$filepath);
		echo $filepath."</br>";
		if(file_exists($filepath)){
			$zip->addFile($filepath,iconv("UTF-8","GBK",$records[$i].".jpg"));
		}
	}
	$zip->close();
	if(file_exists($zipname)){
		$file = fopen($zipname,"r");
		Header("Content-type:application/octet-stream");
		Header("Accept-Ranges:bytes");
		Header("Accept-length:".filesize($zipname));
		Header("Content-Disposition:attachment;filename=".$number.".zip");
		$buffer = 1024;
		while(!feof($file)){
			$file_data = fread($file,$buffer);
			echo $file_data;
		}

		fclose($file);
		unlink($zipname);
	}
	else{
		echo "<script>alert('对不起，你下载的文件不存在！')</script>";
	}
}





?>