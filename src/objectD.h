#define FFI_SCOPE "Object_D"
#define FFI_LIB "/usr/lib/x86_64-linux-gnu/libopencv_objdetect.so"


#define CV_HAAR_MAGIC_VAL    0x42500000
#define CV_TYPE_NAME_HAAR    "opencv-haar-classifier"
#define CV_HAAR_FEATURE_MAX  3


typedef struct CvRect {
    int x;
    int y;
    int width;
    int height;
}
CvRect;

typedef struct CvSize {
    int width;
    int height;
}
CvSize;

typedef struct CvHaarFeature {
    int tilted;
    struct {
        CvRect r;
        float weight;
    } rect[3];
} CvHaarFeature;

typedef struct CvHaarClassifier {
    int count;
    CvHaarFeature* haar_feature;
    float* threshold;
    int* left;
    int* right;
    float* alpha;
} CvHaarClassifier;

typedef struct CvHaarStageClassifier {
    int  count;
    float threshold;
    CvHaarClassifier* classifier;

    int next;
    int child;
    int parent;
} CvHaarStageClassifier;

typedef struct CvHidHaarClassifierCascade CvHidHaarClassifierCascade;
typedef struct CvHaarClassifierCascade {
    int  flags;
    int  count;
    CvSize orig_window_size;
    CvSize real_window_size;
    double scale;
    CvHaarStageClassifier* stage_classifier;
    CvHidHaarClassifierCascade* hid_cascade;
} CvHaarClassifierCascade;

typedef struct CvAvgComp {
    CvRect rect;
    int neighbors;
} CvAvgComp;

typedef signed char schar;

typedef struct CvMemBlock {
    struct CvMemBlock*  prev;
    struct CvMemBlock*  next;
}
CvMemBlock;

typedef struct CvMemStorage {
    int signature;
    CvMemBlock* bottom;           /* First allocated block.                   */
    CvMemBlock* top;              /* Current memory block - top of the stack. */
    struct  CvMemStorage* parent; /* We get new blocks from parent as needed. */
    int block_size;               /* Block size.                              */
    int free_space;               /* Remaining free space in current block.   */
}
CvMemStorage;


typedef struct CvSeqBlock {
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


typedef struct CvPoint {
    int x;
    int y;
}
CvPoint;
typedef void CvArr;


/* Loads haar classifier cascade from a directory.
   It is obsolete: convert your cascade to xml and use cvLoad instead */
CvHaarClassifierCascade* cvLoadHaarClassifierCascade( const char* directory, CvSize orig_window_size);

void cvReleaseHaarClassifierCascade( CvHaarClassifierCascade** cascade );

#define CV_HAAR_DO_CANNY_PRUNING    1
#define CV_HAAR_SCALE_IMAGE         2
#define CV_HAAR_FIND_BIGGEST_OBJECT 4
#define CV_HAAR_DO_ROUGH_SEARCH     8

CvSeq* cvHaarDetectObjects( const CvArr* image,
                     CvHaarClassifierCascade* cascade, CvMemStorage* storage,
                     double scale_factor,
                     int min_neighbors, int flags,
                     CvSize min_size, CvSize max_size);

/* sets images for haar classifier cascade */
void cvSetImagesForHaarClassifierCascade( CvHaarClassifierCascade* cascade,
                                                const CvArr* sum, const CvArr* sqsum,
                                                const CvArr* tilted_sum, double scale );

/* runs the cascade on the specified window */
int cvRunHaarClassifierCascade( const CvHaarClassifierCascade* cascade,CvPoint pt, int start_stage);
