<?php


namespace Elightwalk\Razorpay\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class RzpOrder extends AbstractDb {

    const TABLE_NAME = 'elightwalk_razorpay_order_details';
    
    protected function _construct() {
        
        $this->_init(static::TABLE_NAME, 'entity_id');
    }
}
