#define FFI_SCOPE "opencv"
#define FFI_LIB "/usr/lib/x86_64-linux-gnu/libopencv_highgui.so"

#define  CV_FOURCC_PROMPT-1

enum {
    CV_FONT_LIGHT = 25, //QFont::Light,
    CV_FONT_NORMAL = 50, //QFont::Normal,
    CV_FONT_DEMIBOLD = 63, //QFont::DemiBold,
    CV_FONT_BOLD = 75, //QFont::Bold,
    CV_FONT_BLACK = 87 //QFont::Black
};

enum {
    CV_STYLE_NORMAL = 0, //QFont::StyleNormal,
    CV_STYLE_ITALIC = 1, //QFont::StyleItalic,
    CV_STYLE_OBLIQUE = 2 //QFont::StyleOblique
};

enum {
    CV_CAP_PROP_DC1394_OFF = -4, //turn the feature off (not controlled manually nor automatically)
    CV_CAP_PROP_DC1394_MODE_MANUAL = -3, //set automatically when a value of the feature is set by the user
    CV_CAP_PROP_DC1394_MODE_AUTO = -2,
    CV_CAP_PROP_DC1394_MODE_ONE_PUSH_AUTO = -1,
    CV_CAP_PROP_POS_MSEC = 0,
    CV_CAP_PROP_POS_FRAMES = 1,
    CV_CAP_PROP_POS_AVI_RATIO = 2,
    CV_CAP_PROP_FRAME_WIDTH = 3,
    CV_CAP_PROP_FRAME_HEIGHT = 4,
    CV_CAP_PROP_FPS = 5,
    CV_CAP_PROP_FOURCC = 6,
    CV_CAP_PROP_FRAME_COUNT = 7,
    CV_CAP_PROP_FORMAT = 8,
    CV_CAP_PROP_MODE = 9,
    CV_CAP_PROP_BRIGHTNESS = 10,
    CV_CAP_PROP_CONTRAST = 11,
    CV_CAP_PROP_SATURATION = 12,
    CV_CAP_PROP_HUE = 13,
    CV_CAP_PROP_GAIN = 14,
    CV_CAP_PROP_EXPOSURE = 15,
    CV_CAP_PROP_CONVERT_RGB = 16,
    CV_CAP_PROP_WHITE_BALANCE_BLUE_U = 17,
    CV_CAP_PROP_RECTIFICATION = 18,
    CV_CAP_PROP_MONOCROME = 19,
    CV_CAP_PROP_SHARPNESS = 20,
    CV_CAP_PROP_AUTO_EXPOSURE = 21, // exposure control done by camera,
    // user can adjust refernce level
    // using this feature
    CV_CAP_PROP_GAMMA = 22,
    CV_CAP_PROP_TEMPERATURE = 23,
    CV_CAP_PROP_TRIGGER = 24,
    CV_CAP_PROP_TRIGGER_DELAY = 25,
    CV_CAP_PROP_WHITE_BALANCE_RED_V = 26,
    CV_CAP_PROP_ZOOM = 27,
    CV_CAP_PROP_FOCUS = 28,
    CV_CAP_PROP_GUID = 29,
    CV_CAP_PROP_ISO_SPEED = 30,
    CV_CAP_PROP_MAX_DC1394 = 31,
    CV_CAP_PROP_BACKLIGHT = 32,
    CV_CAP_PROP_PAN = 33,
    CV_CAP_PROP_TILT = 34,
    CV_CAP_PROP_ROLL = 35,
    CV_CAP_PROP_IRIS = 36,
    CV_CAP_PROP_SETTINGS = 37,

    CV_CAP_PROP_AUTOGRAB = 1024, // property for highgui class CvCapture_Android only
    CV_CAP_PROP_SUPPORTED_PREVIEW_SIZES_STRING = 1025, // readonly, tricky property, returns cpnst char* indeed
    CV_CAP_PROP_PREVIEW_FORMAT = 1026, // readonly, tricky property, returns cpnst char* indeed

    // OpenNI map generators
    CV_CAP_OPENNI_DEPTH_GENERATOR = 1 << 31,
    CV_CAP_OPENNI_IMAGE_GENERATOR = 1 << 30,
    CV_CAP_OPENNI_GENERATORS_MASK = CV_CAP_OPENNI_DEPTH_GENERATOR + CV_CAP_OPENNI_IMAGE_GENERATOR,

