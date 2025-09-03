define([
    'jquery'
    ], function ($) {
    'use strict';

    return function (widget) {
        $.widget('mage.SwatchRenderer', widget, {
            _LoadProductMedia: function () {
                var $widget = this,
                    $this = $widget.element,
                    productData = this._determineProductData(),
                    mediaCallData,
                    mediaCacheKey,
                    
                    mediaSuccessCallback = function (data) {

                        if (!(mediaCacheKey in $widget.options.mediaCache)) {
                            $widget.options.mediaCache[mediaCacheKey] = data;
                        }
                        $widget._ProductMediaCallback($this, data, productData.isInProductView);
                        setTimeout(function () {
                            $widget._DisableProductMediaLoader($this);
                        }, 300);
                    };
                var $product = $this.parents($widget.options.selectorProduct);
                var pId = this.getProduct();
                $product.find('#amici_flipper_img').attr('data-img', '');
                if (typeof $widget.options.imageFlipper[pId] !== "undefined") {
                    var fliperImg = $widget.options.imageFlipper[pId].flipper_image;
                    $product.find('#amici_flipper_img').attr('data-img', fliperImg);
                }
                if (!$widget.options.mediaCallback) {
                    return;
                }
                mediaCallData = {
                    'product_id': this.getProduct()
                };
                mediaCacheKey = JSON.stringify(mediaCallData);

                if (mediaCacheKey in $widget.options.mediaCache) {
                    $widget._XhrKiller();
                    $widget._EnableProductMediaLoader($this);
                    mediaSuccessCallback($widget.options.mediaCache[mediaCacheKey]);
                } else {
                    mediaCallData.isAjax = true;
                    $widget._XhrKiller();
                    $widget._EnableProductMediaLoader($this);
                    $widget.xhr = $.ajax({
                        url: $widget.options.mediaCallback,
                        cache: true,
                        type: 'GET',
                        dataType: 'json',
                        data: mediaCallData,
                        success: mediaSuccessCallback
                    }).done(function () {
                        $widget._XhrKiller();
                    });
                }
            },
        });
        return $.mage.SwatchRenderer;
    };
});
