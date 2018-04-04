--TEST--
Bug #42326 (moapServer crash)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$moap = new moapClient(dirname(__FILE__)."/bug42359.wsdl");
print_r($moap->__getTypes());
?>
--EXPECT--
Array
(
    [0] => list listItem {anonymous1}
    [1] => string anonymous1
    [2] => string enumItem
    [3] => list listItem2 {enumItem}
)

