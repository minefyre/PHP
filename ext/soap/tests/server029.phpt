--TEST--
moap Server 29-CGI: new/addfunction/handle 
--POST--
<?xml version="1.0" encoding="ISO-8859-1"?>
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
--SKIPIF--
<?php 
	if (php_sapi_name()=='cli') echo 'skip';
	require_once('skipif.inc'); 
?>
--FILE--
<?php

echo "INPUT: \n";
echo file_get_contents("php://input") . "\n";
echo "\n\n-----------\n\n";

function test() {
  return "Hello World";
}

$server = new moapserver(null,array('uri'=>"http://testuri.org"));
$server->addfunction("test");
$server->handle();
echo "ok\n";
?>
--EXPECT--
INPUT: 
<?xml version="1.0" encoding="ISO-8859-1"?>
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


-----------

<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://testuri.org" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:testResponse><return xsi:type="xsd:string">Hello World</return></ns1:testResponse></moap-ENV:Body></moap-ENV:Envelope>
ok