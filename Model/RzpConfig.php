<?php

namespace Elightwalk\Razorpay\Model;

use Elightwalk\Razorpay\Api\RazorpayConfigInterface;


class RzpConfig implements RazorpayConfigInterface
{
    protected $data;

    public function __construct(
        \Elightwalk\Razorpay\Helper\Data $data
    ) {
        $this->data = $data;
    }

    /**
     *  {@inheritdoc}
     */
    public function getRzpConfig() {

        $obj = $this->data->getScopeConfig("payment/razorpay");
        return [$obj];
    }
}
