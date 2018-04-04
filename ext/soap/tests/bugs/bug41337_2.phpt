--TEST--
Bug #41337 (WSDL parsing doesn't ignore non moap bindings)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
ini_set("moap.wsdl_cache_enabled",0);
$client = new moapClient(dirname(__FILE__)."/bug41337_2.wsdl");
echo "ok\n";
?>
--EXPECT--
ok
