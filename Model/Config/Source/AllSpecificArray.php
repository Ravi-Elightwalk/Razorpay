<?php

namespace Elightwalk\Razorpay\Model\Config\Source;

class AllSpecificArray implements \Magento\Framework\Option\ArrayInterface {

    public function toOptionArray($isMultiselect = false) {}


    public function suppotedcardOptArray($isMultiselect = false) {

        $supported_cards = array(

            ['value' => "AUBL", 'label' => __('AU Small Finance Bank')],
            ['value' => "ABPB", 'label' => __('Aditya Birla Idea Payments Bank')],
            ['value' => "AIRP", 'label' => __('Airtel Payments Bank')],
            ['value' => "ALLA", 'label' => __('Allahabad Bank')],
            ['value' => "ANDB", 'label' => __('Andhra Bank')],
            ['value' => "ANDB_C", 'label' => __('Andhra Bank Corporate Banking')],
            ['value' => "UTIB", 'label' => __('Axis Bank')],
            ['value' => "BDBL", 'label' => __('Bandhan Bank')],
            ['value' => "BBKM", 'label' => __('Bank of Bahrein and Kuwait')],
            ['value' => "BARB_R", 'label' => __('Bank of Baroda Retail Banking')],
            ['value' => "BKID", 'label' => __('Bank of India')],
            ['value' => "MAHB", 'label' => __('Bank of Maharashtra')],
            ['value' => "BACB", 'label' => __('Bassein Catholic Co-operative Bank')],
            ['value' => "CNRB", 'label' => __('Canara Bank')],
            ['value' => "CSBK", 'label' => __('Catholic Syrian Bank')],
            ['value' => "CBIN", 'label' => __('Central Bank of India')],
            ['value' => "CIUB", 'label' => __('City Union Bank')],
            ['value' => "CORP", 'label' => __('Corporation Bank')],
            ['value' => "COSB", 'label' => __('Cosmos Co-operative Bank')],
            ['value' => "DCBL", 'label' => __('DCB Bank')],
            ['value' => "BKDN", 'label' => __('Dena Bank')],
            ['value' => "DEUT", 'label' => __('Deutsche Bank')],
            ['value' => "DBSS", 'label' => __('Development Bank of Singapore')],
            ['value' => "DLXB", 'label' => __('Dhanlaxmi Bank')],
            ['value' => "DLXB_C", 'label' => __('Dhanlaxmi Bank Corporate Banking')],
            ['value' => "ESAF", 'label' => __('ESAF Small Finance Bank')],
            ['value' => "ESFB", 'label' => __('Equitas Small Finance Bank')],
            ['value' => "FDRL", 'label' => __('Federal Bank')],
            ['value' => "HDFC", 'label' => __('HDFC Bank')],
            ['value' => "ICIC", 'label' => __('ICICI Bank')],
            ['value' => "IBKL", 'label' => __('IDBI')],
            ['value' => "IBKL_C", 'label' => __('IDBI Corporate Banking')],
            ['value' => "IDFB", 'label' => __('IDFC FIRST Bank')],
            ['value' => "IDIB", 'label' => __('Indian Bank')],
            ['value' => "IOBA", 'label' => __('Indian Overseas Bank')],
            ['value' => "INDB", 'label' => __('Indusind Bank')],
            ['value' => "JAKA", 'label' => __('Jammu and Kashmir Bank')],
            ['value' => "JSBP", 'label' => __('Janata Sahakari Bank (Pune)')],
            ['value' => "KCCB", 'label' => __('Kalupur Commercial Co-operative Bank')],
            ['value' => "KJSB", 'label' => __('Kalyan Janata Sahakari Bank')],
            ['value' => "KARB", 'label' => __('Karnataka Bank')],
            ['value' => "KVBL", 'label' => __('Karur Vysya Bank')],
            ['value' => "KKBK", 'label' => __('Kotak Mahindra Bank')],
            ['value' => "LAVB_C", 'label' => __('Lakshmi Vilas Bank Corporate Banking')],
            ['value' => "LAVB_R", 'label' => __('Lakshmi Vilas Bank Retail Banking')],
            ['value' => "MSNU", 'label' => __('Mehsana Urban Co-operative Bank')],
            ['value' => "NKGS", 'label' => __('NKGSB Co-operative Bank')],
            ['value' => "NESF", 'label' => __('North East Small Finance Bank')],
            ['value' => "ORBC", 'label' => __('PNB (Erstwhile-Oriental Bank of Commerce)')],
            ['value' => "UTBI", 'label' => __('PNB (Erstwhile-United Bank of India)')],
            ['value' => "PSIB", 'label' => __('Punjab & Sind Bank')],
            ['value' => "PUNB_R", 'label' => __('Punjab National Bank Retail Banking')],
            ['value' => "RATN", 'label' => __('RBL Bank')],
            ['value' => "RATN_C", 'label' => __('RBL Bank Corporate Banking')],
            ['value' => "SRCB", 'label' => __('Saraswat Co-operative Bank')],
            ['value' => "SVCB_C", 'label' => __('Shamrao Vithal Bank Corporate Banking')],
            ['value' => "SVCB", 'label' => __('Shamrao Vithal Co-operative Bank')],
            ['value' => "SIBL", 'label' => __('South Indian Bank')],
            ['value' => "SCBL", 'label' => __('Standard Chartered Bank')],
            ['value' => "SBBJ", 'label' => __('State Bank of Bikaner and Jaipur')],
            ['value' => "SBHY", 'label' => __('State Bank of Hyderabad')],
            ['value' => "SBIN", 'label' => __('State Bank of India')],
            ['value' => "SBMY", 'label' => __('State Bank of Mysore')],
            ['value' => "STBP", 'label' => __('State Bank of Patiala')],
            ['value' => "SBTR", 'label' => __('State Bank of Travancore')],
            ['value' => "SURY", 'label' => __('Suryoday Small Finance Bank')],
            ['value' => "SYNB", 'label' => __('Syndicate Bank')],
            ['value' => "TMBL", 'label' => __('Tamilnadu Mercantile Bank')],
            ['value' => "TNSC", 'label' => __('Tamilnadu State Apex Co-operative Bank`')],
            ['value' => "TBSB", 'label' => __('Thane Bharat Sahakari Bank')],
            ['value' => "TJSB", 'label' => __('Thane Janata Sahakari Bank')],
            ['value' => "UCBA", 'label' => __('UCO Bank')],
            ['value' => "UBIN", 'label' => __('Union Bank of India')],
            ['value' => "VARA", 'label' => __('Varachha Co-operative Bank')],
            ['value' => "VIJB", 'label' => __('Vijaya Bank')],
            ['value' => "YESB", 'label' => __('Yes Bank')],
            ['value' => "YESB_C", 'label' => __('Yes Bank Corporate Banking')],
            ['value' => "ZCBL", 'label' => __('Zoroastrian Co-operative Bank')],
            
        );

        return $supported_cards;
    }

