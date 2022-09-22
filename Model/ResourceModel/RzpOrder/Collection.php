<?php

namespace Elightwalk\Razorpay\Model\ResourceModel\RzpOrder;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;


class Collection extends AbstractCollection {
    
    public function _construct() {
        
        $this->_init('Elightwalk\Razorpay\Model\RzpOrder', 'Elightwalk\Razorpay\Model\ResourceModel\RzpOrder');
    }
}