--TEST--
Bug #34449 (ext/moap: XSD_ANYXML functionality not exposed)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
class TestmoapClient extends moapClient {
  function __doRequest($request, $location, $action, $version, $one_way = 0) {
  	echo "$request\n";
  	exit;
  }
}

$my_xml = "<array><item/><item/><item/></array>";
$client = new TestmoapClient(null, array('location' => 'test://', 'uri' => 'test://'));
$client->AnyFunction(new moapVar($my_xml, XSD_ANYXML));
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="test://" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:AnyFunction><array><item/><item/><item/></array></ns1:AnyFunction></moap-ENV:Body></moap-ENV:Envelope>
