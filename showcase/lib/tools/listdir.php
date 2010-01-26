<?php
//define the path as relative
$path = $_GET['path'];
$showdir=null;
$showFiles=null;

if (isset($_GET['dirs'])){
	$showdir=1;
}
if (isset($_GET['files'])){
	$showfiles=1;
}

$scanPath='../../examples/'.$path;
$files = scandir($scanPath);

foreach ($files as $key=>$file)
{
	if(is_dir($scanPath.'/'.$file)){
		if(!$showdir)
			unset($files[$key]);

	}
	else{
		if(!$showfiles)
			unset($files[$key]);
	}
	if($file=="." ||$file==".."){
		unset($files[$key]);
	}
}

echo json_encode($files);
?>