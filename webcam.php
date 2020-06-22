<?php

require_once __DIR__.'/vendor/autoload.php';

use openCv\core;

$cv = new core();
$cv->namedwindow();
$capture = $cv->createCameraCapture();
if(!$cv->grabFrame($capture)){
    print "error \n";
    exit;
}
while(1){
    $img = $cv->queryFrame($capture);
    $cv->showImage($img,true);
    $cv->waitKey(40);
    $cv->grabFrame($capture);
}
$cv->destroyWindow($cv::WND_TITLE);

