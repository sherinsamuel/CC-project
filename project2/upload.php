<?php

// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif','zip');
//require_once __DIR__.'/argv-parser.php';
require_once __DIR__.'/WebHDFS/WebHDFS.php';
require 'vendor/autoload.php';

use Google\Cloud\Storage\StorageClient;

$storage = new StorageClient();

$bucket = $storage->bucket('my_bucket');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}

$storage = new StorageClient(['keyFilePath'=>__DIR__.'/secret/key.json']);
$my_bucket = "sheru-ka-bucket";
$fileName = $_FILES['upl']['name'];
$fileType = $_FILES['upl']['type'];
$fileSize = $_FILES['upl']['size'];
$fileTempLoc = $_FILES['upl']['tmp_name'];
$bucket = $storage->bucket($my_bucket);
$fl = fopen($fileTempLoc,'r');
$bucket->upload($fl,['name'=>$fileName]);
$object = $bucket->object($fileName);
  // echo __DIR__."/data/".$fileName.'<br>';
     // var_dump($object);
$object->downloadToFile(__DIR__.'/uploads/'.$fileName);
//$storage->registerStreamWrapper();
//$contents = file_get_contents('gs:\/\/sheru-ka-bucket/'.$fileName);

$hdfs = new WebHDFS('104.155.234.246', 9870);
$hdfs->put('/uploads/'.$fileName, file_get_contents('uploads/'.$fileName,'r'));
//$hdfs->put('/uploads/'.$fileName, $content);
fclose($fl);
//unlink(__DIR__.'/uploads/*') or die("Couldn't delete file");
array_map('unlink', array_filter((array) glob(__DIR__."/uploads/*")));

echo '{"status":"success"}';
exit;

}

echo '{"status":"error"}';
exit;
