<?php

declare(strict_types=1);
namespace Elightwalk\Razorpay\Setup\Patch\Schema;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;


class SetupRazorpayTable implements SchemaPatchInterface {

    private $schemaSetup;
    private $tbl_name = "elightwalk_razorpay_sales_order";

    public function __construct(
        SchemaSetupInterface $schemaSetup
    ) {
        $this->schemaSetup = $schemaSetup;
    }

    public function apply() {

        $setup = $this->schemaSetup;
        $setup->startSetup();

        if (!$setup->getConnection()->isTableExists($this->tbl_name)) {

            $table = $setup->getConnection()
                        ->newTable($setup->getTable($this->tbl_name))
                        ->addColumn(
                            'entity_id',
                            Table::TYPE_INTEGER,
                            null,
                            [
                                'identity' => true,
                                'unsigned' => true,
                                'primary'  => true,
                                'nullable' => false
                            ]
                        )
                        ->addColumn(
                            'quote_id',
                            Table::TYPE_INTEGER,
                            [
                                'identity' => true,
                                'unique'   => true,
                                'nullable' => false
                            ]
                        )
                        ->addColumn(
                            'order_id',
                            Table::TYPE_INTEGER,
                            [
                                'nullable' => true
                            ]
                        )
                        ->addColumn(
                            'increment_order_id',
                            Table::TYPE_TEXT,
                            32,
                            [
                                'nullable' => true
                            ]
                        )
                        ->addColumn(
                            'rzp_order_id',
                            Table::TYPE_TEXT,
                            25,
                            [
                                'nullable' => true
                            ]
                        )
                        ->addColumn(
                            'rzp_payment_id',
                            Table::TYPE_TEXT,
                            25,
                            [
                                'nullable' => true
                            ]
                        )
                        ->addColumn(
                            'rzp_signature',
                            Table::TYPE_TEXT,
                            225,
                            [
                                'nullable' => true
                            ]
                        )
                        ->addColumn(
                            'rzp_order_amount',
                            Table::TYPE_INTEGER,
                            20,
                            [
                                'nullable' => true,
                                'comment'  => 'RZP order amount'
                            ]
                        )
                        ->addColumn(
                            'by_webhook',
                            Table::TYPE_BOOLEAN,
                            1,
                            [
                                'nullable' => false,
                                'default' => 0
                            ]
                        )
                        ->addColumn(
                            'by_frontend',
                            Table::TYPE_BOOLEAN,
                            1,
                            [
                                'nullable' => false,
                                'default' => 0
                            ]
                        )
                        ->addColumn(
                            'webhook_count',
                            Table::TYPE_SMALLINT,
                            3,
                            [
                                'nullable' => false,
                                'default' => 0
                            ]
                        )
                        ->addColumn(
                            'order_placed',
                            Table::TYPE_BOOLEAN,
                            1,
                            [
                                'nullable' => false,
                                'default' => 0
                            ]
                        )
                        ->addColumn(
                            'webhook_first_notified_at',
                            Table::TYPE_BIGINT,
                            [
                                'nullable' => true
                            ]
                        )
                        ->addColumn(
                            'amount_paid',
                            Table::TYPE_INTEGER,
                            20,
                            [
                                'nullable' => true,
                                'comment'  => 'Actual paid amount'
                            ]
                        )
                        ->addColumn(
                            'email',
                            Table::TYPE_TEXT,
                            255,
                            [
                                'nullable' => true,
                                'comment'  => 'payment email'
                            ]
                        )
                        ->addColumn(
                            'contact',
                            Table::TYPE_TEXT,
                            25,
                            [
                                'nullable' => true,
                                'comment'  => 'payment contact'
                            ]
                        )
                        ->addIndex(
                            'quote_id',
                            ['quote_id', 'rzp_payment_id'],
                            [
                                'type'      => AdapterInterface::INDEX_TYPE_UNIQUE,
                                'nullable'  => false,
                            ]
                        )
                        ->addIndex(
                            'increment_order_id',
                            ['increment_order_id'],
                            [
                                'type'      => AdapterInterface::INDEX_TYPE_UNIQUE,
                            ]
                        );

            $setup->getConnection()->createTable($table);

        }
        $this->schemaSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
