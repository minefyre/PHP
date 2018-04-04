--TEST--
Bug #35273 (Error in mapping moap - java types)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
class TestmoapClient extends moapClient {
  function __doRequest($request, $location, $action, $version, $one_way = 0) {
  	echo $request;
  	exit;
	}
}

ini_set("moap.wsdl_cache_enabled", 0);
$client = new TestmoapClient(dirname(__FILE__).'/bug32941.wsdl', array("trace" => 1, 'exceptions' => 0));
$ahoj = $client->echoPerson(array("name"=>"Name","surname"=>"Surname"));
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://service" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="urn:service.EchoService" xmlns:xsd="http://www.w3.org/2001/XMLSchema" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoPerson><p xsi:type="ns2:Person"><name xsi:type="moap-ENC:string">Name</name><surname xsi:type="moap-ENC:string">Surname</surname></p></ns1:echoPerson></moap-ENV:Body></moap-ENV:Envelope>
