<?php

namespace Elightwalk\Razorpay\Model\ResourceModel\OrderLink;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;


class Collection extends AbstractCollection {
    
    public function _construct() {
        
        $this->_init('Elightwalk\Razorpay\Model\OrderLink', 'Elightwalk\Razorpay\Model\ResourceModel\OrderLink');
    }
}