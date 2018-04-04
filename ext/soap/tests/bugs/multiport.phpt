--TEST--
Proper binding selection
--SKIPIF--
<?php require_once 'skipif.inc'; ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__).'/multiport.wsdl', 
	array('trace' => true, 'exceptions' => false));
$response = $client->GetSessionId(array('userId'=>'user', 'password'=>'password'));
echo $client->__getLastRequest();
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://www.reuters.com/"><moap-ENV:Body><ns1:GetSessionId><ns1:userId>user</ns1:userId><ns1:password>password</ns1:password></ns1:GetSessionId></moap-ENV:Body></moap-ENV:Envelope>
