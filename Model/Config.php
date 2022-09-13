<?php

namespace Elightwalk\Razorpay\Model;

use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Framework\App\Config\Storage\WriterInterface;

class Config {

    const KEY_ALLOW_SPECIFIC = 'allowspecific';
    const KEY_SPECIFIC_COUNTRY = 'specificcountry';
    const KEY_ACTIVE = 'active';
    const KEY_PUBLIC_KEY = 'key_id';
    const KEY_PRIVATE_KEY = 'key_secret';
    const KEY_MERCHANT_NAME_OVERRIDE = 'merchant_name_override';
    const KEY_PAYMENT_ACTION = 'payment_action';
    // const ENABLE_WEBHOOK = 'enable_webhook';
    // const WEBHOOK_SECRET = 'webhook_secret';
    // const WEBHOOK_WAIT_TIME = 'webhook_wait_time';
    const DISABLE_UPGRADE_NOTICE = 'disable_upgrade_notice';
    const SKIP_AMOUNT_MISMATCH_ORDER = 'skip_amount_mismatch_order';

    /**
     * @var string
     */
    protected $methodCode = 'razorpay';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    protected $configWriter;

    /**
     * @var int
     */
    protected $storeId = null;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        WriterInterface $configWriter
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->configWriter = $configWriter;
    }

    /**
     * @return string
     */
    public function getMerchantNameOverride(){

        return $this->getConfigData(self::KEY_MERCHANT_NAME_OVERRIDE);
    }

    public function getKeyId() {

        return $this->getConfigData(self::KEY_PUBLIC_KEY);
    }

    // public function isWebhookEnabled() {

    //     return (bool) (int) $this->getConfigData(self::ENABLE_WEBHOOK, $this->storeId);
    // }

    // public function getWebhookSecret() {

    //     return $this->getConfigData(self::WEBHOOK_SECRET);
    // }
    
    public function getPaymentAction() {

        return $this->getConfigData(self::KEY_PAYMENT_ACTION);
    }

    public function isSkipOrderEnabled() {

        return (bool) (int) $this->getConfigData(self::SKIP_AMOUNT_MISMATCH_ORDER, $this->storeId);
    }

    /**
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($storeId) {

        $this->storeId = $storeId;
        return $this;
    }

    /**
     * Retrieve information from payment configuration
     *
     * @param string $field
     * @param null|string $storeId
     *
     * @return mixed
     */
    public function getConfigData($field, $storeId = null) {
        
        if ($storeId == null) {
            $storeId = $this->storeId;
        }

        $code = $this->methodCode;

        $path = 'payment/' . $code . '/' . $field;
        return $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * Set information from payment configuration
     *
     * @param string $field
     * @param string $value
     * @param null|string $storeId
     *
     * @return mixed
     */
    public function setConfigData($field, $value) {

        $code = $this->methodCode;

        $path = 'payment/' . $code . '/' . $field;

        return $this->configWriter->save($path, $value);
    }

    /**
     * @return bool
     */
    public function isActive() {

        return (bool) (int) $this->getConfigData(self::KEY_ACTIVE, $this->storeId);
    }

    /**
     * To check billing country is allowed for the payment method
     *
     * @param string $country
     * @return bool
     */
    public function canUseForCountry($country) {
        /*
        for specific country, the flag will set up as 1
        */
        if ($this->getConfigData(self::KEY_ALLOW_SPECIFIC) == 1) {

            $availableCountries = explode(',', $this->getConfigData(self::KEY_SPECIFIC_COUNTRY));
            if (!in_array($country, $availableCountries)) {
                return false;
            }
        }

        return true;
    }
}
