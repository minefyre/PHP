--TEST--
moap XML Schema 51: Array in complex type (maxOccurs > 1, array)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<complexType name="testType">
		<sequence>
			<element name="int" type="int"/>
			<element name="int2" type="int" maxOccurs="unbounded"/>
		</sequence>
	</complexType>
EOF;
test_schema($schema,'type="tns:testType"',(object)array("int"=>123.5,"int2"=>array(123.5,456.7)));
echo "ok";
?>
--EXPECTF--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam xsi:type="ns1:testType"><int xsi:type="xsd:int">123</int><int2 xsi:type="xsd:int">123</int2><int2 xsi:type="xsd:int">456</int2></testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
object(stdClass)#%d (2) {
  ["int"]=>
  int(123)
  ["int2"]=>
  array(2) {
    [0]=>
    int(123)
    [1]=>
    int(456)
  }
}
ok