    // Properties of cameras available through OpenNI interfaces
    CV_CAP_PROP_OPENNI_OUTPUT_MODE = 100,
    CV_CAP_PROP_OPENNI_FRAME_MAX_DEPTH = 101, // in mm
    CV_CAP_PROP_OPENNI_BASELINE = 102, // in mm
    CV_CAP_PROP_OPENNI_FOCAL_LENGTH = 103, // in pixels
    CV_CAP_PROP_OPENNI_REGISTRATION = 104, // flag
    CV_CAP_PROP_OPENNI_REGISTRATION_ON = CV_CAP_PROP_OPENNI_REGISTRATION, // flag that synchronizes the remapping depth map to image map
    // by changing depth generator's view point (if the flag is "on") or
    // sets this view point to its normal one (if the flag is "off").
    CV_CAP_PROP_OPENNI_APPROX_FRAME_SYNC = 105,
    CV_CAP_PROP_OPENNI_MAX_BUFFER_SIZE = 106,
    CV_CAP_PROP_OPENNI_CIRCLE_BUFFER = 107,
    CV_CAP_PROP_OPENNI_MAX_TIME_DURATION = 108,

    CV_CAP_PROP_OPENNI_GENERATOR_PRESENT = 109,

    CV_CAP_OPENNI_IMAGE_GENERATOR_PRESENT = CV_CAP_OPENNI_IMAGE_GENERATOR + CV_CAP_PROP_OPENNI_GENERATOR_PRESENT,
    CV_CAP_OPENNI_IMAGE_GENERATOR_OUTPUT_MODE = CV_CAP_OPENNI_IMAGE_GENERATOR + CV_CAP_PROP_OPENNI_OUTPUT_MODE,
    CV_CAP_OPENNI_DEPTH_GENERATOR_BASELINE = CV_CAP_OPENNI_DEPTH_GENERATOR + CV_CAP_PROP_OPENNI_BASELINE,
    CV_CAP_OPENNI_DEPTH_GENERATOR_FOCAL_LENGTH = CV_CAP_OPENNI_DEPTH_GENERATOR + CV_CAP_PROP_OPENNI_FOCAL_LENGTH,
    CV_CAP_OPENNI_DEPTH_GENERATOR_REGISTRATION = CV_CAP_OPENNI_DEPTH_GENERATOR + CV_CAP_PROP_OPENNI_REGISTRATION,
    CV_CAP_OPENNI_DEPTH_GENERATOR_REGISTRATION_ON = CV_CAP_OPENNI_DEPTH_GENERATOR_REGISTRATION,

    // Properties of cameras available through GStreamer interface
    CV_CAP_GSTREAMER_QUEUE_LENGTH = 200, // default is 1
    CV_CAP_PROP_PVAPI_MULTICASTIP = 300, // ip for anable multicast master mode. 0 for disable multicast

    // Properties of cameras available through XIMEA SDK interface
    CV_CAP_PROP_XI_DOWNSAMPLING = 400, // Change image resolution by binning or skipping.
    CV_CAP_PROP_XI_DATA_FORMAT = 401, // Output data format.
    CV_CAP_PROP_XI_OFFSET_X = 402, // Horizontal offset from the origin to the area of interest (in pixels).
    CV_CAP_PROP_XI_OFFSET_Y = 403, // Vertical offset from the origin to the area of interest (in pixels).
    CV_CAP_PROP_XI_TRG_SOURCE = 404, // Defines source of trigger.
    CV_CAP_PROP_XI_TRG_SOFTWARE = 405, // Generates an internal trigger. PRM_TRG_SOURCE must be set to TRG_SOFTWARE.
    CV_CAP_PROP_XI_GPI_SELECTOR = 406, // Selects general purpose input
    CV_CAP_PROP_XI_GPI_MODE = 407, // Set general purpose input mode
    CV_CAP_PROP_XI_GPI_LEVEL = 408, // Get general purpose level
    CV_CAP_PROP_XI_GPO_SELECTOR = 409, // Selects general purpose output
    CV_CAP_PROP_XI_GPO_MODE = 410, // Set general purpose output mode
    CV_CAP_PROP_XI_LED_SELECTOR = 411, // Selects camera signalling LED
    CV_CAP_PROP_XI_LED_MODE = 412, // Define camera signalling LED functionality
    CV_CAP_PROP_XI_MANUAL_WB = 413, // Calculates White Balance(must be called during acquisition)
    CV_CAP_PROP_XI_AUTO_WB = 414, // Automatic white balance
    CV_CAP_PROP_XI_AEAG = 415, // Automatic exposure/gain
    CV_CAP_PROP_XI_EXP_PRIORITY = 416, // Exposure priority (0.5 - exposure 50%, gain 50%).
    CV_CAP_PROP_XI_AE_MAX_LIMIT = 417, // Maximum limit of exposure in AEAG procedure
    CV_CAP_PROP_XI_AG_MAX_LIMIT = 418, // Maximum limit of gain in AEAG procedure
    CV_CAP_PROP_XI_AEAG_LEVEL = 419, // Average intensity of output signal AEAG should achieve(in %)
    CV_CAP_PROP_XI_TIMEOUT = 420, // Image capture timeout in milliseconds

