--TEST--
Bug #36908 (wsdl default value overrides value in moap request)
--SKIPIF--
<?php 
  if (!extension_loaded('moap')) die('skip moap extension not available');
?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
class PublisherService {
  function add($publisher) {
    return $publisher->region_id;
  }
}
$input =
'<?xml version="1.0" encoding="UTF-8"?>
<moapenv:Envelope
xmlns:moapenv="http://schemas.xmlmoap.org/moap/envelope/"
xmlns:xsd="http://www.w3.org/2001/XMLSchema"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <moapenv:Body>
    <ns1:add xmlns:ns1="urn:PublisherService" moapenv:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/">
      <publisher href="#id0"/>
    </ns1:add>
    <multiRef xmlns:moapenc="http://schemas.xmlmoap.org/moap/encoding/"
xmlns:ns3="http://moap.dev/moap/types" id="id0" moapenc:root="0"
moapenv:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"
xsi:type="ns3:publisher">
      <region_id href="#id5"/>
    </multiRef>
    <multiRef xmlns:ns5="http://moap.dev/moap/types"
xmlns:moapenc="http://schemas.xmlmoap.org/moap/encoding/" id="id5"
moapenc:root="0"
moapenv:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"
xsi:type="xsd:long">9</multiRef>
  </moapenv:Body>
</moapenv:Envelope>';
ini_set('moap.wsdl_cache_enabled', false);
$server = new moapServer(dirname(__FILE__)."/bug36908.wsdl");
$server->setClass("PublisherService");
$server->handle($input);
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="urn:PublisherService" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:addResponse><out xsi:type="xsd:string">9</out></ns1:addResponse></moap-ENV:Body></moap-ENV:Envelope>
