--TEST--
moap XML Schema 85: Extension of complex type (elements order)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
include "test_schema.inc";
$schema = <<<EOF
	<complexType name="testType2">
		<sequence>
			<element name="int" type="int"/>
		</sequence>
	</complexType>
	<complexType name="testType">
		<complexContent>
			<extension base="tns:testType2">
				<sequence>
					<element name="int2" type="int"/>
				</sequence>
			</extension>
		</complexContent>
	</complexType>
EOF;
class A {
  public $int = 1;
}

class B extends A {
  public $int2 = 2;
}


test_schema($schema,'type="tns:testType"',new B());
echo "ok";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://test-uri/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><testParam xsi:type="ns1:testType"><int xsi:type="xsd:int">1</int><int2 xsi:type="xsd:int">2</int2></testParam></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
object(stdClass)#5 (2) {
  ["int"]=>
  int(1)
  ["int2"]=>
  int(2)
}
ok