    // Properties for Android cameras
    CV_CAP_PROP_ANDROID_FLASH_MODE = 8001,
    CV_CAP_PROP_ANDROID_FOCUS_MODE = 8002,
    CV_CAP_PROP_ANDROID_WHITE_BALANCE = 8003,
    CV_CAP_PROP_ANDROID_ANTIBANDING = 8004,
    CV_CAP_PROP_ANDROID_FOCAL_LENGTH = 8005,
    CV_CAP_PROP_ANDROID_FOCUS_DISTANCE_NEAR = 8006,
    CV_CAP_PROP_ANDROID_FOCUS_DISTANCE_OPTIMAL = 8007,
    CV_CAP_PROP_ANDROID_FOCUS_DISTANCE_FAR = 8008,
    CV_CAP_PROP_ANDROID_EXPOSE_LOCK = 8009,
    CV_CAP_PROP_ANDROID_WHITEBALANCE_LOCK = 8010,

    // Properties of cameras available through AVFOUNDATION interface
    CV_CAP_PROP_IOS_DEVICE_FOCUS = 9001,
    CV_CAP_PROP_IOS_DEVICE_EXPOSURE = 9002,
    CV_CAP_PROP_IOS_DEVICE_FLASH = 9003,
    CV_CAP_PROP_IOS_DEVICE_WHITEBALANCE = 9004,
    CV_CAP_PROP_IOS_DEVICE_TORCH = 9005,

    // Properties of cameras available through Smartek Giganetix Ethernet Vision interface
    /* --- Vladimir Litvinenko (litvinenko.vladimir@gmail.com) --- */
    CV_CAP_PROP_GIGA_FRAME_OFFSET_X = 10001,
    CV_CAP_PROP_GIGA_FRAME_OFFSET_Y = 10002,
    CV_CAP_PROP_GIGA_FRAME_WIDTH_MAX = 10003,
    CV_CAP_PROP_GIGA_FRAME_HEIGH_MAX = 10004,
    CV_CAP_PROP_GIGA_FRAME_SENS_WIDTH = 10005,
    CV_CAP_PROP_GIGA_FRAME_SENS_HEIGH = 10006,

    CV_CAP_PROP_INTELPERC_PROFILE_COUNT = 11001,
    CV_CAP_PROP_INTELPERC_PROFILE_IDX = 11002,
    CV_CAP_PROP_INTELPERC_DEPTH_LOW_CONFIDENCE_VALUE = 11003,
    CV_CAP_PROP_INTELPERC_DEPTH_SATURATION_VALUE = 11004,
    CV_CAP_PROP_INTELPERC_DEPTH_CONFIDENCE_THRESHOLD = 11005,
    CV_CAP_PROP_INTELPERC_DEPTH_FOCAL_LENGTH_HORZ = 11006,
    CV_CAP_PROP_INTELPERC_DEPTH_FOCAL_LENGTH_VERT = 11007,

    // Intel PerC streams
    CV_CAP_INTELPERC_DEPTH_GENERATOR = 1 << 29,
    CV_CAP_INTELPERC_IMAGE_GENERATOR = 1 << 28,
    CV_CAP_INTELPERC_GENERATORS_MASK = CV_CAP_INTELPERC_DEPTH_GENERATOR + CV_CAP_INTELPERC_IMAGE_GENERATOR
};

