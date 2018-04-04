--TEST--
Bug #31422 (No Error-Logging on moapServer-Side)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$client=new moapClient(null, array('location' => 'http://localhost',
'uri' => 'myNS', 'exceptions' => false, 'trace' => true));

$header = new moapHeader(null, 'foo', 'bar');

$response= $client->__call('function', array(), null, $header);

print $client->__getLastRequest();
?>
--EXPECTF--
Warning: moapHeader::moapHeader(): Invalid namespace in %s on line %d
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="myNS" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Header/><moap-ENV:Body><ns1:function/></moap-ENV:Body></moap-ENV:Envelope>
