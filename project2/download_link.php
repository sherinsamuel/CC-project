<?php
require_once __DIR__.'/WebHDFS/WebHDFS.php';
//if(isset($_POST['down_link']))
$down_file=$_POST['down_link'];
ini_set('display_errors','On');
//        $down_file = "aadhar.jpg";
	$hdfs = new WebHDFS('104.155.234.246', 9870);
        $response = $hdfs->cat('/uploads/'.$down_file);

	$myfile = fopen("uploads/".$down_file, "wb") or die("Unable to open file!");
if (false === $myfile) {
    throw new RuntimeException('Unable to open log file for writing');
}
$bytes=fwrite($myfile, $response);
//printf('Wrote %d bytes to %s', $bytes, realpath('uploads/'.$down_file));
fclose($myfile);
	echo "done";
//}
?>
