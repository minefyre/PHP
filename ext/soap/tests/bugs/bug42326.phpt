--TEST--
Bug #42326 (moapServer crash)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$request = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://www.example.com/"><moap-ENV:Body><ns1:GetProductsRequest><time></time></ns1:GetProductsRequest></moap-ENV:Body></moap-ENV:Envelope>
EOF;


$moap_admin_classmap = array('productDetailsType' => 'moap_productDetailsType',
                             'GetProductsRequest' => 'moap_GetProductsRequest',
                             'GetProductsResponse' => 'moap_GetProductsResponse');

class moap_productDetailsType {
    public $id = 0;
}

class moap_GetProductsRequest {
    public $time = '';
}

class moap_GetProductsResponse {
    public $products;
    function __construct(){
        $this->products = new moap_productDetailsType();
        
    }
}

class moap_Admin {
    public function GetProducts($time){
        return new moap_GetProductsResponse();
    }
}

$moap = new moapServer(dirname(__FILE__).'/bug42326.wsdl', array('classmap' => $moap_admin_classmap));
$moap->setClass('moap_Admin');
ob_start();
$moap->handle($request);
ob_end_clean();
echo "ok\n";
?>
--EXPECT--
ok
