
<?php
require_once __DIR__.'/WebHDFS/WebHDFS.php';
//if(isset($_POST['update']))
//{
	$hdfs = new WebHDFS('104.155.234.246', 9870);
	$response = $hdfs->ls('/uploads');
	$response = $response['FileStatuses'];
	$response = $response['FileStatus'];
	$files_name = array();
//	print_r($response);
	foreach ($response as $file) {
		foreach($file as $key=>$value){
		if($key=='pathSuffix'){
			array_push($files_name,$value);
		}
	}
	}
	//$data->files=$files_name;
	echo json_encode($files_name);
//	print_r($files_name);
//}

?>
