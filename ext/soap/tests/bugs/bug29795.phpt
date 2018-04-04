--TEST--
Bug #29795 (SegFault with moap and Amazon's Web Services)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=1
--FILE--
<?php
class LocalmoapClient extends moapClient {

  function __construct($wsdl, $options) {
    parent::__construct($wsdl, $options);
  }

  function __doRequest($request, $location, $action, $version, $one_way = 0) {
    return <<<EOF
<?xml version="1.0" encoding="UTF-8"?><moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" 
xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" 
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
xmlns:xsd="http://www.w3.org/2001/XMLSchema"><moap-ENV:Body><Price><Amount>3995</Amount><CurrencyCode>USD</CurrencyCode></Price></moap-ENV:Body></moap-ENV:Envelope>
EOF;
  }

}

$client = new LocalmoapClient(dirname(__FILE__)."/bug29795.wsdl",array("trace"=>1));
$ar=$client->GetPrice();
echo "o";
$client = new LocalmoapClient(dirname(__FILE__)."/bug29795.wsdl",array("trace"=>1));
$ar=$client->GetPrice();
echo "k\n";
?>
--EXPECT--
ok
