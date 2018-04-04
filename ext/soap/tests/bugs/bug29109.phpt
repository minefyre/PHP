--TEST--
Bug #29109 (Uncaught moapFault exception: [WSDL] Out of memory)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/bug29109.wsdl");
var_dump($client->__getFunctions()); 
?>
--EXPECT--
array(1) {
  [0]=>
  string(53) "HelloWorldResponse HelloWorld(HelloWorld $parameters)"
}