enum {
    // Data given from depth generator.
    CV_CAP_OPENNI_DEPTH_MAP = 0, // Depth values in mm (CV_16UC1)
    CV_CAP_OPENNI_POINT_CLOUD_MAP = 1, // XYZ in meters (CV_32FC3)
    CV_CAP_OPENNI_DISPARITY_MAP = 2, // Disparity in pixels (CV_8UC1)
    CV_CAP_OPENNI_DISPARITY_MAP_32F = 3, // Disparity in pixels (CV_32FC1)
    CV_CAP_OPENNI_VALID_DEPTH_MASK = 4, // CV_8UC1

    // Data given from RGB image generator.
    CV_CAP_OPENNI_BGR_IMAGE = 5,
    CV_CAP_OPENNI_GRAY_IMAGE = 6
};

// Supported output modes of OpenNI image generator

enum {
    CV_CAP_OPENNI_VGA_30HZ = 0,
    CV_CAP_OPENNI_SXGA_15HZ = 1,
    CV_CAP_OPENNI_SXGA_30HZ = 2,
    CV_CAP_OPENNI_QVGA_30HZ = 3,
    CV_CAP_OPENNI_QVGA_60HZ = 4
};

enum {
    CV_CAP_INTELPERC_DEPTH_MAP = 0, // Each pixel is a 16-bit integer. The value indicates the distance from an object to the camera's XY plane or the Cartesian depth.
    CV_CAP_INTELPERC_UVDEPTH_MAP = 1, // Each pixel contains two 32-bit floating point values in the range of 0-1, representing the mapping of depth coordinates to the color coordinates.
    CV_CAP_INTELPERC_IR_MAP = 2, // Each pixel is a 16-bit integer. The value indicates the intensity of the reflected laser beam.
    CV_CAP_INTELPERC_IMAGE = 3
};

enum {
    CV_CAP_MODE_BGR = 0,
    CV_CAP_MODE_RGB = 1,
    CV_CAP_MODE_GRAY = 2,
    CV_CAP_MODE_YUYV = 3
};

enum {
    CV_CAP_ANY = 0, // autodetect

    CV_CAP_MIL = 100, // MIL proprietary drivers

    CV_CAP_VFW = 200, // platform native
    CV_CAP_V4L = 200,
    CV_CAP_V4L2 = 200,

    CV_CAP_FIREWARE = 300, // IEEE 1394 drivers
    CV_CAP_FIREWIRE = 300,
    CV_CAP_IEEE1394 = 300,
    CV_CAP_DC1394 = 300,
    CV_CAP_CMU1394 = 300,

    CV_CAP_STEREO = 400, // TYZX proprietary drivers
    CV_CAP_TYZX = 400,
    CV_TYZX_LEFT = 400,
    CV_TYZX_RIGHT = 401,
    CV_TYZX_COLOR = 402,
    CV_TYZX_Z = 403,

    CV_CAP_QT = 500, // QuickTime

    CV_CAP_UNICAP = 600, // Unicap drivers

    CV_CAP_DSHOW = 700, // DirectShow (via videoInput)
    CV_CAP_MSMF = 1400, // Microsoft Media Foundation (via videoInput)

    CV_CAP_PVAPI = 800, // PvAPI, Prosilica GigE SDK

    CV_CAP_OPENNI = 900, // OpenNI (for Kinect)
    CV_CAP_OPENNI_ASUS = 910, // OpenNI (for Asus Xtion)

    CV_CAP_ANDROID = 1000, // Android
    CV_CAP_ANDROID_BACK = CV_CAP_ANDROID + 99, // Android back camera
    CV_CAP_ANDROID_FRONT = CV_CAP_ANDROID + 98, // Android front camera

    CV_CAP_XIAPI = 1100, // XIMEA Camera API

    CV_CAP_AVFOUNDATION = 1200, // AVFoundation framework for iOS (OS X Lion will have the same API)

    CV_CAP_GIGANETIX = 1300, // Smartek Giganetix GigEVisionSDK

    CV_CAP_INTELPERC = 1500 // Intel Perceptual Computing SDK
};

