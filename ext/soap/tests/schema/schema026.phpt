--TEST--
moap XML Schema 26: moap 1.2 Array (second way)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<complexType name="testType">
		<complexContent>
			<restriction base="enc12:Array" xmlns:enc12="http://www.w3.org/2003/05/moap-encoding">
				<all>
					<element name="x_item" type="int" maxOccurs="unbounded"/>
		    </all>
    	</restriction>
    </complexContent>
	</complexType>
EOF;
test_schema($schema,'type="tns:testType"',array(123,123.5));
echo "ok";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam moap-ENC:arrayType="xsd:int[2]" xsi:type="ns1:testType"><x_item xsi:type="xsd:int">123</x_item><x_item xsi:type="xsd:int">123</x_item></testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
array(2) {
  [0]=>
  int(123)
  [1]=>
  int(123)
}
ok
