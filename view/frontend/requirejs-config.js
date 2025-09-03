var config = {
    paths: {
        "amici_flipper": "Amici_ImageFlipper/js/amici_flipper"
    },
    shim: {
        'amici_flipper': {
            deps: ['jquery']
        }
    },
    config: {
        mixins: {
            'Magento_Swatches/js/swatch-renderer': {
                'Amici_ImageFlipper/js/swatch-renderer-mixin': true
            }
        }
    }
};
