--TEST--
Bug #29061 (moap extension segfaults)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/bug29061.wsdl", array("exceptions"=>0)); 
$client->getQuote("ibm"); 
echo "ok\n";
?>
--EXPECT--
ok