--TEST--
Bug #30175 (moap results aren't parsed correctly)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php

class LocalmoapClient extends moapClient {

  function __doRequest($request, $location, $action, $version, $one_way = 0) {
    return <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope
xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"
xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xmlns:xsd="http://www.w3.org/2001/XMLSchema"
xmlns:ns1="urn:qweb">
<moap-ENV:Body
moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"
id="_0">
<ns1:HostInfo xsi:type="ns1:HostInfo">
<name xsi:type="xsd:string">blah blah some name field</name>
<shortDescription xsi:type="xsd:string">This is a description. more blah blah blah</shortDescription>
<ipAddress xsi:type="xsd:string">127.0.0.1</ipAddress>
</ns1:HostInfo>
</moap-ENV:Body>
</moap-ENV:Envelope>
EOF;
  }

}

$client = new LocalmoapClient(dirname(__FILE__)."/bug30175.wsdl");
var_dump($client->qwebGetHostInfo());
?>
--EXPECT--
array(3) {
  ["name"]=>
  string(25) "blah blah some name field"
  ["shortDescription"]=>
  string(42) "This is a description. more blah blah blah"
  ["ipAddress"]=>
  string(9) "127.0.0.1"
}
