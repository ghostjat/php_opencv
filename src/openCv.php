<?php

namespace openCv;

use FFI;

class core {

    const FONT_HERSHEY_SIMPLEX =0;
    const FONT_HERSHEY_PLAIN =1;
    const FONT_HERSHEY_DUPLEX=2;
    const FONT_HERSHEY_COMPLEX=3;
    const FONT_HERSHEY_TRIPLEX =4;
    const FONT_HERSHEY_COMPLEX_SMALL =5;
    const FONT_HERSHEY_SCRIPT_SIMPLEX =6;
    const FONT_HERSHEY_SCRIPT_COMPLEX =7;
    const FONT_ITALIC = 16;
    
    const CV_FONT_LIGHT = 25; //QFont::Light,
    const CV_FONT_NORMAL = 50; //QFont::Normal,
    const CV_FONT_DEMIBOLD = 63; //QFont::DemiBold,
    const CV_FONT_BOLD = 75; //QFont::Bold,
    const CV_FONT_BLACK = 87; //QFont::Black
    const CV_STYLE_NORMAL = 0; //QFont::StyleNormal,
    const CV_STYLE_ITALIC = 1; //QFont::StyleItalic,
    const CV_STYLE_OBLIQUE = 2; //QFont::StyleOblique
    const CV_CAP_ANY = 0;
    const CV_CAP_PROP_FRAME_WIDTH = 3;
    const CV_CAP_PROP_FRAME_HEIGHT = 4;
    const CV_CAP_MODE_BGR = 0;
    const CV_CAP_MODE_RGB = 1;
    const CV_CAP_MODE_GRAY = 2;
    const CV_CAP_MODE_YUYV = 3;
    const CV_WND_PROP_FULLSCREEN = 0;
    const CV_WND_PROP_AUTOSIZE = 1;
    const CV_WND_PROP_ASPECTRATIO = 2;
    const CV_WND_PROP_OPENGL = 3;
    const CV_WND_PROP_VISIBLE = 4;
    const CV_WINDOW_NORMAL = 0x00000000;
    const CV_WINDOW_AUTOSIZE = 0x00000001;
    const CV_WINDOW_OPENGL = 0x00001000;
    const CV_GUI_EXPANDED = 0x00000000;
    const CV_GUI_NORMAL = 0x00000010;
    const CV_WINDOW_FULLSCREEN = 1;
    const CV_WINDOW_FREERATIO = 0x00000100;
    const CV_WINDOW_KEEPRATIO = 0x00000000;
    const CV_LOAD_IMAGE_UNCHANGED = -1;
    const CV_LOAD_IMAGE_GRAYSCALE = 0;
    const CV_LOAD_IMAGE_COLOR = 1;
    const CV_LOAD_IMAGE_ANYDEPTH = 2;
    const CV_LOAD_IMAGE_ANYCOLOR = 4;
    const CV_LOAD_IMAGE_IGNORE_ORIENTATION = 128;
    const CV_IMWRITE_JPEG_QUALITY = 1;
    const CV_IMWRITE_JPEG_PROGRESSIVE = 2;
    const CV_IMWRITE_JPEG_OPTIMIZE = 3;
    const CV_IMWRITE_JPEG_RST_INTERVAL = 4;
    const CV_IMWRITE_JPEG_LUMA_QUALITY = 5;
    const CV_IMWRITE_JPEG_CHROMA_QUALITY = 6;
    const CV_IMWRITE_PNG_COMPRESSION = 16;
    const CV_IMWRITE_PNG_STRATEGY = 17;
    const CV_IMWRITE_PNG_BILEVEL = 18;
    const CV_IMWRITE_PNG_STRATEGY_DEFAULT = 0;
    const CV_IMWRITE_PNG_STRATEGY_FILTERED = 1;
    const CV_IMWRITE_PNG_STRATEGY_HUFFMAN_ONLY = 2;
    const CV_IMWRITE_PNG_STRATEGY_RLE = 3;
    const CV_IMWRITE_PNG_STRATEGY_FIXED = 4;
    const CV_IMWRITE_PXM_BINARY = 32;
    const CV_IMWRITE_EXR_TYPE = 48;
    const CV_IMWRITE_WEBP_QUALITY = 64;
    const CV_IMWRITE_PAM_TUPLETYPE = 128;
    const CV_IMWRITE_PAM_FORMAT_NULL = 0;
    const CV_IMWRITE_PAM_FORMAT_BLACKANDWHITE = 1;
    const CV_IMWRITE_PAM_FORMAT_GRAYSCALE = 2;
    const CV_IMWRITE_PAM_FORMAT_GRAYSCALE_ALPHA = 3;
    const CV_IMWRITE_PAM_FORMAT_RGB = 4;
    const CV_IMWRITE_PAM_FORMAT_RGB_ALPHA = 5;
    const CV_HAAR_DO_CANNY_PRUNING = 1;
    const CV_HAAR_SCALE_IMAGE = 2;
    const CV_HAAR_FIND_BIGGEST_OBJECT = 4;
    const CV_HAAR_DO_ROUGH_SEARCH = 8;
    const CV_BGR2GRAY = 6;
    const CV_RGB2GRAY = 7;
    const CV_GRAY2BGR = 8;
    const WND_TITLE = 'PHP-OpenCV';