enum {
    CV_WND_PROP_FULLSCREEN = 0,
    CV_WND_PROP_AUTOSIZE = 1,
    CV_WND_PROP_ASPECTRATIO = 2,
    CV_WND_PROP_OPENGL = 3,
    CV_WND_PROP_VISIBLE = 4,
    CV_WINDOW_NORMAL = 0x00000000,
    CV_WINDOW_AUTOSIZE = 0x00000001,
    CV_WINDOW_OPENGL = 0x00001000,
    CV_GUI_EXPANDED = 0x00000000,
    CV_GUI_NORMAL = 0x00000010,
    CV_WINDOW_FULLSCREEN = 1,
    CV_WINDOW_FREERATIO = 0x00000100,
    CV_WINDOW_KEEPRATIO = 0x00000000
};

enum {
    CV_LOAD_IMAGE_UNCHANGED = -1,
    CV_LOAD_IMAGE_GRAYSCALE = 0,
    CV_LOAD_IMAGE_COLOR = 1,
    CV_LOAD_IMAGE_ANYDEPTH = 2,
    CV_LOAD_IMAGE_ANYCOLOR = 4,
    CV_LOAD_IMAGE_IGNORE_ORIENTATION = 128
};

enum {
    CV_IMWRITE_JPEG_QUALITY = 1,
    CV_IMWRITE_JPEG_PROGRESSIVE = 2,
    CV_IMWRITE_JPEG_OPTIMIZE = 3,
    CV_IMWRITE_JPEG_RST_INTERVAL = 4,
    CV_IMWRITE_JPEG_LUMA_QUALITY = 5,
    CV_IMWRITE_JPEG_CHROMA_QUALITY = 6,
    CV_IMWRITE_PNG_COMPRESSION = 16,
    CV_IMWRITE_PNG_STRATEGY = 17,
    CV_IMWRITE_PNG_BILEVEL = 18,
    CV_IMWRITE_PNG_STRATEGY_DEFAULT = 0,
    CV_IMWRITE_PNG_STRATEGY_FILTERED = 1,
    CV_IMWRITE_PNG_STRATEGY_HUFFMAN_ONLY = 2,
    CV_IMWRITE_PNG_STRATEGY_RLE = 3,
    CV_IMWRITE_PNG_STRATEGY_FIXED = 4,
    CV_IMWRITE_PXM_BINARY = 32,
    CV_IMWRITE_EXR_TYPE = 48,
    CV_IMWRITE_WEBP_QUALITY = 64,
    CV_IMWRITE_PAM_TUPLETYPE = 128,
    CV_IMWRITE_PAM_FORMAT_NULL = 0,
    CV_IMWRITE_PAM_FORMAT_BLACKANDWHITE = 1,
    CV_IMWRITE_PAM_FORMAT_GRAYSCALE = 2,
    CV_IMWRITE_PAM_FORMAT_GRAYSCALE_ALPHA = 3,
    CV_IMWRITE_PAM_FORMAT_RGB = 4,
    CV_IMWRITE_PAM_FORMAT_RGB_ALPHA = 5
};

enum {
    CV_CVTIMG_FLIP = 1,
    CV_CVTIMG_SWAP_RB = 2
};

enum {
    CV_INPAINT_NS = 0,
    CV_INPAINT_TELEA = 1
};
typedef unsigned char uchar;

typedef struct CvScalar {
    double val[4];
}
CvScalar;

typedef struct CvMemStorage CvMemStorage;
typedef signed char schar;

typedef struct CvSeqBlock
{
    struct CvSeqBlock*  prev; /* Previous sequence block.                   */
    struct CvSeqBlock*  next; /* Next sequence block.                       */
  int    start_index;         /* Index of the first element in the block +  */
                              /* sequence->first->start_index.              */
    int    count;             /* Number of elements in the block.           */
    schar* data;              /* Pointer to the first element of the block. */
}
CvSeqBlock;

typedef struct CvSeq {
       int       flags;             
       int       header_size;      
       struct    CvSeq* h_prev;   
       struct    CvSeq* h_next;   
       struct    CvSeq* v_prev;      
       struct    CvSeq* v_next; 
       int       total;          /* Total number of elements.            */ 
       int       elem_size;      /* Size of sequence element in bytes.   */ 
       schar*    block_max;      /* Maximal bound of the last block.     */ 
       schar*    ptr;            /* Current write pointer.               */ 
       int       delta_elems;    /* Grow seq this many at a time.        */ 
       CvMemStorage* storage;    /* Where the seq is stored.             */ 
       CvSeqBlock* free_blocks;  /* Free blocks list.                    */
       CvSeqBlock* first;        /* Pointer to the first sequence block. */
}CvSeq;

