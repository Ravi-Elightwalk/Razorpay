<?php

declare(strict_types=1);
namespace Elightwalk\Razorpay\Setup\Patch\Schema;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;


class SetupRzpOrderTable implements SchemaPatchInterface {

    private $schemaSetup;
    private $tbl_name = "elightwalk_razorpay_order_details";

    public function __construct(
        SchemaSetupInterface $schemaSetup
    ) {
        $this->schemaSetup = $schemaSetup;
    }

    public function apply() {

        $setup = $this->schemaSetup;
        $setup->startSetup();
        $conn = $setup->getConnection();

        // if ($conn->isTableExists($this->tbl_name)) {
        //     $conn->dropTable($setup->getTable($this->tbl_name));
        // }

        $table = $conn->newTable($setup->getTable($this->tbl_name))
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
        );
        $conn->createTable($table);
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
