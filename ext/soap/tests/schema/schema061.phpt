--TEST--
moap XML Schema 61: moap 1.2 Multidimensional array (second way, literal encoding)
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
  	    <attribute ref="enc12:arraySize" wsdl:arraySize="* 1"/>
    	</restriction>
    </complexContent>
	</complexType>
EOF;
test_schema($schema,'type="tns:testType"',array(array(123),array(123.5)),'rpc','literal');
echo "ok";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><moap-ENV:Body><ns1:test><testParam><x_item>123</x_item><x_item>123</x_item></testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
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
