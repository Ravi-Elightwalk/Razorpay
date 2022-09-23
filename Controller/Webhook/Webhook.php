<?php

namespace Elightwalk\Razorpay\Controller\Webhook;

use Elightwalk\Razorpay\Controller\Webhook\Order;

class Webhook extends \Magento\Framework\App\Action\Action
{
	protected $_order;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		Order $order
	) {
		parent::__construct($context);

		$this->_order = $order;
	}
	
	public function execute()
	{
		$request = $this->getReqFromRzp();

		if ($request['event'] == "order.paid")
		{
			$this->_order->paid($request);

		}
	}

	private function getReqFromRzp() {

		$obj = [
			"entity"=> "event",
			"account_id"=> "acc_BFQ7uQEaa7j2z7",
			"event"=> "order.paid",
			"contains"=> [
				"payment",
				"order"
			],

			"payload" => [
				"payment" => [
					"entity"=> [
						"id"=> "pay_DESp9bgForNoUd",
						"entity"=> "payment",
						"amount"=> 6200,
						"currency"=> "INR",
						"status"=> "captured",
						"order_id"=> "order_KJggxVw6S17Q34",
						"invoice_id"=> null,
						"international"=> false,
						"method"=> "card",
						"amount_refunded"=> 0,
						"refund_status"=> null,
						"captured"=> true,
						"description"=> null,
						"card_id"=> "card_DESp9fNnu0RoNc",
						"card"=> [
							"id"=> "card_DESp9fNnu0RoNc",
							"entity"=> "card",
							"name"=> "Gaurav Kumar",
							"last4"=> "1111",
							"network"=> "Visa",
							"type"=> "debit",
							"issuer"=> null,
							"international"=> false,
							"emi"=> false
						],
						"bank"=> null,
						"wallet"=> null,
						"vpa"=> null,
						"email"=> "gaurav.kumar@example.com",
						"contact"=> "+919876543210",
						"notes"=> [],
						"fee"=> 2,
						"tax"=> 0,
						"error_code"=> null,
						"error_description"=> null,
						"created_at"=> 1567674797
					]
				]
			],

			"order" => [
				"entity"=> [
					"id"=> "order_DESoU0U4ikYA19",
					"entity"=> "order",
					"amount"=> 100,
					"amount_paid"=> 100,
					"amount_due"=> 0,
					"currency"=> "INR",
					"receipt"=> "rcptid #1",
					"offer_id"=> null,
					"status"=> "paid",
					"attempts"=> 1,
					"notes"=> [],
					"created_at"=> 1567674759
				]
			],

			"created_at"=> 1567674804,
		];

		return $obj;
	}
}
