--TEST--
Bug #40609 (Segfaults when using more than one moapVar in a request)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
ini_set("moap.wsdl_cache_enabled", 0);

$c = new moapClient(dirname(__FILE__)."/bug40609.wsdl", array('trace' => 1, 'exceptions' => 0));

$c->update(array('symbol' => new moapVar("<symbol>MSFT</symbol>", XSD_ANYXML),
                 'price' =>  new moapVar("<price>1000</price>", XSD_ANYXML)));
echo $c->__getLastRequest();
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://quickstart.samples/xsd"><moap-ENV:Body><ns1:update><symbol>MSFT</symbol><price>1000</price></ns1:update></moap-ENV:Body></moap-ENV:Envelope>
ok
