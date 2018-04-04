--TEST--
Bug #30994 (moap server unable to handle request with references)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$HTTP_RAW_POST_DATA = <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<moap:Envelope xmlns:moap="http://schemas.xmlmoap.org/moap/envelope/"
	xmlns:moapenc="http://schemas.xmlmoap.org/moap/encoding/"
	xmlns:tns="http://spock/kunta/kunta"
	xmlns:types="http://spock/kunta/kunta/encodedTypes"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xmlns:xsd="http://www.w3.org/2001/XMLSchema">

<moap:Body
moap:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/">
	<q1:bassCall xmlns:q1="http://spock/bass/types/kunta">
		<system xsi:type="xsd:string">XXX</system>
		<function xsi:type="xsd:string">TASKTEST</function>
		<parameter href="#id1" />
	</q1:bassCall>
	
	<moapenc:Array id="id1" moapenc:arrayType="tns:Item[1]">
		<Item href="#id2" />
	</moapenc:Array>
	
	<tns:Item id="id2" xsi:type="tns:Item">
		<key xsi:type="xsd:string">ABCabc123</key>
		<val xsi:type="xsd:string">123456</val>
	</tns:Item>
	
</moap:Body>
</moap:Envelope>
EOF;

function bassCall() {
  return "ok";
}

$x = new moapServer(NULL, array("uri"=>"http://spock/kunta/kunta"));
$x->addFunction("bassCall");
$x->handle($HTTP_RAW_POST_DATA);
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://spock/kunta/kunta" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:bassCallResponse><return xsi:type="xsd:string">ok</return></ns1:bassCallResponse></moap-ENV:Body></moap-ENV:Envelope>
