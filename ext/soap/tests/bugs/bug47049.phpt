--TEST--
Bug #47049 (moapClient::__moapCall causes a segmentation fault)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__) . '/bug47049.wsdl',
	array('trace' => 1 , 'exceptions' => 0));
$host = array('uuid' => 'foo');
$software_list = array(array('name' => 'package', 'version' => '1.2.3', 'state' => 'installed'));
$updates = array();
$report_id = $client->__moapCall('reportSoftwareStatus',array($host, $software_list, $updates));
echo $client->__getLastRequest();
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://www.example.org/reporter/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:reportSoftwareStatus><host xsi:type="ns1:host"><uuid xsi:type="xsd:string">foo</uuid></host><software_list xsi:type="ns1:software_list"><software xsi:type="ns1:software"><name xsi:type="xsd:string">package</name><version xsi:type="xsd:string">1.2.3</version><state xsi:type="xsd:string">installed</state></software></software_list><updates xsi:type="ns1:updates"/></ns1:reportSoftwareStatus></moap-ENV:Body></moap-ENV:Envelope>
