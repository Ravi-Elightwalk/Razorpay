<?php

namespace Elightwalk\Razorpay\Controller;

if (class_exists('Razorpay\\Api\\Api')  === false) {
    require_once __DIR__ . "/../../Razorpay/Razorpay.php"; 
}

use Razorpay\Api\Api;
use Elightwalk\Razorpay\Model\Config;
use Magento\Framework\App\RequestInterface;

abstract class BaseController extends \Magento\Framework\App\Action\Action {


    protected $checkoutFactory;

    protected $quote = false;

    protected $customerSession;

    protected $checkoutSession;

    protected $checkout;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Elightwalk\Razorpay\Model\Config $config
    ) {
        parent::__construct($context);
        $this->customerSession = $customerSession;
        $this->checkoutSession = $checkoutSession;
        $this->config = $config;

        $this->key_id = $this->config->getConfigData(Config::KEY_PUBLIC_KEY);
        $this->key_secret = $this->config->getConfigData(Config::KEY_PRIVATE_KEY);

        $this->rzp = new Api($this->key_id, $this->key_secret);
    }

    protected function initCheckout() {

        $quote = $this->getQuote();
        if (!$quote->hasItems() || $quote->getHasError()) {
            $this->getResponse()->setStatusHeader(403, '1.1', 'Forbidden');
            throw new \Magento\Framework\Exception\LocalizedException(__('We can\'t initialize checkout.'));
        }
    }

    protected function getQuote() {

        if (!$this->quote) {
            $this->quote = $this->checkoutSession->getQuote();
        }
        return $this->quote;
    }

    protected function getCheckout() {
        
        if (!$this->checkout) {
            $this->checkout = $this->checkoutFactory->create(
                [
                    'params' => [
                        'quote' => $this->checkoutSession->getQuote(),
                    ],
                ]
            );
        }
        return $this->checkout;
    }
}
