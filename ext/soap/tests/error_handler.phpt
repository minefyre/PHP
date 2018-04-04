--TEST--
Bug #46760 (moapClient doRequest fails when proxy is used)
--SKIPIF--
<?php require_once('skipif.inc'); 
if (!extension_loaded('sqlite')) die('skip sqlite extension not available');
?>
--FILE--
<?php
echo "blllllllllaaaaaaa\n";
$var475 = sqlite_factory("\x00");
$var147 = use_moap_error_handler();
$var477 = flock(false,false);dump($client->_proxy_port);
?>
--EXPECT--
blllllllllaaaaaaa
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"><moap-ENV:Body><moap-ENV:Fault><faultcode>moap-ENV:Server</faultcode><faultstring>Call to undefined function dump()</faultstring></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>
