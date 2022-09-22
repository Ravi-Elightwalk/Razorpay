<?php

namespace Elightwalk\Razorpay\Model;

use Elightwalk\Razorpay\Api\CodeInterface;

class RzpConfig implements CodeInterface 
{
    protected $_data;

    public function __construct(
        \Elightwalk\Razorpay\Helper\Data $data
    ) {
        $this->_data = $data;
    }

    /**
     *  {@inheritdoc}
     */
    public function getRzpConfig()
    {

        $obj = $this->_data->getScopeConfig("payment/razorpay");
        return [$obj];
    }

    public function setRzpData()
    {
        $data = array(
            "rzp_payment_id" => $_POST['razorpay_payment_id'],
            "rzp_order_id"   => $_POST['razorpay_order_id'],
            "rzp_signature"  => $_POST['razorpay_signature'],
        );

        $this->_data->setRzpOrderData($data);
        
        return "successfully Inserted.";
    }

    private function setRzpOrderData($tbl_name, $data = array()) 
    {
        // This is not best way to store Data
        
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName($tbl_name);

        $sql = "Insert Into " . $tableName;
        $_val = ""; $_key = "";
        foreach ($data as $key => $val) {
            $_key .= ($_key=="") ? $key : ", ".$key;
            $_val .= ($val == "") ? "''" : (($_val=="") ? "'".$val."'" : ", '".$val."'");
        }

        $sql = "Insert Into " . $tableName . " (".$_key.") Values (".$_val.")";
        $connection->query($sql);
        return $_val;
    }
}