typedef struct CvSize {
    int width;
    int height;
}
CvSize;

typedef struct CvPoint
{
    int x;
    int y;
}
CvPoint;

typedef struct CvMat CvMat;
typedef void ( *CvTrackbarCallback) (int pos);
typedef void ( *CvTrackbarCallback2)(int pos, void* userdata);


#define CV_MATND_MAGIC_VAL    0x42430000
#define CV_TYPE_NAME_MATND    "opencv-nd-matrix"

#define CV_MAX_DIM            32
#define CV_MAX_DIM_HEAP       1024

typedef struct CvMatND CvMatND;
typedef struct CvRect CvRect;
struct CvSet;

typedef struct CvSparseMat CvSparseMat;

typedef struct CvSparseNode CvSparseNode;

typedef struct CvSparseMatIterator CvSparseMatIterator;

typedef void CvArr;

typedef union Cv32suf Cv32suf;

typedef union Cv64suf Cv64suf;

typedef struct CvSize CvSize;
typedef int CVStatus;
typedef int CvHistType;

#define CV_HIST_MAGIC_VAL     0x42450000
#define CV_HIST_UNIFORM_FLAG  (1 << 10)

/* indicates whether bin ranges are set already or not */
#define CV_HIST_RANGES_FLAG   (1 << 11)

#define CV_HIST_ARRAY         0
#define CV_HIST_SPARSE        1
#define CV_HIST_TREE          CV_HIST_SPARSE
#define CV_HIST_UNIFORM       1

typedef struct CvHistogram CvHistogram;

enum {
    CV_StsOk = 0, /* everithing is ok                */
    CV_StsBackTrace = -1, /* pseudo error for back trace     */
    CV_StsError = -2, /* unknown /unspecified error      */
    CV_StsInternal = -3, /* internal error (bad state)      */
    CV_StsNoMem = -4, /* insufficient memory             */
    CV_StsBadArg = -5, /* function arg/param is bad       */
    CV_StsBadFunc = -6, /* unsupported function            */
    CV_StsNoConv = -7, /* iter. didn't converge           */
    CV_StsAutoTrace = -8, /* tracing                         */
    CV_HeaderIsNull = -9, /* image header is NULL            */
    CV_BadImageSize = -10, /* image size is invalid           */
    CV_BadOffset = -11, /* offset is invalid               */
    CV_BadDataPtr = -12, /**/
    CV_BadStep = -13, /**/
    CV_BadModelOrChSeq = -14, /**/
    CV_BadNumChannels = -15, /**/
    CV_BadNumChannel1U = -16, /**/
    CV_BadDepth = -17, /**/
    CV_BadAlphaChannel = -18, /**/
    CV_BadOrder = -19, /**/
    CV_BadOrigin = -20, /**/
    CV_BadAlign = -21, /**/
    CV_BadCallBack = -22, /**/
    CV_BadTileSize = -23, /**/
    CV_BadCOI = -24, /**/
    CV_BadROISize = -25, /**/
    CV_MaskIsTiled = -26, /**/
    CV_StsNullPtr = -27, /* null pointer */
    CV_StsVecLengthErr = -28, /* incorrect vector length */
    CV_StsFilterStructContentErr = -29, /* incorr. filter structure content */
    CV_StsKernelStructContentErr = -30, /* incorr. transform kernel content */
    CV_StsFilterOffsetErr = -31, /* incorrect filter offset value */
    CV_StsBadSize = -201, /* the input/output structure size is incorrect  */
    CV_StsDivByZero = -202, /* division by zero */
    CV_StsInplaceNotSupported = -203, /* in-place operation is not supported */
    CV_StsObjectNotFound = -204, /* request can't be completed */
    CV_StsUnmatchedFormats = -205, /* formats of input/output arrays differ */
    CV_StsBadFlag = -206, /* flag is wrong or not supported */
    CV_StsBadPoint = -207, /* bad CvPoint */
    CV_StsBadMask = -208, /* bad format of mask (neither 8uC1 nor 8sC1)*/
    CV_StsUnmatchedSizes = -209, /* sizes of input/output structures do not match */
    CV_StsUnsupportedFormat = -210, /* the data format/type is not supported by the function*/
    CV_StsOutOfRange = -211, /* some of parameters are out of range */
    CV_StsParseError = -212, /* invalid syntax/structure of the parsed file */
    CV_StsNotImplemented = -213, /* the requested function/feature is not implemented */
    CV_StsBadMemBlock = -214, /* an allocated block has been corrupted */
    CV_StsAssert = -215, /* assertion failed */
    CV_GpuNotSupported = -216,
    CV_GpuApiCallError = -217,
    CV_OpenGlNotSupported = -218,
    CV_OpenGlApiCallError = -219,
    CV_OpenCLDoubleNotSupported = -220,
    CV_OpenCLInitError = -221,
    CV_OpenCLNoAMDBlasFft = -222
};

