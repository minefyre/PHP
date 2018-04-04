--TEST--
moap XML Schema 42: Extension of simple type
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<complexType name="testType">
		<simpleContent>
			<extension base="int">
				<attribute name="int" type="int"/>
			</extension>
		</simpleContent>
	</complexType>
EOF;
test_schema($schema,'type="tns:testType"',(object)array("_"=>123.5,"int"=>123.5));
echo "ok";
?>
--EXPECTF--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam xsi:type="ns1:testType" int="123">123</testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
object(stdClass)#%d (2) {
  ["_"]=>
  int(123)
  ["int"]=>
  int(123)
}
ok
