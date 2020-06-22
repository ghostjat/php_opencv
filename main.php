<?php 

if (!extension_loaded("FFI")) {
	die("FFI extension required\n");
}

require 'vendor/autoload.php';

use openCv\core;

$cv = new core();
$cv->namedwindow();
$cv->moveWindow();
$cv->showImage('tmp/test.jpg');
$cv->close();
$cv->waitKey();
$cv->destroyWindow($cv::WND_TITLE);

