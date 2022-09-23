<?php

namespace Elightwalk\Razorpay\Model\Config\Source;

class OptionArray implements \Magento\Framework\Option\ArrayInterface {

    public function toOptionArray() : void  
    {
    }

    public function cardOptionArray() : array 
    {
        return[
            ['value' => 0, 'label' => __("Allowed All Card Networks")],
            ['value' => 1, 'label' => __('Specific Card Networks')]
        ];
    }

    public function cardtypeOptionArray() : array
    {
        return [
            ['value' => 0, 'label' => __('Allowed All Types')],
            ['value' => 1, 'label' => __('Only Credit')],
            ['value' => 2, 'label' => __('Only Debit')],
        ];
    }

    public function suppotedcardOptArr() : array 
    {
        return [
            ['value' => 0, 'label' => __('Allowed All Cards')],
            ['value' => 1, 'label' => __('Specific Cards')]
        ];
    }

    public function netbankingOptArr() : array 
    {
        return [
            ['value' => 0, 'label' => __("Allowed All Banks")],
            ['value' => 1, 'label' => __('Specific Banks')]
        ];
    }

    public function walletOptArr() : array 
    {
        return [
            ['value' => 0, 'label' => __('Allowed All Wallet Apps')],
            ['value' => 1, 'label' => __('Specific Wallet Apps')]
        ];
    }

    public function upiOptArr() : array 
    {
        return [
            ['value' => 0, 'label' => __('Allowed All UPI Apps')],
            ['value' => 1, 'label' => __('Specific UPI Apps')]
        ];
    }

    public function webhookEventsOptArr() : array 
    {
        return [
            [
                'value' => "order.paid",
                'label' => __('order.paid'),
            ],
            [
                'value' => "payment.authorized",
                'label' => __('payment.authorized'),
            ],
        ];
    }

}