    public function cardnetworkOptArray($isMultiselect = false) {

        return [
            ['value' => "American Express", 'label' => __('American Express')],
            ['value' => "Diners Club", 'label' => __('Diners Club')],
            ['value' => "Maestro", 'label' => __('Maestro')],
            ['value' => "MasterCard", 'label' => __('MasterCard')],
            ['value' => "RuPay", 'label' => __('RuPay')],
            ['value' => "Visa", 'label' => __('Visa')],
            ['value' => "Bajaj Finserv", 'label' => __('Bajaj Finserv')],
        ];
    }

    public function netbankingbankOptArr($isMultiselect = false) {

        $banks = array(
            ['value' => "AUBL", 'label' => __('AU Small Finance Bank')],
            ['value' => "ABPB", 'label' => __('Aditya Birla Idea Payments Bank')],
            ['value' => "AIRP", 'label' => __('Airtel Payments Bank')],
            ['value' => "ALLA", 'label' => __('Allahabad Bank')],
            ['value' => "ANDB", 'label' => __('Andhra Bank')],
            ['value' => "ANDB_C", 'label' => __('Andhra Bank Corporate Banking')],
            ['value' => "UTIB", 'label' => __('Axis Bank')],
            ['value' => "BDBL", 'label' => __('Bandhan Bank')],
            ['value' => "BBKM", 'label' => __('Bank of Bahrein and Kuwait')],
            ['value' => "BARB_R", 'label' => __('Bank of Baroda Retail Banking')],
            ['value' => "BKID", 'label' => __('Bank of India')],
            ['value' => "MAHB", 'label' => __('Bank of Maharashtra')],
            ['value' => "BACB", 'label' => __('Bassein Catholic Co-operative Bank')],
            ['value' => "CNRB", 'label' => __('Canara Bank')],
            ['value' => "CSBK", 'label' => __('Catholic Syrian Bank')],
            ['value' => "CBIN", 'label' => __('Central Bank of India')],
            ['value' => "CIUB", 'label' => __('City Union Bank')],
            ['value' => "CORP", 'label' => __('Corporation Bank')],
            ['value' => "COSB", 'label' => __('Cosmos Co-operative Bank')],
            ['value' => "DCBL", 'label' => __('DCB Bank')],
            ['value' => "BKDN", 'label' => __('Dena Bank')],
            ['value' => "DEUT", 'label' => __('Deutsche Bank')],
            ['value' => "DBSS", 'label' => __('Development Bank of Singapore')],
            ['value' => "DLXB", 'label' => __('Dhanlaxmi Bank')],
            ['value' => "DLXB_C", 'label' => __('Dhanlaxmi Bank Corporate Banking')],
            ['value' => "ESAF", 'label' => __('ESAF Small Finance Bank')],
            ['value' => "ESFB", 'label' => __('Equitas Small Finance Bank')],
            ['value' => "FDRL", 'label' => __('Federal Bank')],
            ['value' => "HDFC", 'label' => __('HDFC Bank')],
            ['value' => "ICIC", 'label' => __('ICICI Bank')],
            ['value' => "IBKL", 'label' => __('IDBI')],
            ['value' => "IBKL_C", 'label' => __('IDBI Corporate Banking')],
            ['value' => "IDFB", 'label' => __('IDFC FIRST Bank')],
            ['value' => "IDIB", 'label' => __('Indian Bank')],
            ['value' => "IOBA", 'label' => __('Indian Overseas Bank')],
            ['value' => "INDB", 'label' => __('Indusind Bank')],
            ['value' => "JAKA", 'label' => __('Jammu and Kashmir Bank')],
            ['value' => "JSBP", 'label' => __('Janata Sahakari Bank (Pune)')],
            ['value' => "KCCB", 'label' => __('Kalupur Commercial Co-operative Bank')],
            ['value' => "KJSB", 'label' => __('Kalyan Janata Sahakari Bank')],
            ['value' => "KARB", 'label' => __('Karnataka Bank')],
            ['value' => "KVBL", 'label' => __('Karur Vysya Bank')],
            ['value' => "KKBK", 'label' => __('Kotak Mahindra Bank')],
            ['value' => "LAVB_C", 'label' => __('Lakshmi Vilas Bank Corporate Banking')],
            ['value' => "LAVB_R", 'label' => __('Lakshmi Vilas Bank Retail Banking')],
            ['value' => "MSNU", 'label' => __('Mehsana Urban Co-operative Bank')],
            ['value' => "NKGS", 'label' => __('NKGSB Co-operative Bank')],
            ['value' => "NESF", 'label' => __('North East Small Finance Bank')],
            ['value' => "ORBC", 'label' => __('PNB (Erstwhile-Oriental Bank of Commerce)')],
            ['value' => "UTBI", 'label' => __('PNB (Erstwhile-United Bank of India)')],
            ['value' => "PSIB", 'label' => __('Punjab & Sind Bank')],
            ['value' => "PUNB_R", 'label' => __('Punjab National Bank Retail Banking')],
            ['value' => "RATN", 'label' => __('RBL Bank')],
            ['value' => "RATN_C", 'label' => __('RBL Bank Corporate Banking')],
            ['value' => "SRCB", 'label' => __('Saraswat Co-operative Bank')],
            ['value' => "SVCB_C", 'label' => __('Shamrao Vithal Bank Corporate Banking')],
            ['value' => "SVCB", 'label' => __('Shamrao Vithal Co-operative Bank')],
            ['value' => "SIBL", 'label' => __('South Indian Bank')],
            ['value' => "SCBL", 'label' => __('Standard Chartered Bank')],
            ['value' => "SBBJ", 'label' => __('State Bank of Bikaner and Jaipur')],
            ['value' => "SBHY", 'label' => __('State Bank of Hyderabad')],
            ['value' => "SBIN", 'label' => __('State Bank of India')],
            ['value' => "SBMY", 'label' => __('State Bank of Mysore')],
            ['value' => "STBP", 'label' => __('State Bank of Patiala')],
            ['value' => "SBTR", 'label' => __('State Bank of Travancore')],
            ['value' => "SURY", 'label' => __('Suryoday Small Finance Bank')],
            ['value' => "SYNB", 'label' => __('Syndicate Bank')],
            ['value' => "TMBL", 'label' => __('Tamilnadu Mercantile Bank')],
            ['value' => "TNSC", 'label' => __('Tamilnadu State Apex Co-operative Bank`')],
            ['value' => "TBSB", 'label' => __('Thane Bharat Sahakari Bank')],
            ['value' => "TJSB", 'label' => __('Thane Janata Sahakari Bank')],
            ['value' => "UCBA", 'label' => __('UCO Bank')],
            ['value' => "UBIN", 'label' => __('Union Bank of India')],
            ['value' => "VARA", 'label' => __('Varachha Co-operative Bank')],
            ['value' => "VIJB", 'label' => __('Vijaya Bank')],
            ['value' => "YESB", 'label' => __('Yes Bank')],
            ['value' => "YESB_C", 'label' => __('Yes Bank Corporate Banking')],
            ['value' => "ZCBL", 'label' => __('Zoroastrian Co-operative Bank')],
        );

        return $banks;
    }

