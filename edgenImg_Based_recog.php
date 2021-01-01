<?php 

require __DIR__ . '/vendor/autoload.php';

$imagesCollected = 0;
$recognitionStage = false;

$cv = new openCv\core();
$cv->init_legacy();
$cv->namedwindow();

$font = $cv->font();
$cv->initFont($font);

$capture = $cv->createCameraCapture();
if(!$cv->grabFrame($capture)){
	echo 'Error no camera detected!';
	return -1;
}
else{
    $img = $cv->queryFrame($capture);
    $grayImage = $cv->createImage($img->width, $img->height, $img->depth, 1);
    $grayImage->origin = $img->origin;
    while (true) {
        $img = $cv->queryFrame($capture);
        $cv->flip($img, null, 1);
        if($img->nChannels > 1){
            $cv->cvtColor($img, $grayImage, $cv::CV_BGR2GRAY);
        }
        else{
            $grayImage = $img;
        }
        if(!$recognitionStage){
            $cv->putText($img, 'Sample Collection', $cv->cvPoint(10, $img->height - 20), $font , $cv->cvRGB(0, 255, 0));
        }
        else{
            $cv->putText($img, 'Recognition', $cv->cvPoint(10, $img->height-20), $font, $cv->cvRGB(0, 255, 0));
        }
        
        $cv->showImage($img, true);
        $cv->waitKey(40);
    }
}

$cv->destroyAllWindows();