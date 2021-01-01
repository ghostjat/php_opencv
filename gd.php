<?php

require __DIR__ . '/vendor/autoload.php';

$cv = new openCv\core();
$cv->object_detect_init();

$file = 'data/haarcascade_frontalface_alt.xml';
$cascade = FFI::cast($cv->ffi_objD->type('CvHaarClassifierCascade*'), $cv->cvload($file));

$storage = FFI::cast($cv->ffi_objD->type('CvMemStorage*'), $cv->createMemStorage());

$img = $cv->loadImage('/home/ghost/Pictures/11.jpg',$cv::CV_LOAD_IMAGE_COLOR);

$garyImg = $cv->createImage($img->width,$img->height,$img->depth,1);
$garyImg->origin = $img->origin;

detecFaces($garyImg);


function detecFaces($image) {
    global $cv, $cascade, $storage;
    $faces = $cv->haarDetectObjects($image, $cascade, $storage);
    #$img = imagecreatefromjpeg('/home/ghost/Pictures/IMG-15.jpg');
    #$green = imagecolorallocate($img, 0, 255, 0);
    
    #for ($i = 0; $i < $faces; $i++) {
    #    $rect = $cv->getSeqElem($faces, $i);
    #    print "x= $rect->x, y= $rect->y, x1= $rect->x + $rect->width, y1= $rect->y + $rect->height";
    #}
    print_r($faces);
    echo PHP_EOL;
    #return $cord;#imagejpeg($img,'tmp/objd.jpg');
}