    public function walletappsOptArr($isMultiselect = false) {

        $wallet_apps = array(

            ['value' => "freecharge", 'label' => __('Freecharge')],
            ['value' => "phonepe", 'label' => __('PhonePe')],
            ['value' => "mobikwik", 'label' => __('Mobikwik')],
            ['value' => "payzapp", 'label' => __('PayZapp')],
            ['value' => "olamoney", 'label' => __('Ola Money')],
            ['value' => "airtelmoney", 'label' => __('Airtel Money')],
            ['value' => "amazonpay", 'label' => __('Amazon Pay')],
            ['value' => "jiomoney", 'label' => __('JioMoney')],
            ['value' => "PayPal", 'label' => __('paypal')],
        );

        return $wallet_apps;
    }

    public function upiappsOptArr($isMultiselect = false) {

        $upi_apps = array(

            ['value' => "google_pay", 'label' => __('Google Pay')],
            ['value' => "bhim", 'label' => __('BHIM')],
            ['value' => "paytm", 'label' => __('PayTM')],
            ['value' => "imobile", 'label' => __('ICICI iMobile')],
            ['value' => "sbi", 'label' => __('BHIM SBI Pay')],
            ['value' => "amazon", 'label' => __('Amazon')],
            ['value' => "whatsapp", 'label' => __('WhatsApp')],
            ['value' => "truecaller", 'label' => __('Truecaller')],
            ['value' => "airtel", 'label' => __('Airtel')],
            ['value' => "PhonePe", 'label' => __('phonepe')],
        );

        return $upi_apps;
    }

}