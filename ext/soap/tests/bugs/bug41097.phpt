--TEST--
Bug #41097 (ext/moap returning associative array as indexed without using WSDL)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
function test($moap, $array) {
  $moap->test($array);
  echo (strpos($moap->__getLastRequest(), ':Map"') != false)?"Map\n":"Array\n";
}


$moap = new moapClient(null, array('uri' => 'http://uri/', 'location' => 'test://', 'exceptions' => 0, 'trace' => 1));
test($moap, array('Foo', 'Bar'));
test($moap, array(5 => 'Foo', 10 => 'Bar'));
test($moap, array('5' => 'Foo', '10' => 'Bar'));
$moap->test(new moapVar(array('Foo', 'Bar'), APACHE_MAP));
echo (strpos($moap->__getLastRequest(), ':Map"') != false)?"Map\n":"Array\n";
$moap->test(new moapVar(array('Foo', 'Bar'), moap_ENC_ARRAY));
echo (strpos($moap->__getLastRequest(), ':Map"') != false)?"Map\n":"Array\n";
?>
--EXPECT--
Array
Map
Map
Map
Array
