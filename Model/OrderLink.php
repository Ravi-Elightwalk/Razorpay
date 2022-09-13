<?php

namespace Elightwalk\Razorpay\Model;

use Magento\Cron\Exception;
use Magento\Framework\Model\AbstractModel;

class OrderLink extends AbstractModel {
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Elightwalk\Razorpay\Model\ResourceModel\OrderLink::class);
    }
    
}
