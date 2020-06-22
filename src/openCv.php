<?php

namespace openCv;

use FFI;

class core {

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
    
    const WND_TITLE = 'PHP-OpenCV';

    public $ffi,$ffi_objD;
    private $desiredWidth = null;
    private $desiredHeight = null;
    
    protected $img_res = null,$cvargs;
    public $imgW,$imgH,$cvCamera = null;
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
     * @param type $flag
     */
    public function namedwindow($title= self::WND_TITLE,$flag = self::CV_WINDOW_AUTOSIZE){
       $this->window_Title[] = $title;
       return $this->ffi->cvNamedWindow($title,$flag);
    }
    
    public function setWindowProperty($Windowname, $prop_id, $prop_value){
        return $this->ffi->cvSetWindowProperty($Windowname, $prop_id, $prop_value);
    }
    
    public function getWindowProperty($Windowname,$prop_id){
        return $this->ffi->cvGetWindowProperty($Windowname,$prop_id);
    }
    
    /**
     * 
     * @param type $filename
     */
    public function showImage($filename,$cam=false) {
        if($cam){
            return $this->ffi->cvShowImage(self::WND_TITLE,$filename);
        }else{
            return $this->ffi->cvShowImage(self::WND_TITLE, $this->loadImage($filename));
        }
        
    }
    
    public function webImage($url){
        $image = $this->url64_image($url);
        return $this->showImage($image);
    }
    
    protected function url64_image($url){
        $data = str_replace("data:image/webp;base64,", "", $url);
        $url_64 = base64_decode($data);
        $im = imagecreatefromstring($this->URL64image($url_64));
        imagejpeg($im, 'tmp/'.$this->tempImageName().'.jpg');
        imagedestroy($im);
        return 'tmp/'.$this->tempImageName.'.jpg';
    }


    public function resizeWindow($windowname,$width,$height){
        return $this->ffi->cvResizeWindow($windowname, $width, $height);
    }

    public function moveWindow($title = self::WND_TITLE , $x = 300,$y=130) {
        $this->ffi->cvMoveWindow($title, $x, $y);
    }
    
    /**
     * 
     * @param type $window_title
     */
    public function destroyWindow($window_Title) {
        return $this->ffi->cvDestroyWindow($window_Title);
    }
    
    public function destroyAllWindows(){
        return $this->ffi->cvDestroyAllWindows();
    }
    
    public function getWindowHandle($window_Title){
        return $this->ffi->cvGetWindowHandle($window_Title);
    }
    
    public function getWindowName($window_handle){
        return $this->ffi->cvGetWindowName($window_handle);
    }
    
    public function createCameraCapture($flag = self::CV_CAP_ANY) {
        return $this->cvCamera = $this->ffi->cvCreateCameraCapture($flag);
    }
    
    public function createFileCapture($filename){
        return $this->ffi->cvCreateFileCapture($filename);
    }
    
    public function grabFrame($capture){
        return $this->ffi->cvGrabFrame($capture);
    }
    
    public function retrieveFrame($capture, $streamIdx=0){
        return $this->ffi->cvRetrieveFrame($capture, $streamIdx);
    }
    
    public function queryFrame($capture){
        return $this->ffi->cvQueryFrame($capture);
    }
    
    public function releaseCapture($capture){
        return $this->ffi->cvReleaseCapture(
            FFI::cast($this->ffi->type('CvCapture**'),$capture)
        );
    }
    
    /**
     * 
     * @param string $filename
     * @param const $flag
     * @return img resource
    */
    public function loadImage($filename,$flag = self::CV_LOAD_IMAGE_UNCHANGED){
        return $this->ffi->cvLoadImage($filename,$flag);
    }
    
    
    /**
     * 
     * @param string $filename
     * @param bool $mirror
     * @return bool
    */
    public function saveFrame($filename,$image){
        /**if ($this->cvCamera === null) {
            return false;
        }
        $image = $this->ffi->cvQueryFrame($this->cvCamera);

        if ($image === null) {
            return false;
        }
        **/
        return (bool) $this->ffi->cvSaveImage($filename, $image);
    }
    
    public function convertImage($src, $dst, $flags){
        return $this->ffi->cvConvertImage($src, $dst, $flags);
    }
    
    public function getCaptureProperty($capture, $property_id){
        return $this->ffi->cvGetCaptureProperty($capture, $property_id);
    }
    
    public function setCaptureProperty($CvCapture_capture, $int_property_id, $double_value){
        return $this->ffi->cvSetCaptureProperty($CvCapture_capture, $int_property_id, $double_value);

    }
    
    public function getCaptureDomain($CvCapture_capture){
        return $this->ffi->cvGetCaptureDomain($CvCapture_capture);
    }
    
    public function createVideoWriter($filename, $int_fourcc,$double_fps, $CvSize_frame_size,$int_is_color){
        return $this->ffi->cvCreateVideoWriter($filename, $int_fourcc,$double_fps, $CvSize_frame_size,$int_is_color);
    }
    
