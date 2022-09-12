<?php

namespace Elightwalk\Razorpay\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallRazorpayData implements InstallDataInterface {

    private $tbl_name = "elightwalk_razorpay_sales_order";

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {

        $setup->startSetup();

        $conn = $setup->getConnection(); 
        $tableName = $setup->getTable($this->tbl_name);

            $data = [
                [
                    'entity_id' => 1,
                    'quote_id' => 1,
                    'by_webhook' => false,
                    'by_frontend' => false,
                    'webhook_count' => 10,
                    'order_placed' => false,
                    'increment_order_id' => 101,
                ],
                [
                    'entity_id' => 2,
                    'quote_id' => 2,
                    'by_webhook' => false,
                    'by_frontend' => false,
                    'webhook_count' => 11,
                    'order_placed' => false,
                    'increment_order_id' => 111,
                ]
            ];
           $conn->insertMultiple($tableName, $data); 

           $setup->endSetup(); 
    } 
}