--TEST--
Bug #38536 (moap returns an array of values instead of an object)
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
  moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"
  xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/"
  xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xmlns:ns1="http://www.grupos.com.br/ws/enturma/client">
<moap-ENV:Body>
<getClientInfoFromDomainResponse moap-ENC:root="1">
  <xsd:Result xsi:type="ns1:ClientType">
    <id xsi:type="xsd:int">2</id>
    <address href="#i2"/>
  </xsd:Result>
</getClientInfoFromDomainResponse>
<xsd:address id="i2" xsi:type="ns1:ClientAddressType" moap-ENC:root="0">
  <idClient xsi:type="xsd:long">2</idClient>
  <address href="#i3"/>
</xsd:address>
<address xsi:type="xsd:string" id="i3" moap-ENC:root="0">Test</address>
</moap-ENV:Body>
</moap-ENV:Envelope>
EOF;
  }
}

ini_set("moap.wsdl_cache_enabled", 0);
$moapObject = new LocalmoapClient(dirname(__FILE__).'/bug38536.wsdl');
print_r($moapObject->test());
?>
--EXPECT--
stdClass Object
(
    [id] => 2
    [address] => stdClass Object
        (
            [idClient] => 2
            [address] => Test
        )

)
