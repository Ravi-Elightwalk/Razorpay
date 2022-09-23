<?php 

namespace Elightwalk\Razorpay\Controller\Webhook;

use Elightwalk\Razorpay\Model\OrderLink;
use Magento\Framework\Event\Observer;

class Order
{
    protected $_orderLink;
    protected $_observer;
    protected $_request;


    public function __construct(
        OrderLink $orderlLink,
        Observer $observer,
        \Magento\Framework\App\RequestInterface $request )
    {
        $this->_orderLink   = $orderlLink;
        $this->_observer    = $observer;
        $this->_request     = $request;
    }

    public function paid($data)
    {

        $entity = $data['payload']['payment']['entity'];

        $obj = $this->_orderLink
                    ->getCollection()
                    ->addFilter("rzp_order_id", $entity['order_id'])
                    ->getFirstItem()
                    ->getData();
        
        if ((float) $obj['rzp_order_amount'] === (float) $entity['amount']) {
            $this->createInvoice();
        }
    }

    public function createInvoice()
    {
        $invoice = $this->_request->getPost();
        $order_data = $invoice;

        echo "<pre>";
        print_r($order_data);
    }
}