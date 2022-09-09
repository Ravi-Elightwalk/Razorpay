<?php

namespace Elightwalk\Razorpay\Model\Config\Source;

class Allspecificcountries implements \Magento\Framework\Option\ArrayInterface {

    public function toOptionArray() {
        
        return [
            ['value' => 0, 'label' => __('All Allowed Countries')],
            ['value' => 1, 'label' => __('Specific Countries')]
        ];
    }
}