typedef struct CvCapture CvCapture;
typedef struct _IplROI
{
    int  coi; /* 0 - no COI (all channels are selected), 1 - 0th channel is selected ...*/
    int  xOffset;
    int  yOffset;
    int  width;
    int  height;
}
IplROI;
typedef struct _IplImage
{
    int  nSize;             /* sizeof(IplImage) */
    int  ID;                /* version (=0)*/
    int  nChannels;         /* Most of OpenCV functions support 1,2,3 or 4 channels */
    int  alphaChannel;      /* Ignored by OpenCV */
    int  depth;             /* Pixel depth in bits: IPL_DEPTH_8U, IPL_DEPTH_8S, IPL_DEPTH_16S,
                               IPL_DEPTH_32S, IPL_DEPTH_32F and IPL_DEPTH_64F are supported.  */
    char colorModel[4];     /* Ignored by OpenCV */
    char channelSeq[4];     /* ditto */
    int  dataOrder;         /* 0 - interleaved color channels, 1 - separate color channels.
                               cvCreateImage can only create interleaved images */
    int  origin;            /* 0 - top-left origin,
                               1 - bottom-left origin (Windows bitmaps style).  */
    int  align;             /* Alignment of image rows (4 or 8).
                               OpenCV ignores it and uses widthStep instead.    */
    int  width;             /* Image width in pixels.                           */
    int  height;            /* Image height in pixels.                          */
    struct _IplROI *roi;    /* Image ROI. If NULL, the whole image is selected. */
    struct _IplImage *maskROI;      /* Must be NULL. */
    void  *imageId;                 /* "           " */
    struct _IplTileInfo *tileInfo;  /* "           " */
    int  imageSize;         /* Image data size in bytes
                               (==image->height*image->widthStep
                               in case of interleaved data)*/
    char *imageData;        /* Pointer to aligned image data.         */
    int  widthStep;         /* Size of aligned image row in bytes.    */
    int  BorderMode[4];     /* Ignored by OpenCV.                     */
    int  BorderConst[4];    /* Ditto.                                 */
    char *imageDataOrigin;  /* Pointer to very origin of image data
                               (not necessarily aligned) -
                               needed for correct deallocation */
}
IplImage;
typedef struct CvVideoWriter CvVideoWriter;
typedef struct CvBox2D CvBox2D;
typedef struct CvVideoWriter CvVideoWriter;

typedef struct CvHaarClassifierCascade  CvHaarClassifierCascade ;
int cvNamedWindow(const char* name, int flags);

void cvSetWindowProperty(const char* name, int prop_id, double prop_value);
double cvGetWindowProperty(const char* name, int prop_id);
void cvShowImage(const char * name, const IplImage *image);
void cvResizeWindow(const char* name, int width, int height);
void cvMoveWindow(const char* name, int x, int y);
void cvDestroyWindow(const char *name);
void cvDestroyAllWindows(void);
void* cvGetWindowHandle(const char* name);
const char* cvGetWindowName(void* window_handle);

extern CvCapture* cvCreateCameraCapture(int index);
extern CvCapture* cvCreateFileCapture(const char* filename);
extern int cvGrabFrame(CvCapture* capture);
extern IplImage* cvRetrieveFrame(CvCapture* capture, int streamIdx);

