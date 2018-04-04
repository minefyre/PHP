--TEST--
Bug #36614 (Segfault when using moap)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$lo_moap = new moapClient(dirname(__FILE__)."/bug36614.wsdl");
echo "ok\n";
?>
--EXPECT--
ok
