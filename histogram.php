<?php

if (!extension_loaded("FFI")) {
	die("FFI extension required\n");
}

require 'vendor/autoload.php';

use openCv\core;

$keepProcessing = true;
$max_value = 0;
$hist_size = 256;
$bin_w = 0;
$ranage_0 = range(0, 256);
$ranage = $ranage_0;

$cv = new core();
$cv->namedwindow('GrayScaleImage');
$cv->namedwindow('Histogram');
$cv->createHistogram(1, $hist_size, $max_value);
