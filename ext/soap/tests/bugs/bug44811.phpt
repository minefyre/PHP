--TEST--
Bug #44811 (Improve error messages when creating new moapClient which contains invalid data)
--SKIPIF--
<?php require_once 'skipif.inc'; ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
try {
    $x = new moapClient('http://slashdot.org');
} catch (moapFault $e) {
    echo $e->getMessage() . PHP_EOL;
}
die('ok');
?>
--EXPECTF--
moap-ERROR: Parsing WSDL: Couldn't load from 'http://slashdot.org' : %s

ok