    public $ffi, $ffi_objD, $ffi_legacy;
    private $desiredWidth = null;
    private $desiredHeight = null;
    protected $img_res = null, $cvargs;
    public $imgW, $imgH, $cvCamera = null;
    public $window_Title = [];

    public function __construct() {
        $this->ffi = FFI::load(__DIR__ . '/opencv.h');
    }

    /**
     * 
     * @param int $desiredWidth
     * @param int $desiredHeight
     * @return void
     */
    public function setDesiredSize($desiredWidth, $desiredHeight) {
        $this->desiredWidth = $desiredWidth;
        $this->desiredHeight = $desiredHeight;
        if ($this->cvCamera !== null) {
            $this->ffi->cvSetCaptureProperty($this->cvCamera, self::CV_CAP_PROP_FRAME_WIDTH, $this->desiredWidth);
            $this->ffi->cvSetCaptureProperty($this->cvCamera, self::CV_CAP_PROP_FRAME_HEIGHT, $this->desiredHeight);
        }
    }

    /**
     * 
     * @return boolean
     */
    public function open() {
        if ($this->cvCamera !== null) {
            return false;
        }
        $this->cvCamera = $this->ffi->cvCreateCameraCapture(self::CV_CAP_ANY);

        if ($this->cvCamera === null) {
            return false;
        }

        if ($this->desiredWidth !== null && $this->desiredHeight !== null) {
            $this->ffi->cvSetCaptureProperty($this->cvCamera, self::CV_CAP_PROP_FRAME_WIDTH, $this->desiredWidth);
            $this->ffi->cvSetCaptureProperty($this->cvCamera, self::CV_CAP_PROP_FRAME_HEIGHT, $this->desiredHeight);
        }
        return true;
    }

    public function close() {
        if ($this->cvCamera === null) {
            return;
        }
        $this->ffi->cvReleaseCapture(FFI::addr($this->cvCamera));
        $this->cvCamera = null;
    }

    /**
     * 
     * @param type $title
     * @param int $flag
     * flag 0 for resize 1 for fixed size
     */
    public function namedwindow($title = self::WND_TITLE, $flag = self::CV_WINDOW_AUTOSIZE) {
        $this->window_Title[] = $title;
        return $this->ffi->cvNamedWindow($title, $flag);
    }

    public function setWindowProperty($Windowname, $prop_id, $prop_value) {
        return $this->ffi->cvSetWindowProperty($Windowname, $prop_id, $prop_value);
    }

    public function getWindowProperty($Windowname, $prop_id) {
        return $this->ffi->cvGetWindowProperty($Windowname, $prop_id);
    }

    /**
     * 
     * @param type $filename
     */
    public function showImage($filename, $cam = false) {
        if ($cam) {
            return $this->ffi->cvShowImage(self::WND_TITLE, $filename);
        } else {
            return $this->ffi->cvShowImage(self::WND_TITLE, $this->loadImage($filename));
        }
    }

    public function webImage($url) {
        $image = $this->url64_image($url);
        return $this->showImage($image);
    }

    protected function url64_image($url) {
        $data = str_replace("data:image/webp;base64,", "", $url);
        $url_64 = base64_decode($data);
        $im = imagecreatefromstring($this->URL64image($url_64));
        imagejpeg($im, 'tmp/' . $this->tempImageName() . '.jpg');
        imagedestroy($im);
        return 'tmp/' . $this->tempImageName . '.jpg';
    }

