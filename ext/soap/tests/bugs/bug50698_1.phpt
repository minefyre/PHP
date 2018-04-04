--TEST--
Request #50698_1 (moapClient should handle wsdls with some incompatiable endpoints)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
new moapClient(dirname(__FILE__) . '/bug50698_1.wsdl');
echo "ok\n";
?>
--EXPECT--
ok
