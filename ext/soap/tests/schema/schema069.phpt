--TEST--
moap XML Schema 69: Attribute with default value (reference)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<complexType name="testType">
		<attribute name="str" type="string"/>
		<attribute ref="tns:int"/>
	</complexType>
	<attribute name="int" type="int" default="5"/>
EOF;
test_schema($schema,'type="tns:testType"',(object)array("str"=>"str"));
echo "ok";
?>
--EXPECTF--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam str="str" xsi:type="ns1:testType"/></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
object(stdClass)#%d (2) {
  ["str"]=>
  string(3) "str"
  ["int"]=>
  int(5)
}
ok
