--TEST--
moap XML Schema 83: moap 1.2 Array with moap_USE_XSI_ARRAY_TYPE
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<complexType name="testType">
		<complexContent>
			<restriction base="enc12:Array" xmlns:enc12="http://www.w3.org/2003/05/moap-encoding">
  	    <attribute ref="enc12:itemType" wsdl:itemType="int"/>
  	    <attribute ref="enc12:arraySize" wsdl:arraySize="*"/>
    	</restriction>
    </complexContent>
	</complexType>
EOF;
test_schema($schema,'type="tns:testType"',array(123,123.5),"rpc","encoded",'',moap_USE_XSI_ARRAY_TYPE);
echo "ok";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam moap-ENC:arrayType="xsd:int[2]" xsi:type="moap-ENC:Array"><item xsi:type="xsd:int">123</item><item xsi:type="xsd:int">123</item></testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
array(2) {
  [0]=>
  int(123)
  [1]=>
  int(123)
}
ok
