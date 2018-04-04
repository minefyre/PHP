--TEST--
Bug #27722 (Segfault on schema without targetNamespace)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--GET--
wsdl
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$x = new moapClient(dirname(__FILE__)."/bug27722.wsdl");
echo "ok\n";
?>
--EXPECT--
ok