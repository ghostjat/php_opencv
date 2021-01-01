<?php

require __DIR__ . '/vendor/autoload.php';

$keepProcessing = true;

$cv = new openCv\core();
$cv->init_legacy();
$cv->namedwindow();
$cv->namedwindow('Scene Change');

$capture = $cv->createCameraCapture();

if (!$cv->grabFrame($capture)) {
    echo 'Error no camera detected!';
    return -1;
}
 else {
    $img = $cv->queryFrame($capture);
    $prev = $cv->cloneImage($img);
    $diff = $cv->createImage($img->width, $img->height, $img->depth,1);
    $diff->origin = $img->origin;
    
    while($keepProcessing){
        $img = $cv->queryFrame($capture);
        $cv->copy($img, $prev);
        $cv->changeDetection($prev, $img, $diff);
        $cv->ffi->cvShowImage($cv->window_Title[0],$img);
        $cv->ffi->cvShowImage($cv->window_Title[1],$diff);
        $cv->waitKey(40);
    }
}

$cv->destroyAllWindows();