extern IplImage* cvQueryFrame(CvCapture* capture);
extern void cvReleaseCapture(CvCapture **capture);

extern IplImage* cvLoadImage(const char* filename, int iscolor);


int cvSaveImage(const char *filename, const IplImage *image);
void cvConvertImage(const CvArr* src, CvArr* dst, int flags);

double cvGetCaptureProperty(CvCapture* capture, int property_id);
int cvSetCaptureProperty(CvCapture* capture, int property_id, double value);

// Return the type of the capturer (eg, CV_CAP_V4W, CV_CAP_UNICAP), which is unknown if created with CV_CAP_ANY
int cvGetCaptureDomain(CvCapture* capture);

#define CV_FOURCC_DEFAULT CV_FOURCC('I', 'Y', 'U', 'V')
extern CvVideoWriter* cvCreateVideoWriter(const char* filename, int fourcc,
        double fps, CvSize frame_size,
        int is_color);
extern int cvWriteFrame(CvVideoWriter* writer, const IplImage* image);
extern void cvReleaseVideoWriter(CvVideoWriter** writer);
int cvSetCaptureProperty(CvCapture* capture, int property_id, double value);

int cvHaveImageReader(const char *filename);

int cvHaveImageWriter(const char *filename);

int cvWaitKey(int delay);

/* this function is used to set some external parameters in case of X Window */
int cvInitSystem(int argc, char** argv);

int cvStartWindowThread(void);

int cvCreateTrackbar(const char *trackbar_name, const char *window_name, int *value, int count, CvTrackbarCallback on_change);

int cvCreateTrackbar2( const char* trackbar_name, const char* window_name,
                              int* value, int count, CvTrackbarCallback2 on_change,
                              void* userdata);

/* retrieve or set trackbar position */
int cvGetTrackbarPos( const char* trackbar_name, const char* window_name );
void cvSetTrackbarPos( const char* trackbar_name, const char* window_name, int pos );
//void cvSetTrackbarMax(const char* trackbar_name, const char* window_name, int maxval);
//void cvSetTrackbarMin(const char* trackbar_name, const char* window_name, int minval);                              

enum
{
    CV_EVENT_MOUSEMOVE      =0,
    CV_EVENT_LBUTTONDOWN    =1,
    CV_EVENT_RBUTTONDOWN    =2,
    CV_EVENT_MBUTTONDOWN    =3,
    CV_EVENT_LBUTTONUP      =4,
    CV_EVENT_RBUTTONUP      =5,
    CV_EVENT_MBUTTONUP      =6,
    CV_EVENT_LBUTTONDBLCLK  =7,
    CV_EVENT_RBUTTONDBLCLK  =8,
    CV_EVENT_MBUTTONDBLCLK  =9,
    CV_EVENT_MOUSEWHEEL     =10,
    CV_EVENT_MOUSEHWHEEL    =11
};

enum
{
    CV_EVENT_FLAG_LBUTTON   =1,
    CV_EVENT_FLAG_RBUTTON   =2,
    CV_EVENT_FLAG_MBUTTON   =4,
    CV_EVENT_FLAG_CTRLKEY   =8,
    CV_EVENT_FLAG_SHIFTKEY  =16,
    CV_EVENT_FLAG_ALTKEY    =32
};

typedef void (*CvMouseCallback )(int event, int x, int y, int flags, void* param);

/* assign callback for mouse events */
void cvSetMouseCallback( const char* window_name, CvMouseCallback on_mouse,
                                void* param);

/* wait for key event infinitely (delay<=0) or for "delay" milliseconds */
int cvWaitKey(int delay);
void cvUpdateWindow(const char* window_name);

/* core_cv.h*/
void* cvLoad(const char* filename, void* memstorage,
                     const char* name, const char** real_name);
CvMemStorage*  cvCreateMemStorage( int block_size);

void  cvReleaseMemStorage( CvMemStorage** storage );

schar* cvGetSeqElem( const CvSeq* seq, int index );

IplImage* cvCreateImage( CvSize size, int depth, int channels);

/*imageProc.h*/
void cvRectangle(CvArr* img, CvPoint pt1, CvPoint pt2, CvScalar color, int thickness, int line_type, int shift);
CvHistogram*  cvCreateHist( int dims, int* sizes, int type,float** ranges,int uniform);


