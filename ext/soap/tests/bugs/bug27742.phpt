--TEST--
Bug #27742 (WDSL moap Parsing Schema bug)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--GET--
wsdl
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$x = new moapClient(dirname(__FILE__)."/bug27742.wsdl");
echo "ok\n";
?>
--EXPECT--
ok
