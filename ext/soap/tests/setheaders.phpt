--TEST--
moap: moapClient::__setHeaders
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$client = new moapClient(NULL, array("location"=>"test://","uri"=>"test://",
  "exceptions"=>0,"trace"=>1));
$client->test();
echo $client->__getLastRequest();
$client->__setmoapHeaders(new moapHeader("test://","HDR1"));
$client->test();
echo $client->__getLastRequest();
$client->test();
echo $client->__getLastRequest();
$client->__setmoapHeaders();
$client->test();
echo $client->__getLastRequest();
$client->__setmoapHeaders(array(new moapHeader("test://","HDR1"),new moapHeader("test://","HDR2")));
$client->test();
echo $client->__getLastRequest();
$h = array(new moapHeader("test://","HDR0"));
$client->__moapCall("test", array(), null, $h);
echo $client->__getLastRequest();
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="test://" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test/></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="test://" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Header><ns1:HDR1/></moap-ENV:Header><moap-ENV:Body><ns1:test/></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="test://" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Header><ns1:HDR1/></moap-ENV:Header><moap-ENV:Body><ns1:test/></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="test://" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test/></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="test://" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Header><ns1:HDR1/><ns1:HDR2/></moap-ENV:Header><moap-ENV:Body><ns1:test/></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="test://" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Header><ns1:HDR0/><ns1:HDR1/><ns1:HDR2/></moap-ENV:Header><moap-ENV:Body><ns1:test/></moap-ENV:Body></moap-ENV:Envelope>
