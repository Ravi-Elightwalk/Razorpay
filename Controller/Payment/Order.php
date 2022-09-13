<?php

namespace Elightwalk\Razorpay\Controller\Payment;

use Razorpay\Api\Api;
use Elightwalk\Razorpay\Model\PaymentMethod;
use Magento\Framework\Controller\ResultFactory;

class Order extends \Elightwalk\Razorpay\Controller\BaseController {

    protected $quote;
    protected $checkoutSession;
    protected $cartManagement;
    protected $cache;
    protected $orderRepository;
    protected $logger;

    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Elightwalk\Razorpay\Model\Config $config,
        \Magento\Quote\Api\CartManagementInterface $cartManagement,
        // \Elightwalk\Razorpay\Model\CheckoutFactory $checkoutFactory,
        \Magento\Framework\App\CacheInterface $cache,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::__construct(
            $context,
            $customerSession,
            $checkoutSession,
            $config
        );

        $this->config          = $config;
        $this->cartManagement  = $cartManagement;
        $this->customerSession = $customerSession;
        // $this->checkoutFactory = $checkoutFactory;
        $this->cache = $cache;
        $this->orderRepository = $orderRepository;
        $this->logger          = $logger;

        $this->objectManagement   = \Magento\Framework\App\ObjectManager::getInstance();
    }

    public function execute() {

        $receipt_id = $this->getQuote()->getId();

        if(empty($_POST['error']) === false) {

            $this->messageManager->addError(__('Payment Failed'));
            return $this->_redirect('checkout/cart');
        }

        if (isset($_POST['order_check'])) {

            if (empty($this->cache->load("quote_processing_".$receipt_id)) === false) {

                $responseContent = [
                    'success'   => true,
                    'order_id'  => false,
                    'parameters' => []
                ];

                # fetch the related sales order and verify the payment ID with rzp payment id
                # To avoid duplicate order entry for same quote
                $collection = $this->_objectManager->get('Magento\Sales\Model\Order')
                                                   ->getCollection()
                                                   ->addFieldToSelect('entity_id')
                                                   ->addFilter('quote_id', $receipt_id)
                                                   ->getFirstItem();

                $salesOrder = $collection->getData();

                if (empty($salesOrder['entity_id']) === false) {

                    $this->logger->info("Razorpay inside order already processed with webhook quoteID:" . $receipt_id
                                    ." and OrderID:".$salesOrder['entity_id']);

                    $this->checkoutSession
                            ->setLastQuoteId($this->getQuote()->getId())
                            ->setLastSuccessQuoteId($this->getQuote()->getId())
                            ->clearHelperData();

                    $order = $this->orderRepository->get($salesOrder['entity_id']);

                    if ($order) {
                        $this->checkoutSession->setLastOrderId($order->getId())
                                           ->setLastRealOrderId($order->getIncrementId())
                                           ->setLastOrderStatus($order->getStatus());
                    }

                    $responseContent['order_id'] = true;
                }
            } else {

                if(empty($receipt_id) === false) {

                    //set the chache to stop webhook processing
                    $this->cache->save("started", "quote_Front_processing_$receipt_id", ["razorpay"], 30);

                    $this->logger->info("Razorpay front-end order processing started quoteID:" . $receipt_id);

                    $responseContent = [
                        'sucecss'   => false,
                        'parameters' => []
                    ];

                } else {

                    $this->logger->info("Razorpay order already processed with quoteID:" . $this->checkoutSession
                            ->getLastQuoteId());

                    $responseContent = [
                        'success'    => true,
                        'order_id'   => true,
                        'parameters' => []
                    ];

                }
            }

            $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
            $response->setData($responseContent);
            $response->setHttpResponseCode(200);

            return $response;
        }

        //validate shipping and billing
        $validationSuccess =  true;
        $code = 200;


        if(empty($_POST['email']) === true) {

            $this->logger->info("Email field is required");

            $responseContent = [
                'message'   => "Email field is required",
                'parameters' => []
            ];

            $validationSuccess = false;
        }

        if(empty($this->getQuote()->getBillingAddress()->getPostcode()) === true) {

            $responseContent = [
                'message'   => "Billing Address is required",
                'parameters' => []
            ];

            $validationSuccess = false;
        }

        if(!$this->getQuote()->getIsVirtual()) {

            //validate quote Shipping method
            if(empty($this->getQuote()->getShippingAddress()->getShippingMethod()) === true) {

                $responseContent = [
                    'message'   => "Shipping method is required",
                    'parameters' => []
                ];

                $validationSuccess = false;
            }

            if(empty($this->getQuote()->getShippingAddress()->getPostcode()) === true) {

                $responseContent = [
                    'message'   => "Shipping Address is required",
                    'parameters' => []
                ];

                $validationSuccess = false;
            }
        }

        if($validationSuccess) {

            $amount = (int) (number_format($this->getQuote()->getGrandTotal() * 100, 0, ".", ""));

            $payment_action = $this->config->getPaymentAction();

            $maze_version = $this->_objectManager->get('Magento\Framework\App\ProductMetadataInterface')->getVersion();
            $module_version =  $this->_objectManager->get('Magento\Framework\Module\ModuleList')->getOne('Elightwalk_Razorpay')['setup_version'];

            $this->customerSession->setCustomerEmailAddress($_POST['email']);
            
            $payment_capture = ($payment_action === 'authorize') ? 0 : 1;

            $code = 400;

            try {

                //save to razorpay orderLink
                $orderLinkCollection = $this->_objectManager->get('Elightwalk\Razorpay\Model\OrderLink')
                                                       ->getCollection()
                                                       ->addFilter('quote_id', $receipt_id)
                                                       ->getFirstItem();

                $orderLinkData = $orderLinkCollection->getData();

                $createNewOrder = true;

                if (empty($orderLinkData['entity_id']) === false) {

                    if (((int) $orderLinkData['rzp_order_amount'] === $amount)  and (isset($orderLinkData['rzp_order_id']) === true)) {

                        $createNewOrder = false;
                    }
                }

                if ($createNewOrder) {

                    $order = $this->rzp->order->create([
                        'amount' => $amount,
                        'receipt' => $receipt_id,
                        'currency' => $this->getQuote()->getQuoteCurrencyCode(),
                        'payment_capture' => $payment_capture,
                        'app_offer' => ($this->getDiscount() > 0) ? 1 : 0
                    ]);

                } else {

                    if (isset($orderLinkData['rzp_order_id']) === true) {

                        $order = $this->rzp->order->fetch($orderLinkData['rzp_order_id']);
                    }
                }

                $responseContent = [
                    'message'   => 'Unable to create your order. Please contact support.',
                    'parameters' => []
                ];

                if (null !== $order && !empty($order->id)) {

                    $is_hosted = false;

                    $merchantPreferences    = $this->getMerchantPreferences();

                    $responseContent = [
                        'success'           => true,
                        'rzp_order'         => $order->id,
                        'order_id'          => $receipt_id,
                        'amount'            => $order->amount,
                        'quote_currency'    => $this->getQuote()->getQuoteCurrencyCode(),
                        'quote_amount'      => number_format($this->getQuote()->getGrandTotal(), 2, ".", ""),
                        'maze_version'      => $maze_version,
                        'module_version'    => $module_version,
                        'is_hosted'         => $merchantPreferences['is_hosted'],
                        'image'             => $merchantPreferences['image'],
                        'embedded_url'      => $merchantPreferences['embedded_url'],
                    ];

                    $code = 200;

                    $this->checkoutSession->setRazorpayOrderID($order->id);
                    $this->checkoutSession->setRazorpayOrderAmount($amount);

                    if (empty($orderLinkData['entity_id']) === false) {

                        $orderLinkCollection->setRzpOrderId($order->id)
                                            ->setRzpOrderAmount($amount)
                                            ->setEmail($_POST['email'])
                                            ->save();
                    } else {

                        $orderLnik = $this->_objectManager->create('Elightwalk\Razorpay\Model\OrderLink');
                        $orderLnik->setQuoteId($receipt_id)
                                  ->setRzpOrderId($order->id)
                                  ->setRzpOrderAmount($amount)
                                  ->setEmail($_POST['email'])
                                  ->save();
                    }

                }
            }
            catch(\Razorpay\Api\Errors\Error $e) {

                $responseContent = [
                    'message1'   => $e->getMessage(),
                    'parameters' => []
                ];
            }
            catch(\Exception $e) {

                $responseContent = [
                    'message2'   => $e->getMessage(),
                    'parameters' => []
                ];
            }
        }

        //set the chache for race with webhook
        $this->cache->save("started", "quote_Front_processing_$receipt_id", ["razorpay"], 300);

        $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $response->setData($responseContent);
        $response->setHttpResponseCode($code);

        return $response;

    }

    public function getOrderID() {

        return $this->checkoutSession->getRazorpayOrderID();
    }

    public function getRazorpayOrderAmount() {

        return $this->checkoutSession->getRazorpayOrderAmount();
    }

    protected function getMerchantPreferences() {

        try {

            $api = new Api($this->config->getKeyId(),"");

            $response = $api->request->request("GET", "preferences");    

        } catch (\Razorpay\Api\Errors\Error $e) {

            echo 'Magento Error : ' . $e->getMessage();
        }

        $preferences = [];

        $preferences['embedded_url'] = Api::getFullUrl("checkout/embedded");
        $preferences['is_hosted'] = false;
        $preferences['image'] = $response['options']['image'];

        if(isset($response['options']['redirect']) && $response['options']['redirect'] === true) {

            $preferences['is_hosted'] = true;
        }

        return $preferences;
    }

    public function getDiscount() {

        return ($this->getQuote()->getBaseSubtotal() - $this->getQuote()->getBaseSubtotalWithDiscount());
    }
}