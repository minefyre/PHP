--TEST--
moap XML Schema 27: moap 1.1 Multidimensional array
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<complexType name="testType">
		<complexContent>
			<restriction base="moap-ENC:Array">
  	    <attribute ref="moap-ENC:arrayType" wsdl:arrayType="int[,]"/>
    	</restriction>
    </complexContent>
	</complexType>
EOF;
test_schema($schema,'type="tns:testType"',array(array(123),array(123.5)));
echo "ok";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam moap-ENC:arrayType="xsd:int[2,1]" xsi:type="ns1:testType"><item xsi:type="xsd:int">123</item><item xsi:type="xsd:int">123</item></testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
array(2) {
  [0]=>
  array(1) {
    [0]=>
    int(123)
  }
  [1]=>
  array(1) {
    [0]=>
    int(123)
  }
}
ok
