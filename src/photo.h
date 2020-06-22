#define FFI_SCOPE "Object_D"
#define FFI_LIB "/usr/lib/x86_64-linux-gnu/libopencv_photo.so"

enum InpaintingModes {
    CV_INPAINT_NS      =0,
    CV_INPAINT_TELEA   =1
};


/* Inpaints the selected region in the image */
void cvInpaint( const CvArr* src, const CvArr* inpaint_mask,
                       CvArr* dst, double inpaintRange, int flags );
