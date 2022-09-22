<?php

namespace Elightwalk\Razorpay\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;

class Data extends AbstractHelper {

    protected $_scopeConfig;
	protected $_storeManager;
    protected $_rzporder;

	public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        \Elightwalk\Razorpay\Model\RzpOrder $rzporder
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_storeManager = $storeManager;
        $this->_rzporder = $rzporder;
    }

   	public function getScopeConfig($path, $storeId = null, $scopeInterface = ScopeInterface::SCOPE_STORE) {
        if(!$storeId) {
            return $this->_scopeConfig->getValue($path);
        }

        $storeId = $this->getStoreId(); 
	    return $this->_scopeConfig->getValue($path, $scopeInterface, $storeId);
	}

    public function getStoreId() {

        return $this->_storeManager->getStore()->getId();
    }

    public function setRzpOrderData($data = array()) {
        
		$this->_rzporder->setRzpPaymentId($data['rzp_payment_id'])
						->setRzpOrderId($data['rzp_order_id'])
						->setRzpSignature($data['rzp_signature'])
						->save();
    } 

}