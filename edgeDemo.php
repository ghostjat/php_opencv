<?php

require __DIR__ . '/vendor/autoload.php';

$cv = new openCv\core();
$cv->namedwindow();
$capture = $cv->createCameraCapture();
if(!$cv->grabFrame($capture)){
	echo 'Error no camera detected!';
	return -1;
}
$img = $cv->queryFrame($capture);

$grayImg = $cv->createImage($img->width,$img->height,$img->depth,1);
$grayImg->origin = $img->origin;

$edgeImg = $cv->createImage($img->width, $img->height, $img->depth, 1);
$edgeImg->origin = $img->origin;

$keepProcessing = true;

$cv->grabFrame($capture);

while ($keepProcessing){
    $Img = $cv->queryFrame($capture);
    $cv->cvtColor($Img, $grayImg, $cv::CV_BGR2GRAY);
    $cv->canny($grayImg, $edgeImg);
    $cv->showImage($edgeImg, true);
    
    $key = $cv->waitKey(40);
    #if($key === 'x');{
    #    print("Keyboard exit requested : exiting now - bye!\n");
    #    $keepProcessing = false;
    #}
    $cv->grabFrame($capture);
}

$cv->destroyWindow($cv::WND_TITLE);