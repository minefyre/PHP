--TEST--
Bug #37278 (moap not respecting uri in __moapCall)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$options = array(
  "location" => "test://",
  "uri"      => "http://bricolage.sourceforge.net/Bric/moap/Auth",
  "trace"    => 1);

$client = new moapClient(null, $options);

$newNS = "http://bricolage.sourceforge.net/Bric/moap/Story";

try {
  $client->__moapCall("list_ids", array(), array("uri" => $newNS));
} catch (Exception $e) {
  print $client->__getLastRequest();
}
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://bricolage.sourceforge.net/Bric/moap/Story" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:list_ids/></moap-ENV:Body></moap-ENV:Envelope>
