--TEST--
Bug #37013 (server hangs when returning circular object references)
--SKIPIF--
<?php 
  if (!extension_loaded('moap')) die('skip moap extension not available');
?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$request = <<<REQUEST
<?xml version="1.0" encoding="UTF-8"?><moapenv:Envelope
xmlns:moapenv="http://schemas.xmlmoap.org/moap/envelope/"
xmlns:xsd="http://www.w3.org/2001/XMLSchema"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">

<moapenv:Body>
<ns2:getThingWithParent
 moapenv:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"
 xmlns:ns2="urn:test.moapserver#"/>
</moapenv:Body>

</moapenv:Envelope>
REQUEST;


class ThingWithParent
{
 var $parent;
 var $id;
 var $children;
 function __construct( $id, $parent ) {
  $this->id = $id;
  $this->parent = $parent;
 }
}


class MultiRefTest {
 public function getThingWithParent() {
  $p = new ThingWithParent( 1, null );
  $p2 = new ThingWithParent( 2, $p );
  $p3 = new ThingWithParent( 3, $p );

  $p->children = array( $p2, $p3 );

  return $p2;
 }
}


$server = new moapServer(dirname(__FILE__)."/bug37013.wsdl");
$server->setClass( "MultiRefTest");
$server->handle( $request );
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="urn:test.moapserver#" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:getThingWithParentResponse><result id="ref1" xsi:type="moap-ENC:Struct"><parent id="ref2" xsi:type="moap-ENC:Struct"><parent xsi:nil="true"/><id xsi:type="xsd:int">1</id><children moap-ENC:arrayType="moap-ENC:Struct[2]" xsi:type="moap-ENC:Array"><item href="#ref1"/><item xsi:type="moap-ENC:Struct"><parent href="#ref2"/><id xsi:type="xsd:int">3</id><children xsi:nil="true"/></item></children></parent><id xsi:type="xsd:int">2</id><children xsi:nil="true"/></result></ns1:getThingWithParentResponse></moap-ENV:Body></moap-ENV:Envelope>