    public function resizeWindow($windowname, $width, $height) {
        return $this->ffi->cvResizeWindow($windowname, $width, $height);
    }

    public function moveWindow($title = self::WND_TITLE, $x = 300, $y = 130) {
        $this->ffi->cvMoveWindow($title, $x, $y);
    }

    /**
     * 
     * @param type $window_title
     */
    public function destroyWindow($window_Title) {
        return $this->ffi->cvDestroyWindow($window_Title);
    }

    public function destroyAllWindows() {
        return $this->ffi->cvDestroyAllWindows();
    }

    public function getWindowHandle($window_Title) {
        return $this->ffi->cvGetWindowHandle($window_Title);
    }

    public function getWindowName($window_handle) {
        return $this->ffi->cvGetWindowName($window_handle);
    }

    public function createCameraCapture($flag = self::CV_CAP_ANY) {
        return $this->cvCamera = $this->ffi->cvCreateCameraCapture($flag);
    }

    public function createFileCapture($filename) {
        return $this->ffi->cvCreateFileCapture($filename);
    }

    public function grabFrame($capture) {
        return $this->ffi->cvGrabFrame($capture);
    }

    public function retrieveFrame($capture, $streamIdx = 0) {
        return $this->ffi->cvRetrieveFrame($capture, $streamIdx);
    }

    public function queryFrame($capture) {
        return $this->ffi->cvQueryFrame($capture);
    }

    public function releaseCapture($capture) {
        return $this->ffi->cvReleaseCapture(
                        FFI::cast($this->ffi->type('CvCapture**'), $capture)
        );
    }

    /**
     * 
     * @param string $filename
     * @param const $flag
     * @return img resource
     */
    public function loadImage($filename, $flag = self::CV_LOAD_IMAGE_UNCHANGED) {
        return $this->ffi->cvLoadImage($filename, $flag);
    }

    /**
     * 
     * @param string $filename
     * @param bool $mirror
     * @return bool
     */
    public function saveFrame($filename, $image) {
        /*         * if ($this->cvCamera === null) {
          return false;
          }
          $image = $this->ffi->cvQueryFrame($this->cvCamera);

          if ($image === null) {
          return false;
          }
         * */
        return (bool) $this->ffi->cvSaveImage($filename, $image);
    }

    public function convertImage($src, $dst, $flags) {
        return $this->ffi->cvConvertImage($src, $dst, $flags);
    }

    public function getCaptureProperty($capture, $property_id) {
        return $this->ffi->cvGetCaptureProperty($capture, $property_id);
    }

    public function setCaptureProperty($CvCapture_capture, $int_property_id, $double_value) {
        return $this->ffi->cvSetCaptureProperty($CvCapture_capture, $int_property_id, $double_value);
    }

    public function getCaptureDomain($CvCapture_capture) {
        return $this->ffi->cvGetCaptureDomain($CvCapture_capture);
    }

    public function createVideoWriter($filename, $int_fourcc, $double_fps, $CvSize_frame_size, $int_is_color) {
        return $this->ffi->cvCreateVideoWriter($filename, $int_fourcc, $double_fps, $CvSize_frame_size, $int_is_color);
    }

    public function writeFrame($Cv_writer, $IplImage_image) {
        return $this->ffi->cvWriteFrame($Cv_writer, $IplImage_image);
    }

    public function releaseVideoWriter($Cv_writer) {
        return $this->ffi->cvReleaseVideoWriter(\FFI::cast($this->ffi->type('CvVideoWriter*'), $Cv_writer));
    }

    public function haveImageReader($filename) {
        return $this->ffi->cvHaveImageReader($filename);
    }

    public function haveImageWriter($filename) {
        return $this->ffi->cvHaveImageWriter($filename);
    }

    /**
     * 
     * @param type $sec
     */
    public function waitKey($sec = 0) {
        $this->ffi->cvWaitKey($sec);
    }

    public function startWindowThread() {
        return $this->ffi->cvStartWindowThread();
    }

    public function createTrackbar($trackbar_name, $window_name, $int_value, $int_count, $Callback_on_change) {
        return $this->ffi->cvCreateTrackbar($trackbar_name, $window_name, $int_value, $int_count, $Callback_on_change);
    }