    public function writeFrame($Cv_writer, $IplImage_image){
        return $this->ffi->cvWriteFrame($Cv_writer, $IplImage_image);
    }
    
    public function releaseVideoWriter($Cv_writer){
        return $this->ffi->cvReleaseVideoWriter(\FFI::cast($this->ffi->type('CvVideoWriter*'),$Cv_writer));
    }
    
    public function haveImageReader($filename){
        return $this->ffi->cvHaveImageReader($filename);
    }
    
    public function haveImageWriter($filename){
        return $this->ffi->cvHaveImageWriter($filename);
    }
    
     /**
     * 
     * @param type $sec
     */
    public function waitKey($sec = 0) {
        $this->ffi->cvWaitKey($sec);
    }
    
    public function startWindowThread(){
        return $this->ffi->cvStartWindowThread();
    }
    
    public function createTrackbar ($trackbar_name, $window_name, $int_value, $int_count, $Callback_on_change){
        return $this->ffi->cvCreateTrackbar ($trackbar_name, $window_name, $int_value, $int_count, $Callback_on_change);
    }
    
    
    /**ObjectD.h**/
    public function object_detect_init(){
        $this->ffi_objD = FFI::load(__DIR__ .'/objectD.h');
    }
    
    public function haarDetectObjects($image, $cascade, $storage,
                     $scale_factor= 1.1, $min_neighbors = 3, $flags = 0,
                     $min_size, $max_size) {
        return $this->ffi_objD->cvHaarDetectObjects($image, $cascade, $storage,
                     $scale_factor, $min_neighbors, $flags,
                     $min_size, $max_size);
    }
    
    public function loadHaarClassifierCascade( $directory_path, array $winSize = [1,1]){
        $cvSize = $this->objD_Size($winSize[0],$winSize[1]);
        return $this->ffi_objD->cvLoadHaarClassifierCascade( $directory, $cvSize);
    }
    
    public function releaseHaarClassifierCascade($cascade ){
        return $this->ffi_objD->cvReleaseHaarClassifierCascade($cascade);
    }
    
    public function objD_Size($width,$height){
        $cvSize = $this->ffi_objD->new('struct CvSize');
        $cvSize->width = $width;
        $cvSize->height = $height;
        return $cvSize;
    }

    
    
    /**Photo.h**/
    public function photo(){
        $this->ffi_inPaint = \FFI::load(__DIR__ .'/photo.h');
    }
    
    public function Inpaint( $const_CvArr_src, $const_CvArr_inpaint_mask,
                       $CvArr_dst, $double_inpaintRange, $int_flags ){
        return $this->ffi_inPaint->Inpaint( $const_CvArr_src, $const_CvArr_inpaint_mask,
                       $CvArr_dst, $double_inpaintRange, $int_flags );
    }
    
    /**ImageProc.h**/
    
    public function cvRGB($r,$g,$b){
        $rgb = $this->ffi->new('struct  CvScalar');
        $rgb->val[0] = $b;
        $rgb->val[1] = $g;
        $rgb->val[2] = $r;
        $rgb->val[3] = 0;
        return $rgb;
    }
    
    public function rectangle($img, $pt1, $pt2, $color, $thickness,$line_type, $shift){
        return $this->ffi->cvRectangle($img, $pt1, $pt2,$color, $thickness, $line_type, $shift);      
    }
    
    public function createHistogram(int $dims, int $sizes,  int $type, float $ranges = null ,int $uniform = 1){
        return $this->ffi->cvCreateHist( $dims, $sizes, $type,$ranges,$uniform);
    }


    /**
     * CoreCv.h
    **/
    
    public function cvload($filename,$memstorage=null,$name=null,$real_name=null){
        return $this->ffi->cvLoad($filename,$memstorage,$name,$real_name );
    }
    
    public function createMemStorage($block_size = 0){
        return $this->ffi->cvCreateMemStorage($block_size);

    }
    
    public function releaseMemStorage( $storage){
        return $this->ffi->cvReleaseMemStorage(
                FFI::cast($this->ffi->type('CvMemStorage**'),$storage)
        );
    }
    
    public function cvSize($width,$height){
        $cvSize = $this->ffi->new('struct CvSize');
        $cvSize->width = $width;
        $cvSize->height = $height;
        return $cvSize;
    }
    
    public function cvPoint($x,$y){
        $cvPoint = $this->ffi->new('struct CvPoint');
        $cvPoint->x = $x;
        $cvPoint->y = $y;
        return $cvPoint;
    }
    
    public function getSeqElem( $seq, $index ){
        return $this->ffi->cvGetSeqElem( $this->ffi->cast($this->ffi->type('CvSeq*'),$seq), $index);
    }
    
    public function createImage( $width,$height, $depth, $channels ){
        $cvSize = $this->cvSize($width,$height);
        return $this->ffi->cvCreateImage($cvSize, $depth, $channels);
    }
}
