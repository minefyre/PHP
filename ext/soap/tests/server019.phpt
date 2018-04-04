--TEST--
moap Server 19: compressed request (gzip)
--SKIPIF--
<?php 
	if (php_sapi_name()=='cli') echo 'skip';
	require_once('skipif.inc'); 
	if (!extension_loaded('zlib')) die('skip zlib extension not available');
?>
--INI--
precision=14
--POST--
<moap-ENV:Envelope
  moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"
  xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xmlns:si="http://moapinterop.org/xsd">
  <moap-ENV:Body>
    <ns1:test xmlns:ns1="http://testuri.org" />
  </moap-ENV:Body>
</moap-ENV:Envelope>
--GZIP_POST--
1
--FILE--
<?php
function test() {
  return "Hello World";
}

$server = new moapserver(null,array('uri'=>"http://testuri.org"));
$server->addfunction("test");
$server->handle();
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://testuri.org" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:testResponse><return xsi:type="xsd:string">Hello World</return></ns1:testResponse></moap-ENV:Body></moap-ENV:Envelope>
ok
