define([
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push({
            type: 'razorpay',
            component: 'Elightwalk_Razorpay/js/view/payment/method-renderer/razorpay-method'
        });
        return Component.extend({});
    }
);