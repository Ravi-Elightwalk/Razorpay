<?php

namespace Elightwalk\Razorpay\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;

class Data extends AbstractHelper {

    protected $_scopeConfig;

	protected $_storeManager;

	public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_storeManager = $storeManager;
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

}