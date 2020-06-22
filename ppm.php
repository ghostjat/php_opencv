<?php 

if (!extension_loaded("FFI")) {
	die("FFI extension required\n");
}

require 'vendor/autoload.php';

use openCv\core;

$cv = new core();
$imgDir = glob('/home/ghost/projects/ai/rubix/CIFAR-10/data/person/*.ppm');
$i= 0;
foreach ($imgDir as $img) {   
    $image = $cv->loadImage($img);
    if($cv->saveFrame("/home/ghost/projects/ai/rubix/CIFAR-10/data/person/$i.jpg", $image)){
        echo 'done'.PHP_EOL;
        ++$i;
    }
    else{
        echo 'failed!';
    }
}