    /*     * ObjectD.h* */

    public function object_detect_init() {
        $this->ffi_objD = FFI::load(__DIR__ . '/objectD.h');
    }
    
    /**
     * 
     * @param type $image
     * @param type $cascade
     * @param type $storage
     * @param float $scale_factor
     * @param int $min_neighbors
     * @param int $flags
     * @param array $min_size
     * @param array $max_size
     * @return type
     */
    public function haarDetectObjects($image, $cascade, $storage,$scale_factor = 1.1, $min_neighbors = 3, $flags = 0|self::CV_HAAR_SCALE_IMAGE,$min_size=[0,0], $max_size=[0,0]) {
        $minSize = $this->objD_Size($min_size[0], $min_size[1]);
        $maxSize = $this->objD_Size($max_size[0], $max_size[1]);
        return $this->ffi_objD->cvHaarDetectObjects($image, $cascade, $storage,
                        $scale_factor, $min_neighbors, $flags,
                        $minSize, $maxSize);
    }

    public function loadHaarClassifierCascade($directory_path, array $winSize = [1, 1]) {
        $cvSize = $this->objD_Size($winSize[0], $winSize[1]);
        return $this->ffi_objD->cvLoadHaarClassifierCascade($directory, $cvSize);
    }

    public function releaseHaarClassifierCascade($cascade) {
        return $this->ffi_objD->cvReleaseHaarClassifierCascade($cascade);
    }

    public function objD_Size($width, $height) {
        $cvSize = $this->ffi_objD->new('struct CvSize');
        $cvSize->width = $width;
        $cvSize->height = $height;
        return $cvSize;
    }

    /*     * Photo.h* */

    public function photo() {
        $this->ffi_inPaint = \FFI::load(__DIR__ . '/photo.h');
    }

    public function Inpaint($const_CvArr_src, $const_CvArr_inpaint_mask,
            $CvArr_dst, $double_inpaintRange, $int_flags) {
        return $this->ffi_inPaint->Inpaint($const_CvArr_src, $const_CvArr_inpaint_mask,
                        $CvArr_dst, $double_inpaintRange, $int_flags);
    }

    /*     * ImageProc.h* */

    public function cvRGB($r, $g, $b) {
        $rgb = $this->ffi->new('struct  CvScalar');
        $rgb->val[0] = $b;
        $rgb->val[1] = $g;
        $rgb->val[2] = $r;
        $rgb->val[3] = 0;
        return $rgb;
    }

    public function rectangle($img, $pt1, $pt2, $color, $thickness, $line_type, $shift) {
        return $this->ffi->cvRectangle($img, $pt1, $pt2, $color, $thickness, $line_type, $shift);
    }

    public function createHist(int $dims, int $sizes, int $type, float $ranges = null, int $uniform = 1) {
        return $this->ffi->cvCreateHist($dims, $sizes, $type, $ranges, $uniform);
    }

    /**
     * 
     * @param const CvArr $src
     * @param CvArr $dst
     * @param int $code
     * @return void
     */
    public function cvtColor($src, $dst, $code) {
        return $this->ffi->cvCvtColor($src, $dst, $code);
    }

    /**
     * 
     * @param const CvArr* $image
     * @param CvArr* $edges
     * @param double $threshold1
     * @param double $threshold2
     * @param int $aperture_size
     * @return type
     */
    public function canny($image, $edges, $threshold1 = 10, $threshold2 = 200, $aperture_size = 3) {
        return $this->ffi->cvCanny($image, $edges, $threshold1, $threshold2, $aperture_size);
    }

    

    /**
     * CoreCv.h
     * */
    public function cvload($filename, $memstorage = null, $name = null, $real_name = null) {
        return $this->ffi->cvLoad($filename, $memstorage, $name, $real_name);
    }
    
    /**
     * 
     * @param IplImage* $image
     * @return iplImage*
     */
    public function cloneImage($image){
        return $this->ffi->cvCloneImage($image );
    }

    /**
     * Copies source array to destination array
     * @param CvArr $src
     * @param CvArr $dst
     * @param CvArr $mask
     * @return void
     */
    public function copy($src, $dst, $mask=null){
        return $this->ffi->cvCopy($src, $dst,$mask);
    }

