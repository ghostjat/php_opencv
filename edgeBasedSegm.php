<?php 

require __DIR__ . '/vendor/autoload.php';

$cv = new openCv\core();
$cv->init_legacy();
$cv->namedwindow();
$cv->namedwindow();
$capture = $cv->createCameraCapture();
if(!$cv->grabFrame($capture)){
	echo 'Error no camera detected!';
	return -1;
}
else{
    $img = $cv->queryFrame($capture);
    $segImage = $cv->createImage($img->width, $img->height, $img->depth, $img->nChannels);
    $segImage->origin = $img->origin;
    while (true) {
        $img = $cv->queryFrame($capture);
        $cv->segmentImage($img, $segImage);
        $cv->showImage($segImage, true);
        $cv->waitKey(40);
    }
}

$cv->destroyAllWindows();