    /**
     * 
     * @param const CvArr* $src
     * @param CvArr* $dst
     * @param int $flip_mode
     * @return void
     */
    public function flip($src, $dst=null,$flip_mode =0){
        return $this->ffi->cvFlip($src, $dst,$flip_mode);
    }
    
    public function font(){
        $font =  $this->ffi->new('struct CvFont');
        return FFI::cast($this->ffi->type('CvFont*'), $font);
    }
    
    /**
     * 
     * @param CvFont* $font
     * @param int $font_face
     * @param double $hscale
     * @param double $vscale
     * @param double $shear
     * @param int $thickness
     * @param int $line_type
     * @return void
     */
    public function initFont($font,$font_face=self::FONT_HERSHEY_PLAIN,$hscale=1,$vscale=1,$shear=0,$thickness = 1,$line_type =8){
        return $this->ffi->cvInitFont($font,$font_face,$hscale,$vscale,$shear, $thickness,$line_type);
    }
    /**
     * 
     * @param CvArr $img
     * @param char $text
     * @param CvPoint $org
     * @param CvFont $font
     * @param CvScalar $color
     * @return void
     */
    public function putText($img, $text, $org, $font, $color) {
        print_r($color);
        #return $this->ffi->cvPutText( $img, $text, $org, $font, $color);

    }

    public function createMemStorage($block_size = 0) {
        return $this->ffi->cvCreateMemStorage($block_size);
    }

    public function releaseMemStorage($storage) {
        return $this->ffi->cvReleaseMemStorage(
                        FFI::cast($this->ffi->type('CvMemStorage**'), $storage)
        );
    }

    public function cvSize($width, $height) {
        $cvSize = $this->ffi->new('struct CvSize');
        $cvSize->width = $width;
        $cvSize->height = $height;
        return $cvSize;
    }

    public function cvPoint($x, $y) {
        $cvPoint = $this->ffi->new('struct CvPoint');
        $cvPoint->x = $x;
        $cvPoint->y = $y;
        return $cvPoint;
    }

    public function getSeqElem($seq, $index) {
        return $this->ffi->cvGetSeqElem($this->ffi->cast($this->ffi->type('CvSeq*'), $seq), $index);
    }

    public function createImage($width, $height, $depth, $channels) {
        $cvSize = $this->cvSize($width, $height);
        return $this->ffi->cvCreateImage($cvSize, $depth, $channels);
    }
    
    
    /**
     * legacy.hpp
     */
    public function init_legacy(){
        $this->ffi_legacy = \FFI::cdef(
                '
                typedef void CvArr;
                typedef struct CvSeq CvSeq;
                typedef struct CvMemStorage CvMemStorage;
                typedef struct _IplImage IplImage;
                int cvChangeDetection( IplImage*  prev_frame, IplImage*  curr_frame, IplImage*  change_mask );

                CvSeq* cvSegmentImage( const CvArr* srcarr, CvArr* dstarr,
                                    double canny_threshold,
                                    double ffill_threshold,
                                    CvMemStorage* storage );','/usr/lib/x86_64-linux-gnu/libopencv_legacy.so');
    }
    
    /**
     * Common use change detection function 
     * @param IplImage* $prev_frame
     * @param IplImage* $curr_frame
     * @param IplImage* $change_mask
     * @return int
     */
    public function changeDetection($prev_frame, $curr_frame, $change_mask ){
        
        return $this->ffi_legacy->cvChangeDetection(
                FFI::cast($this->ffi_legacy->type('IplImage*'),$prev_frame),
                FFI::cast($this->ffi_legacy->type('IplImage*'),$curr_frame), 
                FFI::cast($this->ffi_legacy->type('IplImage*'),$change_mask) 
            );
    }


    /**
     * 
     * @param const CvArr* $srcarr
     * @param CvArr* $dstarr
     * @param double $canny_threshold
     * @param double $ffill_threshold
     * @param CvMemStorage $storage
     * @return CvSeq*
     */
    public function segmentImage($srcarr, $dstarr, $canny_threshold=200, $ffill_threshold=50, $storage=null) {
        return $this->ffi_legacy->cvSegmentImage($srcarr, $dstarr,$canny_threshold,$ffill_threshold,$storage);
    }

}
